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

	public function login(){
		// $mail = $this->input->post('mail');
		// $pass = $this->input->post('pass');

		$this->load->model('models/Beheer_model');
		$data['return'] = $this->beheer_model->login($mail, $pass);
		
		$this->load->view('req_output', $data);
	}
}
