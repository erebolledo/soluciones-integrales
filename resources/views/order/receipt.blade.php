<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">        

<div class="container">
    <form action="/order-receipt" method="post" onsubmit="return verification();" class="form-horizontal">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
        <div class="form-group">
            <label class="col-sm-3">Id de orden:</label>
            <div class="col-sm-9">
                <input class="form-control" id="n_order" name="id_order" value="{{$id}}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3">Peso:</label>
            <div class="col-sm-9">
                <input class="form-control" id="weight" name="weight">
            </div>
        </div>        
        <div class="form-group">
            <label class="col-sm-3">Peso volumétrico:</label>
            <div class="col-sm-9">
                <input class="form-control" id="volumetric-weight" name="volumetric-weight">
            </div>
        </div>                
        <div class="form-group">
            <label class="col-sm-3">Total piezas:</label>
            <div class="col-sm-9">
                <input class="form-control" id="pieces" name="pieces">
            </div>
        </div>                
        <div class="form-group">
            <label class="col-sm-3">Descripción del contenido:</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">Largo: </label>
            <div class="col-sm-2">
                <input class="form-control" id="long" name="long">
            </div>
            <label class="col-sm-2">Ancho: </label>
            <div class="col-sm-2">
                <input class="form-control" id="width" name="width">
            </div>            
            <label class="col-sm-2">Alto: </label>
            <div class="col-sm-2">
                <input class="form-control" id="high" name="high">
            </div>                        
        </div>                        
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success btn-block btn-lg" type="submit">Guardar</button>
            </div>            
        </div>
    </form>
</div>    