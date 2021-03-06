<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Paginas extends CI_Controller {
  public $website_info;

  function __construct() {
    parent::__construct();
    $this->template->set_layout('website_main.php');

    $this->load->model('inicio_model', 'Inicio');
    $this->load->model('paginas_model', 'Paginas');

    //$this->load->model('productos_model', 'Productos');
    $this->load->model("crud_model","Crud");

    $this->load->model("paquetes_model","Paquetes");
    $this->load->model("tours_model","Tours");
    $this->load->model("hoteles_model","Hoteles");
    $this->load->model("paquetes_galeria_model","Paquetes_galeria");
    $this->load->model("tours_itinerario_model","Tours_itinerario");
    $this->load->model("hoteles_galeria_model","Hoteles_galeria");
    $this->load->model("promociones_model","Promociones");

    /**
     * Información del website
     */
    $this->website_info = $this->Inicio->get_website();
  }

  public function redirect(){
    redirect('waadmin', 'refresh');
  }

  public function index() {
    $this->template->set_layout('website.php');
    $this->load->model("videos_model","Videos");
    $data['active_link'] = "inicio";

    $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($data['website']); //siempre

    //Promociones
    $data['promociones'] = $this->Promociones->listado(6,0);
    //Videos
    $data['videos'] = $this->Videos->listado(8,0);

    //Paquetes
    $data_paquetes = array('ordenar_por' => 't1.orden', 'ordentipo' => 'ASC', 'publicar' => 1);
    $total_paquetes = $this->Paquetes->total_registros();
    $data['paquetes'] = $this->Paquetes->listado($total_paquetes,0,$data_paquetes);

    //Tours
    $data_tours = array('ordenar_por' => 't1.orden', 'ordentipo' => 'ASC', 'publicar' => 1);
    $total_tours = $this->Tours->total_registros();
    $data['tours'] = $this->Tours->listado($total_tours,0,$data_tours);

    //Hoteles
    $total_hoteles = $this->Hoteles->total_registros();
    $data['hoteles'] = $this->Hoteles->listado($total_hoteles,0);

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
    $data['actual_link'] = "detalles";
    //Verficamos si se hizo una busqueda por fechas
    if($this->session->userdata('s_busqueda_paquetes')){
      $data['busqueda_info'] = $this->session->userdata('s_busqueda_paquetes');
    }

    //Consultar Paquete
    $data_paquete = array('url_key' => $url_key);
    $paquete = $this->Paquetes->get_row($data_paquete);
    $paquete['tipo_info'] = 'P'; //Paquete
    $data['paquete'] = $paquete;

    $data['servicio_info'] = $paquete;

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

  public function pdf_paquete($url_key,$tipo='P') {
    //Verficamos si se hizo una busqueda por fechas
    if($this->session->userdata('s_busqueda_paquetes')){
      $data['busqueda_info'] = $this->session->userdata('s_busqueda_paquetes');
    }

  // boost the memory limit if it's low ;)
    /*ini_set('memory_limit','32M'); */

  //Consultar servicio
    $data_where = array('url_key' => $url_key);
    $resultado = $this->Paquetes->get_row($data_where);
    $data['post'] = $resultado;

    $url_servicio = base_url() . 'paquete-tour/' . $resultado['url_key'];
    $servicio = array(
      'nombre_servicio' => $resultado['nombre'],
      'descripcion_servicio' => $resultado['detalles'],
      'url_servicio' => $url_servicio,
      'itinerario' => $resultado['itinerarios']
      );

    $data['servicio'] = $servicio;
    $data['website'] = $this->Inicio->get_website();
    $cabeceras_email = $this->config->item('waemail');
    $cabeceras_email['titulo_email_admin'] = $servicio['nombre_servicio'];
    $data['cabeceras'] = $cabeceras_email;

  // render the view into HTML
    $data['titulo'] = $servicio['nombre_servicio'];

  //
    $file_name_pdf = $resultado['url_key'] . '.pdf';
    $html = $this->load->view('paginas/pdf/pdf_paquete', $data, true);
    /*die();*/

    $this->load->library('mimpdf');

    $pdf = $this->mimpdf->load();

  // Add a footer for good measure ;)
    $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("d/m/Y H:i"));

  // write the HTML into the PDF
    $pdf->WriteHTML($html);

     //Formas de pago (página)
    if(!empty($resultado['formas_pago_id'])){
      $data_pagina = array('id' => $resultado['formas_pago_id']);
      $data['formas_pago'] = $this->Paginas->get_row($data_pagina);
      $html_formas_pago = $this->load->view('paginas/pdf/pdf_formas_pago', $data, true);
      $pdf->AddPage();
      $pdf->WriteHTML($html_formas_pago);
    }

  // save to file because we can
    $pdf->Output($file_name_pdf, 'D');

  }


/**
 * Tours
 */
public function tours($provincia_key=null, $categoria_key=null, $args=null) {
  $this->load->model("provincias_model","Provincias");
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
  $data['actual_link'] = "detalles";
    //Consultar tour
  $data_paquete = array('url_key' => $url_key);
  $tour = $this->Tours->get_row($data_paquete);
  $tour['tipo_info'] = 'T'; //Tour
  $data['tour'] = $tour;

  $data['servicio_info'] = $tour;

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

  public function pdf_tour($url_key) {

  // boost the memory limit if it's low ;)
    /*ini_set('memory_limit','32M'); */

  //Consultar servicio
    $data_where = array('url_key' => $url_key);
    $resultado = $this->Tours->get_row($data_where);
    $data['post'] = $resultado;

    $url_servicio = base_url() . 'tour/' . $resultado['url_key'];
    $servicio = array(
      'nombre_servicio' => $resultado['nombre'],
      'descripcion_servicio' => $resultado['detalle'],
      'url_servicio' => $url_servicio,
      'itinerario' => $resultado['itinerarios']
      );

    $data['servicio'] = $servicio;
    $data['website'] = $this->Inicio->get_website();
    $cabeceras_email = $this->config->item('waemail');
    $cabeceras_email['titulo_email_admin'] = $servicio['nombre_servicio'];
    $data['cabeceras'] = $cabeceras_email;

  // render the view into HTML
    $data['titulo'] = $servicio['nombre_servicio'];

  //
    $file_name_pdf = $resultado['url_key'] . '.pdf';
    $html = $this->load->view('paginas/pdf/pdf_paquete', $data, true);
    /*die();*/

    $this->load->library('mimpdf');

    $pdf = $this->mimpdf->load();

  // Add a footer for good measure ;)
    $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date("d/m/Y H:i"));

  // write the HTML into the PDF
    $pdf->WriteHTML($html);

     //Formas de pago (página)
    if(!empty($resultado['formas_pago_id'])){
      $data_pagina = array('id' => $resultado['formas_pago_id']);
      $data['formas_pago'] = $this->Paginas->get_row($data_pagina);
      $html_formas_pago = $this->load->view('paginas/pdf/pdf_formas_pago', $data, true);
      $pdf->AddPage();
      $pdf->WriteHTML($html_formas_pago);
    }

  // save to file because we can
    $pdf->Output($file_name_pdf, 'D');

  }

/**
 * Hoteles
 */
public function hoteles($provincia_key=null, $categoria_key=null, $args=null) {
  $this->load->model("provincias_model","Provincias");
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

/**
 * Contáctenos
 */

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

            /*$config['useragent']           = "CodeIgniter";*/
            /*$config['protocol'] = 'sendmail';*/
            /*$config['protocol']            = "smtp";
            $config['smtp_host']           = "mail.tupaytravel.com";
            $config['smtp_port']           = "25";
            $config['mailpath'] = "/usr/bin/sendmail";*/
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';

            $this->email->initialize($config);

            $this->email->from('reservas@tupaytravel.com', utf8_decode('Reservas Tupay Travel'));
            $this->email->reply_to($post['email'], utf8_decode($post['nombres']));
            $this->email->to('tupaytravel@hotmail.com'); //Email destino (quién recibe el correo)
            $this->email->cc('juanjus98@gmail.com');
            //$this->email->bcc('them@their-example.com');

            $subject_str = utf8_decode('Nuevo contacto') . " " . utf8_decode($post['nombre']);
            $this->email->subject($subject_str);
            $this->email->message($email_admin);
            $this->email->send(); //Envia email al administrador
            /*echo $this->email->print_debugger();*/

            //ENVIAMOS EMAIL DE CONFIRMACIÓN
            $this->email->clear();
            $this->email->initialize($config);

            $this->email->from('reservas@tupaytravel.com', utf8_decode('Tupay Travel'));
            $this->email->to($post['email'], utf8_decode($post['nombre']));
            $this->email->subject(utf8_decode('Gracias por contáctarnos desde tupaytravel.com'));
            $this->email->message($email_user);
            $this->email->send();
            /*$this->email->print_debugger(array('headers'));*/

            redirect("contactenos?send=ack");
          }
        } //Post


      $this->template->build('paginas/contactanos', $data);
    }

