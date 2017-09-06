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

    $this->load->model("promociones_model","Promociones");
    $this->load->model("videos_model","Videos");
    $this->load->model("paquetes_model","Paquetes");
    $this->load->model("tours_model","Tours");
    $this->load->model("hoteles_model","Hoteles");
    $this->load->model("paquetes_galeria_model","Paquetes_galeria");
    $this->load->model("tours_itinerario_model","Tours_itinerario");
    $this->load->model("hoteles_galeria_model","Hoteles_galeria");
    $this->load->model("provincias_model","Provincias");

    /**
     * Información del website
     */
    $this->website_info = $this->Inicio->get_website();
  }

  public function redirect(){
    redirect('waadmin', 'refresh');
  }

  public function index() {
    $data['active_link'] = "inicio";

    $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($data['website']); //siempre

    //Promociones
    $data['promociones'] = $this->Promociones->listado(6,0);
    //Videos
    $data['videos'] = $this->Videos->listado(8,0);

    //Paquetes
    $data_paquetes = array('ordenar_por' => 't1.orden', 'ordentipo' => 'ASC');
    $total_paquetes = $this->Paquetes->total_registros();
    $data['paquetes'] = $this->Paquetes->listado($total_paquetes,0,$data_paquetes);

    //Tours
    $data_tours = array('ordenar_por' => 't1.orden', 'ordentipo' => 'ASC');
    $total_tours = $this->Tours->total_registros();
    $data['tours'] = $this->Tours->listado($total_tours,0,$data_tours);

    //Hoteles
    $total_hoteles = $this->Hoteles->total_registros();
    $data['hoteles'] = $this->Hoteles->listado($total_hoteles,0);
    /*echo "<pre>";
    print_r($data['paquetes']);
    echo "</pre>";*/


    $data_crud['table'] = "slider as t1";
    $data_crud['columns'] = "t1.*";
    $data_crud['where'] = array("t1.estado !=" => 0);
    $data_crud['order_by'] = "t1.orden Asc";
    $data['slider'] = $this->Crud->getRows($data_crud);


    $this->template->title('Inicio');
    $this->template->build('paginas/index', $data);
  }

  public function paquetes($args=null) {
    $data['dias'] = $this->Paquetes->listadoDias();
    
    $data_busqueda = array();
    $nroDias = 0;
    if(isset($args)){
      $_hasta = explode('hasta_', $args);
      if(count($_hasta) > 1){
        $_desde = explode('desde_',$_hasta[0]);
        $strDesde =  substr($_desde[1], 4,4) . "-". substr($_desde[1], 2,2) . "-" . substr($_desde[1], 0,2);
        $strHasta =  substr($_hasta[1], 4,4) . "-". substr($_hasta[1], 2,2) . "-" . substr($_hasta[1], 0,2);
        $fechaDesde = date('Y-m-d', strtotime($strDesde));
        $data_busqueda['dateDesde'] = $fechaDesde;
        $fechaHasta = date('Y-m-d', strtotime($strHasta));
        $data_busqueda['dateHasta'] = $fechaHasta;
        $dateDiff = strtotime($strHasta) - strtotime($strDesde);
        $nroDias = floor($dateDiff / (60 * 60 * 24)) + 1;
        $data_busqueda['fechaDesde'] = date("d-m-Y", strtotime($fechaDesde));
        $data_busqueda['fechaHasta'] = date("d-m-Y", strtotime($fechaHasta));
      }

      $_dias = explode('dias', $args);
      if(count($_dias) > 1){
        $nroDias = $_dias[0];
      }

      $data_busqueda['nro_dias'] = $nroDias;
      $s_busqueda['s_busqueda_paquetes'] = $data_busqueda;
      $this->session->set_userdata($s_busqueda);

    }else {
      $this->session->unset_userdata('s_busqueda_paquetes');
    }

    if($this->session->userdata('s_busqueda_paquetes')){
      $data['busqueda_info'] = $this->session->userdata('s_busqueda_paquetes');
    }

    $data['active_link'] = "paquetes-tours";
    $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($this->website_info); //siempre

    //Paquetes
    $data_paquetes = array('ordenar_por' => 't1.orden', 'ordentipo' => 'ASC');
    if($nroDias > 0){
      $data_paquetes['nro_dias'] = $nroDias;
      $data_busqueda['nroDias'] = $nroDias;
    }

    $total_paquetes = $this->Paquetes->total_registros($data_paquetes);
    $data['total_paquetes'] = $total_paquetes;
    $data['paquetes'] = $this->Paquetes->listado($total_paquetes,0,$data_paquetes);

    //Información de busqueda
    $data['busqueda'] = $data_busqueda;

    $this->template->title('Paquetes');
    $this->template->build('paginas/paquetes', $data);
  }

  public function paquete($url_key) {
    //Verficamos si se hizo una busqueda por fechas
    if($this->session->userdata('s_busqueda_paquetes')){
      $data['busqueda_info'] = $this->session->userdata('s_busqueda_paquetes');
    }

    //Consultar Paquete
    $data_paquete = array('url_key' => $url_key);
    $paquete = $this->Paquetes->get_row($data_paquete);
    $data['paquete'] = $paquete;

    $data['active_link'] = "paquetes-tours";
    $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($paquete, 'paquete'); //siempre

    //Formas de pago (página)
    if(!empty($paquete['formas_pago_id'])){
      $data_pagina = array('id' => $paquete['formas_pago_id']);
      $data['formas_pago'] = $this->Paginas->get_row($data_pagina);
    }

    //Paises
    $data['paises'] = $this->Crud->getPaises();

    $this->template->title('Paquete');
    $this->template->build('paginas/paquete', $data);
  }


