@extends('layouts.app')
@section('content')
    <!--<h3>ENVIOS SOLUCIONES INTEGRALES </h3>-->
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding: 0px !important;">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo asset('images/l1648-boeing-747-400-500-200-trans.png')?>" style="width:100%;">
                <div class="carousel-caption">
                    <h3 class="shadow-white">Soluciones Integrales Envíos</h3>
                    <p class="shadow-white">                    
                        En Soluciones Integrales Envíos realizamos sus envios de Estados Unidos a Venezuela de forma eficiente y confiable
                        de  modo que sus encargos lleguen de manera segura a sus manos, 
                        realizando todos los procesos de una manera fácil y al mejor precio del mercado. 
                        Registrate y comienza disfrutar de nuestros servicios

                    </p>
                    <a href="<?php echo url('account/create') ?>" class="btn btn-primary btn-lg" role="button" style="float: none">Registrarse</a>
                </div>                                                
            </div>
            <div class="item">
                <img src="<?php echo asset('images/contenedores-500-200-trans.jpg')?>"  style="width:100%;">
                <div class="carousel-caption">
                    <h3 class="shadow-white">Soporte</h3>
                    <p class="shadow-white">                    
                        En nuestra seccion de preguntas y respuestas, podras aclarar cualquier duda acerca de nuestros servicios, 
                        en caso de no encontrar lo que buscas contactanos, en Envios Soluciones Integrales estamos para servirte                            
                    </p>
                    <a href="<?php echo url('support') ?>" class="btn btn-primary btn-lg" role="button" style="float: none">Soporte</a>
                </div>                                                

            </div>                
            <div class="item">
                <img src="<?php echo asset('images/avion-contenedor-500-200-trans.jpg')?>"  style="width:100%;">
                <div class="carousel-caption">
                    <h3 class="shadow-white">Calcular precios</h3>
                    <p class="shadow-white">                    
                        Calcula el precio de tu encomienda, con nuestra calculadora digital y veras que tenemos los mejores precios del mercado. Abre una cuenta con nosotros y te sorprenderás
                    </p>
                    <a href="<?php echo url('calculate') ?>" class="btn btn-primary btn-lg" role="button" style="float: none">Calcular</a>
                </div>                                                
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>            
    </div>
    <hr>
    <div class="container-fluid content">
        <div class="orange-box">
            <div class="row" style="text-align: center">            
                <div class="col-sm-12 col-md-6">
                    <h3><span class="glyphicon glyphicon-ok" style="color:green"></span> ENVIOS AEREOS Y MARITIMOS DESDE MIAMI A VENEZUELA</h3>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h3><span class="glyphicon glyphicon-ok" style="color:green"></span> EL MEJOR PRECIO DEL MERCADO, SIN PESO MINIMO</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: center">
                    <h3>
                        <span class="glyphicon glyphicon-ok" style="color:green"></span>&nbsp;
                        <span class="glyphicon glyphicon-ok" style="color:green"></span>&nbsp; 
                        LA MEJOR OPCION PARA SUS COMPRAS                    
                    </h3>
                </div>            
            </div>
        </div>                    
    </div>
    <hr>
    <div class="container-fluid content">
        <div class="row" style="background-color: #01274b;">            
            <div class="col-sm-12 col-md-6" style="color: white">
                <h3 style="text-align: center; color: white;">Dirección en miami</h3>
                <p>
                    9802 NW 80th av. G47 Hialeah Gardens Fl, 33016                
                </p>
                <p>
                    Para sus envios recuerde que debe colocar los datos de su cuenta en la dirección, como puede ver 
                    <a href="#" data-toggle="modal" data-target="#myModal">acá</a>. 
                </p>
                <p>
                    ¿No posee una cuenta? <a href="<?php echo url('account/create')?>">Registrate aquí</a>.
                </p>
            </div>            
            <div class="col-sm-12 col-md-6" style="color: white">
                <h3 style="text-align: center; color: white;">Contáctanos</h3>
                <p>
                    Si necesita información, quiere plantearnos una inquietud o simplemente ponerse en contacto con nosotros, puede escribirnos al correo 
                    <strong>solucionesintegrales1609@gmail.com</strong>
                </p>
                <p>
                    También puede contactarnos vía telefónica por los teléfonos: 
                    <ul>
                        <li>(0212) 6821369</li>
                        <li>(0416) 6424326</li>
                        <li>(0416) 6424261</li>
                    </ul>
                </p>
            </div>            
        </div>
        <hr>
        <div style="background-color: #dfe9f1;border: 1px solid #b6bcc2;">
            <h3 style="text-align: center" id="openAccount">Abre una cuenta con nosotros, es totalmente gratis</h3>
            @include('account.form')        
        </div>
    </div>
@endsection

