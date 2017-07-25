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
    <script src="./ckfinder/ckfinder.js"></script>

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
     $sql="SELECT * from tblpaquete where id='".$_GET['id']."'";
     $res=mysql_query($sql, $conection);
     $row=  mysql_fetch_array($res);
     ?>
      <form class="form-horizontal" method="post" action="modelpaquete.php">
        <div class="form-group">
          <label for="nombre" class="col-sm-2 control-label">Nombre del Paquete:</label>
          <div class="col-sm-10">
              <input name="nombre" style="width: 250px;" type="text" class="form-control" id="nombre" value="<?php echo $row['nombre'];?>" size="20" autofocus="">
          </div>
        </div>
        <div class="form-group">
          <label for="ffin" class="col-sm-2 control-label">Cantidad de Personas::</label>
          <div class="col-sm-10">
             <input name="cantidad" type="text" style="width: 250px;" class="form-control" id="cantidad" value="<?php echo $row['cantidad'];?>" size="20" autofocus="">
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
          <label for="estadia" class="col-sm-2 control-label">Precio:</label>
          <div class="col-sm-10">
             <input name="precio" type="text" style="width: 250px;" class="form-control" id="precio" value="<?php echo $row['precio'];?>" autofocus="">
          </div>
        </div>

        <div class="form-group">
          <button id="agregardetalle" type="button" id="editar" class="btn btn-primary" aria-label="Left Align">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Detalle
          </button>
        </div>
          <div class="row" id="div_detalles">
             <?php 
             if(isset($_GET['id'])){
                $sql11="SELECT count(id_paquete) as cant from tblpaquete_tour where id_paquete='".$_GET['id']."' group by id_paquete";
                $res11=mysql_query($sql11, $conection);
                if(mysql_num_rows($res11)!=0){
                  $row11=  mysql_fetch_array($res11);
                  $cant=$row11['cant'];
                }
                else
                {
                    $cant=0;
                }
             ?>
              <input type="text" id="cant_detalles" name="cant_detalles" value="<?php  echo $cant;?>"/>
              
             <?php 
                $sql1="SELECT tblpaquete_tour.* from tblpaquete_tour where id_paquete='".$_GET['id']."'";
                $res1=mysql_query($sql1, $conection);
                 $j=0;
                while($row1=  mysql_fetch_array($res1)){
                ?>
                <div id="<?php echo $row1['id']?>">
                   <input type="hidden" name="idd_<?php echo $j?>" value="<?php echo $row1['id']?>" />
                   <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Nombre del Detalle:</label>
                    <label>
                      <input type="text" name="nombre_<?php echo $j?>" value="<?php echo $row1['nombre']?>" id="" class="form-control" style="width:300px"/>
                    </label>
                    <button type="button" id="eliminardetalle" class="btn btn-primary" aria-label="Left Align">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar Detalle
                    </button>
                   </div>

                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Detalle:</label>
                    <label>
                      <textarea name="detalles_<?php echo $j?>" rows="5" id="" ><?php echo $row1['detalle']?></textarea>
                    </label>
                  </div>
                </div>
                <script>
                   var editor_<?php echo $j?> = CKEDITOR.replace("detalles_<?php echo $j?>");
                   CKFinder.setupCKEditor( editor_<?php echo $j?>, "../panel/ckfinder/" );
                </script>
              
                <?php $j++;
              }
            }else {?>
              <input type="hidden" id="cant_detalles" name="cant_detalles" value="0"/>
             <?php } ?>
          </div>  
          
          
          <input type="hidden" id="guardar" name="guardar" value="<?php echo $_GET['id']?>" >
         
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
 $(document).ready(function ($) {
     var i=$('#cant_detalles').val();     
     
     $('#agregardetalle').on('click',function(){
        $('#div_detalles').append(
          '<div><div class="form-group" id="'+i+'">'+
          '<label for="nombre_'+i+'" class="col-sm-2 control-label">Nombre del Detalle:</label>'+
          '<label>'+
            '<input type="text" name="nombre_'+i+'" id="nombre_'+i+'" class="form-control" style="width:300px"/>'+
          '</label><button type="button" id="eliminardetalle" class="btn btn-primary" aria-label="Left Align">'+
            '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar Detalle'+
          '</button>'+
        '</div>'+       
                
          '<div class="form-group">'+
          '<label for="detalles_'+i+'" class="col-sm-2 control-label">Detalle:</label>'+
          '<label>'+
            '<textarea name="detalles_'+i+'" rows="5" id="detalles_'+i+'" ></textarea>'+
          '</label>'+
        '</div></div><script>'+
          'var editor_'+i+' = CKEDITOR.replace( "detalles_'+i+'"); CKFinder.setupCKEditor( editor_'+i+', "../panel/ckfinder/" );'+'<\/script>');
        $valor=parseInt($('#cant_detalles').val());
         $('#cant_detalles').val($valor+1);
         i++;
     });
     
     
     $('div#div_detalles').on('click','button#eliminardetalle',function(event){
         $(this).parent('div').parent('div').remove();
         id=$(this).parent('div').parent('div').attr('id');
              $.ajax({
                    data:  "eliminardetalle="+id,
                    url:   'modelpaquete.php',
                    type:  'post',
                    success:  function (response) {
                        
                    }
              });
     });
 });

</script>   
</body>    
</html>