<?php
$paises = getPaises();
/*echo "<pre>";
print_r($paises);
echo "</pre>";*/
?>
<div id="sticky-sidebar">
<form class="form-vertical" name="buscador" id="buscador" action="tours/" method="post">
 <fieldset class="form-reservar">
 <h3>Reservarlo ahora.</h3>
<!-- <div class="form-group">
  <label>Nombres y apellidos:</label>
  <input type="text" name="nombres" class="form-control" value="">
</div>
<div class="form-group">
  <label>Teléfono:</label>
  <input type="text" name="telefono" class="form-control" value="">
</div>
<div class="form-group">
  <label>E-mail:</label>
  <input type="email" name="email" class="form-control" value="">
</div> -->

<div class="form-group">
  <label>Pais de origen:</label>
  <select class="form-control select_search" name="pais_origen">
    <option value="">Seleccionar</option>
    <?php
    if(!empty($paises)){
      foreach ($paises as $key => $pais) {
        echo '<option value="'.$pais['name'].'">'.$pais['name'].'</option>';
      }
    }
    ?>
  </select>
  </div>
  
  <div class="form-group">
    <label>Ciudad de origen:</label>
    <input type="text" name="ciudad" class="form-control" value="">
  </div>

  <div class="form-group">
    <label>Fecha de arribo:</label>
    <div class="input-group date">
      <input type="text" class="form-control select-fecha" name="fecha_inicio" value="<?php echo $desde = (!empty($fechaDesde)) ? date("d-m-Y", strtotime($fechaDesde)) : '' ;?>" >
      <span class="input-group-addon">
        <a href="javascript:;" class="show_calendar">
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </a>
      </span>
    </div>
  </div>

<div class="row">
    <div class="col-xs-3">
      <label class="text-center btn-block">Adultos</label>
      <select name="adultos" id="adultos" class="form-control" placeholder="+18 años">
<!--         <option value="0">0</option> -->
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <p class="help-block text-center">+18 años.</p>
    </div>

    <div class="col-xs-3">
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

    <div class="col-xs-3">
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

    <div class="col-xs-3">
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
<!-- Provincias tblprovincia-->
<fieldset>
<?php
$sql_dias="SELECT COUNT(t1.id) AS numero_dias FROM tblpaquete_tour AS t1 
INNER JOIN tblpaquete AS t2 ON (t2.id = t1.id_paquete) GROUP BY t1.id_paquete";
$rs_dias=mysql_query($sql_dias, $link);
if(mysql_num_rows($rs_dias) > 0){
  $dias = array();
  while ($fs_dia = mysql_fetch_array($rs_dias)) {
    $dias[$fs_dia['numero_dias']] = $fs_dia['numero_dias'];
  }
}
?>
<div class="container-box">
<h3 class="titulo_opciones">Número de días</h3>
<div class="box-wscroll">
<?php
  if(!empty($dias)){
      foreach ($dias as $key => $dia) {
        $urlPaquetes = 'paquetes-tours/'.$dia.'dias';
    ?>
      <a href="<?php echo $urlPaquetes;?>" class="btn btn-block btn-default"><?php echo ($dia == 1) ? 'Tour de ' . $dia . ' Día' : 'Tours de ' . $dia . ' Días' ;?></a>
    <?php
      }
 }
?>
</div>
</div>
</fieldset>
</form>
</div>