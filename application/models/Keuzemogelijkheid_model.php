<?php

// klasse voor gegevens van de activiteiten te beheren
class Keuzemogelijkheid_Model extends CI_Model {
    
    function __construct() {
        
        $this->load->database();
        
    }

    function get($id)
    {
        $this->db->where($id);
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->row();
    }
    
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->result();
    }

    function getAllByNaamWithKeuzeOpties()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('KeuzeMogelijkheid');
        $activiteiten = $query->result();

        $this->load->model('KeuzeMogelijkheid');

        foreach ($activiteiten as $activiteit) {
            $activiteit->keuzeopties=
                $this->KeuzeOptie_Model->getAllByNaamWhereKeuzeMogelijkheid($activiteit->id);
        }

        return $activiteiten;
    }
    
    function insertKeuzemogelijkheid($naam, $plaatsId, $beginDatum, $eindDatum, $deadline) 
    {
        $keuzeMogelijkheid = new stdClass();
        $keuzeMogelijkheid->naam = $naam;
        $keuzeMogelijkheid->plaatsId = $plaatsId;
        $keuzeMogelijkheid->beginDatum = $beginDatum;
        $keuzeMogelijkheid->eindDatum = $eindDatum;
        $keuzeMogelijkheid->deadline = $deadline;
        $keuzeMogelijkheid->jaargangId = 0;
        $this->db->insert('KeuzeMogelijkheid', $keuzeMogelijkheid);
        return $this->db->insert_id();
    }
    
    function deleteKeuzemogelijkheid ($id)
    {
     $this->db->where($id);
     $query = $this->db->delete('KeuzeMogelijkheid');   
    }
   
}

?>
