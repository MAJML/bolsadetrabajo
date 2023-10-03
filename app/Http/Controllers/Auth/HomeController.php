<?php

namespace BolsaTrabajo\Http\Controllers\Auth;

use Illuminate\Http\Request;
use BolsaTrabajo\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function  index()
    {
        return view('auth.home.index');
    }
}