/**
 * Prueba de email
 */
public function testemail() {

      //Enviar formulario


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

            /*$config['useragent']           = "CodeIgniter";*/
            $config['protocol']            = "smtp";
            $config['smtp_host']           = "tupaytravel.com";
            /*$config['smtp_user']           = "reservas";
            $config['smtp_pass']           = "Thenumber1!!!";*/
            $config['smtp_crypto']         = "ssl";
            $config['smtp_port']           = "465";

            /*$config['mailpath'] = "/usr/bin/sendmail";*/
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';

            /*$this->email->initialize($config);
            $this->email->from('reservas@tupaytravel.com', utf8_decode('Reservas Tupay Travel'));
            $this->email->reply_to($post['email'], utf8_decode($post['nombres']));
            $this->email->to('tupaytravel@hotmail.com'); //Email destino (quién recibe el correo)
            $this->email->cc('juanjus98@gmail.com');*/
            //$this->email->bcc('them@their-example.com');

            /*$subject_str = utf8_decode('Test Contactos') . " " . utf8_decode($post['nombre']);
            $this->email->subject($subject_str);
            $this->email->message($email_admin);
            $this->email->send();*/
            /*echo $this->email->print_debugger();*/

            //ENVIAMOS EMAIL DE CONFIRMACIÓN
            /*$this->email->clear();*/
            $this->email->initialize($config);

            $this->email->from('reservas@tupaytravel.com', utf8_decode('Tupay Travel'));
            $this->email->to("juanju98@hotmail.com", utf8_decode("Juan Julio SSL"));
            $this->email->subject(utf8_decode('Prueba ssl'));
            $this->email->message($email_user);
            $this->email->send();
            echo $this->email->print_debugger();
            die();

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
             'field' => 'telefono',
             'label' => 'telefono',
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
            $adultos = (!empty($post['adultos'])) ? strip_tags($post['adultos']) : 0 ;
            $adolecentes = (!empty($post['adolecentes'])) ? strip_tags($post['adolecentes']) : 0 ;
            $ninios = (!empty($post['ninios'])) ? strip_tags($post['ninios']) : 0 ;
            $infantes = (!empty($post['infantes'])) ? strip_tags($post['infantes']) : 0 ;

            $fecha_arribo = (!empty($post['fecha_arribo'])) ? strip_tags($post['fecha_arribo']) : '' ;

            $data_insert = array(
              "tipo_info" => strip_tags($post['tipo_info']),
              "id_info" => strip_tags($post['id_info']),
              "date_desde" => strip_tags($post['dateDesde']),
              "date_hasta" => strip_tags($post['dateHasta']),
              "pais_origen" => strip_tags($post['pais_origen']),
              "ciudad" => strip_tags($post['ciudad']),
              "fecha_arribo" => $fecha_arribo,
              "adultos" => $adultos,
              "adolecentes" => $adolecentes,
              "ninios" => $ninios,
              "infantes" => $infantes,
              "nombres" => strip_tags($post['nombres']),
              "telefono" => strip_tags($post['telefono']),
              "celular" => strip_tags($post['celular']),
              "email" => strip_tags($post['email']),
              "mensaje" => strip_tags($post['mensaje']),
              "agregar" => date("Y-m-d H:i:s")
              );

            $this->db->insert('reservas', $data_insert);
            $reservas_id = $this->db->insert_id();

            //Templates Email
            $data_email['post'] = $data_insert;

            //Otros datos para el email
            $data_email['website'] = $this->Inicio->get_website();

            $thank_key = $post['tipo_info'];
            
            if($post['tipo_info'] == 'P'){
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

              $titulo_email_admin = 'Solicitud de reserva - Paquete';

              $url_key_th = $paquete['url_key'];
            }

            if($post['tipo_info'] == 'T'){
              //Consultar Tour
              $data_tour = array('id' => $post['id_info']);
              $tour = $this->Tours->get_row($data_tour);

              $url_servicio = base_url() . 'tour/' . $tour['url_key'];
              $servicio = array(
                'nombre_servicio' => $tour['nombre'],
                'descripcion_servicio' => $tour['detalle'],
                'url_servicio' => $url_servicio,
                'itinerario' => $tour['itinerarios']
                );

              $data_email['servicio'] = $servicio;
              $titulo_email_admin = 'Solicitud de reserva - Tour';
              $url_key_th = $tour['url_key'];
            }

            $thank_key = $post['tipo_info'] . '-' . $url_key_th;

            $cabeceras_email = $this->config->item('waemail');
            $cabeceras_email['titulo_email_admin'] = $titulo_email_admin;
            $data_email['cabeceras'] = $cabeceras_email;
            
            //Template user email
            $email_user = $this->load->view('paginas/email/tp_reservar_user', $data_email, TRUE);

            //Template admin admin
            $email_admin = $this->load->view('paginas/email/tp_reservar', $data_email, TRUE);

            //Enviar email
            $this->load->library('email');

            /*$config['useragent']           = "CodeIgniter";*/
            /*$config['protocol'] = 'sendmail';*/
            /*$config['protocol']            = "smtp";
            $config['smtp_host']           = "mail.tupaytravel.com";
            $config['smtp_port']           = "25";
            $config['mailpath'] = "/usr/bin/sendmail";*/
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';

            $this->email->initialize($config);

            $this->email->from('reservas@tupaytravel.com', utf8_decode('Reservas Tupay Travel'));
            $this->email->reply_to($post['email'], utf8_decode($post['nombres']));
            $this->email->to('tupaytravel@hotmail.com'); //Email destino (quién recibe el correo)
            $this->email->cc('juanjus98@gmail.com');
            //$this->email->bcc('them@their-example.com');

            $subject_admin = utf8_decode($titulo_email_admin) . utf8_decode(' - ' . $post['nombres']);
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

            /*print_r($this->email->print_debugger());*/

            /*$redirect = $url_servicio . '?ack=success';*/
            $redirect = base_url('gracias/' . $thank_key);
            
            redirect($redirect);
          }
        } //Post


        $this->template->build('paginas/contactanos', $data);
  }

  public function gracias($args){
    $data['active_link'] = "inicio";
    $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($data['website']); //siempre

    $this->template->title('Confirmación');
    $this->template->build('paginas/gracias', $data);
  }

  //Mensaje de confirmación
  public function confirmacion($token='') {
    $data['active_link'] = "inicio";
    $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($data['website']); //siempre

    $this->template->title('Confirmación');
    $this->template->build('paginas/confirmacion', $data);
  }

  /**
   * Pagina
   */
  public function pagina($url_key) {
    //Consultar tour
    $data_where = array('url_key' => $url_key);
    $result = $this->Paginas->get_row($data_where);
    $data['pagina'] = $result;

    $data['active_link'] = "pagina";
    $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($result, 'pagina'); //siempre


    $this->template->title('Página');
    $this->template->build('paginas/pagina', $data);
  }

