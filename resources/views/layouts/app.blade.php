<!-- Stored in resources/views/layouts/app.blade.php -->
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/form.css')?>" type="text/css">        
        <link rel="icon" href="<?php echo asset('images/integralIcono.png')?>" sizes="192x192" />
        
        <style>
            .btn-social{
                margin-bottom: 5px; 
                width: 200px;
                float: none; 
                color: white;                
                text-align: left;    
            }
            
            .social-icon {
                padding: 20px;
                font-size: 30px;
                width: 70px;
                text-align: center;
                text-decoration: none;
                margin: 5px 2px;
                color: white;
                border-radius: 50%;
            }

            .social-icon:hover {
                opacity: 0.7;
                color: black;
            }            
        </style>
    </head>
    <body>
        <div>
        <header class="width">
            <nav class="navbar navbar-default top-nav-collapse width" id="navMenu" style="padding: 14px">
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
                  <ul class="nav navbar-nav navbar-right">
                    <li><a id ="main" href="<?php echo url('/') ?>">Principal</a></li>
                    <li><a id ="default" href="<?php echo url('order/index') ?>">Cuenta</a></li>
                    <li><a id="accountCreate" href="<?php echo url('account/create') ?>">Registrarse</a></li>                  
                    <li><a id="calculate" href="<?php echo url('calculate') ?>">Calcular</a></li>
                    <li><a id="" href="<?php echo url('#') ?>" data-toggle="modal" data-target="#myModal">Datos envío</a></li>
                    <li><a id="support" href="<?php echo url('support') ?>">Soporte</a></li>
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
        <section class="main-content width" id="section">
            <div id = "message"></div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: lightyellow">
                        <div class="modal-body">
                            @include('account.dataForSend')
                        </div>
                    </div>      
                </div>
            </div>            
            
            <div class="">
                @yield('content')
            </div>
        </section>
        <footer class="width footer">
            <div class="row">
                <div class="col-sm-12">
                    <h4 style="color: white">Siguenos en nuestras redes sociales</h4>                    
                    <a href="#" target="_blank" class="social-icon fa fa-facebook" style="background-color: #3B5998"></a>
                    <a href="#" target="_blank" class="social-icon fa fa-twitter" style="background-color: #55ACEE"></a>
                    <a href="#" target="_blank" class="social-icon fa fa-instagram" style="background-color: #125688"></a>                    
                </div>
            </div>
        </footer> 
        <div class="footer width" style="background-color: #021d38;">
            <div> 
                <div class="" style="text-align: center">
                    Copyright&nbsp;©&nbsp;2018 | Desarrollado por Soluciones Integrales&nbsp;
                    RIF:&nbsp;J-404421556
                </div>                                                    
            </div>
        </div>            
    </div>
        
    </body>
    <script>
        $( document ).ready(function() {
            
            /*
             * Funcion que verifica en que pagina se encuentra y enmarca el item menu
             * @type redirect.href|DOMString
             */
            let url = window.location.href; 

            $("nav ul li a").each(function() {  
                if (url == (this.href)) 
                    $(this).css("outline", "5px auto -webkit-focus-ring-color");
                else
                    $(this).css("outline", "none");
                    //$(this).closest("li").addClass("active");
            });
            
            return false;
            
            /*let path = window.location.pathname;
            console.log(path);
            switch(path) {
                case '/':
                    $("#main").css("outline", "5px auto -webkit-focus-ring-color");
                    break;
                case '/account/create':    
                    $("#accountCreate").css("outline", "5px auto -webkit-focus-ring-color");
                    break;
                case '/calculate':    
                    $("#calculate").css("outline", "5px auto -webkit-focus-ring-color");
                    break;
                case '/support':    
                    $("#support").css("outline", "5px auto -webkit-focus-ring-color");
                    break;     
                default:
                    $("#default").css("outline", "5px auto -webkit-focus-ring-color");
                $("#support").on('click', function () {
                    $("#support").css("outline", "5px auto -webkit-focus-ring-color");
                }); 
            };*/
            //$("#a").css("outline": "5px auto -webkit-focus-ring-color");
            //console.log($("#navMenu").height());
            //$('#section').css( "margin-top", $("#navMenu").height() + 50);
            //$('#section').height($("#navMenu").height() + 30);
        });        
    </script>    
</html>