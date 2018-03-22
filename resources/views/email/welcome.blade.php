<!DOCTYPE html>
    <head>
        <title>Soluciones Integrales</title>
        <link rel="icon" href="<?php echo asset('images/integralIcono.png')?>" sizes="192x192" />
        <noscript>Es necesario Javascrit para ejecutar esta aplicación.</noscript>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo asset('css/email.css')?>" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    
    <body>
        <div class="email-content">
            <input id="token" name="token" type="hidden" value="{{$user->token}}"/>
            <div class="email-row">
                <div class="header-left">
                    <a href="http://{{request()->getHttpHost()}}">
                        <img src="<?php echo asset('images/cropped-integral-logo-envios.png')?>" width="250px">
                    </a><br>
                    RIF J-404421556<br>
                </div>
                <div class="header-right">
                    <div id="qr"></div>
                    <p>
                        <br>
                        9802 NW 80th Avenue<br>
                        BAY-G47<br>
                        Hialeah, Florida 33016-2342 USA<br>
                        numero de recibo<br>
                        fecha<br>
                    </p>
                </div>
            </div>
            <div>
                <h1 style="color: #01274b">Encabezado</h1>
                <p>Esta es una prueba de envio de correo para <strong>{{$user->name}}</strong> </p>
                <?php print_r($user)?>
                <p>
                    Puede acceder de manera directa a su cuenta haciendo click en el siguiente enlace: 
                    <a href="http://{{request()->getHttpHost()}}/account/token-login/{{$user->token}}">
                        http://{{request()->getHttpHost()}}/account/token-login/{{$user->token}}
                    </a> 
                </p>
                            <div>
                <p>
                    cuadro centrado
                    datos del cliente                    
                </p>
            </div>

            <div>
                cuadro centrado
                informacion del paquete

                largo ancho alto piezas lb peso volumetrico valor-declarado desccripcion del contenido costo-envio 
            </div>

            </div>
        </div>    
    </body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="<?php echo asset('js/kjua.js')?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            let token = $('#token').val();

            var el = kjua({
                    text: token, 
                    round: 0,
                    size: 100
            });

            document.getElementById('qr').appendChild(el);         
        })
        var e1 = kjua({text: 'hello'});
    </script>
</html>    