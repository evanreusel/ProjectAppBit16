<!-- 
    TIM SWERTS
	LAST UPDATED: 18 03 30
	KEUZEMOGELIJKHEID CONTROLLER
-->

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/// Controller voor keuzemogelijkheidfunctionaliteiten
class Keuzemogelijkheid extends CI_Controller{
    
     public function __construct() {
         /**
          * Default Constructor
         */
        parent::__construct();

        // =================================================================================================== GREIF MATTHIAS
        // Autoload
        $this->load->library('session');
        
        // Redirect to home if no session started
        $this->load->model('beheer_model');
        if(!$this->session->has_userdata('id') || $this->beheer_model->get_byId($this->session->userdata('id')) == null){
            redirect('/admin/index', 'location');
        }
    }

    /**
	 * Vraag keuzemogelijkheid op
	 * @param int $id
	 *  Id van keuzemogelijkheid
 	*/
    public function get($id){
        $data['return'] = '';
		
        /// Get data from db
        $this->load->model('keuzemogelijkheid_model');
        $returndata = $this->keuzemogelijkheid_model->get_byId($id);

        /// Return data
        $data['return'] = json_encode($returndata);
		
		/// Print in default api output view
		$this->load->view('req_output', $data);
    }
    /// =================================================================================================== /GREIF MATTHIAS

    /**
	 * Pas keuzemogelijkheid aan
 	*/
    public function update()
	{
		/// klasse keuzemogelijkheid aanmaken en initialiseren
        $keuzemogelijkheid = new stdClass();

        $keuzemogelijkheid->id = $this->input->post('id');
        $keuzemogelijkheid->plaatsId = $this->input->post('plaats');
        $keuzemogelijkheid->jaargangId = $this->input->post('jaar');
        $keuzemogelijkheid->naam = $this->input->post('naam');
        $keuzemogelijkheid->eindTijdstip = $this->input->post('eindTijdstip');
        $keuzemogelijkheid->beginTijdstip = $this->input->post('beginTijdstip');
        $keuzemogelijkheid->deadlineTijdstip = $this->input->post('deadlineTijdstip');

		/// Model inladen
        $this->load->model('keuzemogelijkheid_model');
		
		/// Keuzemogelijkheid toevoegen of aanpassen
        if($keuzemogelijkheid->id == 0){
       		$this->keuzemogelijkheid_model->add($keuzemogelijkheid);
        } else {
        	$this->keuzemogelijkheid_model->update($keuzemogelijkheid);
        }

		/// Redirect naar keuzemogelijkheid pagina
		redirect('admin/dash/keuzemogelijkheidbeheer/'. $keuzemogelijkheid->jaargangId);
    }
    
    /**
	 * Verwijder keuzemogelijkheid
	 * @param int $id
	 *  Id van keuzemogelijkheid
 	*/
    public function delete($id)
	{
		
        $this->load->model('keuzemogelijkheid_model');

        $returndata = $this->keuzemogelijkheid_model->get_byId($id);

        $this->keuzemogelijkheid_model->delete($id);
        
		/// Redirect to keuzemogelijkheidbeheer
        redirect('admin/dash/keuzemogelijkheidbeheer/'.$returndata->jaargangId);
	}
}
