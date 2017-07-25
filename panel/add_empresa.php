<?php

include("../../config/config.php");
extract($_REQUEST);
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';
//$nombre_empresa=utf8_decode($nombre_empresa);
////$descripcion=utf8_decode($descripcion);
//$direccion=utf8_decode($direccion);
//$contacto=utf8_decode($contacto);

$descripcion = addslashes($descripcion);

if (isset($verificado)) {
    $verificado = 1;
} else {
    $verificado = 0;
}

$sql = "Insert Into empresa (id_categoria, id_subcategoria, nombre_empresa, descripcion, website, direccion, "
        . "telefono, email, logo, url_video, contacto,desde, kerwords,verificado) "
        . "Values('$id_categoria', '$id_subcategoria', '$nombre_empresa', '$descripcion', '$website', '$direccion', "
        . "'$telefono', '$email', '$logo', '$url_video', '$contacto','$desde', '$kerwords','$verificado')";
if (mysql_query($sql)) {
    $sw = 1;
} else {
    $sw = 0;
}

echo $sw;
?>