<!-- 
    TIM SWERTS
	LAST UPDATED: 18 03 30
	Taken CONTROLLER
-->

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Taken extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
    }

    public function update()
	{
		// klasse keuzemogelijkheid aanmaken en initialiseren
        $taak = new stdClass();

        $taak->id = $this->input->post('id');
        $taak->functie = $this->input->post('functie');
        $taak->beschrijving = $this->input->post('beschrijving');
        $taak->keuzemogelijkheidId = $this->input->post('Keuzemogelijkheid');

		// Model inladen
        $this->load->model('Taken_model');
		
		// Keuzemogelijkheid toevoegen of aanpassen
        if($taak->id == 0){
       		$this->Taken_model->add($taak);
        } else {
        	$this->Taken_model->update($taak);
        }

		// Redirect naar keuzemogelijkheid pagina
		redirect('admin/dash/takenbeheer/'. $taak->keuzemogelijkheidId);
    }
    
    public function delete($id)
	{
		
        $this->load->model('Taken_model');

        $returndata = $this->Taken_model->get_byId($id);

        $this->Taken_model->delete($id);
        
		// Redirect to keuzemogelijkheidbeheer
        redirect('admin/dash/takenbeheer/'.$returndata->keuzemogelijkheidId);
	}
}
