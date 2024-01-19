<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Alumno;
use BolsaTrabajo\Area;
use BolsaTrabajo\Distrito;
use BolsaTrabajo\Provincia;
use BolsaTrabajo\Educacion;
use BolsaTrabajo\ExperienciaLaboral;
use BolsaTrabajo\ReferenciaLaboral;
use Illuminate\Support\Facades\Auth;
use BolsaTrabajo\AlumnoHabilidad;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class AlumnoController extends Controller
{
    public function index()
    {
        return view('auth.alumno.index');
    }

    public function list()
    {
        return response()->json(['data' => Alumno::with('provincias')->with('distritos')->with('areas')
            ->with('educaciones')->get() ]);
    }

    // codigo hecho por marco
    public function print_cv_pdf($id)
    {
        $alumno = Alumno::find($id);
        $Areas = Area::all();
        $Provincias = Provincia::all();

        if($alumno != null){

            $Distritos = Distrito::where('provincia_id', $alumno->provincia_id)->get();
            $Educaciones = Educacion::where('alumno_id', $alumno->id)->get();
            $ExperienciaLaboral = ExperienciaLaboral::where('alumno_id', $alumno->id)->get();

            $Habilidades = AlumnoHabilidad::where('alumno_id', $alumno->id)
                ->whereHas('habilidades', function ($query) { $query->whereNull('deleted_at'); })
                ->get();

            $ReferenciaLaboral = ReferenciaLaboral::where('alumno_id', $alumno->id)->get();

            $data = array(
                'areas' => $Areas,
                'alumno' => Alumno::find($id),
                'habilidades' => $Habilidades,
                'distritos' => $Distritos,
                'educaciones' => $Educaciones,
                'experienciaLaboral' => $ExperienciaLaboral,
                'referenciaLaboral' => $ReferenciaLaboral
            );
            $pdf = PDF::loadView('auth.alumno.exports.cv_pdf', $data);
            /* $pdf = PDF::loadView('auth.alumno.exports.print_cv_pdf', $data); */
            /* return $pdf->download('CV-'.($alumno->nombres.' '.$alumno->apellidos).'.pdf'); */
            return $pdf->stream('CV-'.($alumno->nombres.' '.$alumno->apellidos).'.pdf');
        }

        return redirect()->to('/auth/alumno');
    }

    public function update(Request $request)
    {
        $status = false;
        $entity = Alumno::find($request->id);
        $entity->aprobado = $request->update_id;

        if($entity->save()) $status = true;

        return response()->json(['Success' => $status]);
    }

    public function delete(Request $request)
    {
        $status = false;
        $entity = Alumno::find($request->id);
        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }
}
