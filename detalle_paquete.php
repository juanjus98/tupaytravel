<?php
session_start();
include("conectar.php");
include("funciones.php");
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
$fecha_inicio=$_SESSION['fecha_inicio'];

//id_paquete
$id_paquete = $_REQUEST['id_paquete'];
?>

<!DOCTYPE html>
<!-- saved from url=(0069)http://templates.expresspixel.com/bootstrap_real_estate/listings.html -->
<html lang="en" class=" responsejs "><head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<head>
  <base href="<?php echo MURL;?>">
  <title>Detalle Paquete</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link id="switch_style" href="./css/real_estate.css" rel="stylesheet">
  <link href="./css/theme.css" rel="stylesheet">
  <!-- <script type="text/javascript" src="./js/jquery-1.11.0.min.js"></script> -->
  <!-- <script type="text/javascript" src="./js/response.min.js"></script> -->

  <link rel="stylesheet" href="./css/style.css">
  <!-- <script type="text/javascript" src="./js/bootstrap.js"></script> -->
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

      <div class="row ">
        <div class="col-sm-8">

          <?php 
          $sql1="SELECT tblpaquete_tour.*,tblpaquete.nombre as name FROM tblpaquete_tour inner join tblpaquete on tblpaquete_tour.id_paquete=tblpaquete.id where id_paquete='".$id_paquete."'";
          $query1=mysql_query($sql1,$link);
          $dia=1;
          $j=0;
          while($com1=mysql_fetch_array($query1))
          {
           if($j==0)
           {
             echo '<div class="row"><div class="col-md-9"><h3 class="titulo_opciones">'.strtoupper($com1['name']).'</h2></div>';
             echo '<div class="col-md-3"><a href="#" id="'.$id_paquete.'" class="comprar btn btn-block btn-cotizar" role="button" data-toggle="modal" data-target="#mymodal">Cotizar</a></div><div class="clearfix"></div></div>';
             $j=1;
           }
           ?>
           <div class="row">
             <div class="col-md-12">
              <h3 style="color:#c9d74e;background-color: #392713;"><?php echo $fecha_inicio; ?></h3>
              <?php $fecha_inicio= date("d-m-Y", strtotime("$fecha_inicio + 1 days")); ?>
              <p><?php echo $com1['detalle'];?></p>
            </div>
          </div>

          <?php } ?>

          <div class="row">
            <div class="col-sm-4 col-md-offset-3" style="margin-bottom: 100px;">
              <button id="<?php echo $id_paquete?>" class="comprar btn btn-cotizar pull-right" type="button" data-toggle="modal" data-target="#mymodal">Cotizar</button>
            </div>
          </div>

        </div>
        <div class="col-sm-4">
          <h4 class="col-sm-12 well" data-toggle="collapse" data-target="#filters">Galer&iacute;a</h4>
          <?php
  //Consultar galería
          $sql_gal="SELECT * FROM tblpaquete_galeria where id_tblpaquete='".$id_paquete."'";
          $query_gal=mysql_query($sql_gal,$link);
          if(mysql_num_rows($query_gal) > 0){
           ?>
           <div class="row">
            <?php
            while ($fs_gal = mysql_fetch_array($query_gal)) {
              ?>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div style="margin: 10px 0;">
               <a class="fancybox" href="images/uploads/<?php echo $fs_gal['nombre_imagen'];?>" data-fancybox-group="gallery_<?php echo $n_opcion;?>" title="<?php echo $fs_gal['titulo'];?>"><img src="images/uploads/<?php echo $fs_gal['nombre_imagen'];?>" class="img-responsive" alt="<?php echo $fs_gal['titulo'];?>"></a>
               </div>
             </div>
             <?php } ?>
           </div>
           <?php }else { ?>
           <b>Sin galer&iacute;a.</b>
           <?php }?>
    <!-- <div class="row ">
      <h4 class="col-sm-12 well" data-toggle="collapse" data-target="#filters">Recomendaciones</h4>
      <div class="col-sm-12 well collapse in" id="filters" style="height: auto;">
        <iframe class="youtube-player" type="text/html" width="250" height="150" src="http://www.youtube.com/embed/fFIV1JwtNXI" frameborder="0"></iframe>
      </div>
    </div>
    <div class="row">
      <h4 class="col-sm-12 well" data-toggle="collapse" data-target="#location">Recomendaciones</h4>
      <div class="col-sm-12  well collapse in" id="location" style="height: auto;">
       <iframe class="youtube-player" type="text/html" width="250" height="150" src="http://www.youtube.com/embed/Nek7ILr_NoU" frameborder="0"></iframe>

     </div>
   </div>

   <div class="row hidden-xs">
    <h4 class="col-sm-12 well">Recomendaciones</h4>
    <div class="col-sm-12  well">
      <iframe class="youtube-player" type="text/html" width="250" height="150" src="http://www.youtube.com/embed/dDxmebLIsVc" frameborder="0"></iframe>
    </div>
  </div> -->		


