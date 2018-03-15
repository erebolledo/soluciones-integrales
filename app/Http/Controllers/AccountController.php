<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
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
        $user = Account::updateOrCreate($data);
        $code = 1000+$user->id;
        $user = Account::updateOrCreate(['id' => $user->id], ['code'=>$code]);
                
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
        //erer@adad.com        

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
     */
    public function initSession(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');
        $user = Account::where('email', $email)->first();

        session(['user'=>$user]);
        
        if (!empty($remember)){
            $token = md5($email).md5($password);
            Account::updateOrCreate(['id'=>$user->id], ['token' => $token]);        
            setcookie ("tokenCookie",$token,time()+ (10 * 365 * 24 * 60 * 60));            
        }else{
            $token = '';
            Account::updateOrCreate(['id'=>$user->id], ['token' => $token]);        
            setcookie ("tokenCookie",$token,time()+ (10 * 365 * 24 * 60 * 60));            
        }
        
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
            $m->from('karen.suarez@gmail.com', 'Nuestra aplicacion');

            $m->to('karen.suarez@gmail.com', $user->name)->subject('prueba de correo');
        });        
    }
    
}
