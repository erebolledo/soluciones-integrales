<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\CoronadoAccount;
use App\DollarValue;
use App\Account;
use Mail;

class AccountController extends Controller
{
    public $user;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    
    public function index(Request $request){
        return view('welcome');
        $res = Account::where('email', 'erkarebolledo@gmail.com')->first();
        die(print_r($res));
        die();
        session()->flush();
        session()->save();
        die(print_r(session()->all()));        
    }
    
    /*
     * Funcion para salir de la cuenta
     */
    public function logout(Request $request){
        session()->flush();
        session()->save();
        return view('welcome');
    }    

    /*
     * Funcion para almacenar una nueva cuenta
     * @parameter Request $request son las entradas del formulario
     * @return void
     */
    public function store(Request $request){
        session()->flush();
        session()->save();        
        
        $data = $request->all();
        unset($data['_token']);
        $token = hash_hmac('sha256', $data['email'], 'secret');
        $data['token'] = $token;

        $user = Account::updateOrCreate($data);
        
        $coronadoAccount = CoronadoAccount::where('available', 1)->first();
        $coronadoAccount->id_solinte = $user->id;
        $coronadoAccount->available = 0;
        $coronadoAccount->save();
        
        $user->code = $coronadoAccount->id_coronado;
        $user->save();
        
        Mail::send('email.welcome', ['user' => $user], function ($m) use ($user) {
            $m->from('envios@soluciones-integrales.com.ve', 'Soluciones Integrales');
            $m->to($user->email, $user->name)->subject('Bienvenido a Soluciones Integrales Envíos');
            $m->bcc('envios@soluciones-integrales.com.ve', 'Soluciones Integrales')->subject('Nuevo cliente');
        });                
                
        session(['user'=>$user]);
        
        return redirect('order/create');
        
        return response()
            ->json($user, 200)
            ->header('Content-Type', 'application/json');
    }
    
    /*
     * Funcion que nos indica si un correo electronico ya esta registrado en el sistema
     */
    public function exist($email){        
        header('Access-Control-Allow-Origin: *');        
        $user = Account::where('email', $email)->get();        
        
        return count($user);
    }
    
    /*
     * Funcion para autenticar a un usuario, si existe en el sistema se pasa a la pagina de sesion, si no existe se reenvia a la pagina de registro
     */
    public function auth(Request $request) {
        header('Access-Control-Allow-Origin: *');
        $data = json_decode($request->getContent());

        $res = Account::where('email', $data->email)->first();

        $this->user = $res;
        if (!isset($res->password))
            return 'no email';
        else { 
            if ($data->password === $res->password)
                return 'auth';
            else
                return 'no auth';
        }        
        return "";
    }
    
    /*
     * Funcion donde se inicializa la sesion de la cuenta en el sistema
     * 
     */
    public function initSession(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        //$remember = $request->input('remember');
        $user = Account::where('email', $email)->first();

        session(['user'=>$user]);
        
        /*if (!empty($remember)){
            $token = md5($email).md5($password);
            Account::updateOrCreate(['id'=>$user->id], ['token' => $token]);        
            setcookie ("tokenCookie",$token,time()+ (10 * 365 * 24 * 60 * 60));            
        }else{
            $token = '';
            Account::updateOrCreate(['id'=>$user->id], ['token' => $token]);        
            setcookie ("tokenCookie",$token,time()+ (10 * 365 * 24 * 60 * 60));            
        }*/
        
        return redirect('order/create');        
    }

    /*
     * Funcion donde se inicializa la sesion de la cuenta en el sistema utilizando el token
     * del cliente
     * @parameters $token Es el token del cliente
     * @result void
     */
    public function tokenLogin($token) {
        $user = Account::where('token', $token)->first();        
        session(['user'=>$user]);
        
        return redirect('order/create');        
    }
    
    /*
     * Funcion para obtener los datos de una cuenta
     * @parameter int $id Es el id de la cuent del usuario
     * @result Respueta en json de los datos del usuario
     */
    public function get($id){
        header('Access-Control-Allow-Origin: *');
        $user = Account::find($id);
        
        return response()
            ->json($user, 200)
            ->header('Content-Type', 'application/json');
    }    
    
    /*
     * Funcion para mostrar los datos de a cuenta
     * @parameter int $id Es el id de la cuent del usuario
     * @result Respueta en json de los datos del usuario
     */
    public function show($status="") {    
        $user = session('user');
        
        return view('account.show',['user'=>$user]);        
    }

    public function forgot(){
        $user = Account::find(57);

        Mail::send('account.email', ['user' => $user], function ($m) use ($user) {
            $m->from('envios@soluciones-integrales.com.ve', 'Nuestra aplicacion con el nuevo dominio');
            $m->to('erkarebolledo@gmail.com', $user->name)->subject('prueba de correo');
        });        
    }
    
    /*
     * Funcion para obtener el valor del dolar, debe ser llamada desde el crontab
     * @result $dollar Es el valor del dolar en ese momento
     */
    public function getDollarValue(){        
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://twitter.com/dolartoday?lang=es');
        $page = $res->getBody()->getContents();
        $page = explode('el $ cotiza a Bs. ', $page);
        $page = explode(' ', $page[1]);
        $value = str_replace(',', '.', $page[0]);
        
        if (!empty($value)){
            $data = ['value'=>$value];
            $dollar = DollarValue::updateOrCreate($data);
        }else{
            $dollar = '';
        }
        
        return $dollar;        
    }
    
    public function calculate() {
        $dollar = DollarValue::orderBy('created_at', 'desc')->first();
        return view('calculator.calculate',['dollar'=>$dollar]);        
    }
    
    public function test(){
        $client = new \GuzzleHttp\Client();
        
        $response = $client->request('POST', 'http://s6.stephytrackingonline.com/CoronadoExpress/Agents/Header/AgentCheck.asp', [
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
            'form_params' => [
                'UserID' => '207',
                'UserPassword' => 'si1234',
            ]                        
        ]);
        die('asdasd');
        die(print_r($response->getHeaders()));
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://s6.stephytrackingonline.com/CoronadoExpress/Agents/Apps/Customers/InAddCustomer.asp', [
            'form_params' => [
                'Name' => 'SI',
                'Add1' => 'caracas',
                'Ciudad' => 'caracas',
                'Pais' => 'venezuela',
                'Phone1' => '04166424326',
                'Email' => 'erkarebolledo@gmail.com',
                'AgentID' => '207',
                'SetRepack' => 'Yes',
                'Complete' => 'No',
                'Destino' => 'CCS',
                'PoBox' => '0',
                'ServiceType' => '-1',                
                'CountryID' => '0',
                'StatusID' => '2',
                'LanguageID' => '2',                
                'Password' => 'si1234',
                'Out' => '',
                'Type' => 'C',                
                'Save' => '1',
                'Terms' => '0',
                'Ins' => 'N',                                
                'InsRat' => '0',
                'Class' => '0',
                'Special' => '0',                
                'AirCurrenc' => '',
                'MarClass' => '0',
                'MarSpecial' => '0',                                                
                'OceanCurrency' => '',                                                               
            ]
        ]);        
        
        die('listo');
        die(print_r($response));
        
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://twitter.com/dolartoday?lang=es');
        $page = $res->getBody()->getContents();
        $page = explode('el $ cotiza a Bs. ', $page);        
        $value = explode(' ', $page[1]);
        
        return $value;
    }
}
