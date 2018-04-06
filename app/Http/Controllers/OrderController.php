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
            return redirect('account/login');
        
        $user = session('user');
        $orders = array();        
        
        switch ($status) {
            case 'pending':
                $subtitle = 'Paquetes pendientes por entregar';
                $statusName='<p style="color: orange; margin:0;">Paquetes pendientes</p>';  
                $queryFormer = "SELECT * FROM orders WHERE id_user=".$user->id." and (status LIKE 'pending' or status LIKE 'received') ORDER BY `orders`.`status` DESC, `orders`.`created_at` DESC";
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
                $queryFormer = "SELECT * FROM orders WHERE id_user=".$user->id." and status LIKE 'closed' ORDER BY `orders`.`updated_at` DESC";
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
            return redirect('account/login');
        
        $user = session('user');
        $orders = array();
        $status = "new";
        $subtitle = 'Reportar un paquete nuevo';
        $statusName='<p style="color: orange; margin:0;">Reportar un paquete nuevo</p>';                  
        
        
        return view('order.create', ['user'=>$user]);
    }
    
    /*
     * Funcion para almacenar los datos de la orden/paquete
     * @parameters $request son los datos del formulario de la orden
     * @return void
     */
    public function store(Request $request){  
        $data = $request->all();
        $user = session('user');
        unset($data['_token']);
        
        $data['buyed']= date_format(date_create_from_format("d/m/Y",$data['buyed']),"Y-m-d");
        $data['id_user'] = $user->id;
        $data['status'] = 'pending';

        $order = Order::updateOrCreate($data);        
        return redirect('order/index/pending');
    }
    
    /*
     * Funcion que cambia el estatus de una orden al siguiente estatus
     */
    public function changeStatus($id)
    {
        header('Access-Control-Allow-Origin: *');        
        
        $order = Order::find($id);
        
        switch ($order->status)
        {
            case 'pending':
                $order->status='received';
                $order->save();
                break;
            
            case 'received':
                $order->status='closed';
                $order->save();
                break;
            
            default:
                break;
        }                                    
    }
}
