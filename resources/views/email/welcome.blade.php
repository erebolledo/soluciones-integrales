
@extends('layouts.email')
@section('content')
    <tr>
        <td colspan="2">
            <br>
            <h4  style="color: #01274b">
                Hola <strong>{{$user->name}}</strong>, bienvenido a <strong>SOLUCIONES INTEGRALES ENVIOS</strong>.
            </h4>                                
            <br>
            <p>
                Los datos para entrar a tu cuenta son:                        
            </p>            
            <p class="data-box">
                <strong>Correo: </strong><?=$user->email?>
                <br>
                <strong>Contraseña: </strong><?=$user->password?>
            </p>              
            <br>
            <p>
                <p>Para realizar tu envio a nuestros almacenes en Miami debes colocar la siguiente dirección:</p>
                <p class="data-box">
                    <strong>Name:</strong> <?=$user->code?><br>
                    <strong>Addres line 1:</strong> 9802 NW 80th Avenue. Bay G-47<br>
                    <strong>Addres line 2:</strong> <?=$user->name?><br>
                    <strong>City:</strong> HIALEAH GARDENS<br>
                    <strong>State:</strong> Fl<br>
                    <strong>Zip Code:</strong> 33016<br>
                    <strong>Country:</strong> United States<br>
                    <strong>Phone Number:</strong> 786-3586303<br>
                </p>                    
            </p>                                
            <br>
            <p style="text-align: center">
                Guarda este correo y accede directamente a tu cuenta haciendo click en este botón:
            </p>
            <p style="text-align: center">
                <a href="http://{{request()->getHttpHost()}}/account/token-login/{{$user->token}}">
                    <button class="btn-primary">ENTRAR A TU CUENTA</button>
                </a> 
            </p>                                
        </td>
    </tr>
@endsection        
 