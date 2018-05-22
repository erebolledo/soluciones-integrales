<!-- Stored in resources/views/layouts/app.blade.php -->
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Soluciones Integrales</title>
        <noscript>Es necesario Javascrit para ejecutar esta aplicación.</noscript>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>        

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">        
        <link rel="stylesheet" href="<?php echo asset('css/admin.css')?>" type="text/css">
        <link rel="icon" href="<?php echo asset('images/integralIcono.png')?>" sizes="192x192" />
    </head>
    <body>
        <div>
        <header>
            <nav class="navbar-inverse" id="navMenu">
              <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" 
                                aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="admin">Administrador</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right" style="padding-top: 0px">
                    <li><a id ="main" href="<?php echo url('admin') ?>">Listar ordenes</a></li>
                    <li><a id="support" href="<?php echo url('admin/id-coronado') ?>">Coronado Id</a></li>
                    <li><a href="<?php echo url('admin/logout') ?>"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                  </ul>
                </div><!--/.nav-collapse -->
              </div><!--/.container-fluid -->              
            </nav>
        </header>
        <section id="section">
            @if(Session::has('message'))            
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('message') }}.
                </div>        
            @endif                        
            <div class="container">
                @yield('content')
            </div>
        </section>
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
        });        
    </script>    
</html>