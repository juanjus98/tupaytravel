<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos extends CI_Controller{

	public  $user_info;

	function __construct(){
		parent::__construct();
		$this->template->set_layout('intranet.php');

		/**
		 * Verficamos si existe una session activa
		 */
		$this->auth->logged_in();

		$this->load->model("crud_model","Crud");
		$this->load->model("grupos_model","Grupos");
		
		//Información del usuario que ha iniciado session
		$this->user_info = $this->auth->user_profile();

	}

	function index(){
		/*$data['wa_tipo'] = $tipo;*/
		$data['wa_modulo'] = 'Ajustes';
		$data['wa_menu'] = 'Grupos';

		$sessionName = 's_grupos'; //Session name

		//Paginacion
        $base_url = base_url() . "comprobantes/comprobantes/index";
        $per_page = 10; //registros por página
        $uri_segment = 4; //segmento de la url
        $num_links = 4; //número de links
        //Página actual
        $page = ($this->uri->segment($uri_segment)) ? $this->uri->segment($uri_segment) : 0;

//        if ($page == 0) {
//            $this->session->unset_userdata('s_post');
//        }

        if (isset($_GET['refresh'])) {
            $this->session->unset_userdata('s_post');
        }

        //Setear post
        $post = $this->Crud->set_post($this->input->post(),$sessionName);
        $data['post'] = $post;

        //Total de registros por post
        $data['total_registros'] = $this->Grupos->total_registros($post);

        //Listado
        $data['listado'] = $this->Grupos->listado($per_page, $page, $post);

        //Paginacion
        $total_rows = $data['total_registros'];

        $set_paginacion = set_paginacion($base_url, $per_page, $uri_segment, $num_links, $total_rows);

        $this->pagination->initialize($set_paginacion);
        $data["links"] = $this->pagination->create_links();


        if ($this->session->userdata("mensaje")) {
            $data["mensaje"] = $this->session->userdata("mensaje");
            $this->session->unset_userdata("mensaje");
        }

		$this->template->title('Listado de grupos.');
		$this->template->build('admin/grupos/index', $data);
	}

	function editar($tipo='V',$id=1){
		$data['wa_tipo'] = $tipo;
		$data['wa_modulo'] = 'Ajustes';
		$data['wa_menu'] = 'Condominio';
		//Consultar condominio
		$data_crud['table'] = "wa_condominio as t1";
		$data_crud['columns'] = "t1.*";
		$data_crud['where'] = array("t1.id_condominio" => $id, "t1.estado !=" => 0);
		$data['condominio'] = $this->Crud->getRow($data_crud);

		//Consultar Administrador
		$id_condominio = $data['condominio']['id_condominio'];
		$data_crud['table'] = "wa_personal as t1";
		$data_crud['columns'] = "t1.*";
		$data_crud['where'] = array("t1.id_condominio" => $id_condominio, "t1.estado !=" => 0, "t1.id_cargo" => 1);
		$data['administrador'] = $this->Crud->getRow($data_crud);

		if ($this->input->post()) {
			$data['post'] = $this->input->post();

			$config = array(
				array(
					'field' => 'condominio[codigo_condominio]',
					'label' => 'Código',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'condominio[nombre_condominio]',
					'label' => 'Nombre',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'condominio[direccion]',
					'label' => 'Dirección',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'condominio[telefono]',
					'label' => 'telefono',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'administrador[nombre]',
					'label' => 'Nombres',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'administrador[apellido]',
					'label' => 'Apellidos',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'administrador[telefono]',
					'label' => 'telefono',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'administrador[email]',
					'label' => 'E-mail',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					)
				);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

			$condominio = $this->input->post('condominio');
			$administrador = $this->input->post('administrador');

			if ($this->form_validation->run() == FALSE){
				/*Error*/
				$data['condominio'] = $condominio;
				$data['administrador'] = $administrador;
			}else{
				//Actualizar condominio.
				$id_condominio = $condominio['id_condominio'];
				unset($condominio['id_condominio']);
				$data_update = array(
					'table' => 'wa_condominio',
					'where' => array('id_condominio' => $id_condominio),
					'columns' => $condominio
					);
				
				$this->Crud->updateRow($data_update);
				
				//Actualizar administrador.
				$id_personal = $administrador['id_personal'];
				unset($condominio['id_personal']);
				$data_update_admin = array(
					'table' => 'wa_personal',
					'where' => array('id_personal' => $id_personal),
					'columns' => $administrador
					);
				$this->Crud->updateRow($data_update_admin);
				
				$this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
				redirect('admin/condominio/V/' . $id_condominio);

			}

		}


		$this->template->title('Gestionar condominio.');
		$this->template->build('admin/condominios/editar', $data);
	}

}