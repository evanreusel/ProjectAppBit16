<?php

class Jaargang_model extends CI_Model {
    
    function __construct() {
        $this->load->database();
    }

    function get_byId($id)
    {
        $this->db->where($id);
        $query = $this->db->get('Jaargang');
        return $query->row();
    }
    
    function getAll()
    {
        $query = $this->db->get('Jaargang');
        return $query->result();
    }

    function getAllByJaargang() {
        $this->db->order_by('naam', 'desc');
        $query = $this->db->get('Jaargang');
        return $query->result();
    }
}

?>
