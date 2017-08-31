<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Auth
 *
 * Autenticacion de usuarios
 *
 * @package Auth
 * @subpackage Libraries
 * @category Libraries
 * @author Juan Julio Sandoval Layza
 */
class Auth {
 var $ci;
 /**
 * Constructor - Sets Preferences
 *
 * The constructor can be passed an array of config values
 */
 function __construct() {
   $this->ci = & get_instance();
   $this->ci->config->load('auth', TRUE);
   $this->ci->load->library('bcrypt');
   /*log_message('debug', 'Auth Class Initialized');*/
 }
 // --------------------------------------------------------------------
 /**
 * Login
 *
 * @access public
 * @param array
 * @return void
 */
 function login($data) {
   $result = $this->ci->db->select($this->ci->config->item('user_columns', 'auth'))
   ->where($this->ci->config->item('user_username_column', 'auth'), $data['usuario'])
   ->get($this->ci->config->item('user_table', 'auth'))
   ->row_array();

   $compare = $this->ci->bcrypt->compare($data['contrasena'], $result['password']);
   if(!empty($compare)){
     unset($result['password']);
     $data_insert = array(
       'id_usuario' => $result['id_usuario'],
       'direccion_ip' => $this->ci->input->ip_address(),
       'ingreso' => date("Y-m-d H:i:s"),
       'estado' => 'Logueado'
       );
     $this->ci->db->insert('wa_acceso', $data_insert);
     $result['acceso_info'] = $data_insert;
     $result['authentication'] = TRUE;
     $this->ci->session->set_userdata('s_user_info', $result);
     return TRUE;
   } else {
     return FALSE;
   }
 }
 // --------------------------------------------------------------------
 /**
 * Valida Contraseña
 *
 * @access public
 */
 function valida_contrasena($data) {
   $result = $this->ci->db->select($this->ci->config->item('user_columns', 'auth'))
   ->where($this->ci->config->item('user_username_column', 'auth'), $data['usuario'])
   ->get($this->ci->config->item('user_table', 'auth'))
   ->row_array();
   $compare = $this->ci->bcrypt->compare($data['contrasena'], $result['password']);
   if(!empty($compare)){
     return TRUE;
   } else {
     return FALSE;
   }
 }
 // --------------------------------------------------------------------
 /**
 * Logout
 *
 * @access public
 */
 function logout() {
   $user_info = $this->ci->session->userdata('s_user_info');
 //Insertamos datos de acceso
   $data_insert = array(
     'id_usuario' => $user_info['id_usuario'],
     'direccion_ip' => $this->ci->input->ip_address(),
     'ingreso' => date("Y-m-d H:i:s"),
     'estado' => 'Deslogueado'
     );
   $this->ci->db->insert('wa_acceso', $data_insert);
   $this->ci->session->sess_destroy();
   redirect($this->ci->config->item('url_logout', 'auth'));
 }
 // --------------------------------------------------------------------
 /**
 * Logged_in (Verfica si hay una session iniciada)
 *
 * @access public
 */
 function logged_in() {
   $id = $this->ci->session->userdata('s_user_info');
   if ($id) {
     return TRUE;
   } else {
     redirect($this->ci->config->item('url_logged_in', 'auth'));
   }
 }
 /**
 * Perfil de usuario.
 * Información detallada del perfil de usuario que ha iniciado sesión.
 *
 * @category Library
 * @package Auth
 * @subpackage user_profile
 * @author Juan Julio Sandoval <juanjus98@gmail.com>
 * @since 2016-12-13
 * @version 0.1
 * @return [array]
 */
 function user_profile() {
   $user_info = $this->ci->session->userdata('s_user_info');
   if($user_info['authentication']){
     $result = $this->ci->db->select('t1.*, t2.*')
     ->join($this->ci->config->item('profile_table', 'auth').' As t2','t2.'.$this->ci->config->item('profile_id_column', 'auth').'= t1.'.$this->ci->config->item('profile_id_column', 'auth'))
     ->where('t1.'.$this->ci->config->item('user_id_column', 'auth'), $user_info['id_usuario'])
     ->get($this->ci->config->item('user_table', 'auth') . ' AS t1')
     ->row_array();
     unset($result['password']);
     if(!empty($result)){
       return $result;
     }
   }
   return FALSE;
 }
}