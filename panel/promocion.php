<?php
include ("./../conectar.php");

$conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio</title>
  <link rel="icon" type="image/png" href="/images/favicon.ico" />
  <link rel="icon" type="image/png" href="/images/favicon.ico" />
  <script src="http://code.jquery.com/jquery.js"></script>
  <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
  <script src="../js/bootstrap.min.js"></script>
  <script src="./ckeditor/ckeditor.js"></script>
  <link rel="stylesheet" type="text/css" href="../libs/datepicker/css/jquery.datetimepicker.css" />
  <script src="../libs/datepicker/js/jquery.datetimepicker.full.js"></script>


  <style>
    .contenedor {
     margin:0 auto;
     width:85%;
     text-align:center;
   }

   li a{
     cursor:pointer;/*permite que se despliegue el dropdown en ipad, que sin esto no se muestra*/
   }
 </style>

</head>
<body background="../images/fondo.jpg">
  <div class="container">
   <div class="panel panel-primary">
    <div class="panel-heading">         
      <nav class="navbar navbar-default" role="navigation">

       <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="main.php" data-toggle="tooltip" data-placement="bottom" title="Ir al inicio"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
        </div>

  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
  otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">

      <li><a href="main.php"><strong>Paquetes Tour</strong></a></li>
      <li><a href="listado_tour.php"><strong>Tours</strong></a></li>
      <li><a href="listado_hoteles.php"><strong>Hoteles</strong></a></li>

      <li><a href="listado_videos.php"><strong>Videos</strong></a></li>

      <li><a href="listado_promociones.php"><strong>Promociones</strong></a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a class="navbar-brand" href="" data-toggle="tooltip" data-placement="bottom" title="Usuario conectado"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $user?></a></li>
      <li><a class="navbar-brand" href="index.php" data-toggle="tooltip" data-placement="bottom" title="Salir del sistema" ><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
    </ul>
  </div>
</nav>
</div>
</div>

<div class="panel-body">
  <div class="row">    
    <?php 
    $sql="SELECT * from tblpromociones where id='".$_GET['id']."'";

    $res= mysql_query($sql, $conection);
    $row= mysql_fetch_array($res);

    /*echo "<pre>";
    print_r($row);
    echo "</pre>";*/

    ?>
    <form class="form-horizontal" method="post" action="modelpromocion.php" enctype="multipart/form-data">

      <div class="form-group">
        <label for="titulo" class="col-sm-2 control-label">Título:</label>
        <div class="col-sm-8">
          <input name="titulo" type="text" class="form-control" id="titulo" value="<?php echo $row['titulo'];?>"  autofocus="">
          <!-- <p class="help-block">Título corto.</p> -->
        </div>
      </div>

      <div class="form-group">
        <label for="url" class="col-sm-2 control-label">URL:</label>
        <div class="col-sm-6">
          <input name="url" type="text" class="form-control" id="url" value="<?php echo $row['url'];?>">
        </div>
        <div class="col-sm-2">
          <select name="target" id="target" class="form-control">
          <?php
          $targets = array(
            "_blank" => 'Abrir en la misma página',
            "_self" => 'Abrir en una nueva pestaña'
          );
          foreach ($targets as $key => $value) {
            $selected_ = "";
            if($row['target'] == $key){ $selected_ = "selected";}
            echo '<option value="'.$key.'" '.$selected_.'>'.$value.'</option>';
          }
          ?>
          </select>
          <!-- <p class="help-block">Título corto.</p> -->
        </div>
      </div>


      <div class="form-group">
      <label for="url" class="col-sm-2 control-label">Imagen:</label>
      <div class="col-md-10">
       <input type="file" name="imagen" id="imagen">
       <p class="help-block">JPG,PNG,GIF (400px * 400px)</p>
       <?php
       if(!empty($row['imagen'])){
       ?>
       <a href="../images/uploads/<?php echo $row['imagen'];?>" target="_blank">
       <img src="../images/uploads/<?php echo $row['imagen'];?>" style="max-height: 50px;"></a>
       <?php }?>
       </div>
      </div>

      <div class="form-group">
        <label for="orden" class="col-sm-2 control-label">Orden:</label>
        <div class="col-sm-3">
          <input name="orden" type="text" class="form-control" id="orden" value="<?php echo $row['orden'];?>">
        </div>
      </div>

      <input type="hidden" id="guardar" name="guardar" value="<?php echo $_GET['id']?>" >
     <!--  <div class="form-group" style="float: right;">
        <div class="form-group">
          <button type="submit" id="editar" class="btn btn-primary" aria-label="Left Align">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar
          </button>
        </div>
      </div> -->

      <div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
      <button type="submit" id="editar" class="btn btn-primary" aria-label="Left Align">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar
          </button>
    </div>
  </div>

    </form>
  </div>
</div>
<div class="panel-heading">
 <div class="contenedor" align="center">
   <strong>Tupay <span class="glyphicon glyphicon-registration-mark" aria-hidden="true"></span> 2015 versión 3</strong>
   <br>
   <strong><a href="http://www.bit-store.ec/index.php/contactenos/"  style="color:white">Info</a> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></strong>
 </div>
</div>   


</div>  
<script>
  $('div#imagenes').on('click','button.eliminar',function(event){
    id=$(this).attr('id');
    $.ajax({
                      data:  "eliminarfoto="+id,
                      url:   'modelhotel.php',
                      type:  'post',
      success:  function (response) {
        $('div#'+id).css('display','none');   
      }
    });
  });  
</script>

</body>    
</html>

