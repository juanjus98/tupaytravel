<section class="main-container">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <form class="form-vertical" name="buscador" id="buscador" action="paquetes" method="post">
       <fieldset class="form-home">
        <div class="form-group">
          <label>Inicio de Tour desde Lima - Perú</label>
          <div class="input-group date">
            <input type="text" class="form-control" name="fecha_inicio" id="date_from" value="" >
            <span class="input-group-addon">
              <a href="javascript:;" id="fecha_inicio_show">
                <!-- <span class="glyphicon glyphicon-calendar"></span> -->
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </a>
            </span>
          </div>
        </div>

        <div class="form-group">
          <label>Fin de Tour desde Lima - Perú</label>
          <div class="input-group date">
            <input type="text" class="form-control" name="fecha_fin" id="date_to" value="">
            <span class="input-group-addon">
              <a href="javascript:;" id="fecha_fin_show">
                <!-- <span class="glyphicon glyphicon-calendar"></span> -->
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </a>
            </span>
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Nacionalidad</label>
          <input type="text" id="nacionalidad" name="nacionalidad" class="form-control">
        </div>

        <div class="row">
          <div class="col-xs-3">
            <label class="text-center btn-block">Adultos</label>
            <select name="adultos" id="adultos" class="form-control" placeholder="+18 años">
              <option value="0">0</option>
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

        <div class="row mrg-bot-15">
          <div class="col-md-12">
            <label>¿Con Estadia?</label> &nbsp;&nbsp;&nbsp;
            <label class="radio-inline">
              <input type="radio" name="estadia" id="estadia1" value="Si" checked> SI
            </label>
            <label class="radio-inline">
              <input type="radio" name="estadia" id="estadia2" value="No"> NO
            </label>
          </div>
        </div>

        <div class="row"> 
          <div class="col-md-12">
            <button id="buscar" class="btn btn-primary-1 btn-block" type="submit"><i class="fa fa-search" aria-hidden="true"></i> BUSCAR TOUR</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
  <div class="col-md-8 col-sm-6">
    <h3 class="titulo_opciones">Nuestras promociones:</h3>
    <?php
    /*$sql_promociones="SELECT * FROM tblpromociones WHERE estado != 0 ORDER BY orden LIMIT 6";
    $rs_promociones=mysql_query($sql_promociones, $link);*/
    ?>
    <?php
    if(!empty($promociones)){
     ?>
     <div class="row">
       <?php
       /*while ($fs_promocion = mysql_fetch_array($rs_promociones)) {*/
        foreach ($promociones as $key => $value) {
          $tituloPromo = $value['titulo'];
          $urlImagen = base_url('assets/images/uploads/' . $value['imagen']);
         ?>
         <div class="col-xs-6 col-md-4">
          <a href="<?php echo $value['url'];?>" target="<?php echo $value['target'];?>">
            <div class="cont-promo">
             <span class="btn-block titulo-block"><?php echo $tituloPromo;?></span>
             <img src="<?php echo $urlImagen;?>" alt="<?php echo $tituloPromo;?>" class="img-responsive">
           </div>
         </a>
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

<!--Nos recomiendan-->
<div class="row">
  <div class="col-md-12">
    <?php include('includes/i_videos_slider.php');?>
  </div>
</div>

<!-- Paquetes, Tours y estadía-->
<div class="row">
  <div class="col-md-4">
    <?php include('includes/i_paquetes.php');?>
  </div>
  <div class="col-md-4">
    <?php include('includes/i_tours.php');?>
  </div>
  <div class="col-md-4">
    <?php include('includes/i_estadia.php');?>
  </div>
</div>

<!-- Bloques rápidos-->
<?php include('includes/i_boxes.php');?>

</section>