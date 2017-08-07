<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Servicios extends CI_Controller {
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
 $this->load->model('servicios_model', 'Servicios');
 $this->load->library("imaupload");
}
 /**
 * Listar categorías.
 *
 * Muestra el listado de las categorías.
 *
 * @package servicios
 * @author Juan Julio Sandoval Layza
 * @copyright webApu.com 
 * @since 26-02-2015
 * @version Version 1.0
 */
 public function index() {
 //$data['wa_tipo'] = $tipo;
   $data['wa_modulo'] = 'Listado';
   $data['wa_menu'] = 'Servicios';
 $sessionName = 's_servicios'; //Session name
 //Paginacion
 $base_url = base_url() . "waadmin/servicios/index";
 $per_page = 10; //registros por página
 $uri_segment = 4; //segmento de la url
 $num_links = 4; //número de links
 //Página actual
 $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
 if (isset($_GET['refresh'])) {
   $this->session->unset_userdata($sessionName);
   redirect("waadmin/servicios/index");
 }
 //Setear post
 $post = $this->Crud->set_post($this->input->post(),$sessionName);
 $data['post'] = $post;
 //Total de registros por post
 $data['total_registros'] = $this->Servicios->total_registros($post);
 //Listado
 $data['listado'] = $this->Servicios->listado($per_page, $page, $post);
 //Paginacion
 $total_rows = $data['total_registros'];
 $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);
 $this->pagination->initialize($set_paginacion);
 $data["links"] = $this->pagination->create_links();
 $this->template->title('Servicios');
 $this->template->build('waadmin/servicios/index', $data);
}

function editar($tipo='C',$id=NULL){
 $data['current_url'] = base_url(uri_string());
 $data['back_url'] = base_url('waadmin/servicios/index');
 if(isset($id)){
   $data['edit_url'] = base_url('waadmin/servicios/editar/E/' . $id);
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
 $data['wa_menu'] = 'Servicio';
 if($tipo == 'E' || $tipo == 'V'){
   $data_row = array('id' => $id);
   $data['post'] = $this->Servicios->get_row($data_row);
 }
 if ($this->input->post()) {
   $post= $this->input->post();
   $data['post'] = $post; 
   $config = array(
     array(
       'field' => 'nombre_largo',
       'label' => 'Nombre largo',
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
     if($_FILES["imagen_1"]){
       $imagen_info1 = $this->imaupload->do_upload($upload_path, "imagen_1");
     }
     if($_FILES["imagen_2"]){
       $imagen_info2 = $this->imaupload->do_upload($upload_path, "imagen_2");
     }
     if($_FILES["imagen_3"]){
       $imagen_info3 = $this->imaupload->do_upload($upload_path, "imagen_3");
     }
     $data_form = array(
       "nombre_largo" => $post['nombre_largo'],
       "descripcion" => $post['descripcion'],
       "orden" => $post['orden'],
       "keywords" => $post['keywords']
       );
 //cargar imágenes
     if (!empty($imagen_info1['upload_data'])) {
       $data_form['imagen_1'] = $imagen_info1['upload_data']['file_name'];
     }
     if (!empty($imagen_info2['upload_data'])) {
       $data_form['imagen_2'] = $imagen_info2['upload_data']['file_name'];
     }
     if (!empty($imagen_info3['upload_data'])) {
       $data_form['imagen_3'] = $imagen_info3['upload_data']['file_name'];
     }
 //Agregar
     if($tipo == 'C'){
       $data_urlkey = array('tipo' => 'p', 'urlkey' => $post['nombre_largo']);
       $url_key = $this->Crud->get_urlkey($data_urlkey);
       $data_form['url_key'] = $url_key;
       $this->db->insert('servicio', $data_form);
       $servicio_id = $this->db->insert_id();
 //Actualizamos la tabla urlkey
       $data_urlkey_insert = array('tipo' => 'p', 'urlkey' => $url_key);
       $this->db->insert("urlkey",$data_urlkey_insert);
       $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
     }
 //Editar
     if ($tipo == 'E'){
       $this->db->where('id', $post['id']);
       $this->db->update('servicio', $data_form);
       $servicio_id = $post['id'];
       $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
     }
 //INSERTAMOS ESPECIFICACIONES
     $this->db->where('servicio_id', $servicio_id);
     $this->db->delete('servicio_detalle');
     if (!empty($post['detalles'])) {
       $detalles = $post['detalles'];
       foreach ($detalles['titulo'] as $index => $titulo) {
         $descripcion = $detalles['descripcion'][$index];
         $data_insert_detalles = array(
           "servicio_id" => $servicio_id,
           "nombre" => $titulo,
           "descripcion" => $descripcion
           );
         $this->db->insert('servicio_detalle', $data_insert_detalles);
       }
     }
     redirect('/waadmin/servicios/index');
   }
 }
 $this->template->title($data['tipo'] . ' Servicio');
 $this->template->build('waadmin/servicios/editar', $data);
}

}
