<?php
/*echo "<pre>";
print_r($categorias);
echo "</pre>";*/
?>
<div id="sticky-sidebar">
  <form class="form-vertical" name="buscador" id="buscador" action="" method="post">
   <!-- <fieldset class="form-home">
     <h3>¿En qué fechas viajas?</h3>
     <div class="form-group">
      <label>Desde</label>
      <div class="input-group date">
        <input type="text" class="form-control" name="fecha_inicio" id="date_from" value="<?php echo $desde = (!empty($busqueda['fechaDesde'])) ? $busqueda['fechaDesde'] : '' ;?>" >
        <span class="input-group-addon">
          <a href="#" id="fecha_inicio_show">
            <i class="fa fa-calendar" aria-hidden="true"></i>
          </a>
        </span>
      </div>
    </div>

    <div class="form-group">
      <label>Hasta</label>
      <div class="input-group date">
        <input type="text" class="form-control" name="fecha_fin" id="date_to" value="<?php echo $hasta = (!empty($busqueda['fechaHasta'])) ? $busqueda['fechaHasta'] : '' ;?>">
        <span class="input-group-addon">
          <a href="#" id="fecha_fin_show">
            <i class="fa fa-calendar" aria-hidden="true"></i>
          </a>
        </span>
      </div>
    </div>
    <div class="row"> 
      <div class="col-md-12">
        <button id="buscar" class="btn btn-primary-1 btn-block" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
      </div>
    </div>
  </fieldset> -->

  <fieldset>
    <div class="container-box">
      <h3 class="titulo_opciones">Categoría</h3>
      <div>
        <?php
        if(!empty($categorias)){
          foreach ($categorias as $key => $value) {
              $categoria_str = url_title(convert_accented_characters($value['categoria']),'-', TRUE);
              $urlCategoria = base_url('tours/'.$categoria_str);
              ?>
              <a href="<?php echo $urlCategoria;?>" class="btn btn-block btn-primary"><?php echo $value['categoria'];?></a>
              <?php
          }
        }
        ?>
      </div>
    </div>
  </fieldset>

  <fieldset>
    <div class="container-box">
      <h3 class="titulo_opciones">Número de días</h3>
      <div class="box-wscroll">
        <?php
        if(!empty($dias)){
          foreach ($dias as $key => $dia) {
            if($dia['nro_dias'] > 0){
              $urlPaquetes = base_url('tours/'.$dia['nro_dias'].'dias');
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