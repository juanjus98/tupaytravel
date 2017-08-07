<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Image Upload
 *
 * Carga y procesa una imágen
 *
 * @package     Imaupload
 * @subpackage      Libraries
 * @category        Libraries
 * @author      Juan Julio Sandoval Layza
 */
class Imaupload {

    var $ci;

    /**
     * Constructor - Sets Preferences
     *
     * The constructor can be passed an array of config values
     */
    function __construct() {
        $this->ci = & get_instance();
        $this->ci->config->load('auth', TRUE);
        $this->ci->load->library("upload");

        log_message('debug', 'Imaupload Class Initialized');
    }

    // --------------------------------------------------------------------

    /**
     * Upload
     *
     * @access  public
     * @param   array
     * @return  void
     */
    function do_upload($upload_path, $file_name) {
        $config_upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . $upload_path;
        $config_upload['allowed_types']        = 'gif|jpg|png';
        $config_upload['max_size']             = 3000;
        /*$config_upload['max_width']            = 1024;
        $config_upload['max_height']           = 1024;*/
        $config_upload['file_name'] = $this->new_filename($file_name);

        $this->ci->upload->initialize($config_upload);
        if (!$this->ci->upload->do_upload($file_name)) {
            $data = array('error' => $this->ci->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->ci->upload->data());
        }

        return $data;
    }

    // --------------------------------------------------------------------

    /**
     * Nuevo nombre del archivo
     *
     * @access  public
     */
    function new_filename($file_name) {
        $file_name = $_FILES[$file_name]['name'];
        $fileExt = substr(strrchr($file_name, "."), 1);
        $file_name = explode(".", $file_name);
        $file_name = $file_name[0];

        $file_name = str_replace(array('[\', \']'), '', $file_name);
        $file_name = preg_replace('/\[.*\]/U', '', $file_name);
        $file_name = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $file_name);
        $file_name = htmlentities($file_name, ENT_COMPAT, 'utf-8');
        $file_name = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $file_name);
        $file_name = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $file_name);

        $file_name .= "_" . time() . "." . $fileExt;

        return strtolower(trim($file_name, '-'));
    }

}

// END Template class