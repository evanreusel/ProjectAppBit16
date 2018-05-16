<?php
// TIM SWERTS
// LAST UPDATED : 18/05/15
// VrijwilliggersInShift_Model

/// Model voor beheren van de tabel shift van de database.
class VrijwilligersInShift_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }

    /**
     * Functie voor het opvragen van een alle vrijwilliger bij een specifieke shift shift.
	 * @param string $id
	 *  Id van de shift
 	*/
    function get_byShiftId($id)
    {
        $this->db->where('shiftId', $id);
        $query = $this->db->get('VrijwilligersInShift');
        return $query->result();
    }
    /**
     * Functie voor het ophalen van alle vrijwilligers voor een specifieke shift.
	 * @param string $shiftId
	 *  Id van de shift
 	*/
    function getAllByShiftId($shiftId)
    {
        
        $shiften = $this->get_byShiftId($shiftId);

        $this->load->model('Persoon_model');
        foreach ($shiften as $shift) {
            $shift->persoon = $this->Persoon_model->get_Id($shift->persoonId);
        }

        return $shiften; 
    }
    /**
     * Functie voor het ophalen van alle shiften voor een specifieke persoon.
	 * @param string $id
	 *  Id van de persoon
 	*/
    function get_byPersoonId($id)
    {
        $this->db->where('persoonId', $id);
        $query = $this->db->get('VrijwilligersInShift');
        return $query->result();
    }
    /// Functie voor het ophalen van alle vrijwilligers
    function getAll()
    {
        $query = $this->db->get('VrijwilligersInShift');
        return $query->result();
    }
    /**
     * Functie voor het toevoegen van een specifieke vrijwilliger voor een specifieke shift.
	 * @param stdClass $VrijwilligerInShift
	 *  Object met data over de vrijwilliger en de shift.
 	*/
    function add($VrijwilligerInShift){
        $this->db->insert('VrijwilligersInShift', $VrijwilligerInShift);
    }
    
    /**
     * Functie voor het verwijderen van een specifieke vrijwilligers voor een specifieke shift.
	 * @param string $shiftId
     * @param string $persoonId
	 * 
 	*/
    function delete($shiftId, $persoonId){
        $this->db->where('persoonId', $persoonId);
        $this->db->where('shiftId',$shiftId);
        $this->db->delete('VrijwilligersInShift');
    }
}
?>