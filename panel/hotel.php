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
     $sql="SELECT * 
          from tblhotel
          inner join tblprovincia on tblhotel.id_provincia=tblprovincia.id
          where tblhotel.id_hotel='".$_GET['id']."'";
//          inner join tblfotos on tblhotel.id_hotel=tblfotos.id_hotel
          
     
     $res=mysql_query($sql, $conection);
     $row=  mysql_fetch_array($res);
     
     ?>
      <form class="form-horizontal" method="post" action="modelhotel.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Nombre Hotel:</label>
          <div class="col-sm-10">
              <input name="nombre" style="width: 250px;" type="text" class="form-control" id="nombre" value="<?php echo $row['nombre'];?>" size="20" autofocus="">
          </div>
        </div>
        
        <div class="form-group">
          <label for="tipo" class="col-sm-2 control-label">Tipo de Hotel:</label>
          <div class="col-sm-10">
              <select name="tipo" style="width: 250px;" class="form-control" id="tipo" >
                  
                  <?php 
                  if(!isset($_GET['id']))
                  {
                   echo '<option value="Hostal">Hostal</option>
                          <option value="Hotel">Hotel</option> ';  
                  }
                  
                  
                       if($row['tipo']=='Hostal'){?>
                          <option value="Hostal" selected="selected">Hostal</option>
                          <option value="Hotel">Hotel</option>
                  <?php }?>
                   <?php if($row['tipo']=='Hotel'){?>
                           <option value="Hostal" >Hostal</option>
                          <option value="Hotel" selected="selected">Hotel</option>
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
          <label for="detalles" class="col-sm-2 control-label">Descripción del Hotel:</label>
          <label>
            <textarea name="detalles" rows="5" id="detalles" ><?php echo $row['descripcion'];?></textarea>
          </label>
        </div>
       <div class="form-group">
          <label for="imagenes" class="col-sm-2 control-label">Subir Imagenes:</label>
          <label>
             <input type="file" name="archivo[]" multiple="multiple">
          </label>
       </div>
        <div class="form-group" id="imagenes">  
       <?php $sql11="SELECT * from tblfotos Where id_hotel='".$_GET['id']."'";
             $res11=mysql_query($sql11, $conection);
                        
            while ($row11=  mysql_fetch_array($res11)) { 
              echo  '<div class="col-md-3" id="'.$row11['id'].'"><img src="../images/hotel/'.$row11['foto'].'" width="100" height="100" style="padding:10px;"/>';
              echo '<button type="button" id="'.$row11['id'].'" class="btn btn-primary eliminar" aria-label="Left Align">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eiminar
               </button></div>';
            }
        ?>  
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

