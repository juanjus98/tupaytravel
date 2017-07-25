<?php
session_start();
include ("conectar.php");
include("funciones.php");
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
require './libs/PHPMailer-master/PHPMailerAutoload.php';
$conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

if(isset($_POST['id_tour']))
{

	$nombre=$_POST['nombre'];
	$email=$_POST['email'];
	$telefono=$_POST['telefono'];
	$personas=$_POST['personas'];
	$comentario=$_POST['comentario'];
	$nacionalidad=$_POST['nacionalidad'];
	$comentario1=$_POST['comentario1'];
	$id=$_POST['id_tour'];

	$sql="INSERT INTO tblclientetour (nombre,email,telefono,comentario,personas, nacionalidad,id_tour,comentario1) VALUES ('".$nombre."','".$email."','".$telefono."','".$comentario."','".$personas."','".$nacionalidad."','".$id."','".$comentario1."')";
	$res=mysql_query($sql, $conection);

	$sql1="SELECT tbltours.*, tblprovincia.provincia FROM tbltours LEFT JOIN tblprovincia ON (tblprovincia.id = tbltours.id_provincia) Where tbltours.id='".$id."'";
	$result=mysql_query($sql1, $conection);
	$res1=  mysql_fetch_array($result);

	$url_tour = 'tour/' . $res1['id'] . '/' . url_amigable($res1['nombre']) .'/';


	$mensaje="Pedir cotizacion del tour: <b>".$res1['nombre']."</b></br>";
	$mensaje.= "<p><strong>Nombre: </strong>". $_POST['nombre']."</p>";
	$mensaje.= "<p><strong>Email: </strong>".$_POST['email']."</p>";
	$mensaje.= "<p><strong>Telefono: </strong>". $_POST['telefono']."</p>";
	$mensaje.= "<p><strong>Paquete: </strong>".$_POST['id_tour']."</p>";
	$mensaje.= "<p><strong>Cantidad de Personas: </strong>".$personas."</p>";
	$mensaje.= "<p><strong>Nacionalidad: </strong>".$nacionalidad."</p>";
	$mensaje.= "<p><strong>Comentario: </strong>".$comentario."</p><hr>";
	$mensaje.= "<p><strong><u>DETALLES DEL TOUR</u></strong></p>";

	$mensaje.= "<p><strong>Tour: </strong>".$res1['nombre']."</p>";
	$mensaje.= "<p><strong>Provincia: </strong>".$res1['provincia']."</p>";
	$mensaje.= "<p><strong>URL:</strong><a href='".$url_tour."' target='_blank'>".$url_tour."</a></p>";
	$mensaje.= "<p>".$res1['detalle']."</p></br>";

	enviarEmail($mensaje);

	echo "<script> window.location.href='".$url_tour."'</script>";
	return;
}
else{

	$fecha_inicio=$_SESSION['fecha_inicio'];
	$fecha_fin=$_SESSION['fecha_fin'];
	$estadia=$_SESSION['estadia'];

	$adultos=$_SESSION['adultos'];
	$adolecentes=$_SESSION['adolecentes'];
	$ninios=$_SESSION['ninios'];
	$infantes=$_SESSION['infantes'];

	$nacionalidad=$_SESSION['nacionalidad'];

	/*modificado por...*/
	$comentario1=$_POST['comentario1'];
	$nombre=$_POST['nombre'];
	$email=$_POST['email'];
	$telefono=$_POST['telefono'];
//$personas=$_POST['personas'];
	$comentario=$_POST['comentario'];
//$nacionalidad=$_POST['nacionalidad'];
	$comentario1=$_POST['comentario1'];
	$id=$_POST['id_tour'];

	$sql="INSERT INTO tblclientes (fecha_inicio,fecha_fin,personas,nacionalidad,estadia,comentario1,nombre,email,movil,id_paquete) VALUES ('".$fecha_inicio."','".$fecha_fin."','".$personas."','".$nacionalidad."','".$estadia."','".$comentario1."','".$_POST['nombre']."','".$_POST['email']."','".$_POST['movil']."','".$_POST['id_paquete']."')";
	$res=mysql_query($sql, $conection);

	$sql1="SELECT nombre FROM tblpaquete where id='".$_POST['id_paquete']."'";
	$result=mysql_query($sql1, $conection);
	$res1=  mysql_fetch_array($result);

	$sql11="SELECT tblpaquete_tour.*,tblpaquete.nombre as name FROM tblpaquete_tour inner join tblpaquete on tblpaquete_tour.id_paquete=tblpaquete.id where id_paquete='".$_POST['id_paquete']."'";
	$query1=mysql_query($sql11,$conection);


	$mensaje = "<p><strong>Pedir cotizacion del paquete:".$res1['nombre']."</strong></p></br>";
	$mensaje .= "<p><strong>Nombre: </strong>". $_POST['nombre']."</p></br>";
	$mensaje .= "<p><strong>Email: </strong>".$_POST['email']."</p></br>";
	$mensaje .= "<p><strong>Telefono: </strong>". $_POST['movil']."</p></br>";
	$mensaje .= "<p><strong>Paquete: </strong>".$_POST['id_paquete']."</p></br>";
	$mensaje .= "<p><strong>Fechas: </strong>".$fecha_inicio." al ".$fecha_fin."</p></br>";
	$mensaje .= "<p><strong>Nacionalidad: </strong>".$nacionalidad."</p></br>";
	$mensaje .= "<p><strong>Estadia: </strong>".$estadia."</p></br>";
	$mensaje .= "<p><strong>Comentario: </strong>".$comentario1."</p></br>";

	if($_POST['vuelos_internacionales'] === 'SI'){
		$mensaje .= "<hr><p><strong><u>Vuelo Internacional</u></strong></p>";
		$mensaje .= "<p><strong><u>País Origen:</u></strong> ". $_POST['pais_origen'] ."</p>";
		$mensaje .= "<p><strong><u>Ciudad origen:</u></strong> ". $_POST['ciudad_origen']."</p>";
	}

	$mensaje .= "<hr><p><strong><u>Personas</u></strong></p>";
	$mensaje .= "<p><strong><u>Adultos:</u></strong> ". $adultos ."</p>";
	$mensaje .= "<p><strong><u>Adolecentes:</u></strong> ". $adolecentes ."</p>";
	$mensaje .= "<p><strong><u>Niños:</u></strong> ". $ninios ."</p>";
	$mensaje .= "<p><strong><u>Infantes:</u></strong> ". $infantes ."</p>";

	$mensaje .= "<hr><p><strong><u>Detalles del paquete</u></strong>"."</p>";

	$fecha_inicio = date("d-m-Y", strtotime("$fecha_inicio - 1 days"));
	while($com1=mysql_fetch_array($query1))
	{
		$fecha_inicio= date("d-m-Y", strtotime("$fecha_inicio + 1 days"));
		$mensaje.= "<p>".$fecha_inicio."</p></br>";
		$mensaje.="<p>".$com1['detalle']."</p></br>";
	}
	enviarEmail($mensaje);
	echo "<script> window.location.href='./'</script>";
}


function enviarEmail($mensaje){
	$conection = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());
	$sql1="SELECT * FROM tbladmin";
	$result=mysql_query($sql1, $conection);
	$res1=  mysql_fetch_array($result);

//Create a new PHPMailer instance
	$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
	$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
	$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';

//Set the hostname of the mail server
	$mail->Host = 'mail.tupaytravel.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 25;

//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
	$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = $res1['correo'];

//Password to use for SMTP authentication
	$mail->Password = $res1['password'];

//Set who the message is to be sent from
	$mail->setFrom($res1['correo'], 'Administrador');

//Set who the message is to be sent to
	$mail->addAddress($res1['correo_destino'], 'Administrador');
	//$mail->addAddress("juanjus98@gmail.com", 'Juan Julio');
//Set the subject line
	$mail->Subject = 'Pedir Cotizacion';
//$mail->Body = $mensaje;
	$mail->msgHTML($mensaje);
	$mail->send();

	return;
}