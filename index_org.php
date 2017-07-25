<?php
session_start();
include("conectar.php");
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
?>
<!DOCTYPE html>
<html lang="en" class=" responsejs ">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Tupay Travel - Agencia de Viajes de Cusco y Machupicchu - Perú</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tupay Travel - Agencia de Viajes de Cusco - Perú: Whatsapp: +51988878850 / +51984786422, llama Ahora! conoce Machupicchu con la mejor Agencia del Cusco.">
    <meta name="author" content="GcmSystem.Com">
    <meta name="keywords" content="tours en cusco, tours a machupicchu, agencia de viaje en cusco, travel cusco, turismo en machupicchu, turist cusco.">
    <link id="switch_style" href="./css/real_estate.css" rel="stylesheet">
    <link href="./css/theme.css" rel="stylesheet">
</head>
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
                <img src="images/peru.png" alt="Perú" height="27" width="59" style="float: left;"/>
                <label>+51988878850 / +51984786422</label>
                
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
	    <div class="col-sm-5 hidden-xs home_form">
		<div class="col-sm-12 well lform">
                    <div class="row">
                        <form class="form-vertical" name="buscador" id="buscador" action="listado.php" method="post">
			<fieldset>
                            <div class="col-sm-12">
				<div class="form-group">
                                    <label>Inicio de Tours desde Lima - Perú</label>
                                    <div class="input-group date" id="datetimepicker1">
                                        <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" value="" >
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Fin de Tours desde Lima - Perú</label>
                                    <div class="input-group date" id="datetimepicker2">
                                        <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" value="">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
				<div class="row">						  
                                    <div class="col-sm-6">	
                                       <div class="form-group">
                                            <label>Cantidad de Personas</label>
                                            <input type="text" id="personas" name="personas" class="form-control">  
                                        </div>
                                    </div>
                                    <div class="col-sm-6">	
                                       <div class="form-group">
                                            <label>Nacionalidad</label>
                                            <input type="text" id="nacionalidad" name="nacionalidad" class="form-control">  
                                        </div>
                                    </div>
				</div>
                                <div class="row">						  
                                    <div class="col-sm-4">
                                       <label>Con Estadia</label>
                                    </div>
                                    <div class="col-md-1" style="width: auto">
                                        <label>
                                          <input type="radio" name="estadia" id="estadia1" value="Si" checked>
                                          Si
                                        </label>
                                    </div>
                                    <div class="col-md-1" style="width: auto">
                                        <label>
                                          <input type="radio" name="estadia" id="estadia2" value="No">
                                          No
                                        </label> 
                                    </div>		
				</div>
                            </div>
                            <div class="row">	
                                <div class="col-sm-6 pull-right" style="margin-top: 10px;">
                                  <button id="buscar" class="btn btn-primary pull-right" type="submit">Buscar</button>
                                 </div>
                            </div>												
			</fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-7 col-xs-12 no_margin_left home_carousel pull-right">
                <div class="col-md-6">
                    <h3 class="hidden-xs"><strong>Ofertas Machupicchu..!</strong></h3>
                    <a href="http://tupaytravel.com/detalle_tour.php?id=32" target="_blank"><img src="./images/machupicchu.jpg" alt="" width="250" height="250"></a>		</div>		
                    <div class="col-md-6">
                            <h3 class="hidden-xs"><strong>Ofertas Valle Sagrado..!</strong></h3>
                            <a href="http://tupaytravel.com/detalle_tour.php?id=29" target="_blank"><img src="./images/ofertas.gif" alt="" width="250" height="250"></a>                    </div>
<!--              <div id="owl-demo" class="owl-carousel owl-theme">
                <div class="item"><img src="./images/carousel_1.jpg" alt="The Last of us"></div>
                <div class="item"><img src="./images/carousel_2.jpg" alt="GTA V"></div>
                <div class="item"><img src="./images/carousel_3.jpg" alt="Mirror Edge"></div>
              </div>-->
            </div>
</div>

