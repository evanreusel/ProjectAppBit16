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
            $this->mailjet->leegBerichtObject();
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
            echo PHP_EOL;
            echo PHP_EOL;
            echo json_encode($this->mailjet->toonBerichtObject());
            echo PHP_EOL;
            echo PHP_EOL;

            //echo $this->mailjet->verstuur();
        }
}
    public function overzicht()
    {
        $data['message'] = "Welcome admin | Login";
        $data['css_files'] = array();
        $data['view'] = 'mail_overzicht';
        //$data['css_files'] = array("login.css");
        $data['clearscreen'] = true;

        $this->load->view('template/main', $data);

    }

}
