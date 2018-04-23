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
				'url' => base_url() . 'index.php/admin/dash/jaargangoverzicht/'
			],
			[
				'title' => 'Locaties',
				'url' => base_url() . 'index.php/admin/dash/plaatsToevoegen/'
			],
			[
				'title' => 'Deelnemers',
				'url' => base_url() . 'index.php/admin/dash/deelnemersoverzicht/'
			],
			[
				'title' => 'Vrijwilligers',
				'url' => base_url() . 'index.php/admin/dash/vrijwilligersoverzicht/'
			]
		];
		$data['actions'] = [
			[
				'title' => 'Administrators beheren',
				'url' => base_url() . 'index.php/admin/dash/adminbeheer/'
			],
			[
				'title' => 'Personeelslijst importeren',
				'url' => base_url() . 'index.php/admin/dash/personeelimporteren'
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
					$data['jaargang']=$this->jaargang_model->get_byId($extras);
				}else{															// Can't load page without jaargang id => load indexpage
					$view = 'index';
				}
			break;
			case 'jaargangoverzicht':
				$this->load->model('jaargang_model');
				$data['data']['jaargangen'] = $this->jaargang_model->getAllbyBeginTijdstip();
			break;
			case 'jaargangbeheer':
				if($extras != null) {
					$this->load->model('jaargang_model');
					$data['data']['jaargang'] = $this->jaargang_model->get_byId($extras);
				}

				// Return to jaargangoverzicht if no jaargang found
				if(!isset($data['data']['jaargang']) || $data['data']['jaargang'] == null){
					redirect('admin/dash/jaargangoverzicht');
				}
			break;

			// =================================================================================================== TIM SWERTS
			case "updatekeuzemogelijkheid":

				//plaatsen inladen voor dropdown list
				$this->load->model('plaats_model');
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();

				$this->load->model('keuzemogelijkheid_model');
				$data['keuzemogelijkheid'] = $this->keuzemogelijkheid_model->get_byId($extras);
			
			break;
			case "keuzemogelijkheidToevoegen":
				//jaren inladen voor dropdown list
				$this->load->model('jaargang_model');
				$data['jaargang'] = $this->jaargang_model->get_byId($extras);

				//plaatsen inladen voor dropdown list
				$this->load->model('plaats_model');
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();
			break;
			case "updatekeuzeoptie":

				//plaatsen inladen voor dropdown list
				$this->load->model('plaats_model');
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();

				if($extras != null) {
					if(strpos($extras,"i")==0){
						$this->load->model('keuzemogelijkheid_model');
						$data['keuzemogelijkheid'] = $this->keuzemogelijkheid_model->get_byId(str_replace("i", "", $extras));
						$data['keuzeoptieId'] = null;
						$data['kaas']=strpos($extras,"i");
					}
					if(strpos($extras,"u")==0){
						$data['keuzeoptieId'] = str_replace("u", "", $extras);
						$data['jaargang'] = null;

						$this->load->model('keuzeoptie_model');
						$data['keuzeoptie'] = $this->keuzeoptie_model->get_byId($extras);
						$data['kaas']=3;
					}
					// $this->load->model('keuzeoptie_model');
					// $data['data']['keuzeoptie'] = $this->keuzeoptie_model->get_byId($extras);
				}
			break;
			// =================================================================================================== /TIM SWERTS
			// =================================================================================================== DAAN
			case "plaatsToevoegen":
			$this->load->model('plaats_model');
			if(isset($extras)){
				$plaats = new stdClass();
		
				$plaats = $this->plaats_model->getPlaatsById($extras);
				$data["huidigeplaats"] = $plaats;
			}
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();
			break;
			// =================================================================================================== /DAAN
			case 'jaargangupdate':
				if($extras != null) {
					$this->load->model('jaargang_model');
					$data['data']['jaargang'] = $this->jaargang_model->get_byId($extras);
				}
			break;

			case 'personeelimporteren':
			break;

			case 'deelnemersoverzicht':
			$this->load->model('Persoon_model');
        	$data["deelnemers"] = $this->Persoon_model->getallwithactiviteit();
			break;

			case 'vrijwilligersoverzicht':
			$this->load->model('Persoon_model');
        	$data["vrijwilligers"] = $this->Persoon_model->getallwithshift();
			break;

			case 'importsuccess':
			$this->load->model('CSV_model');
        	$soort = $this->input->post('soort', TRUE);
        	$personen = $this->CSV_model->readpersonen($soort);
			$data["personen"] = $personen;
			break;

			default:
				$view = 'index';
			$this->load->model('Persoon_model');
        	$data["deelnemers"] = $this->Persoon_model->getallwithactiviteit();
			$this->load->view('dash_admin_personeelsoverzicht.php',$data);
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
    public function delete($id)
	{
		// Delete
        $this->load->model('beheer_model');
        $this->beheer_model->delete($id);
		
		// Redirect to adminbeheer
		redirect('admin/dash/adminbeheer');
	}

	public function excel(){		
		$this->dash("importsuccess");
	}

	public function list(){
			$this->load->model('Persoon_model');
        	$data["deelnemers"] = $this->Persoon_model->getallwithactiviteit();
		$this->load->view('dash_admin_personeelsoverzicht.php',$data);

	}
	// =================================================================================================== TIM
}

?>