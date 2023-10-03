<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Empresa;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    public function index()
    {
        return view('auth.empresa.index');
    }

    public function list()
    {
        return response()->json(['data' => Empresa::with('provincias')->with('distritos')->get() ]);
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

    public function delete(Request $request)
    {
        $status = false;
        $entity = Empresa::find($request->id);
        if($entity->delete()) $status = true;

        return response()->json(['Success' => $status]);
    }

}
