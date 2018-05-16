<?php
/*
GREIF MATTHIAS 
LAST UPDATED: 18 03 30
JAARGANG CONTROLLER
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jaargang extends CI_Controller{
    /**
	 * Default Contstructor
 	*/
    public function __construct()
	{
        parent::__construct();
        
        // Autoload
        $this->load->library('session');

		// Redirect to home if no session started
        $this->load->model('beheer_model');
        if(!$this->session->has_userdata('id') || $this->beheer_model->get_byId($this->session->userdata('id')) == null){
            redirect('/admin/index', 'location');
        }
    }



    // FLOW
    /**
	 * Update jaargang
 	*/
    public function update()
    {
        $this->load->model('jaargang_model');

        $id = $this->input->post('id', TRUE);

        if($this->jaargang_model->get_byId($id) != null){
            // Get from db
            $jaargang = $this->jaargang_model->get_byId($id);
        }else{
            // Set defaults
            $jaargang->naam = '';
            $jaargang->thema = '';
            $jaargang->info = '';
            $jaargang->beginTijdstip = '';
            $jaargang->eindTijdstip = '';
            $jaargang->actief = 1;
        }
        
        // Check vals
        if($this->input->post('naam', TRUE) != null){
            $jaargang->naam = $this->input->post('naam', TRUE);
        }

        if($this->input->post('thema', TRUE) != null){
            $jaargang->thema = $this->input->post('thema', TRUE);
        }

        if($this->input->post('info', TRUE) != null){
            $jaargang->info = $this->input->post('info', TRUE);
        }

        if($this->input->post('beginTijdstip', TRUE) != null){
            $jaargang->beginTijdstip = $this->input->post('beginTijdstip', TRUE);
        }

        if($this->input->post('eindTijdstip', TRUE) != null){
            $jaargang->eindTijdstip = $this->input->post('eindTijdstip', TRUE);
        }

        if(isset($jaargang->id)){
            // Update db
            $this->jaargang_model->update($jaargang);
        }else{
            // Add to db
            $this->jaargang_model->add($jaargang);
        }

        // Redir
        redirect('admin/dash/jaargangoverzicht');
    }
    
    // API
    /**
	 * Beeindig jaargang
     * @param string $id
	 *  Id van jaargang
 	*/
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