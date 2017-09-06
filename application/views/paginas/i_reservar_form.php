<form class="form-vertical" name="form-reservar" id="form-reservar" action="" method="post" data-toggle="validator">
<fieldset class="form-reservar">
<h3>Reservarlo ahora.</h3>
<div class="form-group has-feedback">
  <label for="pais_origen" class="control-label">Pais de origen:</label>
  <select class="form-control select_search" name="pais_origen" id="pais_origen" required>
    <option value="">Seleccionar</option>
    <?php
    if(!empty($paises)){
      foreach ($paises as $key => $pais) {
        echo '<option value="'.$pais->name.'">'.$pais->name.'</option>';
      }
    }
    ?>
  </select>
</div>

<div class="form-group has-feedback">
  <label for="ciudad" class="control-label">Ciudad de origen:</label>
  <input type="text" name="ciudad" id="ciudad" class="form-control" value="" required>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
</div>

<?php
if(empty($busqueda_info)){
?>
<div class="form-group has-feedback">
  <label for="fecha_arribo" class="control-label">Fecha de arribo (desde Lima):</label>
  <div class="input-group date">
    <input type="text" class="form-control select-fecha" name="fecha_arribo" id="fecha_arribo" value="<?php echo $desde = (!empty($fechaDesde)) ? date("d-m-Y", strtotime($fechaDesde)) : '' ;?>" required>
    <span class="input-group-addon">
      <a href="javascript:;" class="show_calendar">
        <i class="fa fa-calendar" aria-hidden="true"></i>
      </a>
    </span>
  </div>
</div>
<?php } ?>
<div class="row">
  <div class="col-xs-6 col-md-3">
    <label class="text-center btn-block">Adultos</label>
    <select name="adultos" id="adultos" class="form-control" placeholder="+18 años">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <p class="help-block text-center">+18 años.</p>
  </div>

  <div class="col-xs-6 col-md-3">
    <label class="text-center btn-block">Adolecentes</label>
    <select name="adolecentes" id="adolecentes" class="form-control" placeholder="12-17">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <p class="help-block text-center">12-17</p>
  </div>

  <div class="col-xs-6 col-md-3">
    <label class="text-center btn-block">Ñiños</label>
    <select name="ninios" id="ninios" class="form-control" placeholder="8-11">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <p class="help-block text-center">8-11</p>
  </div>

  <div class="col-xs-6 col-md-3">
    <label class="text-center btn-block">Infantes</label>
    <select name="infantes" id="infantes" class="form-control" placeholder="3-7">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <p class="help-block text-center">3-7</p>
  </div>
</div>

<div class="row"> 
  <div class="col-md-12">
    <button class="btn btn-primary-1 btn-block" type="submit">
      <i class="fa fa-hand-o-right" aria-hidden="true"></i> Reservar ahora.
    </button>
  </div>
</div>
</fieldset>

</form>