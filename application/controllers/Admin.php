<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
		
	public function index()
	{
		$this->load->view('login');
	}

	public function login($username, $pass){
		$this->load->model('beheer_model');
		$data['return'] = json_encode($this->beheer_model->login($username, $pass));
		
		$this->load->view('req_output', $data);
	}
}
