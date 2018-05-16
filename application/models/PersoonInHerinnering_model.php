<?php
/*
ERIK VAN REUSEL
LAST UPDATED: 19 05 18
PERSOON IN HERINNERING MODEL
*/

class PersoonInHerinnering_model extends CI_Model
{
    /**
     * Default constructor
     */
    function __construct()
    {
        $this->load->database();
    }
    /**
     * Haalt een emailherinnering op
     * @param int $id
     *  Id van emailherinnering
     */
    function get_byHerinneringId($id)
    {
        $this->db->where('mailherinneringId', $id);
        $query = $this->db->get('PersoonInHerinnering');
        return $query->result();
    }
    /**
     * Maakt een nieuwe record aan voor persoon in herinnering
     * @param int $id
     *  PersoonInHerinnering object
     */
    function insert($persoonInherinnering) {
        $this->db->insert('PersoonInHerinnering', $persoonInherinnering);
        return true;
    }

    /**
     * Verwijderd de persoon in een specifieke herinnering
     * @param int $id
     *  Id van Herinnering
     */
    function delete($herinneringId) {
        $this->db->where('mailherinneringId', $herinneringId);
        $this->db->delete('PersoonInHerinnering');
    }
}
    ?>