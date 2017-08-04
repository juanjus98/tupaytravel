<?php

/**
 * Helper del Sistema
 *
 * funciones helper que ayudan al desarrollo de modulos del sistema
 *
 * @package		Helper del Sistema
 * @author		Juan Julio Sandoval Layza
 * @copyright           Winner System 
 * @since		07-04-2014
 * @version		Version 1.0
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Dividir texto en dos
 */
if (!function_exists('divideTexto')) {
    function divideTexto($str,$parts=2){
        $str = trim($str);
        $arr_str = explode(' ', $str);
        $num_text = count($arr_str);
        $str1="";
        $str2="";
        if($num_text > 1){
            $index_divide = round(($num_text / 2),0, PHP_ROUND_HALF_DOWN);
            foreach ($arr_str as $key => $value) {
                if($key < $index_divide){
                    $str1 .= " " .  $value;
                }else{
                    $str2 .= " " .  $value;
                }
            }
            $resultado = array(trim($str1),trim($str2));
        }else{
            $resultado = array(trim($str));
        }
        return $resultado;
    }
}

if (!function_exists('wamenu')) {

    function wamenu() {
        $CI= & get_instance();
        //Categorias de productos
        $CI->load->model('crud_model', 'Crud');

        $data_crud['table'] = "servicio as t1";
        $data_crud['columns'] = "t1.*";
        $data_crud['where'] = array("t1.estado !=" => 0);
        $data_crud['order_by'] = "t1.orden Asc";
        $resultado = $CI->Crud->getRows($data_crud);

        foreach ($resultado as $key => $value) {
            $servicios["servicio/{$value['url_key']}"] = $value['nombre_largo'];
        }


        $menu = array(
            'inicio' => 'Inicio',
            'contactanos' => 'Contactanos',
            'salones' => 'Salones',
            'servicios' => $servicios
        );

        return $menu;
    }

}

if (!function_exists('crear_menu')) {

    function crear_menu($menu, $active_link) {
        $nav = '<ul class="nav navbar-nav navbar-nav-wa">';
        foreach ($menu as $key => $value) {
            $class_active = "";
            if ($key == $active_link) {
                $class_active = "active";
            }
            if (is_array($value)) {
                $nav .= '<li class="dropdown '.$class_active.'"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $key . ' <span class="caret"></span></a>' . PHP_EOL;
                $nav .= '<ul class="dropdown-menu">' . PHP_EOL . @crear_menu($value) . PHP_EOL . '</ul>';
                $nav .= '</li>' . PHP_EOL;
            } else {
                $key = ($key!='inicio') ? $key : '' ;
                $nav .= '<li class="'.$class_active.'"><a href="' . base_url($key) .'">' . $value . '</a></li>' . PHP_EOL;
            }
        }

        $nav .= '</ul>';
        return $nav;
    }

}

if (!function_exists('crear_menu_responsive')) {

    function crear_menu_responsive($menu, $active_link) {
        $nav = '<ul class="mainmenu">';
        foreach ($menu as $key => $value) {
            $class_active = "";
            if ($key == $active_link) {
                $class_active = "active";
            }
            if (is_array($value)) {
                $nav .= '<li class="'.$class_active.'"><a href="javascript:;">' . $key . ' <span class="caret"></span></a>' . PHP_EOL;
                $nav .= '<ul class="submenu">' . PHP_EOL . @crear_menu_responsive($value) . PHP_EOL . '</ul>';
                $nav .= '</li>' . PHP_EOL;
            } else {
                $key = ($key!='inicio') ? $key : '' ;
                $nav .= '<li class="'.$class_active.'"><a href="' . base_url($key) .'">' . $value . '</a></li>' . PHP_EOL;
            }
        }

        $nav .= '</ul>';
        return $nav;
    }

}

if (!function_exists('productos_footer')) {

    function productos_footer($limit=9) {
        $CI= & get_instance();
        //Categorias de productos
        $CI->load->model('crud_model', 'Crud');

        $data_crud['table'] = "producto as t1";
        $data_crud['columns'] = "t1.*";
        $data_crud['where'] = array("t1.estado !=" => 0);
        $data_crud['order_by'] = "t1.orden Asc";
        $resultado = $CI->Crud->getRows($data_crud);

        return $resultado;
    }

}

/**
 * Mensajes
 *
 * Crea mensajes de exito y error
 * 
 * @category	Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		26-02-2015
 * @version		Version 1.0
 */
if (!function_exists('msj')) {

    function msj() {
        $CI = & get_instance();
        $str = "";

        if ($CI->session->userdata("msj_success")) {
            $str = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $CI->session->userdata("msj_success") . '</div>';
            $CI->session->unset_userdata("msj_success");
        }

        if ($CI->session->userdata("msj_error")) {
            $str = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $CI->session->userdata("msj_error") . '</div>';
            $CI->session->unset_userdata("msj_error");
        }

        return $str;
    }

}

/**
 * Paginacion
 *
 * Genera paginacion de registros
 * 
 * @category		Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		16-02-2015
 * @version		Version 1.0
 */
if (!function_exists('set_paginacion')) {

    function set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows) {
        $config = array();
        $config["base_url"] = $base_url;
        $config["per_page"] = $per_page;
        $config["uri_segment"] = $uri_segment;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $num_links;
        $config['page_query_string'] = FALSE;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';

        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Siguiente';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';

        $config['prev_link'] = 'Anterior';
        $config['prev_tag_open'] = '';
        $config['prev_tag_close'] = '';

        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';

        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';

        $config["total_rows"] = $total_rows;

        return $config;
    }

}

/**
 * Head info
 *
 * Genera iformación para el head para seo
 * 
 * @category		Utilitarios
 * @author		Juan Julio Sandoval Layza
 * @since		08-05-2015
 * @version		Version 1.0
 */
if (!function_exists('head_info')) {

    function head_info($info, $page = "inicio") {
        if (!empty($info)) {
            switch ($page) {
                case "inicio":
                $head_info = array(
                    "title" => $info['title'],
                    "description" => strip_tags($info['description']),
                    "keywords" => strip_tags($info['keywords']),
                    "image" => base_url() . "images/uploads/" . strip_tags($info['imagen_1'])
                    );
                break;
                case "salon":
                $head_info = array(
                    "title" => $info['nombre_largo'],
                    "description" => strip_tags(str_replace("\n", "",$info['descripcion'])),
                    "keywords" => $info['keywords'],
                    "image" => base_url() . "images/upload/" . $info['imagen_2']
                    );
                break;
                case "servicio":
                $head_info = array(
                    "title" => $info['nombre_largo'],
                    "description" => strip_tags(str_replace("\n", "",$info['descripcion'])),
                    "keywords" => $info['keywords'],
                    "image" => base_url() . "images/upload/" . $info['imagen_2']
                    );
                break;
            }
        }
        return $head_info;
    }

}