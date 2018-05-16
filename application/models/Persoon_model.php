<?php
/*
TIM
LAST UPDATED: 18 03 30
PERSOON MODEL
*/

class Persoon_model extends CI_Model {
    // =================================================================================================== GREIF MATTHIAS
    /**
	 * Haal een persoon op uit de database met de meegegeven id en token
	 * @param int $id
     * id van de op te halen persoon
	 * @param int $token
     * token van de op te halen pesoon
 	*/  
    function get_byIdAndToken($id, $token)
    {
        $this->db->where(array('id' => $id, 'token' => $token));
        $query = $this->db->get('Persoon');

        return $query->result()[0];
    }

    /**
	 * Haal een persoon op uit de database met de meegegeven id
	 * @param int $id
     * id van de op te halen persoon
 	*/ 
    function get_byId($id)
    {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('Persoon');

        if($query->result() != null){
            return $query->result()[0];
        }
        
        return null;
    }
    // =================================================================================================== /GREIF MATTHIAS

    /**
	 * Haal een persoon op uit de database met de meegegeven id
	 * @param int $id
     * id van de op te halen persoon
 	*/ 
    function get_Id($id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get('Persoon');
        return $query->row(); 
    }

    /**
	 * Haal alle personen op uit de database
 	*/ 
    function get_All()
    {
        //$this->db->where(array('id' => $id));
        $query = $this->db->get('Persoon');

        if($query->result() != null){
            return $query->result();
        }

        return null;
    }

    /**
	 * Haal alle deelnemers op uit de database die zijn ingeschreven als deelnemer
 	*/ 
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

    /**
	 * Haal alle personen op uit de database die zijn ingeschreven als vrijwilliger
 	*/ 
    function get_AllVrijwilligers()
    {
        $this->load->model("VrijwilligersInShift");

        $query = $this->db->select('*')->from('Persoon')
            ->join('VrijwilligersInShift', 'Persoon.id = VrijwilligersInShift.persoonId', 'left')
            ->where(array('soort' => "VRIJWILLIGER"))
            ->get();
        $vrijwilligers = $query->result();
        // get their shifts
        $this->load->model("VrijwilligersInShift_model");
        $vrijwilligersInShiftObject = $this->VrijwilligersInShift_model->getAll();
        //$shiften = array_map(create_function('$o', 'return $o->shiftId;'), $vrijwilligersInShiftObject);
        foreach ($vrijwilligers as $vrijwilliger) {
            $shiften = array_filter(
                $vrijwilligersInShiftObject,
                function ($e) use($vrijwilliger)  {
                    return $e->persoonId == $vrijwilliger;
                }
            );


        }
    }

    /**
	 * Haal alle vrijwilligers op uit de database die niet zijn ingeschreven voor een activiteit
 	*/ 
    function get_NietIngeschrevenVrijwilligers($jaargangid)
    {
        $query = $this->db->select('*')->from('Persoon')
        ->join('VrijwilligersInShift', 'Persoon.id = VrijwilligersInShift.persoonId', 'left')
        ->where(array('soort' => "VRIJWILLIGER", 'jaarId' => $jaargangid))
        ->get();
        $nietingeschreven = array_filter(
            $query->result(),
            function ($e)  {
                return $e->shiftId == null;
            }
        );

        return $nietingeschreven;
    }

   /**
	 * Haal alle deelnemers op uit de database die niet zijn ingeschreven voor een activiteit
     * @param int $jaargang
     * het jaargang van de op te halen personen
 	*/  
    function get_NietIngeschrevenDeelnemers($jaargang)
    {
        $query = $this->db->select('*')->from('Persoon')
            ->join('KeuzeoptieVanDeelnemer', 'Persoon.id = KeuzeoptieVanDeelnemer.persoonId', 'left')
            ->where(array('soort' => "DEELNEMER", 'jaarId' => $jaargang))
            ->get();
        $nietingeschreven = array_filter(
            $query->result(),
            function ($e)  {
                return $e->keuzeoptieId == null;
            }
        );
        return $nietingeschreven;
    }

 /**
	 * voeg een persoon toe aan de database
     * @param stdclass $persoon
     * de toe te voegen persoon
 	*/  
    function insert($persoon){
        //haal het huidige jaargangid op om later te koppelen aan de persoon
        $this->load->model("Jaargang_model");
        $jaargang = $this->Jaargang_model->getActief();
        $persoon->jaarid = $jaargang->id;
        $persoon->token = $this->generatetoken();

        $this->db->insert('Persoon', $persoon);
    }

    /**
	 * genereer een unieke token
 	*/ 
    function generatetoken(){
        do{
        $token = bin2hex(random_bytes(30));
        }while($this->get_bytoken($token) != null);

        return $token;
    }

    // =================================================================================================== GREIF MATTHIAS
    /**
	 * zoek een persoon in de database met een bepaald token
     * @param token
     * de token voor de op te zoeken persoon
 	*/ 
    function get_bytoken($token){        
        $this->db->where('token', $token);
        $query = $this->db->get('Persoon');
        return $query->row();
    }
    // =================================================================================================== /GREIF MATTHIAS

   
    /**
	 *     Haal alle medewerkers die voor een activiteit zijn ingeschreven voor een meegegeven jaargang
     *     samen met de gekoppelde activiteiten 
     * @param jaargangid
     * de jaargang van de op te zoeken medewerkers
 	*/ 
    function getallwithactiviteit($jaargangId){

        //tussenvariabele ophalen
        $query = $this->db->where('jaarid', $jaargangId);
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

        //indien de medewerker is ingeschreven wordt de info over de activiteit opgehaald
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
    
     /**
	 * haal alle personen van een bepaald jaargang
     * @param $jaargangid
     * het jaargang van de op te halen personen
 	*/ 
    function getAll_ofJaargang($jaargangId){
        $query = $this->db->where('jaarid', $jaargangId);
        $query = $this->db->get('Persoon');

        return $query->result();
    }

     /**
	 * Alle vrijwilligers ophalen met hun activiteiten van een bepaald jaargang
     * @param $jaargangid
     * het jaargang van de op te halen personen
 	*/ 
    function getAll_ofJaargang_withShift($jaargangId){
        // Get all Personen of Jaargang
        $personen = $this->getAll_ofJaargang($jaargangId);

        $vrijwilligers = new SplObjectStorage;
        foreach($personen as $persoon){            
            // Get Shifts
            $query = $this->db->where('persoonid', $persoon->id);
            $query = $this->db->get('VrijwilligersInShift');
            $data = $query->result();

            $shiften = array();

            //keuzemogelijkheden per persoon ophalen
            if(!empty($data)){
            foreach($data as $item){
            $query = $this->db->where('id', $item->shiftId);
            $query = $this->db->get('Shift');
            $shift = $query->row();

            //keuzemogelijkheid koppelen aan keuzeoptie
            $query = $this->db->where('id', $shift->taakId);
            $query = $this->db->get('Taak');
            $shift->taak = $query->row();

            //keuzemogelijkheid koppelen aan keuzeoptie
            $query = $this->db->where('id', $shift->taak->keuzemogelijkheidId);
            $query = $this->db->get('Keuzemogelijkheid');
            $shift->taak->keuzemogelijkheid = $query->row();

            $shiften[] = $shift;
            }
        $vrijwilligers[$persoon] = $shiften;
        }

        }

        return $vrijwilligers;
    }
    // =================================================================================================== /MATTHIAS
    
    /**
	 * haal alle personen op
 	*/ 
    function getAll()
    {

        $query = $this->db->get('Persoon');

        return $query->result();
    }
}
?>