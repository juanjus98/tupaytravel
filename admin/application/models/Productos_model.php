<?php

class Productos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function set_post($searchterm) {
        if ($searchterm) {
            $this->session->set_userdata('s_post', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('s_post')) {
            $searchterm = $this->session->userdata('s_post');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
    }


    public function set_post_productos($searchterm) {
        if ($searchterm) {
            $this->session->set_userdata('s_post_productos', $searchterm);
            return $searchterm;
        } elseif ($this->session->userdata('s_post_productos')) {
            $searchterm = $this->session->userdata('s_post_productos');
            return $searchterm;
        } else {
            $searchterm = "";
            return $searchterm;
        }
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
            $like["t1.nombre_corto"] = "";
        }

        $resultado = $this->db->select("t1.*, t2.nombre as categoria_nombre")
                ->join("categoria as t2","t2.id = t1.categoria_id","left")
                ->where($where)
                ->like($like)
                ->get("producto as t1")
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

        $resultado = $this->db->select("t1.*, t2.nombre as categoria_nombre")
                ->join("categoria as t2","t2.id = t1.categoria_id","left")
                ->where($where)
                ->like($like)
                ->order_by($order_by)
                ->limit($limit, $start)
                ->get("producto as t1")
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

        $result = $this->db->select("t1.*, t2.nombre as categoria_nombre, t3.nombre as marca_nombre")
                ->join("categoria as t2","t2.id = t1.categoria_id","left")
                ->join("marca as t3","t3.id = t1.marca_id","left")
                ->where($where)
                ->get("producto as t1")
                ->row_array();

        //Caracteristicas
        $producto_caracteristicas = $this->db->select("t1.*")
                ->where("t1.producto_id =", $result['id'])
                ->where("t1.estado !=", 0)
                ->get("producto_caracteristicas as t1")
                ->result_array();
        if (!empty($producto_caracteristicas)) {
            foreach ($producto_caracteristicas as $item) {
                $arr_caracteristicas['titulo'][] = $item['nombre'];
                $arr_caracteristicas['descripcion'][] = $item['descripcion'];
            }
            $result['caracteristicas'] = $arr_caracteristicas;
        }

        //Especificaciones
        $producto_especificaciones = $this->db->select("t1.*")
                ->where("t1.producto_id =", $result['id'])
                ->where("t1.estado !=", 0)
                ->get("producto_especificaciones as t1")
                ->result_array();

        if (!empty($producto_especificaciones)) {
            foreach ($producto_especificaciones as $item) {
                $arr_especificaciones['titulo'][] = $item['nombre'];
                $arr_especificaciones['descripcion'][] = $item['descripcion'];
            }
            $result['especificaciones'] = $arr_especificaciones;
        }


        return $result;
    }
    
    /**
     * Listado de marcas
     *
     * Trae un listado de las marcas (td:marca)
     *
     * @package		Productos
     * @author		Juan Julio Sandoval Layza
     * @copyright       webApu.com 
     * @since		04-02-2016
     * @version		Version 1.0
     */
    function listar_marcas() {
        $resultado = $this->db->select("t1.*")
                ->where("estado != ", 0)
                ->order_by("t1.orden", "asc")
                ->get('marca as t1')
                ->result_array();
        return $resultado;
    }

    /**
     * Listado de productos relacionados
     *
     * Muestra un listado de todas las productos
     *
     * @package     productos
     * @author      Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since       02-03-2014
     * @version     Version 1.0
     */
    function get_relacionados($producto_id, $categoria_id, $limit = 3) {
        //Where
        $where = array('t1.estado != ' => 0);

        //Where
        if (!empty($data['producto_id'])) {
            $where["t1.producto_id != "] = $data['producto_id'];
        }

        if (!empty($data['categoria_id'])) {
            $where["t1.categoria_id != "] = $data['categoria_id'];
        }

        //ORDENAR POR
        $order_by = 't1.agregar DESC';

        $resultado = $this->db->select("t1.*, t2.nombre as categoria_nombre, t3.nombre as marca_nombre")
                ->join("categoria as t2","t2.id = t1.categoria_id")
                ->join("marca as t3","t3.id = t1.marca_id")
                ->where($where)
                ->order_by($order_by)
                ->limit($limit)
                ->get("producto as t1")
                ->result_array();

        return $resultado;
    }

}
