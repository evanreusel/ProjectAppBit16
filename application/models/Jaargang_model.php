<?php

class Jaargang_model extends CI_Model {
    
    function __construct() {
        $this->load->database();
    }

    function get_byId($id)
    {
        $this->db->where('id', $id);
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

    function end($jaargang){
        $this->db->where('id', $jaargang->id);
        $this->db->update('Jaargang', $jaargang);
    }

    function getWithKeuzemogelijkheidWithOpties_byId($id){
        $this->load->model('keuzemogelijkheid_model');

        $output = [
            'jaargang' => $this->get_byId($id),
            'keuzemogelijkheden' => $keuzemogelijkheid_model->getAllWithKeuzeOpties_byJaargangId($id);
        ]
        
        return $output;

    }
}

?>
