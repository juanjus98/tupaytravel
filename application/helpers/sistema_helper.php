<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');


if (!function_exists('modulos_menus')) {
 function modulos_menus($segment=null) {
   $CI = & get_instance();

   /*Consultamos wa_modulos*/
   $CI->db->select('*');
   $CI->db->where("visible",1);
   $CI->db->where("estado",1);
   $CI->db->order_by("orden","ASC");
   $modulos = $CI->db->get('wa_modulo')->result_array();

   $html = '';
   $ii=0;
   foreach ($modulos as $key => $modulo) {
     $id_modulo = "modulo_" . $modulo['id_modulo'];

     $active_modulo = "";
     if (isset($_COOKIE[$id_modulo]) && $_COOKIE[$id_modulo] == 1) $active_modulo = "active";

     $modulo_collapse = 'collapse' .$modulo['id_modulo'];
     $html .= '<li class="treeview '.$active_modulo.'"><a href="#" class="wa-modulo" data-idmodulo="modulo_'.$modulo['id_modulo'].'"><i class="fa '.$modulo['icono'].'"></i> <span>'.$modulo['nombre_modulo'].'</span><i class="fa fa-angle-left pull-right"></i></a>';

     /*Cosultamos menus*/
     $CI->db->select('*');
     $CI->db->where("id_modulo",$modulo['id_modulo']);
     $CI->db->where("estado",1);
     $CI->db->order_by("orden","ASC");
     $menus = $CI->db->get('wa_menu')->result_array();

     if(!empty($menus)){
       $ii++;
       $class_in = '';
       if($ii == 1){ $class_in = 'in';}

       $html .= '<ul class="treeview-menu">';
       foreach ($menus as $key => $menu) {
         $url_ruta = base_url($menu['ruta']);
         $html .= '<li><a href="'.$url_ruta.'"><i class="fa fa-angle-double-right"></i> '.$menu['nombre_menu'].'</a></li>';
       }

       $html .= '</ul>';
     }
     $html .= '</li>';
   }

   return $html;
 }
}


/**
 * Tipo
 * 
 * @category Tipo
 * @author Juan Julio Sandoval Layza
 * @since 10-11-2014
 * @version Version 1.0
 */
if (!function_exists('get_tipo')) {
 $CI = & get_instance();

 function get_tipo($string) {
   if (substr($string, 0, 3) == '519') {
     $result = "Movil";
   } else {
     $result = "Fijo";
   }
   return $result;
 }

}

/**
 * Estados
 * 
 * @category Estados
 * @author Juan Julio Sandoval Layza
 * @since 10-11-2014
 * @version Version 1.0
 */
if (!function_exists('get_estados')) {
 $CI = & get_instance();

 function get_estados($id = NULL) {
   $items = array(
     "1" => "Pendiente",
     "2" => "Completado",
     "3" => "No contestado",
     "-1" => "Error",
     "9" => "Llamada en curso"
     );

   if (isset($id)) {
     return $items[$id];
   } else {
     return $items;
   }
 }

}

/**
 * Estados
 * 
 * @category Estados
 * @author Juan Julio Sandoval Layza
 * @since 10-11-2014
 * @version Version 1.0
 */
if (!function_exists('get_estados_timpos')) {
 $CI = & get_instance();

 function get_estados_timpos($id = NULL) {
   $items = array(
     "1" => "Poca duración",
     "2" => "Duración Parcial",
     "3" => "Duración Completa",
     );

   if (isset($id)) {
     return $items[$id];
   } else {
     return $items;
   }
 }

}

/**
 * Estados para listado
 * 
 * @category Estados para listado
 * @author Juan Julio Sandoval Layza
 * @since 10-11-2014
 * @version Version 1.0
 */
if (!function_exists('get_estados_list')) {
 $CI = & get_instance();

 function get_estados_list($llamada_duracion) {
   $items = array(
     "1" => "Poca duración",
     "2" => "Duración Parcial",
     "3" => "Duración Completa",
     );

   switch ($llamada_duracion) {
     case $llamada_duracion < 6:
     $id_duracion = 1;
     break;
     case $llamada_duracion >= 6 && $llamada_duracion < 11:
     $id_duracion = 2;
     break;
     case $llamada_duracion >= 11:
     $id_duracion = 3;
     break;
   }

   return $items[$id_duracion];
 }

}

