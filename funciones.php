<?php
/* * ************************URLS AMIGABLES************************** */

function url_amigable($url) {

    $url = strtolower($url);

//Rememplazamos caracteres especiales latinos

    $find = array('�', '�', '�', '�', '�', '�');

    $repl = array('a', 'e', 'i', 'o', 'u', 'n');

    $url = str_replace($find, $repl, $url);

// A�aadimos los guiones

    $find = array(' ', '&', '\r\n', '\n', '+');
    $url = str_replace($find, '-', $url);

// Eliminamos y Reemplazamos dem�s caracteres especiales

    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

    $repl = array('', '-', '');

    $url = preg_replace($find, $repl, $url);

    return $url;
}
?>