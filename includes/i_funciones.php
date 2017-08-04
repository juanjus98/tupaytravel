<?php
/**
 * Urls amigables
 */
function url_amigable($url) {
    $url = strtolower($url);
    $find = array('�', '�', '�', '�', '�', '�');
    $repl = array('a', 'e', 'i', 'o', 'u', 'n');
    $url = str_replace($find, $repl, $url);
    $find = array(' ', '&', '\r\n', '\n', '+');
    $url = str_replace($find, '-', $url);
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl = array('', '-', '');
    $url = preg_replace($find, $repl, $url);
    return $url;
}

/**
 * Paises
 */
function getPaises(){
    include('countries.php');
    return $countries;
}
?>