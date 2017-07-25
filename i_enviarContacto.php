<?php 
date_default_timezone_set('Etc/UTC');
require './libs/PHPMailer-master/PHPMailerAutoload.php';
$link = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

if(isset($_POST['enviar']) && isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['comentario'])){
	
	$sql="INSERT INTO tblcontacto (nombre,email,movil,nacionalidad,comentario) VALUES ('".$_POST['nombre']."','".$_POST['email']."','".$_POST['movil']."','".$_POST['nacionalidad']."','".$_POST['comentario']."')";
	$res=mysql_query($sql, $link);
	
	$sql1="SELECT * FROM tbladmin";
	$result=mysql_query($sql1, $link);
	$res1=  mysql_fetch_array($result);
    //Create a new PHPMailer instance
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
	$mail->Subject = 'Nuevo Contacto desde la página Web.';
//$mail->Body = $mensaje;
	$mail->msgHTML($mensaje);

	if($mail->send()){
		echo '<script>alert("Mensaje enviado satisfactoriamente.");</script>';
	}

}


?>