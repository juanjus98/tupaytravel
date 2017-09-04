<?php
/*echo "<pre>";
print_r($hotel);
echo "</pre>";*/
?>
<section class="main-container cont-detail">
  <div class="row">
    <div class="col-md-8">
      <h1><?php echo $hotel['nombre'];?></h1>
      <h5><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $retVal = (!empty($hotel['localidad'])) ? $hotel['localidad'] . ' - ' : '' ; echo $hotel['provincia'];?></h5>
    </div>
    <div class="col-md-4">
      <div class="sharethis-inline-share-buttons"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="cont-gallery">
        <div class="row">
          <div class="col-md-12">
            <?php
            if(!empty($galeria)){
              ?>
              <ul id="imageGalleryHotel">
                <?php
                foreach ($galeria as $key => $value) {
                  $urlImagen = (!empty($value['foto'])) ? base_url($this->config->item('upload_path') . $value['foto']) : base_url('assets/images/no-image.jpg') ;
                  ?>
                  <li data-thumb="<?php echo $urlImagen;?>" data-src="<?php echo $urlImagen;?>">
                    <img src="<?php echo $urlImagen;?>" class="img-responsive" />
                  </li>
                  <?php 
                }
                ?>
              </ul>
              <?php
            }
            ?>
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

            <!-- <li role="presentation">
              <a href="#itinerario" id="descripcion-tab" role="tab" data-toggle="tab" aria-controls="itinerario" aria-expanded="true">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Itinerario
              </a>
            </li>

            <li role="presentation">
              <a href="#pago" id="pago-tab" role="tab" data-toggle="tab" aria-controls="pago" aria-expanded="true">
                <i class="fa fa-usd" aria-hidden="true"></i>  Formas de pago
              </a>
            </li> -->

          </ul>
          <div class="tab-content" id="myTabContent">
            <!--Descripción-->
            <div class="tab-pane fade in active" role="tabpanel" id="descripcion" aria-labelledby="descripcion-tab">
              <?php echo $strDetalles = ($hotel['descripcion']) ? $hotel['descripcion'] : '<p class="text-center">Sin información</p>' ;?>
            </div>
            <!--//Descripción-->

                </div>

              </div>
            </div>
            <!-- //Tabs-->

          </div>
<div class="col-md-4">
<h3 class="titulo_opciones">Relacionados:</h3>
    <?php
    if(!empty($hoteles_relacionados)){
     ?>
     <div class="row">
       <?php
        foreach ($hoteles_relacionados as $key => $value) {
          /*echo "<pre>";
          print_r($value);
          echo "</pre>";*/
          $nombre = $value['nombre'];

          //Consultar imagen principal
            $data_galeria = array('id_hotel' => $value['id_hotel'], 'principal' => 1);
            $galeria = $this->Hoteles_galeria->get_row($data_galeria);

            if(!empty($galeria)){
              $urlImagen = base_url('imagens/w600_h600_at__' . $galeria['foto']);
            }else{
              $urlImagen = base_url('assets/images/no-image.jpg') ;
            }

            $url_hotel = base_url('hotel/' . $value['id_hotel'] . '/' . $value['url_key']);

         ?>
         <div class="col-xs-12 col-md-6">
          <a href="<?php echo $url_hotel;?>" title="<?php echo $nombre;?>">
            <div class="cont-promo">
             <span class="btn-block titulo-block"><?php echo $nombre;?></span>
             <img src="<?php echo $urlImagen;?>" alt="<?php echo $nombre;?>" alt="<?php echo $nombre;?>" class="img-responsive">
           </div>
         </a>
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

</section>