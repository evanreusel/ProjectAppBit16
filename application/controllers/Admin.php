<?php
/*
    GREIF MATTHIAS 
	LAST UPDATED: 18 03 30
	ADMIN CONTROLLER
*/

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
	
	// VIEWS
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

	public function dash($view = null, $extras = null){
		// Load models
		$this->load->model('beheer_model');

		// Load logged in user
		$data['user'] = $this->beheer_model->get_byId($this->session->userdata('id'));

		// Check if dashboard view is requested else default homeview
		if(is_null($view) )
		{
			$view = 'index';
		}

		// Load view
		$data['message'] = 'Hello there ' . $data['user']->username . ' | Dash';// Title
		$data['css_files'] = array("dash.css");									// Default dash style

		$data['primaryColor'] = 'deep-purple';									// Primary color (purple for admin, blue for others??)
		$data['currentview'] = $view;											// Current view indicator (for navbar indicator??)
		$data['homelink'] = base_url() . 'index.php/admin/dash/';				// Dash homepage
		$data['links'] = [														// Available links for navbar
			[
				'title' => 'Jaargang',
				'url' => base_url() . 'index.php/admin/dash/jaargangbeheer/'
			],
			[
				'title' => 'Locaties',
				'url' => base_url() . 'index.php/admin/dash/plaatsToevoegen/'
			]
		];
		$data['actions'] = [
			[
				'title' => 'Administrators beheren',
				'url' => base_url() . 'index.php/admin/dash/adminbeheer/'
			],
			[
				'title' => 'Log out',
				'url' => base_url() . 'index.php/admin/logout/'
			]
		];

		// Get data for view
		switch($view){
			case "adminbeheer":													// Admin screen
				$data['data']['admins'] = $this->beheer_model->getAll();		// Get admin details
			break;
			case "adminupdate":													// Admin add/update screen
				if($extras != null) {											// Get admin details in case of udpate
					$data['data']['admin'] = $this->beheer_model->get_byId($extras);
				}
			break;
			case "keuzemogelijkheidbeheer":										// Keuzemogelijkheid screen for jaargang
				if($extras != null) {											
					$this->load->model('jaargang_model');
					$data['data'] = $this->jaargang_model->getWithKeuzemogelijkheidWithOpties_byId($extras);
				}else{															// Can't load page without jaargang id => load indexpage
					$view = 'index';
				}
			break;

			// =================================================================================================== TIM SWERTS
			case "updatekeuzemogelijkheid":
				//jaren inladen voor dropdown list
				$this->load->model('jaargang_model');
				$data['jaargangen'] = $this->jaargang_model->getAllByJaargang();

				//plaatsen inladen voor dropdown list
				$this->load->model('plaats_model');
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();

				if($extras != null) {
					$this->load->model('keuzemogelijkheid_model');
					$data['data']['keuzemogelijkheden'] = $this->keuzemogelijkheid_model->get_byId($extras);
				}
			break;
			case "updatekeuzeoptie":

				//plaatsen inladen voor dropdown list
				$this->load->model('plaats_model');
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();

				if($extras != null) {
					$this->load->model('keuzeoptie_model');
					$data['data']['keuzeoptie'] = $this->keuzeoptie_model->get_byId($extras);
				}
			break;
			// =================================================================================================== /TIM SWERTS
			case 'jaargangbeheer';
				$this->load->model('jaargang_model');
				$data['data']['jaargangen'] = $this->jaargang_model->getAllbyBeginTijdstip();
			break;
			// =================================================================================================== DAAN
			case "plaatsToevoegen":
			$this->load->model('plaats_model');
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();
			break;
			// =================================================================================================== /DAAN
			case 'jaargangupdate':
				if($extras != null) {
					$this->load->model('jaargang_model');
					$data['data']['jaargang'] = $this->jaargang_model->get_byId($extras);
				}
			break;
			default:
				$view = 'index';
			break;
		}

		// Set view
		$data['view'] = 'dash_admin_' . $view;

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

	// =================================================================================================== TIM
	public function checkpass($id = null, $pass = null)
	{
		$data['return'] = '';
		
		// Check login vals
		if(!is_null($id) && !is_null($pass)){
			// Get data from db
			$this->load->model('beheer_model');
			$return = $this->beheer_model->login_byId($id, $pass);

			// Return data
			$data['return'] = json_encode($return);
		}
		
		// Print in default api output view
		$this->load->view('req_output', $data);
	}
	// =================================================================================================== /TIM

	// FLOW
	// Logout admin
	public function logout(){
		$this->session->unset_userdata('id');

		// Redirect to adminbeheer
		redirect('admin/');
	}

	// Update admin
	public function update()
	{
		// Setup Admin class
        $admin = new stdClass();

        $admin->id = $this->input->post('id', TRUE);
        $admin->username = $this->input->post('username', TRUE);
        $admin->pass =  password_hash($this->input->post('nieuwpass', TRUE), PASSWORD_DEFAULT);

		// Check data
        $this->load->model('beheer_model');
		
		// Add admin or update
        if($admin->id == 0){
       		$this->beheer_model->add($admin);
        } else {
        	$this->beheer_model->update($admin);
        }

		// Redirect to adminbeheer
		redirect('admin/dash/adminbeheer');
	}

	// Delete admin
    public function delete()
	{
		$id = $this->input->post('id', TRUE);

		// Delete
        $this->load->model('beheer_model');
        $this->beheer_model->delete($id);
		
		// Redirect to adminbeheer
		redirect('admin/dash/adminbeheer');
	}

	// =================================================================================================== TIM
	public function excel(){
	/*$spreadsheet = new Spreadsheet();
   $sheet = $spreadsheet->getActiveSheet();
   $sheet->setCellValue('A1', 'Hello World !');

   $writer = new Xlsx($spreadsheet);
   $writer->save('hello world.xlsx');*/
	}
	// =================================================================================================== /TIM
}

?>