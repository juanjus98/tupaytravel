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
        <div class="col-md-12">
        <?php include('includes/i_fotos_slider.php');?>
        </div>
      </div>

    </section>

    <!-- Footer-->
    <footer>
      <section class="nb-footer">
        <div class="row">

          <div class="col-md-4 col-sm-6">
            <div class="footer-single">
              <div class="footer-title"><h2>Información de Contácto</h2></div>
              <address>
                <strong>Oficina:</strong> Dirección de la oficina #344<br>
                Cusco, Perú <br>
                <i class="fa fa-phone"></i>  +51988878850 <br>
                <i class="fa fa-fax"></i> +51984786422<br>
                <i class="fa fa-envelope"></i> reservas@tupaytravel.com<br>
              </address>          
            </div>
          </div>

          <div class="col-md-4 col-sm-6">
            <div class="footer-single useful-links">
             <div class="footer-title"><h2>Tours Destacados</h2></div>
             <ul class="list-unstyled">
              <li><a href="#">Home <i class="fa fa-angle-right pull-right"></i></a></li>
              <li><a href="#">About Us <i class="fa fa-angle-right pull-right"></i></a></li>
              <li><a href="#">Services <i class="fa fa-angle-right pull-right"></i></a></li>
              <li><a href="#">Portfolio <i class="fa fa-angle-right pull-right"></i></a></li>
              <li><a href="#">Pricing <i class="fa fa-angle-right pull-right"></i></a></li>
              <li><a href="#">Contact Us <i class="fa fa-angle-right pull-right"></i></a></li>
            </ul>
          </div>
        </div>


        <div class="col-md-4 col-sm-6">
          <div class="footer-single useful-links">
           <div class="footer-title"><h2>Estadia</h2></div>
           <ul class="list-unstyled">
            <li><a href="#">Home <i class="fa fa-angle-right pull-right"></i></a></li>
            <li><a href="#">About Us <i class="fa fa-angle-right pull-right"></i></a></li>
            <li><a href="#">Services <i class="fa fa-angle-right pull-right"></i></a></li>
            <li><a href="#">Portfolio <i class="fa fa-angle-right pull-right"></i></a></li>
            <li><a href="#">Pricing <i class="fa fa-angle-right pull-right"></i></a></li>
            <li><a href="#">Contact Us <i class="fa fa-angle-right pull-right"></i></a></li>
          </ul>
        </div>
      </div>

    </div>

  </section>  

</footer>
<!-- //Footer-->

</div><!-- //main-->
</div> <!-- //container-->
<?php include('includes/i_scripts.php');?>
</body>
</html>