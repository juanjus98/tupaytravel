<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Configurar Auth
  |--------------------------------------------------------------------------
  |
  | Configurar la tabla y los campos de usuario,
  | guardarlos en una session
  | Auth work.
  |
  | 'user_table' = Tabla de usuarios
  | 'user_columns' = Columnas de la tabla a guardar en la session
  | 'user_id_column' = Nombre de la columna id
  | 'user_username_column' = Nombre de la columna que guarga el nombre de usuario
  | 'user_password_column' = Nombre de la columna que guarga el password
 */
  $config['user_table'] = "wa_usuario";
  $config['user_columns'] = array("id_usuario", "id_personal", "id_rol", "usuario","password");
  $config['user_id_column'] = "id_usuario";
  $config['user_username_column'] = "usuario";
  $config['user_password_column'] = "password";

  $config['profile_table'] = "wa_personal";
  $config['profile_id_column'] = "id_personal";

//url si aún no se ha logeado
  $config['url_logged_in'] = "waadmin/login";
//$config['url_logged_in'] = "index.php/login";

//url si se ha logeado correctamente
  $config['url_login'] = "waadmin/inicio";

//url salir del sistema logout()
  $config['url_logout'] = "waadmin/login";
//$config['url_logout'] = "index.php/login";
//