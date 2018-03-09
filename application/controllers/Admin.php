<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
		
	public function index()
	{
		$data['message'] = "hello";
	    $data['view'] = 'login';
	    $data['css_files'] = array("home.css");
		$this->load->view('template/main', $data);
	}

	public function login($username = null, $pass = null){
		$data['return'] = '';
		
		if(!is_null($username) && !is_null($pass)){
			$this->load->model('beheer_model');
			$data['return'] = json_encode($this->beheer_model->login($username, $pass));
		}
		
		$this->load->view('req_output', $data);
	}
}
