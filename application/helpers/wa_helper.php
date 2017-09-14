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
        //Menu
        $CI->load->model('menu_model', 'Menu');

        //Menú tours
        $resultado = $CI->Menu->menuTours();
        foreach ($resultado as $key => $value) {
            $url_key = 'tours/' . $value['url_key'];
            $menuTours[$url_key] = $value['provincia'];
        }

        //Menú estadia
        $resultado = $CI->Menu->menuEstadia();
        foreach ($resultado as $key => $value) {
            /*$urlkey = url_title(convert_accented_characters($value['provincia_id'] . " " .$value['provincia']),'-', TRUE);
            $menuEstadia["hoteles/{$urlkey}"] = $value['provincia'];*/
            $url_key = 'hoteles/' . $value['url_key'];
            $menuEstadia[$url_key] = $value['provincia'];
        }


        $menu = array(
            'inicio' => '<i class="fa fa-home" aria-hidden="true"></i>',
            'paquetes-tours' => 'Paquetes Tour Perú',
            'Tours' => $menuTours,
            'Hoteles' => $menuEstadia
            );

        return $menu;
    }

}

if (!function_exists('crear_menu')) {

    function crear_menu($menu, $active_link=null, $is_submenu=null) {
        /*$nav = '<ul class="nav navbar-nav navbar-nav-wa">';*/
        $nav = ($is_submenu != 'SI') ? '<ul class="nav navbar-nav navbar-nav-wa">' : '' ;
        foreach ($menu as $key => $value) {
            $class_active = "";
            if ($key == $active_link) {
                $class_active = "active";
            }
            if (is_array($value)) {
                $nav .= '<li class="dropdown '.$class_active.'"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $key . ' <span class="caret"></span></a>' . PHP_EOL;
                $nav .= '<ul class="dropdown-menu">' . PHP_EOL . @crear_menu($value, null, 'SI') . PHP_EOL . '</ul>';
                $nav .= '</li>' . PHP_EOL;
            } else {
                $key = ($key!='inicio') ? $key : '' ;
                $nav .= '<li class="'.$class_active.'"><a href="' . base_url($key) .'">' . $value . '</a></li>' . PHP_EOL;
            }
        }

        /*$nav .= '</ul>';*/
        $nav .= ($is_submenu != 'SI') ? '</ul>' : '' ;
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
 * @category        Utilitarios
 * @author      Juan Julio Sandoval Layza
 * @since       08-05-2015
 * @version     Version 1.0
 */
if (!function_exists('head_info')) {

    function head_info($info, $page = "inicio") {
        $CI =& get_instance();
        if (!empty($info)) {
            switch ($page) {
                case "inicio":
                $head_info = array(
                    "title" => $info['title'],
                    "description" => strip_tags($info['description']),
                    "keywords" => strip_tags($info['keywords']),
                    "image" => base_url($CI->config->item('upload_path') . $info['imagen_1'])
                    );
                break;
                case "paquete":
                $head_info = array(
                    "title" => $info['nombre'],
                    "description" => strip_tags(str_replace("\n", "",$info['descripcion'])),
                    "keywords" => $info['keywords'],
                    "image" => base_url($CI->config->item('upload_path') . $info['imagen'])
                    );
                break;
                case "tour":
                $head_info = array(
                    "title" => $info['nombre'],
                    "description" => strip_tags(str_replace("\n", "",$info['descripcion'])),
                    "keywords" => $info['keywords'],
                    "image" => base_url($CI->config->item('upload_path') . $info['imagen'])
                    );
                break;
                case "hotel":
                $head_info = array(
                    "title" => $info['nombre'],
                    "description" => strip_tags(str_replace("\n", "",$info['descripcion'])),
                    "keywords" => $info['keywords'],
                    "image" => base_url($CI->config->item('upload_path') . $info['imagen'])
                    );
                break;
                case "pagina":
                $head_info = array(
                    "title" => $info['nombre_corto'],
                    "description" => strip_tags(str_replace("\n", "",$info['resumen'])),
                    "keywords" => $info['keywords'],
                    "image" => base_url($CI->config->item('upload_path') . $info['imagen_1'])
                    );
                break;
            }
        }
        return $head_info;
    }

}

/**
 * Video helper
 */
/**
 * Extracts the daily motion id from a daily motion url.
 * Returns false if the url is not recognized as a daily motion url.
 */
function getDailyMotionId($url)
{

    if (preg_match('!^.+dailymotion\.com/(video|hub)/([^_]+)[^#]*(#video=([^_&]+))?|(dai\.ly/([^_]+))!', $url, $m)) {
        if (isset($m[6])) {
            return $m[6];
        }
        if (isset($m[4])) {
            return $m[4];
        }
        return $m[2];
    }
    return false;
}


/**
 * Extracts the vimeo id from a vimeo url.
 * Returns false if the url is not recognized as a vimeo url.
 */
function getVimeoId($url)
{
    if (preg_match('#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#', $url, $m)) {
        return $m[1];
    }
    return false;
}

/**
 * Extracts the youtube id from a youtube url.
 * Returns false if the url is not recognized as a youtube url.
 */
function getYoutubeId($url)
{
    $parts = parse_url($url);
    if (isset($parts['host'])) {
        $host = $parts['host'];
        if (
            false === strpos($host, 'youtube') &&
            false === strpos($host, 'youtu.be')
            ) {
            return false;
    }
}
if (isset($parts['query'])) {
    parse_str($parts['query'], $qs);
    if (isset($qs['v'])) {
        return $qs['v'];
    }
    else if (isset($qs['vi'])) {
        return $qs['vi'];
    }
}
if (isset($parts['path'])) {
    $path = explode('/', trim($parts['path'], '/'));
    return $path[count($path) - 1];
}
return false;
}


/**
 * Gets the thumbnail url associated with an url from either:
 *
 *      - youtube
 *      - daily motion
 *      - vimeo
 *
 * Returns false if the url couldn't be identified.
 *
 * In the case of you tube, we can use the second parameter (format), which
 * takes one of the following values:
 *      - small         (returns the url for a small thumbnail)
 *      - medium        (returns the url for a medium thumbnail)
 *
 *
 *
 */
function getVideoThumbnailByUrl($url, $format = 'small')
{
    if (false !== ($id = getVimeoId($url))) {
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
        /**
         * thumbnail_small
         * thumbnail_medium
         * thumbnail_large
         */
        return $hash[0]['thumbnail_large'];
    }
    elseif (false !== ($id = getDailyMotionId($url))) {
        return 'http://www.dailymotion.com/thumbnail/video/' . $id;
    }
    elseif (false !== ($id = getYoutubeId($url))) {
        /**
         * http://img.youtube.com/vi/<insert-youtube-video-id-here>/0.jpg
         * http://img.youtube.com/vi/<insert-youtube-video-id-here>/1.jpg
         * http://img.youtube.com/vi/<insert-youtube-video-id-here>/2.jpg
         * http://img.youtube.com/vi/<insert-youtube-video-id-here>/3.jpg
         *
         * http://img.youtube.com/vi/<insert-youtube-video-id-here>/default.jpg
         * http://img.youtube.com/vi/<insert-youtube-video-id-here>/hqdefault.jpg
         * http://img.youtube.com/vi/<insert-youtube-video-id-here>/mqdefault.jpg
         * http://img.youtube.com/vi/<insert-youtube-video-id-here>/sddefault.jpg
         * http://img.youtube.com/vi/<insert-youtube-video-id-here>/maxresdefault.jpg
         */
        if ('medium' === $format) {
            return 'http://img.youtube.com/vi/' . $id . '/hqdefault.jpg';
        }
        return 'http://img.youtube.com/vi/' . $id . '/default.jpg';
    }
    return false;
}

/**
 * Returns the location of the actual video for a given url which belongs to either:
 *
 *      - youtube
 *      - daily motion
 *      - vimeo
 *
 * Or returns false in case of failure.
 * This function can be used for creating video sitemaps.
 */
function getVideoLocation($url)
{
    if (false !== ($id = getDailyMotionId($url))) {
        return 'http://www.dailymotion.com/embed/video/' . $id;
    }
    elseif (false !== ($id = getVimeoId($url))) {
        return 'http://player.vimeo.com/video/' . $id;
    }
    elseif (false !== ($id = getYoutubeId($url))) {
        return 'http://www.youtube.com/embed/' . $id;
    }
    return false;
}