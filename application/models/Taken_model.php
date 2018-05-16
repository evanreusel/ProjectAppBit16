<?php
/// TIM SWERTS
///	LAST UPDATED: 18 03 30
///	TAAK MODEL
///
/// Model voor beheren van de tabel taken van de database.
class Taken_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }

    /**
     * Functie voor het opvragen van een specifieke taak.
	 * @param string $id
	 *  Id van de taak
 	*/
    function get_byId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('Taak');
        return $query->row();
    }
    /// Functie voor het ophalen van alle taken gesorteerd op basis van naam.
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('Taak');
        return $query->result();
    }

    /**
     * Functie voor ophalen van alle taken die behoren tot een welbepaalde keuzemogelijkheid.
	 * @param string $id
	 *  Id van de keuzemogelijkheid
 	*/
    function getAllByNaamWhereKeuzeMogelijkheid($id)
    {
        $this->db->where('keuzemogelijkheidId', $id);
        $query = $this->db->get('Taak');
        return $query->result();

    }

    /**
     * Functie voor het ophalen van alle shiften die tot een taak behoren met een specifieke keuzemogelijkheid.
	 * @param string $id
	 *  Id van de taak
 	*/
    function getAllWithShiften_byKeuzemogelijkheidId($id){
        /// Ga alle taken ophalen onder een bepaalde keuzemgelijkheid
       $taken = $this->getAllByNaamWhereKeuzeMogelijkheid($id);

        /// Ga alle shiften ophalen onder een bepaalde taak
        $this->load->model('Shiften_model');
        foreach ($taken as $taak) {
            $taak->shiften = $this->Shiften_model->getAllByNaamWhereTaakId($taak->id);
        }

        return $taken;
    }

     /**
      * Functie voor het aanpassen van een taak die mee wordt geleverd als object.
	 * @param stdClass $taak
	 *  Object van de taak die aangepast moet worden
 	*/
    function update($taak)
    {
        $this->db->where('id', $taak->id);
        $this->db->update('Taak', $taak);
    }

     /**
      * Functie voor het toevoegen van een taak die mee wordt geleverd als object.
	 * @param stdClass $taak
	 *  Object van de taak die toegevoegd moet worden
 	*/
    function add($taak){
        $this->db->insert('Taak', $taak);
        return $this->db->insert_id();
    }
    
    /**
     * Functie voor het verwijderen van een taak die mee wordt geleverd als id.
	 * @param string $id
	 *  Id van de taak die verwijderd moet worden
 	*/
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('Taak');
    }
}


?>