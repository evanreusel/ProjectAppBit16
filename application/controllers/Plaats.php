<?php
/*
DAAN
LAST UPDATED: 18 03 30
PLAATS CONTROLLER
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Plaats extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
                $this->load->helper('form');
	}
	
        function getEmptyPlaats() {
        $plaats = new stdClass();

        $plaats->id = 0;
        $plaats->naam = '';
        $plaats->locatie = '';
        

        return $plaats;
    }
        
    public function maakNieuwe() {
        $data['titel'] = 'Plaats toevoegen';
        $data['plaats'] = $this->getEmptyPlaats($id);
 

        $data['view'] = 'plaatsToevoegen';

        redirect('admin/dash/plaatsToevoegen');
    }
    
    public function registreer() {
        $plaats = new stdClass();

        $plaats->naam = $this->input->post('naam');
        $plaats->locatie = $this->input->post('locatie');

        $plaats->id = $this->input->post('id');
        $data['view'] = 'plaatsToevoegen';
        $this->load->model('plaats_model');
        
        if ($plaats->id == 0) {
            $this->plaats_model->insert($plaats);
        } else {
            $this->plaats_model->update($plaats);
        }
        
        redirect('admin/dash/plaatsToevoegen');
    
        }

    public function verwijder($id) {
        $this->load->model('plaats_model');
        $this->plaats_model->delete($id);

        redirect('admin/dash/plaatsToevoegen');
    }

    public function wijzig($id) {
        redirect('admin/dash/plaatsToevoegen/' .$id, 'refresh');
    }


    	public function ajaxplaats($id = null)
	{
		$data['return'] = '';
		
		// Haal plaats op
		$this->load->model('plaats_model');
			$plaats = new stdClass();		
			$plaats = $this->plaats_model->getPlaatsById($id);
            // Return data
			$data['return'] = json_encode($plaats);

		
		// Print in default api output view
		$this->load->view('req_output', $data);
	}
}
