<!-- Stored in resources/views/layouts/app.blade.php -->
<?php 
/*$values = [7,15,17,21];
$nValues = count($values);
$total=0;

for($i=0;$i<$nValues;$i++){
    $total+=$values[$i];
}

echo $total;

die();*/
?>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Soluciones Integrales</title>
        <noscript>Es necesario Javascrit para ejecutar esta aplicación.</noscript>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
        <!--<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>        

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">        
        <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/form.css')?>" type="text/css">        
        <link rel="icon" href="<?php echo asset('images/integralIcono.png')?>" sizes="192x192" />
    </head>
    <body>
        <div>
        <header class="width">
            <nav class="navbar navbar-default" style="padding: 14px">
              <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" 
                                aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="img-menu">
                        <a href="/"><img src="<?php echo asset('images/cropped-integral-logo-envios.png')?>" width="350px"></a>
                    </div>
                    <div class="no-img-menu">
                        <a href="/">
                            <h1 style="font-weight: bolder;color: #01274b; margin: 0px;">
                                Soluciones Integrales <font color="orange">Envios</font>
                            </h1>
                        </a>
                    </div>                    
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav navbar-right" style="font-size: medium">
                    <li><a href="<?php echo url('/') ?>">Principal</a></li>
                    <li><a href="<?php echo url('order/index') ?>">Cuenta</a></li>
                    <li><a href="<?php echo url('account/create') ?>">Registrarse</a></li>                  
                    <li><a href="<?php echo url('calculate') ?>">Calculadora</a></li>            
                    <li><a href="#">Soporte</a></li>
                    <?php if (!empty(session('user'))):?>
                        <li><a href="<?php echo url('account/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    <?php endif;?>                     
                    <!--<li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                      </ul>
                    </li>-->
                  </ul>
                </div><!--/.nav-collapse -->
              </div><!--/.container-fluid -->
            </nav>
        </header>
        <section class="main-content width">
            <div class="">
                @yield('content')
            </div>
        </section>
        <footer>
            <div class="footer width">
                <div class="footer-text">
                    Copyright © 2018 | Desarrollado por Soluciones Integrales
                </div>                
            </div>  
        </footer>    
    </div>
        
    </body>
</html>