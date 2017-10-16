<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Paquetes extends CI_Controller {
  public $website_info;

  function __construct() {
    parent::__construct();
    $this->template->set_layout('website_main.php');

    $this->load->model('inicio_model', 'Inicio');
    $this->load->model('paginas_model', 'Paginas');

    //$this->load->model('productos_model', 'Productos');
    $this->load->model("crud_model","Crud");

    $this->load->model("paquetes_model","Paquetes");
    /*$this->load->model("tours_model","Tours");*/
    /*$this->load->model("hoteles_model","Hoteles");*/
    $this->load->model("paquetes_galeria_model","Paquetes_galeria");
    /*$this->load->model("tours_itinerario_model","Tours_itinerario");*/
    /*$this->load->model("hoteles_galeria_model","Hoteles_galeria");*/
    $this->load->model("promociones_model","Promociones");

    /**
     * Información del website
     */
    $this->website_info = $this->Inicio->get_website();
    /*echo "<pre>";
    print_r($this->website_info);
    echo "</pre>";*/
  }

  
  public function index($args=null) {
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

    $data_paquetes['publicar'] = 1;

    //publicar

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

}

/* End of file paginas.php */
/* Location: ./application/controllers/waadmin/paginas.php */