<?php

class Paginas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Total de categorías
     *
     * Muestra el total de categorías
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function total_registros($data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.nombre_corto"] = "";
        }

        $resultado = $this->db->select("*")
        ->where($where)
        ->like($like)
        ->get("pagina as t1")
        ->num_rows();
        return $resultado;
    }

    /**
     * Listado de categorías
     *
     * Muestra un listado de todas las categorías
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function listado($limit, $start, $data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Where
        if (!empty($data['ciudad'])) {
            $where["t2.ciudad"] = $data['ciudad'];
        }

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.nombre_corto"] = "";
        }

        //ORDENAR POR
        if (!empty($data['ordenar_por'])) {
            $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
        } else {
            $order_by = 't1.agregar DESC';
        }

        if ($start > 0) {
            $start = ($start - 1) * $limit;
        }

        $resultado = $this->db->select("*")
        ->where($where)
        ->like($like)
        ->order_by($order_by)
        ->limit($limit, $start)
        ->get("pagina as t1")
        ->result_array();
        return $resultado;
    }

    /**
     * Cosultar categoría
     *
     * Trae la información de una categoria
     *
     * @package     productos
     * @author      Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since       02-03-2014
     * @version     Version 1.0
     */
    function get_row($data) {
        $where = array('t1.estado != ' => 0);
        if(!empty($data['id'])){
            $where['t1.id'] = $data['id'];
        }

        if(!empty($data['url_key'])){
            $where['t1.url_key'] = $data['url_key'];
        }

        $result = $this->db->select("t1.*")
        ->where($where)
        ->get("pagina as t1")
        ->row_array();


        return $result;
    }

}
