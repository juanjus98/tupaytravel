<div id="sticky-sidebar">
<form class="form-vertical" name="buscador" id="buscador" action="tours/" method="post">
 <fieldset class="form-home">
 <h3>¿En qué fechas viajas?</h3>
  <div class="form-group">
    <label>Desde</label>
    <div class="input-group date">
      <input type="text" class="form-control" name="fecha_inicio" id="date_from" value="<?php echo $desde = (!empty($fechaDesde)) ? date("d-m-Y", strtotime($fechaDesde)) : '' ;?>" >
      <span class="input-group-addon">
        <a href="#" id="fecha_inicio_show">
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </a>
      </span>
    </div>
  </div>

  <div class="form-group">
    <label>Hasta</label>
    <div class="input-group date">
      <input type="text" class="form-control" name="fecha_fin" id="date_to" value="<?php echo $hasta = (!empty($fechaHasta)) ? date("d-m-Y", strtotime($fechaHasta)) : '' ;?>">
      <span class="input-group-addon">
        <a href="#" id="fecha_fin_show">
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </a>
      </span>
    </div>
  </div>
  <div class="row"> 
    <div class="col-md-12">
      <button id="buscar" class="btn btn-primary-1 btn-block" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Filtrar</button>
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