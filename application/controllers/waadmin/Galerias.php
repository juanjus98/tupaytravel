<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galerias extends CI_Controller {
    private $ctr_name;
    private $base_ctr; //Url base del controlodor
    private $primary_table = "galeria"; //Tabla principal
    public $base_title = "Galerias";

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
        $this->load->model('galerias_model', 'Galerias');

        $this->ctr_name = $this->router->fetch_class();
        //Base del controlador
        $this->base_ctr = $this->config->item('admin_path') . '/' . $this->ctr_name;

        $this->load->library("imaupload");

    }

    /**
     * Listar categorías.
     *
     * Muestra el listado de las categorías.
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		26-02-2015
     * @version		Version 1.0
     */
    function index(){
        /*$data['wa_tipo'] = $tipo;*/
        $data['wa_modulo'] = 'Listado';
        $data['wa_menu'] = $this->base_title;

        //URLS
        $controlador = $this->base_ctr;
        $data['agregar_url'] = base_url($controlador . '/editar/C');
        $data['ver_url'] = base_url($controlador . '/editar/V/'); //Adicionar ID
        $data['editar_url'] = base_url($controlador . '/editar/E/'); //Adicionar ID
        $data['eliminar_url'] = base_url($controlador . '/eliminar');
        $data['refresh_url'] = base_url($controlador . '/index?refresh');

        $data['order_url'] = base_url($controlador . '/uporden');

        //BUSQUEDA
        $data['campos_busqueda'] = array(
            't1.nombre' => 'Nombre'
            );

        $sessionName = 's_' . $this->primary_table; //Session name

        //Paginacion
        $base_url = base_url($this->base_ctr . '/index');
        $per_page = 30; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

        if (isset($_GET['refresh'])) {
            $this->session->unset_userdata($sessionName);
        }

        //Setear post
        $post = $this->Crud->set_post($this->input->post(),$sessionName);
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Galerias->total_registros($post);

        //Listado
        $data['listado'] = $this->Galerias->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];

        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();


        if ($this->session->userdata("mensaje")) {
            $data["mensaje"] = $this->session->userdata("mensaje");
            $this->session->unset_userdata("mensaje");
        }

        $this->template->title('Listado ' . $this->base_title);
        $this->template->build($this->base_ctr . '/index', $data);
    }


    function editar($tipo='C',$id=NULL){
        $data['current_url'] = base_url(uri_string());
        $data['back_url'] = base_url('waadmin/galerias/index');
        if(isset($id)){
            $data['edit_url'] = base_url('waadmin/galerias/editar/E/' . $id);
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
        $data['wa_menu'] = 'Galerias';

        if($tipo == 'E' || $tipo == 'V'){
           $data_crud['table'] = "galeria as t1";
           $data_crud['columns'] = "t1.*";
           $data_crud['where'] = array("t1.id" => $id, "t1.estado !=" => 0);
           $data['post'] = $this->Crud->getRow($data_crud);
       }


       if ($this->input->post()) {
        $post= $this->input->post();
        $data['post'] = $post;  

        $config = array(
           array(
               'field' => 'nombre',
               'label' => 'Galería',
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
        /*if($_FILES["imagen"]){
            $imagen_info = $this->imaupload->do_upload("/images/uploads", "imagen");
        }*/

        $destacar = (isset($post['destacar'])) ? $post['destacar'] : 0 ;

        $data_form = array(
            "nombre" => $post['nombre'],
            "descripcion" => $post['descripcion'],
            "orden" => $post['orden']
            );

        /*if (!empty($imagen_info['upload_data'])) {
            $data_form['imagen'] = $imagen_info['upload_data']['file_name'];
        }*/

    //Agregar
        if($tipo == 'C'){
            $data_urlkey = array('tipo' => 'g', 'urlkey' => $post['nombre']);
            $url_key = $this->Crud->get_urlkey($data_urlkey);
            /*$url_key = url_title(convert_accented_characters($post['nombre']),'-', TRUE);*/
            $data_form['url_key'] = $url_key;

            //Actualizamos la tabla urlkey
            $data_urlkey_insert = array('tipo' => 'g', 'urlkey' => $url_key);
            $this->Crud->insertRow("urlkey",$data_urlkey_insert);

            $this->db->insert('galeria', $data_form);
            $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
        }

    //Editar
        if ($tipo == 'E') {
            $this->db->where('id', $post['id']);
            $this->db->update('galeria', $data_form);
            $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
        }

        redirect('/waadmin/galerias/index');

    }

}

$this->template->title('Editar.');
$this->template->build('waadmin/galerias/editar', $data);
}

    /**
     * Eliminar
     *
     * Eliminar Galerias
     *
     * @package		Dispositivo
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		26-02-2015
     * @version		Version 1.0
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
                    $this->db->update('galeria', $data_eliminar);
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/galerias/index");
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/galerias/index");
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/galerias/index");
        }

        $this->template->title('Listado de dispositivos.');
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
    $this->db->update($this->primary_table, $data_form);
    echo "Orden actualizado.";
  }
}

}

/* End of file Galerias.php */
/* Location: ./application/controllers/waadmin/Galerias.php */