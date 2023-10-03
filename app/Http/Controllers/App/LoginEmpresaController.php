<?php

namespace BolsaTrabajo\Http\Controllers\App;

use BolsaTrabajo\Empresa;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use BolsaTrabajo\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginEmpresaController extends Controller
{
    use AuthenticatesUsers;

    private $empresa;

    protected $guard = 'empresasw';
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/';
    protected $loginView = 'app.home.index';
    protected $username = 'usuario_empresa';

    public function __construct(Empresa $empresa)
    {
        $this->middleware('guest:empresasw', ['except' => ['logout'] ]);
        $this->empresa = $empresa;
    }

    protected function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->getCredentials($request);
        $empresa = Empresa::where('aprobado', 1)->where('usuario_empresa', $credentials['usuario_empresa'])->first();

        if ($empresa && Hash::check($credentials['password'], $empresa->password)) {
            Auth::guard($this->getGuard())->login($empresa, $request->has('remember'));
            return $this->handleUserWasAuthenticated($request, null);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function consultar_reniec($data)
    {
        $token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
        $dni = $data;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 2,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Referer: https://apis.net.pe/consulta-dni-api',
            'Authorization: Bearer ' . $token
          ),
        ));
        $response = curl_exec($curl);  
        curl_close($curl);
        return response()->json($response);
    }

    public function consultar_sunat($data){
        $token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
        // $ruc = '20553056846';
        $ruc = $data;
        
        // Iniciar llamada a API
        $curl = curl_init();
        
        // Buscar ruc sunat
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Referer: http://apis.net.pe/api-ruc',
            'Authorization: Bearer ' . $token
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        return response()->json($response);

        // Datos de empresas según padron reducido
        // $empresa = json_decode($response);
        
        // echo "<pre>";
        // print_r($empresa);
        // echo "<pre>";
        
    }

}
