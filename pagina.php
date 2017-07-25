<?php
session_start();
include("conectar.php");
include("funciones.php");
require_once __DIR__ . '/libs/function.video.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

//Consultar página
$url_key = $_GET['url_key'];
$sql="Select * FROM tblpagina WHERE url_key='".$url_key."'";
$query1=mysql_query($sql,$link);
while($com1=mysql_fetch_array($query1)){
  $pagina_info = $com1;
}

/*echo "<pre>";
print_r($pagina_info);
echo "</pre>";*/
?>
<!DOCTYPE html>
<!-- saved from url=(0069)http://templates.expresspixel.com/bootstrap_real_estate/listings.html -->
<html lang="en" class=" responsejs "><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="utf-8">
<title><?php echo $pagina_info['titulo'];?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<base href="<?php echo MURL;?>">

<link id="switch_style" href="<?php echo MURL;?>css/real_estate.css" rel="stylesheet">
<link href="<?php echo MURL;?>css/theme.css" rel="stylesheet">
<link rel="stylesheet"  href="css/font-awesome.min.css"/>


<body>
	
  <div class="container">
   <?php include('i_header.php');?>

   <div class="row"><!-- start nav -->
    <div class="col-md-12">
      <?php include('i_navbar.php');?>
    </div>
  </div><!-- end nav -->	

  <div class="row">
    <div class="col-md-8">
      <h1 class="titulo-pagina text-center"><?php echo $pagina_info['titulo'];?></h1>
      <?php echo $pagina_info['descripcion'];?>

    <div class="text-center">
    <br>
      <a href="docs/confirmacion1.docx" target="_blank" class="btn btn-pagos" title="Descargar ficha.">
        <i class="fa fa-file-word-o" aria-hidden="true"></i> Descargar ficha.
      </a>
    </div>
    </div>

    <div class="col-md-4">
     <?php include('i_videos_right.php');?>
   </div>
 </div>

 <?php include('i_footer.php');?>

</div> <!-- /container -->
<script type="text/javascript" src="<?php echo MURL;?>js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo MURL;?>js/response.min.js"></script>
<link rel="stylesheet" href="<?php echo MURL;?>css/style.css">
<script type="text/javascript" src="<?php echo MURL;?>js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo MURL;?>libs/datepicker/css/jquery.datetimepicker.css" />
<script src="<?php echo MURL;?>libs/datepicker/js/jquery.datetimepicker.full.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?php echo MURL;?>js/fancybox/lib/jquery.mousewheel.pack.js?v=3.1.3"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo MURL;?>js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo MURL;?>js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript" src="<?php echo MURL;?>js/formValidation/formValidation.js"></script>
<script type="text/javascript" src="<?php echo MURL;?>js/formValidation/framework/bootstrap.min.js"></script>

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