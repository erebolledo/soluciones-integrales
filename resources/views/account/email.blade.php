<div>
    <div class="">
        <a href="/"><img src="<?php echo asset('images/cropped-integral-logo-envios.png')?>" width="250px"></a>
    </div>

    <div style="background-color: #f8f8f8">
        <h1 style="color: #01274b">Encabezado</h1>
        <p>Esta es una prueba de envio de correo para <strong>{{$user->name}}</strong> </p>
        <?php print_r($user)?>
        <p>
            Puede acceder de manera directa a su cuenta haciendo click en el siguiente enlace: 
            <a href="http://{{request()->getHttpHost()}}/account/token-login/{{$user->token}}">
                http://{{request()->getHttpHost()}}/account/token-login/{{$user->token}}
            </a> 
        </p>
    </div>
</div>    