 <?php 
 include ("./../conectar.php");
 require_once '../libs/function.video.php';

 $conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

 $fecha = date("Y-m-d H:i:s");

 if(isset($_POST['guardar']) && $_POST['guardar']=="")
 {
  $imagen = getVideoThumbnailByUrl($_POST['url'],"medium");

  $sql="INSERT INTO tblvideos (url,titulo,descripcion,imagen,orden,fecha) VALUES ('".$_POST['url']."','".$_POST['titulo']."','".$_POST['descripcion']."','".$imagen."','".$_POST['orden']."','".$fecha."')";
  $res=mysql_query($sql, $conection) or die(mysql_error());
  $id_video = mysql_insert_id();

  echo "<script> window.location.href='listado_videos.php'</script>";
  return;

}
else if(isset($_POST['guardar']) && $_POST['guardar']!="")
{

  $imagen = getVideoThumbnailByUrl($_POST['url'],"medium");

  $sql="UPDATE tblvideos SET url='".$_POST['url']."',titulo='".$_POST['titulo']."',descripcion='".$_POST['descripcion']."',imagen='".$imagen."',orden='".$_POST['orden']."',fecha='".$fecha."' WHERE id='".$_POST['guardar']."'";
  $res=mysql_query($sql, $conection);
  
  $id_video=$_POST['guardar'];

  echo "<script> window.location.href='listado_videos.php'</script>";
  return;
}
else if(isset($_POST['eliminar']))
{
  $sql="UPDATE tblvideos SET estado=0 WHERE id='".$_POST['id']."'";
  $res=mysql_query($sql, $conection);
  return;
}
?>