/**
 * Tours
 */
public function tours($provincia_key=null, $categoria_key=null, $args=null) {
  $data_busqueda = array();
  $data_dias = array();

  $data_tours = array('ordenar_por' => 't1.orden', 'ordentipo' => 'ASC');
  /**
   * Setear argumentos de busqueda
   */
  if(isset($provincia_key)){
    $data_provincia = array('url_key' => $provincia_key);
    $provincia = $this->Provincias->get_row($data_provincia);
    $id_provincia = $provincia['id'];
    $data_tours['id_provincia'] = $id_provincia;
    $data_busqueda['provincia'] = $provincia;

    $data_dias['id_provincia'] = $id_provincia;
  }

  if(isset($categoria_key)){
    //Consultar categoria
    $data_crud['table'] = "tbltours_categoria as t1";
    $data_crud['columns'] = "t1.*";
    $data_crud['where'] = array("t1.url_key" => $categoria_key, "t1.estado !=" => 0);
    $categoria = $this->Crud->getRow($data_crud);
    $id_tbltours_categoria = $categoria['id'];
    $data_tours['id_tbltours_categoria'] = $id_tbltours_categoria;
    $data_busqueda['categoria'] = $categoria;
  }

  if(isset($args)){
    list($nro_dias, $str_dias) = explode("-", $args);
    /*echo $nro_dias;*/
    $data_tours['nro_dias'] = $nro_dias;
    $data_busqueda['nro_dias'] = $nro_dias;
  }


  $data['dias'] = $this->Tours->listadoDias($data_dias);

  //Consultar categoria
  $data_crud['table'] = "tbltours_categoria as t1";
  $data_crud['columns'] = "t1.*";
  $data_crud['where'] = array("t1.estado !=" => 0);
  $data_crud['order_by'] = "t1.categoria ASC";
  $data['categorias'] = $this->Crud->getRows($data_crud);


  $data['active_link'] = "Tours";
  $data['website'] = $this->Inicio->get_website();
  $data['head_info'] = head_info($this->website_info);


  $total_tours = $this->Tours->total_registros($data_tours);
  $data['total_listado'] = $total_tours;
  $data['listado'] = $this->Tours->listado($total_tours,0,$data_tours);

    //Información de busqueda
  $data['busqueda'] = $data_busqueda;

  $this->template->title('Tours');
  $this->template->build('paginas/tours', $data);
}

