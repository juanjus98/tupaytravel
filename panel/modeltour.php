 <?php 
 include ("./../conectar.php");

$conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

if(isset($_POST['guardar']) && $_POST['guardar']=="")
{
    $sql="INSERT INTO tbltours (nombre,fecha_inicio,fecha_fin,cant_personas,nacionalidad,tipo,estadia,id_provincia,detalle) VALUES ('".$_POST['nombre']."','".$_POST['finicio']."','".$_POST['ffin']."','".$_POST['cantidad']."','".$_POST['nacionalidad']."','".$_POST['tipo']."','".$_POST['estadia']."','".$_POST['provincia']."','".$_POST['detalles']."')";    
    $res=mysql_query($sql, $conection);
    echo "<script> window.location.href='listado_tour.php'</script>";  
}
else if(isset($_POST['guardar']) && $_POST['guardar']!="")
{
  $sql="UPDATE tbltours SET nombre='".$_POST['nombre']."',fecha_inicio='".$_POST['finicio']."',fecha_fin='".$_POST['ffin']."',cant_personas='".$_POST['cantidad']."',nacionalidad='".$_POST['nacionalidad']."',tipo='".$_POST['tipo']."',estadia='".$_POST['estadia']."',id_provincia='".$_POST['provincia']."',detalle='".$_POST['detalles']."' WHERE id='".$_POST['guardar']."'";  
  $res=mysql_query($sql, $conection);
  echo "<script> window.location.href='listado_tour.php'</script>";  
  exit();
}

$sql="DELETE FROM tbltours WHERE id='".$_POST['id']."'";
$res=mysql_query($sql, $conection);
return;
?>