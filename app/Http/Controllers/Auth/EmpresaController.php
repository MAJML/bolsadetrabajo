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
        if($request->mostrar == 'mostrar'){
            return response()->json(['data' => Empresa::with('provincias')
            ->with('distritos')
            ->with('actividad_economicas')
            ->orderBy('created_at', 'DESC')
            ->get() ]);
        }else if($request->ruc_dni != null && $request->ruc_dni != ""){
            return response()->json(['data' => Empresa::with('provincias')
            ->where('tipo_persona', 'like', '%'.$request->actividad_eco_filter_id.'%' )
            ->where('ruc', 'like', '%'.$request->ruc_dni.'%' )
            ->orWhere('nombre_comercial', 'like', '%'.$request->ruc_dni.'%')
            ->with('distritos')
            ->with('actividad_economicas')
            ->orderBy('created_at', 'DESC')
            ->limit(80)
            ->get() ]);
        }else{
            return response()->json(['data' => '' ]);
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
            $entity->ruc = $request->ruc;
            $entity->razon_social = $request->razon_social;
            $entity->nombre_comercial = $request->nombre_empresa;
            $entity->direccion = $request->direccion;
            $entity->telefono = $request->telefono;
            $entity->email = $request->email;
            $entity->pagina_web = $request->pagina_Web;
            $entity->nombre_contacto = $request->nombre_contacto;
            $entity->telefono_contacto = $request->telefono_contacto;
            $entity->cargo_contacto = $request->cargo_contacto;
            $entity->email_contacto = $request->email_contacto;
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
