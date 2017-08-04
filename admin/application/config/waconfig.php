<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Administrador
 */
$config['admin_name'] = "Administrador";

$config['admin_domain'] = "salonesyeventos.pe";
$config['admin_url'] = "http://" . $config['admin_domain'];
$config['admin_logo'] = $config['admin_url'] . "/images/logo-admin.png";

//Direcotio de admin
$config['admin_path'] = 'waadmin';

/**
 * Generales para el website
 */
$config['website']['dominio'] = "www.salonesyeventos.pe";

/**
 * Directorio de carga de imagenes
 */
$config['upload_path'] = "/images/uploads/";

/**
 * Configuración de email
 */
$config['waemail']['dominio'] = "www.salonesyeventos.pe";
$config['waemail']['logo'] = "http://www.salonesyeventos.pe/images/logo.png";
$config['waemail']['color'] = "#F3A313";