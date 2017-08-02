<?php
session_start();
include("conectar.php");
include("funciones.php");
require_once __DIR__ . '/libs/function.video.php';
require_once __DIR__ . '/libs/nocsrf.php';

$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

/*echo $_GET['token'];*/

if($_POST){
  $fecha_inicio=$_POST['fecha_inicio'];
  $fecha_fin=$_POST['fecha_fin'];
  
  $adultos=$_POST['adultos'];
  $adolecentes=$_POST['adolecentes'];
  $ninios=$_POST['ninios'];
  $infantes=$_POST['infantes'];

  $estadia=$_POST['estadia'];
  $nacionalidad=$_POST['nacionalidad'];

  //Array datos de busqueda
  $busqueda = array(
    'fecha_inicio' => $fecha_inicio,
    'fecha_fin' => $fecha_fin,
    'adultos' => $adultos,
    'adolecentes' => $adolecentes,
    'ninios' => $ninios,
    'infantes' => $infantes,
    'estadia' => $estadia,
    'nacionalidad' => $nacionalidad
  );

  $busqueda_json = json_encode($busqueda);
  $token = NoCSRF::generate( 'csrf_token' );

  $sql="INSERT INTO tblbusqueda (token, busqueda, tipo) VALUES('$token','$busqueda_json','BUSQUEDA')";
  $res=mysql_query($sql, $link);

  $_SESSION['fecha_inicio']=$fecha_inicio;
  $_SESSION['fecha_fin']=$fecha_fin;
  $_SESSION['estadia']=$estadia;
  
  $_SESSION['adultos']=$adultos;
  $_SESSION['adolecentes']=$adolecentes;
  $_SESSION['ninios']=$ninios;
  $_SESSION['infantes']=$infantes;

  $_SESSION['nacionalidad']=$nacionalidad;

  $url_location = MURL . "tours/" .$token;

  header("Location: ".$url_location);

}else{
  $fecha_inicio=$_SESSION['fecha_inicio'];
  $fecha_fin=$_SESSION['fecha_fin'];
  
  $adultos=$_SESSION['adultos'];
  $adolecentes=$_SESSION['adolecentes'];
  $ninios=$_SESSION['ninios'];
  $infantes=$_SESSION['infantes'];

  $estadia=$_SESSION['estadia'];
  $nacionalidad=$_SESSION['nacionalidad']; 

  if(isset($_GET['token'])){
    $token = $_GET['token'];
    $sql="SELECT * FROM tblbusqueda WHERE token='$token'";
    $res=mysql_query($sql, $link);
    $fs = mysql_fetch_array($res);

    $busqueda = (array)json_decode($fs['busqueda']);

    $fecha_inicio=$busqueda['fecha_inicio'];
    $fecha_fin=$busqueda['fecha_fin'];

    $adultos=$busqueda['adultos'];
    $adolecentes=$busqueda['adolecentes'];
    $ninios=$busqueda['ninios'];
    $infantes=$busqueda['infantes'];

    $estadia=$busqueda['estadia'];
    $nacionalidad=$busqueda['nacionalidad']; 

  } 

}
?>

<!DOCTYPE html>
<html lang="en" class=" responsejs "><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
  <base href="<?php echo MURL;?>">
  <meta charset="utf-8">
  <title>Paquetes de Tours</title>
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


   <?php 
   $sql="SELECT count(tblpaquete_tour.id_paquete) as cant,tblpaquete_tour.id_paquete,tblpaquete.nombre as name,tblpaquete.orden, tblpaquete.precio
   FROM tblpaquete_tour 
   inner join tblpaquete on tblpaquete.id=tblpaquete_tour.id_paquete";
   $condicion=""; 

