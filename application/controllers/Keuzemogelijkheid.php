<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuzemogelijkheid extends CI_Controller{
    
     public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
    }
    
    public function index() {
        $this->load->model('Keuzemogelijkheid_model');
            $data['activiteiten'] 
                    = $this->Keuzemogelijkheid_model->getAllByNaamWithKeuzeOpties();
            
            $data['titel']  = 'Database beheer';
        

            $data['message'] = "Beheer";
            $data['view'] = 'keuzemogelijkheid';
            $data['css_files'] = array("dash_docent.css");
            $this->load->view('template/main', $data);
       
        
    }

    public function get($id){
        $this->load->model('Keuzeoptie_model');
        $data['keuzeOptie'] = $this->Keuzeoptie_model->get($id);
        $data['titel'] = 'getid';

        $this->load->view('keuzeoptie', $data);
    }

    public function delete($id)
	{
        $this->load->model('keuzemogelijkheid_model');
        $this->beheer_model->deleteKeuzemogelijkheid($id);
		
		redirect('/Keuzemogelijkheid/index', 'location');
	}
    
}
