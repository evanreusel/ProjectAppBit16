<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		//check if loged in
		if(!$this->session->has_userdata('id')){
			redirect('/admin/index', 'location');
		}
	}
		
	public function index()
	{
		$data['message'] = "Welcome admin | Login";
	    $data['view'] = 'login';
		$data['css_files'] = array("login.css");
		$data['clearscreen'] = true;
		$this->load->view('template/main', $data);
	}

	public function login($username = null, $pass = null){
		$data['return'] = '';
		
		if(!is_null($username) && !is_null($pass)){
			$this->load->model('beheer_model');
			$login_return = $this->beheer_model->login($username, $pass);

			if($login_return != ''){
				$this->session->set_userdata('id', $login_return->id);
			}
			$data['return'] = json_encode($login_return);
		}
		
		$this->load->view('req_output', $data);
	}
}
