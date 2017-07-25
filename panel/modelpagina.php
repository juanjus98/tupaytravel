 <?php 
 include ("./../conectar.php");
 require_once '../libs/function.video.php';
 require_once '../libs/upload/class.upload.php';

 $conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

 $fecha = date("Y-m-d H:i:s");

 if(isset($_POST['guardar']) && $_POST['guardar']=="")
 {

  $sql="INSERT INTO tblpagina (titulo,url_key,descripcion) VALUES ('".$_POST['titulo']."','".$_POST['url_key']."','".$_POST['descripcion']."')";

  $res=mysql_query($sql, $conection) or die(mysql_error());
  $id_video = mysql_insert_id();

  echo "<script> window.location.href='listado_paginas.php'</script>";
  return;

}
else if(isset($_POST['guardar']) && $_POST['guardar']!="")
{

  $sql="UPDATE tblpagina SET titulo='".$_POST['titulo']."', url_key='".$_POST['url_key']."', descripcion='".$_POST['descripcion']."' WHERE id='".$_POST['guardar']."'";

  $res=mysql_query($sql, $conection);
  
  $id_video=$_POST['guardar'];

  echo "<script> window.location.href='listado_paginas.php'</script>";
  return;
}
else if(isset($_POST['eliminar']))
{
  $sql="UPDATE tblpagina SET estado=0 WHERE id='".$_POST['id']."'";
  $res=mysql_query($sql, $conection);
  return;
}
?>