<div class="row home-latest">
			
	<div class="col-md-4" style="margin-rigth:5px;">
		<h3 class="hidden-xs">Recomendaciones</h3>
                <iframe class="youtube-player" type="text/html" width="300" height="150" src="http://www.youtube.com/embed/nhlUGUQqb-c" frameborder="0"></iframe>
        </div>		
	<div class="col-md-4">
		<h3 class="hidden-xs">Recomendaciones</h3>
                <iframe class="youtube-player" type="text/html" width="300" height="150" src="http://www.youtube.com/embed/JQceQeFFGx0" frameborder="0"></iframe>
                
		
	</div>
        <div class="col-md-4">
         <h3 class="hidden-xs">Recomendaciones</h3>
         <iframe class="youtube-player" type="text/html" width="300" height="150" src="http://www.youtube.com/embed/zsKAfqLrOcs" frameborder="0"></iframe>
         
	</div>
    
        <div align="right"><a href="https://www.youtube.com/channel/UCRIeYohcJ_u31-wDiOwRAFA" target="_blank"><img src="images/ver-mas.png" alt="Ver mas videos"></a>        </div>
</div>
<!--<div class="row home-latest" style="margin-top: 10px;margin-left: 5px;">
			
	<div class="col-md-22">
            <img src="./images/foto1.jpg" style="width:200px; height:200px"> 
        </div>
        <div class="col-md-22">
            <img src="./images/foto2.jpg" style="width:200px; height:200px"> 
        </div>
	<div class="col-md-22">
            <img src="./images/foto3.jpg" style="width:200px; height:200px"> 
        </div>
        <div class="col-md-22" >
            <img src="./images/foto4.jpg" style="width:200px; height:200px"> 
        </div>
        <div class="col-md-222">
            <img src="./images/foto5.jpg" style="width:200px; height:200px"> 
        </div>
</div>	 -->

<p>CERTIFICADOS Y LICENCIAS</p>

<a href="http://tupaytravel.com/images/tupay-documento.jpg" target="_blank"><img src="images/tupay-documento-peque.jpg"></a><img src="images/tupay-documento1peque.jpg" border="0" usemap="#Map">
<map name="Map"><area shape="rect" coords="344,299,468,330" href="http://tupaytravel.com/images/tupay-documento1.jpg" target="_blank">
</map>

<footer>
	<hr>	
        <div class="row" >
            <div class="col-md-1"><a href="">Inicio</a> |
		<a href="contacto.php">Contactenos</a><br>
		
            </div>
            <div class="col-md-4" style="float: right;">
              <div class="col-xs-12" style="width: auto;"><a href="#" class="normaltip"><img src="images/paypal.png" alt=""></a></div>
              <div class="col-xs-12" style="width: auto;"><a href="#" class="normaltip"><img src="images/maestro.png" alt=""></a></div>
              <div class="col-xs-12" style="width: auto;"><a href="#" class="normaltip"><img src="images/mastercard.png" alt=""></a></div>
              <div class="col-xs-12" style="width: auto;"><a href="#" class="normaltip"><img src="images/visa.png" alt=""></a></div>
            </div>
        </div>
	
</footer>

</div> 

<script type="text/javascript" src="./js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="./js/response.min.js"></script>
<link rel="stylesheet" href="./css/style.css">
    <script type="text/javascript" src="./js/bootstrap.js"></script>


<link rel="stylesheet" type="text/css" href="./libs/datepicker/css/jquery.datetimepicker.css" />
<script src="./libs/datepicker/js/jquery.datetimepicker.full.js"></script>

<script>
jQuery('#fecha_inicio').datetimepicker({
  format:'d-m-Y',
  formatDate:'d-m-Y',
  onShow:function( ct ){
   this.setOptions({
    maxDate:jQuery('#fecha_fin').val()?jQuery('#fecha_fin').val():false
   })
  },
  timepicker:false
 });

 jQuery('#fecha_fin').datetimepicker({
  format:'d-m-Y',
  formatDate:'d-m-Y',
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('#fecha_inicio').val()?jQuery('#fecha_inicio').val():false
   })
  },
  timepicker:false
 });



$('#buscar').on('click',function(event){
    event.preventDefault()
    if($('#fecha_inicio').val()!="" && $('#fecha_fin').val()!="")
    {
        $('form#buscador').submit();
    }
    else
    {
        alert('Inserte las fechas en el buscador');
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