<?php
session_start();
include("conectar.php");
include("funciones.php");
require_once __DIR__ . '/libs/function.video.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
?>

<!DOCTYPE html>
<!-- saved from url=(0069)http://templates.expresspixel.com/bootstrap_real_estate/listings.html -->
<html lang="en" class=" responsejs "><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
  <base href="<?php echo MURL;?>">
  <meta charset="utf-8">
  <title>Listado de Hoteles</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link id="switch_style" href="./css/real_estate.css" rel="stylesheet">
  <link href="./css/theme.css" rel="stylesheet">
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
      <div class="col-md-8">
        <h3>
          <?php 
          $sql="Select provincia FROM tblprovincia WHERE id='".$_GET['id']."'";
          $query=mysql_query($sql,$link);
          while($com=mysql_fetch_array($query))
          {
            echo 'Listado de Hoteles en '.$com['provincia'];
          }
          ?>

        </h3>
      </div>

      <div class="row" style="padding: 20px">
        <ul class="nav nav-tabs" id="Tipos" role="tablist">
          <li role="presentation" class="active"><a href="#Hotel" aria-controls="profile" role="tab" data-toggle="tab">Hotel</a></li>
          <li role="presentation"><a href="#Alojamiento" aria-controls="home" role="tab" data-toggle="tab">Hostal</a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="Hotel">
            <ul class="tour-item">
              <?php 
              $sql1="Select tblhotel.* FROM tblhotel WHERE tipo='Hotel' AND id_provincia='".$_GET['id']."'";
              $query2=mysql_query($sql1,$link);

              while($com2=mysql_fetch_array($query2)){
                $url_detalle_hotel_2 = 'hotel/' . $com2['id_hotel'] . '/' . url_amigable($com2['nombre']) .'/';
                ?>
                <li>
                  <!-- <a href="hoteles.php?id=<?php echo $com2['id_hotel']?>" ><?php echo strtoupper($com2['nombre'])?></a> -->
                  <a href="<?php echo $url_detalle_hotel_2;?>" target="_self"><?php echo strtoupper($com2['nombre'])?></a>
                </li>
                <?php } ?>
              </ul>

            </div>

            <div role="tabpanel" class="tab-pane" id="Alojamiento">
              <ul>
                <?php  $sql1="Select tblhotel.* FROM tblhotel WHERE tipo='Hostal' AND id_provincia='".$_GET['id']."'";
                $query2=mysql_query($sql1,$link);
                while($com2=mysql_fetch_array($query2)) {
                  $url_detalle_hotel_1 = 'hotel/' . $com2['id_hotel'] . '/' . url_amigable($com2['nombre']) .'/';
                  ?>
                  <li>
                    <!-- <a href="hoteles.php?id=<?php echo $com2['id_hotel']?>" ><?php echo strtoupper($com2['nombre'])?></a> -->
                    <a href="<?php echo $url_detalle_hotel_1;?>" target="_self"><?php echo strtoupper($com2['nombre'])?></a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
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

 <!-- <link rel="stylesheet" type="text/css" href="./libs/datepicker/css/jquery.datetimepicker.css" />
 <script src="./libs/datepicker/js/jquery.datetimepicker.full.js"></script> -->

 <!-- Add mousewheel plugin (this is optional) -->
 <script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel.pack.js?v=3.1.3"></script>

 <!-- Add fancyBox main JS and CSS files -->
 <script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
 <link rel="stylesheet" type="text/css" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

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