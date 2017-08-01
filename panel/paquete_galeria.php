<?php
include ("./../conectar.php");
$conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

//Consultar paquete
$sql="SELECT * from tblpaquete Where id=" . $_GET['id'];
$res=mysql_query($sql, $conection);

$fs = mysql_fetch_array($res);

//POST
if($_POST['accion'] === 'cargar'){
 $titulo = $_POST['titulo'];
 $id_tblpaquete = $_POST['id_tblpaquete'];

 $principal = (isset($_POST['principal'])) ? 1 : 99 ;

 require_once '../libs/upload/class.upload.php';

 if (!empty($_FILES['imagen'])) {

   $foo = new Upload($_FILES['imagen'],'es_ES'); 
   if ($foo->uploaded) {
 // save uploaded image with no changes
     $foo->Process('../images/uploads/');
     if ($foo->processed) {
 //echo 'Imagen cargada sasfactoriamente.';
       $nombre_imagen = $foo->file_dst_name;

 //Insertar en la tabla;
       $sql="INSERT INTO tblpaquete_galeria (id_tblpaquete,titulo,nombre_imagen,principal) VALUES ('".$id_tblpaquete."','".$titulo."','".$nombre_imagen."','".$principal."')";
       $res=mysql_query($sql, $conection);
       $id_galeria=mysql_insert_id($conection);

       if(!empty($nombre_imagen) && !empty($id_galeria)){
         /*header("paquete_galeria.php?id=" . $_GET['id']);*/
         $url = "paquete_galeria.php?id=" . $_GET['id'];
         header('Location: ' . $url);
       }


     } else {
       echo 'error : ' . $foo->error;
     }

   }

 }

}

//Eliminar
if($_POST['accion'] === 'eliminar'){
 $regs = $_POST['regs'];
 if(!empty($regs )){
   foreach ($regs as $key => $value) {
     $sql="DELETE FROM tblpaquete_galeria Where id=" . $key;
     $res=mysql_query($sql, $conection);
   }

   $url = "paquete_galeria.php?id=" . $_GET['id'];
   header('Location: ' . $url);

 }

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Galería</title>
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


   });

 </script>
</head>
<body>
 <div class="container-fluid">
   <div class"row">
     <div class="col-md-12">
       <h4><?php echo $fs['nombre'];?></h4>
     </div>
     <div class="col-md-12">
       <div class="panel panel-default">
         <div class="panel-heading">Cargar Imagen.</div>
         <div class="panel-body">
           <form name="form-upload" id="form-upload" method="post" action="" enctype="multipart/form-data">
             <input type="hidden" name="accion" value="cargar">
             <input type="hidden" name="id_tblpaquete" id="id_tblpaquete" value="<?php echo $fs['id'];?>">
             <div class="form-group">
               <label for="titulo">Título</label>
               <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título">
             </div>
             <div class="clearfix"></div>
             <div class="form-group">
             <label for="imagen">Imagen JPG (600px * 380px)</label>
               <input type="file" name="imagen" id="imagen">
             </div>

            <div class="checkbox">
              <label>
              <input type="checkbox" name="principal" value="1"> Seleccionar como imagen principal.
              </label>
            </div>

             <div class="clearfix"></div>
             <button type="submit" class="btn btn-primary">Cargar imagen</button>
           </form>
         </div>
       </div>
     </div>
     <div class="col-md-12">
       <form name="form-eliminar" id="form-eliminar" method="post" action="">
         <div class="table-responsive">
           <table class="table table-bordered table-hover table-condensed">
             <thead>
               <tr>
                 <th></th>
                 <th>Título</th>
                 <th>Imagen</th>
                 <th>Principal</th>
               </tr> 
             </thead>
             <tbody>
               <?php
                //Consultar galeria
               $sql="SELECT * from tblpaquete_galeria Where id_tblpaquete=" . $_GET['id'];
               $res=mysql_query($sql, $conection);

               /*$fs = mysql_fetch_array($res);*/
               if(mysql_num_rows($res)){
                 while ($fs = mysql_fetch_array($res)) {
                   ?>
                   <tr>
                     <td><input type="checkbox" name="regs[<?php echo $fs['id'];?>]"></td>
                     <td><?php echo $fs['titulo'];?></td>
                     <td>
                     <img src="../images/uploads/<?php echo $fs['nombre_imagen'];?>" style="max-height: 40px;">
                     </td>
                     <td class="text-center">
                     <?php echo $principal = ($fs['principal'] == 1) ? "SI" : '';?>
                     </td>
                   </tr>
                   <?php } } else {?>
                   <tr>
                     <td colspan="2"><center><b>Sin registros.</b></center></td>
                   </tr>
                   <?php }?>

                 </tbody>
               </table>

             </div>

             <div class="pull-right">
               <input type="hidden" name="accion" value="eliminar">
               <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Seleccionados"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar seleccionados</button>
             </div>

           </form>
         </div>
       </div>
     </div> 
   </body>

   </html>