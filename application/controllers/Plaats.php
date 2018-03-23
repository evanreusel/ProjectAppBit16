<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plaats extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
                $this->load->helper('form');
	}
	
        	public function index()
	{


        $this->load->model('plaats_model');
        $data['plaatsen'] = $this->plaats_model->getAllByPlaatsnaam();

		$data['message'] = "hello";
		$data['css_files'] = array("home.css");
		$data['clearscreen'] = true;
        $this->load->view('plaats_toevoegen', $data);
        

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
 

        $data['view'] = 'login';

        $this->load->view('plaats_toevoegen', $data);
    }
    
    public function registreer() {
        $plaats = new stdClass();

        $plaats->naam = $this->input->post('naam');
        $plaats->locatie = $this->input->post('locatie');

        $plaats->id = $this->input->post('id');

        $this->load->model('brouwerij_model');
        
        if ($plaats->id == 0) {
            $this->plaats_model->insert($plaats);
        } else {
            $this->plaats_model->update($plaats);
        }
        
    redirect("home/index"); 
    
        }
}
