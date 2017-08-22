<?php
$itinerarios = $tour['itinerarios'];
$estadia = ($tour['estadia']==1) ? 'SI' : 'NO';
$duracion = count($itinerarios);
$provincia = $tour['provincia'];
?>
<section class="main-container cont-detail">
  <div class="row">
    <div class="col-md-8">
      <h1><?php echo $tour['nombre'];?> <span><?php echo $tour['precio'];?></span></h1>
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
              <form class="form-vertical" name="buscador" id="buscador" action="tours/" method="post">
               <fieldset class="form-reservar">
                 <h3>Reservarlo ahora.</h3>
<!-- <div class="form-group">
  <label>Nombres y apellidos:</label>
  <input type="text" name="nombres" class="form-control" value="">
</div>
<div class="form-group">
  <label>Teléfono:</label>
  <input type="text" name="telefono" class="form-control" value="">
</div>
<div class="form-group">
  <label>E-mail:</label>
  <input type="email" name="email" class="form-control" value="">
</div> -->

<div class="form-group">
  <label>Pais de origen:</label>
  <select class="form-control select_search" name="pais_origen">
    <option value="">Seleccionar</option>
    <?php
    if(!empty($paises)){
      foreach ($paises as $key => $pais) {
        echo '<option value="'.$pais->alpha3Code.'">'.$pais->name.'</option>';
      }
    }
    ?>
  </select>
</div>

<div class="form-group">
  <label>Ciudad de origen:</label>
  <input type="text" name="ciudad" class="form-control" value="">
</div>

<div class="form-group">
  <label>Fecha de arribo:</label>
  <div class="input-group date">
    <input type="text" class="form-control select-fecha" name="fecha_inicio" value="<?php echo $desde = (!empty($fechaDesde)) ? date("d-m-Y", strtotime($fechaDesde)) : '' ;?>" >
    <span class="input-group-addon">
      <a href="javascript:;" class="show_calendar">
        <i class="fa fa-calendar" aria-hidden="true"></i>
      </a>
    </span>
  </div>
</div>

<div class="row">
  <div class="col-xs-3">
    <label class="text-center btn-block">Adultos</label>
    <select name="adultos" id="adultos" class="form-control" placeholder="+18 años">
      <!--         <option value="0">0</option> -->
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <p class="help-block text-center">+18 años.</p>
  </div>

  <div class="col-xs-3">
    <label class="text-center btn-block">Adolecentes</label>
    <select name="adolecentes" id="adolecentes" class="form-control" placeholder="12-17">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <p class="help-block text-center">12-17</p>
  </div>

  <div class="col-xs-3">
    <label class="text-center btn-block">Ñiños</label>
    <select name="ninios" id="ninios" class="form-control" placeholder="8-11">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <p class="help-block text-center">8-11</p>
  </div>

  <div class="col-xs-3">
    <label class="text-center btn-block">Infantes</label>
    <select name="infantes" id="infantes" class="form-control" placeholder="3-7">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <p class="help-block text-center">3-7</p>
  </div>
</div>

<div class="row"> 
  <div class="col-md-12">
    <button class="btn btn-primary-1 btn-block" type="submit">
      <i class="fa fa-hand-o-right" aria-hidden="true"></i> Reservar ahora.
    </button>
  </div>
</div>
</fieldset>

</form>
</div>
</div>
</div>

</section>