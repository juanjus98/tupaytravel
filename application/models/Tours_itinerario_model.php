<?php

class Tours_itinerario_model extends CI_Model {

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

        if (!empty($data['id_tbltours'])) {
            $where["t1.id_tbltours"] = $data['id_tbltours'];
        }

        $resultado = $this->db->select("*")
                ->where($where)
                ->get("tbltours_itinerario as t1")
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

        if (!empty($data['id_tbltours'])) {
            $where["t1.id_tbltours"] = $data['id_tbltours'];
        }

        if ($start > 0) {
            $start = ($start - 1) * $limit;
        }

        $resultado = $this->db->select("*")
                ->where($where)
                ->order_by("t1.orden", "asc")
                ->limit($limit, $start)
                ->get("tbltours_itinerario as t1")
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
    function get_row($id) {
        $result = $this->db->select("t1.*")
                ->where("t1.id =", $id)
                ->where("t1.estado !=", 0)
                ->get("tbltours_itinerario as t1")
                ->row_array();
        return $result;
    }

}
