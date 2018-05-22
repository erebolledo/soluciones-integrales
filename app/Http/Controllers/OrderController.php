<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use App\Account;
use App\Order;
use App\Package;
use GuzzleHttp\Client;
use Mail;

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
                $queryFormer = "SELECT * FROM orders WHERE id_user=".$user->id." and (status LIKE 'pending' or status LIKE 'received' or status LIKE 'invoiced') "
                        . "ORDER BY `orders`.`status` DESC, `orders`.`created_at` DESC";
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
        
        $data['buyed'] = (!empty($data['buyed']))?date_format(date_create_from_format("d/m/Y",$data['buyed']),"Y-m-d"):NULL;
        $data['id_user'] = $user->id;
        $data['status'] = 'pending';
        $data['n_order'] = (empty($data['n_order']))?NULL:$data['n_order'];
        $data['n_tracking'] = (empty($data['n_tracking']))?NULL:$data['n_tracking'];
        $data['observations'] = (empty($data['observations']))?NULL:$data['observations'];
        
        $order = Order::updateOrCreate($data);

        Mail::send('email.newOrder', ['user' => $user, 'order'=>$order], function ($m) use ($user, $order) {
            $m->from('auto@soluciones-integrales.com.ve', 'Soluciones Integrales');
            $m->to($user->email, $user->name)->subject('Orden número '.$order->id);
            $m->bcc('envios@soluciones-integrales.com.ve', 'Soluciones Integrales')->subject('Orden número '.$order->id);            
        });                      
        
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
    
    public function getTracking($tracking)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', 'http://s6.stephytrackingonline.com/CoronadoExpress/MainWebsite.asp', [
            'form_params' => [
                'Data' => $tracking,
                'Go' => '1',
                'ID' => $tracking.'|',
                'Type' => 'T'
            ]
        ]);  
        
        $page = $res->getBody()->getContents();
        $page = explode("<hr color='#CCCCCC' size='1'>", $page);
        $page = explode("</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table>", $page[1]);        
        
        if (!empty($page[0]))
        {
            $page = explode("&nbsp;", $page[0]);
            
            if ($page[1]==="Not received / Found")
                return "<p style='background-color:yellow;'><strong>EL PAQUETE NO HA SIDO RECIBIDO EN NUESTRAS OFICINAS.</strong></p>";
            else
                return $page[1];            
        }            

        return 'NO SE PUDO TRACKEAR EL PAQUETE, FAVOR NOTIFICAR AL ADMINISTRADOR';            
    }
    
    /*
     * Funcion para dar la orden por recibida en las oficinas de coronados
     */
    public function receipt(Request $request)
    {
        header('Access-Control-Allow-Origin: *');        
        $data = $request->all();
        
        foreach ($data as $index => $field)
        {
            if ($index!=='description')
            {                
                $data[$index] = str_replace(',', '.', $field);
            }
        }        
        
        $order = Order::find($request->input('id'));
        $order->weight = $data['weight'];
        $order->vol_weight = $data['vol_weight'];
        $order->width = $data['width'];
        $order->large = $data['large'];
        $order->high = $data['high'];
        $order->description = (empty($data['description']))?NULL:$data['description'];
        $order->pieces = $data['pieces'];
        $order->num_receipt = $data['num_receipt'];
        $order->status='received';

        $order->save();        
        
        $user = Account::find($order->id_user);
        
        Mail::send('email.receiptOrder', ['user' => $user, 'order'=>$order], function ($m) use ($user, $order) {
            $m->from('auto@soluciones-integrales.com.ve', 'Soluciones Integrales');
            $m->to($user->email, $user->name)->subject('Soluciones Integrales orden # '.$order->id.' recibida');
        });                              
    }
    
    /*
     * Funcion para generar la factura
     */
    public function invoice(Request $request)
    {
        header('Access-Control-Allow-Origin: *');        
        $data = $request->all();
        
        $order = Order::find($request->input('id'));
        $order->price = str_replace(',', '.', $data['price']);
        $order->status='invoiced';
        $order->save();
        
        $user = Account::find($order->id_user);

        Mail::send('email.invoiceOrder', ['user' => $user, 'order'=>$order], function ($m) use ($user, $order) {
            $m->from('auto@soluciones-integrales.com.ve', 'Soluciones Integrales');
            $m->to($user->email, $user->name)->subject('Soluciones Integrales orden # '.$order->id.' recibida');
        });                                      
    }
    
    /*
     * Funcion para obtener la data de determinada orden
     */
    public function get($id)
    {
        header('Access-Control-Allow-Origin: *');                
        $order = Order::find($id);
        
        return $order;
    }
}
