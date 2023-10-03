<?php

namespace BolsaTrabajo\Http\Controllers\App;

use BolsaTrabajo\Alumno;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAlumnoController extends Controller
{
    use AuthenticatesUsers;

    private $alumno;

    protected $guard = 'alumnos';
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/';
    protected $loginView = 'app.home.index';
    protected $username = 'usuario_alumno';

    public function __construct(Alumno $alumno)
    {
        $this->middleware('guest:alumnos', ['except' => ['logout'] ]);
        $this->alumno = $alumno;
    }

    protected function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->getCredentials($request);
        $alumno = Alumno::where('aprobado', 1)->where('usuario_alumno', $credentials['usuario_alumno'])->first();

        if ($alumno && Hash::check($credentials['password'], $alumno->password)) {
            Auth::guard($this->getGuard())->login($alumno, $request->has('remember'));
            return $this->handleUserWasAuthenticated($request, null);
        }

        return $this->sendFailedLoginResponse($request);
    }
}
