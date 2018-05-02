<!-- 
    GREIF MATTHIAS 
	LAST UPDATED: 18 05 02
	DEELNEMER CONTROLLER
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deelnemer extends CI_Controller {
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
		$data['message'] = 'Hello there ' . $data['user']->naam . ' | Dash';	// Title
		$data['css_files'] = array("dash.css");									// Default dash style

		$data['primaryColor'] = 'blue';											// Primary color (purple for admin, blue for others??)
		$data['currentview'] = $view;											// Current view indicator (for navbar indicator??)
		$data['homelink'] = base_url() . 'index.php/deelnemer/dash/';				// Dash homepage
		$data['links'] = [														// Available links for navbar
			[
				'title' => 'Inschrijven',
				'url' => base_url() . 'index.php/deelnemer/dash/personeelsinschrijvingen/'
			]
		];
		$data['actions'] = [
			// [
			// 	'title' => 'Administrators beheren',
			// 	'url' => base_url() . 'index.php/admin/dash/adminbeheer/'
			// ]
		];

		// Get data for view
		switch($view){
			case "personeelsinschrijvingen":
				//haal het actief jaar op.													
				$this->load->model('jaargang_model');
				$data['actiefJaar']=$this->jaargang_model->getActief();
				
				//zoek keuzemogelijkheden
				$this->load->model('keuzemogelijkheid_model');
				$data['keuzemogelijkheden']=$this->keuzemogelijkheid_model->getAll_byJaargangId($data['actiefJaar']->id);
				foreach ($data['keuzemogelijkheden'] as $keuzemogelijkheid) {
					$this->load->model('keuzeoptie_model');
					$keuzemogelijkheid->keuzeopties = $this->keuzeoptie_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);

				}
				$this->load->model('KeuzeoptieVanDeelnemer_model');
				$data['ingeschreven']= $this->KeuzeoptieVanDeelnemer_model->get_byPersoonId($data['user']->id);
			
				break;
		}

		// Set view
		$data['view'] = 'dash_deelnemer_' . $view;

		$this->load->view('template/main', $data);
	}
}