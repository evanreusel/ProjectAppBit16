<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// Autoload
		$this->load->library('session');

		// Check location is home of admin controller
		$is_home = ($this->router->class === 'person' && $this->router->method === 'index') ? true : false;

		// Homepage check
		// if(!$is_home){
		// 	// Redirect to default page if no session set
		// 	if(!$this->session->has_userdata('id')){
		// 		redirect('/main/index', 'location');
		// 	}
		// }
	}
	
	// DEFAULT
	public function index($id = null, $token = null)
	{
		// Check login vals
		if(!is_null($id) && !is_null($token)){
			// Get data from db
			$this->load->model('persoon_model');
			$login_return = $this->persoon_model->login($id, $token);

			// Set session vars if succeeded
			if($login_return != ''){
                $this->session->set_userdata('id', $login_return->id);
                $this->session->set_userdata('role', $login_return->soort);

                // redirect('/' . strtolower($login_return->soort) . '/index', 'location');
				$data['return'] = json_encode($login_return);
			}
			
			// Print in default api output view
			$this->load->view('req_output', $data);
        }

        // Redir to default page
        // redirect('/main/index', 'location');
	}
}