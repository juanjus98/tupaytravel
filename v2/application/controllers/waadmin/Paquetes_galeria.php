<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paquetes_galeria extends CI_Controller{

 public $user_info;
 public $paquete_id;

 function __construct(){
   parent::__construct();
   $this->template->set_layout('waadmin/popup.php');

 /**
 * Verficamos si existe una session activa
 */
 $this->auth->logged_in();
 
 //Información del usuario que ha iniciado session
 $this->user_info = $this->auth->user_profile();

 $this->load->model("crud_model","Crud");
 $this->load->model("paquetes_galeria_model","Paquetes_galeria");

 $this->load->library("imaupload");

}

function index($id){
 $this->paquete_id = $id;
 //Consultar paquete
 $data_crud['table'] = "tblpaquete as t1";
 $data_crud['columns'] = "t1.id, t1.nombre";
 $data_crud['where'] = array("t1.id" => $this->paquete_id, "t1.estado !=" => 0);
 $data['paquete'] = $this->Crud->getRow($data_crud);

 $data['wa_modulo'] = $data['paquete']['nombre'];
 $data['wa_menu'] = 'Intinerario';

 $sessionName = 's_paquetes_galeria'; //Session name

 //Paginacion
 $base_url = base_url() . "waadmin/paquetes_galeria/index/" . $this->paquete_id;
 $per_page = 10; //registros por página
 $uri_segment = 5; //segmento de la url
 $num_links = 4; //número de links

 //Página actual
 $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
 

 if (isset($_GET['refresh'])) {
   $this->session->unset_userdata($sessionName);
   redirect("waadmin/paquetes_galeria/index/" . $this->paquete_id);
 }

 //Setear post
 $post = $this->Crud->set_post($this->input->post(),$sessionName);
 $post['id_tblpaquete'] = $id;
 $data['post'] = $post;

 //Total de registros por post
 $data['total_registros'] = $this->Paquetes_galeria->total_registros($post);

 //Listado
 $data['listado'] = $this->Paquetes_galeria->listado($per_page, $page, $post);

 //Paginacion
 $total_rows = $data['total_registros'];
 $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

 $this->pagination->initialize($set_paginacion);
 $data["links"] = $this->pagination->create_links();

 $this->template->title('Intinerario');
 $this->template->build('waadmin/paquetes_galeria/index', $data);
}


function editar($tipo='C',$id=null,$id_relation){
  $data['current_url'] = base_url(uri_string());
  $data['back_url'] = base_url('waadmin/paquetes_galeria/index/' .$id_relation);
  if(isset($id)){
    $data['edit_url'] = base_url('waadmin/paquetes_galeria/editar/E/' . $id . '/' . $id_relation);
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
 $data['wa_menu'] = 'Intinerario';

 if($tipo == 'E' || $tipo == 'V'){
   $data_crud['table'] = "tblpaquete_galeria as t1";
   $data_crud['columns'] = "t1.*";
   $data_crud['where'] = array("t1.id" => $id, "t1.estado !=" => 0);
   $data['post'] = $this->Crud->getRow($data_crud);
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
  if($_FILES["nombre_imagen"]){
    $imagen_info = $this->imaupload->do_upload("/assets/images/uploads", "nombre_imagen");
  }

  $data_form = array(
    'titulo' => $post['titulo'],
    'descripcion' => $post['descripcion'],
    'orden' => $post['orden']
    );

  if (!empty($imagen_info['upload_data'])) {
   $data_form['nombre_imagen'] = $imagen_info['upload_data']['file_name'];
  }

    //Agregar
 if($tipo == 'C'){
  $data_form['id_tblpaquete'] = $id_relation;
  $this->db->insert('tblpaquete_galeria', $data_form);
  $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
}

    //Editar
if ($tipo == 'E') {
  $this->db->where('id', $post['id']);
  $this->db->update('tblpaquete_galeria', $data_form);
  $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
}

redirect('/waadmin/paquetes_galeria/index/' . $id_relation);

}

}

$this->template->title('Editar.');
$this->template->build('waadmin/paquetes_galeria/editar', $data);
}

function eliminar($id){
  if ($this->input->post('items')) {
    $items = $this->input->post('items');
    if(!empty($items)){
      foreach ($items as $key => $value) {
        $fecha_eliminar = date("Y-m-d H:i:s");
        $data_form = array(
          'eliminar' => $fecha_eliminar,
          'estado' => 0
          );
        $this->db->where('id', $value);
        $this->db->update('tblpaquete_galeria', $data_form);
      }
    }

    $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");

  }else{
   $this->session->set_userdata('msj_error', "Debe sellecionar al menos un item para eliminar."); 
 }
 redirect('/waadmin/paquetes_galeria/index/' . $id);
}

}