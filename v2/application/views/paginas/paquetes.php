<section class="main-container">
  <div class="row">
    <div class="col-md-3">
      <?php $this->load->view('paginas/iside');?>
    </div>

    <div class="col-md-9">
      <div class="cont-thumbnails">
        <?php
        if(!empty($paquetes)) {
          ?>        
          <div class="row">
            <?php
            /*while ($paquete = mysql_fetch_array($result)) {*/
              foreach ($paquetes as $key => $paquete) {
                /*echo "<pre>";
                print_r($paquete);
                echo "</pre>";*/
                $nombre_paquete = trim($paquete['nombre']);
                $url_paquete = base_url('paquete-tour/' . $paquete['url_key']);
                $urlImagen = (!empty($paquete['imagen'])) ? base_url($this->config->item('upload_path') . $paquete['imagen']) : base_url('assets/images/no-image.jpg') ;
                ?>
                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <a href="<?php echo $url_paquete;?>" class="titulo-imagen" title="<?php echo $nombre_paquete;?>">
                      <img src="<?php echo $urlImagen;?>" class="img-responsive" alt="<?php echo $nombre_paquete;?>">
                      <h3><?php echo $nombre_paquete;?></h3>
                    </a>
                    <div class="cont-btns">
                      <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                        <a href="javascript:;" class="btn btn-precio" role="button"><?php echo $paquete['precio'];?></a>
                        <a href="<?php echo $url_paquete;?>" class="btn btn-detalles" title="<?php echo $nombre_paquete;?>">
                          <i class="fa fa-info" aria-hidden="true"></i> Detalles
                        </a>
                      </div>
                    </div>
                  </div>
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

    </div>

  </section>