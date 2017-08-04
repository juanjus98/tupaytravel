<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias extends CI_Controller {

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
        $this->load->model('categorias_model', 'Categorias');

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
    public function index() {
        //$data['wa_tipo'] = $tipo;
        $data['wa_modulo'] = 'Productos';
        $data['wa_menu'] = 'Categorias';

        $sessionName = 's_categorias'; //Session name

        //Paginacion
        $base_url = base_url() . "waadmin/categorias/index";
        $per_page = 30; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links

        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        
        /*if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }*/

        if (isset($_GET['refresh'])) {
            $this->session->unset_userdata($sessionName);
            redirect("waadmin/categorias/index");
        }

        //Setear post
        $post = $this->Crud->set_post($this->input->post(),$sessionName);
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Categorias->total_registros($post);

        //Listado
        $data['listado'] = $this->Categorias->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Categorías');
        $this->template->build('waadmin/categorias/index', $data);
    }


    function editar($tipo='C',$id=NULL){
        $data['current_url'] = base_url(uri_string());
        $data['back_url'] = base_url('waadmin/categorias/index');
        if(isset($id)){
            $data['edit_url'] = base_url('waadmin/categorias/editar/E/' . $id);
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
        $data['wa_menu'] = 'Categorías';

        if($tipo == 'E' || $tipo == 'V'){
           $data_crud['table'] = "categoria as t1";
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
               'label' => 'Categoría',
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
        if($_FILES["imagen"]){
            $imagen_info = $this->imaupload->do_upload("/images/uploads", "imagen");
        }

        $destacar = (isset($post['destacar'])) ? $post['destacar'] : 0 ;

        $data_form = array(
            "parent_id" => $post['parent_id'],
            "nombre" => $post['nombre'],
            "descripcion" => $post['descripcion'],
            "destacar" => $destacar,
            "orden" => $post['orden']
            );

        if (!empty($imagen_info['upload_data'])) {
            $data_form['imagen'] = $imagen_info['upload_data']['file_name'];
        }

    //Agregar
        if($tipo == 'C'){
            $data_urlkey = array('tipo' => 'c', 'urlkey' => $post['nombre']);
            $url_key = $this->Crud->get_urlkey($data_urlkey);
            /*$url_key = url_title(convert_accented_characters($post['nombre']),'-', TRUE);*/
            $data_form['url_key'] = $url_key;

            //Actualizamos la tabla urlkey
            $data_urlkey_insert = array('tipo' => 'c', 'urlkey' => $url_key);
            $this->Crud->insertRow("urlkey",$data_urlkey_insert);

            $this->db->insert('categoria', $data_form);
            $this->session->set_userdata('msj_success', "Registro agregado satisfactoriamente.");
        }

    //Editar
        if ($tipo == 'E') {
            $this->db->where('id', $post['id']);
            $this->db->update('categoria', $data_form);
            $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
        }

        redirect('/waadmin/categorias/index');

    }

}

$this->template->title('Editar.');
$this->template->build('waadmin/categorias/editar', $data);
}

    /**
     * Eliminar
     *
     * Eliminar categorias
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
                    $this->db->update('categoria', $data_eliminar);
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/categorias/index");
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/categorias/index");
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/categorias/index");
        }

        $this->template->title('Listado de dispositivos.');
        $this->template->build('inicio');
    }

}

/* End of file categorias.php */
/* Location: ./application/controllers/waadmin/categorias.php */