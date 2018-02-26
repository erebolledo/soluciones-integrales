@extends('layouts.app')

@section('content')
<?php 
    $name = explode(' ', $user->name);
    $name = $name[0];
?>
    <div>
        @include('order.indexBar')
        <div style="border: 1px solid #e7e7e7;padding: 20 10 0;border-top: 0;background-color: #f8f8f8;">
            <h4 style="font-weight: 700;color: #01274b;margin:20 0">{{$subtitle}}</h4>
            <?php if (empty($orders)):?>
                <h3 style="text-align: center; margin: 30px; color: orange">No existen paquetes en esta lista</h3>
            <?php endif;?>    
            <?php foreach ($orders as $order): ?>
            <?php
                $idOrder = 100000 + $order->id;  
                $dateBuyed = (empty($order->buyed))?"---":date("d/m/Y", strtotime($order->buyed));
            ?>
            <div class="box">
                <div class="row"><label>Identificador del paquete: </label>{{$idOrder}}</div>
                <div class="row"><label>Número de orden: </label><?=$order->n_order ?></div>
                <div class="row"><label>Número de tracking: </label><?=(empty($order->n_tracking))?"---":$order->n_tracking?></div>
                <div class="row"><label>Origen: </label><?=(empty($order->store))?"---":$order->store?></div>
                <div class="row"><label>Fecha de compra: </label><?=$dateBuyed?></div>
                <div class="row"><label>Estatus: </label><?=$status?></div>
            </div>
            <?php endforeach;?>       
        </div>        
    </div>    
    <script>        
        document.getElementById('<?=$status?>').innerHTML = '<?=$statusName?>';
    </script>    
@endsection


<?php
?>