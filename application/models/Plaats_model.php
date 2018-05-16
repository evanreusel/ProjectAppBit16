<?php
/*
DAAN PROOST
LAATST GEUPDATET: 16/05/18
PLAATS MODEL
*/

class Plaats_model extends CI_Model {


     /// functie om alle plaatsen uit de database op te vragen

    function getAllByPlaatsnaam() {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('Plaats');
        return $query->result();
    }

    /**
     * functie om plaats op te vragen met id
     * @param string $id
     * id van de plaats
     */
    function getPlaatsById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('Plaats');
        return $query->row();
    }
    /**
     * functie om plaats in de database toe te voegen
     * @param StdClass $plaats
     * plaatsobject om in de database toe te voegen
     */
        function insert($plaats) {
        $this->db->insert('Plaats', $plaats);
        return $this->db->insert_id();
    }
        /**
     * functie om plaatsobject te updaten
     * @param StdClass $plaats
     * plaatsobject om in de database te updaten
     */

    function update($plaats) {
        $this->db->where('id', $plaats->id);
        $this->db->update('Plaats', $plaats);
    }

       /**
     * functie om plaats te verwijderen uit de database per id
     * @param string $id
     * id van de plaats
     */

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('Plaats');
    }
}
?>