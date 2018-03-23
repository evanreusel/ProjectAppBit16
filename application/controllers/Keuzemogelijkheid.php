<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuzemogelijkheid extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
    }

    public function get($id){
        $this->load->model('Keuzeoptie_model');
        $data['keuzeOptie'] = $this->Keuzeoptie_model->get($id);
        $data['titel'] = 'getid';

        $this->load->view('keuzeoptie', $data);
    }
    
}
