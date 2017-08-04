<?php
session_start();
include("conectar.php");
include("includes/i_funciones.php");
require_once __DIR__ . '/libs/function.video.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

/**
 * Setear request
 */
$params = $_GET['params'];
$_hasta = explode('hasta_', $params);
if(count($_hasta) > 1){
  $_desde = explode('desde_',$_hasta[0]);
  $strDesde =  substr($_desde[1], 4,4) . "-". substr($_desde[1], 2,2) . "-" . substr($_desde[1], 0,2);
  $strHasta =  substr($_hasta[1], 4,4) . "-". substr($_hasta[1], 2,2) . "-" . substr($_hasta[1], 0,2);
  $fechaDesde = date('Y-m-d', strtotime($strDesde));
  $fechaHasta = date('Y-m-d', strtotime($strHasta));
  $dateDiff = strtotime($strHasta) - strtotime($strDesde);
  $nroDias = floor($dateDiff / (60 * 60 * 24));
}

$_dias = explode('dias', $params);
if(count($_dias) > 1){
  $nroDias = $_dias[0];
}

/**
 * Consultar paquetes
 */
$addWhere = 'Where cantidad > 0';
if($nroDias > 0){
  $addWhere .= ' And cantidad = ' . $nroDias;
}

$sql_query = "SELECT * FROM tblpaquete ".$addWhere." ORDER BY cantidad ASC";
$result = mysql_query($sql_query,$link);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php include('includes/i_head.php');?>
</head>
<body>
  <div class="container">
   <div class="main brd-lr">
    <?php include('includes/i_header.php');?>
<section class="main-container">
  <div class="row">
    <div class="col-md-3">
      <?php include('includes/i_side.php');?>
    </div>

    <div class="col-md-9">
      <div class="cont-thumbnails">
<?php
if(mysql_num_rows($result) > 0) {
?>        
<div class="row">
<?php
while ($paquete = mysql_fetch_array($result)) {
  $url_paquete = 'paquete-tour/' . url_amigable($paquete['nombre']) . '-' . $paquete['id'];
/**
 * Consultar Galería
 */
//Consultar galería
$urlImagen = 'images/no-image.jpg';
$sql_gal="SELECT * FROM tblpaquete_galeria where id_tblpaquete='".$paquete['id']."' Order By principal ASC, id Asc";
$query_gal=mysql_query($sql_gal,$link);
if(mysql_num_rows($query_gal) > 0){
  $fs_gal = mysql_fetch_array($query_gal);
  $urlImagen = 'images/uploads/' . $fs_gal['nombre_imagen'];
}
?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <a href="<?php echo $url_paquete;?>" class="titulo-imagen" title="<?php echo trim($paquete['nombre']);?>">
        <img src="<?php echo $urlImagen;?>" class="img-responsive" alt="<?php echo trim($paquete['nombre']);?>">
        <h3><?php echo trim($paquete['nombre']);?></h3>
      </a>
      <div class="cont-btns">
        <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
        <a href="javascript:;" class="btn btn-precio" role="button"><?php echo $paquete['precio'];?></a>
        <a href="<?php echo $url_paquete;?>" class="btn btn-detalles" title="<?php echo trim($paquete['nombre']);?>">
          <i class="fa fa-info" aria-hidden="true"></i> Detalles
        </a>
        </div>
      </div>
    </div>
  </div>
<?php 
}
?>
</div>
<?php
}
?>

      </div>
    </div>

  </div>

</section>

<!-- Footer-->
<footer>
<?php include('includes/i_footer.php');?>
</footer>
<!-- //Footer-->
</div><!-- //main-->
</div> <!-- //container-->

<!-- Multichat-->
<?php include('includes/i_multichat.php');?>

<?php include('includes/i_scripts.php');?>
</body>
</html>