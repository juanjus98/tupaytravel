<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Waauth extends CI_Controller {
    public $user_info; 

    function __construct() {
        parent::__construct();
        $this->template->set_layout('waadmin/login.php');
    }

    public function index() {
        $user_info = $this->session->userdata("s_user_info");

        if($user_info['authentication']) {
            redirect($this->config->item('url_login', 'auth'));
        }

        /**
         * Form acctions
         */
        if ($this->input->post()) {
            $data['post'] = $this->input->post();

            $this->form_validation->set_rules('username', 'Usuario', 'required',
                array('required' => 'Ingresar Usuario.')
                );
            $this->form_validation->set_rules('password', 'Contraseña', 'required',
                array('required' => 'Ingresar Contraseña')
                );

            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');

            if ($this->form_validation->run() == FALSE){
                /*Error*/
            }else{
                /*Login*/
                $user_data = array(
                    "usuario" => $this->input->post("username"),
                    "contrasena" => trim($this->input->post("password"))
                    );

                $login = $this->auth->login($user_data);
                if ($login) {
                    /*$this->session->set_userdata("msj_success","Autenticado satisfactoriamente.");*/
                    redirect($this->config->item('url_login', 'auth'));
                } else {
                    $this->session->set_userdata('msj_error', "Usuario o contraseña incorrectos.");
                    /*redirect('login');*/
                }

            }
        }

        $data['user_info'] = "";
        $this->template->title('Inicias Sesión.');
        $this->template->build('waadmin/auth/login', $data);
    }


    function logout() {
        $this->auth->logout();
    }

    function perfil(){
        $this->template->set_layout('waadmin/intranet.php');
        $this->load->library('bcrypt');

        /**
        * Verficamos si existe una session activa
        */
        $this->auth->logged_in();

        //Información del usuario que ha iniciado session
        $this->user_info = $this->auth->user_profile();

        $tipo = $this->uri->segment(3);
        $tipos_vista = array('V' => 'Visualizar', 'E' => 'Editar');

        $data['tipo'] = $tipos_vista[$tipo];
        $data['wa_tipo'] = $tipo;
        $data['wa_modulo'] = $tipos_vista[$tipo];
        $data['wa_menu'] = 'Perfil de usuario';

        $data['current_url'] = base_url(uri_string());
        $data['back_url'] = base_url('waadmin/perfil/V');
        $data['edit_url'] = base_url('waadmin/perfil/E');

        $data['post'] = $this->user_info;

        if ($this->input->post()) {
            $post= $this->input->post();
            $data['post'] = $post;

            $config = array(
               array(
                   'field' => 'nombre',
                   'label' => 'Nombre',
                   'rules' => 'required',
                   'errors' => array(
                       'required' => 'Campo requerido.',
                       )
                   ),
               array(
                   'field' => 'apellido',
                   'label' => 'Apellidos',
                   'rules' => 'required',
                   'errors' => array(
                       'required' => 'Campo requerido.',
                       )
                   )
               );

            /**
             * Validar contraseñas.
             */
            if($post['ck_cambiar_pass']){
                $config[] = array(
                   'field' => 'password',
                   'label' => 'Contraseña actual',
                   'rules' => 'required|callback_password_check',
                   'errors' => array(
                       'required' => 'Campo requerido.',
                       'password_check' => 'Contraseña actual incorrecta.',
                       )
                   );
                $config[] = array(
                   'field' => 'new_password',
                   'label' => 'Nueva contraseña',
                   'rules' => 'required|min_length[4]',
                   'errors' => array(
                       'required' => 'Campo requerido.',
                       'min_length' => 'Ingresar mínimo 4 caracteres.',
                       )
                   );
            }

            $this->form_validation->set_rules($config);
            $this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

            if ($this->form_validation->run() == FALSE){
             /*Error*/
             $data['post'] = $this->input->post();
         }else{

            $update_data_personal = array(
                'nombre' => $post['nombre'],
                'apellido' => $post['apellido'],
                'telefono' => $post['telefono'],
                'email' => $post['email']
                );

            $this->db->where('id_personal', $post['id_personal']);
            $this->db->update('wa_personal', $update_data_personal);

            /**
             * Actualizar contraseña
             */
            if($post['ck_cambiar_pass']){
                $password = $this->bcrypt->hash($post['new_password']);
                $update_data_usuario = array('password' => $password);
                $this->db->where('id_usuario', $post['id_usuario']);
                $this->db->update('wa_usuario', $update_data_usuario);
            }

            $this->session->set_userdata('msj_success', "Registros actualizados satisfactoriamente.");
            redirect('/waadmin/perfil/V');
        }
    }

    $this->template->title('Usuario');
    $this->template->build('waadmin/auth/perfil', $data);
}

public function password_check(){
    $valida_data = array(
        'usuario' => $this->input->post('usuario'),
        'contrasena' => $this->input->post('password')
        );
    $valida_contrasena = $this->auth->valida_contrasena($valida_data);

    if(!$valida_contrasena){
        $this->form_validation->set_message('password_check', 'Contraseña actual incorrecta');
        return FALSE;
    }else{
        return TRUE;
    }
}

}