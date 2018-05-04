<?php

// Tim Swerts
// last updated: 3/05/2018
// shiften controller

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shiften extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
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

    public function deelnemerAanKeuzeoptieToevoegen($keuzeoptieId, $persoonId)
    {
        $deelnemerInKeuzeoptie = new stdClass();

        $deelnemerInKeuzeoptie->persoonId = $persoonId;
        $deelnemerInKeuzeoptie->keuzeoptieId = $keuzeoptieId;

        $this->load->model('KeuzeoptieVanDeelnemer_model');
        $this->KeuzeoptieVanDeelnemer_model->add($deelnemerInKeuzeoptie);

        $this->load->view('ajax_vrijwilligerinshift', $data);
    }
    
    public function deelnemerVanKeuzeoptieVerwijderen($keuzeoptieId, $persoonId)
	{
        $this->load->model('KeuzeoptieVanDeelnemer_model');
        $this->KeuzeoptieVanDeelnemer_model->delete($keuzeoptieId, $persoonId);

		$this->load->view('ajax_vrijwilligerinshift', $data);
    }
    
    public function vrijwilligerInShiftWeergeven($shiftId)
    {

        $this->load->model('KeuzeoptieVanDeelnemer_model');
        $data['keuzeopties']=$this->KeuzeoptieVanDeelnemer_model->getAllByKeuzemogelijkheidId($keuzeMogelijkheidId);

        $this->load->view('ajax_vrijwilligersinshift', $data);

    }
}
