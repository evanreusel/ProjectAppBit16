<!-- 
    TIM SWERTS
	LAST UPDATED: 18 03 30
	KEUZEOPTIE CONTROLLER
-->

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuzeoptie extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
    }

    // =================================================================================================== GREIF MATTHIAS
    // Get Keuzeoptie by Id
    public function get($id){
        $data['return'] = '';
		
        // Get data from db
        $this->load->model('$keuzeoptie_model');
        $returndata = $this->$keuzeoptie_model->get_byId($id);

        // Return data
        $data['return'] = json_encode($returndata);
		
		// Print in default api output view
		$this->load->view('req_output', $data);
    }
    // =================================================================================================== /GREIF MATTHIAS

    public function update()
	{
		// klasse Keuzeoptie aanmaken en initialiseren
        $keuzeoptie = new stdClass();

        $keuzeoptie->id = $this->input->post('id');
        $keuzeoptie->keuzemogelijkheidId = $this->input->post('keuzemogelijkheidId');
        $keuzeoptie->naam = $this->input->post('naam');
        $keuzeoptie->plaatsId = $this->input->post('plaatsId');
        $keuzeoptie->min = $this->input->post('min');
        $keuzeoptie->max = $this->input->post('max');
        $keuzeoptie->eindTijdstip = $this->input->post('eindTijdstip');
        $keuzeoptie->beginTijdstip = $this->input->post('beginTijdstip');

		// Model inladen
        $this->load->model('Keuzeoptie_model');
		
		// Keuzeoptie toevoegen of aanpassen
        if($keuzeoptie->id == 0){
       		$this->Keuzeoptie_model->add($keuzeoptie);
        } else {
        	$this->Keuzeoptie_model->update($keuzeoptie);
        }

        $this->load->model('keuzemogelijkheid_model');
        $keuzemogelijkheid=$this->keuzemogelijkheid_model->get_byId($keuzeoptie->keuzemogelijkheidId);
		// Redirect naar keuzemogelijkheid pagina
		redirect('admin/dash/keuzemogelijkheidbeheer/'.$keuzemogelijkheid->jaargangId);
    }
    
    public function delete($id)
	{
		
        $this->load->model('Keuzeoptie_model');

        $this->Keuzeoptie_model->delete($id);
		
		// Redirect to keuzemogelijkheidbeheer
		redirect('admin/dash/jaargangoverzicht');
	}
}
