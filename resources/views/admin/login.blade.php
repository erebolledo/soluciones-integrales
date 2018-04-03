<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Soluciones Integrales Envios</title>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="icon" href="<?php echo asset('images/integralIcono.png')?>" sizes="192x192" />
    </head>
    <body>
        <header></header>
        @if(Session::has('error'))            
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('error') }}.
            </div>        
        @endif        
        <div class="container" style="width: 300px">
            <form class="form-signin" action="/admin/init-session" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h2 class="form-signin-heading" style="text-align: center">Entrar</h2>
                <label class="sr-only">Usuario</label>
                <input id="login" name="login" class="form-control" placeholder="User" required="" autofocus="">
                <label class="sr-only">Password</label>
                <input id="password" name="password" class="form-control" placeholder="Password" required="" type="password">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            </form>
        </div>    
        <footer></footer>
    </body>
</html>
