<?php
include ("./../conectar.php");

$conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

if(isset($_POST['guardar']) && $_POST['guardar']=="")
{
    $con="SELECT MAX(orden) FROM tblpaquete";
    $ress=mysql_query($con, $conection);
    $fila=mysql_fetch_row($ress);
    $orden=(int)($fila[0]+1);
    
    $sql="INSERT INTO tblpaquete (nombre,cantidad,nacionalidad,estadia, precio,orden) VALUES ('".$_POST['nombre']."','".$_POST['cantidad']."','".$_POST['nacionalidad']."','".$_POST['estadia']."','".$_POST['precio']."','".$orden."')";
    $res=mysql_query($sql, $conection);
    $id_paquete=mysql_insert_id($conection);
    
    $cant=$_POST['cant_detalles'];

    for($i=0;$i<$cant;$i++)
    {
     $nombre=$_POST['nombre_'.$i];
     $detalle=$_POST['detalles_'.$i];
     if($_POST['nombre_'.$i]!=null && $_POST['detalles_'.$i]!=null)
     {
       $sql1="INSERT INTO tblpaquete_tour (id_paquete,nombre,detalle) VALUES ('".$id_paquete."','".$nombre."','".$detalle."')";
       $res1=mysql_query($sql1, $conection);   
     }
     
    }
    echo "<script> window.location.href='main.php'</script>";
    return;
}
else if(isset($_POST['guardar']) && $_POST['guardar']!="")
{


  $sql="UPDATE tblpaquete SET nombre='".$_POST['nombre']."',fecha_inicio='".$_POST['finicio']."',fecha_fin='".$_POST['ffin']."',cantidad='".$_POST['cantidad']."',nacionalidad='".$_POST['nacionalidad']."',estadia='".$_POST['estadia']."',precio='".$_POST['precio']."',detalles='".$_POST['detalles']."' WHERE id='".$_POST['guardar']."'";

  $res=mysql_query($sql, $conection);
   
  //borro todo de paquetetour
  $sqldelete="delete from tblpaquete_tour WHERE id_paquete='".$_POST['guardar']."'";
  $resdelete=mysql_query($sqldelete, $conection);
  
  $cant=$_POST['cant_detalles'];

    for($i=0;$i<$cant;$i++)
    {
     $nombre=$_POST['nombre_'.$i];
     $detalle=$_POST['detalles_'.$i];

     if($_POST['nombre_'.$i]!=null && $_POST['detalles_'.$i]!=null)
     {
       $sql1="INSERT INTO tblpaquete_tour (id_paquete,nombre,detalle) VALUES ('".$_POST['guardar']."','".$nombre."','".$detalle."')";
       $res1=mysql_query($sql1, $conection);   
     }
     
    }
  echo "<script> window.location.href='main.php'</script>";
  return;
}
else if(isset($_POST['eliminardetalle']))
{
    $sql="DELETE FROM tblpaquete_tour WHERE id='".$_POST['eliminardetalle']."'";
    $res=mysql_query($sql, $conection);
    return;
}
else if(isset($_POST['eliminar']))
{
    $sql="DELETE FROM tblpaquete WHERE id='".$_POST['id']."'";
    $res=mysql_query($sql, $conection);
    return;
}
else if(isset($_POST['ordenar'])) 
{
    $datos=array();
    $datos=  json_decode($_POST["datos"]);
    for($i=0;$i<count($datos);$i++){
        $sql="UPDATE tblpaquete SET orden='".$i."' WHERE id='".$datos[$i]."'";
        echo $sql;
        $res=mysql_query($sql, $conection);
    }
    return;
}