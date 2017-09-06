<?php
$itinerarios = $paquete['itinerarios'];
$estadia = ($paquete['estadia']==1) ? 'SI' : 'NO';
$duracion = count($itinerarios);
$ciudades = implode (", ", $paquete['ciudades_nombres']);

//Datos de paquete o tour
$nombre = $paquete['nombre'];
$tipo_info = 'P'; //P:paquete, T:tour
$id_info = $paquete['id'];

if(!empty($busqueda_info)){
  $date_range = date_range($busqueda_info['dateDesde'], $busqueda_info['dateHasta']);
}
?>
<section class="main-container cont-detail">
  <div class="row">
    <div class="col-md-8">
      <h1><?php echo $nombre;?> <div class="clearfix mrg-top-15 visible-xs-block"></div> <span><?php echo $paquete['precio'];?></span></h1>
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
                    <div class="clearfix"></div>
                    <div class="caption">
                    <?php echo $caption = ($itinerario['titulo']) ? $itinerario['titulo'] : ''; ?>
                    </div>
                    <div class="clearfix"></div>
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
                  <h4>Ciudades</h4>
                  <p><?php echo $strCiudades = (!empty($ciudades)) ? $ciudades : '' ;?></p>
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
              <?php echo $strDetalles = ($paquete['detalles']) ? $paquete['detalles'] : '<p class="text-center">Sin información</p>' ;?>
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
                        $str_fecha = (!empty($date_range[$key])) ? nice_date($date_range[$key], 'd/m/Y') : 'Día ' . $iiDia;
                        ?>
                        <li class="timeline-item">
                          <div class="timeline-info">
                            <span><?php echo $str_fecha;?></span>
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
<form class="form-vertical" name="form-reservar" id="form-reservar" action="" method="post" data-toggle="validator">
<fieldset class="form-reservar">
<h3>Reservarlo ahora.</h3>
<div class="form-group has-feedback">
  <label for="pais_origen" class="control-label">Pais de origen:</label>
  <select class="form-control select_search" name="pais_origen" id="pais_origen" required>
    <option value="">Seleccionar</option>
    <?php
    if(!empty($paises)){
      foreach ($paises as $key => $pais) {
        echo '<option value="'.$pais->name.'">'.$pais->name.'</option>';
      }
    }
    ?>
  </select>
</div>

<div class="form-group has-feedback">
  <label for="ciudad" class="control-label">Ciudad de origen:</label>
  <input type="text" name="ciudad" id="ciudad" class="form-control" value="" required>
  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
</div>

<?php
if(empty($busqueda_info)){
?>
<div class="form-group has-feedback">
  <label for="fecha_arribo" class="control-label">Fecha de arribo (desde Lima):</label>
  <div class="input-group date">
    <input type="text" class="form-control select-fecha" name="fecha_arribo" id="fecha_arribo" value="<?php echo $desde = (!empty($fechaDesde)) ? date("d-m-Y", strtotime($fechaDesde)) : '' ;?>" required>
    <span class="input-group-addon">
      <a href="javascript:;" class="show_calendar">
        <i class="fa fa-calendar" aria-hidden="true"></i>
      </a>
    </span>
  </div>
</div>
<?php } ?>
<div class="row">
  <div class="col-xs-3">
    <label class="text-center btn-block">Adultos</label>
    <select name="adultos" id="adultos" class="form-control" placeholder="+18 años">
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

<!--Modal reservar-->
<div class="modal fade" id="modal-reservar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form name="form-reservar-completar" id="form-reservar-completar" action="<?php echo base_url('reservar');?>" method="post" data-toggle="validator">
      <input type="hidden" name="tipo_info" value="<?php echo $tipo_info;?>">
      <input type="hidden" name="id_info" value="<?php echo $id_info;?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Por último solo completa el siguiente formulario.</h4>
      </div>
      <div class="modal-body">
      <div class="row">
          <div class="col-xs-12 col-md-5">
              <p class="lead">Reservar <span class="text-success"><?php echo $nombre;?></span></p>
              <ul id="list-form-data" class="list-unstyled" style="line-height: 2">
                  <?php
                  if(!empty($busqueda_info)){
                  ?>
                  <li>
                  <span class="fa fa-check text-success"></span> Fechas elegidas: <?php echo date('d/m/Y',strtotime($busqueda_info['dateDesde']))?> - <?php echo date('d/m/Y',strtotime($busqueda_info['dateHasta']))?>
                  <input type="hidden" name="dateDesde" value="<?php echo $busqueda_info['dateDesde'];?>">
                  <input type="hidden" name="dateHasta" value="<?php echo $busqueda_info['dateHasta'];?>">
                  </li>
                  <?php }?>
                  <!-- <li><span class="fa fa-check text-success"></span> See all your orders</li>-->
              </ul>
          </div>
                  <div class="col-xs-12 col-md-7">
                  <div class="well">
                      <div class="form-group has-feedback">
                      <label for="nombres" class="control-label">Nombres y apellidos:</label>
                      <input type="text" name="nombres" id="nombres" class="form-control" value="" required>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      </div>

                      <div class="row">
                      <div class="col-xs-12 col-md-6">
                      <div class="form-group has-feedback">
                      <label for="telefono" class="control-label">Teléfono:</label>
                      <input type="text" name="telefono" id="telefono" class="form-control" value="" required>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      </div>
                      </div>
                      <div class="col-xs-12 col-md-6">
                      <div class="form-group has-feedback">
                      <label for="celular" class="control-label">Celular:</label>
                      <input type="text" name="celular" id="celular" class="form-control" value="" required>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      </div>
                      </div>
                      </div>

                      <div class="form-group has-feedback">
                      <label for="email" class="control-label">Correo electrónico:</label>
                      <input type="email" name="email" id="email" class="form-control" value="" required>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      </div>

                      <div class="form-group">
                      <label for="email" class="control-label">Mensaje:</label>
                      <textarea name="mensaje" id="mensaje" class="form-control" rows="4"></textarea>
                      </div>
                      </div>
                  </div>
                  
              </div>
    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        <i class="fa fa-times" aria-hidden="true"></i> Cancelar
        </button>
        <!-- <button type="button" class="btn btn-primary">Enviar</button> -->
        <button class="btn btn-primary-1" type="submit">
        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Enviar.
        </button>
      </div>
    </form>
    </div>
  </div>
</div>