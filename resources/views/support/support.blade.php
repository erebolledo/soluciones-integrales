@extends('layouts.app')
@section('content')
    <div class="content">
        <h3>PREGUNTAS FRECUENTES</h3>
        <div class="question">
            <ul>
                <li>
                    <a href="<?php echo url('support/#process')?>"><h4>¿Cuál es el proceso para traer mis paquetes a través de Sistemas Integrales Envios?</h4></a>
                </li>
                <li>
                    <a href="<?php echo url('support/#account')?>"><h4>¿Como creo una cuenta en Sistemas Integrales Envios?</h4></a>
                </li>
                <li>
                    <a href="<?php echo url('support/#order')?>"><h4>¿Como registro un paquete?</h4></a>
                </li>            
                <li>
                    <a href="<?php echo url('support/#order-status')?>"><h4>¿Cuales son los estatus de mi paquete?</h4></a>
                </li>            
                <li>
                    <a href="<?php echo url('support/#')?>"><h4>¿Donde puedo ver el estatus de un paquete?</h4></a>
                </li>            
                <li>
                    <a href="<?php echo url('support/#')?>"><h4>¿Como puedo pagar el costo de mi envio?</h4></a>
                </li>                        
            </ul>
        </div>
        <hr>
        <div class="answer">
            <ol class="no-dot">
                <li>
                    <h4 id="process">¿Cuál es el proceso para traer mis paquetes a través de Sistemas Integrales Envios?</h4>
                    <p>
                        Si no tienes una cuenta debes crear una cuenta con nosotros, puedes hacerlo <a href="<?php echo url('account/create')?>">acá</a>, luego
                        debes realizar el envio de tu paquete a la dirección en miami especificada <a href="<?php echo url('data')?>">acá</a>. Por último
                        registra tu paquete en el sistema, puedes entrar <a href="<?php echo url('order/create')?>">acá</a>.
                    </p>
                    <br>                    
                </li>
                <li>
                    <h4 id="account">¿Como creo una cuenta en Sistemas Integrales Envios?</h4>
                    <p>
                        Para crear una cuenta con nosotros entra en el siguiente <a href="<?php echo url('account/create')?>">enlace</a>,
                        llena el formulario con tus datos personales y tu dirección para la entrega.
                    </p>
                    <br>
                </li>
                <li>
                    <h4 id="order">¿Como registro un paquete?</h4>
                    <p>
                        Estando dentro de tu cuenta procede a llenar el formulario de registro de tu paquete, puedes llegar de manera directa
                        haciendo click en el siguiente <a href="<?php echo url('order/create')?>">enlace</a>.
                    </p>
                    <br>
                </li>            
                <li>
                    <h4 id="order-status">¿Cuales son los estatus de mi paquete?</h4>
                    <p>
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
                    </p>
                    <br>
                </li>            
                <li>
                    <h4>¿Donde puedo ver el estatus de un paquete?</h4>
                    <p>
                        Para ver el estatus de tu paquete puedes entrar <a href="<?php echo url('order/index')?>">acá</a>.
                    </p>
                    <br>
                </li>            
                <li>
                    <h4>¿Como puedo pagar el costo de mi envio?</h4>
                    <p>
                        Puedes pagar el costo de tu envio a traves de:
                        <ul>
                            <li>Transferencia/depósito en BsF</li>
                            <li>Paypal</li>
                        </ul>
                    </p>
                    <br>
                </li>                        
            </ol>
        </div>        
    </div>
@endsection

