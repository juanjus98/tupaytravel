<?php

class Inicio_model extends CI_Model {

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
    function get_website() {
        $result = $this->db->select("t1.*")
                ->where("t1.id =", 1)
                ->where("t1.estado !=", 0)
                ->get("website as t1")
                ->row_array();
        return $result;
    }
    
    /**
     * Slider principal
     *
     * Trae la información del slider principal
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       Webapu.com
     * @since		09-06-2015
     * @version		Version 1.0
     */
    function get_slider($limit = 3) {
        $result = $this->db->select("t1.*")
                ->where("t1.estado !=", 0)
                ->limit($limit)
                ->order_by("t1.orden", "Asc")
                ->get("slider as t1")
                ->result_array();
        return $result;
    }
    
    /**
     * Carousel de productos destacados
     *
     * Trae la productos destacados
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       Webapu.com
     * @since		29-02-2016
     * @version		Version 1.0
     */
    function get_productos_destacados($limit = 12) {
        $result = $this->db->select("t1.*")
                ->where("t1.estado !=", 0)
                ->limit($limit)
                ->order_by("t1.id", "asc")
                ->get("producto as t1")
                ->result_array();
        return $result;
    }

}
