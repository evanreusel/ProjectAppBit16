<?php
/// TIM SWERTS
/// LAST UPDATED: 18 04 30
/// KEUZEOPTIE MODEL
///
/// Model voor de database manipultie van de tabel Keuzeoptie.
class Keuzeoptie_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }
    /// Functie voor het ophalen van de specifieke keuzeoptie op basis van een id.
    /**
	 * @param string $id
	 *  Id van de Keuzeoptie
 	*/
    function get_byId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('KeuzeOptie');
        return $query->row();
    }
    /// Ophalen van alle keuzeopties gesorteerd op basis van naam.
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('KeuzeOptie');
        return $query->result();
    }
    /// Functie voor het ophalen van alle keuzeopties die behoren tot een specifieke keuzemogelijkheid.
    /**
	 * @param string $id
	 *  Id van de Keuzemogelijkheid
 	*/
    function getAllByNaamWhereKeuzeMogelijkheid($id)
    {
        $this->db->where('keuzemogelijkheidId', $id);
        $query = $this->db->get('KeuzeOptie');
        return $query->result();
    }
    /// Functie voor de aanpassen van een keuzeoptie die mee wordt gegeven.
    /**
	 * @param stdClass $keuzeoptie
	 *  Object van de Keuzeoptie die aangepast moet worden
 	*/
    function update($keuzeoptie)
    {
        $this->db->where('id', $keuzeoptie->id);
        $this->db->update('KeuzeOptie', $keuzeoptie);
    }
    /// Functie voor de toevoegen van een keuzeoptie die mee wordt gegeven.
    /**
	 * @param stdClass $keuzeoptie
	 *  Object van de Keuzeoptie die toegevoegd moet worden
 	*/
    function add($keuzeoptie){
        $this->db->insert('KeuzeOptie', $keuzeoptie);
        return $this->db->insert_id();
    }
    /// Functie voor het verwijderen van de keuzeoptie waarvan het id wordt meegegeven.
    /**
	 * @param string $id
	 *  Id van de Keuzeoptie die verwijderd moet worden
 	*/
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('KeuzeOptie');
    }
}


?>