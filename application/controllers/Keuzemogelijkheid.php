<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuzemogelijkheid extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
    }

    public function get_byId($id){
        $data['return'] = '';
		
        // Get data from db
        $this->load->model('keuzeoptie_model');
        $returndata = $this->keuzeoptie_model->get($id);

        // Return data
        $data['return'] = json_encode($returndata);
		
		// Print in default api output view
		$this->load->view('req_output', $data);
    }
    
}
