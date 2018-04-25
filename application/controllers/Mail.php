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
        $this->load->model('persoon_model');
        $this->load->model('mailsjabloon_model');
        $this->load->library('mailjet');
        $vandaag = date('Y-m-d');
        $mailRemindersVandaag = $this->mailreminder_model->get_HerinneringDag($vandaag);
        foreach ($mailRemindersVandaag as $mailReminder)
        {
            $mailsjabloon = $this->mailsjabloon_model->get($mailReminder->sjabloonId);
            $ontvangers = array();
            $persoonIds = $this->mailreminder_model->get_PersonenInReminder($mailReminder->id);
            foreach ($persoonIds as $persoonId)
            {
                $persoon = $this->persoon_model->get_byId($persoonId->persoonId);
                //TODO: Maak vulsjabloon()

                $mailObject = $this->mailjet->maakBerichtObject($persoon->mail, $persoon->naam, $mailsjabloon->naam, $mailsjabloon->inhoud, $mailsjabloon->inhoud);
                $this->mailjet->voegBerichtObjectToe($mailObject);
            }
        echo json_encode($this->mailjet->toonBerichtObject());
        }
        //echo json_encode($mailRemindersVandaag);
        //{"id":"1","naam":"Greif Matthias","adres":"","woonplaats":"","nummer":"R0656559","mail":"r0656559@student.thomasmore.be","soort":"STUDENT","token":"0prol2vZH3IgYBMapBI2","jaarId":"1"}
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
