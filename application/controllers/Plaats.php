<!-- 
    DAAN
	LAST UPDATED: 18 03 30
	PLAATS CONTROLLER
-->

<?php
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
        $data['plaats'] = $this->getEmptyPlaats();
 

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
        $plaats = new stdClass();

        $this->load->model('plaats_model');
        $this->plaats_model->getPlaatsById($id);

        $this->load->controller('Admin');
        $this->Admin->dash("dash/plaatsToevoegen", $plaats);
    }
}
