<?php
// Tim Swerts
// last updated: 03/05/2018
// shiften controller

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/// Controller voor shiften
class Shiften extends CI_Controller{
    // Default Constructor
    public function __construct() {
        parent::__construct();

        // =================================================================================================== GREIF MATTHIAS
        // Autoload
       $this->load->library('session');

       // Redirect to home if no session started
       if(!$this->session->has_userdata('id')){
           redirect('/admin/index', 'location');
       }
        // =================================================================================================== /GREIF MATTHIAS
    }

    /// Functie voor het aanpassen en aanmaken van shiften
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

    /**
     * Functie voor het verwijderen van shiften
     * @param string $id
     * Id van de shift die verwijderd moet worden
     */
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
    
    
    /**
     * Functie voor het toevoegen van een vrijwilliger in een shift
     * @param string $shiftId
     * Id van de shift
     * @param string $persoonId
     * Id van de vrijwilliger
     */
    public function vrijwilligerInShiftToevoegen($shiftId, $persoonId)
    {
        $vrijwilligerInShift = new stdClass();

        $vrijwilligerInShift->persoonId = $persoonId;
        $vrijwilligerInShift->shiftId = $shiftId;

        $this->load->model('VrijwilligersInShift_model');
        $this->VrijwilligersInShift_model->add($vrijwilligerInShift);

        // Laden van de verkregen data in een ajax-venster
        $this->load->view('ajax_resultatenTonen', $data);
    }
 
    /**
     * Functie voor het verwijderen van een vrijwilliger uit een shift
     * @param string $shiftId
     * Id van de shift
     * @param string $persoonId
     * Id van de vrijwilliger
     */
    public function vrijwilligerInShiftVerwijderen($shiftId, $persoonId)
	{
        $this->load->model('VrijwilligersInShift_model');
        $this->VrijwilligersInShift_model->delete($shiftId, $persoonId);

        // Laden van de verkregen data in een ajax-venster
		$this->load->view('ajax_resultatenTonen', $data);
    }

    /**
     * Functie voor het weergeven van alle vrijwilliger van een bepaalde shift
     * @param string $shiftId
     * Id van de shift
     */
    public function vrijwilligerInShiftWeergeven($shiftId)
    {

        $this->load->model('VrijwilligersInShift_model');
        $data['shiften']=$this->VrijwilligersInShift_model->getAllByShiftId($shiftId);

        // Laden van de verkregen data in een ajax-venster
        $this->load->view('ajax_vrijwilligersinshift', $data);

    }
}
