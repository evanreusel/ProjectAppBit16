<!-- 
    TIM SWERTS
	LAST UPDATED: 18 05 15
	KEUZEOPTIE CONTROLLER
-->

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/// Controller voor keuzeoptiefunctionaliteiten
class Keuzeoptie extends CI_Controller{
    
     public function __construct() {
        parent::__construct();

        /// =================================================================================================== GREIF MATTHIAS
        /// Autoload
        $this->load->library('session');

		/// Redirect to home if no session started
        $this->load->model('beheer_model');
        if(!$this->session->has_userdata('id') || $this->beheer_model->get_byId($this->session->userdata('id')) == null){
            redirect('/admin/index', 'location');
        }
        /// =================================================================================================== /GREIF MATTHIAS
    }

    /// =================================================================================================== GREIF MATTHIAS
    /// Get Keuzeoptie by Id
    public function get($id){
        $data['return'] = '';
		
        /// Get data from db
        $this->load->model('$keuzeoptie_model');
        $returndata = $this->$keuzeoptie_model->get_byId($id);

        /// Return data
        $data['return'] = json_encode($returndata);
		
		/// Print in default api output view
		$this->load->view('req_output', $data);
    }
    /// =================================================================================================== /GREIF MATTHIAS

    /// Functie voor het aanpassen en aanmaken van keuzeopties
    public function update()
	{
		/// klasse Keuzeoptie aanmaken en initialiseren
        $keuzeoptie = new stdClass();

        $keuzeoptie->id = $this->input->post('id');
        $keuzeoptie->keuzemogelijkheidId = $this->input->post('keuzemogelijkheidId');
        $keuzeoptie->naam = $this->input->post('naam');
        $keuzeoptie->plaatsId = $this->input->post('plaatsId');
        $keuzeoptie->min = $this->input->post('min');
        $keuzeoptie->max = $this->input->post('max');
        $keuzeoptie->eindTijdstip = $this->input->post('eindTijdstip');
        $keuzeoptie->beginTijdstip = $this->input->post('beginTijdstip');

		/// Model inladen
        $this->load->model('Keuzeoptie_model');
		
		/// Keuzeoptie toevoegen of aanpassen
        if($keuzeoptie->id == 0){
       		$this->Keuzeoptie_model->add($keuzeoptie);
        } else {
        	$this->Keuzeoptie_model->update($keuzeoptie);
        }

        /// Keuzemogelijkheid aanmaken om te kunnen redirecten naar de juiste pagina
        $this->load->model('keuzemogelijkheid_model');
        $keuzemogelijkheid=$this->keuzemogelijkheid_model->get_byId($keuzeoptie->keuzemogelijkheidId);
        
        /// Redirect naar keuzemogelijkheid pagina
		redirect('admin/dash/keuzemogelijkheidbeheer/'.$keuzemogelijkheid->jaargangId);
    }

    /**
     * Functie voor het verwijderen van keuzeopties
     * @param string $id
     * Id van de keuzeoptie die verwijderd moet worden
     */   
    public function delete($id)
	{
		
        $this->load->model('Keuzeoptie_model');

        $this->Keuzeoptie_model->delete($id);
		
		/// Redirect to keuzemogelijkheidbeheer
		redirect('admin/dash/jaargangoverzicht');
	}
}
