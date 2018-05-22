@extends('layouts.app')

@section('content')
    <div class="content">
        @include('order.indexBar')
        <div style="border: 1px solid #e7e7e7;padding: 20 10 0;border-top: 0;background-color: #f8f8f8;">
            <h4 style="font-weight: 700;color: #01274b;margin:20 20">Rastrear paquete</h4>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <label>Número de tracking/recibo:</label>
                </div>
                <div class="col-sm-12 col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar" name="search" id="inputSearch">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="button" id="buttonSearch">
                                <i class="glyphicon glyphicon-search" style="line-height: inherit"></i>
                            </button>
                        </div>                        
                    </div>
                    <div id="errorInputSearch" class="error"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12"><div id="answer" style="text-align: center"></div></div>                
            </div>            
        </div>        
    </div>
    <script>
        $(document).ready(function()
        {
            $('#buttonSearch').click(function ()
            {
                if (!$('#inputSearch').val())
                {
                    $('#inputSearch').css( "background-color", "yellow" );
                    $('#errorInputSearch').html('El campo de búsqueda no puede estar vacio');                         
                    
                    return false;
                }
                else
                {
                    $('#inputSearch').css( "background-color", "white" );
                    $('#errorInputSearch').html('');                                             
                }
                
                $('#answer').html('<div class="loader"></div>');
                let hostname = location.hostname;
                let url =  'http://'+hostname+'/api/order/get-tracking/'+$('#inputSearch').val();

                $.get(url, function(data, status)            
                {                
                    if (status==='success')
                    {
                        $('#answer').html(data);                    
                    }
                    else
                    {
                        console.log('error');
                    }
                });                        
            });
            
            $('#tracking').html('<p style="color: orange; margin:0;">Rastrear paquete</p>');
        });    
    </script>
@endsection
