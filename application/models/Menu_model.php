<?php
class Menu_model extends CI_Model {

  function __construct() {
   parent::__construct();
 }

/**
 * Menú Tours
 */
function menuTours($data=null) {
  $where = array('t1.estado != ' => 0);
  $result = $this->db->select('t2.id AS provincia_id, t2.provincia, t2.url_key, count(t1.id) as n_tours')
  ->join('tblprovincia as t2', 't2.id = t1.id_provincia')
  ->where($where)
  ->group_by('t1.id_provincia')
  ->order_by('n_tours DESC')
  ->get('tbltours as t1')
  ->result_array();
  return $result;
}

/**
 * Menú Estadía
 */
function menuEstadia($data=null) {
  $where = array('t1.estado != ' => 0);
  $result = $this->db->select('t2.id AS provincia_id, t2.provincia, t2.url_key, COUNT(t1.id_hotel) AS n_hoteles')
  ->join('tblprovincia as t2', 't2.id = t1.id_provincia')
  ->where($where)
  ->group_by('t1.id_provincia')
  ->order_by('n_hoteles DESC')
  ->get('tblhotel as t1')
  ->result_array();
  return $result;
}




}