<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\AlumnoAviso;
use BolsaTrabajo\Grado_academico;
use BolsaTrabajo\Estado;
use BolsaTrabajo\Area;
use BolsaTrabajo\Aviso;
use BolsaTrabajo\Empresa;
use BolsaTrabajo\Distrito;
use BolsaTrabajo\Estudiante_aviso;
use BolsaTrabajo\Intermediacion_seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AvisoPostulacionController extends Controller
{
    public function index()
    {
        return view('auth.aviso-postulacion.index', ['Empresas' => Empresa::all()]);
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

    public function partialViewPostulantesEstudiantes(Request $request)
    {
        return response()->json(['data' =>  Estudiante_aviso::where('aviso_id', $request->id)->where('deleted_at', NULL)->get() ]);
    }

    public function list_postulantes(Request $request)
    {
        return response()->json(['data' => AlumnoAviso::with('alumnos')->with('estados')->where('aviso_id', $request->id)->get() ]);
    }

    public function partialEditarEstados($idalumno, $idaviso)
    {
        $estado = Estado::all();
        $alumno_avisos = AlumnoAviso::where('alumno_id', $idalumno)->where('aviso_id', $idaviso)->get();
        return view('auth.aviso._EditarEstado', ['alumno_avisos' => $alumno_avisos, 'idalumno' => $idalumno, 'idaviso' => $idaviso, 'estado' => $estado]);
    }
}
