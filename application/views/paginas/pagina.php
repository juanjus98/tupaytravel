<?php
/*echo "<pre>";
print_r($pagina);
echo "</pre>";*/
?>
<section class="main-container cont-detail">
  <div class="row">
    <div class="col-md-12">
    <div class="cont-ckeditor" style="padding: 0 30px;">
    <h1><?php echo $pagina['nombre_corto'];?></h1>
    <p><?php echo $pagina['resumen'];?></p>
    <?php echo $pagina['descripcion1'];?>
    </div>

    <?php
      if(!empty($pagina['descargable'])){
        $url_descargable = base_url($this->config->item('upload_path') . $pagina['descargable']);
        echo '<div class="text-center"><a href="'.$url_descargable.'" target="_blank" class="btn btn-primary-1"><i class="fa fa-download" aria-hidden="true"></i> '.$pagina['descargable_titulo'].'</a></div>';
      }
    ?>
    </div>      
  </div>
</section>
  