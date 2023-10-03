<?php

namespace BolsaTrabajo\Http\Controllers\App;

use BolsaTrabajo\AlumnoAviso;
use BolsaTrabajo\Area;
use BolsaTrabajo\Actividad_economica;
use BolsaTrabajo\Aviso;
use BolsaTrabajo\Cargo;
use BolsaTrabajo\Condicion;
use BolsaTrabajo\Distrito;
use BolsaTrabajo\Empresa;
use BolsaTrabajo\Horario;
use BolsaTrabajo\Modalidad;
use BolsaTrabajo\Provincia;
use BolsaTrabajo\Grado_academico;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmpresaController extends Controller
{
    protected $avisos_per_page = 40;

    public function avisos(Request $request)
    {
        if($request->ajax()) {

            $Avisos = Aviso::where('empresa_id', Auth::guard('empresasw')->user()->id)
                ->orderBy('id', 'asc')->paginate($this->avisos_per_page);

            return [
                'avisos' => view('app.empresa.avisos.ajax.listado')->with(['avisos' => $Avisos, 'i' => ($this->avisos_per_page*($Avisos->currentPage()-1)+1) ])->render(),
                'next_page' => $Avisos->nextPageUrl()
            ];
        }

        return view('app.avisos.index');
    }

    public function index()
    {
        $Empresa = Auth::guard('empresasw')->user();
        $ActividadEconomica = Actividad_economica::all();
        $Areas = Area::all();
        $Provincias = Provincia::all();
        $Distritos = Distrito::where('provincia_id', $Empresa->provincia_id)->orderby('nombre', 'asc')->get();
        $Cargos = Cargo::all();

        return view('app.empresas.index', ['Areas' => $Areas, 'Provincias' => $Provincias, 'Distritos' => $Distritos, 'Cargos' => $Cargos, 'Empresa' => $Empresa, 'ActividadEconomica' => $ActividadEconomica]);
    }


    public function store(Request $request){

        $status = false; $Empresa = Auth::guard('empresasw')->user();

        $request->merge([
            'link' => Str::slug($request->nombre_comercial),
        ]);

        $validator = Validator::make($request->all(), [
            'link' => 'required|unique:empresas,link,'.($Empresa->id != 0 ? $Empresa->id : "NULL").',id,deleted_at,NULL',
            // 'razon_social' => 'required',
            // 'nombre_comercial' => 'required',
            // 'provincia_id' => 'required',
            // 'distrito_id' => 'required',
            // 'direccion' => 'required',
            // 'telefono' => 'required|max:15',
            // 'email' => 'required|email',
            // 'descripcion' => 'required',
            // 'nombre_contacto' => 'required',
            // 'apellido_contacto' => 'required',
            // 'cargo_contacto' => 'required',
            // 'telefono_contacto' => 'required',
            // 'email_contacto' => 'required|email',
        ]);

        if(!$validator->fails()){

            $random = Str::upper(str_random(4)); $logo = null;

            if($request->file('logo') != null){
                $logo = uniqid($random . "_") . '.' . $request->file('logo')->getClientOriginalExtension();
            }

            $Empresa = Empresa::find($Empresa->id);

            if(!$logo) $logo = $Empresa->logo;

            $Empresa->razon_social = $request->razon_social;
            $Empresa->nombre_comercial = $request->nombre_comercial;
            $Empresa->actividad_economica_empresa = $request->actividad_economica;
            $Empresa->link = $request->link;
            $Empresa->provincia_id = $request->provincia_id;
            $Empresa->distrito_id = $request->distrito_id;
            $Empresa->direccion = $request->direccion;
            $Empresa->referencia = $request->referencia;
            $Empresa->telefono = $request->telefono;
            $Empresa->email = $request->email;
            $Empresa->pagina_web = $request->pagina_web;
            // $Empresa->descripcion = $request->descripcion;
            // $Empresa->logo = $logo;
            $Empresa->nombre_contacto = $request->nombre_contacto;
            $Empresa->apellido_contacto = $request->apellido_contacto;
            $Empresa->cargo_contacto = $request->cargo_contacto;
            $Empresa->telefono_contacto = $request->telefono_contacto;
            $Empresa->email_contacto = $request->email_contacto;

            $Empresa->nombre_paciente = $request->name_paciente;
            $Empresa->enfermedad_paciente = $request->enfermedad_paciente;
            $Empresa->evidencias_paciente = $request->carga_evidencias;

            if($Empresa->save()) {
                if ($request->file('logo') != null)
                    $request->file('logo')->move('uploads/empresas/logos', $logo);

                $status = true;
            }
        }

        return response()->json(['Success' => $status, 'Errors' => $validator->errors() ]);
    }

    public function registrar_aviso()
    {
        $Empresa = Auth::guard('empresasw')->user();
        $Areas = Area::all();
        $Modalidades = Modalidad::all();
        $Condiciones = Condicion::all();
        $Horarios = Horario::all();
        // $Distritos = Distrito::all();
        $Grado = Grado_academico::all();
        $TipoPersona = Empresa::all();

        $Provincias = Provincia::all();
        $Distritos = Distrito::where('provincia_id', $Empresa->provincia_id)->orderby('nombre', 'asc')->get();


        return view('app.avisos.registrar', ['Areas' => $Areas, 'Modalidades' => $Modalidades,
            'Condiciones' => $Condiciones, 'Horarios' => $Horarios, 'Distritos' => $Distritos, 'Grado' => $Grado, 'TipoPersona' => $TipoPersona, 'Provincias' => $Provincias]);
    }

    public function store_aviso(Request $request)
    {
        $status = false;

        $request->merge([
            'empresa_id' => Auth::guard('empresasw')->user()->id,
            'link' => Str::slug($request->titulo),
            'area_id' => 1,
            'vacantes' => $request->vacantes,
            'solicita_carrera' => $request->solicita_carrera,
            'solicita_grado_a' => $request->solicita_grado_a,
            'ciclo_cursa' => $request->ciclo_cursa,
            'periodo_vigencia' => $request->periodo_vigencia,
            'referencia_direccion' => $request->referencia_direccion,
            'direccion' => $request->direccion
        ]);

        $validator = Validator::make($request->all(), [
            'empresa_id' => 'required',
            // 'titulo' => 'required',
            // 'link' => ['required','unique:avisos,link,'.($request->id != 0 ? $request->id : "NULL").',id,empresa_id,'.$request->empresa_id.',deleted_at,NULL'],
            //'area_id' => 'required',
            // 'modalidad_id' => 'required',
            // 'horario_id' => 'required',
            'distrito_id' => 'required',
            'descripcion' => 'required',
            // 'salario' => 'required',
            'vacantes' => 'required',
            'solicita_carrera' => 'required',
            'solicita_grado_a' => 'required',
            'periodo_vigencia' => 'required'
        ]);

        if (!$validator->fails()){
            Aviso::create($request->all());
            $status = true;
        }

        return $status ? redirect(route('empresa.avisos')) : redirect(route('empresa.registrar_aviso'))->withErrors($validator)->withInput();
    }


    public function update_aviso(Request $request)
    {
        $status = false;

        $request->merge([
            'empresa_id' => Auth::guard('empresasw')->user()->id,
            'link' => Str::slug($request->titulo),
        ]);

        $validator = Validator::make($request->all(), [
            'empresa_id' => 'required',
            'titulo' => 'required',
            'link' => ['required','unique:avisos,link,'.($request->id != 0 ? $request->id : "NULL").',id,empresa_id,'.$request->empresa_id.',deleted_at,NULL'],
            //'area_id' => 'required',
            // 'modalidad_id' => 'required',
            // 'horario_id' => 'required',
            'distrito_id' => 'required',
            'descripcion' => 'required',
            'salario' => 'required'
        ]);

        if (!$validator->fails()){
                $entity = Aviso::find($request->id);
                $entity->titulo = $request->titulo;
                $entity->link = $request->link;
                // $entity->modalidad_id = $request->modalidad_id;
                // $entity->horario_id = $request->horario_id;
                $entity->distrito_id = $request->distrito_id;
                $entity->descripcion = $request->descripcion;
                $entity->salario = $request->salario;
                $entity->vacantes = $request->vacantes;
                $entity->solicita_carrera = $request->solicita_carrera;
                $entity->solicita_grado_a = $request->solicita_grado_a;
                $entity->ciclo_cursa = $request->ciclo_cursa;
                $entity->periodo_vigencia = $request->periodo_vigencia;

                if($entity->save()) $status = true;
        }

        return response()->json(['Success' => $status, 'Errors' => $validator->errors()]);
    }

    public function listar_aviso()
    {
        return view('app.avisos.listar');
    }

    public function listar_aviso_json()
    {
        return response()->json(['data' => Aviso::where('empresa_id', Auth::guard('empresasw')->user()->id)
            ->with('areas')->with('empresas')->with('modalidades')->with('horarios')->with('provincias')->with('distritos')->get()]);
    }

    public function partialView_aviso($id)
    {
        $entity = null;

        if($id != 0) $entity = Aviso::find($id);

        $Areas = Area::all();
        $Modalidades = Modalidad::all();
        $Condiciones = Condicion::all();
        $Horarios = Horario::all();
        $Provincias = Provincia::all();
        $Distritos = $entity != null && $entity->provincia_id != null ? Distrito::where('provincia_id', $entity->provincia_id)->get() : Distrito::all();
        $Grado = Grado_academico::all();

        return view('app.avisos._actualizar', ['Aviso' => $entity, 'Areas' => $Areas, 'Modalidades' => $Modalidades,
            'Condiciones' => $Condiciones, 'Horarios' => $Horarios, 'Provincias' => $Provincias, 'Distritos' => $Distritos, "Grado" => $Grado]);
    }

    public function partialViewAvisoPostulantes($id)
    {
        $Aviso = Aviso::find($id);

        if($Aviso != null && $Aviso->empresa_id == Auth::guard('empresasw')->user()->id)
            return view('app.avisos._postulantes', ['id' => $id]);

        return  null;
    }

    public function list_avisoPostulantes(Request $request)
    {
        return response()->json(['data' => AlumnoAviso::with('alumnos')->with('estados')->where('aviso_id', $request->id)->get() ]);
    }

}
