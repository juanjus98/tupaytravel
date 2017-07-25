<?php
session_start();
include("conectar.php");
include("funciones.php");
require_once __DIR__ . '/libs/function.video.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
?>
<!DOCTYPE html>
<!-- saved from url=(0069)http://templates.expresspixel.com/bootstrap_real_estate/listings.html -->
<html lang="en" class=" responsejs "><head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
<head>

  <base href="<?php echo MURL;?>"> 
  <title>Detalle Tour</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link id="switch_style" href="./css/real_estate.css" rel="stylesheet">
  <link href="./css/theme.css" rel="stylesheet">
  <script type="text/javascript" src="./js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="./js/response.min.js"></script>
  <link rel="stylesheet" href="./css/style.css">
  <script type="text/javascript" src="./js/bootstrap.js"></script>
  <script type="text/javascript" src="./js/bootstrap-modal.js"></script>

  <!--Start of Zendesk Chat Script-->
  <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){
      z._.push(c)},$=z.s=
      d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
        $.src='https://v2.zopim.com/?4djBSec4OHl4b786bXDsRHxsqN4T47rj';z.t=+new Date;$.
        type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
      </script>
      <!--End of Zendesk Chat Script-->
    </head>


    <body>

      <div class="container">
       <?php include('i_header.php');?>

       <div class="row"><!-- start nav -->
        <div class="col-sm-12">
          <?php include('i_navbar.php');?>
        </div>
      </div><!-- end nav -->	

      <div class="row">
        <div class="col-sm-8">
          <br />	
          <?php 
          $sql="Select * FROM tbltours WHERE tbltours.id='".$_GET['id']."'";
          $query1=mysql_query($sql,$link);
          while($com1=mysql_fetch_array($query1))
          {
           ?>
           <div class="">
                    <!--div id="owl-demo" class="owl-carousel owl-theme">
                        <div class="item"><img src="images/imagen_tour/<?php echo $com1['imagen']?>" alt="0" style="width: 100%;height: 300px;"/></div>
                      </div-->
                      <p><?php echo $com1['detalle'];?></p>

                    </div>

                    <?php } ?>
                    <div class="col-sm-4 col-md-offset-3" style="margin-bottom: 100px;">
                      <button id="<?php echo $_GET['id']?>" class="comprar btn btn-cotizar pull-right" type="button" data-toggle="modal" data-target="#mymodal">Consultar</button>
                    </div>
                  </div>
                  <div class="col-sm-4">
                   <?php include('i_videos_right.php');?>
              </div>


            </div>

            <?php include('i_footer.php');?>

        </div> <!-- /container -->
        <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #C4DB28;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Consultar</h4>
              </div>
              <div class="modal-body">
                <form name="inscripcion" id="form_inscripcion" class="form-horizontal" action="inscripcion.php" method="post">

                  <div class="form-group">
                    <label for="nombre" class="col-sm-4 control-label">Nombre y Apellidos:</label>
                    <div class="col-sm-8 campo">
                     <input name="nombre" type="text" style="min-width: 150px;width: 200px;" class="form-control" id="nombre" >
                   </div>
                 </div>
                 <div class="form-group">
                  <label for="telefono" class="col-sm-4 control-label">Movil:</label>
                  <div class="col-sm-8 campo">
                   <input name="telefono" type="text" style="min-width: 150px;width: 200px;" class="form-control" id="telefono" >
                 </div>
               </div>
               <div class="form-group">
                <label for="email" class="col-sm-4 control-label">Email:</label>
                <div class="col-sm-8 campo">
                 <input name="email" type="text" style="min-width: 150px;width: 200px;" class="form-control" id="email" >
               </div>
             </div>
             <div class="form-group">
              <label for="nacionalidad" class="col-sm-4 control-label">Nacionalidad:</label>
              <div class="col-sm-8">
               <input name="nacionalidad" type="text" style="min-width: 150px;width: 200px;" class="form-control" id="nacionalidad">
             </div>
           </div>
           <div class="form-group">
            <label for="personas" class="col-sm-4 control-label">Personas:</label>
            <div class="col-sm-8">
             <input name="personas" type="text" style="min-width: 150px;width: 200px;" class="form-control" id="personas">
           </div>
         </div>
         <div class="form-group">
          <label for="comentario" class="col-sm-4 control-label">Comentario:</label>
          <div class="col-sm-8">
            <textarea name="comentario" type="text" style="min-width: 150px;width: 200px;" class="form-control" id="comentario"></textarea>
          </div>
        </div>
        <input name="id_tour" value="<?php echo $_GET['id']?>" type="hidden" style="width: 250px;" id="id_tour">


        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-10">
            <button type="submit" class="btn btn-cotizar">Enviar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>

      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-cotizar">Enviar</button>
      </div> -->
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script type="text/javascript" src="./js/jquery.min.js"></script>

<script type="text/javascript" src="./js/formValidation.js"></script>
<script type="text/javascript" src="./js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/bootstrap-modal.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel.pack.js?v=3.1.3"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript">
  $(function() {

    $('input[type=radio][name=vuelos_internacionales]').change(function() {
      if (this.value == 'SI') {
        $(".fix_vuelos_internacionales").fadeIn();
      }
      else if (this.value == 'NO') {
        $(".fix_vuelos_internacionales").fadeOut();
      }
    });

    $('.fancybox').fancybox();

    //Ver video fancybox
    $(".various").fancybox({
      maxWidth  : 800,
      maxHeight : 600,
      fitToView : false,
      width   : '70%',
      height    : '70%',
      autoSize  : false,
      closeClick  : false,
      openEffect  : 'none',
      closeEffect : 'none'
    });

    //Validar formulario
    $('#form_inscripcion').formValidation({
      message: 'Valor no válido.',
        /*icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
          },*/
          fields: {
            nombre: {
              row: '.campo',
              validators: {
                notEmpty: {
                  message: 'Por favor ingrese Nombres y Apellidos.'
                }
              }
            },
            telefono: {
              row: '.campo',
              validators: {
                notEmpty: {
                  message: 'Por favor ingrese Movil.'
                }
              }
            },
            email: {
              row: '.campo',
              validators: {
                notEmpty: {
                  message: 'Por favor ingrese E-mail.'
                },
                emailAddress: {
                  message: 'Por favor ingrese un E-mail válido.'
                }
              }
            }
          }
        });

  });
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-82619572-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>