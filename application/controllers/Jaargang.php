<?php
/*
GREIF MATTHIAS 
LAST UPDATED: 18 03 30
JAARGANG CONTROLLER
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jaargang extends CI_Controller{
    public function __construct()
	{
        parent::__construct();
        
        // Autoload
        $this->load->library('session');

		// Login validation
        // Redirect to home if no session started
        if(!$this->session->has_userdata('id')){
            redirect('/admin/index', 'location');
        }
    }

    // FLOW
    // Update jaargang
    public function update()
    {
        $this->load->model('jaargang_model');

        if($this->jaargang_model->get_byId($id) != null){
            // Get from db
            $jaargang = $this->jaargang_model->get_byId($id);
        }
        
        $jaargang->naam = $this->input->post('naam', TRUE);
        $jaargang->thema = $this->input->post('thema', TRUE);
        $jaargang->$info = $this->input->post('info', TRUE);
        $jaargang->beginTijdstip = $this->input->post('beginTijdstip', TRUE);
        $jaargang->eindTijdstip = $this->input->post('eindTijdstip', TRUE);

        if(isset($jaargang->$id)){
            // Update db
            $this->jaargang_model->update($jaargang);
        }else{
            // Add to db
            $this->jaargang_model->add($jaargang);
        }

        // Redir
        redirect('admin/jaargangbeheer');
    }
    
    // API
    // Deactivate jaargang
    public function end($id){
        if($id > 0)
        {
            $this->load->model('jaargang_model');

            // Get from db
            $jaargang = $this->jaargang_model->get_byId($id);

            // Deactivate
            $jaargang->actief = 0;

            // Update db
            $this->db->where('id', $jaargang->id);
            $this->db->update('Jaargang', $jaargang);

            // Output succes
            echo 'TRUE';
        }

        // Output failure
        echo 'FALSE';
    }
}

?>