<?php
class KeuzeoptieVanDeelnemer_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }

    function get_byKeuzeoptieId($id)
    {
        $this->db->where('keuzeoptieId', $id);
        $query = $this->db->get('KeuzeoptieVanDeelnemer');
        return $query->result();
    }

    function getAllByKeuzemogelijkheidId($id)
    {
        $this->db->where('keuzemogelijkheidId', $id);
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->result(); 
    }
    
    function get_byPersoonId($id)
    {
        $this->db->where('persoonId', $id);
        $query = $this->db->get('KeuzeoptieVanDeelnemer');
        return $query->result();
    }

    function add($VrijwilligerInShift){
        $this->db->insert('VrijwilligerInShift', $VrijwilligerInShift);
        // return $this->db->insert_id();
    }

    function addKeuzeoptieVanDeelnemer($KeuzeoptieVanDeelnemer){
        echo print_r($KeuzeoptieVanDeelnemer);
        $this->db->insert('KeuzeoptieVanDeelnemer', $KeuzeoptieVanDeelnemer);
        // return $this->db->insert_id();
    }
    

    function delete($shiftId, $persoonId){
        $this->db->where('persoonId', $persoonId);
        $this->db->where('keuzeoptieId',$shiftId);
        $this->db->delete('KeuzeoptieVanDeelnemer');
    }
}
?>