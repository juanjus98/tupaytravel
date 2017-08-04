<?php

class Paginas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Categorías de servisios
     *
     * Lista todos las categorias de los servicios
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       webApu.com
     * @since		07-05-2014
     * @version		Version 1.0
     */
    function get_servicio_categorias() {
        $result = $this->db->select("t1.*")
                ->where("t1.estado !=", 0)
                ->order_by("t1.orden", "Asc")
                ->get("servicio_categoria as t1")
                ->result_array();
        return $result;
    }

    /**
     * Categoría Servicio
     *
     * Trae información de un servicio
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       webApu.com
     * @since		07-05-2014
     * @version		Version 1.0
     */
    function get_servicio_categoria($url_key) {
        $result = $this->db->select("t1.*")
                ->where("t1.url_key", $url_key)
                ->where("t1.estado !=", 0)
                ->order_by("t1.orden", "Asc")
                ->get("servicio_categoria as t1")
                ->row_array();
        return $result;
    }

    /**
     * Servicios
     *
     * Servicios de una categoría
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       webApu.com
     * @since		07-05-2014
     * @version		Version 1.0
     */
    function get_servicios($url_key) {
        $result = $this->db->select("t1.*")
                ->join("servicio_categoria as t2", "t2.id=t1.servicio_categoria_id")
                ->where("t2.url_key", $url_key)
                ->where("t2.estado !=", 0)
                ->where("t1.estado !=", 0)
                ->order_by("t1.id", "Asc")
                ->get("servicio as t1")
                ->result_array();

//        echo '<pre>';
//        print_r($this->db->last_query());
//        echo '<pre>';
        return $result;
    }

    /**
     * Servicios
     *
     * Servicios de una categoría
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       webApu.com
     * @since		07-05-2014
     * @version		Version 1.0
     */
    function get_servicio($url_key, $servicio_url) {
        $result = $this->db->select("t1.*")
                ->join("servicio_categoria as t2", "t2.id=t1.servicio_categoria_id")
                ->where("t2.url_key", $url_key)
                ->where("t2.estado !=", 0)
                ->where("t1.estado !=", 0)
                ->order_by("t1.orden", "Asc")
                ->get("servicio as t1")
                ->result_array();
        return $result;
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
            $like["t1.nombre"] = "";
        }

        $resultado = $this->db->select("*")
                ->where($where)
                ->like($like)
                ->get("categoria as t1")
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

        $resultado = $this->db->select("*")
                ->where($where)
                ->like($like)
                ->order_by($order_by)
                ->limit($limit, $start)
                ->get("categoria as t1")
                ->result_array();
        return $resultado;
    }

    /**
     * Clientes
     *
     * Listado de clientes
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       webApu.com
     * @since		16-07-2015
     * @version		Version 1.0
     */
    function get_clientes() {
        $result = $this->db->select("t1.*")
                ->where("t1.estado !=", 0)
                ->order_by("t1.agregar", "Desc")
                ->get("cliente as t1")
                ->result_array();

//        echo '<pre>';
//        print_r($this->db->last_query());
//        echo '<pre>';
        return $result;
    }

    /**
     * Cliente
     *
     * Información de un clientes   
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       webApu.com
     * @since		16-07-2015
     * @version		Version 1.0
     */
    function get_cliente($id) {
        $result = $this->db->select("t1.*")
                ->where("t1.id", $id)
                ->where("t1.estado !=", 0)
                ->get("cliente as t1")
                ->row_array();

        //Galeria
        $result_galeria = $this->db->select("t1.*")
                ->where("t1.cliente_id", $id)
                ->where("t1.estado !=", 0)
                ->order_by("orden")
                ->get("cliente_galeria as t1")
                ->result_array();

        $result['galeria'] = $result_galeria;

//        echo '<pre>';
//        print_r($this->db->last_query());
//        echo '<pre>';
        return $result;
    }

    /**
     * Consultar pagina
     *
     * Trae la información de una pagina
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		07-05-2014
     * @version		Version 1.0
     */
    function get_pagina($pagina_id) {
        $result = $this->db->select("t1.*")
                ->where("t1.id =", $pagina_id)
                ->where("t1.estado !=", 0)
                ->get("pagina as t1")
                ->row_array();
        return $result;
    }

    /**
     * Consultar noticia_categoria
     *
     * Trae la información de las noticia_categoria
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		18-05-2014
     * @version		Version 1.0
     */
    function get_noticia_categorias() {
        $result = $this->db->select("t1.*")
                ->where("t1.estado !=", 0)
                ->order_by("t1.nombre", "Asc")
                ->get("noticia_categoria as t1")
                ->result_array();
        return $result;
    }

    /**
     * Consultar servicio
     *
     * Trae la información de un servicio
     *
     * @package		Servicios
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		18-05-2014
     * @version		Version 1.0
     */
    function get_noticia_categoria($id) {
        $result = $this->db->select("t1.*")
                ->where("t1.id =", $id)
                ->where("t1.estado !=", 0)
                ->get("noticia_categoria as t1")
                ->row_array();
        return $result;
    }

    /**
     * Total de noticias
     *
     * Muestra el total de noticias
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function total_registros_noticias($data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);
        if ($data['noticia_categoria_id'] != "all") {
            $where['t1.noticia_categoria_id'] = $data['noticia_categoria_id'];
        }

        if ($start > 0) {
            $start = ($start - 1) * $limit;
        }

        $resultado = $this->db->select("t1.*, t2.nombre as categoria_nombre")
                ->join("noticia_categoria as t2", "t2.id=t1.noticia_categoria_id")
                ->where($where)
                ->get("noticia as t1")
                ->num_rows();
        return $resultado;
    }

    /**
     * Listado de noticias
     *
     * Muestra un listado de todas las noticias
     *
     * @package		Noticias
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		02-03-2014
     * @version		Version 1.0
     */
    function listado_noticias($limit, $start, $data = NULL) {
        //Where
        $where = array('t1.estado != ' => 0);
        if ($data['noticia_categoria_id'] != "all") {
            $where['t1.noticia_categoria_id'] = $data['noticia_categoria_id'];
        }

        if ($start > 0) {
            $start = ($start - 1) * $limit;
        }

        $resultado = $this->db->select("t1.*, t2.nombre as categoria_nombre")
                ->join("noticia_categoria as t2", "t2.id=t1.noticia_categoria_id")
                ->where($where)
                ->order_by("t1.agregar", "Desc")
                ->limit($limit, $start)
                ->get("noticia as t1")
                ->result_array();
        return $resultado;
    }

    /**
     * Noticias destacadas
     *
     * Noticias destacadas
     *
     * @package		Noticias
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		22-05-2014
     * @version		Version 1.0
     */
    function get_noticias_destacadas($limit = 4) {
        $result = $this->db->select("t1.*,t2.nombre as categoria_nombre")
                ->join("noticia_categoria as t2", "t2.id=t1.noticia_categoria_id")
                ->where("t1.destacada", 1)
                ->where("t1.estado !=", 0)
                ->order_by("t1.id", "Desc")
                ->limit($limit)
                ->get("noticia as t1")
                ->result_array();
        return $result;
    }

    /**
     * Consultar servicio
     *
     * Trae la información de un servicio
     *
     * @package		Servicios
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com 
     * @since		18-05-2014
     * @version		Version 1.0
     */
    function get_noticia($id) {
        $result = $this->db->select("t1.*,t2.nombre as categoria_nombre")
                ->join("noticia_categoria as t2", "t2.id=t1.noticia_categoria_id")
                ->where("t1.id =", $id)
                ->where("t1.estado !=", 0)
                ->get("noticia as t1")
                ->row_array();

        return $result;
    }

    /**
     * Banner
     *
     * Trae información de los banners
     *
     * @package     Inicio
     * @author      Juan Julio Sandoval Layza
     * @copyright   Webapu.com
     * @since       29-02-2016
     * @version     Version 1.0
     */
    function get_banner($id=null) {
        $result[1] = array(
            "nombre" => "Banner",
            "image" => "banner.png",
            "url" => "http://epropesco.com/",
            "target" => "_parent"
        );

        $result[2] = array(
            "nombre" => "Banner Side",
            "image" => base_url() . "images/Proteccion-visual-epropesco-200X380.jpg",
            "url" => "http://www.epropesco.com/c/20-proteccion-visual",
            "target" => "_parent"
        );


        return $result[$id];
    }

}
