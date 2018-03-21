@extends('layouts.app')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class="content">
    <h3>ENTRAR</h3>
    <div class="container-form" id="effect">
        <form class="form-signin" method="post" action="/account/init-session" id="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-25"><label>Usuario/Email</label></div>
                <div class="col-75">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                    <div id="errorEmail" class="error"></div>
                </div>                
            </div>          
            <div class="row">
                <div class="col-25"><label>Contraseña</label></div>
                <div class="col-75">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    <div id="errorPass" class="error"></div>
                </div>                
            </div>          
            <!--<div class="row" style="text-align: center; margin-top: 10px;">
                <input type="checkbox" value="remember" id="remember" name="remember"> Recordarme
            </div>-->
            <div class="row" style="text-align: center;">
                <a href="<?php echo url('account/create')?>">Crear una cuenta</a><br><a href="<?php echo url('account/forgot') ?>">¿Olvidaste tu contraseña?</a>
            </div>          
            <button class="btn btn-lg btn-primary" style="width: 100%; float: none;" type="button" onclick="auth()">Entrar</button>
      </form>    
    </div>
</div>    
    <script>
        $( document ).ready(function() {
            $('#email').on('keyup', function () {
                $('#email').css( "background-color", "white" );
                $('#errorEmail').html('');
            });             
            
            $('#password').on('keyup', function () {
                $('#password').css( "background-color", "white" );
                $('#errorPass').html('');
            });                         
        });            
    </script>    
@endsection

<script>    
    function auth(){
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        /*let remember = "";
        
        if (document.getElementById('remember').checked)
            remember = "remember";
        else
            remember = "no remember";*/

        axios.post('/api/account/auth', {"email":email, "password":password})
        .then(function (response) {
            console.log(response);
            if (response.data === "no email"){
                document.getElementById('errorEmail').innerHTML = 'Este correo no esta registrado en el sistema';                
                document.getElementById('email').style.backgroundColor = "yellow"; 
                $( '#effect' ).effect('shake', {direction: 'left', times: 4, distance: 5,}, 10);
                return false;
            }
            if (response.data === "no auth"){
                document.getElementById('errorEmail').innerHTML = '';                
                document.getElementById('email').style.backgroundColor = "white";                 
                document.getElementById('errorPass').innerHTML = 'La contraseña es incorrecta';                
                document.getElementById('password').style.backgroundColor = "yellow"; 
                $( '#effect' ).effect('shake', {direction: 'left', times: 4, distance: 5,}, 10);                
                return false;
            }
            if (response.data === "auth"){
                $('#form').submit();
                return true;
            }                
        })
        .catch(function (error) {
            alert('Revise su conexión a Internet');
            console.log(error);
        });
    }
</script>
    