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

        // =================================================================================================== GREIF MATTHIAS
        // Autoload
        $this->load->library('session');

        // Redirect to home if no session started
        $this->load->model('beheer_model');
        if (!$this->session->has_userdata('id') || $this->beheer_model->get_byId($this->session->userdata('id')) == null) {
            redirect('/admin/index', 'location');
        }
        // =================================================================================================== /GREIF MATTHIAS
    }

    public function maakbericht()
    {
        $this->load->library('mailjet');
        echo json_encode($this->mailjet->maakBerichtObject( "evanreusel@gmail.com", "Erik", "Onderwerp", "hoi", "Hoi html"));
    }
    public function verstuur()
    {
        $this->load->library('mailjet');
        $berichtobj = $this->mailjet->maakBerichtObject(    "evanreusel@gmail.com", "Erik", "Onderwerp", "hoi", "Hoi html");
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
        $data['message'] = "Mail Reminder Overzicht";
        $data['css_files'] = array();
        $data['view'] = 'mail_overzicht';
        $this->load->model('mailreminder_model');
        $this->load->model('mailsjabloon_model');
        $reminders = $this->mailreminder_model->getAll();
        foreach ($reminders as $reminder) {
            $reminder->ontvangers =  $this->mailreminder_model->get_PersonenInReminder($reminder->id);
            $reminder->sjabloon = $this->mailsjabloon_model->get($reminder->sjabloonId);

        }
        $data['mailsjablonen'] = $this->mailsjabloon_model->getAll();
        $data['reminders'] = $reminders;
        //$data['css_files'] = array("login.css");
        $data['clearscreen'] = true;

        $this->load->view('template/main', $data);

    }
    public function voegtoe()
    {
        $this->load->model('persoon_model');
        $ontvangers = $this->persoon_model->get_All();
        $data['ontvangers'] = $ontvangers;
//        print_r($ontvangers);
        $data['message'] = "Mail Reminder Toevoegen";
        $data['css_files'] = array();
        $data['view'] = 'mail_voegtoe';
        $data['clearscreen'] = true;

        $this->load->view('template/main', $data);

    }
    public function get_personen()
    {
        // get keuzemogelijkheden
        $this->load->model('Keuzemogelijkheid_model');
        $this->load->model('Taken_model');
        $this->load->model('Shiften_model');
        $this->load->model("VrijwilligersInShift_model");

        $keuzemogelijkheden = $this->Keuzemogelijkheid_model->getAllByNaamWithKeuzeOpties();
        //print_r($keuzemogelijkheden);
        foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
            //get taken
            $taken = $this->Taken_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);
            echo ("AANTAL TAKEN VOOR " . $keuzemogelijkheid->naam . ": " . count($taken));
            $keuzemogelijkheid->taken = array();
            $keuzemogelijkheid->taken = $taken;

            // get shiften
            foreach ($keuzemogelijkheid->taken as $taak) {
                $shiften = $this->Shiften_model->getAllByNaamWhereTaakId($taak->id);
                $taak->shiften = $shiften;
                foreach ($taak->shiften as $shift) {
                    //get personen in shift
                    $vrijwilligersInshiftObject  = $this->VrijwilligersInShift_model->get_byShiftId($shift->id);
                    print_r($vrijwilligersInshiftObject);
                    $vrijwilligers = array_map(create_function('$o', 'return $o->persoon;'), $vrijwilligersInshiftObject);
                    $shift->vrijwilligers = $vrijwilligers;

                }
            }

        }
        print_r($keuzemogelijkheden);
        // get vrijwilligers zonder shiften


        //get keuzemogelijkheden (hierboven)
        //get keuzeopties
        //get deelnemers by keuzeopties
        //get deelnemers zonder keuzeopties

    }

}
