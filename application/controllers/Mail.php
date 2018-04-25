<!-- 
    ERIK
	LAST UPDATED: 18 03 30
	MAIL CONTROLLER
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function maakbericht()
    {
        $this->load->library('mailjet');
        echo json_encode($this->mailjet->maakBerichtObject("evanreusel@gmail.com", "Erik", "Onderwerp", "hoi", "Hoi html"));
    }
    public function verstuur()
    {
        $this->load->library('mailjet');
        $berichtobj = $this->mailjet->maakBerichtObject("evanreusel@gmail.com", "Erik", "Onderwerp", "hoi", "Hoi html");
        $Messages = array($berichtobj);
        echo json_encode($Messages);
        $mjobj = new stdClass();
        $mjobj->Messages = $Messages;
        echo $this->mailjet->verstuur($mjobj);

    }
    public function remindervandaag()
    {
        $this->load->model('mailreminder_model');
        $vandaag = date('Y-m-d');
        $mailRemindersVandaag = $this->mailreminder_model->get_ReminderDag($vandaag);
        echo json_encode($mailRemindersVandaag);
    }
    public function voegtoe()
    {
        $data['message'] = "Welcome admin | Login";
        $data['css_files'] = array();
        $data['view'] = 'mail_voegtoe';
        $this->load->model('mailsjabloon_model');
        $data['sjablonen'] = $this->mailsjabloon_model->getAll();
        $data['ontvangers'] = array("STUDENT", "DOCENTEN");
        //$data['css_files'] = array("login.css");
        $data['clearscreen'] = true;

        $this->load->view('template/main', $data);

    }

}
