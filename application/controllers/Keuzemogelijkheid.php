<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuzemogelijkheid extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
    }

    public function get($id){
        $data['return'] = '';
		
        // Get data from db
        $this->load->model('keuzemogelijkheid_model');
        $returndata = $this->keuzemogelijkheid_model->get_byId($id);

        // Return data
        $data['return'] = json_encode($returndata);
		
		// Print in default api output view
		$this->load->view('req_output', $data);
    }

    public function update()
	{
		// klasse keuzemogelijkheid aanmaken en initialiseren
        $keuzemogelijkheid = new stdClass();

        $keuzemogelijkheid->id = $this->input->post('id');
        $keuzemogelijkheid->username = $this->input->post('username');
        $keuzemogelijkheid->pass =  password_hash($this->input->post('nieuwpass'), PASSWORD_DEFAULT);

		// Model inladen
        $this->load->model('keuzemogelijkheid_model');
		
		// Keuzemogelijkheid toevoegen of aanpassen
        if($admin->id == 0){
       		$this->keuzemogelijkheid_model->insertKeuzemogelijkheid($keuzemogelijkheid);
        } else {
        	$this->keuzemogelijkheid_model->deleteKeuzemogelijkheid($keuzemogelijkheid);
        }

		// Redirect naar keuzemogelijkheid pagina
		redirect('admin/dash/keuzemogelijkheidbeheer');
	}

}
