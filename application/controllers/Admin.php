<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// Autoload
		$this->load->library('session');

		// Check location is home of admin controller
		$is_home = ($this->router->class === 'admin' && $this->router->method === 'index') ? true : false;

		// Homepage check
		if(!$is_home){
			// Redirect to login if no session started
			if(!$this->session->has_userdata('id')){
				redirect('/admin/index', 'location');
			}
		}
	}
	
	// DEFAULT
	public function index()
	{
		// Load default login view
		$data['message'] = "Welcome admin | Login";
	    $data['view'] = 'login';
		$data['css_files'] = array("login.css");
		$data['clearscreen'] = true;
		$this->load->view('template/main', $data);
	}

	// API
	// LOGIN
	public function login($username = null, $pass = null){
		$data['return'] = '';
		
		// Check login vals
		if(!is_null($username) && !is_null($pass)){
			// Get data from db
			$this->load->model('beheer_model');
			$login_return = $this->beheer_model->login($username, $pass);

			// Set session vars if succeeded
			if($login_return != ''){
				$this->session->set_userdata('id', $login_return->id);
			}

			// Return data
			$data['return'] = json_encode($login_return);
		}
		
		// Print in default api output view
		$this->load->view('req_output', $data);
	}
}