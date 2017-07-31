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
          <div class="container-box">
            <h3 class="titulo_opciones">
              Tour 
              <div class="clearfix visible-xs-block"></div>
              <span>
                <a href="#">Ver más</a>
              </span>
            </h3>
            <div class="box-wscroll">
<ul class="list-group container-list">
    <li class="list-group-item text-capitalize"><a href="https://www.choosebranson.com/show/shows/the-acrobats-of-china-show" target="_blank">Acrobats of China</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/amazing-pets" target="_blank">Amazing Pets</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/andy-williams-christmas-show-spectacular" target="_blank">Andy Williams Christmas Show</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/bill-engvall" target="_blank">Bill Engvall</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/billy-dean" target="_blank">Billy Dean in Concert with Jarrett</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/dailey-vincent-show" target="_blank">Dailey & Vincent</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/gene-watson" target="_blank">Gene Watson</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/jimmy-fortune" target="_blank">Jimmy Fortune</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/rhonda-vincent" target="_blank">Rhonda Vincent</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/branson-country-usa" target="_blank">Branson Country USA</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/buckets-n-boards" target="_blank">Buckets N Boards</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/christmas-wonderland" target="_blank">Christmas Wonderland</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/clay-coopers-country-express" target="_blank">Clay Cooper's Country Express</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/comedy-jamboree" target="_blank">Comedy Jamboree</a></li>
  <li class="list-group-item">Daniel O'Donnell</li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/down-home-country" target="_blank">Down Home Country</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/dublins-irish-tenors-and-the-celtic-ladies" target="_blank">Dublin's Irish Tenors and The Celtic Ladies</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/eamonn-mccrystal-show" target="_blank">Eamonn McCrystal</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/grand-jubilee" target="_blank">Grand Jubilee</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/hughes-brothers-christmas-show" target="_blank">Hughes Brothers Christmas Show</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/rick-thomas" target="_blank">Illusionist Rick Thomas</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/it-show" target="_blank">It Show starring the Hughes Brothers</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/jonah-at-sight-and-sound-theatres" target="_blank">Jonah</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/larry-gatlin-the-gatlin-brothers" target="_blank">Larry Gatlin & the Gatlin Brothers</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/legends-in-concert" target="_blank">Legends in Concert</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/the-lettermen" target="_blank">The Lettermen</a></li>
</ul>
</div>

          </div>
        </div>

        <div class="col-md-4">
          <div class="container-box">
            <h3 class="titulo_opciones">
              Estadía 
              <div class="clearfix visible-xs-block"></div>
              <span>
                <a href="#">Ver más</a>
              </span>
            </h3>
            <div class="box-wscroll">
<ul class="list-group container-list">
    <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/the-acrobats-of-china-show" target="_blank">Acrobats of China</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/amazing-pets" target="_blank">Amazing Pets</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/andy-williams-christmas-show-spectacular" target="_blank">Andy Williams Christmas Show</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/bill-engvall" target="_blank">Bill Engvall</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/billy-dean" target="_blank">Billy Dean in Concert with Jarrett</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/dailey-vincent-show" target="_blank">Dailey & Vincent</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/gene-watson" target="_blank">Gene Watson</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/jimmy-fortune" target="_blank">Jimmy Fortune</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/rhonda-vincent" target="_blank">Rhonda Vincent</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/branson-country-usa" target="_blank">Branson Country USA</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/buckets-n-boards" target="_blank">Buckets N Boards</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/christmas-wonderland" target="_blank">Christmas Wonderland</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/clay-coopers-country-express" target="_blank">Clay Cooper's Country Express</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/comedy-jamboree" target="_blank">Comedy Jamboree</a></li>
  <li class="list-group-item">Daniel O'Donnell</li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/down-home-country" target="_blank">Down Home Country</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/dublins-irish-tenors-and-the-celtic-ladies" target="_blank">Dublin's Irish Tenors and The Celtic Ladies</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/eamonn-mccrystal-show" target="_blank">Eamonn McCrystal</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/grand-jubilee" target="_blank">Grand Jubilee</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/hughes-brothers-christmas-show" target="_blank">Hughes Brothers Christmas Show</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/rick-thomas" target="_blank">Illusionist Rick Thomas</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/it-show" target="_blank">It Show starring the Hughes Brothers</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/jonah-at-sight-and-sound-theatres" target="_blank">Jonah</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/larry-gatlin-the-gatlin-brothers" target="_blank">Larry Gatlin & the Gatlin Brothers</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/legends-in-concert" target="_blank">Legends in Concert</a></li>
  <li class="list-group-item"><a href="https://www.choosebranson.com/show/shows/the-lettermen" target="_blank">The Lettermen</a></li>
</ul>
</div>

          </div>
        </div>
      </div>

      <!-- Bloques rápidos-->
      <div class="row marg-t20 boxs-fast">
        <div class="col-md-4">
          <div class="box box-1 brd-2 text-center">
            <a href="p/formas-de-pago" class="btn btn-lg btn-wa2" title="Formas de pago.">
            <i class="fa fa-credit-card" aria-hidden="true"></i> Formas de pago
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box box-2 brd-2 text-center">
            <a href="p/fotos" class="btn btn-lg btn-wa1" title="Galería de fotos">
            <i class="fa fa-camera-retro" aria-hidden="true"></i> Galería de fotos
            </a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-3 brd-2 text-center">
            <a href="p/certificados-licencias" class="btn btn-lg btn-wa2" title="Cetificados y Licencias">
            <i class="fa fa-id-card" aria-hidden="true"></i> Cetificados y Licencias
            </a>
          </div>
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