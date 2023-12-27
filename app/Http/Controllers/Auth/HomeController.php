<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use BolsaTrabajo\Actividad_economica;
use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function  index()
    {
        return view('auth.home.index', ['actividad_eco' => Actividad_economica::all()]);
    }
}
