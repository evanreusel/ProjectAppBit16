<?php
/*
TIM
LAST UPDATED: 18 03 30
PERSOON MODEL
*/

class Persoon_model extends CI_Model {    
    function get_byIdAndToken($id, $token)
    {
        $this->db->where(array('id' => $id, 'token' => $token));
        $query = $this->db->get('Persoon');

        return $query->result()[0];
    }

    function get_byId($id)
    {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('Persoon');

        if($query->result() != null){
            return $query->result()[0];
        }
        
        return null;
    }

    function get_Id($id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get('Persoon');
        return $query->row(); 
    }
    function get_All()
    {
        //$this->db->where(array('id' => $id));
        $query = $this->db->get('Persoon');

        if($query->result() != null){
            return $query->result();
        }

        return null;
    }
    function get_AllDeelnemers()
    {
        $this->db->where(array('soort' => "DEELNEMER"));
        $query = $this->db->get('Persoon');

        if($query->result() != null)
        {
            return $query->result();
        }

        return null;

    }
    function get_AllVrijwilligers()
    {
        $this->db->where(array('soort' => "VRIJWILLIGER"));

        $query = $this->db->get('Persoon');
        $vrijwilligers = $query->result();
        print_r($vrijwilligers);
        if($vrijwilligers != null)
        {
            $this->load->model("VrijwilligersInShift_model");

            foreach ($vrijwilligers as $vrijwilliger) {
                $shiften = $this->VrijwilligersInShift_model->get_byPersoonId($vrijwilliger->id);
                $vrijwilliger->shiften = array();
                print_r($shiften);
                if(count($shiften) !=0)
                {
                    $vrijwilliger->shiften = array_map(create_function('$o', 'return $o->shiftId;'), $shiften);
                }

            }
            return $vrijwilligers;
        }


        return null;
    }
    function get_NietIngeschrevenVrijwilligers()
    {
        $query = $this->db->select('*')->from('Persoon')
        ->join('VrijwilligersInShift', 'Persoon.id = VrijwilligersInShift.persoonId', 'left')
        ->where(array('soort' => "VRIJWILLIGER"))
        ->get();
        $nietingeschreven = array_filter(
            $query->result(),
            function ($e)  {
                return $e->shiftId == null;
            }
        );
        return $query->result();

    }
    function insert($persoon){
        //haal het huidige jaargangid op om later te koppelen aan de persoon
        $this->load->model("Jaargang_model");
        $jaargang = $this->Jaargang_model->getActief();
        $persoon->jaarid = $jaargang->id;
        $persoon->token = $this->generatetoken();

        $this->db->insert('persoon', $persoon);
    }

    function generatetoken(){
        do{
        $token = bin2hex(random_bytes(30));
        }while($this->get_bytoken($token) != null);

        return $token;
    }

    function get_bytoken($token){        
        $this->db->where('token', $token);
        $query = $this->db->get('Persoon');
        return $query->row();
    }

    //Haal alle medewerkers die voor een activiteit zijn ingeschreven 
    //samen met de gekoppelde activiteiten
    function getallwithactiviteit(){
        //jaargang ophalen
        $this->load->model("jaargang_model");
        $jaar = $this->jaargang_model->getActief();

        //tussenvariabele ophalen
        $query = $this->db->where('jaarid', $jaar->id);
        $query = $this->db->get('Persoon');
        $personen = $query->result();

        $deelnemers = new SplObjectStorage;

        foreach($personen as $persoon){
        //keuzeoptie ophalen
        $query = $this->db->where('persoonid', $persoon->id);
        $query = $this->db->get('KeuzeoptieVanDeelnemer');
        $data = $query->result();

        //keuzemogelijkheden per persoon ophalen
        $keuzeopties = array();

        if($data != null){
        foreach($data as $item){
        $query = $this->db->where('id', $item->keuzeoptieId);
        $query = $this->db->get('KeuzeOptie');
        $keuzeoptie = $query->row();

        //keuzemogelijkheid koppelen aan keuzeoptie
        $query = $this->db->where('id', $keuzeoptie->keuzemogelijkheidId);
        $query = $this->db->get('KeuzeMogelijkheid');
        $keuzeoptie->keuzemogelijkheid = $query->row();

        $keuzeopties[] = $keuzeoptie;
        }
        }

        $deelnemers[$persoon] = $keuzeopties;
        }

        return $deelnemers;
    }

    // =================================================================================================== MATTHIAS
    
    
    function getAll_ofJaargang($jaargangId){
        $query = $this->db->where('jaarid', $jaargangId);
        $query = $this->db->get('Persoon');

        return $query->result();
    }

    function getAll_ofJaargang_withShift($jaargangId){
        // Get all Personen of Jaargang
        $personen = $this->getAll_ofJaargang($jaargangId);

        $vrijwilligers = new SplObjectStorage;
        foreach($personen as $persoon){            
            // Get Shifts
            $query = $this->db->where('persoonid', $persoon->id);
            $query = $this->db->get('vrijwilligersinshift');
            $data = $query->result();

            $shiften = array();

            //keuzemogelijkheden per persoon ophalen
            if(!empty($data)){
            foreach($data as $item){
            $query = $this->db->where('id', $item->shiftId);
            $query = $this->db->get('shift');
            $shift = $query->row();

            //keuzemogelijkheid koppelen aan keuzeoptie
            $query = $this->db->where('id', $shift->taakId);
            $query = $this->db->get('taak');
            $shift->taak = $query->row();

            //keuzemogelijkheid koppelen aan keuzeoptie
            $query = $this->db->where('id', $shift->taak->keuzemogelijkheidId);
            $query = $this->db->get('keuzemogelijkheid');
            $shift->taak->keuzemogelijkheid = $query->row();

            $shiften[] = $shift;
            }
        $vrijwilligers[$persoon] = $shiften;
        }

        }

        return $vrijwilligers;
    }
    // =================================================================================================== /MATTHIAS
    
    function getAll($id)
    {

        $query = $this->db->get('Persoon');

        return $query->result();
    }
}
?>