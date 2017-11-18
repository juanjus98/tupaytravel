<?php
$itinerarios = $tour['itinerarios'];
$estadia = ($tour['estadia']==1) ? 'SI' : 'NO';
$duracion = count($itinerarios);
$provincia = $tour['provincia'];

//Datos de paquete o tour
$nombre = $tour['nombre'];
$tipo_info = 'T'; //P:paquete, T:tour
$id_info = $tour['id'];
//echo md5("P3ru@2017");
?>
<section class="main-container cont-detail">
  <div class="row">
    <div class="col-md-8">
      <h1><?php echo $tour['nombre'];?> <div class="clearfix mrg-top-15 visible-xs-block"></div> <span><?php echo $tour['precio'];?></span></h1>
      <div class="clearfix"></div>
      <a href="<?php echo base_url('pdf-tour/' . $tour['url_key']);?>" class="btn btn-link"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar en PDF</a>
    </div>
    <div class="col-md-4">
      <div class="sharethis-inline-share-buttons"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php
      if($_GET['ack'] == 'success'){
        ?>
        <div class="alert alert-success" role="alert"><i class="fa fa-smile-o" aria-hidden="true"></i> <strong>Tu solicitud ha sido enviada con éxito.</strong> Nos estaremos poniendo en contacto contigo a la brevedad posible. Gracias. </div>
        <?php
      }
      ?>
    </div>
    <div class="col-md-8">
      <div class="cont-gallery">
        <div class="row">
          <div class="col-md-10">
            <?php
            if(!empty($itinerarios)){
              ?>
              <ul id="imageGallery">
                <?php
                foreach ($itinerarios as $key => $itinerario) {
                  $urlImagen = (!empty($itinerario['nombre_imagen'])) ? base_url($this->config->item('upload_path') . $itinerario['nombre_imagen']) : base_url('assets/images/no-image.jpg') ;
                  ?>
                  <li data-thumb="<?php echo $urlImagen;?>" data-src="<?php echo $urlImagen;?>">
                    <img src="<?php echo $urlImagen;?>" class="img-responsive" />
                    <div class="caption"><?php echo $caption = ($itinerario['titulo']) ? $itinerario['titulo'] : ''; ?></div>
                  </li>
                  <?php 
                }
                ?>
              </ul>
              <?php
            }
            ?>
          </div>
          <div class="col-md-2">
            <div class="row iconos-desc">
              <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
                <div class="cont-icono">
                  <i class="fa fa-bed" aria-hidden="true"></i>
                  <div class="clearfix"></div>
                  <h4>Estadia</h4>
                  <p><?php echo $estadia;?></p>
                </div>
              </div>

              <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
                <div class="cont-icono">
                  <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                  <div class="clearfix"></div>
                  <h4>Duración</h4>
                  <p><?php echo $strDurecion = ($duracion > 1) ? $duracion . ' Días' : $duracion . ' Día' ;?></p>
                </div>
              </div>
              <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
                <div class="cont-icono">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <div class="clearfix"></div>
                  <h4>Ciudad</h4>
                  <p><?php echo $strCiudades = (!empty($provincia)) ? $provincia : '' ;?></p>
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
          <ul class="nav nav-tabs nav-justified" id="myTabs" rele="tablist">
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
              <?php echo $strDetalles = ($tour['detalle']) ? $tour['detalle'] : '<p class="text-center">Sin información</p>' ;?>
            </div>
            <!--//Descripción-->

            <!--Itinerario-->
            <div class="tab-pane fade" role="tabpanel" id="itinerario" aria-labelledby="itinerario-tab">
              <!-- timeline-->
              <div class="row example-basic">
                <div class="col-xs-12">
                  <?php 
                  if(!empty($itinerarios)){
                    ?>
                    <ul class="timeline">
                      <?php
                      $iiDia = 1;
                      foreach ($itinerarios as $key => $itinerario) {
                        $urlImagen = (!empty($itinerario['nombre_imagen'])) ? base_url($this->config->item('upload_path') . $itinerario['nombre_imagen']) : base_url('assets/images/no-image.jpg') ;
                        ?>
                        <li class="timeline-item">
                          <div class="timeline-info">
                            <span><?php echo 'Día ' . $iiDia;?></span>
                          </div>
                          <div class="timeline-marker"></div>
                          <div class="timeline-content">
                            <div class="row">
                              <div class="col-sm-8">
                                <h3 class="timeline-title"><?php echo $itinerario['titulo'];?></h3>
                                <p><?php echo $itinerario['descripcion'];?></p>
                              </div>
                              <div class="col-sm-4">
                                <img src="<?php echo $urlImagen;?>" class="img-responsive img-rounded" alt="<?php echo $itinerario['titulo'];?>">
                              </div>
                            </div>
                          </div>
                        </li>
                        <?php 
                        $iiDia++;
                      }
                      ?>
                    </ul>
                    <?php
                  }else{
                    ?>
                    <h4 class="text-center">Sin itinerario.</h4>
                    <?php }?>
                  </div>
                </div>
                <!-- //timeline-->
              </div>
              <!--//Itinerario-->

              <!--Formas de pago-->
              <div class="tab-pane fade cont-ckeditor" role="tabpanel" id="pago" aria-labelledby="pago-tab">
                <?php
                if(!empty($formas_pago)){

                  echo '<p>' . $formas_pago['resumen'] . '</p>';
                  echo $formas_pago['descripcion1'];

                  echo '<div class="clearfix mrg-top-15"></div>';

                  if(!empty($formas_pago['descargable'])){
                    $url_descargable = base_url($this->config->item('upload_path') . $formas_pago['descargable']);
                    echo '<div class="text-center"><a href="'.$url_descargable.'" target="_blank" class="btn btn-primary-1"><i class="fa fa-download" aria-hidden="true"></i> '.$formas_pago['descargable_titulo'].'</a></div>';
                  }

                }else{
                  echo '<h4 class="text-center">Sin registros</h4>';
                }
                ?>
              </div>
              <!--//Formas de pago-->

            </div>

          </div>
        </div>
        <!-- //Tabs-->

      </div>
      <div class="col-md-4">
        <div id="sticky-sidebar">
          <?php $this->load->view('paginas/i_reservar_form');?>
        </div>
      </div>
    </div>

  </section>
  <!--Modal reservar-->
  <?php //$this->load->view('paginas/i_reservar_form_modal');?>