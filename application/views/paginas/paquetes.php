<?php
if(!empty($busqueda_info['dateDesde']) && !empty($busqueda_info['dateHasta'])){
  $date_range = date_range($busqueda_info['dateDesde'], $busqueda_info['dateHasta']);
}
?>
<section class="main-container">
  <div class="row">
    <div class="col-md-3">
      <?php $this->load->view('paginas/iside');?>
    </div>

    <div class="col-md-9">
      <div class="cont-titulos">
        <h1 class="titulo_opciones">Paquetes encontrados. <span><?php echo $retVal = (!empty($total_paquetes)) ? $total_paquetes : '' ; ?></span></h1>
      </div>
      <div class="cont-thumbnails">
        <?php
        if(!empty($paquetes)) {
          foreach ($paquetes as $key => $paquete) {
            //Consultar itinerario
            $data_post = array('id_tblpaquete' => $paquete['id']);
            $total_itinerario = $this->Paquetes_galeria->total_registros($data_post);
            $itinerarios = $this->Paquetes_galeria->listado($total_itinerario, 0, $data_post);

            $nombre_paquete = strip_tags($paquete['nombre']);
            $url_paquete = base_url('paquete-tour/' . $paquete['url_key']);

            $urlImagen = base_url('assets/images/no-image.jpg') ;
            /*$urlImagen = (!empty($paquete['imagen'])) ? base_url($this->config->item('upload_path') . $paquete['imagen']) : base_url('assets/images/no-image.jpg') ;*/
            ?>
            <div class="listado-item">
              <div class="row">
                <!-- <div class="col-sm-12 col-md-5">
                  <div class="thumbnail">
                    <a href="<?php echo $url_paquete;?>" title="<?php echo $nombre_paquete;?>" class="list-item">
                      <img src="<?php echo $urlImagen;?>" alt="<?php echo $nombre_paquete;?>" class="img-responsive">
                    </a>
                  </div>
                </div> -->

                <div class="col-sm-12 col-md-12">
                  <h3>
                    <a href="<?php echo $url_paquete;?>" title="<?php echo $nombre_paquete;?>">
                      <?php echo strtolower($nombre_paquete);?>
                    </a>
                  </h3>
                  <div class="list-group">
                    <?php 
                    if(!empty($itinerarios)){
                      $i_dia = 1;
                      foreach ($itinerarios as $key => $itinerario) {
                        $str_fecha = (!empty($date_range[$key])) ? nice_date($date_range[$key], 'd/m/Y') : 'Día ' . $i_dia;
                        ?>
                        <div class="list-group-item">
                          <h4 class="list-group-item-heading">
                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i> 
                            <?php echo $str_fecha;?> <span><?php echo $itinerario['titulo'];?></span>
                          </h4>
                        </div>
                        <?php
                        $i_dia++;
                      } 
                    }
                    ?>
                  </div>

                  <!-- <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                      <a href="#" class="btn btn-precio"><?php echo $paquete['precio'];?></a>
                    </div>
                    <div class="btn-group" role="group">
                      <a href="<?php echo $url_paquete;?>" title="<?php echo $nombre_paquete;?>" class="btn btn-detalles"><i class="fa fa-plus" aria-hidden="true"></i> Detalles</a>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
            <?php 
          }
        }
        ?>

      </div>
    </div>

  </div>

</section>