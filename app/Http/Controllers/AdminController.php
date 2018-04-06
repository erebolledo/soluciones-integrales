<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Account;
use App\CoronadoAccount;
use App\Admin;

class AdminController extends Controller {
    
    /*
     * Funcion para iniciar la sesion del administrador
     */
    public function initSession(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');        
        
        session()->flush();
        session()->save();        
        
        $admin = Admin::where('login', $login)->first();
        
        if (empty($admin->id))
        {
            session()->flash('error', 'El usuario no existe');
            return redirect('admin/login');
        }

        if ($admin->password !== $password)
        {
            session()->flash('error', 'El password es incorrecto');            
            return redirect('admin/login');            
        }
        
        session(['admin'=>$admin]);
        return redirect('admin');            
        
    }

    /*
     * Funcion para listar la pantalla principal del administrador
     */
    public function index()
    {
        if (empty(session('admin')))
            return redirect('admin/login');

        return redirect('admin/list');
    }
    
    /*
     * Funcion para listar las ordenes con los requests que sean pasados por parametros
     */
    public function orders(Request $request)
    {                
        header('Access-Control-Allow-Origin: *');        
        $search = $request->input('search');
        $orderBy = $request->input('order_by');
        $requestArray = $request->all();
        
        if (array_key_exists('search', $requestArray))
            unset($requestArray['search']);
        
        if (array_key_exists('order_by', $requestArray))
            unset($requestArray['order_by']);        
                
        $queryFormer = "SELECT a.id AS id_account, a.code, a.name, a.email, "
                . "o.id as id_order, o.n_order, o.status, o.n_tracking FROM orders as o INNER JOIN accounts as a "
                . "ON o.id_user=a.id";    

        if (!empty($search)){
            $queryFormer .= " where Concat_WS('',name,phonePrimary,phoneSecondary,mobile,email, company,source, industry, country) "
                    . "like '%$search%'";        
        }else{
            if (!empty($requestArray)){
                $queryFormer .= " where true";
            }            
        }    
        
        if (!empty($requestArray)){        
            foreach ($requestArray as $key => $req){
                $queryFormer .=  " and $key like '%$req%'";
            }
        }

        $queryFormer .= " order by $orderBy asc";

        $orders = DB::select($queryFormer);
        
        return $orders;        
    }
    
    /*
     * Funcion para guardar los ids creados en coronado para ser usados por nuestro sistema
     */
    public function storeIdCoronado(Request $request)
    {
        $request = $request->input('ids');        
        
        $ids = explode(' ', $request);
        
        foreach ($ids as $id)
        {
            $data = ['id'=>NULL, 'id_solinte'=>0,  'id_coronado'=>$id, 'available'=>1];
            $coronadoAccount = CoronadoAccount::updateOrCreate($data);
        }
        
        session()->flash('message', 'Los IDs fueron insertados exitosamente');
        return redirect('admin/id-coronado');        
    }
    
    /*
     * Funcion para salir de la cuenta
     */
    public function logout(Request $request){
        session()->flush();
        session()->save();
        return redirect('admin/login');
    }        
}
?>
