<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper('html');
	}
		
	public function index()
	{
		$this->load->view('login');
	}

	public function login(){
		$mail = $this->input->post('mail');
		$pass = $this->input->post('pass');

		$this->load->model('Beheer_model');
		$data['return'] = $this->Beheer_model->login($mail, $pass);
		
		$this->load->view('req_output', $data);
	}
}
