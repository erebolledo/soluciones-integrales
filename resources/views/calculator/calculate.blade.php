@extends('layouts.app')
@section('content')
    <div class="content">
        <h3>CALCULAR COSTOS</h3>
        <div class="container-form">
            <div class="row">
                <h3 style="width: 220;float: left;">Datos del paquete</h3>
                <h5 style="margin-top: 30px;">(Se&nbsp;deben&nbsp;llenar&nbsp;todos&nbsp;los&nbsp;campos)</h5>
            </div>
            <form name="form" id="regForm" method="post" action="/account/store">
                <input type="hidden" name="dollarValue" id="dollarValue" value="{{$dollar->value}}"/>
                <div class="row">
                    <div class="col-25">
                        <label>Medidas en</label>
                    </div>
                    <div class="col-50">
                        <div style="width: 100%; float: left ">
                            <select class="form-control" style="height:46px" id="measure">
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
                        <input type="text" id="long" name="long"/> <!--placeholder="Ejemplo: 2.5"/>-->
                        <div id="errorLong" class="error"></div>
                    </div>
                </div>                    
                <div class="row">
                    <div class="col-25">
                        <label>Ancho</label>
                    </div>
                    <div class="col-50">
                        <input type="text" id="wide" name="wide"/> <!--placeholder="Ejemplo: 2.5"/>-->
                        <div id="errorWide" class="error"></div>
                    </div>
                </div>                    
                <div class="row">
                    <div class="col-25">
                        <label>Alto</label>
                    </div>
                    <div class="col-50">
                        <input type="text" id="high" name="high"/> <!--placeholder="Ejemplo: 2.5"/>-->
                        <div id="errorHigh" class="error"></div>
                    </div>
                </div>                        
                <div class="row">
                    <div class="col-25">
                        <label>Peso</label>
                    </div>
                    <div class="col-50">
                        <div class="input-select">
                            <input type="text" id="weight" name="weight"/> <!--placeholder="Ejemplo: 2.5"/>-->
                            <div id="errorWeight" class="error"></div>                        
                        </div>    
                        <div class="select-input">
                            <select class="form-control" id="weightUnit" style="height:46px">
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
                        <div class="input-select">
                            <input type="text" id="price" name="price" class="number" readonly>                          
                            <div id="errorPrice" class="error" style="position: relative; float: none"></div>
                            <div id="errorBs" class="error" style="position: relative; float: none"></div>
                        </div>
                        <div class="select-input">
                            <select class="form-control" id="moneyUnit" style="height:46px">
                                <!--<option>BsF</option>-->
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
    </div>    
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>-->
    <script>
        $( document ).ready(function() {
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

            $("#moneyUnit").on('change', function () {
                if ($('#button').prop('disabled')===false)
                    calculate();
            }); 
        });
        //console.log($('#divPrice').prop('style.width', 200));

        var calculateDisabled = function () {
            if (($('#long').val()) && $('#wide').val() && $('#high').val() && $('#weight').val())
                $('#button').prop('disabled', false);
            else
                $('#button').prop('disabled', true);
        }
        
        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? ',' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
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
                priceForPound = priceForPound*$('#dollarValue').val();                
                $('#errorBs').html('* Costo aproximado en BsF.');
            }else{
                $('#errorBs').html('');
            }            
            
            if (volPounds > pounds){
                $('#errorPrice').html('* Por peso volumétrico.');
                $('#price').val(addCommas((volPounds*priceForPound).toFixed(2)));
            }else{
                $('#errorPrice').html('');
                $('#price').val(addCommas((volPounds*priceForPound).toFixed(2)));
            }
                
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

