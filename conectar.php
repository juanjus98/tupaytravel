<?php
define("DOMINIO", "localhost/tupaytravel");
define("MURL", "http://" . DOMINIO . "/");

define('DB_HOST', 'localhost');
define('DB_USER', 'tupaytra');
define('DB_PASSWORD', 'peru@2015');	
define('DB_DATABASE', 'tupaytra_bd2');

function conectar(){
$link = mysql_connect("localhost","root","12345678", "db_tupaytravel");
mysql_select_db("db_tupaytravel",$link);

mysql_query("SET NAMES 'utf8'"); //change added by me resuelve el problema del cotejamiento
if (!$link) {
  die('No se pudo establecer una conexi��n: ' . mysql_error());
}
 return $link;
}
?>