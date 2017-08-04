<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Paginas extends CI_Controller {
  public $website_info;

  function __construct() {
    parent::__construct();
    $this->template->set_layout('website.php');

    $this->load->model('inicio_model', 'Inicio');
    $this->load->model('paginas_model', 'Paginas');

    $this->load->model('productos_model', 'Productos');
    $this->load->model("crud_model","Crud");

    /**
     * Información del website
     */
    $this->website_info = $this->Inicio->get_website();
  }

  public function index() {
    $data['active_link'] = "inicio";

    $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($data['website']); //siempre

    $data_crud['table'] = "slider as t1";
    $data_crud['columns'] = "t1.*";
    $data_crud['where'] = array("t1.estado !=" => 0);
    $data_crud['order_by'] = "t1.orden Asc";
    $data['slider'] = $this->Crud->getRows($data_crud);


    $this->template->title('Inicio');
    $this->template->build('paginas/index', $data);
  }


    public function contactanos() {
        $this->template->title('Contáctanos');
        $data['active_link'] = "contactanos";
        $data['website'] = $this->Inicio->get_website(); //siempre
        $data['head_info'] = head_info($data['website']); //siempre

      //Enviar formulario
        if($this->input->post()){
          $post = $this->input->post();
          $config = array(
           array(
               'field' => 'nombre',
               'label' => 'Nombres',
               'rules' => 'required',
               'errors' => array(
                   'required' => 'Campo requerido.',
                   )
               ),
           array(
               'field' => 'email',
               'label' => 'E-mail',
               'rules' => 'required|valid_email',
               'errors' => array(
                   'required' => 'Campo requerido.',
                   'valid_email' => 'E-mail inválido.'
                   )
               ),
           array(
               'field' => 'telefono',
               'label' => 'Teléfono',
               'rules' => 'required',
               'errors' => array(
                   'required' => 'Campo requerido.',
                   )
               )
           );

       $this->form_validation->set_rules($config);
       $this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

          if ($this->form_validation->run() == FALSE)
          {
            $data['post'] = $post;
          }else{
            //GUARDAR EN LA BASE DE DATOS LA NUEVA SOLICITUD DE COTIZACIÓN.
            $data_insert = array(
              "nombres" => strip_tags($post['nombre']),
              "telefono" => strip_tags($post['telefono']),
              "email" => strip_tags($post['email']),
              "mensaje" => strip_tags($post['mensaje']),
              "agregar" => date("Y-m-d H:i:s")
              );

            /*$this->db->insert('contactos', $data_insert);
            $contactos_id = $this->db->insert_id();*/

            //Templates Email
            $data_email['post'] = $data_insert;

            //Otros datos para el email
            $data_email['website'] = $this->Inicio->get_website();
            $data_email['cabeceras'] = $this->config->item('waemail');
            
            //Template user email
            $email_user = $this->load->view('paginas/email/tp_contacto_user', $data_email, TRUE);

            //Template admin admin
            $email_admin = $this->load->view('paginas/email/tp_contacto', $data_email, TRUE);

            //Enviar email
            $this->load->library('email');

            $config['useragent']           = "CodeIgniter";
            /*$config['protocol'] = 'sendmail';*/
            $config['protocol']            = "smtp";
            $config['smtp_host']           = "localhost";
            $config['smtp_port']           = "25";

            $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';

            $this->email->initialize($config);

            $this->email->from('informes@consorciobongourmet.com', utf8_decode('Informes Bon Gourmet Eventos y Convenciones'));
            $this->email->reply_to($post['email'], utf8_decode($post['nombre']));
            $this->email->to('juanjus98@gmail.com'); //Email destino (quién recibe el correo)
            /*$this->email->cc('epropesco@hotmail.com');*/
            //$this->email->bcc('them@their-example.com');

            $this->email->subject(utf8_decode('Nuevo contacto.'));
            $this->email->message($email_admin);
            $this->email->send(); //Envia email al administrador
            /*echo $this->email->print_debugger();*/

            //ENVIAMOS EMAIL DE CONFIRMACIÓN
            $this->email->clear();
            $this->email->initialize($config);

            $this->email->from('informes@consorciobongourmet.com', utf8_decode('Informes Bon Gourmet Eventos y Convenciones'));
            $this->email->to($post['email'], utf8_decode($post['nombre']));
            $this->email->subject(utf8_decode('Gracias por contáctarnos - Bon Gourmet Eventos y Convenciones'));
            $this->email->message($email_user);
            $this->email->send();
            $this->email->print_debugger(array('headers'));

            redirect("confirmacion");
          }
        } //Post


      $this->template->build('paginas/contactanos', $data);
    }

    //Mensaje de confirmación
    public function confirmacion($token='') {
      $data['active_link'] = "inicio";
      $data['website'] = $this->Inicio->get_website();
      $data['head_info'] = head_info($data['website']); //siempre

      $this->template->title('Confirmación');
      $this->template->build('paginas/confirmacion', $data);
    }

    public function salones() {
      $this->template->title('Salones');

      $data['active_link'] = "salones";
      $data['footer_line'] = "salones";
      $data['website'] = $this->Inicio->get_website();

      //Categorías para carousel parent_id != 0, destacar=1
      $data_crud['table'] = "categoria as t1";
      $data_crud['columns'] = "t1.*";
      $data_crud['where'] = array("t1.parent_id !=" => 0, "t1.destacar" => 1, "t1.estado !=" => 0);
      $data_crud['order_by'] = "t1.orden Asc";
      $data['categorias_carousel'] = $this->Crud->getRows($data_crud);

      $data['head_info'] = head_info($data['website']); //siempre
      $this->template->build('paginas/salones', $data);
    }

    public function salon($url_key=null) {
      $this->template->title('Salon');
      $data['active_link'] = "salones";
      $data['active_gallery'] = true;

      $data['website'] = $this->Inicio->get_website();
      
      //Consultar salón
      $data_crud['table'] = "producto as t1";
      $data_crud['columns'] = "t1.*";
      $data_crud['where'] = array("t1.url_key" => $url_key, "t1.estado !=" => 0);
      /*$data_crud['order_by'] = "t1.orden Asc";*/
      $salon = $this->Crud->getRow($data_crud);
      $data['salon'] = $salon;

      //Consultar producto_especificaciones
      $data_crud['table'] = "producto_especificaciones as t1";
      $data_crud['columns'] = "t1.*";
      $data_crud['where'] = array("t1.producto_id" => $salon['id'], "t1.estado !=" => 0);
      $data_crud['order_by'] = "t1.id Asc";
      $producto_especificaciones = $this->Crud->getRows($data_crud);
      $data['producto_especificaciones'] = $producto_especificaciones;

      //Consultar producto_imagen
      $data_crud['table'] = "producto_imagen as t1";
      $data_crud['columns'] = "t1.*";
      $data_crud['where'] = array("t1.producto_id" => $salon['id'], "t1.estado !=" => 0);
      $data_crud['order_by'] = "t1.id Asc";
      $galeria = $this->Crud->getRows($data_crud);
      $data['galeria'] = $galeria;

      $data['head_info'] = head_info($salon,'salon'); //siempre
      $this->template->build('paginas/salon', $data);
    }

    public function servicio($url_key=null) {
      $data['active_link'] = "servicios";
      $data['active_gallery'] = true;

      $data['website'] = $this->Inicio->get_website();
      
      //Consultar salón
      $data_crud['table'] = "servicio as t1";
      $data_crud['columns'] = "t1.*";
      $data_crud['where'] = array("t1.url_key" => $url_key, "t1.estado !=" => 0);
      $servicio = $this->Crud->getRow($data_crud);
      $data['servicio'] = $servicio;

      //Consultar servicio_detalle
      $data_crud['table'] = "servicio_detalle as t1";
      $data_crud['columns'] = "t1.*";
      $data_crud['where'] = array("t1.servicio_id" => $servicio['id'], "t1.estado !=" => 0);
      $data_crud['order_by'] = "t1.id ASC";
      $servicio_detalle = $this->Crud->getRows($data_crud);
      $data['servicio_detalle'] = $servicio_detalle;

      $data['head_info'] = head_info($servicio,'servicio'); //siempre
      $this->template->title('Servicio');
      $this->template->build('paginas/servicio', $data);
    }

}

    /* End of file categorias.php */
/* Location: ./application/controllers/waadmin/categorias.php */