/**
 * Reservar
 */
public function testcorreo(){

    $this->load->library('email');
    
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'mail.tupaytravel.com';
    $config['smtp_user'] = 'reservas@tupaytravel.com';
    $config['smtp_pass'] = 'Thenummber1!!!';
    $config['smtp_port'] = '587';
    /*$config['smtp_crypto'] = '587';*/
    
    /*$config['mailpath'] = '/usr/sbin/sendmail';*/
    /*$config['charset'] = 'iso-8859-1';*/
/*    $config['charset']    = 'utf-8';*/
    /*$config['wordwrap'] = TRUE;*/
    $config['mailtype'] = 'html';
    $config['newline']    = "\r\n";
    $config['crlf']    = "\r\n";


    $this->email->initialize($config);

    $this->email->from("reservas@tupaytravel.com", "bcperutravel Test");
    $this->email->to('juanjus98@gmail.com', 'Solicitud - Paquete turistico');
    /*$this->email->to('juanjus98@gmail.com', 'Solicitud - Paquete turistico');*/
    $this->email->subject('PRUEBA DE CORREO V2');
    $this->email->message('<h1>PRUEBA ENVIADO POR JUAN JULIO</h1>');
    if ($this->email->send()) {
      $msg = 'ENVIADO!!';
    }
    else {
      $msg = 'NO ENVIADO';
    }

    echo "<br>";

    print_r($this->email->print_debugger());

    echo $msg;
  }

public function fotos() {
    /*$this->template->set_layout('website.php');*/
    $this->load->model("galerias_model","Galerias");
    $this->load->model("galeria_fotos_model","Fotos");
    $data['active_link'] = "fotos";

    $data['website'] = $this->Inicio->get_website();
    $data['head_info'] = head_info($data['website']); //siempre

    //Tours
    $data_galerias = array('ordenar_por' => 't1.orden', 'ordentipo' => 'ASC');
    $total_galerias = $this->Galerias->total_registros($data_galerias);
    $data['galerias'] = $this->Galerias->listado($total_galerias,0,$data_galerias);

    $this->load->view('paginas/fotos',$data);
}


}

/* End of file paginas.php */
/* Location: ./application/controllers/waadmin/paginas.php */