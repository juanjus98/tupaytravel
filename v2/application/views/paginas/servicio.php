<?php
$nombre_largo = $servicio['nombre_largo'];
$descripcion = $servicio['descripcion'];
$url_key = $servicio['url_key'];
$imagen_1 = base_url('images/uploads/' . $servicio['imagen_1'] );
$imagen_2 = base_url('images/uploads/' . $servicio['imagen_2'] );
$imagen_3 = base_url('images/uploads/' . $servicio['imagen_3'] );

/*echo "<pre>";
print_r($servicio_detalle);
echo "</pre>";*/
?>
<section>
  <div class="linea-top"><!--Linea amarilla--></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clear-padd">
        <div class="cont_slide_2">
          <div class="img-slide">
            <img src="<?php echo $imagen_1;?>" class="img-responsive" alt="<?php echo $nombre_largo;?>">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--BODY-->
  <div class="container-fluid body-page salon-page">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="logo-salon text-center">
          <img src="<?php echo $imagen_2;?>" class="img-responsive" alt="<?php echo $nombre_largo;?>">
        </div>
        <?php
        if(!empty($galeria)){
        ?>
        <div class="btn-galeria text-center">
          <a href="#" class="btn" title="Ver galería"><i class="fa fa-camera-retro" aria-hidden="true"></i> Ver galería</a>
        </div>
        <?php
      }
        ?>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="bg-form">
          <div class="white-line"><!--linea blanca--></div>
          <div class="form servicio">
            <h1><?=$nombre_largo?></h1>
            <p>
              <?php
              echo str_replace("\n","<br>",$descripcion);
              ?>
            </p>

            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 servicio-detalles">
                <?php
            if(!empty($servicio_detalle)){
              foreach ($servicio_detalle as $key => $value) {
              ?>
              <h2><?php echo $value['nombre'];?></h2>
              <p><?php echo str_replace("\n","<br>",$value['descripcion']);?></p>
              <?php
            }
              }?>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 text-center servicio-image">
                <img src="<?php echo $imagen_3;?>" class="img-responsive" alt="<?php echo $nombre_largo;?>">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--Galerìa-->
<?php
if(!empty($galeria)){
?>
<div id="lightgallery" style="display: none;">
  <?php
  foreach ($galeria as $key => $value) {
    $imagen_file = $value['imagen'];
  ?>
  <a href="<?php echo base_url('images/uploads/' . $imagen_file);?>" data-sub-html="<?php echo $value['imagen_titulo'];?>">
    <img class="img-responsive" src="<?php echo base_url();?>imagens/w200_h200_at__<?php echo $imagen_file;?>">
  </a>
  <?php
}
  ?>
</div>
<?php
}
?>
<!--//Galería-->
<!--//BODY-->
</section>