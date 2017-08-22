<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tours extends CI_Controller {

 function __construct() {
   parent::__construct();
   $this->template->set_layout('waadmin/intranet.php');
 /**
 * Verficamos si existe una session activa
 */
 $this->auth->logged_in();

 //Información del usuario que ha iniciado session
 $this->user_info = $this->auth->user_profile();

 $this->load->helper('waadmin');
 $this->load->model("crud_model","Crud");
 $this->load->model('tours_model', 'Tours');
 $this->load->model('provincias_model', 'Provincias');
 $this->load->model('paginas_model', 'Paginas');

 $this->load->library("imaupload");
}

 /**
 * Listar categorías.
 *
 * Muestra el listado de las categorías.
 *
 * @package     tours
 * @author      Juan Julio Sandoval Layza
 * @copyright webApu.com 
 * @since       26-02-2015
 * @version     Version 1.0
 */
 public function index() {
 //$data['wa_tipo'] = $tipo;
   $data['wa_modulo'] = 'Listado';
   $data['wa_menu'] = 'tours';

//Provincias   
$total_provincias = $this->Provincias->total_registros();
$data['provincias'] = $this->Provincias->listado($total_provincias, 0);

//Consultar categoria
$data_crud['table'] = "tbltours_categoria as t1";
$data_crud['columns'] = "t1.*";
$data_crud['where'] = array("t1.estado !=" => 0);
$data_crud['order_by'] = "t1.categoria ASC";
$data['categorias'] = $this->Crud->getRows($data_crud);

$sessionName = 's_tours'; //Session name

//Paginacion
$base_url = base_url() . "waadmin/tours/index";
$per_page = 30; //registros por página
$uri_segment = 4; //segmento de la url
$num_links = 4; //número de links

 //Página actual
 $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

 if (isset($_GET['refresh'])) {
   $this->session->unset_userdata($sessionName);
   redirect("waadmin/tours/index");
 }

 //Setear post
 $post = $this->Crud->set_post($this->input->post(),$sessionName);
 $data['post'] = $post;

 //Total de registros por post
 $data['total_registros'] = $this->Tours->total_registros($post);

 //Listado
 $data['listado'] = $this->Tours->listado($per_page, $page, $post);

 //Paginacion
 $total_rows = $data['total_registros'];
 $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

 $this->pagination->initialize($set_paginacion);
 $data["links"] = $this->pagination->create_links();

 $this->template->title('tours');
 $this->template->build('waadmin/tours/index', $data);
}

function editar($tipo='C',$id=NULL){
 $path = '../../../../assets/plugins/ckfinder';
 $width = 'auto';
 $ckEditor = $this->editor($path, $width);

 $data['current_url'] = base_url(uri_string());
 $data['back_url'] = base_url('waadmin/tours/index');
 if(isset($id)){
   $data['edit_url'] = base_url('waadmin/tours/editar/E/' . $id);
 }

 switch ($tipo) {
   case 'C':
   $data['tipo'] = 'Agregar';
   break;
   case 'E':
   $data['tipo'] = 'Editar';
   break;
   case 'V':
   $data['tipo'] = 'Visualizar';
   break;
 }

 $data['wa_tipo'] = $tipo;
 $data['wa_modulo'] = $data['tipo'];
 $data['wa_menu'] = 'Tour';

 if($tipo == 'E' || $tipo == 'V'){
  $data_row = array('id' => $id);
  $data['post'] = $this->Tours->get_row($data_row);
}

//Provincias   
$total_provincias = $this->Provincias->total_registros();
$data['provincias'] = $this->Provincias->listado($total_provincias, 0);

//Consultar categoria
$data_crud['table'] = "tbltours_categoria as t1";
$data_crud['columns'] = "t1.*";
$data_crud['where'] = array("t1.estado !=" => 0);
$data_crud['order_by'] = "t1.categoria ASC";
$data['categorias'] = $this->Crud->getRows($data_crud);

  /**
  * Paginas
  */
   $total_paginas = $this->Paginas->total_registros();
   $data['paginas'] = $this->Paginas->listado($total_paginas,0);
   

   if ($this->input->post()) {
     $post= $this->input->post();
     $data['post'] = $post;

     $config = array(
       array(
         'field' => 'nombre',
         'label' => 'Nombre',
         'rules' => 'required',
         'errors' => array(
           'required' => 'Campo requerido.',
           )
         ),
       array(
         'field' => 'id_tbltours_categoria',
         'label' => 'Categoría',
         'rules' => 'required',
         'errors' => array(
           'required' => 'Campo requerido.',
           )
         ),
       array(
         'field' => 'id_provincia',
         'label' => 'Provincia',
         'rules' => 'required',
         'errors' => array(
           'required' => 'Campo requerido.',
           )
         ),
       array(
         'field' => 'descripcion',
         'label' => 'Descripción',
         'rules' => 'required',
         'errors' => array(
           'required' => 'Campo requerido.',
           )
         ),
       array(
         'field' => 'orden',
         'label' => 'Orden',
         'rules' => 'required',
         'errors' => array(
           'required' => 'Campo requerido.',
           )
         ),
       array(
         'field' => 'detalle',
         'label' => 'Detalles',
         'rules' => 'required',
         'errors' => array(
           'required' => 'Campo requerido.',
           )
         ),
       array(
         'field' => 'formas_pago_id',
         'label' => 'Forma de pago',
         'rules' => 'required',
         'errors' => array(
           'required' => 'Campo requerido.',
           )
         )
       );

     $this->form_validation->set_rules($config);
     $this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

     if ($this->form_validation->run() == FALSE){
       /*Error*/
       $data['post'] = $this->input->post();
     }else{

          //Cargar Imagen
      $upload_path = $this->config->item('upload_path');
      if($_FILES["imagen"]){
       $imagen_info1 = $this->imaupload->do_upload($upload_path, "imagen");
     }

     $estadia = (isset($post['estadia'])) ? $post['estadia'] : 0 ;

     $data_form = array(
      "id_tbltours_categoria" => $post['id_tbltours_categoria'],
       "nombre" => $post['nombre'],
       "detalle" => $post['detalle'],
       "descripcion" => $post['descripcion'],
       "estadia" => $estadia,
       "precio" => $post['precio'],
       "orden" => $post['orden'],
       "keywords" => $post['keywords'],
       "id_provincia" => $post['id_provincia'],
       "formas_pago_id" => $post['formas_pago_id']
       );

          //cargar imágenes
     if (!empty($imagen_info1['upload_data'])) {
       $data_form['imagen'] = $imagen_info1['upload_data']['file_name'];
     }

     if(empty($post['url_key_pre'])){
       $data_urlkey = array('tipo' => 'p', 'urlkey' => $post['nombre']);
       $url_key = $this->Crud->get_urlkey($data_urlkey);
       $data_form['url_key'] = $url_key;

       //Actualizamos la tabla urlkey
       $data_urlkey_insert = array('tipo' => 'p', 'urlkey' => $url_key);
       $this->db->insert("urlkey",$data_urlkey_insert);
     }

    //Agregar
     if($tipo == 'C'){
       $this->db->insert('tbltours', $data_form);
       $Tour_id = $this->db->insert_id();
       $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
     }

          //Editar
     if ($tipo == 'E') {
       $this->db->where('id', $post['id']);
       $this->db->update('tbltours', $data_form);
       $Tour_id = $post['id'];
       $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
     }

     redirect('/waadmin/tours/index');
   }

 }

 $this->template->title($data['tipo'] . ' Tour');
 $this->template->build('waadmin/tours/editar', $data);
}

 /**
 * Eliminar
 *
 * Eliminar categorias
 *
 * @package     Dispositivo
 * @author      Juan Julio Sandoval Layza
 * @copyright webApu.com 
 * @since       26-02-2015
 * @version     Version 1.0
 */
 public function eliminar() {
   if ($this->input->post()) {
     $items = $this->input->post('items');
     if (!empty($items)) {
       foreach ($items as $item) {
         $eliminar = date("Y-m-d H:i:s");
         $data_eliminar = array(
           "eliminar" => $eliminar,
           "estado" => 0
           );
         $this->db->where('id', $item);
         $this->db->update('tbltours', $data_eliminar);
       }
       $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
       redirect("waadmin/tours/index");
     } else {
       $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
       redirect("waadmin/tours/index");
     }
   } else {
     $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
     redirect("waadmin/tours/index");
   }

   $this->template->title('Listado');
   $this->template->build('inicio');
 }


function editor($path, $width) {

 //Loading Library For Ckeditor

 $this->load->library('ckeditor');

 $this->load->library('ckfinder');

 //configure base path of ckeditor folder 

 $this->ckeditor->basePath = base_url('assets/plugins/ckeditor/');

 $this->ckeditor->config['toolbar'] = 'Full';

 $this->ckeditor->config['language'] = 'es';

 $this->ckeditor->config['width'] = $width;

 //configure ckfinder with ckeditor config 

 $this->ckfinder->SetupCKEditor($this->ckeditor, $path);
}

}

/* End of file categorias.php */
 /* Location: ./application/controllers/waadmin/categorias.php */