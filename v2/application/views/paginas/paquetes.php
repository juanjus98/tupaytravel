<?php
/*echo "<pre>";
print_r($dias);
echo "</pre>";*/
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

            $nombre_paquete = trim($paquete['nombre']);
            $url_paquete = base_url('paquete-tour/' . $paquete['url_key']);
            $urlImagen = (!empty($paquete['imagen'])) ? base_url($this->config->item('upload_path') . $paquete['imagen']) : base_url('assets/images/no-image.jpg') ;
            ?>
            <div class="listado-item hvr-glow">
              <div class="row">
                <div class="col-sm-12 col-md-5">
                  <div class="thumbnail">
                    <a href="<?php echo $url_paquete;?>" title="<?php echo $nombre_paquete;?>" class="titulo-imagen">
                      <img src="<?php echo $urlImagen;?>" class="img-responsive" alt="<?php echo $nombre_paquete;?>">
                    </a>
                  </div>
                </div>
                <div class="col-sm-12 col-md-7">
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
                        ?>
                        <div class="list-group-item">
                          <h4 class="list-group-item-heading">
                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i> 
                            Día <?php echo $i_dia;?> <span><?php echo $itinerario['titulo'];?></span>
                          </h4>
                        </div>
                        <?php
                        $i_dia++;
                      } 
                    }
                    ?>
                  </div>

                  <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                      <a href="#" class="btn btn-precio"><?php echo $paquete['precio'];?></a>
                    </div>
                    <div class="btn-group" role="group">
                    <a href="<?php echo $url_paquete;?>" title="<?php echo $nombre_paquete;?>" class="btn btn-detalles"><i class="fa fa-plus" aria-hidden="true"></i> Detalles</a>
                    </div>
                  </div>
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