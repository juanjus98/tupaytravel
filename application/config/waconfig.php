<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Administrador
 */
$config['admin_name'] = "Administrador";

$config['admin_domain'] = "tupaytravel.com";
$config['admin_url'] = "http://" . $config['admin_domain'];
$config['admin_logo'] = $config['admin_url'] . "/assets/images/waadmin/logo.png";

//Direcotio de admin
$config['admin_path'] = 'waadmin';

/**
 * Generales para el website
 */
$config['website']['dominio'] = "www.tupaytravel.com";

/**
 * Directorio de carga de imagenes
 */
$config['upload_path'] = "/assets/images/uploads/";
$config['galeria_upload_path'] = "/assets/galeria/";

/**
 * Configuración de email
 */
$config['waemail']['dominio'] = "www.tupaytravel.com";
$config['waemail']['logo'] = "http://tupaytravel.com/assets/images/logo_email.jpg";
$config['waemail']['color'] = "#99C115";