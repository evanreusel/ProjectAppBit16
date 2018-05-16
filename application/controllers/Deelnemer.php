<!-- 
    GREIF MATTHIAS 
	LAST UPDATED: 18 05 02
	DEELNEMER CONTROLLER
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/// Constructor voor deelnemer functionaliteiten
class Deelnemer extends CI_Controller {
	/**
	 * Default Contstructor
 	*/
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
	
	/**
	 * Container voor alle dashbord schermen van deelnemer
	 * @param string $view
	 *  Scherm dat opgeroepen word in het dashbord van administrator
	 * @param string $extras
	 *  Optionele parameters
 	*/
	public function dash($view = null, $extras = null){
		// Load models
		$this->load->model('persoon_model');

		// Load logged in user
		$data['user'] = $this->persoon_model->get_byId($this->session->userdata('id'));

		// Check if dashboard view is requested else default homeview
		if(is_null($view) )
		{
			$view = 'index';
		}

		// Load view
		$data['user']->username = $data['user']->naam;							// Header back compatibility
		$data['message'] = 'Hello there ' . $data['user']->naam . ' | Dash';	// Title
		$data['css_files'] = array("dash.css");									// Default dash style

		$data['primaryColor'] = 'blue';											// Primary color (purple for admin, blue for others??)
		$data['currentview'] = $view;											// Current view indicator (for navbar indicator??)
		$data['homelink'] = base_url() . 'index.php/deelnemer/dash/';				// Dash homepage
		$data['links'] = [														// Available links for navbar
			[
				'title' => 'Inschrijven',
				'url' => base_url() . 'index.php/deelnemer/dash/personeelsinschrijvingen/',
				'hulp' => 'schrijf je in of uit voor aanstaande evenementen'
			],													// Available links for navbar
			[
				'title' => 'Vrijwilliger toevoegen',
				'url' => base_url() . 'index.php/deelnemer/dash/vrijwilligertoevoegen/'
			]
		];
		$data['actions'] = [
			[
				'title' => 'Log out',
				'url' => base_url() . 'index.php/deelnemer/logout/',
				'hulp' => "Log uit"
			]
		];

		// Get data for view
		switch($view){
			// =================================================================================================== 
			case "personeelsinschrijvingen":
				$data['creator'] = "";
				//haal het actief jaar op.													
				$this->load->model('jaargang_model');
				$data['actiefJaar']=$this->jaargang_model->getActief();
				
				//zoek keuzemogelijkheden
				$this->load->model('keuzemogelijkheid_model');
				$data['keuzemogelijkheden']=$this->keuzemogelijkheid_model->getAll_byJaargangId($data['actiefJaar']->id);
				foreach ($data['keuzemogelijkheden'] as $keuzemogelijkheid) {
					$this->load->model('keuzeoptie_model');
					$keuzemogelijkheid->keuzeopties = $this->keuzeoptie_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);
					foreach($keuzemogelijkheid->keuzeopties as $keuzeoptie){
						$this->load->model('plaats_model');
						$keuzeoptie->plaats = $this->plaats_model->getPlaatsById($keuzeoptie->plaatsId);
						echo $keuzeoptie->plaatsId;
						echo '</br>';
						echo print_r($keuzeoptie->plaats);
						echo '</br>';
					}

				}
				$this->load->model('KeuzeoptieVanDeelnemer_model');
				$data['ingeschreven']= $this->KeuzeoptieVanDeelnemer_model->get_byPersoonId($data['user']->id);
			
				break;
		
			case "vrijwilligersucces":
				$data['creator'] = "";
				$data['persoon'] = $extras;
			break;
			// =================================================================================================== /	
		}

		// Set view
		$data['view'] = 'dash_deelnemer_' . $view;

		$this->load->view('template/main', $data);
	}

	/**
	 * Meld administrator af
 	*/
	public function logout(){
		$this->session->unset_userdata('id');

		// Redirect to adminbeheer
		redirect('/');
	}

	// =================================================================================================== 
	public function vrijwilligertoevoegen(){
            $persoon = new stdClass();

			$persoon->naam = $this->input->post('naam', TRUE);
			$persoon->mail = $this->input->post('mail', TRUE);
			$persoon->woonplaats = $this->input->post('woonplaats', TRUE);
			$persoon->adres = $this->input->post('adres', TRUE);
			$persoon->soort = "vrijwilleger";

            $this->load->model("Persoon_model");
       		$this->Persoon_model->insert($persoon);

			$this->dash('vrijwilligersucces',$persoon);
	}
	// =================================================================================================== /
}