</div>


</div>

<?php include('i_footer.php');?>

<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #C4DB28;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Pedir Cotizaci&#243;n</h4>
      </div>
      <div class="modal-body">
        <form name="inscripcion" id="form_inscripcion" class="form-horizontal" action="inscripcion.php" method="post">

          <table class="table">
            <thead>
              <tr>
                <th colspan="2">Este programa inicia desde su recojo en el aeropuerto de Lima-Per&uacute;, el cual no incluye vuelos internacionales. Si desea incluirlos marque la opci&oacute;n.</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th style="width: 35%;"><label for="pais_origen" class="pull-right">Con vuelos internacionales: </label></th>
                <td>
                  <label class="radio-inline">
                    <input type="radio" name="vuelos_internacionales" id="vuelos_internacionales1" value="SI" checked> <b>SI</b>
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="vuelos_internacionales" id="vuelos_internacionale2" value="NO"> <b>NO</b>
                  </label>
                </td>
              </tr>
              <tr class="fix_vuelos_internacionales">
                <th><label for="pais_origen" class="pull-right">Pa&iacute;s de origen: </label></th>
                <td class="campo"><input name="pais_origen" type="text" class="form-control" id="pais_origen"></td>
              </tr>
              <tr class="fix_vuelos_internacionales">
                <th><label for="ciudad_origen" class="pull-right">Ciudad de origen: </label></th>
                <td class="campo"><input name="ciudad_origen" type="text" class="form-control" id="ciudad_origen"></td>
              </tr>
              <tr>
                <th><label for="fechas" class="pull-right">Fechas Elegidas: </label></th>
                <td><?php echo $_SESSION['fecha_inicio'].' al '.$_SESSION['fecha_fin']?></td>
              </tr>
              <tr>
                <th><label for="personas" class="pull-right">Cantidad de Personas: </label></th>
                <td><?php echo $_SESSION['personas'];?></td>
              </tr>
              <tr>
                <th><label for="personas" class="pull-right">Nacionalidad: </label></th>
                <td><?php echo $_SESSION['nacionalidad'];?></td>
              </tr>
              <tr>
                <th><label for="personas" class="pull-right">Estadia: </label></th>
                <td><?php echo $_SESSION['estadia'];?></td>
              </tr>
              <tr>
                <th><label for="nombre" class="pull-right">Nombre y Apellidos: </label></th>
                <td class="campo"><input name="nombre" type="text" class="form-control" id="nombre"></td>
              </tr>
              <tr>
                <th><label for="movil" class="pull-right">Movil: </label></th>
                <td class="campo"><input name="movil" type="text" class="form-control" id="movil"></td>
              </tr>
              <tr>
                <th><label for="email" class="pull-right">Email: </label></th>
                <td class="campo"><input name="email" type="text" class="form-control" id="email"></td>
              </tr>
              <tr>
                <th><label for="comentario1" class="pull-right">Comentario: </label></th>
                <td class="campo">
                  <!-- <input name="comentario1" type="text" class="form-control" id="comentario1"> -->
                  <textarea class="form-control" id="comentario1" name="comentario1"></textarea>
                </td>
              </tr>

              <tr>
                <th><label for="Enciar" class="pull-right"></label></th>
                <td>
                  <button type="submit" class="btn btn-cotizar">Enviar</button> 
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </td>
              </tr>
            </tbody>
          </table>

          <input name="id_paquete" value="<?php echo $id_paquete?>" type="hidden" style="min-width: 150px;width: 200px;" id="id_paquete">
        </form>
      </div>
 <!-- <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
  <button type="submit" class="btn btn-default">Enviar</button>
</div> -->
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</div> <!-- /container -->
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
            movil: {
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