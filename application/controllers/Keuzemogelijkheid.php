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
        $keuzemogelijkheid->plaatsId = $this->input->post('plaats');
        $keuzemogelijkheid->jaargangId = $this->input->post('jaar');
        $keuzemogelijkheid->naam = $this->input->post('naam');
        $keuzemogelijkheid->eindTijdstip = $this->input->post('eindTijdstip');
        $keuzemogelijkheid->beginTijdstip = $this->input->post('beginTijdstip');
        $keuzemogelijkheid->deadlineTijdstip = $this->input->post('deadlineTijdstip');

		// Model inladen
        $this->load->model('keuzemogelijkheid_model');
		
		// Keuzemogelijkheid toevoegen of aanpassen
        if($keuzemogelijkheid->id == 0){
       		$this->keuzemogelijkheid_model->add($keuzemogelijkheid);
        } else {
        	$this->keuzemogelijkheid_model->update($keuzemogelijkheid);
        }

		// Redirect naar keuzemogelijkheid pagina
		redirect('admin/dash/keuzemogelijkheidbeheer');
    }
    
    public function delete($id)
	{
		
        $this->load->model('keuzemogelijkheid_model');
        $this->beheer_model->delete($id);
		
		// Redirect to keuzemogelijkheidbeheer
		redirect('admin/dash/keuzemogeelijkheidbeheer');
	}

}
