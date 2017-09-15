<?php
$website_info = $this->website_info;
?>
<?php
/*echo "<pre>";
print_r($hotel);
echo "</pre>";*/
?>
<section class="main-container-pages cont-detail">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <h1>Contáctenos</h1>
      <p>Si usted desea comunicarse con nosotros rellenane el siguiente formulario, estamos atentos para atender sus dudas y consultas.</p>
      <?php
      if($_GET['send'] == 'ack'){
      ?>
      <div class="alert alert-success" role="alert"><i class="fa fa-smile-o" aria-hidden="true"></i> <strong>Gracias por contactarnos!</strong> en breve responderemos su mensaje. </div>
      <?php
    }
      ?>

      <div class="form">
        <form name="form-contactanos" id="form-contactanos" method="post" data-toggle="validator">
          <?php //echo validation_errors(); ?>
          <div class="form-group">
            <label for="nombre">Nombre y Apellidos</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres y apellidos" required>
          </div>
          <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Ejm.: juanjus98@gmail.como" required>
          </div>
          <div class="form-group">
            <label for="telefono">Celular / Telf.</label>
            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ejm.: +51 748 7755" required>
          </div>
          <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje" rows="8" class="form-control"></textarea>
          </div>
          <div class="clearfix"></div>
          <div class="pull-right">
            <button type="submit" class="btn btn-primary-1"><i class="fa fa-envelope-o" aria-hidden="true"></i> Enviar<span></span></button>
          </div>
          <div class="clearfix"></div>
        </form>
      </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h1>Tupay Travel.</h1>
        <p>
          <?php echo $website_info['title'];?>
        </p>
        <div class="datos-contacto">
          <span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $website_info['direccion'];?></span><br>
          <span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $website_info['telefono_2'];?></span><br>
          <span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $website_info['telefono_2'];?></span><br>
          <span><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $website_info['email_1'];?></span><br><br>
          <span>
            <i class="fa fa-facebook-official" aria-hidden="true"></i> /
            <a href="https://www.facebook.com/<?php echo $website_info['url_facebook'];?>" target="_blank">
              <?php echo $website_info['url_facebook'];?>
            </a>
          </span><br>

          <span>
            <i class="fa fa-skype" aria-hidden="true"> /
            <a href="skype:<?php echo $website_info['skype'];?>?call" target="_blank" title="Hablemos por skype"></i> <?php echo $website_info['skype'];?></a>
          </span>

          <br>
          
        </div>
      </div>
    </div>

  </section>
  <?php
  /*echo "<pre>";
  print_r($website_info);
  echo "</pre>";*/
  ?>
