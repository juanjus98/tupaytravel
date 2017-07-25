<?php
session_start();
include("conectar.php");
include("funciones.php");
require_once __DIR__ . '/libs/function.video.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
?>
<!DOCTYPE html>
<html lang="es" class="responsejs">
<head>
  <?php include('i_head.php');?>
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
     <div class="col-sm-5 hidden-xs home_form">
      <div class="col-sm-12 well lform">
        <div class="row">
          <form class="form-vertical" name="buscador" id="buscador" action="tours/" method="post">
           <fieldset>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Inicio de Tour desde Lima - Perú</label>
                <div class="input-group date">
                  <input type="text" class="form-control" name="fecha_inicio" id="date_from" value="" >
                  <span class="input-group-addon">
                    <a href="#" id="fecha_inicio_show"><span class="glyphicon glyphicon-calendar"></span></a>
                  </span>
                </div>
              </div>
              
              <div class="form-group">
                <label>Fin de Tour desde Lima - Perú</label>
                <div class="input-group date">
                  <input type="text" class="form-control" name="fecha_fin" id="date_to" value="">
                  <span class="input-group-addon">
                    <a href="#" id="fecha_fin_show"><span class="glyphicon glyphicon-calendar"></span></a>
                  </span>
                </div>
              </div>
              
              <div class="row mrg-bot-15">						  
                <div class="col-md-12">	
                  <label>Nacionalidad</label>
                  <input type="text" id="nacionalidad" name="nacionalidad" class="form-control">
                </div>
              </div>

              <div class="row">
                <div class="col-xs-3">
                  <label class="text-center btn-block">Adultos</label>
                  <select name="adultos" id="adultos" class="form-control" placeholder="+18 años">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                  <p class="help-block text-center">+18 años.</p>
                </div>

                <div class="col-xs-3">
                  <label class="text-center btn-block">Adolecentes</label>
                  <select name="adolecentes" id="adolecentes" class="form-control" placeholder="12-17">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                  <p class="help-block text-center">12-17</p>
                </div>
                
                <div class="col-xs-3">
                  <label class="text-center btn-block">Ñiños</label>
                  <select name="ninios" id="ninios" class="form-control" placeholder="8-11">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                  <p class="help-block text-center">8-11</p>
                </div>

                <div class="col-xs-3">
                  <label class="text-center btn-block">Infantes</label>
                  <select name="infantes" id="infantes" class="form-control" placeholder="3-7">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                  <p class="help-block text-center">3-7</p>
                </div>
              </div>

              <div class="row mrg-bot-15">
                <div class="col-md-12">
                  <label>¿Con Estadia?</label> &nbsp;&nbsp;&nbsp;
                  <label class="radio-inline">
                    <input type="radio" name="estadia" id="estadia1" value="Si" checked> SI
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="estadia" id="estadia2" value="No"> NO
                  </label>
                </div>
              </div>

              
              <div class="row">	
                <div class="col-md-12">
                  <button id="buscar" class="btn btn-primary btn-block" type="submit">Buscar tours</button>
                </div>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8 col-sm-7 col-xs-12 no_margin_left home_carousel">
    <h3 class="titulo_opciones" style="margin-bottom: 10px; border-bottom: solid 4px #cd1;">Nuestras promociones:</h3>
    <?php include('i_promociones.php');?>
  </div>
</div>

<?php
include('i_videos_slider.php');
?>

<?php
include('i_fotos_slider.php');
?>

<div class="box-formas-pago text-center">
  <a href="http://tupaytravel.com/p/formas-de-pago" class="btn btn-lg btn-pagos" title="Formas de pago.">
    <i class="fa fa-credit-card" aria-hidden="true"></i> Formas de pago.
  </a>
</div>

<p>CERTIFICADOS Y LICENCIAS</p>

<a href="http://tupaytravel.com/images/tupay-documento.jpg" target="_blank"><img src="images/tupay-documento-peque.jpg"></a><img src="images/tupay-documento1peque.jpg" border="0" usemap="#Map">
<map name="Map"><area shape="rect" coords="344,299,468,330" href="http://tupaytravel.com/images/tupay-documento1.jpg" target="_blank">
</map>

<?php include('i_footer.php');?>

</div>

<div class="cont-multichat">
  <a href="https://m.me/tupay.travel" target="_blank">
    <!-- <a href="//www.fb.com/msg/tupay.travel" target="_blank"> -->
    <img src="images/icon-messenger48.png">
  </a>
  <a href="https://api.whatsapp.com/send?phone=51988878850" target="_blank">
    <img src="images/icon-whatsapp48.png">
  </a>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- <script type="text/javascript" src="./js/response.min.js"></script> -->
<!-- <link rel="stylesheet" href="./css/style.css"> -->
<script type="text/javascript" src="./js/bootstrap.js"></script>


<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="./js/lightslider/js/lightslider.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="js/fancybox/lib/jquery.mousewheel.pack.js?v=3.1.3"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" /> 

<script type="text/javascript">

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
    $("#content-slider").lightSlider({
      loop:true,
      auto:true,
      item:4,
      slideMove:2,
      easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
      speed:600,
      pauseOnHover: true,
      pager: false,
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
    });

    //Galería de fotos.
    $("#content-slider-fotos").lightSlider({
      loop:true,
      auto:true,
      item:4,
      slideMove:2,
      easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
      speed:600,
      pauseOnHover: true,
      pager: false,
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
    });

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

    var dateFormat = "dd-mm-yy",
    from = $( "#date_from" )
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
    to = $( "#date_to" ).datepicker({
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
      $("#date_from").datepicker("show");
    });

    $("#fecha_fin_show").click(function() {
      console.log("open 2");
      $("#date_to").datepicker("show");
    });


    $('#buscar').on('click',function(event){
      event.preventDefault()
      //Validar
      if($('#date_from').val()==""){
        alert('Seleccionar Fecha Inicio de Tour');
        $('#date_from').focus();
        return false;
      }

      if($('#date_to').val()==""){
        alert('Seleccionar Fecha Fin de Tour');
        $('#date_to').focus();
        return false;
      }

      if($('select#adultos').val() == "0"){
        alert('Debe seleccionar al menos un Adulto');
        $('select#adultos').focus();
        return false;
      }

      $('form#buscador').submit();

      /*if($('#date_from').val()!="" && $('#date_to').val()!=""){
        $('form#buscador').submit();
      } else{
        alert('Inserte las fechas en el buscador');
      }*/

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