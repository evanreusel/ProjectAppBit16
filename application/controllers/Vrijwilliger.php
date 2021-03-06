<!-- 
    GREIF MATTHIAS
	LAST UPDATED: 18 04 25
	VRIJWILLIGER CONTROLLER
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/// Controller voor vrijwilligersfunctionaliteiten
class Vrijwilliger extends CI_Controller {
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
	 * Container voor alle dashbord schermen van vrijwilliger
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
			$view = 'inschrijvingshiften';
		}

		// Load view
		$data['user']->username = $data['user']->naam;
		$data['message'] = 'Hello there ' . $data['user']->naam . ' | Dash';	// Title
		$data['css_files'] = array("dash.css");									// Default dash style

		$data['primaryColor'] = 'blue';											// Primary color (purple for admin, blue for others??)
		$data['currentview'] = $view;											// Current view indicator (for navbar indicator??)
		$data['homelink'] = base_url() . 'index.php/vrijwilliger/dash/';				// Dash homepage
		$data['links'] = [														// Available links for navbar
			[
				'title' => 'Shiften',
				'url' => base_url() . 'index.php/vrijwilliger/dash/inschrijvingshiften'
			]
		];
		$data['actions'] = [
			[
				'title' => 'Log out',
				'url' => base_url() . 'index.php/vrijwilliger/logout/',
				'hulp' => "Log uit"
			]
		];

		// Get data for view
		switch($view){
			// Inladen van de view voor het kunnen inschrijven voor shiften, gemaakt door: Tim Swerts
			case "inschrijvingshiften":
				$data['creator'] = "";
				//haal het actief jaar op.													
				$this->load->model('jaargang_model');
				$data['actiefJaar']=$this->jaargang_model->getActief();
				
				//Alle keuzemogelijkheden zoeken met onderliggende taken en shiften
				$this->load->model('keuzemogelijkheid_model');
				$data['keuzemogelijkheden']=$this->keuzemogelijkheid_model->getAll_byJaargangId($data['actiefJaar']->id);
				foreach ($data['keuzemogelijkheden'] as $keuzemogelijkheid) {
					$this->load->model('taken_model');
					$keuzemogelijkheid->taken = $this->taken_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);
					foreach ($keuzemogelijkheid->taken as $taak) {
						$this->load->model('Shiften_model');
						$taak->shiften=$this->Shiften_model->getAllByNaamWhereTaakId($taak->id);
					}
				}
				$this->load->model('VrijwilligersInShift_model');
				$data['ingeschreven']= $this->VrijwilligersInShift_model->get_byPersoonId($data['user']->id);
			break;
		}

		// Set view
		$data['view'] = 'dash_vrijwilliger_' . $view;

		$this->load->view('template/main', $data);
	}

	/**
	 * Meld vrijwilliger af
 	*/
	public function logout(){
		$this->session->unset_userdata('id');

		// Redirect to adminbeheer
		redirect('/');
	}
}