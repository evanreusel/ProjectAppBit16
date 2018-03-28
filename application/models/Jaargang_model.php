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
        $this->db->order_by('naam', 'DESC');
        $query = $this->db->get('Jaargang');
        return $query->result();
    }

    function getAllbyBeginTijdstip(){
        $this->db->order_by('beginTijdstip', 'DESC');
        $query = $this->db->get('Jaargang');
        return $query->result();
    }
}

?>
