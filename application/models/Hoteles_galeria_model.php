<?php

class Hoteles_galeria_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Total de registros
     *
     * Muestra el total de registros
     *
     * @package		Servicios
     * @author		Juan Julio Sandoval Layza
     * @copyright       Winner System 
     * @since		20-05-2015
     * @version		Version 1.0
     */
    function total_registros($data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        if (!empty($data['id_hotel'])) {
            $where["t1.id_hotel"] = $data['id_hotel'];
        }

        $resultado = $this->db->select("*")
        ->where($where)
        ->get("tblfotos as t1")
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
     * @copyright       Winner System 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function listado($limit, $start, $data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        if (!empty($data['id_hotel'])) {
            $where["t1.id_hotel"] = $data['id_hotel'];
        }

        if ($start > 0) {
            $start = ($start - 1) * $limit;
        }

        $resultado = $this->db->select("*")
        ->where($where)
        ->order_by("t1.orden", "asc")
        ->limit($limit, $start)
        ->get("tblfotos as t1")
        ->result_array();

        return $resultado;
    }

    /**
     * Cosultar categoría
     *
     * Trae la información de una categoria
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright       Winner System 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function get_row($data) {
        $where = array('t1.estado != ' => 0);

        //Where
        if(!empty($data['id'])){
            $where["t1.id"] = $data['id'];
        }

        if(!empty($data['id_hotel'])){
            $where["t1.id_hotel"] = $data['id_hotel'];
        }

        if (!empty($data['principal'])) {
            $where["t1.principal"] = $data['principal'];
        }

        $result = $this->db->select("t1.*")
        ->where($where)
        ->get("tblfotos as t1")
        ->row_array();

        return $result;
    }

}
