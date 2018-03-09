<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// Autoload
		$this->load->library('session');

		// Check location is home of admin controller
		$is_home = ($this->router->class === 'student' && $this->router->method === 'index') ? true : false;

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
		$data['message'] = "Welcome Student";
	    $data['view'] = 'dash_student';
		$data['css_files'] = array("login.css");
		$this->load->view('template/main', $data);
	}
}