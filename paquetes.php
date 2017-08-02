<?php
session_start();
include("conectar.php");
include("funciones.php");
require_once __DIR__ . '/libs/function.video.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

/**
 * Consultar paquetes
 */
$sql_query = "SELECT * FROM tblpaquete ORDER BY cantidad ASC";
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
  /*echo "<pre>";
  print_r($paquete);
  echo "</pre>";*/
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
      <a href="#" class="titulo-imagen">
        <img src="<?php echo $urlImagen;?>" class="img-responsive" alt="<?php echo trim($paquete['nombre']);?>">
        <h3><?php echo trim($paquete['nombre']);?></h3>
      </a>
      <div class="cont-btns">
        <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
        <a href="javascript:;" class="btn btn-precio" role="button"><?php echo $paquete['precio'];?></a>
        <a href="#" class="btn btn-detalles" role="button">
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