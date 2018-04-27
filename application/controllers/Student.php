<!-- 
    GREIF MATTHIAS
	LAST UPDATED: 18 04 25
	STUDENT CONTROLLER
-->

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
		$data['message'] = 'Hello there ' . $data['user']->naam . ' | Dash';// Title
		$data['css_files'] = array("dash.css");									// Default dash style

		$data['primaryColor'] = 'blue';											// Primary color (purple for admin, blue for others??)
		$data['currentview'] = $view;											// Current view indicator (for navbar indicator??)
		$data['homelink'] = base_url() . 'index.php/student/dash/';				// Dash homepage
		$data['links'] = [														// Available links for navbar
			[
				'title' => 'Shiften',
				'url' => base_url() . 'index.php/student/dash/inschrijvingshiften'
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
			case "inschrijvingshiften":
				//haal het actief jaar op.													
				$this->load->model('jaargang_model');
				$data['actiefJaar']=$this->jaargang_model->getActief();
				
				//zoek keuzemogelijkheden
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
		$data['view'] = 'dash_student_' . $view;

		$this->load->view('template/main', $data);
	}
}