<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Promociones extends CI_Controller {

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
 $this->load->model('promociones_model', 'Promociones');
 $this->load->model('provincias_model', 'Provincias');
 $this->load->model('paginas_model', 'Paginas');

 $this->load->library("imaupload");
}

 /**
 * Listar categorías.
 *
 * Muestra el listado de las categorías.
 *
 * @package     Promociones
 * @author      Juan Julio Sandoval Layza
 * @copyright webApu.com 
 * @since       26-02-2015
 * @version     Version 1.0
 */
 public function index() {
 //$data['wa_tipo'] = $tipo;
   $data['wa_modulo'] = 'Listado';
   $data['wa_menu'] = 'Promociones';

$sessionName = 's_Promociones'; //Session name

//Paginacion
$base_url = base_url() . "waadmin/promociones/index";
$per_page = 30; //registros por página
$uri_segment = 4; //segmento de la url
$num_links = 4; //número de links

 //Página actual
 $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

 if (isset($_GET['refresh'])) {
   $this->session->unset_userdata($sessionName);
   redirect("waadmin/promociones/index");
 }

 //Setear post
 $post = $this->Crud->set_post($this->input->post(),$sessionName);
 $data['post'] = $post;

 //Total de registros por post
 $data['total_registros'] = $this->Promociones->total_registros($post);

 //Listado
 $data['listado'] = $this->Promociones->listado($per_page, $page, $post);

 //Paginacion
 $total_rows = $data['total_registros'];
 $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

 $this->pagination->initialize($set_paginacion);
 $data["links"] = $this->pagination->create_links();

 $this->template->title('Promociones');
 $this->template->build('waadmin/promociones/index', $data);
}

function editar($tipo='C',$id=NULL){
 $data['current_url'] = base_url(uri_string());
 $data['back_url'] = base_url('waadmin/promociones/index');
 if(isset($id)){
   $data['edit_url'] = base_url('waadmin/promociones/editar/E/' . $id);
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
 $data['wa_menu'] = 'Promoción';

 if($tipo == 'E' || $tipo == 'V'){
  $data_row = array('id' => $id);
  $data['post'] = $this->Promociones->get_row($data_row);
}  

   if ($this->input->post()) {
     $post= $this->input->post();
     $data['post'] = $post;

     $config = array(
       array(
         'field' => 'titulo',
         'label' => 'Título',
         'rules' => 'required',
         'errors' => array(
           'required' => 'Campo requerido.',
           )
         ),
       array(
         'field' => 'url',
         'label' => 'Url',
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

     /*$estadia = (isset($post['estadia'])) ? $post['estadia'] : 0 ;*/

     //Cargar Imagen
      $upload_path = $this->config->item('upload_path');
      if($_FILES["imagen"]){
       $imagen_info1 = $this->imaupload->do_upload($upload_path, "imagen");
     }

     $data_form = array(
       "titulo" => $post['titulo'],
       "url" => $post['url'],
       "target" => $post['target'],
       "orden" => $post['orden']
       );

     //cargar imágenes
     if (!empty($imagen_info1['upload_data'])) {
       $data_form['imagen'] = $imagen_info1['upload_data']['file_name'];
     }

    //Agregar
     if($tipo == 'C'){
       $this->db->insert('tblpromociones', $data_form);
       /*$hotel_id = $this->db->insert_id();*/
       $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
     }


          //Editar
     if ($tipo == 'E') {
       $this->db->where('id', $post['id']);
       $this->db->update('tblpromociones', $data_form);
       /*echo $this->db->affected_rows();*/
       /*$hotel_id = $post['id_hotel'];*/
       $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
     }

     redirect('/waadmin/promociones/index');
   }

 }

 $this->template->title($data['tipo'] . ' Promoción');
 $this->template->build('waadmin/promociones/editar', $data);
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
         $this->db->update('tblpromociones', $data_eliminar);
       }
       $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
       redirect("waadmin/promociones/index");
     } else {
       $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
       redirect("waadmin/promociones/index");
     }
   } else {
     $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
     redirect("waadmin/promociones/index");
   }

   $this->template->title('Listado');
   $this->template->build('inicio');
 }

 /**
 * Ajax actualizar orden
 */
public function uporden(){
  if($this->input->post()){
    $post = $this->input->post();
    $data_form = array('orden' => $post['orden']);
    $this->db->where('id', $post['id']);
    $this->db->update('tblpromociones', $data_form);
    echo "Orden actualizado.";
  }
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