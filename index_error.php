<?php
session_start();
include("conectar.php");
include("funciones.php");
require_once __DIR__ . '/libs/function.video.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
?>
<!DOCTYPE html>
<html lang="en" class=" responsejs ">
<head>
  <base href="<?php echo MURL;?>">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Tupay Travel - Agencia de Viajes de Cusco y Machupicchu - Perú</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="Tupay Travel - Agencia de Viajes de Cusco - Perú: Whatsapp: +51988878850 / +51984786422, llama Ahora! conoce Machupicchu con la mejor Agencia del Cusco.">
  <meta name="author" content="GcmSystem.Com">
  <meta name="keywords" content="tours en cusco, tours a machupicchu, agencia de viaje en cusco, travel cusco, turismo en machupicchu, turist cusco.">
  <link id="switch_style" href="./css/real_estate.css" rel="stylesheet">
  <link href="./css/theme.css" rel="stylesheet">

  <!-- <link rel="stylesheet"  href="./js/lightslider/css/lightslider.css"/> -->
</head>
<body>
  <div class="container">
    <div class="row"><!-- start header -->
      <div class="col-sm-4 col-xs-6 logo">
        <a href="./" target="_self">
          <div class="row">
            <div class="col-sm-3 hidden-xs logo-img">
              <img src="images/logo_1.png" height="85" alt="">
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

      <!--   <div id="google_translate_element"></div><script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
      </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->

    </div>
  </div><!-- end header -->

  <div class="row"><!-- start nav -->
    <div class="col-sm-12">
      <?php include('i_navbar.php');?>
    </div>
  </div><!-- end nav -->		

  <div class="row">
   <div class="col-sm-5 hidden-xs home_form">
    <div class="col-sm-12 well lform">
      <div class="row">
        <form class="form-vertical" name="buscador" id="buscador" action="tours/" method="post">
         <fieldset>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Inicio de Tours desde Lima - Perú</label>
              <div class="input-group date">
                <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" id="from" value="" >
                <span class="input-group-addon">
                  <a href="#" id="fecha_inicio_show"><span class="glyphicon glyphicon-calendar"></span></a>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label>Fin de Tours desde Lima - Perú</label>
              <div class="input-group date">
                <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" id="to" value="">
                <span class="input-group-addon">
                  <a href="#" id="fecha_fin_show"><span class="glyphicon glyphicon-calendar"></span></a>
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

          <!-- <div class="row home-latest">

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

         <div align="right"><a href="https://www.youtube.com/channel/UCRIeYohcJ_u31-wDiOwRAFA" target="_blank">
           <img src="images/ver-mas.png" alt="Ver mas videos"></a>
         </div>

       </div> -->

       <?php
       //include('i_videos_slider.php');
       ?>

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
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

  <script type="text/javascript" src="./js/response.min.js"></script>
  <!-- <link rel="stylesheet" href="./css/style.css"> -->
  <script type="text/javascript" src="./js/bootstrap.js"></script>


  <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <!-- <script src="./js/lightslider/js/lightslider.js"></script> -->

  <!-- Add mousewheel plugin (this is optional) -->
  <!-- <script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel.pack.js?v=3.1.3"></script> -->

  <!-- Add fancyBox main JS and CSS files -->
 <!-- <script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
 <link rel="stylesheet" type="text/css" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />  -->

  <script>

    $.datepicker.regional['es'] = {
     closeText: 'Cerrar',
     prevText: '< Ant',
     nextText: 'Sig >',
     currentText: 'Hoy',
     monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
     monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
     dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
     dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
     dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
     weekHeader: 'Sm',
     dateFormat: 'dd-mm-yy',
     firstDay: 1,
     isRTL: false,
     showMonthAfterYear: false,
     yearSuffix: ''
   };
   $.datepicker.setDefaults($.datepicker.regional['es']);

   $(function() {

    console.log("Ready!");

    //Galería videos.
    /*$("#content-slider").lightSlider({
      loop:true,
      auto:true,
      item:4,
      slideMove:2,
      easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
      speed:600,
      responsive : [
      {
        breakpoint:800,
        settings: {
          item:3,
          slideMove:1,
          slideMargin:6,
        }
      },
      {
        breakpoint:480,
        settings: {
          item:2,
          slideMove:1
        }
      }
      ]
    });*/

    //Ver video fancybox
    /*$(".various").fancybox({
      maxWidth  : 800,
      maxHeight : 600,
      fitToView : false,
      width   : '70%',
      height    : '70%',
      autoSize  : false,
      closeClick  : false,
      openEffect  : 'none',
      closeEffect : 'none'
    });*/

    var dateFormat = "dd-mm-yy",
    from = $( "#from" )
    .datepicker({
      minDate: 0,
      defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1
    })
    .on( "change", function() {
      to.datepicker( "option", "minDate", getDate( this ) );
    }),
    to = $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      changeYear: true,
      numberOfMonths: 1
    })
    .on( "change", function() {
      from.datepicker( "option", "maxDate", getDate( this ) );
    });

    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }

      return date;
    };

    $("#fecha_inicio_show").click(function() {
      console.log("open 1");
      $("#from").datepicker("show");
    });

    $("#fecha_fin_show").click(function() {
      console.log("open 2");
      $("#to").datepicker("show");
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

  } );

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