<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docent extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// Autoload
		$this->load->library('session');

		// Check location is home of admin controller
		$is_home = ($this->router->class === 'docent' && $this->router->method === 'index') ? true : false;

		// Homepage check
		if(!$is_home){
			// Redirect to home if no session started
			if(!$this->session->has_userdata('id')){
				redirect('/main/index', 'location');
			}
		}
	}
	
	// DEFAULT
	public function index()
	{
		// Load default login view
		$data['message'] = "Welcome Docent";
	    $data['view'] = 'dash_docent';
		$data['css_files'] = array("login.css");
		$this->load->view('template/main', $data);
	}
}