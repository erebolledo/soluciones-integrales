<script  src="<?php echo asset('js/datePicker.js')?>"></script>  
<link rel='stylesheet prefetch' href='http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css'>


<form action="/order-save" method="post" onsubmit="return verification();" class="content-account">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
    <div class="row">
      <label class="col-25">Número de orden:</label>
      <div class="col-50">
        <input class="form-control" id="n_order" placeholder="Introduca el número de orden" name="n_order" required>
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
          <input type="submit" class="btn btn-primary" value="Guardar"/>
      </div>
    </div>  
  </form>