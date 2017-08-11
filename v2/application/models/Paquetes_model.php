<?php

class Paquetes_model extends CI_Model {

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
        if (!empty($data['ciudad'])) {
            $where["t2.ciudad"] = $data['ciudad'];
        }

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.nombre"] = "";
        }

        $resultado = $this->db->select("t1.*")
                ->join("tblpaquete_ciudades as t2","t2.id_tblpaquete = t1.id","left")
                ->where($where)
                ->where_in('t1.ciudades','CUSCO')
                ->like($like)
                ->group_by('t1.id')
                ->get("tblpaquete as t1")
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
        if (!empty($data['ciudad'])) {
            $where["t2.ciudad"] = $data['ciudad'];
        }

        //Like
        if (!empty($data['campo']) && !empty($data['busqueda'])) {
            $like[$data['campo']] = $data['busqueda'];
        } else {
            $like["t1.nombre"] = "";
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

        $resultado = $this->db->select("t1.*")
                ->join("tblpaquete_ciudades as t2","t2.id_tblpaquete = t1.id","left")
                ->where($where)
                ->like($like)
                ->group_by('t1.id')
                ->order_by($order_by)
                ->limit($limit, $start)
                ->get("tblpaquete as t1")
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
                ->where($where)
                ->get("tblpaquete as t1")
                ->row_array();

        //Consultar itinerario (galeria)
        $itinerarios = $this->db->select("t1.*")
                ->where("t1.id_tblpaquete =", $result['id'])
                ->where("t1.estado !=", 0)
                ->order_by('t1.orden','ASC')
                ->get("tblpaquete_galeria as t1")
                ->result_array();
        if (!empty($itinerarios)) {
            $result['itinerarios'] = $itinerarios;
        }

        //Consultar ciudades
        $ciudades_result = $this->db->select("t1.*")
                ->where("t1.id_tblpaquete =", $result['id'])
                ->order_by('t1.id','ASC')
                ->get("tblpaquete_ciudades as t1")
                ->result_array();
        if (!empty($ciudades_result)) {
            foreach ($ciudades_result as $key => $value) {
                $ciudades[] = $value['ciudad'];
            }
            $result['ciudades'] = $ciudades;
        }

        return $result;
    }
    

}
