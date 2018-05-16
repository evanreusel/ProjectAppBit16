<!-- 
    TIM SWERTS
	LAST UPDATED: 18 03 30
	Shiften MODEL
-->

<?php
/// Model voor het beheren van de tabel shiften in de database
class Shiften_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }

    /**
     * Functie voor het ophalen van een specifieke shift op basis van een id.
	 * @param string $id
	 *  Id van de shift
 	*/
    function get_byId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('Shift');
        return $query->row();
    }
    /// Functie voor het ophalen van alle shiften gesorteerd op basis van naam.
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('Shift');
        return $query->result();
    }

     /**
      * Functie voor het ophalen van alle shiften die bij een specifieke taak horen. Alle gevonden shiften worden gesorteerd op basis van naam.
	 * @param string $id
	 *  Id van de taak
 	*/
    function getAllByNaamWhereTaakId($id)
    {
        $this->db->where('taakId', $id);
        $query = $this->db->get('Shift');
        return $query->result();

    }

     /**
      * Functie voor het aanpassen van een welbepaalde shift die meegegeven wordt als object.
	 * @param stdClass $shift
	 *  Object van een shift die aangepast moet worden
 	*/
    function update($shift)
    {
        $this->db->where('id', $shift->id);
        $this->db->update('Shift', $shift);
    }

     /**
     * Functie voor het tevoegen van een welbepaalde shift die meegegeven wordt als object.
	 * @param stdClass $shift
	 *  Object van een shift die toegevoegd moet worden
 	*/
    function add($shift){
        $this->db->insert('Shift', $shift);
        return $this->db->insert_id();
    }
    
     /**
     * Functie voor het verwijderen van een welbepaalde shift waarvan de id meegegeven word.
	 * @param string $id
	 *  Id van de shift de verwijderd moet worden
 	*/
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('Shift');
    }
}


?>