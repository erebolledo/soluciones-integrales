@extends('layouts.app')

@section('content')
<?php 
    $name = $user->name;//explode(' ', $user->name);
    //$name = $name[0];
?>
    <div class="content">
        @include('order.indexBar')
        <div style="border: 1px solid #e7e7e7;padding: 20 10 0;border-top: 0;background-color: #f8f8f8;">            
            <h4 style="font-weight: 700;color: #01274b;margin:20 20">Reportar un paquete nuevo</h4>
            <div id="error"></div>
            <form action="/order/store" method="post" onsubmit="return verification();" class="content-account">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
                <div class="row">
                    <label class="col-25">Número de orden:</label>
                    <div class="col-50">
                        <input class="form-control" id="n_order" placeholder="Número de orden asignado por Amazon, Ebay, etc" name="n_order">
                    </div>
                </div>
                <div class="row">
                    <label class="col-25">Número de tracking:</label>
                    <div class="col-50">          
                        <input class="form-control" id="n_tracking" placeholder="Introduzca el número de tracking" name="n_tracking">
                    </div>
                </div>
                <div class="row">
                    <label class="col-25">Tienda/Origen:</label>
                    <div class="col-50">          
                        <select class="form-control" name="store">
                            <option>Amazon</option>
                            <option>Ebay</option>
                            <option>Walmart</option>
                            <option>Locatel</option>
                            <option>Otro</option>
                        </select>
                    </div>
                </div>    
                <div class="row">
                    <label class="col-25">Fecha de compra:</label>
                    <div class="col-50">          
                        <input autocomplete="off" class="datepicker form-control" placeholder="Fecha de la compra" name="buyed"/>
                    </div>
                </div>        
                <div class="row">
                    <label class="col-25">Observaciones:</label>
                    <div class="col-50">          
                        <textarea class="form-control" id="observations" name="observations" rows="3"></textarea>        
                    </div>
                </div>            
                <div class="row">
                    <div class="col-25"></div>        
                    <div class="col-50">
                        <input type="submit" id="buttonSave" class="btn btn-primary" value="Guardar"/>
                    </div>
                </div>  
            </form>    
        </div>    
    <script>
        $( document ).ready(function() {
            $('#new').html('<p style="color: orange; margin:0;">Reportar un paquete nuevo</p>');
            
            //verificar campos orden y tracking, ambos no pueden estar vacios
            $("#buttonSave").click(function () {        
                if ((!$('#n_order').val())&&(!$('#n_tracking').val()))
                {
                    let error = '<div class="alert alert-danger"><strong>Error</strong> Debe colocar el número de orden o al menos el número de tracking.</div>';
                    $('#error').html(error);
                    
                    return false;                    
                }
            });
        });
    </script>    
    <script  src="<?php echo asset('js/datePicker.js')?>"></script>  
    <link rel='stylesheet prefetch' href='http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'>    
@endsection