/**
 * Tour
 */
public function tour($url_key) {

    //Consultar tour
  $data_paquete = array('url_key' => $url_key);
  $tour = $this->Tours->get_row($data_paquete);
  $data['tour'] = $tour;

  $data['active_link'] = "Tours";
  $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($tour, 'tour'); //siempre

    //Formas de pago (página)
    if(!empty($tour['formas_pago_id'])){
      $data_pagina = array('id' => $tour['formas_pago_id']);
      $data['formas_pago'] = $this->Paginas->get_row($data_pagina);
    }

    //Paises
    $data['paises'] = $this->Crud->getPaises();

    $this->template->title('Tour');
    $this->template->build('paginas/tour', $data);
  }

/**
 * Hoteles
 */
public function hoteles($provincia_key=null, $categoria_key=null, $args=null) {
  $data_busqueda = array();
  $data_dias = array();

  $data_hoteles = array('ordenar_por' => 't1.orden', 'ordentipo' => 'ASC');
  /**
   * Setear argumentos de busqueda
   */
  if(isset($provincia_key)){
    $data_provincia = array('url_key' => $provincia_key);
    $provincia = $this->Provincias->get_row($data_provincia);
    $id_provincia = $provincia['id'];
    $data_hoteles['id_provincia'] = $id_provincia;
    $data_busqueda['provincia'] = $provincia;
  }

  $data['active_link'] = "Hoteles";
  $data['website'] = $this->Inicio->get_website();
  $data['head_info'] = head_info($this->website_info);


  $total_hoteles = $this->Hoteles->total_registros($data_hoteles);
  $data['total_listado'] = $total_hoteles;
  $data['listado'] = $this->Hoteles->listado($total_hoteles,0,$data_hoteles);

    //Información de busqueda
  $data['busqueda'] = $data_busqueda;

  $this->template->title('Hoteles');
  $this->template->build('paginas/hoteles', $data);
}

/**
 * Tour
 */
