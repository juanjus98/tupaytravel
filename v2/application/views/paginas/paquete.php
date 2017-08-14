<?php 
echo "<pre>";
print_r($paquete);
echo "</pre>";

$itinerarios = $paquete['itinerarios'];
/*echo "<pre>";
print_r($itinerarios);
echo "</pre>";*/
?>
<section class="main-container cont-detail">
  <div class="row">
      <div class="col-md-8">
        <h1><?php echo $paquete['nombre'];?> <span><?php echo $paquete['precio'];?></span></h1>
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
          <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
              <div class="cont-icono">
                <i class="fa fa-bed" aria-hidden="true"></i>
                <div class="clearfix"></div>
                <h4>Estadia</h4>
                <p>Si incluye</p>
              </div>
            </div>

            <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
              <div class="cont-icono">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                <div class="clearfix"></div>
                <h4>Duración</h4>
                <p>4 Días</p>
              </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-12 col-lg-12">
              <div class="cont-icono">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <div class="clearfix"></div>
                <h4>Provincia</h4>
                <p>Cusco</p>
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
        <p>DESCRIPCIÓN Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
        </p>
        </div>
        <!--//Descripción-->

        <!--Itinerario-->
        <div class="tab-pane fade" role="tabpanel" id="itinerario" aria-labelledby="itinerario-tab">
        <p>ITINERARIO Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
        </p>
        </div>
        <!--//Itinerario-->

        <!--Formas de pago-->
        <div class="tab-pane fade" role="tabpanel" id="pago" aria-labelledby="pago-tab">
        <p>PAGO Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
        </p>
        </div>
        <!--//Formas de pago-->

      </div>

      </div>
      </div>
      <!-- //Tabs-->

    </div>
    <div class="col-md-4">
      <?php
//$paises = getPaises();
?>
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
    /*if(!empty($paises)){
      foreach ($paises as $key => $pais) {
        echo '<option value="'.$pais['name'].'">'.$pais['name'].'</option>';
      }
    }*/
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