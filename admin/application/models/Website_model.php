<?php
class Website_model extends CI_Model {

    function __construct() {
        parent::__construct();
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
    

}