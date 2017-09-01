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
    <!-- <div class="col-md-3">
      <?php $this->load->view('paginas/iside_tours');?>
    </div> -->

    <div class="col-md-12">
      <div class="cont-titulos">
        <h1 class="titulo_opciones">Hoteles <?php echo $retVal = (!empty($provincia)) ? ' en ' . ucfirst(strtolower($provincia['provincia'])) : '' ;?>. <span><?php echo $retVal = (!empty($total_listado)) ? $total_listado : '' ; ?></span></h1>
      </div>
      <div class="cont-thumbnails">
      <div class="row">
        <?php
        if(!empty($listado)) {
          foreach ($listado as $key => $item) {

            echo "<pre>";
            print_r($item);
            echo "</pre>";
            
            //Consultar imagen principal
            $data_galeria = array('id_hotel' => $item['id'], 'principal' => 1);
            $galeria = $this->Hoteles_galeria->get_row($data_galeria);

            $nombre = trim($item['nombre']);
            $provincia = trim($item['provincia']);

            $url_hotel = base_url('hotel/' . $item['id'] . '/' . $item['url_key']);
            /*$url_detalle_hotel_2 = 'hotel/' . $com2['id_hotel'] . '/' . url_amigable($com2['nombre']) .'/';*/
            $urlImagen = (!empty($item['imagen'])) ? base_url($this->config->item('upload_path') . $item['imagen']) : base_url('assets/images/no-image.jpg') ;
            ?>

                <div class="col-sm-12 col-md-4">

                  <div class="thumbnail thumbnail-item">
                    <!-- <div class="discount">25%</div> -->
                    <figure>
                      <a href="<?php echo $url_hotel;?>" title="<?php echo $nombre;?>">
                        <img src="https://unsplash.it/800/600" alt="<?php echo $nombre;?>">
                      </a>
                      <!-- <div class="tg-icons">
                        <span class="badge" data-toggle="tooltip" title="Título"><i class="fa fa-plane" aria-hidden="true"></i></span>
                        <span class="badge"  data-toggle="tooltip" title="Título"><i class="fa fa-car" aria-hidden="true"></i></span>
                      </div> -->
                    </figure>
                    <div class="caption">
                      <h3><a href="<?php echo $url_hotel;?>" title="<?php echo $nombre;?>"><?php echo $nombre;?></a></h3>
                      <h4>
                        <i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $provincia;?>
                      </h4>
                      <!-- <p>Descripción</p> -->
                    </div>
                    <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                      <!-- <div class="btn-group" role="group">
                        <a href="javascript:;" class="btn btn-precio"><small>desde</small> $200.00</a>
                      </div> -->
                      <div class="btn-group" role="group">
                        <a href="<?php echo $url_hotel;?>" title="<?php echo $nombre;?>" class="btn btn-detalles">
                        <i class="fa fa-plus" aria-hidden="true"></i> Detalles
                        </a>
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

  </div>

</section>