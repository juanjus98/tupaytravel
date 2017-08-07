<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller{

	public  $user_info;

	function __construct(){
		parent::__construct();
		$this->template->set_layout('waadmin/intranet.php');

		/**
		 * Verficamos si existe una session activa
		 */
		$this->auth->logged_in();

		//Información del usuario que ha iniciado session
		$this->user_info = $this->auth->user_profile();

		$this->load->model("crud_model","Crud");
		$this->load->model("website_model","Website");
		

	}

	function index($tipo='V',$id=1){
		$this->editar($tipo,$id);
	}

	function editar($tipo='V',$id=1){
		$this->load->library("imaupload");

	   $data['current_url'] = base_url(uri_string());
	   $data['back_url'] = base_url('waadmin/website/editar/V/' . $id);
	   if(isset($id)){
	       $data['edit_url'] = base_url('waadmin/website/editar/E/' . $id);
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
	   $data['wa_menu'] = 'Website';

		//Consultar website
		$data_crud['table'] = "website as t1";
		$data_crud['columns'] = "t1.*";
		$data_crud['where'] = array("t1.id" => $id, "t1.estado !=" => 0);
		$data['post'] = $this->Crud->getRow($data_crud);

		if ($this->input->post()) {
			$data['post'] = $this->input->post();

			$config = array(
				array(
					'field' => 'title',
					'label' => 'Nomnre',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'description',
					'label' => 'Descripción',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'keywords',
					'label' => 'keywords',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'telefono_1',
					'label' => 'telefono',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'direccion',
					'label' => 'Dirección',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Campo requerido.',
						)
					),
				array(
					'field' => 'email_1',
					'label' => 'E-mail 1',
					'rules' => 'required|valid_email',
					'errors' => array(
						'required' => 'Campo requerido.',
						'valid_email' => 'E-mail inválido.',
						)
					),
				array(
					'field' => 'email_2',
					'label' => 'E-mail 2',
					'rules' => 'required|valid_email',
					'errors' => array(
						'required' => 'Campo requerido.',
						'valid_email' => 'E-mail inválido.',
						)
					)
				);

			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

			$post = $this->input->post();

			if ($this->form_validation->run() == FALSE){
				/*Error*/
				$data['post'] = $post;
			}else{
				//Cargar Imagen
	           if($_FILES["imagen_1"]){
	           	   $upload_path = $this->config->item('upload_path');
	               $imagen_info = $this->imaupload->do_upload($upload_path, "imagen_1");
	           }

				//Actualizar website.
				$website_id = $post['id'];

				$data_form = array(
					'title' => $post['title'], 
					'description' => $post['description'], 
					'keywords' => $post['keywords'], 
					'direccion' => $post['direccion'],
					'telefono_1' => $post['telefono_1'], 
					'email_1' => $post['email_1'], 
					'email_2' => $post['email_2'], 
					'url_facebook' => $post['url_facebook'], 
					'url_twitter' => $post['url_twitter'],
					);

				//cargar imágenes
				if (!empty($imagen_info['upload_data'])) {
					$data_form['imagen_1'] = $imagen_info['upload_data']['file_name'];
				}

				$data_update = array(
					'table' => 'website',
					'where' => array('id' => $website_id),
					'columns' => $data_form
					);
				
				$this->Crud->updateRow($data_update);
				
				$this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
				redirect('waadmin/website/V/' . $website_id);

			}

		}

		$this->template->title('Gestionar website.');
		$this->template->build('waadmin/website/editar', $data);
	}

}