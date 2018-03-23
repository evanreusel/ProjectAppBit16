<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ADMIN CONTROLLER
// - LOGIN
// - DASH


class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// Autoload
		$this->load->library('session');
		$this->load->helper('form');

		// Check location is home of admin controller or api request page
		$is_home = ($this->router->class === 'admin' && $this->router->method === 'index') ? true : false;
		$is_api_login = ($this->router->class === 'admin' && $this->router->method === 'login') ? true : false;

		// Homepage check
		if(!$is_home && !$is_api_login){
			// Redirect to home if no session started
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
	public function login($username = null, $pass = null)
	{
		$data['return'] = '';
		
		// Check login vals
		if(!is_null($username) && !is_null($pass)){
			// Get data from db
			$this->load->model('beheer_model');
			$login_return = $this->beheer_model->login($username, $pass);

			// Set session vars if succeeded
			if($login_return != ''){
				$this->session->set_userdata('id', $login_return->id);
				$this->session->set_userdata('role', 'admin');
			}

			// Return data
			$data['return'] = json_encode($login_return);
		}
		
		// Print in default api output view
		$this->load->view('req_output', $data);
	}

	public function dash($view = null, $extras = null){
		if(is_null($view) )
		{
			$view = 'home';
		}

		// Load view
		$data['message'] = "Welcome admin | Dash";
	    $data['view'] = 'dash_admin_' . $view;
		$data['css_files'] = array("dash.css");
		$data['primaryColor'] = 'orange';
		$data['currentview'] = $view;
		$data['links'] = [
			[
				'title' => 'Dash',
				'url' => base_url() . 'index.php/admin/dash/'
			],
			[
				'title' => 'Admin beheren',
				'url' => base_url() . 'index.php/admin/dash/adminbeheer/'
			]
		];

		//get data for view
		switch($view){
			case "adminbeheer":
				$data['data']['admins'] = $this->adminbeheer();
			break;
			case "updateadmin":
				if($extras != null) {
					$data['data']['admin'] = $this->updateadmin($extras);
				}
			break;
		}

		$this->load->view('template/main', $data);
	}

	private function adminbeheer(){
		$this->load->model('beheer_model');
		return $this->beheer_model->getAll();
	}

public function updateadmin($id){
	if($id != null){
		$this->load->model('beheer_model');
		return $this->beheer_model->get_byId($id);
	}

	return null;
}

	public function update()
	{
        $admin = new stdClass();

        $admin->id = $this->input->post('id');
        $admin->username = $this->input->post('username');
        $admin->pass =  password_hash($this->input->post('nieuwpass'), PASSWORD_DEFAULT);

        $this->load->model('beheer_model');
        
        if($admin->id == 0){
        $this->beheer_model->add($admin);
        } else {
        $this->beheer_model->update($admin);
        }

		redirect('admin/dash/adminbeheer');
	}

     public function delete($id)
	{
        $this->load->model('beheer_model');
        $this->beheer_model->delete($id);
		
		redirect('admin/dash/adminbeheer');
	}

    public function json_checkpass(){
        $id = $_POST['id']; 
		$oudpass = $_POST['oudpass'];
        
        $this->load->model('beheer_model');
		$admin = $this->beheer_model->get_byId($id);
		
		echo json_encode(password_verify($oudpass, $admin->pass));
    }
}

?>