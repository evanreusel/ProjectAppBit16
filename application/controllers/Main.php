<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	// Default page
	public function index()
	{
	    $data['message'] = "Hi there";
	    $data['view'] = 'home';
		$data['css_files'] = array("home.css");
		$data['clearscreen'] = true;
		
		$this->load->view('template/main', $data);
	}

	// Mail signin entrypoint
	public function signin($id = null, $token = null)
	{
		// Check login vals
		if(!is_null($id) && !is_null($token)){
			// Get data from db
			$this->load->model('persoon_model');
			$login_return = $this->persoon_model->get_byId($id, $token);

			// Set session vars if succeeded
			if($login_return != ''){
                $this->session->set_userdata('id', $login_return->id);
                $this->session->set_userdata('role', $login_return->soort);

				// Redir to specific controller
                redirect('/' . strtolower($login_return->soort) . '/index', 'location');
			}
        }

        // Redir to default page
        redirect('/main/index', 'location');
	}
}
