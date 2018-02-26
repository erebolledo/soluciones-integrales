<h3>
    HOLA, <a href="<?php echo url('account/edit')?>" title="Editar datos del usuario">{{$name}}</a>
    <a href="<?php echo url('account/edit')?>" title="Editar datos del usuario"><img src="<?php echo asset('images/20344-200.png') ?>" width="40px" height="40px" style="margin-left: 5px;"></a>
</h3>
<?php if ('0'==='1'):?>        
<div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>El paquete fue guardado con éxito.</strong>
</div>
<?php endif;?>
<div class="wrapper">
    <ul>
        <li id='new'><a href="<?php echo url('order/create') ?>">Reportar un paquete nuevo</a></li>
        <li id="pending"><a href="{{url('order/index/pending')}}">Paquetes pendientes</a></li>
        <li id="closed"><a href="{{url('order/index/closed')}}">Paquetes entregados</a></li>
    </ul>  
</div>            
