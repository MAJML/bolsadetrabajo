<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use BolsaTrabajo\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    public function index()
    {
        return view('auth.empresa.index');
    }

    public function list(Request $request)
    {
        if($request->actividad_eco_filter_id != null && $request->actividad_eco_filter_id != ""){
            return response()->json(['data' => Empresa::with('provincias')
            ->where('actividad_economica_empresa', $request->actividad_eco_filter_id )
            ->with('distritos')
            ->with('actividad_economicas')
            ->get() ]);
        }else{
            return response()->json(['data' => Empresa::with('provincias')
            ->with('distritos')
            ->with('actividad_economicas')
            ->get() ]);
        }

    }

    public function partialView($id)
    {
        return view('auth.empresa._Mantenimiento', ['Entity' => Empresa::find($id)]);
    }

    public function update(Request $request)
    {
        $status = false;
        $entity = Empresa::find($request->id);
        $entity->aprobado = $request->update_id;

        if($entity->save()) $status = true;

        return response()->json(['Success' => $status]);
    }

    public function updateData(Request $request)
    {
        $status = false;
        $validator = Validator::make($request->all(), [
            'tipo_persona' => 'required',
        ]);
        if (!$validator->fails()){
            $entity = Empresa::find($request->id);
            $entity->tipo_persona = $request->tipo_persona;
            if($entity->save()) $status = true;            
        }
        return response()->json(['Success' => $status, 'Errors' => $validator->errors()]);
    }

    public function delete(Request $request)
    {
        $status = false;
        $entity = Empresa::find($request->id);
        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }

}
