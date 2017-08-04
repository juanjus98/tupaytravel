<?php
$website_info = $this->website_info;
?>
<section>
  <div class="linea-top"><!--Linea amarilla--></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clear-padd">
        <div class="cont_slide_2">
          <div class="img-slide">
            <img src="<?php echo base_url('images/slide/slide002.jpg');?>" class="img-responsive" alt="Titulo">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--BODY-->
  <div class="container-fluid body-page contactanos-page">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h1>CONTACTANOS</h1>
        <p class="lineas-tb">
          La ocación que sea siempre es especial y nosotros lo sabemos, contamos con los salones más exclusivos y el mejor equipo de trabajo para brindarte una velada al más alto estilo.<br/><br/>
          Somos la exelencia en eventos sociales y corporativos.
        </p>
        <div class="datos-contacto">
          <span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $website_info['telefono_1'];?></span><br>
          <span>
          <i class="fa fa-facebook-official" aria-hidden="true"></i> /
          <a href="https://www.facebook.com/<?php echo $website_info['url_facebook'];?>" target="_blank">
            <?php echo $website_info['url_facebook'];?>
            </a>
          </span>
          <br>
          <span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $website_info['direccion'];?></span>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="bg-form">
          <div class="white-line"><!--linea blanca--></div>
          <div class="form">
            <form name="form-contactanos" id="form-contactanos" action="" method="post">
            <?php //echo validation_errors(); ?>
            <div class="form-group">
              <label for="nombre">Nombre y Apellidos</label>
              <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Correo Electrónico</label>
              <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="telefono">Celular / Telf.</label>
              <input type="text" name="telefono" id="telefono" class="form-control">
            </div>
            <div class="form-group">
              <label for="mensaje">Mensaje</label>
              <textarea name="mensaje" id="mensaje" rows="8" class="form-control"></textarea>
            </div>
            <div class="clearfix"></div>
            <div class="pull-right">
              <button type="submit" class="btn hvr-buzz-out btn-enviar">Enviar<span></span></button>
            </div>
            <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--//BODY-->
</section>