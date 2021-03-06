@extends('layouts.app')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')    
<div class="content">
    <h3>EDITAR</h3>
    <input type="hidden" name="idUser" id="idUser" value="{{ $user->id }}"/>
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>
    <input type="hidden" id="nameServer" value="<?=Request::server('HTTP_HOST')?>"/>
    
    <!--<div id="root"><script src="<?= asset('js/UpdateReg.js')?>"></script></div>-->
    <div class="container-form">
         <h3>Datos</h3>
         <form name="regForm" id="regForm" method="post" action="/account/store">
           <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
           <div class="row">
             <div class="col-25">
                 <label>Nombre <font color="red">*</font></label>
             </div>
             <div class="col-50">
               <input type="text" id="idName" name="name" placeholder="Nombre y apellido" value="{{$user->name}}"/>
               <div id="errorName" class="error"></div>
             </div>
           </div>
           <div class="row">
             <div class="col-25">
               <label>Correo electrónico <font color="red">*</font></label>
             </div>
             <div class="col-50">
               <input type="text" id="idEmail" ref="email" name="email" placeholder="jose.perez@gmail.com" value="{{$user->email}}"/>
               <div id="errorEmail" class="error"></div>
             </div>
           </div>        
           <div class="row">
             <div class="col-25">
               <label>Cedula/ID</label>
             </div>
             <div class="col-50">
               <input type="text" ref="identification" name="identification" placeholder="Cédula/RIF" value="{{$user->identification}}"/>
             </div>
           </div>
           <div class="row">
             <div class="col-25">
               <label>Teléfono celular</label>
             </div>
             <div class="col-50">
               <input type="text" id = "idPhone" ref="phone" name="phone" placeholder="04146320250" value="{{$user->phone}}"/>
               <span id='errorPhone'></span>
             </div>
           </div>
           <div class="row">
             <div class="col-25">
               <label>Contraseña <font color="red">*</font></label>
             </div>
             <div class="col-50">
               <input type="password" id = "idPass" ref="password" name="password" value="{{$user->password}}"/>
               <div id="errorPass" class="error"></div>
             </div>
           </div>
           <div class="row" style="margin-left:25%">
             <input type="checkbox" id = "idShowPass"/><label>&nbsp;Mostrar contraseña</label>          
           </div>        
           <hr/>
           <h3>Dirección para la entrega en Venezuela</h3>
           <div class="row">
             <div class="col-25">
               <label>Estado</label>
             </div>
             <div class="col-50">
               <input type="text" name="state" placeholder="Estado de entrega" value="{{$user->state}}"/>
             </div>
           </div>                        
           <div class="row">
             <div class="col-25">
               <label>Ciudad</label>
             </div>
             <div class="col-50">
               <input type="text" id="lCity" name="city" ref="city" placeholder="Ciudad de entrega" value="{{$user->city}}"/>
             </div>
           </div>        
           <div class="row">
             <div class="col-25">
               <label>Dirección detallada</label>
             </div>
             <div class="col-50">
               <textarea id="lDeliverAddress" name="address" ref="address" placeholder="Dirección exacta de entrega">{{$user->address}}</textarea>            
             </div>
           </div>        
           <div class="row">
               <div class="col-25"></div>
               <div class="col-50">
                   <input type="submit" id="save" class="btn btn-primary" value="Guardar"/>
               </div>
           </div>        
         </form>        
    </div>        
</div>

<script>
    $( document ).ready(function() {
        //Mostrar data del cliente
        let id = $('#idUser').val();
        
        //Mostrar Contraseña
        $("#idShowPass").on('change', function () {
            let type = $('#idPass').attr('type');

            if (type === "password")
                $('#idPass').attr('type', 'text');
            else
                $('#idPass').attr('type', 'password');            
        });         

        $("#idName").on('change', function () {
            let name = $('#idName').val();
            $('#idName').val($('#idName').val().toUpperCase());
            registryDisabled();
        });        

        $("#idEmail").on('change', function () {
            let email = $("#idEmail").val();
            let nameServer = $("#server").val();
            
            if (!email.match(/\S+@\S+\.\S+/g)) {
                $('#idEmail').css( "background-color", "yellow" );
                $('#errorEmail').html('El correo es inválido');                
                return false;
            }else {
                $('#idEmail').css( "background-color", "white" );
                $('#errorEmail').html('');                                
            }

            $.get('http://'+nameServer+'/api/account/exist/'+email, function(data, status){
                if (data!=='0'){
                    $('#idEmail').css( "background-color", "yellow" );
                    $('#errorEmail').html('Ya existe una cuenta que utiliza este correo electrónico');
                }else{
                    $('#idEmail').css( "background-color", "white" );
                    $('#errorEmail').html('');                                                    
                }
            });            

            registryDisabled();
        });        

        $("#idPass").on('change', function () {
            registryDisabled();
        });        
        
        $("#regForm").submit(function () {
            var verify = registryDisabled();
            if (!verify)
                alert('Favor llene correctamente los datos solicitados');

            return verify;
        });        
        
        //Habilitar boton de guardar
        var registryDisabled = function() {
            if (($('#idName').val()) && $('#idEmail').val() && $('#idPass').val() && $('#errorEmail').html()===''){
                //$('#save').prop('disabled', false);                
                return true;
            }else{
                //$('#save').prop('disabled', true);
                return false;
            }
                
            
            return false;
        };                
    });
</script>
@endsection