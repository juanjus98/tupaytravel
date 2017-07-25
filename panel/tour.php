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
     $sql="SELECT * from tbltours where id='".$_GET['id']."'";
     $res=mysql_query($sql, $conection);
     $row=  mysql_fetch_array($res);
     ?>
      <form class="form-horizontal" method="post" action="modeltour.php">
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Nombre del Tour:</label>
          <div class="col-sm-10">
              <input name="nombre" style="width: 250px;" type="text" class="form-control" id="nombre" value="<?php echo $row['nombre'];?>" size="20" autofocus="">
          </div>
        </div>
        <div class="form-group">
          <label for="finicio" class="col-sm-2 control-label">Fecha Inicio:</label>
          <div class="col-sm-10">
              <input type="text" class="form-control date" name="finicio" id="finicio" value="<?php echo $row['fecha_inicio'];?>" style="width: 250px;">
          </div>
          </div>
        <div class="form-group">
          <label for="ffin" class="col-sm-2 control-label">Fecha Fin:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control date" name="ffin" id="ffin" value="<?php echo $row['fecha_fin'];?>" style="width: 250px;">
            
          </div>
        </div>
        <div class="form-group">
          <label for="ffin" class="col-sm-2 control-label">Cantidad de Personas:</label>
          <div class="col-sm-10">
             <input name="cantidad" type="text" style="width: 250px;" class="form-control" id="cantidad" value="<?php echo $row['cant_personas'];?>" size="20" autofocus="">
          </div>
        </div>
          <div class="form-group">
          <label for="tipo" class="col-sm-2 control-label">Tipo de Tour:</label>
          <div class="col-sm-10">
              <select name="tipo" style="width: 250px;" class="form-control" id="tipo" >
                  
                  <?php 
                  if(!isset($_GET['id']))
                  {
                   echo '<option value="Aventura">Aventura</option>
                          <option value="Tradicional">Tradicional</option> ';  
                  }
                  
                  
                       if($row['tipo']=='Aventura'){?>
                          <option value="Aventura" selected="selected">Aventura</option>
                          <option value="Tradicional">Tradicional</option>
                  <?php }?>
                   <?php if($row['tipo']=='Tradicional'){?>
                           <option value="Aventura" >Aventura</option>
                          <option value="Tradicional" selected="selected">Tradicional</option>
                  <?php }?>
              </select>
          </div>
          </div>
        <div class="form-group">
          <label for="provincia" class="col-sm-2 control-label">Provincia</label>
          <div class="col-sm-10">
              <select name="provincia" style="width: 250px;" class="form-control" id="provincia" >
                  <?php $sql1="SELECT * from tblprovincia";
                        $res1=mysql_query($sql1, $conection);
                        
                     while ($row1=  mysql_fetch_array($res1)) {
                         
                        if($row['id_provincia']==$row1['id'])
                          echo '<option value="'.$row1['id'].'" selected="selected">'.$row1['provincia'].'</option>';
                        else
                           echo '<option value="'.$row1['id'].'">'.$row1['provincia'].'</option>'; 
                  }?>
              </select>
          </div>
          
        </div>
          <div class="form-group">
          <label for="nacionalidad" class="col-sm-2 control-label">Nacionalidad:</label>
          <div class="col-sm-10">
             <input name="nacionalidad" type="text" style="width: 250px;" class="form-control" id="nacionalidad" value="<?php echo $row['nacionalidad'];?>" size="20" autofocus="">
          </div>
        </div>
         <div class="form-group">
          <label for="estadia" class="col-sm-2 control-label">Estadia:</label>
          <div class="col-sm-10">
             <input name="estadia" type="text" style="width: 250px;" class="form-control" id="estadia" value="<?php echo $row['estadia'];?>" size="20" autofocus="">
          </div>
        </div>
          <div class="form-group">
          <label for="detalles" class="col-sm-2 control-label">Detalles del Tour:</label>
          <label>
            <textarea name="detalles" rows="5" id="detalles" ><?php echo $row['detalle'];?></textarea>
          </label>
        </div>
          <input type="hidden" id="guardar" name="guardar" value="<?php echo $_GET['id']?>" >
         <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'detalles' );
            </script>
            <div class="form-group" style="float: right;">
          <div class="form-group">
          <button type="submit" id="editar" class="btn btn-primary" aria-label="Left Align">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Guardar
          </button>
          </div>
        </div>
      </form>
  </div>
  
    <div class="panel-heading">
       <div class="contenedor" align="center">
         <strong>Tupay <span class="glyphicon glyphicon-registration-mark" aria-hidden="true"></span> 2015 versión 3</strong>
         <br>
         <strong><a href="http://www.bit-store.ec/index.php/contactenos/"  style="color:white">Info</a> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></strong>
       </div>
    </div>   
   </div>

</div>
    
   
   
 <script>
  $('#finicio').datetimepicker({
     timepicker:false,
     format:'Y-m-d'
 });

$('#ffin').datetimepicker({
 timepicker:false,
 format:'Y-m-d'
 });

</script>   
</body>    
</html>