public function hotel($id_hotel, $titulo) {

    //Consultar tour
  $data_hotel = array('id_hotel' => $id_hotel);
  $hotel = $this->Hoteles->get_row($data_hotel);
  $data['hotel'] = $hotel;

  //Consultar galería
  $data_galeria = array('id_hotel' => $id_hotel);
  $total_galeria = $this->Hoteles_galeria->total_registros($data_galeria);
  $galeria = $this->Hoteles_galeria->listado($total_galeria, 0, $data_galeria);
  $data['galeria'] = $galeria;

  //Imagen principal
  foreach ($galeria as $key => $value) {
    /*echo "<pre>";
    print_r($value);
    echo "</pre>";*/
    if($value['principal'] == 1){
      $hotel['imagen'] = $value['foto'];
      break;
    }
  }

  //Relacionados
  $data_hoteles = array('id_provincia' => $hotel['id_provincia']);
  $data['hoteles_relacionados'] = $this->Hoteles->listado(8,0,$data_hoteles);

  $data['active_link'] = "Hoteles";
  $data['website'] = $this->Inicio->get_website();
  $data['head_info'] = head_info($hotel, 'hotel'); //siempre


    //Paises
    $data['paises'] = $this->Crud->getPaises();

    $this->template->title('Hotel');
    $this->template->build('paginas/hotel', $data);
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

/**
 * Reservar
 */
public function reservar() {
  $this->template->title('Reservar');
    $data['active_link'] = "contactanos";
        $data['website'] = $this->Inicio->get_website(); //siempre
        $data['head_info'] = head_info($data['website']); //siempre

        //Enviar formulario
        if($this->input->post()){
          $post = $this->input->post();

          $config = array(
           array(
             'field' => 'nombres',
             'label' => 'Nombres y apellidos',
             'rules' => 'required',
             'errors' => array(
               'required' => 'Campo requerido.',
               )
             ),
           array(
             'field' => 'celular',
             'label' => 'Celular',
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
             )
           );

          $this->form_validation->set_rules($config);
          $this->form_validation->set_error_delimiters('<p class="text-red text-error">', '</p>');

          if ($this->form_validation->run() == FALSE){
            $data['post'] = $post;
          }else{
            
            //GUARDAR EN LA BASE DE DATOS LA NUEVA SOLICITUD DE COTIZACIÓN.
            $data_insert = array(
              "tipo_info" => strip_tags($post['tipo_info']),
              "id_info" => strip_tags($post['id_info']),
              "date_desde" => strip_tags($post['dateDesde']),
              "date_hasta" => strip_tags($post['dateHasta']),
              "pais_origen" => strip_tags($post['pais_origen']),
              "ciudad" => strip_tags($post['ciudad']),
              "adultos" => strip_tags($post['adultos']),
              "adolecentes" => strip_tags($post['adolecentes']),
              "ninios" => strip_tags($post['ninios']),
              "infantes" => strip_tags($post['infantes']),
              "nombres" => strip_tags($post['nombres']),
              "telefono" => strip_tags($post['telefono']),
              "celular" => strip_tags($post['celular']),
              "email" => strip_tags($post['email']),
              "mensaje" => strip_tags($post['mensaje']),
              "agregar" => date("Y-m-d H:i:s")
            );

            $this->db->insert('reservas', $data_insert);
            $reservas_id = $this->db->insert_id();

            //Consultar Paquete
            $data_paquete = array('id' => $post['id_info']);
            $paquete = $this->Paquetes->get_row($data_paquete);

            $url_servicio = base_url() . 'paquete-tour/' . $paquete['url_key'];
            $servicio = array(
              'nombre_servicio' => $paquete['nombre'],
              'descripcion_servicio' => $paquete['detalles'],
              'url_servicio' => $url_servicio,
              'itinerario' => $paquete['itinerarios']
            );
            
            $data_email['servicio'] = $servicio;

            //Templates Email
            $data_email['post'] = $data_insert;

            //Otros datos para el email
            $data_email['website'] = $this->Inicio->get_website();
            $data_email['cabeceras'] = $this->config->item('waemail');

            if($this->session->userdata('s_busqueda_paquetes')){
            $data_email['busqueda_info'] = $this->session->userdata('s_busqueda_paquetes');
            }
            
            //Template user email
            $email_user = $this->load->view('paginas/email/tp_reservar_user', $data_email, TRUE);

            //Template admin admin
            $email_admin = $this->load->view('paginas/email/tp_reservar', $data_email, TRUE);

            //Enviar email
            $this->load->library('email');

            $config['useragent']           = "CodeIgniter";
            /*$config['protocol'] = 'sendmail';*/
            $config['protocol']            = "smtp";
            $config['smtp_host']           = "mail.tupaytravel.com";
            $config['smtp_port']           = "25";

            $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';

            $this->email->initialize($config);

            $this->email->from('reservas@tupaytravel.com', utf8_decode('Reservas Tupay Travel'));
            $this->email->reply_to($post['email'], utf8_decode($post['nombres']));
            $this->email->to('tupaytravel@hotmail.com'); //Email destino (quién recibe el correo)
            $this->email->cc('juanjus98@gmail.com');
            //$this->email->bcc('them@their-example.com');

            $subject_admin = utf8_decode('Nueva solicitud de reserva de ') . utf8_decode($post['nombres']);
            $this->email->subject($subject_admin);
            $this->email->message($email_admin);
            $this->email->send(); //Envia email al administrador
            /*echo $this->email->print_debugger();*/

            //ENVIAMOS EMAIL DE CONFIRMACIÓN
            $this->email->clear();
            $this->email->initialize($config);

            $this->email->from('reservas@tupaytravel.com', utf8_decode('Reservas Tupay Travel'));
            $this->email->to($post['email'], utf8_decode($post['nombres']));
            $this->email->subject(utf8_decode('Confirmación de reserva.'));
            $this->email->message($email_user);
            $this->email->send();
            $this->email->print_debugger(array('headers'));

            /*print_r($this->email->print_debugger());*/

            $redirect = $url_servicio . '?ack=success';
            redirect($redirect);
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