// if($personas!=null)
// {
// if($condicion==""){
// $condicion.=" WHERE tblpaquete.cantidad >=".$personas;
// }
// else {
// $condicion.=" and tblpaquete.cantidad >='".$personas."'"; 
// }
// }
// if($estadia!=null)
// {
// if($condicion==""){
// $condicion.=" WHERE tblpaquete.estadia ='".$estadia."'";
// }else{
// $condicion.=" and tblpaquete.estadia ='".$estadia."'";
// }
// }
   $sql.= $condicion . " GROUP BY tblpaquete_tour.id_paquete ";

   $fecha;
   if($fecha_inicio!=null && $fecha_fin!=null)
     { $fecha=$fecha_inicio;
       $datetime1 = new DateTime($fecha_inicio);
       $datetime2 = new DateTime($fecha_fin);
       $interval = $datetime2->diff($datetime1,true);
       $a=($interval->d)+1;
       $sql.= " HAVING count(tblpaquete_tour.id_paquete)= '".$a."'";
     }
     $sql.=" ORDER BY orden ASC";
     $query=mysql_query($sql,$link);
     if(mysql_num_rows($query)!=0)
     {
       echo '<h3 class="titulo_opciones">Encontramos estas opciones:</h3>';
     }
     else
     {
       echo '<h3>No se encontraron Resultados</h3>'; 
     }
     $n_opcion = 0;
     while($com=mysql_fetch_array($query))
     { 

      $fecha_inicio=$fecha;
      $n_opcion++;

      $url_paquete = 'paquete/' . $com['id_paquete'] . '/' . url_amigable($com['name']) .'/' . $token;

      ?>
      <div class="row">
       <div class="col-md-12">
       <a href="<?php echo $url_paquete;?>">
       <h4 class="n_opcion">Opción <?php echo $n_opcion;?></h4>
       </a>
       </div>
     </div>
     <?php
         //Consultar galería
     $sql_gal="SELECT * FROM tblpaquete_galeria where id_tblpaquete='".$com['id_paquete']."' Order By principal ASC, id Asc";
     $query_gal=mysql_query($sql_gal,$link);
     if(mysql_num_rows($query_gal) > 0){
       ?>
       <div class="row">
        <?php
        while ($fs_gal = mysql_fetch_array($query_gal)) {
          ?>
          <div class="col-md-3">
           <a class="fancybox" href="images/uploads/<?php echo $fs_gal['nombre_imagen'];?>" data-fancybox-group="gallery_<?php echo $n_opcion;?>" title="<?php echo $fs_gal['titulo'];?>"><img src="images/uploads/<?php echo $fs_gal['nombre_imagen'];?>" class="img-responsive" alt="<?php echo $fs_gal['titulo'];?>"></a>
         </div>
         <?php } ?>
       </div>
       <?php } ?>

       <div class="row" style="margin: 10px 0;">
         <!-- <form action="detalle_paquete.php" method="post"> -->

         <div class="clearfix"></div>

         <?php 
         echo '<a href="'.$url_paquete.'"><h3 class="to-emoji">'.$com['name'].'</h3></a>';
         $sql1="SELECT tblpaquete_tour.* FROM tblpaquete_tour where id_paquete='".$com['id_paquete']."'";
         $query1=mysql_query($sql1,$link);

         while($com1=mysql_fetch_array($query1))
         {
           echo "<strong>".$fecha_inicio.'</strong>'." ".$com1['nombre'];
           $fecha_inicio= date("d-m-Y", strtotime("$fecha_inicio + 1 days"));
           echo '</br>';

         }
         /*$url_paquete = 'paquete/' . $com['id_paquete'] . '/' . url_amigable($com['name']) .'/' . $token;*/
         ?> 
         <div class="row">
           <!-- <input name="id_paquete" id='id_paquete' type="hidden" value="<?php echo $com['id_paquete']?>" > -->
           <div class="col-sm-6 pull-right" style="margin-top: 10px;">
             <!-- <button id="<?php echo $com['id_paquete']?>" class="btn btn-primary pull-right" style="margin-left: 10px;" type="submit">Ver Detalles</button> -->
             <a href="<?php echo $url_paquete;?>" class="btn btn-primary pull-right" style="margin-left: 10px;">Ver Detalles</a>
             <?php
             if(!empty($com['precio'])){
               ?>
               <a href="javascript:;" class="btn btn-success pull-right">Precio <?php echo $com['precio'];?></a>
               <?php } ?>
             </div>
           </div>
           <!-- </form>  -->
         </div>
         <hr>   
         <?php } ?> 

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

 <script src="https://cdn.rawgit.com/ashleighy/emoji.js/master/emoji.js.js"></script>

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

$(function(){
$('.to-emoji').Emoji({
  path:  'images/emojione/apple40/',
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

 </body></html>