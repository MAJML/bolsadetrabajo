<?php

namespace BolsaTrabajo\Http\Controllers\App;

use BolsaTrabajo\Alumno;
use BolsaTrabajo\AlumnoHabilidad;
use BolsaTrabajo\App;
use BolsaTrabajo\Area;
use BolsaTrabajo\Distrito;
use BolsaTrabajo\Educacion;
use BolsaTrabajo\ExperienciaLaboral;
use BolsaTrabajo\Habilidad;
use BolsaTrabajo\Provincia;
use BolsaTrabajo\ReferenciaLaboral;
use Carbon\Carbon;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PDF;

class PostulacionesController extends Controller
{
    public function index()
    {
        $Alumno = Auth::guard('alumnos')->user();
        $Areas = Area::all();
        $Provincias = Provincia::all();
        $Distritos = Distrito::where('provincia_id', $Alumno->provincia_id)->get();

        $Educaciones = Educacion::where('alumno_id', $Alumno->id)->get();
        $ExperienciaLaboral = ExperienciaLaboral::where('alumno_id', $Alumno->id)->get();
        $ReferenciaLaboral = ReferenciaLaboral::where('alumno_id', $Alumno->id)->get();
        $Habilidades = AlumnoHabilidad::where('alumno_id', $Alumno->id)
            ->whereHas('habilidades', function ($query) { $query->whereNull('deleted_at'); })
            ->get();

        $Anios =  range(date('Y'), date('Y')-21);
        array_push($Anios, "En Curso");

        $errors = Alumno::ValidatePerfilAlumno();

        return view('app.postulaciones.index');
    }

}
