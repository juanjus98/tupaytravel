<?php
include("conectar.php");
include("funciones.php");
require_once __DIR__ . '/libs/function.video.php';
require_once __DIR__ . '/libs/nocsrf.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
?>
<!DOCTYPE html>
<!-- saved from url=(0069)http://templates.expresspixel.com/bootstrap_real_estate/listings.html -->
<html lang="en" class=" responsejs "><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
    <meta charset="utf-8">
    <title>Contacto</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link id="switch_style" href="./css/real_estate.css" rel="stylesheet">
    <link href="./css/theme.css" rel="stylesheet">
 

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
             <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Formulario de Contacto</h3>
                </div>
                <div class="panel-body">
             <form name="contacto" class="form-horizontal" id="form-contactanos" action="enviar_contacto.php" method="post">
                           
               <div class="form-group">
                <label for="nombre" class="col-sm-4 control-label">Nombre y Apellidos:</label>
                <div class="col-sm-8 form-campo">
                   <input name="nombre" type="text" style="width: 250px;" class="form-control" id="nombre">
                </div>
              </div>
              <div class="form-group">
                <label for="movil" class="col-sm-4 control-label">Movil:</label>
                <div class="col-sm-8 form-campo">
                   <input name="movil" type="text" style="width: 250px;" class="form-control" id="movil" >
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-4 control-label">Email:</label>
                <div class="col-sm-8 form-campo">
                   <input name="email" type="text" style="width: 250px;" class="form-control" id="email">
                </div>
              </div>
              <div class="form-group">
                <label for="nacionalidad" class="col-sm-4 control-label">Nacionalidad:</label>
                <div class="col-sm-8 form-campo">
                   <input name="nacionalidad" type="text" style="width: 250px;" class="form-control" id="nacionalidad">
                </div>
              </div>
               <div class="form-group">
                <label for="email" class="col-sm-4 control-label">Comentario:</label>
                <div class="col-sm-8 form-campo">
                    <textarea name="comentario" type="text" style="width: 250px;" rows="6" class="form-control" id="comentario"></textarea>
                </div>
              </div>
                 <div class="col-md-4" style="float: right;"> <button type="submit" name="enviar" class="btn btn-default" data-dismiss="modal">Enviar</button></div>
             </form>
                </div>
             </div>
            </div>
     
            <div class="col-sm-4">
         <?php include('i_videos_right.php');?>
       </div>
	
            
        </div>
      
 <?php include('i_footer.php');?>

</div> <!-- /container -->
<script type="text/javascript" src="./js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="./js/response.min.js"></script>
<link rel="stylesheet" href="./css/style.css">
<script type="text/javascript" src="./js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="./libs/datepicker/css/jquery.datetimepicker.css" />
<script src="./libs/datepicker/js/jquery.datetimepicker.full.js"></script>

 <!-- Add mousewheel plugin (this is optional) -->
 <script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel.pack.js?v=3.1.3"></script>

 <!-- Add fancyBox main JS and CSS files -->
 <script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
 <link rel="stylesheet" type="text/css" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

 <script type="text/javascript" src="js/formValidation/formValidation.js"></script>
 <script type="text/javascript" src="js/formValidation/framework/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
      /*
       *  Simple image gallery. Uses default settings
       */

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
    
     });

  /**
 * Validar Formulario #form-contactanos
 */
//Validar formulario
$('#form-contactanos').formValidation({
  framework: 'bootstrap',
  message: 'Valor no válido.',
        /*icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
          fields: {
            nombre: {
              row: '.form-campo',
              validators: {
                notEmpty: {
                  message: 'Ingrese Nombres y Apellidos.'
                }
              }
            },
            movil: {
              row: '.form-campo',
              validators: {
                notEmpty: {
                  message: 'Ingrese Movil.'
                }
              }
            },
            email: {
              row: '.form-campo',
              validators: {
                notEmpty: {
                  message: 'Ingrese un E-mail.'
                },
                emailAddress: {
                  message: 'Ingrese un E-mail válido.'
                }
              }
            },
            nacionalidad: {
              row: '.form-campo',
              validators: {
                notEmpty: {
                  message: 'Ingrese Nacionalidad.'
                }
              }
            }
          }
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