if (!function_exists('fecha_es')) {

 /**
 * Fecha en español
 *
 * Formatea una fecha MySQL (Y-m-d) a una fecha en español.
 * 
 * Uso: fecha_es(fecha_mysql, formato de retorno, opcional incluir hora)
 * 
 * @package Fecha en español
 * @author Juan Julio Sandoval Layza
 * @since 25-06-2014
 * @version Version 1.0
 */
 function fecha_es($fecha_mysql, $formato = "d/m/a", $incluir_hora = FALSE) {
   $fecha_en = strtotime($fecha_mysql);
 $dia = date("l", $fecha_en); // Sunday
 $ndia = date("d", $fecha_en); // 01-31
 $mes = date("m", $fecha_en); // 01-12
 $ano = date("Y", $fecha_en); // 2014
 $hora = date("H:i:s", $fecha_en); // H-i-s (Hora, minutos, segundos)

 $dias = array('Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miercoles', 'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sabado', 'Sunday' => 'Domingo');
 $meses = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Setiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');

 switch ($formato) {
   case "d/m/a":
   $fecha_es = date("d/m/Y", $fecha_en);
//Resultado: 25/06/2014
   break;
   case "d-m-a":
   $fecha_es = date("d-m-Y", $fecha_en);
//Resultado: 25-06-2014
   break;
   case "d.m.a":
   $fecha_es = date("d.m.Y", $fecha_en);
//Resultado: 25.06.2014
   break;
   case "d M a":
   $fecha_es = $ndia . " " . substr($meses[$mes], 0, 3) . " " . $ano;
//Resultado: 25 Jun 2014
   break;
   case "d F a":
   $fecha_es = $ndia . " " . $meses [$mes] . " " . $ano;
//Resultado: 25 Junio 2014
   break;
   case "D d M a":
   $fecha_es = substr($dias[$dia], 0, 3) . " " . $ndia . " " . substr($meses[$mes], 0, 3) . " " . $ano;
//Resultado: Mar 25 Jun 2014
   break;
   case "L d F a":
   $fecha_es = $dias[$dia] . " " . $ndia . " " . $meses [$mes] . " " . $ano;
//Resultado: Martes 25 Junio 2014
   break;
 }

 if ($incluir_hora) {
   $fecha_es .= " " . $hora;
 }

 return $fecha_es;
}

}

if (!function_exists('msj')) {

 function msj() {
   $CI = & get_instance();
   $str = "";

   if ($CI->session->userdata("msj_success")) {
     $str = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $CI->session->userdata("msj_success") . '</div>';
     $CI->session->unset_userdata("msj_success");
   }

   if ($CI->session->userdata("msj_error")) {
     $str = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $CI->session->userdata("msj_error") . '</div>';
     $CI->session->unset_userdata("msj_error");
   }

   return $str;
 }

}

if (!function_exists('notify')) {

 function notify() {
   $CI = & get_instance();
   $str = "";

 $resultado = "";

   if ($CI->session->userdata("msj_success")) {

     $resultado = array(
       'tipo' => 'msj_success',
       'titulo' => 'Exito.',
       'mensaje' => $CI->session->userdata("msj_success")
       );

     $CI->session->unset_userdata("msj_success");
   }

   if ($CI->session->userdata("msj_error")) {
     $resultado = array(
       'tipo' => 'msj_error',
       'titulo' => 'Error',
       'mensaje' => $CI->session->userdata("msj_error")
       );

     $CI->session->unset_userdata("msj_error");
   }


   echo '<script type="text/javascript">var msjnotify=\''.json_encode($resultado).'\';</script>';

 }

}

if (!function_exists('set_paginacion')) {

 function set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows) {
   $config = array();
   $config["base_url"] = $base_url;
   $config["per_page"] = $per_page;
   $config["uri_segment"] = $uri_segment;
   $config['use_page_numbers'] = TRUE;
   $config['num_links'] = $num_links;

   $config['full_tag_open'] = '<ul class="pagination">';
   $config['full_tag_close'] = '</ul>';

   $config['first_link'] = '&laquo;';
   $config['first_tag_open'] = '<li>';
   $config['first_tag_close'] = '</li>';

   $config['last_link'] = '&raquo;';
   $config['last_tag_open'] = '<li>';
   $config['last_tag_close'] = '</li>';
   $config['next_link'] = '&gt;';
   $config['next_tag_open'] = '<li>';
   $config['next_tag_close'] = '</li>';

   $config['prev_link'] = '&lt;';
   $config['prev_tag_open'] = '<li>';
   $config['prev_tag_close'] = '</li>';

   $config['cur_tag_open'] = '<li class="active"><span>';
   $config['cur_tag_close'] = '</span></li>';

   $config['num_tag_open'] = '<li>';
   $config['num_tag_close'] = '</li>';

   $config["total_rows"] = $total_rows;

   return $config;
 }

}