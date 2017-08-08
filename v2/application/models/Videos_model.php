<?php

class Videos_model extends CI_Model {

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
        if (!empty($data['categoria_id'])) {
            $where["t1.categoria_id"] = $data['categoria_id'];
        }

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.titulo"] = "";
        }

        $resultado = $this->db->select("t1.*")
                /*->join("categoria as t2","t2.id = t1.categoria_id","left")*/
                ->where($where)
                ->like($like)
                ->get("tblvideos as t1")
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
        //Where
        $where = array('t1.estado != ' => 0);

        //Where
        if (!empty($data['categoria_id'])) {
            $where["t1.categoria_id"] = $data['categoria_id'];
        }

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.titulo"] = "";
        }


        //ORDENAR POR
        if (!empty($data['ordenar_por'])) {
            $order_by = $data['ordenar_por'] . ' ' . $data['ordentipo'];
        } else {
            $order_by = 't1.orden ASC';
        }

        if ($start > 0) {
            $start = ($start - 1) * $limit;
        }

        $resultado = $this->db->select("t1.*")
                /*->join("categoria as t2","t2.id = t1.categoria_id","left")*/
                ->where($where)
                ->like($like)
                ->order_by($order_by)
                ->limit($limit, $start)
                ->get("tblvideos as t1")
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

        $result = $this->db->select("t1.*")
                /*->join("categoria as t2","t2.id = t1.categoria_id","left")
                ->join("marca as t3","t3.id = t1.marca_id","left")*/
                ->where($where)
                ->get("tblpromociones as t1")
                ->row_array();

        return $result;
    }


}
