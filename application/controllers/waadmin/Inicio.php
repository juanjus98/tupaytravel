<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller{

	public  $user_info;

	function __construct(){
		parent::__construct();
		$this->template->set_layout('waadmin/intranet.php');

		/**
		 * Verficamos si existe una session activa
		 */
		$this->auth->logged_in();
		
		$this->load->model('inicio_model', 'Inicio');

		//Información del usuario que ha iniciado session
		$this->user_info = $this->auth->user_profile();


	}

	function index(){
		$data['website'] = $this->Inicio->get_website(); //siempre
		/*echo "<pre>";
		print_r($website);
		echo "</pre>";*/
		$data['wa_modulo'] = 'Ajustes';
		$data['wa_menu'] = 'Inicio';
		
		$this->template->title('Inicio');
        $this->template->build('waadmin/inicio/index', $data);
	}

}