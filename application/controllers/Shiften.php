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
        $this->load->library('session');

		// Redirect to home if no session started
        $this->load->model('beheer_model');
        if(!$this->session->has_userdata('id') || $this->beheer_model->get_byId($this->session->userdata('id')) == null){
            redirect('/admin/index', 'location');
        }
        // =================================================================================================== /GREIF MATTHIAS
    }

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


    public function vrijwilligerInShiftToevoegen($shiftId, $persoonId)
    {
        $vrijwilligerInShift = new stdClass();

        $vrijwilligerInShift->persoonId = $persoonId;
        $vrijwilligerInShift->shiftId = $shiftId;

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
        $data['shiften']=$this->VrijwilligersInShift_model->getAllByShiftId($shiftId);

        $this->load->view('ajax_vrijwilligersinshift', $data);

    }
}
