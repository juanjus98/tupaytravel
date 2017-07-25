<?php
session_start();
include("conectar.php");
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

$fecha_inicio=$_POST['fecha_inicio'];
$fecha_fin=$_POST['fecha_fin'];
$personas=$_POST['personas'];
$estadia=$_POST['estadia'];
$nacionalidad=$_POST['nacionalidad'];

$_SESSION['fecha_inicio']=$fecha_inicio;
$_SESSION['fecha_fin']=$fecha_fin;
$_SESSION['estadia']=$estadia;
$_SESSION['personas']=$personas;
$_SESSION['nacionalidad']=$nacionalidad;
?>

<!DOCTYPE html>
<html lang="en" class=" responsejs "><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="utf-8">
<title>Paquetes de Tours</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link id="switch_style" href="./css/real_estate.css" rel="stylesheet">
<link href="./css/theme.css" rel="stylesheet">


<body>

 <div class="container">
  <div class="row"><!-- start header -->
   <div class="col-sm-4 col-xs-6 logo">
     <a href="">
       <div class="row">
         <div class="col-sm-3 hidden-xs logo-img">
           <img src="./images/logo_1.png" height="85" alt="">
         </div>
       </div>
     </a>
   </div>   
   <div class="col-sm-3 col-xs-6 customer_service pull-right">
     <h4><span class="hidden-xs">reservas@tupaytravel.com </span></h4>
     <h4><small>www.tupaytravel.com</small></h4>
     <a href="https://www.facebook.com/Tupay-Travel-959339647430909/?fref=ts">
       <img src="images/facebook.jpg" alt="Facebook" height="27" width="27" style="float: left;"/>
     </a>
     <img src="images/whatsapp.ico" alt="Whataapp" height="27" width="27" style="float: left;"/>
     <label>988878850/984786422</label>

     <div id="google_translate_element"></div><script type="text/javascript">
     function googleTranslateElementInit() {
       new google.translate.TranslateElement({pageLanguage: 'es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
     }
   </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

 </div>
</div><!-- end header -->

<div class="row"><!-- start nav -->
 <div class="col-sm-12">

   <nav class="navbar navbar-inverse" role="navigation">
     <div class="navbar-inner">
       <!-- Brand and toggle get grouped for better mobile display -->
       <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand visible-xs" href="#">Menu</a>
       </div>

       <!-- Collect the nav links, forms, and other content for toggling -->
       <div class="collapse navbar-collapse navbar-ex1-collapse">
         <ul class="nav navbar-nav">
           <li><a href="index.php">PAQUETES TOUR PERU</a></li>
           <li class="dropdown">
             <a href="listado_tours.php" class="dropdown-toggle" data-toggle="dropdown">TOUR <b class="caret"></b></a>
             <?php 
             $sql="Select * FROM tblprovincia";
             $query=mysql_query($sql,$link);
             echo '<ul class="dropdown-menu">';
             while($com=mysql_fetch_array($query))
             {
               echo '<li><a href="listado_tours.php?id='.$com['id'].'">'.$com['provincia'].'</a></li>';
             }
             echo '</ul>';
             ?>
           </li>
           <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown">ESTADIA <b class="caret"></b></a>
             <?php 
             $sql="Select * FROM tblprovincia";
             $query=mysql_query($sql,$link);
             echo '<ul class="dropdown-menu">';
             while($com=mysql_fetch_array($query))
             {
               echo '<li><a href="listado_hoteles.php?id='.$com['id'].'">'.$com['provincia'].'</a></li>';
             }
             echo '</ul>';
             ?>
           </li>
         </ul>
       </div>
     </div>
   </nav>
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
       { $fecha_inicio=$fecha;
         $n_opcion++;
         ?>
         <div class="row">
           <div class="col-md-12"><h4 class="n_opcion">Opción <?php echo $n_opcion;?></h4></div>
         </div>
         <?php
         //Consultar galería
         $sql_gal="SELECT * FROM tblpaquete_galeria where id_tblpaquete='".$com['id_paquete']."'";
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
           <form action="detalle_paquete.php" method="post">

             <div class="clearfix"></div>



             <?php 
             echo '<h3>'.$com['name'].'</h3>';
             $sql1="SELECT tblpaquete_tour.* FROM tblpaquete_tour where id_paquete='".$com['id_paquete']."'";
             $query1=mysql_query($sql1,$link);

             while($com1=mysql_fetch_array($query1))
             {
               echo "<strong>".$fecha_inicio.'</strong>'." ".$com1['nombre'];
               $fecha_inicio= date("d-m-Y", strtotime("$fecha_inicio + 1 days"));
               echo '</br>';

             }
             ?> 
             <div class="row">
               <input name="id_paquete" id='id_paquete' type="hidden" value="<?php echo $com['id_paquete']?>" >
               <div class="col-sm-6 pull-right" style="margin-top: 10px;">
                 <button id="<?php echo $com['id_paquete']?>" class="btn btn-primary pull-right" style="margin-left: 10px;" type="submit">Ver Detalles</button>
                 <?php
                 if(!empty($com['precio'])){
                   ?>
                   <a href="#" class="btn btn-success pull-right">Precio <?php echo $com['precio'];?></a>
                   <?php } ?>
                 </div>
               </div>
             </form> 
           </div>
           <hr>   
           <?php } ?> 

         </div>
         <div class="col-sm-4">
           <div class="col-sm-12">

             <div class="row ">
               <h4 class="col-sm-12 well" data-toggle="collapse" data-target="#filters">Recomendaciones</h4>
               <div class="col-sm-12 well collapse in" id="filters" style="height: auto;">
                 <iframe class="youtube-player" type="text/html" width="250" height="150" src="http://www.youtube.com/embed/fFIV1JwtNXI" frameborder="0"></iframe>
               </div>
             </div>
             <div class="row">
               <h4 class="col-sm-12 well" data-toggle="collapse" data-target="#location">Recomendaciones</h4>
               <div class="col-sm-12 well collapse in" id="location" style="height: auto;">
                 <iframe class="youtube-player" type="text/html" width="250" height="150" src="http://www.youtube.com/embed/Nek7ILr_NoU" frameborder="0"></iframe>

               </div>
             </div>

             <div class="row hidden-xs">
               <h4 class="col-sm-12 well">Recomendaciones</h4>
               <div class="col-sm-12 well">
                 <iframe class="youtube-player" type="text/html" width="250" height="150" src="http://www.youtube.com/embed/dDxmebLIsVc" frameborder="0"></iframe>
               </div>
             </div> 
           </div>
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