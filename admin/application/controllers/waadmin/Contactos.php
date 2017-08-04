<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contactos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('waadmin');
        $this->auth->logged_in();
        $this->load->library("imaupload");

        $this->load->model('waadmin/contactos_model', 'Contactos');
        $this->template->set_layout('waadmin/intranet.php');
    }

    /**
     * Listar Contactos
     *
     * Muestra el listado de Contactos.
     *
     * @package		Contactos
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function index() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        $data['paises'] = listado_paises();

        //Paginacion
        $base_url = base_url() . "waadmin/contactos/index";
        $per_page = 20; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Contactos->set_post($this->input->post());
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Contactos->total_registros($post);

        //Listado
        $data['listado'] = $this->Contactos->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];
        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();

        $this->template->title('Contactos');
        $this->template->build('waadmin/contactos/index', $data);
    }

    /**
     * Agregar cliente
     *
     * Agregar cliente
     *
     * @package		Contactos
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function agregar() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        $data['categorias_servicios'] = $this->Contactos->get_categorias_servicios();
        if ($this->input->post()) {
            $post = $this->input->post();
            $config = array(
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Nombre corto',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'fecha_entrega',
                    'label' => 'Fecha entrega',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion',
                    'label' => 'Descripción',
                    'rules' => 'required'
                )
            );

            if (empty($post['servicios'])) {
                $config[] = array(
                    'field' => 'servicios',
                    'label' => 'Servicios',
                    'rules' => 'required'
                );
            }

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '* Campo obligatorio.');
            $this->form_validation->set_error_delimiters('<div class="col-sm-4 msj-error">', '</div>');

            if ($this->form_validation->run() == FALSE) {
                $post = $this->input->post();
                $data['post'] = $post;
            } else {
                $post = $this->input->post();

                $data_insert = array(
                    "fecha_entrega" => $post['fecha_entrega'],
                    "nombre_corto" => $post['nombre_corto'],
                    "descripcion" => $post['descripcion'],
                    "url" => $post['url']
                );

                //cargar imágenes
                $imagen1_info = $this->imaupload->do_upload("/images/upload/", "imagen_1");

                if (!empty($imagen1_info['upload_data'])) {
                    $data_insert['imagen_1'] = $imagen1_info['upload_data']['file_name'];
                }

                $this->db->insert('cliente', $data_insert);
                $cliente_id = $this->db->insert_id();

                //Insertar servicios
                if (!empty($post['servicios'])) {
                    foreach ($post['servicios'] as $servicio) {
                        $data_insert_servicio = array(
                            "cliente_id" => $cliente_id,
                            "servicio_categoria_id" => $servicio
                        );
                        $this->db->insert('cliente_servicio_categoria', $data_insert_servicio);
                    }
                }

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/contactos/index");
            }
        }
        $this->template->title('Agregar servicio');
        $this->template->build('waadmin/contactos/agregar', $data);
    }

    /**
     * Editar servicio
     *
     * Editar servicio
     *
     * @package		Contactos
     * @author		Juan Julio Sandoval Layza
     * @copyright   webApu.com
     * @since		20-05-2015
     * @version		Version 1.0
     */
    public function editar($id) {
        $data['user_info'] = $this->session->userdata('s_user_info');
        $data['post'] = $this->Contactos->get_row($id);
        $data['paises'] = listado_paises();
        if ($this->input->post()) {
            $post = $this->input->post();
            $config = array(
                array(
                    'field' => 'nombres',
                    'label' => 'Nombres',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'email',
                    'label' => 'E-mail',
                    'rules' => 'required'
                )
            );

            $this->form_validation->set_rules($config);
            $this->form_validation->set_message('required', '* Campo obligatorio.');
            $this->form_validation->set_error_delimiters('<div class="col-sm-4 msj-error">', '</div>');

            if ($this->form_validation->run() == FALSE) {
                $post = $this->input->post();
                $data['post'] = $post;
            } else {
                $post = $this->input->post();
                $data_update = array(
                    "nombres" => $post['nombres'],
                    "telefono" => $post['telefono'],
                    "email" => $post['email'],
                    "pais" => $post['pais'],
                    "asunto" => $post['asunto'],
                    "mensaje" => $post['mensaje']
                );

                $this->db->where('id', $post['id']);
                $this->db->update('contactos', $data_update);


                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/contactos/index");
            }
        }

        $this->template->title('Editar contácto');
        $this->template->build('waadmin/contactos/editar', $data);
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
                    $this->db->update('contactos', $data_eliminar);
                }
                $this->session->set_userdata('msj_success', "Registros eliminados satisfactoriamente.");
                redirect("waadmin/contactos/index");
            } else {
                $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
                redirect("waadmin/contactos/index");
            }
        } else {
            $this->session->set_userdata('msj_error', "Debe seleccionar al menos un registro.");
            redirect("waadmin/contactos/index");
        }

        $this->template->title('Listado de dispositivos.');
        $this->template->build('inicio');
    }

}

/* End of file Contactos.php */
/* Location: ./application/controllers/waadmin/categorias.php */