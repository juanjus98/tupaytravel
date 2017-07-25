 <?php 
 include ("./../conectar.php");

$conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

if(isset($_POST['guardar']) && $_POST['guardar']=="")
{

   $sql="INSERT INTO tblhotel (nombre,descripcion,id_provincia,tipo) VALUES ('".$_POST['nombre']."','".$_POST['detalles']."',".$_POST['provincia'].",'".$_POST['tipo']."')";
   $res=mysql_query($sql, $conection) or die(mysql_error());
   $id_hotel = mysql_insert_id();
      # definimos la carpeta destino
    $carpetaDestino="../images/hotel/";
 
    # si hay algun archivo que subir
    if($_FILES["archivo"]["name"][0])
    {
 
        # recorremos todos los arhivos que se han subido
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
        {
 
            # si es un formato de imagen
            if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png" || $_FILES["archivo"]["type"][$i]=="image/bmp")
            {
 
                # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {
                    $origen=$_FILES["archivo"]["tmp_name"][$i];
                    $destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];
                     
                    $sql1="INSERT INTO tblfotos(id_hotel,foto) VALUES ('".$id_hotel."','". $_FILES["archivo"]["name"][$i] ."')";
                    $res=mysql_query($sql1, $conection) or die(mysql_error());
                    
                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {
                        echo "<br>".$_FILES["archivo"]["name"][$i]." movido correctamente";
                    }else{
                        echo "<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];
                    }
                }else{
                    echo "<br>No se ha podido crear la carpeta: up/".$user;
                }
            }else{
                echo "<br>".$_FILES["archivo"]["name"][$i]." - NO es imagen jpg";
            }
        }
    }else{
        echo "<br>No se ha subido ninguna imagen";
    }
echo "<script> window.location.href='listado_hoteles.php'</script>";
return;

}
else if(isset($_POST['guardar']) && $_POST['guardar']!="")
{
  $sql="UPDATE tblhotel SET nombre='".$_POST['nombre']."',tipo='".$_POST['tipo']."',id_provincia='".$_POST['provincia']."',descripcion='".$_POST['detalles']."' WHERE id_hotel='".$_POST['guardar']."'";
  $res=mysql_query($sql, $conection);
  
  $carpetaDestino="../images/hotel/";
  $id_hotel=$_POST['guardar'];
    # si hay algun archivo que subir
    if($_FILES["archivo"]["name"][0])
    {
 
        # recorremos todos los arhivos que se han subido
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++)
        {
 
            # si es un formato de imagen
            if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png" || $_FILES["archivo"]["type"][$i]=="image/bmp")
            {
 
                # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {
                    $origen=$_FILES["archivo"]["tmp_name"][$i];
                    $destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];
                     
                    $sql1="INSERT INTO tblfotos(id_hotel,foto) VALUES ('".$id_hotel."','". $_FILES["archivo"]["name"][$i] ."')";
                    $res=mysql_query($sql1, $conection) or die(mysql_error());
                    
                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {
                        echo "<br>".$_FILES["archivo"]["name"][$i]." movido correctamente";
                    }else{
                        echo "<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];
                    }
                }else{
                    echo "<br>No se ha podido crear la carpeta: up/".$user;
                }
            }else{
                echo "<br>".$_FILES["archivo"]["name"][$i]." - NO es imagen jpg";
            }
        }
    }else{
        echo "<br>No se ha subido ninguna imagen";
    }
   
  echo "<script> window.location.href='listado_hoteles.php'</script>";
return;
}
else if(isset($_POST['eliminarfoto']))
{
   $sql11="SELECT * from tblfotos WHERE id='".$_POST['eliminarfoto']."'";
   echo $sql11;
   $res11=mysql_query($sql11, $conection);
   $val=mysql_fetch_array($res11);
   //elimino la foto en el serviodr
   $result=unlink("../images/hotel/".$val['foto']);
      
   $sql="DELETE FROM tblfotos WHERE id='".$_POST['eliminarfoto']."'";
   echo $sql;
   $res=mysql_query($sql, $conection);
   
   return;
}
$sql="DELETE FROM tblhotel WHERE id_hotel='".$_POST['id']."'";
$res=mysql_query($sql, $conection);
return;
?>