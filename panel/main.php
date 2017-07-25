﻿<?php
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
 <script src="../js/jquery.tablednd.js"></script>
 <script src="../js/mootools-core-1.3.2-full-compat-yc.js"></script>
 <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
 <link href="../css/tablednd.css" rel="stylesheet" type="text/css">

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
 <script>
   $(document).ready(function(){
     $('table#listado').on('click','button#editar',function(){
       $id=$(this).parents('tr').attr('id');
       window.location.href='paquete.php?id='+$id; 
     });
     $('#nuevo').on('click',function(){
       window.location.href='paquete.php'; 
     });
     $('table#listado').on('click','button#eliminar',function(){
       $id=$(this).parents('tr').attr('id');
       $.ajax({
                         data:  "eliminar=paquete&id="+$id,
                         url:   'modelpaquete.php',
                         type:  'post',
         success:  function (response) {
           window.location.href='main.php'; 
           }
       });
     });

 //para ordenar
 $("#listado").tableDnD();
 // Initialise the second table specifying a dragClass and an onDrop function that will display an alert
 $("#listado").tableDnD({
   onDragClass: "myDragClass",
   onDrop: function(table, row) {
     var dato=new Array();
     var i=0;
     $('#listado tbody tr').each(function(index, element){
       var id = $(this).attr("id");
       dato[i++]=id;
     });
     $.ajax({
                       data:  "ordenar=ordenar&datos="+JSON.encode(dato),
                       url:   'modelpaquete.php',
                       type:  'post',
       success:  function (response) {

         }
     });

   }
 });

 //Cargar galeria
 $('.wapopup').on('click',function(){
   var url = $(this).attr('href');
   var height = $(this).data('height');
   var width = $(this).data('width');

   newwindow=window.open(url,"Galería",'height='+ height +',width=' + width);
   if (window.focus) {newwindow.focus()}

     console.log(url);
   return false;

 });

});

</script>
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

     <li><a href="listado_paginas.php"><strong>Páginas</strong></a></li>

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
 <button type="button" id="nuevo" class="btn btn-primary" aria-label="Left Align">
   <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo Paquete
 </button>
 <div class="row col-lg-offset-5">

   <h3>Listado de Paquetes</h3></div>
   <div class="row">
     <div class="col-md-12">
       <div class="table-responsive">
         <table class="table table-striped" id="listado">
           <thead>
             <th>Nombre</th>
             <th>Personas</th>
             <th>Estadia</th>
             <th>Precio</th>
             <th></th>

           </thead>
           <tbody>
             <?php 
             $sql="SELECT * from tblpaquete ORDER BY orden";
             $res=mysql_query($sql, $conection);
             while($row= mysql_fetch_array($res))
             {
               echo '<tr id="'.$row['id'].'">
               <td>'.$row['nombre'].'</td>
               <td>'.$row['cantidad'].'</td>
               <td>'.$row['estadia'].'</td>
               <td>'.$row['precio'].'</td>
               <td><button type="button" id="editar" class="btn btn-primary" aria-label="Left Align">
                 <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Editar
               </button>
               <button type="button" id="eliminar" class="btn btn-primary" aria-label="Left Align">
                 <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Eliminar</button>
                 <a href="paquete_galeria.php?id='.$row['id'].'" class="btn btn-info wapopup" data-width="600" data-height="600"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Galería</a>
               </td>
             </tr>';

           }

           ?>
         </tbody>
       </table>
     </div>
   </div>
 </div>

 <div class="panel-heading">
   <div class="contenedor" align="center">
     <strong>Tupay <span class="glyphicon glyphicon-registration-mark" aria-hidden="true"></span> 2015 versión 3</strong>
     <br>
     <strong><a href="http://www.bit-store.ec/index.php/contactenos/" style="color:white">Info</a> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></strong>
   </div>
 </div> 
</div>
</div> 
</body>

</html>

