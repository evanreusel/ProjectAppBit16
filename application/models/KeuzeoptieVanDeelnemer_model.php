<?php
// LAATST GEÜPDATET OP 16/05/18

// ====================================================================== PROOST DAAN
class KeuzeoptieVanDeelnemer_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }
    /// opvragen van keuzeoptie door id mee te geven
    function get_byKeuzeoptieId($id)
    {
        $this->db->where('keuzeoptieId', $id);
        $query = $this->db->get('KeuzeoptieVanDeelnemer');
        return $query->result();
    }
    /// opvragen van persoon door id mee te geven
    function get_byPersoonId($id)
    {
        $this->db->where('persoonId', $id);
        $query = $this->db->get('KeuzeoptieVanDeelnemer');
        return $query->result();
    }
    /// toevoegen van nieuwe keuzeoptie van een persoon aan de database
    function add($KeuzeoptieVanDeelnemer){
        $this->db->insert('KeuzeoptieVanDeelnemer', $KeuzeoptieVanDeelnemer);

    }
    
    /// Verwijderen van keuzeoptie van een persoon uit de database
    function delete($keuzeoptieId, $persoonId){
        $this->db->where('persoonId', $persoonId);
        $this->db->where('keuzeoptieId',$keuzeoptieId);
        $this->db->delete('KeuzeoptieVanDeelnemer');
    }
}
// ====================================================================== / PROOST DAAN
?>