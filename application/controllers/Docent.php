<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docent extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// Autoload
		$this->load->library('session');

		// Redirect to mainscreen if no session started
		if(!$this->session->has_userdata('id')){
			redirect('/main/index', 'location');
		}
	}
	
	// DEFAULT
	public function index()
	{
		// Load dash view
		$data['message'] = "Welcome Docent";
	    $data['view'] = 'dash_docent';
		$data['css_files'] = array("dash_docent.css");
		$this->load->view('template/main', $data);
	}
}