@extends('layouts.app')
@section('content')
    <div class="content">
        <h3 style="margin-bottom: 20px;">PREGUNTAS FRECUENTES</h3>
        <div class="container-fluid">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#process">¿Cuál es el proceso para traer mis paquetes a través de Sistemas Integrales Envios?</a>
                        </h4>
                    </div>
                    <div id="process" class="panel-collapse collapse">
                        <div class="panel-body">
                            Si no tienes una cuenta debes crear una cuenta con nosotros, puedes hacerlo <a href="<?php echo url('account/create')?>">acá</a>, luego
                            debes realizar el envio de tu paquete a la dirección en miami especificada en <a href="<?php echo url('data')?>">este enlace</a>. Por último
                            registra tu paquete en el sistema, para hacerlo sigue el <a href="<?php echo url('order/create')?>">siguiente enlace</a>.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#account">¿Como creo una cuenta en Sistemas Integrales Envios?</a>
                        </h4>
                    </div>
                    <div id="account" class="panel-collapse collapse">
                        <div class="panel-body">
                            Para crear una cuenta con nosotros entra en el siguiente <a href="<?php echo url('account/create')?>">enlace</a>,
                            llena el formulario con tus datos personales y tu dirección para la entrega.              
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#order">¿Como registro un paquete?</a>
                        </h4>
                    </div>
                    <div id="order" class="panel-collapse collapse">
                        <div class="panel-body">
                            Estando dentro de tu cuenta procede a llenar el formulario de registro de tu paquete, puedes llegar de manera directa
                            haciendo click en el siguiente <a href="<?php echo url('order/create')?>">enlace</a>.              
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#order-status">¿Cuales son los estatus de mi paquete?</a>
                        </h4>
                    </div>
                    <div id="order-status" class="panel-collapse collapse">
                        <div class="panel-body">
                        Los paquetes pasan por tres distintos estatus:
                            <ul>
                                <li>
                                    <strong>Abierto:</strong> Es cuando el usuario registra el paquete, aún se encuentra en transito y no ha llegado
                                    a Venezuela.
                                </li>
                                <li>
                                    <strong>Recibido:</strong> El paquete ya se encuentra en Venezuela y esta listo para la entrega.
                                </li>                        
                                <li>
                                    <strong>Entregado:</strong> Son aquellos paquetes que ya fueron entregados a sus dueños.
                                </li>                                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#order">¿Donde puedo ver el estatus de un paquete?</a>
                        </h4>
                    </div>
                    <div id="order" class="panel-collapse collapse">
                        <div class="panel-body">
                            Para ver el estatus de tu paquete puedes entrar <a href="<?php echo url('order/index')?>">acá</a>.
                        </div>
                    </div>
                </div>                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#order">¿Como puedo pagar el costo de mi envio?</a>
                        </h4>
                    </div>
                    <div id="order" class="panel-collapse collapse">
                        <div class="panel-body">
                            Puedes pagar el costo de tu envio a traves de:
                            <ul>
                                <li>Transferencia/depósito en BsF</li>
                                <li>Paypal</li>
                            </ul>
                        </div>
                    </div>
                </div>                                
            </div> 
        </div>
    </div>
@endsection    

