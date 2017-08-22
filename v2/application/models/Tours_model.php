<?php

class Tours_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Total de productos
     *
     * Muestra el total de productos
     *
     * @package		productos
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function total_registros($data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Where
        if (!empty($data['id_tbltours_categoria'])) {
            $where["t1.id_tbltours_categoria"] = $data['id_tbltours_categoria'];
        }

        if (!empty($data['id_provincia'])) {
            $where["t1.id_provincia"] = $data['id_provincia'];
        }

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.nombre"] = "";
        }

        $resultado = $this->db->select("t1.*, t2.categoria, t3.provincia")
        ->join("tbltours_categoria as t2","t2.id = t1.id_tbltours_categoria")
        ->join("tblprovincia as t3","t3.id = t1.id_provincia")
        ->where($where)
        ->like($like)
        ->get("tbltours as t1")
        ->num_rows();

        return $resultado;
    }

    /**
     * Listado de productos
     *
     * Muestra un listado de todas las productos
     *
     * @package		productos
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function listado($limit, $start, $data = NULL) {
        /*echo "<pre>";
        print_r($data);
        echo "</pre>";*/
        //Where
        $where = array('t1.estado != ' => 0);

        //Where
        if (!empty($data['id_tbltours_categoria'])) {
            $where["t1.id_tbltours_categoria"] = $data['id_tbltours_categoria'];
        }

        if (!empty($data['id_provincia'])) {
            $where["t1.id_provincia"] = $data['id_provincia'];
        }

        //Like
        if (!empty($data['busqueda'])) {
        /*if (!empty($data['campo']) && !empty($data['busqueda'])) {*/
            $like["t1.nombre"] = $data['busqueda'];
        } else {
            $like["t1.nombre"] = "";
        }


        //ORDENAR POR
        if (!empty($data['ordenar_por'])) {
            $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
        } else {
            $order_by = 't1.nombre ASC';
        }

        if ($start > 0) {
            $start = ($start - 1) * $limit;
        }

        $resultado = $this->db->select("t1.*, t2.categoria, t3.provincia")
        ->join("tbltours_categoria as t2","t2.id = t1.id_tbltours_categoria")
        ->join("tblprovincia as t3","t3.id = t1.id_provincia")
        ->where($where)
        ->like($like)
        ->order_by($order_by)
        ->limit($limit, $start)
        ->get("tbltours as t1")
        ->result_array();

        return $resultado;
    }

    /**
     * Cosultar categoría
     *
     * Trae la información de una categoria
     *
     * @package		productos
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function get_row($data) {
        $where = array('t1.estado != ' => 0);
        if(!empty($data['id'])){
            $where['t1.id'] = $data['id'];
        }

        if(!empty($data['url_key'])){
            $where['t1.url_key'] = $data['url_key'];
        }

        $resultado = $this->db->select("t1.*, t2.categoria, t3.provincia")
        ->join("tbltours_categoria as t2","t2.id = t1.id_tbltours_categoria")
        ->join("tblprovincia as t3","t3.id = t1.id_provincia")
        ->where($where)
        ->get("tbltours as t1")
        ->row_array();

        //Consultar itinerario (galeria)
        $itinerarios = $this->db->select("t1.*")
        ->where("t1.id_tbltours =", $resultado['id'])
        ->where("t1.estado !=", 0)
        ->order_by('t1.orden','ASC')
        ->get("tbltours_itinerario as t1")
        ->result_array();
        if (!empty($itinerarios)) {
            $resultado['itinerarios'] = $itinerarios;
        }

        return $resultado;
    }

/**
     * Listado de productos
     *
     * Muestra un listado de todas las productos
     *
     * @package     productos
     * @author      Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since       02-03-2014
     * @version     Version 1.0
     */
function listadoDias() {
    $where = array('t1.estado != ' => 0);

    $resultado = $this->db->select("t1.nro_dias")
    ->where($where)
    ->group_by('t1.nro_dias')
    ->order_by('t1.nro_dias','ASC')
    ->get("tbltours as t1")
    ->result_array();
    
    return $resultado;
}


}
