<?php
/*echo "<pre>";
print_r($busqueda);
echo "</pre>";*/
if(!empty($busqueda)){
  $provincia = $busqueda['provincia'];
}
?>
<section class="main-container">
  <div class="row">
    <div class="col-md-3">
      <?php $this->load->view('paginas/iside_tours');?>
    </div>

    <div class="col-md-9">
      <div class="cont-titulos">
        <h1 class="titulo_opciones">Tours encontrados<?php echo $retVal = (!empty($provincia)) ? ' en ' . ucfirst(strtolower($provincia['provincia'])) : '' ;?>. <span><?php echo $retVal = (!empty($total_listado)) ? $total_listado : '' ; ?></span></h1>
      </div>
      <div class="cont-thumbnails">
        <?php
        if(!empty($listado)) {
          foreach ($listado as $key => $item) {
                //Consultar itinerario
            $data_post = array('id_tbltours' => $item['id']);
            $total_itinerario = $this->Tours_itinerario->total_registros($data_post);
            $itinerarios = $this->Tours_itinerario->listado($total_itinerario, 0, $data_post);

            $nombre_tour = trim($item['nombre']);
            $url_tour = base_url('tour/' . $item['url_key']);
            $urlImagen = base_url('assets/images/no-image.jpg') ;
            /*$urlImagen = (!empty($item['imagen'])) ? base_url($this->config->item('upload_path') . $item['imagen']) : base_url('assets/images/no-image.jpg') ;*/
            ?>
            <div class="listado-item hvr-glow">
              <div class="row">
                <!-- <div class="col-sm-12 col-md-5">
                  <div class="thumbnail">
                    <a href="<?php echo $url_tour;?>" title="<?php echo $nombre_tour;?>" class="list-item">
                      <img src="<?php echo $urlImagen;?>" alt="<?php echo $nombre_tour;?>" class="img-responsive">
                    </a>
                  </div>
                </div> -->
                <div class="col-sm-12 col-md-12">
                  <h3>
                    <a href="<?php echo $url_tour;?>" title="<?php echo $nombre_tour;?>">
                      <?php echo strtolower($nombre_tour);?>
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

                  <!-- <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                      <a href="#" class="btn btn-precio"><?php echo $item['precio'];?></a>
                    </div>
                    <div class="btn-group" role="group">
                    <a href="<?php echo $url_tour;?>" title="<?php echo $nombre_tour;?>" class="btn btn-detalles"><i class="fa fa-plus" aria-hidden="true"></i> Detalles</a>
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