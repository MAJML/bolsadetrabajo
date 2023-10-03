<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\AlumnoAviso;
use BolsaTrabajo\Aviso;
use BolsaTrabajo\Empresa;
use BolsaTrabajo\Estudiante_aviso;
use BolsaTrabajo\Intermediacion_seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use BolsaTrabajo\Http\Controllers\Controller;

class AvisoController extends Controller
{
    public function index()
    {
        return view('auth.aviso.index', ['Empresas' => Empresa::all()]);
    }

    public function list(Request $request)
    {
        return response()->json(['data' => Aviso::whereHas('empresas', function ($q) { $q->where('deleted_at',  null);})
        ->whereHas('empresas', function ($q) use ($request) { if($request->empresa_filter_id != null && $request->empresa_filter_id != ""){ $q->where('id', $request->empresa_filter_id ); }})
        ->with('empresas')->with('provincias')->with('areas')
        ->with('modalidades')->with('horarios')->with('provincias')
        ->with('distritos')->orderBy('id')->get()
        ]);
    }

    public function partialViewPostulantes($id)
    {
        return view('auth.aviso._Postulantes', ['id' => $id]);
    }

    public function partialViewPostulantes2($id)
    {
        return view('auth.aviso._Seguimiento', ['id' => $id]);
    }

    // codigo hecho por marco
    public function partialViewPostulantesEstudiantes2(Request $request)
    {
        return response()->json(['data' =>  Intermediacion_seguimiento::where('aviso_id', $request->id)->where('deleted_at', NULL)->get() ]);
    }

    public function partialViewPostulantesEstudiantes(Request $request)
    {
        return response()->json(['data' =>  Estudiante_aviso::where('aviso_id', $request->id)->where('deleted_at', NULL)->get() ]);
    }

    public function list_postulantes(Request $request)
    {
        return response()->json(['data' => AlumnoAviso::with('alumnos')->with('estados')->where('aviso_id', $request->id)->get() ]);
    }

    public function delete(Request $request)
    {
        $status = false;

        $entity = Aviso::find($request->id);

        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }

    // codigo creado por marco
    public function store_estudiante_aviso(Request $request)
    {   
        $status = false;

        $request->merge([
            'aviso_id' => $request->id_estudiante_aviso,
            'nombres'  => $request->nombres_apellido,
            'dni'      => $request->dni,
            'telefono' => $request->celular,
            'correo'   => $request->correo,
            'grado_academico' => $request->grado_academico,
            'estado' => $request->estado
        ]);
        $validator = Validator::make($request->all(), [
            'nombres_apellido' => 'required'
        ]);

        if (!$validator->fails()){
            Estudiante_aviso::create($request->all());
            $status = true;
        }

        return $status ? redirect(route('auth.aviso')) : redirect(route('auth.aviso'))->withErrors($validator)->withInput();

    }

    public function store_seguimiento(Request $request)
    {   
        $status = false;

        $request->merge([
            'aviso_id' => $request->id_aviso_s,
            'fecha_envio_postulantes'  => $request->fecha_envio,
            'fecha_seguimiento'  => $request->fecha_seguimiento,
            'comentarios' => $request->comentario
        ]);
        $validator = Validator::make($request->all(), [
            'aviso_id' => 'required'
        ]);

        if (!$validator->fails()){
            Intermediacion_seguimiento::create($request->all());
            $status = true;
        }

        return $status ? redirect(route('auth.aviso')) : redirect(route('auth.aviso'))->withErrors($validator)->withInput();
        
    }
}
