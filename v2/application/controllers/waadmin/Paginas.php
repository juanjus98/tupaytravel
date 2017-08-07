<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paginas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('waadmin');
        $this->auth->logged_in();
        $this->load->library("imaupload");
        $this->load->model('paginas_model', 'Paginas');
        $this->template->set_layout('waadmin/intranet.php');
    }

    /**
     * Listar categorías.
     *
     * Muestra el listado de las categorías.
     *
     * @package		Categorías
     * @author		Juan Julio Sandoval Layza
     * @copyright       Winner System 
     * @since		26-02-2015
     * @version		Version 1.0
     */
    public function index() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Paginacion
        $base_url = base_url() . "waadmin/categorias/index";
        $per_page = 5; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;
        if ($page == 0) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Categorias->set_post($this->input->post());
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

    /**
     * Home
     *
     * Página de inicio del website
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       Winner System 
     * @since		07-05-2015
     * @version		Version 1.0
     */
    public function home() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Traer información de una página
        $data['post'] = $this->Paginas->get_pagina(1);

        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Título',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'resumen',
                    'label' => 'Resumen',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion1',
                    'label' => 'Descripción',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'url_video',
                    'label' => 'Url video',
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
                    "nombre_corto" => $post['nombre_corto'],
                    "resumen" => $post['resumen'],
                    "descripcion1" => $post['descripcion1'],
                    "url_video" => $post['url_video']
                );
                $this->db->where('id', $post['id']);
                $this->db->update('pagina', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/paginas/home");
            }
        }

        $this->template->title('Página Home');
        $this->template->build('waadmin/paginas/home', $data);
    }

    /**
     * Nosotros
     *
     * Página nosotros
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       Winner System 
     * @since		07-05-2015
     * @version		Version 1.0
     */
    public function nosotros() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Traer información de una página
        $data['post'] = $this->Paginas->get_pagina(2);

        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Título',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion1',
                    'label' => 'Descripción',
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
                    "nombre_corto" => $post['nombre_corto'],
                    "resumen" => $post['resumen'],
                    "descripcion1" => $post['descripcion1'],
                    "url_video" => $post['url_video']
                );

                //cargar imágenes
                $imagen_info = $this->imaupload->do_upload("/images/upload/", "imagen_1");
                if (!empty($imagen_info['upload_data'])) {
                    $data_update['imagen_1'] = $imagen_info['upload_data']['file_name'];
                }

                $this->db->where('id', $post['id']);
                $this->db->update('pagina', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/paginas/nosotros");
            }
        }

        $this->template->title('Página Home');
        $this->template->build('waadmin/paginas/nosotros', $data);
    }

    /**
     * Clientes
     *
     * Página clientes
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       Winner System 
     * @since		07-05-2015
     * @version		Version 1.0
     */
    public function clientes() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Traer información de una página
        $data['post'] = $this->Paginas->get_pagina(3);

        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Título',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'resumen',
                    'label' => 'Resumen',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion1',
                    'label' => 'Descripción',
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
                    "nombre_corto" => $post['nombre_corto'],
                    "resumen" => $post['resumen'],
                    "descripcion1" => $post['descripcion1']
                );
                $this->db->where('id', $post['id']);
                $this->db->update('pagina', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/paginas/clientes");
            }
        }

        $this->template->title('Página Home');
        $this->template->build('waadmin/paginas/clientes', $data);
    }

    /**
     * Servicios
     *
     * Página Servicios
     *
     * @package     Paginas
     * @author      Juan Julio Sandoval Layza
     * @copyright       Winner System 
     * @since       07-05-2015
     * @version     Version 1.0
     */
    public function servicios() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Traer información de una página
        $data['post'] = $this->Paginas->get_pagina(4);

        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Título',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'resumen',
                    'label' => 'Resumen',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion1',
                    'label' => 'Descripción',
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
                    "nombre_corto" => $post['nombre_corto'],
                    "resumen" => $post['resumen'],
                    "descripcion1" => $post['descripcion1']
                );
                $this->db->where('id', $post['id']);
                $this->db->update('pagina', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/paginas/servicios");
            }
        }

        $this->template->title('Página Home');
        $this->template->build('waadmin/paginas/clientes', $data);
    }

    /**
     * Soporte
     *
     * Página soporte
     *
     * @package     Paginas
     * @author      Juan Julio Sandoval Layza
     * @since       20-07-2015
     * @version     Version 1.0
     */
    public function soporte() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Traer información de una página
        $data['post'] = $this->Paginas->get_pagina(5);

        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Título',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion1',
                    'label' => 'Descripción',
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
                    "nombre_corto" => $post['nombre_corto'],
                    "resumen" => $post['resumen'], //Descargar Skype
                    "descripcion1" => $post['descripcion1'],
                    "imagen_2" => $post['imagen_2'],
                    "imagen_3" => $post['imagen_3']
                );
                $this->db->where('id', $post['id']);
                $this->db->update('pagina', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/paginas/soporte");
            }
        }

        $this->template->title('Página Soporte');
        $this->template->build('waadmin/paginas/soporte', $data);
    }

    /**
     * Descargas
     *
     * Página Descargas
     *
     * @package     Paginas
     * @author      Juan Julio Sandoval Layza
     * @since       20-07-2015
     * @version     Version 1.0
     */
    public function descargas() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Traer información de una página
        $data['post'] = $this->Paginas->get_pagina(6);

        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Título',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion1',
                    'label' => 'Descripción',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'resumen',
                    'label' => 'Resumen',
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
                    "nombre_corto" => $post['nombre_corto'],
                    "resumen" => $post['resumen'], //Descargar Skype
                    "descripcion1" => $post['descripcion1'],
                    "url_video" => $post['url_video']
                );
                $this->db->where('id', $post['id']);
                $this->db->update('pagina', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/paginas/descargas");
            }
        }

        $this->template->title('Página Descargas');
        $this->template->build('waadmin/paginas/descargas', $data);
    }

    /**
     * Contáctenos
     *
     * Página Contáctenos
     *
     * @package     Paginas
     * @author      Juan Julio Sandoval Layza
     * @since       17-08-2015
     * @version     Version 1.0
     */
    public function contactenos() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Traer información de una página
        $data['post'] = $this->Paginas->get_pagina(8);

        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Título',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion1',
                    'label' => 'Descripción',
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
                    "nombre_corto" => $post['nombre_corto'],
                    "resumen" => $post['resumen'],
                    "descripcion1" => $post['descripcion1']
                );
                $this->db->where('id', $post['id']);
                $this->db->update('pagina', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/paginas/contactenos");
            }
        }

        $this->template->title('Página Contáctenos');
        $this->template->build('waadmin/paginas/contactenos', $data);
    }
    
    /**
     * Pagos
     *
     * Página pagos
     *
     * @package		Paginas
     * @author		Juan Julio Sandoval Layza
     * @copyright       Winner System 
     * @since		07-05-2015
     * @version		Version 1.0
     */
    public function pagos() {
        $data['user_info'] = $this->session->userdata('s_user_info');
        //Traer información de una página
        $data['post'] = $this->Paginas->get_pagina(7);

        if ($this->input->post()) {
            $config = array(
                array(
                    'field' => 'nombre_corto',
                    'label' => 'Título',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'descripcion1',
                    'label' => 'Descripción',
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
                    "nombre_corto" => $post['nombre_corto'],
                    "resumen" => $post['resumen'],
                    "descripcion1" => $post['descripcion1']
                );

                //cargar imágenes
                $imagen_info = $this->imaupload->do_upload("/images/upload/", "imagen_1");
                if (!empty($imagen_info['upload_data'])) {
                    $data_update['imagen_1'] = $imagen_info['upload_data']['file_name'];
                }

                $this->db->where('id', $post['id']);
                $this->db->update('pagina', $data_update);

                $this->session->set_userdata('msj_success', "Registro editado satisfactoriamente.");
                redirect("waadmin/paginas/nosotros");
            }
        }

        $this->template->title('Página pagos');
        $this->template->build('waadmin/paginas/pagos', $data);
    }

}

/* End of file categorias.php */
/* Location: ./application/controllers/waadmin/categorias.php */