<?php
/*echo "<pre>";
print_r($busqueda);
echo "</pre>";*/
?>
<div id="sticky-sidebar">
  <form class="form-vertical" name="buscador" id="buscador" action="" method="post">

  <fieldset>
    <div class="container-box">
      <h3 class="titulo_opciones">Categoría</h3>
      <div>
        <?php
        if(!empty($categorias)){
          foreach ($categorias as $key => $value) {
            $provincia_key = (!empty($busqueda['provincia'])) ? $busqueda['provincia']['url_key'] : 'all' ;
            $categoria_key = (!empty($busqueda['categoria'])) ? $busqueda['categoria']['url_key'] : 'all' ;
            $nro_dias = (!empty($busqueda['nro_dias'])) ? $busqueda['nro_dias']: '' ;
            $strDia = ($nro_dias > 1) ? $nro_dias . '-dias' : $nro_dias . '-dia';
            $urlCategoria = base_url('tours/'.$provincia_key . '/' . $value['url_key']);

            if(!empty($nro_dias)){
              $urlCategoria .= '/' . $strDia;
            }
            ?>
            <a href="<?php echo $urlCategoria;?>" class="btn btn-block btn-primary"><?php echo $value['categoria'];?></a>
            <?php
          }
        }
        ?>
      </div>
    </div>
  </fieldset>

  <fieldset class="hidden-xs">
    <div class="container-box">
      <h3 class="titulo_opciones">Número de días</h3>
      <div class="box-wscroll">
        <?php
        if(!empty($dias)){
          foreach ($dias as $key => $dia) {
            if($dia['nro_dias'] > 0){
              $provincia_key = (!empty($busqueda['provincia'])) ? $busqueda['provincia']['url_key'] : 'all' ;
              $categoria_key = (!empty($busqueda['categoria'])) ? $busqueda['categoria']['url_key'] : 'all' ;
              $strDia = ($dia['nro_dias'] > 1) ? $dia['nro_dias'] . '-dias' : $dia['nro_dias'] . '-dia' ;
              $urlPaquetes = base_url('tours/' . $provincia_key. '/' . $categoria_key . '/' . $strDia);
              ?>
              <a href="<?php echo $urlPaquetes;?>" class="btn btn-block btn-default"><?php echo ($dia['nro_dias'] == 1) ? 'Tour de ' . $dia['nro_dias'] . ' Día' : 'Tours de ' . $dia['nro_dias'] . ' Días' ;?></a>
              <?php
            }
          }
        }
        ?>
      </div>
    </div>
  </fieldset>
</form>
</div>