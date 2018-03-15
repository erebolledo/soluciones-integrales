@extends('layouts.app')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')    
<div class="content">
    <h3>REGISTRO</h3>
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"/>
    <script>        
        function showMessage(hea, mes, foo){
            var message = '<div class="modal-header" style="background-color: #6fb17b;"><button type="button" class="close" data-dismiss="modal">&times;</button><img height="70" width="70" style="margin-left:95px" src='+hea+'></div>';
            message+='<div class="modal-body"><p  style="text-align: center;">'+mes+'</p></div>';
            message+='<div class="modal-footer" style="text-align:center;"><button type="button" class="btn btn-success" data-dismiss="modal">'+foo+'</button></div>';

            return message;
        }
        
        function printModal(token){
            /*console.log(this);
            $('#messageContent').html(showMessage('<?php echo asset('images/success_border.png')?>', "Los datos fueron guardados con éxito", "Aceptar"));
            $('#messageModal').modal('show');*/
            window.open('/account/init-session/'+token, '_self');    
        }
        
        $("#messageModal").on('hide.bs.modal', function () {
            window.open('/account/init-session', '_self');
        });
    </script>
    <input type="hidden" id="server" value="<?=Request::server('HTTP_HOST')?>"/>
    <div id="root"><script src="<?= asset('js/RegForm.js')?>"></script></div>    
</div>
@endsection