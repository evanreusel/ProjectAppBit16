<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jaargang extends CI_Controller{
    public function __construct()
	{
        parent::__construct();
        
        // Autoload
        $this->load->library('session');

		// Check location is home of admin controller or api request page
		$is_api_end = ($this->router->class === 'jaargang' && $this->router->method === 'end') ? true : false;

		// Homepage check
		if($is_api_end){
			// Redirect to home if no session started
			if(!$this->session->has_userdata('id')){
				redirect('/admin/index', 'location');
			}
		}
    }
    
    // API
    // Deactivate jaargang
    public function end($id){
        if($id > 0)
        {
            $this->load->model('jaargang_model');

            // Get from db
            $jaargang = $jaargang_model->get_byId($id);

            $jaargang->actief = 0;

            $this->db->where('id', $jaargang->id);
            $this->db->update('Jaargang', $jaargang);

            return TRUE;
        }

        return FALSE;
    }
}

?>