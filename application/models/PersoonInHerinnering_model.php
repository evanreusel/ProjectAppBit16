<?php
/*
ERIK VAN REUSEL
LAST UPDATED: 19 05 18
PERSOON IN HERINNERING MODEL
*/

class PersoonInHerinnering_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    function get_byHerinneringId($id)
    {
        $this->db->where('mailherinneringId', $id);
        $query = $this->db->get('PersoonInHerinnering');
        return $query->result();
    }
    function insert($persoonInherinnering) {
        $this->db->insert('PersoonInHerinnering', $persoonInherinnering);
        return true;
    }


    function delete($herinneringId) {
        $this->db->where('mailherinneringId', $herinneringId);
        $this->db->delete('PersoonInHerinnering');
    }
}
    ?>