<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
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
		$data['message'] = "Welcome Student";
	    $data['view'] = 'dash_student';
		$data['css_files'] = array("dash_student.css");
		$this->load->view('template/main', $data);
	}
}