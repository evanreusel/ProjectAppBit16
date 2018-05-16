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

/// Controller voor administratorfunctionaliteiten
class Admin extends CI_Controller {
	/**
	 * Default Constructor
 	*/
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
			$this->load->model('beheer_model');
			// Redirect to home if no session started
			if(!$this->session->has_userdata('id') || $this->beheer_model->get_byId($this->session->userdata('id')) == null){
				redirect('/admin/index', 'location');
			}
		}
	}
	
	// VIEWS
	// DEFAULT
	/**
	 * Laad loginscherm voor administrator
 	*/
	public function index()
	{
		// Load default login view
		$data['creator'] = "GREIF MATTHIAS";
		$data['message'] = "Welcome admin | Login";
	    $data['view'] = 'login';
		$data['css_files'] = array("login.css");
		$data['clearscreen'] = true;

		$this->load->view('template/main', $data);
	}

	/**
	 * Container voor alle dashbord schermen van administrator
	 * @param string $view
	 *  Scherm dat opgeroepen word in het dashbord van administrator
	 * @param string $extras
	 *  Optionele parameters
 	*/
	public function dash($view = null, $extras = null){
		// Load models
		$this->load->model('beheer_model');

		// Load logged in user
		$data['user'] = $this->beheer_model->get_byId($this->session->userdata('id'));

		// Check if dashboard view is requested else default view
		if(is_null($view) )
		{
			$view = 'jaargangoverzicht';
		}

		// Load view
		$data['message'] = 'Hello there ' . $data['user']->username . ' | Dash';// Title
		$data['css_files'] = array("dash.css");									// Default dash style

		$data['primaryColor'] = 'deep-purple';									// Primary color (purple for admin, blue for others??)
		$data['currentview'] = $view;											// Current view indicator (for navbar indicator??)
		$data['homelink'] = base_url() . 'index.php/admin/dash/';				// Dash homepage
		$data['links'] = [														// Available links for navbar
			[
			'title' => 'Editiebeheer',
				'url' => base_url() . 'index.php/admin/dash/jaargangoverzicht/',
				'hulp' => "Beheer het huidige jaargang en bekijk informatie over de vorige jaargangen"
			],
			[
				'title' => 'Locaties',
				'url' => base_url() . 'index.php/admin/dash/plaatsToevoegen/',
				'hulp' => "Voeg nieuwe plaatsen toe of pas bestaande plaatsen aan"
			],
			[
				'title' => 'Mails',
				'url' => base_url() . 'index.php/admin/dash/mail_overzicht/'
			]
		];
		$data['actions'] = [
			[
				'title' => 'Administrators beheren',
				'url' => base_url() . 'index.php/admin/dash/adminbeheer/',
				'hulp' => "Maak nieuwe admins aan, verwijder of bewerk oude admins"
			],
			[
				'title' => 'Log out',
				'url' => base_url() . 'index.php/admin/logout/',
				'hulp' => "Log uit"
			]
		];

		// Get data for view
		switch($view){
			case "adminbeheer":													// Admin screen
				$data['creator'] = "GREIF MATTHIAS";
				$data['data']['admins'] = $this->beheer_model->getAll();		// Get admin details
			break;
			case "adminupdate":													// Admin add/update screen
				$data['creator'] = "GREIF MATTHIAS";
				if($extras != null) {											// Get admin details in case of udpate
					$data['data']['admin'] = $this->beheer_model->get_byId($extras);
				}
			break;

			case "personeelsinschrijvingen":
				$data['creator'] = "";
				if($extras != null) {											
					$this->load->model('jaargang_model');
					$data['data'] = $this->jaargang_model->getWithKeuzemogelijkheidWithOpties_byId($extras);
					$data['jaargang']=$this->jaargang_model->get_byId($extras);
				}else{															// Can't load page without jaargang id => load indexpage
					$view = 'index';
				}

			break;
			case 'jaargangoverzicht':
				$data['creator'] = "GREIF MATTHIAS";
				$this->load->model('jaargang_model');
				$data['data']['jaargangen'] = $this->jaargang_model->getAllbyBeginTijdstip();
			break;
			case 'jaargangbeheer':
				$data['creator'] = "GREIF MATTHIAS";

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
			/// Doorverwijzen naar de pagina waarop keuzemogelijkheden worden aangepast.
			case "updatekeuzemogelijkheid":
				$data['creator'] = "TIM SWERTS";
				///plaatsen inladen voor dropdown list
				$this->load->model('plaats_model');
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();

				$this->load->model('keuzemogelijkheid_model');
				$data['keuzemogelijkheid'] = $this->keuzemogelijkheid_model->get_byId($extras);
			
			break;
			/// Doorverwijzen naar de pagina waarop keuzemogelijkheden worden aangemaakt.
			case "keuzemogelijkheidToevoegen":
				$data['creator'] = "TIM SWERTS";
				///jaren inladen voor dropdown list
				$this->load->model('jaargang_model');
				$data['jaargang'] = $this->jaargang_model->get_byId($extras);

				///plaatsen inladen voor dropdown list
				$this->load->model('plaats_model');
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();
			break;
			/// Doorverwijzen naar de pagina waarop keuzeopties worden aangemaakt en aangepast.
			case "updatekeuzeoptie":
				$data['creator'] = "TIM SWERTS";
				///plaatsen inladen voor dropdown list
				$this->load->model('plaats_model');
				$data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();
				/// kiezen of we een keuzeoptie moeten aanmaken of aanpassen en daarna alle gegevens ophalen.
				if($extras != null) {
					///Aanmaken van een keuzeoptie
					if(strpos($extras,"i")!==false){
						$this->load->model('keuzemogelijkheid_model');
						$data['keuzemogelijkheid'] = $this->keuzemogelijkheid_model->get_byId(str_replace("i", "", $extras));
						$data['token']=true;
					}
					/// Aanpassen van een keuzeoptie
					if(strpos($extras,"u")!==false){
						$this->load->model('keuzeoptie_model');
						$data['keuzeoptie'] = $this->keuzeoptie_model->get_byId($extras);
						$this->load->model('keuzemogelijkheid_model');
						$data['keuzemogelijkheid'] = $this->keuzemogelijkheid_model->get_byId($data['keuzeoptie']->keuzemogelijkheidId);
						$data['token']=false;

					}
				}
			break;
			/// Weergeven van alle keuzemogelijkheden voor een bepaald jaargang.
			case "keuzemogelijkheidbeheer":
				$data['creator'] = "TIM SWERTS";
				if($extras != null) {											
					$this->load->model('jaargang_model');
					$data['data'] = $this->jaargang_model->getWithKeuzemogelijkheidWithOpties_byId($extras);
					$data['jaargang']=$this->jaargang_model->get_byId($extras);
				}else{															/// Als er geen jaargang meegegeven wordt, word je doorverwezen naar de home-pagina
					$view = 'index';
				}
			break;
			/// Weergeven van alle taken voor een bepaalde keuzemogelijkheid.
			case "takenbeheer":
				$data['creator'] = "TIM SWERTS";
				if($extras != null) {											
					$this->load->model('Taken_model');
					$data['taken'] = $this->Taken_model->getAllWithShiften_byKeuzemogelijkheidId($extras);
					$this->load->model('keuzemogelijkheid_model');
					$data['keuzemogelijkheid'] = $this->keuzemogelijkheid_model->get_byId($extras);
				}else{															/// Als er geen keuzemogelijkheid meegegeven wordt, word je doorverwezen naar de home-pagina
					$view = 'index';
				}
			break;
			/// Doorverwijzen naar de pagina waarop taken worden aangemaakt en aangepast.
			case "updatetaak":
				$data['creator'] = "TIM SWERTS";
				// kiezen of we een taak moeten aanmaken of aanpassen en daarna alle gegevens ophalen.
				if($extras != null) {
					//Aanmaken van een taak
					if(strpos($extras,"i")!==false){
						$this->load->model('keuzemogelijkheid_model');
						$data['keuzemogelijkheid'] = $this->keuzemogelijkheid_model->get_byId(str_replace("i", "", $extras));
						$data['token']=true;
					}
					// Aanpassen van een taak
					if(strpos($extras,"u")!==false){
						$this->load->model('taken_model');
						$data['taak'] = $this->taken_model->get_byId($extras);
						$this->load->model('keuzemogelijkheid_model');
						$data['keuzemogelijkheid'] = $this->keuzemogelijkheid_model->get_byId($data['taak']->keuzemogelijkheidId);
						$data['token']=false;

					}
				}else{
					// De index pagina zal geladen worden als er te weinig info wordt meegegeven.
					$view = 'index';
				}
			break;
			/// Doorverwijzen naar de pagina waarop shiften worden aangemaakt en aangepast.
			case "updateshift":
				$data['creator'] = "TIM SWERTS";
				// kiezen of we een shift moeten aanmaken of aanpassen en daarna alle gegevens ophalen.
				if($extras != null) {
					// Aanmaken van een shift
					if(strpos($extras,"i")!==false){
						$this->load->model('Taken_model');
						$data['taak'] = $this->Taken_model->get_byId(str_replace("i", "", $extras));
						$data['token']=true;
					}
					// Aanpassen van een shift
					if(strpos($extras,"u")!==false){
						$this->load->model('Shiften_model');
						$data['shift'] = $this->Shiften_model->get_byId($extras);
						$this->load->model('Taken_model');
						$data['taak'] = $this->Taken_model->get_byId($data['shift']->taakId);
						$data['token']=false;

					}
				}else{															/// De index pagina zal geladen worden als er te weinig info wordt meegegeven.
					$view = 'index';
				}
			break;
			// =================================================================================================== /TIM SWERTS
			// =================================================================================================== DAAN
			case "plaatsToevoegen":
				$data['creator'] = "DAAN";
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
				$data['creator'] = "GREIF MATTHIAS";
				if($extras != null) {
					$this->load->model('jaargang_model');
					$data['data']['jaargang'] = $this->jaargang_model->get_byId($extras);
				}
			break;

			case 'personeelimporteren':
				$data['creator'] = "";
			break;

			case 'deelnemersoverzicht':
				$data['creator'] = "";
				if($extras != null) {
				$this->load->model('Persoon_model');
				$data["deelnemers"] = $this->Persoon_model->getallwithactiviteit($extras);
				}
			break;
			case 'vrijwilligersoverzicht':
				$data['creator'] = "GREIF MATTHIAS";
				if($extras != null) {
					$this->load->model('Persoon_model');
					$data["vrijwilligers"] = $this->Persoon_model->getAll_ofJaargang_withShift($extras);
				}
			break;
			case 'importsuccess':
				$data['creator'] = "";
				$data["personen"] = $extras;
			break;

			case 'importfout':
				$data['creator'] = "";
			break;

			case "mail_overzicht":
				$data['creator'] = "ERIK";

				$data['message'] = "Mail Reminder Overzicht";
				$data['css_files'] = array();
				$data['view'] = 'mail_overzicht';

				$this->load->model('Mailherinnering_model');
				$this->load->model('mailsjabloon_model');
				$this->load->model('jaargang_model');

				$jaargangid = $this->jaargang_model->getActief();

				$reminders = $this->Mailherinnering_model->getAll();
				$data['keuzemogelijkheden'] = $this->get_personen($jaargangid->id);
				$data['nietingeschrevenDeelnemers']  = $this->Persoon_model->get_NietIngeschrevenDeelnemers($jaargangid->id);
				$data['nietingeschrevenVrijwilligers']  = $this->Persoon_model->get_NietIngeschrevenVrijwilligers($jaargangid->id);
				$nietingeschrevenVrijwilligers = $this->Persoon_model->get_NietIngeschrevenVrijwilligers($jaargangid->id);
				foreach ($reminders as $reminder) {
					$reminder->ontvangers =  $this->Mailherinnering_model->get_PersonenInReminder($reminder->id);
					$reminder->sjabloon = $this->mailsjabloon_model->get($reminder->sjabloonId);

				}
				$data['mailsjablonen'] = $this->mailsjabloon_model->getAll();
				$data['reminders'] = $reminders;
				//$data['css_files'] = array("login.css");
				$data['clearscreen'] = true;
				$data["creator"] = "Erik Vzn Reusel";
				$this->load->view('template/main', $data);
			break;

			default:
				$data['creator'] = "GREIF MATTHIAS";
				$view = 'index';
			break;
		}

		// Set view
		$data['view'] = 'dash_admin_' . $view;

		$this->load->view('template/main', $data);
	}

	// API
	// LOGIN
	/**
	 * Login API call, print return waarde op scherm
	 * @param string $username
	 *  Gebruikersnaam van gebruiker
	 * @param string $pass
	 *  Wachtwoord van gebruiker
 	*/
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

	/**
	 * Login API call, print return waarde op scherm
	 * @param id $id
	 *  Id van gebruiker
	 * @param string $pass
	 *  Wachtwoord van gebruiker
 	*/
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



	// FLOW
	/**
	 * Meld administrator af
 	*/
	public function logout(){
		$this->session->unset_userdata('id');

		// Redirect to adminbeheer
		redirect('admin/');
	}

	// Update admin
	/**
	 * Update administratorgegevens
 	*/
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

	/**
	 * Verwijderd de administrator
	 * @param int $id
	 *  Id van gebruiker
 	*/
    public function delete($id)
	{
		// Delete
        $this->load->model('beheer_model');
        $this->beheer_model->delete($id);
		
		// Redirect to adminbeheer
		redirect('admin/dash/adminbeheer');
	}

	// =================================================================================================== TIM

	///lees een CSV bestand in met deelnemers/vrijwilligers en voeg deze toe aan de database
	public function excel(){		
		$this->load->model('CSV_model');
        $soort = $this->input->post('soort', TRUE);
        $personen = $this->CSV_model->readpersonen($soort);
		if($personen != null){
		$this->dash("importsuccess",$personen);
		} else {
		$this->dash("importfout");
		}
	}	
	// =================================================================================================== /TIM

	public function get_NietIngeschreven()
    {
        $this->load->model('Persoon_model');
        print_r($this->Persoon_model->get_NietIngeschrevenVrijwilligers());
        echo PHP_EOL;
        echo PHP_EOL;
        print_r($this->Persoon_model->get_NietIngeschrevenDeelnemers());
	}
	
	private function get_personen($jaargangid)
    {

        // get keuzemogelijkheden
        $this->load->model('Keuzemogelijkheid_model');
        $this->load->model('KeuzeoptieVanDeelnemer_model');
        $this->load->model('Taken_model');
        $this->load->model('Shiften_model');
        $this->load->model('Persoon_model');
        $this->load->model("VrijwilligersInShift_model");

        $keuzemogelijkheden = $this->Keuzemogelijkheid_model->getAllByNaamWithKeuzeOpties($jaargangid);
        //print_r($keuzemogelijkheden);
        foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
            $keuzemogelijkheid->verbergen = true;
            //get taken
            $taken = $this->Taken_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);
            //echo ("AANTAL TAKEN VOOR " . $keuzemogelijkheid->naam . ": " . count($taken));
            $keuzemogelijkheid->taken = array();
            $keuzemogelijkheid->taken = $taken;

            // get shiften
            foreach ($keuzemogelijkheid->taken as $taak) {
                $shiften = $this->Shiften_model->getAllByNaamWhereTaakId($taak->id);
                $taak->verbergen = true;
                $taak->shiften = $shiften;
                foreach ($taak->shiften as $shift) {
                    //get personen in shift
                    $vrijwilligersInshiftObject  = $this->VrijwilligersInShift_model->getAllByShiftId($shift->id);
                    //print_r($vrijwilligersInshiftObject);
                    if (count($vrijwilligersInshiftObject) !=0)
                    {
                        $taak->verbergen = false;
                        $keuzemogelijkheid->verbergen = false;
                    }
                    $vrijwilligers = array_map(create_function('$o', 'return $o->persoon;'), $vrijwilligersInshiftObject);
                    $shift->vrijwilligers = $vrijwilligers;

                }
            }
            //get deelnemers van keuzeopties

            foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie) {
                $keuzeoptie->personen = array();
                $keuzeoptie->verbergen = true;
                $keuzeoptieVanDeelnemers = $this->KeuzeoptieVanDeelnemer_model->get_byKeuzeoptieId($keuzeoptie->id);
                if (count($keuzeoptieVanDeelnemers) !=0)
                {
                    $keuzemogelijkheid->verbergen = false;
                    $keuzeoptie->verbergen = false;
                }
                foreach ($keuzeoptieVanDeelnemers as $keuzeoptieVanDeelnemer) {
                    $deelnemendPersoon = $this->Persoon_model->get_byId($keuzeoptieVanDeelnemer->persoonId);
                    array_push($keuzeoptie->personen, $deelnemendPersoon);
                }
            }

        }
        return $keuzemogelijkheden;

        //get niet ingeschreven personen


    }
}

?>