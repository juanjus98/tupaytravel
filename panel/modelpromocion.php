 <?php 
 include ("./../conectar.php");
 require_once '../libs/function.video.php';
 require_once '../libs/upload/class.upload.php';

 $conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

 $fecha = date("Y-m-d H:i:s");

 if(isset($_POST['guardar']) && $_POST['guardar']=="")
 {

 if (!empty($_FILES['imagen'])) {
   $foo = new Upload($_FILES['imagen'],'es_ES'); 
   if ($foo->uploaded) {
    // save uploaded image with no changes
     $foo->Process('../images/uploads/');
     if ($foo->processed) {
     //echo 'Imagen cargada sasfactoriamente.';
       $nombre_imagen = $foo->file_dst_name;
     } else {
      $nombre_imagen = "";
       echo 'error : ' . $foo->error;
     }

   }
 }

if(!empty($nombre_imagen)){
  $sql="INSERT INTO tblpromociones (titulo,imagen,url,target,orden) VALUES ('".$_POST['titulo']."','".$nombre_imagen."','".$_POST['url']."','".$_POST['target']."','".$_POST['orden']."')";
}else {
  $sql="INSERT INTO tblpromociones (titulo,url,target,orden) VALUES ('".$_POST['titulo']."','".$_POST['url']."','".$_POST['target']."','".$_POST['orden']."')";
}

  $res=mysql_query($sql, $conection) or die(mysql_error());
  $id_video = mysql_insert_id();

  echo "<script> window.location.href='listado_promociones.php'</script>";
  return;

}
else if(isset($_POST['guardar']) && $_POST['guardar']!="")
{

  if (!empty($_FILES['imagen'])) {
   $foo = new Upload($_FILES['imagen'],'es_ES'); 
   if ($foo->uploaded) {
    // save uploaded image with no changes
     $foo->Process('../images/uploads/');
     if ($foo->processed) {
     //echo 'Imagen cargada sasfactoriamente.';
       $nombre_imagen = $foo->file_dst_name;
     } else {
      $nombre_imagen = "";
       echo 'error : ' . $foo->error;
     }

   }
 }

if(!empty($nombre_imagen)){
  $sql="UPDATE tblpromociones SET titulo='".$_POST['titulo']."',imagen='".$nombre_imagen."', url='".$_POST['url']."', target='".$_POST['target']."',orden='".$_POST['orden']."' WHERE id='".$_POST['guardar']."'";
}else{
  $sql="UPDATE tblpromociones SET titulo='".$_POST['titulo']."', url='".$_POST['url']."', target='".$_POST['target']."',orden='".$_POST['orden']."' WHERE id='".$_POST['guardar']."'";
}

  $res=mysql_query($sql, $conection);
  
  $id_video=$_POST['guardar'];

  echo "<script> window.location.href='listado_promociones.php'</script>";
  return;
}
else if(isset($_POST['eliminar']))
{
  $sql="UPDATE tblpromociones SET estado=0 WHERE id='".$_POST['id']."'";
  $res=mysql_query($sql, $conection);
  return;
}
?>