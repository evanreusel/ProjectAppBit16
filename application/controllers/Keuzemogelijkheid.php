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
        
        
       $this->load->view('keuzemogelijkheid', $data);
        
    }

    public function get($id){
        $this->load->model('Keuzeoptie_model');
        $data['keuzeOptie'] = $this->Keuzeoptie_model->get($id);
        $data['titel'] = 'getid';

        $this->load->view('keuzeoptie', $data);
    }
    
}
