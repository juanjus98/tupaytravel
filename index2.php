<?php
session_start();
include("conectar.php");
include("funciones.php");
require_once __DIR__ . '/libs/function.video.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
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
        <div class="col-md-4 col-sm-6">
          <?php include('includes/i_form.php');?>
        </div>

        <div class="col-md-8 col-sm-6">
          <?php include('includes/i_promociones.php');?>
        </div>

      </div>

      <!--Nos recomiendan-->
      <div class="row">
        <div class="col-md-12">
        <?php include('includes/i_videos_slider.php');?>
        </div>
      </div>

      <!-- Paquetes, Tours y estadía-->
      <div class="row">
        <div class="col-md-4">
          <?php include('includes/i_paquetes.php');?>
        </div>
        <div class="col-md-4">
          <?php include('includes/i_tours.php');?>
        </div>
        <div class="col-md-4">
          <?php include('includes/i_estadia.php');?>
        </div>
      </div>

      <!-- Bloques rápidos-->
      <?php include('includes/i_boxes.php');?>

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