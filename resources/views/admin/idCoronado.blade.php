@extends('layouts.admin')
@section('content')
<div>
    <h3>IDs de Coronado para relacionar en la BD</h3>
    <form name="regForm" id="regForm" method="post" action="/admin/store-id-coronado">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="comment">IDs de Coronado:</label>
                <textarea class="form-control" rows="5" id="ids" name="ids"></textarea>
            </div>
            <div class="col-sm-6">
                <label for="comment">IDs disponibles: <?=count($ids)?></label>
                <div style="height: 114px;overflow: scroll;">
                    <ul>
                    <?php 
                    $i = 0;                
                    foreach ($ids as $id):                        
                        echo '<li>'.$id->id_coronado.'</li>'; 
                    endforeach;
                    ?>
                    </ul>
                </div>    
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-success">Insertar</button>
            </div>            
        </div>
    </form>
</div>    
@endsection

