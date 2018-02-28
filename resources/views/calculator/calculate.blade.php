@extends('layouts.app')
@section('content')
    <h3>Calcular costos</h3>
    <div class="container-form">
        <div class="row">
            <h3 style="width: 220;float: left;">Datos del paquete</h3><h5 style="margin-top: 30px;">(Se  deben llenar todos los campos)</h5>
        </div>
        <form name="form" id="regForm" method="post" action="/account/store">
            <div class="row">
                <div class="col-25">
                    <label>Medidas en</label>
                </div>
                <div class="col-50">
                    <div style="width: 120px; float: left ">
                        <select class="form-control" id="measure">
                            <option>pulgadas</option>
                            <option>cm</option>                            
                        </select>
                    </div>                    
                </div>
            </div>    
            <div class="row">
                <div class="col-25">
                    <label>Largo</label>
                </div>
                <div class="col-50">
                    <input type="text" id="long" name="long" placeholder="Ejemplo: 2.5"/>
                    <div id="errorLong" class="error"></div>
                </div>
            </div>                    
            <div class="row">
                <div class="col-25">
                    <label>Ancho</label>
                </div>
                <div class="col-50">
                    <input type="text" id="wide" name="wide" placeholder="Ejemplo: 1.8"/>
                    <div id="errorWide" class="error"></div>
                </div>
            </div>                    
            <div class="row">
                <div class="col-25">
                    <label>Alto</label>
                </div>
                <div class="col-50">
                    <input type="text" id="high" name="high" placeholder="Ejemplo: 8"/>
                    <div id="errorHigh" class="error"></div>
                </div>
            </div>                        
            <div class="row">
                <div class="col-25">
                    <label>Peso</label>
                </div>
                <div class="col-50">
                    <div style="width: 80%; float: left ">
                        <input type="text" id="weight" name="weight" placeholder="Ejemplo: 5.4"/>
                        <div id="errorWeight" class="error"></div>                        
                    </div>    
                    <div style="width: 20%; float: left ">
                        <select class="form-control" id="weightUnit">
                            <option>lb</option>
                            <option>kg</option>                            
                        </select>
                    </div>                    
                </div>
            </div>                                    
            <hr/>
            <div class="row">
                <div class="col-25">
                    <label>Costo del envio</label>
                </div>
                <div class="col-50">
                    <div style="width: 80%; float: left ">
                        <input type="text" id="price" name="price" readonly/>
                        <div id="errorPrice" class="error"></div>
                    </div>
                    <div style="width: 20%; float: left ">
                        <select class="form-control" id="moneyUnit">
                            <option>BsF</option>
                            <option>$</option>
                        </select>
                    </div>                    
                </div>
            </div>
            <div class="row">
                <div class="col-25"></div>
                <div class="col-50">                    
                    <input type="button" id="button" class="btn btn-primary" title="Debes llenar todos los datos" disabled="true" value="Calcular" onclick="calculate()"/>
                    <input type="reset" id="reset" class="btn btn-default" value="Limpiar"/>                    
                </div>
        </div>        

        </form>
    </div> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script>
        $("#long").on('keyup', function () {
            $(this).val($(this).val().replace(/,/g, '.'));
            calculateDisabled();
        });
        
        $("#wide").on('keyup', function () {
            $(this).val($(this).val().replace(/,/g, '.'));
            calculateDisabled();
        });
        
        $("#high").on('keyup', function () {
            $(this).val($(this).val().replace(/,/g, '.'));
            calculateDisabled();
        });        
        
        $("#weight").on('keyup', function () {
            $(this).val($(this).val().replace(/,/g, '.'));
            calculateDisabled();
        });        

        var calculateDisabled = function () {
            if (($('#long').val()) && $('#wide').val() && $('#high').val() && $('#weight').val())
                $('#button').prop('disabled', false);
            else
                $('#button').prop('disabled', true);
        }
        
        function calculate() {
            if (!$.isNumeric($('#long').val())){
                $('#long').css( "background-color", "yellow" );
                //$('#long').focus();
                $('#errorLong').html('El campo "Largo" debe ser númerico');
                return false;
            }else{
                $('#long').css( "background-color", "white" );
                $('#errorLong').html('');
            }
            
            if (!$.isNumeric($('#wide').val())){
                $('#wide').css( "background-color", "yellow" );
                $('#errorWide').html('El campo "Ancho" debe ser númerico');
                return false;
            }else{
                $('#wide').css( "background-color", "white" );
                $('#errorWide').html('');                
            }

            if (!$.isNumeric($('#high').val())){
                $('#high').css( "background-color", "yellow" );
                $('#errorHigh').html('El campo "Alto" debe ser númerico');
                return false;
            }else{
                $('#high').css( "background-color", "white" );
                $('#errorHigh').html('');                
            }

            if (!$.isNumeric($('#weight').val())){
                $('#weight').css( "background-color", "yellow" );
                $('#errorWeight').html('El campo "Peso" debe ser númerico');
                return false;
            }else{
                $('#weight').css( "background-color", "white" );
                $('#errorWeight').html('');                
            }
            
            let factor = 166;
            let long, wide, high, pounds = 0;
            let priceForPound = 4;
            
            if ($('#measure').val()==='cm'){
                long = $('#long').val()*0.39370;
                wide = $('#wide').val()*0.39370;
                high = $('#high').val()*0.39370;
            }else{
                long = $('#long').val();
                wide = $('#wide').val();
                high = $('#high').val();                
            }
            
            if ($('#weightUnit').val()==='kg')
                pounds = Math.ceil($('#weight').val()*2.20462);
            else
                pounds = Math.ceil($('#weight').val());
            
            let volPounds = Math.ceil((Math.ceil(long)*Math.ceil(wide)*Math.ceil(high))/factor);
            
            if ($('#moneyUnit').val()==='BsF'){
                priceForPound = priceForPound*200000;
            }
            
            if (volPounds > pounds){
                $('#errorPrice').html('Peso volumétrico');
                $('#price').val(volPounds*priceForPound);
            }else{
                $('#errorPrice').html('Peso');
                $('#price').val(pounds*priceForPound);
            }
                
            console.log(pounds);
            console.log(volPounds);

        };

        /*$(document).on('change', '.unitprice', function() {
          $(this).val().replace(/,/g, '.');
        });        
        
        $('#long').val(function(index, currentValue) { return currentValue.replace(/,/g, '.'); });

        
        var options = {
            translation: {
                '0': {pattern: /\d/},
                '1': {pattern: /[1-9]/},
                '9': {pattern: /\d/, optional: true},
                '#': {pattern: /\d/, recursive: true},
                'C': {pattern: /V|v|E|e/, fallback: 'V'},
                'F': {pattern: /[\dA-Za-z]/}
            }
        };
        $('#long').mask('C-19999999', options);
        $('#wide').mask('0000-0000000', options);*/
    </script>   
@endsection

