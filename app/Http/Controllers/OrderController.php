<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use App\Package;

class OrderController extends Controller
{
    /*
     * Funcion donde manejamos los paquetes de las cuentas
     * @param  string $pack
     * @param  int $sent
     * @return view
     */
    public function index($status='pending') {
        //Si el usuario solicito recordar entonces verifica a cookie
        if (!empty($_COOKIE['tokenCookie'])){
            $user = Account::where('token', $_COOKIE['tokenCookie'])->first();
            if (!empty($user))
                session(['user'=>$user]);
        }

        //Si la session esta vacia devuelve la pantalla a login
        if (empty(session('user')))
            return view('account.login');
        
        $user = session('user');
        $orders = array();        
        
        switch ($status) {
            case 'pending':
                $subtitle = 'Paquetes pendientes por entregar';
                $statusName='<p style="color: orange; margin:0;">Paquetes pendientes</p>';  
                $queryFormer = "SELECT * FROM packages WHERE id_user=".$user->id." and (status LIKE 'pending' or status LIKE 'received') ORDER BY `packages`.`created_at` DESC";
                $orders = DB::select($queryFormer);
                //$status = "Paquete pendiente";
                break;
            case 'received':
                $subtitle = 'Paquetes recibidos en nuestro almacen';
                $statusName='<p style="color: orange; margin:0;">Paquetes recibidos</p>';            
                //$status = "Paquete listo para la entrega";
                break;
            case 'closed':
                $subtitle = 'Paquetes entregados al cliente';
                $statusName='<p style="color: orange; margin:0;">Paquetes entregados</p>';            
                $queryFormer = "SELECT * FROM packages WHERE id_user=".$user->id." and status LIKE 'closed' ORDER BY `packages`.`updated_at` DESC";
                $orders = DB::select($queryFormer);                
                //$status = "Paquete entregado";
                break;
        }            
        return view('order.index', ['user'=>$user, 'status'=>$status, 'statusName'=>$statusName, 'orders'=>$orders, 'subtitle'=>$subtitle]);
    }
    
    /*
     * Funcion para crear una orden/paquete nuevo
     * @return view
     */
    public function create() {
        //Si el usuario solicito recordar entonces verifica a cookie
        if (!empty($_COOKIE['tokenCookie'])){
            $user = Account::where('token', $_COOKIE['tokenCookie'])->first();
            if (!empty($user))
                session(['user'=>$user]);
        }
        
        //Si la session esta vacia devuelve la pantalla a login
        if (empty(session('user')))
            return view('account.login');
        
        $user = session('user');
        $orders = array();
        $status = "new";
        $subtitle = 'Reportar un paquete nuevo';
        $statusName='<p style="color: orange; margin:0;">Reportar un paquete nuevo</p>';                  
        
        
        return view('order.create', ['user'=>$user]);
    }
    
    /*
     * Funcion para salvar una orden/paquete nuevo
     * @param  int $sent
     * @return 
     */
    public function save(Request $request){  
        $user = session('user');
        die(print_r($user));
        
        $dataArray['id_user']=$user->id;
        $dataArray['n_order']= substr($request->input('n_order'), 0, 50); 
        $dataArray['status']= 'pending';
        $dataArray['n_tracking']= substr($request->input('n_tracking'), 0, 50);
        $dataArray['store']= substr($request->input('store'), 0, 50); 
        $dataArray['buyed']= date_format(date_create_from_format("d/m/Y",$request->input('buyed')),"Y-m-d");
        $dataArray['observations']= $request->input('observations'); 
        
        $data = Package::updateOrCreate($dataArray);
        
        return redirect('account/pack/pending/1');
    }
}
