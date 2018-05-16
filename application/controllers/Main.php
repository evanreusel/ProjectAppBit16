<!-- 
    GREIF MATTHIAS
	LAST UPDATED: 18 05 16
	MAIN CONTROLLER
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/// Controller voor loginfunctionaliteit
class Main extends CI_Controller {
	/**
	 * Default Constructor
 	*/
	public function __construct()
	{
		parent::__construct();
		
		// Autoload
        $this->load->library('session');
	}

	/**
	 * Inlogmogelijkheid voor gebruikers door middel van link
	 * @param int $id
	 *  Id van gebruiker
	 * @param string $token
	 *  Beveiligingtoken van gebruiker
 	*/
	public function signin($id = null, $token = null)
	{
		// Check login vals
		if(!is_null($id) && !is_null($token)){
			// Get data from db
			$this->load->model('persoon_model');
			$login_return = $this->persoon_model->get_byId($id, $token);

			// Set session vars if succeeded
			if($login_return != ''){
                $this->session->set_userdata('id', $login_return->id);
                $this->session->set_userdata('role', $login_return->soort);

				// Redir to specific controller
                redirect('/' . strtolower($login_return->soort) . '/dash', 'location');
			}
        }

        // Redir to default page
        redirect('/main/index', 'location');
	}
}
