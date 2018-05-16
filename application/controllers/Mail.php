
<?php

/*
    ERIK
	LAST UPDATED: 18 05 13
	MAIL CONTROLLER
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/// Controller voor mailfunctionaliteiten
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
        $this->load->model('Mailherinnering_model');
        $this->load->model('persoon_model');
        $this->load->model('mailsjabloon_model');
        $this->load->library('mailjet');
        $vandaag = date('Y-m-d');
        $mailRemindersVandaag = $this->Mailherinnering_model->get_HerinneringDag($vandaag);
        foreach ($mailRemindersVandaag as $mailReminder)
        {
            $this->mailjet->leegBerichtObject();
            $mailsjabloon = $this->mailsjabloon_model->get($mailReminder->sjabloonId);
            $ontvangers = array();
            $persoonIds = $this->Mailherinnering_model->get_PersonenInReminder($mailReminder->id);
            foreach ($persoonIds as $persoonId)
            {
                $persoon = $this->persoon_model->get_byId($persoonId->persoonId);
                $teZoekenTags = array("#naam", "#token");
                $teVervangenMet = array("$persoon->naam", "$persoon->token");

                $sjabloonIngevuld = str_replace($teZoekenTags, $teVervangenMet, $mailsjabloon->inhoud);
                $mailObject = $this->mailjet->maakBerichtObject($persoon->mail, $persoon->naam, $mailsjabloon->naam, $sjabloonIngevuld, $sjabloonIngevuld);
                $this->mailjet->voegBerichtObjectToe($mailObject);
            }
            echo PHP_EOL;
            echo PHP_EOL;
            echo json_encode($this->mailjet->toonBerichtObject());
            echo PHP_EOL;
            echo PHP_EOL;

            echo $this->mailjet->verstuur();
        }
    }
    public function maakHerinnering()
    {
        $this->load->model("Mailherinnering_model");
        $this->load->model("PersoonInHerinnering_model");
        //print_r($_POST);
        $id = $this->input->post('id');
        $personen = $this->input->post('personen');
        $personen = array_unique($personen);
        $datum = $this->input->post('datum');
        $mailsjabloon = $this->input->post('mailsjabloon');

        // nieuwe herinnering aanmaken
        $mailherinnering = new stdClass();
        $mailherinnering->timer = $datum;
        $mailherinnering->sjabloonId = $mailsjabloon;
        if ($id == 0)
        {
            $id = $this->Mailherinnering_model->insert($mailherinnering);
        }
        else
        {
            $mailherinnering->id = $id;
            $this->Mailherinnering_model->update($mailherinnering);
        }
        //pas personen in herinnering aan
        $this->PersoonInHerinnering_model->delete($id);
        foreach ($personen as $persoon)
        {
            $persoonInHerinnering = new stdClass();
            $persoonInHerinnering->mailherinneringId = $id;
            $persoonInHerinnering->persoonId = $persoon;
            $this->PersoonInHerinnering_model->insert($persoonInHerinnering);
        }
    }
    public function verwijderHerinnering()
    {
        $id = $this->input->post('id');
        $this->load->model("Mailherinnering_model");
        $this->Mailherinnering_model->delete($id);
        $this->overzicht();
    }

    public function overzicht()
    {
        $data['message'] = "Mail Reminder Overzicht";
        $data['css_files'] = array();
        $data['view'] = 'mail_overzicht';

        $this->load->model('Mailherinnering_model');
        $this->load->model('mailsjabloon_model');
        $this->load->model('jaargang_model');

        $jaargangid = $this->jaargang_model->getActief();

        $reminders = $this->Mailherinnering_model->getAll();
        $data['keuzemogelijkheden'] = $this->get_personen();
        $data['nietingeschrevenDeelnemers']  = $this->Persoon_model->get_NietIngeschrevenDeelnemers($jaargangid);
        $data['nietingeschrevenVrijwilligers']  = $this->Persoon_model->get_NietIngeschrevenVrijwilligers();
        $nietingeschrevenVrijwilligers = $this->Persoon_model->get_NietIngeschrevenVrijwilligers();
        foreach ($reminders as $reminder) {
            $reminder->ontvangers =  $this->Mailherinnering_model->get_PersonenInReminder($reminder->id);
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
    public function get_NietIngeschreven()
    {
        $this->load->model('Persoon_model');
        print_r($this->Persoon_model->get_NietIngeschrevenVrijwilligers());
        echo PHP_EOL;
        echo PHP_EOL;
        print_r($this->Persoon_model->get_NietIngeschrevenDeelnemers());
    }
    private function get_personen()
    {
        // get keuzemogelijkheden
        $this->load->model('Keuzemogelijkheid_model');
        $this->load->model('KeuzeoptieVanDeelnemer_model');
        $this->load->model('Taken_model');
        $this->load->model('Shiften_model');
        $this->load->model('Persoon_model');
        $this->load->model("VrijwilligersInShift_model");

        $keuzemogelijkheden = $this->Keuzemogelijkheid_model->getAllByNaamWithKeuzeOpties();
        //print_r($keuzemogelijkheden);
        foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
            $keuzemogelijkheid->verbergen = true;
            //get taken
            $taken = $this->Taken_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);
            //echo ("AANTAL TAKEN VOOR " . $keuzemogelijkheid->naam . ": " . count($taken));
            $keuzemogelijkheid->taken = array();
            $keuzemogelijkheid->taken = $taken;

            // get shiften
            foreach ($keuzemogelijkheid->taken as $taak) {
                $shiften = $this->Shiften_model->getAllByNaamWhereTaakId($taak->id);
                $taak->verbergen = true;
                $taak->shiften = $shiften;
                foreach ($taak->shiften as $shift) {
                    //get personen in shift
                    $vrijwilligersInshiftObject  = $this->VrijwilligersInShift_model->getAllByShiftId($shift->id);
                    //print_r($vrijwilligersInshiftObject);
                    if (count($vrijwilligersInshiftObject) !=0)
                    {
                        $taak->verbergen = false;
                        $keuzemogelijkheid->verbergen = false;
                    }
                    $vrijwilligers = array_map(create_function('$o', 'return $o->persoon;'), $vrijwilligersInshiftObject);
                    $shift->vrijwilligers = $vrijwilligers;

                }
            }
            //get deelnemers van keuzeopties

            foreach ($keuzemogelijkheid->keuzeopties as $keuzeoptie) {
                $keuzeoptie->personen = array();
                $keuzeoptie->verbergen = true;
                $keuzeoptieVanDeelnemers = $this->KeuzeoptieVanDeelnemer_model->get_byKeuzeoptieId($keuzeoptie->id);
                if (count($keuzeoptieVanDeelnemers) !=0)
                {
                    $keuzemogelijkheid->verbergen = false;
                    $keuzeoptie->verbergen = false;
                }
                foreach ($keuzeoptieVanDeelnemers as $keuzeoptieVanDeelnemer) {
                    $deelnemendPersoon = $this->Persoon_model->get_byId($keuzeoptieVanDeelnemer->persoonId);
                    array_push($keuzeoptie->personen, $deelnemendPersoon);
                }
            }

        }
        return $keuzemogelijkheden;

        //get niet ingeschreven personen


    }
    public function getPersonenInHerinnering($id)
    {
    $this->load->model("PersoonInHerinnering_model");
    $personenInHerinnering = $this->PersoonInHerinnering_model->get_byHerinneringId($id);
    echo json_encode($personenInHerinnering);
    }
    private function get_personenv2()
    {

    }

}
