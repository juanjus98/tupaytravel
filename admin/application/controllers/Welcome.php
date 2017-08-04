<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function demo(){
		// Set the title
		$this->template->title = 'Welcome!';
		
        // Dynamically add a css stylesheet
		$this->template->stylesheet->add('//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
		
        // Load a view in the content partial
		$this->template->content->view('hero', array('title' => 'Hello, world!'));

        $news = array(); // load from model (but using a dummy array here)
        $this->template->content->view('news', $news);
        
        // Set a partial's content
        $this->template->footer = 'Made with Twitter Bootstrap';
        
        // Publish the template
        $this->template->publish();
    }

    public function upload(){
    	if($this->input->post()){
    		$config['upload_path']          = './images/';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 1000;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 1024;

	        $this->load->library('upload', $config);

	        /*echo "<pre>";
	        print_r($config);
	        echo "</pre>";

	        die();*/

	        if ( ! $this->upload->do_upload('userfile')){
	            $upload_info = array('error' => $this->upload->display_errors());
	        }
	        else{
	            $upload_info = array('upload_data' => $this->upload->data());
	        }

	        /*$upload_data = $upload_info['upload_data'];*/

	        echo "<pre>";
	        print_r($upload_info);
	        echo "</pre>";

		}


    	$this->load->view('upload_form', array('error' => ' ' ));
    }

}
