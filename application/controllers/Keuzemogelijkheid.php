<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuzemogelijkheid extends CI_Controller{
    
     public function __construct() {
        parent::__construct();
    }

    public function get($id){
        $data['return'] = '';
		
        // Get data from db
        $this->load->model('keuzemogelijkheid_model');
        $returndata = $this->keuzemogelijkheid_model->get_byId($id);

        // Return data
        $data['return'] = json_encode($returndata);
		
		// Print in default api output view
		$this->load->view('req_output', $data);
    }


}
