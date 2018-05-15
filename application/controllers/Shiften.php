<?php
// Tim Swerts
// last updated: 3/05/2018
// shiften controller

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shiften extends CI_Controller{
    
     public function __construct() {
        parent::__construct();

        // =================================================================================================== GREIF MATTHIAS
        // Autoload
            // $this->load->library('session');

		// Redirect to home if no session started
            // $this->load->model('beheer_model');
            // if(!$this->session->has_userdata('id') || $this->beheer_model->get_byId($this->session->userdata('id')) == null){
            //     redirect('/admin/index', 'location');
            // }
        // =================================================================================================== /GREIF MATTHIAS
    }

    public function update()
	{
		// klasse shift aanmaken en initialiseren
        $shift = new stdClass();

        $shift->id = $this->input->post('id');
        $shift->naam = $this->input->post('naam');
        $shift->taakId = $this->input->post('taakId');

		// Model inladen
        $this->load->model('Shiften_model');
		
		// Shift toevoegen of aanpassen
        if($shift->id == 0){
       		$this->Shiften_model->add($shift);
        } else {
        	$this->Shiften_model->update($shift);
        }

        $this->load->model('Taken_model');
        $taak=$this->Taken_model->get_byId($shift->taakId);
		// Redirect naar taken pagina
		redirect('admin/dash/takenbeheer/'.$taak->keuzemogelijkheidId);
    }

    public function delete($id)
	{
		
        $this->load->model('Shiften_model');
        $returndata = $this->Shiften_model->get_byId($id);

        $this->load->model('Taken_model');
        $redirectData = $this->Taken_model->get_byId($returndata->taakId);

        $this->Shiften_model->delete($id);
        
		// Redirect to keuzemogelijkheidbeheer
        redirect('admin/dash/takenbeheer/'.$redirectData->keuzemogelijkheidId);
	}

    public function vrijwilligerInShiftToevoegen($shiftId, $persoonId)
    {
        $vrijwilligerInShift = new stdClass();

        $vrijwilligerInShift->persoonId = $persoonId;
        $vrijwilligerInShift->$shiftId = $shiftId;

        $this->load->model('VrijwilligersInShift_model');
        $this->VrijwilligersInShift_model->add($vrijwilligerInShift);

        $this->load->view('ajax_vrijwilligerinshift', $data);
    }
    
    public function vrijwilligerInShiftVerwijderen($shiftId, $persoonId)
	{
        $this->load->model('VrijwilligersInShift_model');
        $this->VrijwilligersInShift_model->delete($shiftId, $persoonId);

		$this->load->view('ajax_vrijwilligerinshift', $data);
    }
    
    public function vrijwilligerInShiftWeergeven($shiftId)
    {

        $this->load->model('VrijwilligersInShift_model');
        $data['$shiften']=$this->VrijwilligersInShift_model->getAllByShiftId($shiftId);

        $this->load->view('ajax_vrijwilligersinshift', $data);

    }
}
