<?php
/*
DAAN
LAST UPDATED: 18 03 30
PLAATS CONTROLLER
*/

defined('BASEPATH') OR exit('No direct script access allowed');

/// Controller voor plaats
class Plaats extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->helper('form');

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
    
    /// Geeft nieuw leeg plaatsobject
    public function getEmptyPlaats() {
        $plaats = new stdClass();

        $plaats->id = 0;
        $plaats->naam = '';
        $plaats->locatie = '';
        

        return $plaats;
    }
    /// maak nieuw plaatsobject
    public function maakNieuwe() {
        $data['titel'] = 'Plaats toevoegen';
        $data['plaats'] = $this->getEmptyPlaats();
 

        $data['view'] = 'plaatsToevoegen';

        redirect('admin/dash/plaatsToevoegen');
    }
    
    /// Registreer wat de administrator invult. Als hij op wijzig klikt, wordt het bestaande plaatsobject geupdatet. Wanneer hij een nieuwe plaats toevoegt (en dus gewoon de veldjes invult zonder op wijzig geklikt te hebben), wordt het nieuwe plaatsobject in de database geïnsert.

    public function registreer() {
        $plaats = new stdClass();

        $plaats->naam = $this->input->post('naam');
        $plaats->locatie = $this->input->post('locatie');

        $plaats->id = $this->input->post('id');
        $data['view'] = 'plaatsToevoegen';
        $this->load->model('plaats_model');
        
        if ($plaats->id > 0) {
            $this->plaats_model->update($plaats);
        } else {
            $this->plaats_model->insert($plaats);
        }
        
        redirect('admin/dash/plaatsToevoegen');
    }

    /// Functie om een locatie uit de database te verwijderen
    public function verwijder($id) {
        $this->load->model('plaats_model');
        $this->plaats_model->delete($id);

        redirect('admin/dash/plaatsToevoegen');
    }

    /// Functie om een bestaande locatie te wijzigen in de database
    public function wijzig($id) {
        redirect('admin/dash/plaatsToevoegen/' .$id, 'refresh');
    }

    /// Functie om plaats op te halen
    	public function jsonplaats($id)
	{
		$data['return'] = '';
		
        // Haal plaats op
		$this->load->model('plaats_model');
			$plaats = new stdClass();		
            $plaats = $this->plaats_model->getPlaatsById($id);
            // Return data
			$data['return'] = json_encode($plaats);

		
		// Data tonen in req_output
		$this->load->view('req_output', $data);
	}
}
