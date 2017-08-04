<?php
session_start();
include("conectar.php");
include("includes/i_funciones.php");
require_once __DIR__ . '/libs/function.video.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

/**
 * Consultar paquete
 */
$params = $_GET['params'];
$dataParams = explode("-", $params);
$paquete_id = end($dataParams);

$addWhere = 'Where id=' . $paquete_id;
$sql_query = "SELECT * FROM tblpaquete ".$addWhere;
$result = mysql_query($sql_query,$link);
if(mysql_num_rows($result)){
  $paquete=mysql_fetch_array($result);
  $url_paquete = 'paquete-tour/' . url_amigable($paquete['nombre']) . '-' . $paquete['id'];
  $titulo = strtolower(trim($paquete['nombre']));

  /*echo "<pre>";
  print_r($paquete);
  echo "</pre>";*/

  /**
  * Consultar Galería
  */
  $sql_gal="SELECT * FROM tblpaquete_galeria where id_tblpaquete='".$paquete['id']."' Order By principal ASC, id Asc";
  $query_gal=mysql_query($sql_gal,$link);
  if(mysql_num_rows($query_gal) > 0){
    $galeria = array();
    while ($fs_gal = mysql_fetch_array($query_gal)) {
      $galeria[] = $fs_gal;
    }
  }

  /**
   * Imagen principal
   */
  $urlImagen = 'images/fb-image.jpg';
  if(!empty($galeria)){
   $urlImagen = 'images/uploads/' . $galeria[0]['nombre_imagen'];
  }

}
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
<section class="main-container cont-detail">
  <div class="row">
      <div class="col-md-8">
        <h1><?php echo $titulo;?> <span>$200.00</span></h1>
      </div>
      <div class="col-md-4">
        <div class="sharethis-inline-share-buttons"></div>
      </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="cont-gallery">
      <div class="row">
        <div class="col-md-10">
          <?php include('includes/i_paquete_galeria.php');?>
        </div>
        <div class="col-md-2">
          <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
              <div class="cont-icono">
                <i class="fa fa-bed" aria-hidden="true"></i>
                <div class="clearfix"></div>
                <h4>Estadia</h4>
                <p>Si incluye</p>
              </div>
            </div>

            <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
              <div class="cont-icono">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                <div class="clearfix"></div>
                <h4>Duración</h4>
                <p>4 Días</p>
              </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
              <div class="cont-icono">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <div class="clearfix"></div>
                <h4>Provincia</h4>
                <p>Cusco</p>
              </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
              <div class="cont-icono">
                <i class="fa fa-users" aria-hidden="true"></i>
                <div class="clearfix"></div>
                <h4>Pasajeros Minimo</h4>
                <p>1 persona</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>

      <!-- Tabs-->
      <!-- <div class="cont-tabs"> -->
      <div class="tabbable-panel">
      <div class="tabbable-line">
      <ul class="nav nav-tabs" id="myTabs" rele="tablist">
        <li role="presentation" class="active">
          <a href="#descripcion" id="descripcion-tab" role="tab" data-toggle="tab" aria-controls="descripcion" aria-expanded="true">
          <i class="fa fa-info-circle" aria-hidden="true"></i> Información
          </a>
        </li>

        <li role="presentation">
          <a href="#itinerario" id="descripcion-tab" role="tab" data-toggle="tab" aria-controls="itinerario" aria-expanded="true">
          <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Itinerario
          </a>
        </li>

        <li role="presentation">
          <a href="#pago" id="pago-tab" role="tab" data-toggle="tab" aria-controls="pago" aria-expanded="true">
          <i class="fa fa-usd" aria-hidden="true"></i>  Formas de pago
          </a>
        </li>

      </ul>
      <div class="tab-content" id="myTabContent">
        <!--Descripción-->
        <div class="tab-pane fade in active" role="tabpanel" id="descripcion" aria-labelledby="descripcion-tab">
        <p>DESCRIPCIÓN Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
        </p>
        </div>
        <!--//Descripción-->

        <!--Itinerario-->
        <div class="tab-pane fade" role="tabpanel" id="itinerario" aria-labelledby="itinerario-tab">
        <p>ITINERARIO Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
        </p>
        </div>
        <!--//Itinerario-->

        <!--Formas de pago-->
        <div class="tab-pane fade" role="tabpanel" id="pago" aria-labelledby="pago-tab">
        <p>PAGO Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
        </p>
        </div>
        <!--//Formas de pago-->

      </div>

      </div>
      </div>
      <!-- //Tabs-->

    </div>
    <div class="col-md-4">
      <?php include('includes/i_form_reservar.php');?>
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