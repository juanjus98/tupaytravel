<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {

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
 $this->load->model('productos_model', 'Productos');

 $this->load->library("imaupload");
}

 /**
 * Listar categorías.
 *
 * Muestra el listado de las categorías.
 *
 * @package     Productos
 * @author      Juan Julio Sandoval Layza
 * @copyright webApu.com 
 * @since       26-02-2015
 * @version     Version 1.0
 */
 public function index() {
 //$data['wa_tipo'] = $tipo;
   $data['wa_modulo'] = 'Listado';
   $data['wa_menu'] = 'Salones';

 $sessionName = 's_productos'; //Session name

 //Paginacion
 $base_url = base_url() . "waadmin/productos/index";
 $per_page = 10; //registros por página
 $uri_segment = 4; //segmento de la url
 $num_links = 4; //número de links

 //Página actual
 $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

 if (isset($_GET['refresh'])) {
   $this->session->unset_userdata($sessionName);
   redirect("waadmin/productos/index");
}

 //Setear post
$post = $this->Crud->set_post($this->input->post(),$sessionName);
$data['post'] = $post;

 //Total de registros por post
$data['total_registros'] = $this->Productos->total_registros($post);

 //Listado
$data['listado'] = $this->Productos->listado($per_page, $page, $post);

 //Paginacion
$total_rows = $data['total_registros'];
$set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

$this->pagination->initialize($set_paginacion);
$data["links"] = $this->pagination->create_links();

$this->template->title('Salones');
$this->template->build('waadmin/productos/index', $data);
}

function editar($tipo='C',$id=NULL){
   $data['current_url'] = base_url(uri_string());
   $data['back_url'] = base_url('waadmin/productos/index');
   if(isset($id)){
       $data['edit_url'] = base_url('waadmin/productos/editar/E/' . $id);
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
   $data['wa_menu'] = 'Salon';


   if($tipo == 'E' || $tipo == 'V'){
      $data_row = array('id' => $id);
      $data['post'] = $this->Productos->get_row($data_row);
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

               $this->db->insert('producto', $data_form);
               $producto_id = $this->db->insert_id();

               //Actualizamos la tabla urlkey
               $data_urlkey_insert = array('tipo' => 'p', 'urlkey' => $url_key);
               $this->db->insert("urlkey",$data_urlkey_insert);

               $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
           }

          //Editar
           if ($tipo == 'E') {
               $this->db->where('id', $post['id']);
               $this->db->update('producto', $data_form);
               $producto_id = $post['id'];
               $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
           }

          //INSERTAMOS ESPECIFICACIONES
           $this->db->where('producto_id', $producto_id);
           $this->db->delete('producto_especificaciones');
           if (!empty($post['especificaciones'])) {
               $especificaciones = $post['especificaciones'];
               foreach ($especificaciones['titulo'] as $index => $titulo) {
                   $descripcion = $especificaciones['descripcion'][$index];
                   $data_insert_especificacion = array(
                       "producto_id" => $producto_id,
                       "nombre" => $titulo,
                       "descripcion" => $descripcion
                       );
                   $this->db->insert('producto_especificaciones', $data_insert_especificacion);
               }
           }
           redirect('/waadmin/productos/index');
       }

   }

   $this->template->title($data['tipo'] . ' Producto');
   $this->template->build('waadmin/productos/editar', $data);
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
               $this->db->update('producto', $data_eliminar);
           }
           $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
           redirect("waadmin/productos/index");
       } else {
           $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
           redirect("waadmin/productos/index");
       }
   } else {
       $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
       redirect("waadmin/productos/index");
   }

   $this->template->title('Listado de dispositivos.');
   $this->template->build('inicio');
}

/**
 * Crear código
 * Crea un nuevo código para un producto.
 *
 * @category  Productos
 * @package   crearCodigo
 * @license   http://www.webapu.com
 * @copyright webApu.com
 * @author Juan Julio Sandoval <juanjus98@gmail.com>
 * @since     2017-03-30
 * @version   0.1
 * @param     array $data ejem: array('categoria_id',)
 */
function crearCodigo($categoria_id){
  //Consultar categoria
  $data_crud['table'] = "categoria as t1";
  $data_crud['columns'] = "t1.*";
  $data_crud['where'] = array("t1.id" => $categoria_id, "t1.estado !=" => 0);
  $categoria = $this->Crud->getRow($data_crud);

  //Crear prefijo
  $arr_nombre = explode(' ', $categoria['nombre']);
  if(count($arr_nombre) > 0){
    $ii=0;
    $str="";
    foreach ($arr_nombre as $key => $value) {
      $ii++;
      if($ii <= 3){
        $str .= substr($value, 0, 1);
      }
    }
    $prefijo = $str;
  }else{
    $prefijo = substr($categoria['nombre'], 0, 3);
  }

  //Consultar producto
  $this->db->select_max('id', 'producto_id');
  $producto_id = $this->db->get('producto')->row_array();

  //Nuevo código
  $codigo = strtoupper($prefijo) . "-" . ($producto_id['producto_id']+1);

  return $codigo;
}

}

/* End of file categorias.php */
 /* Location: ./application/controllers/waadmin/categorias.php */