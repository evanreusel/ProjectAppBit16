<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 03 30
    JAARGANG MODEL
-->

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

    function getActief(){
        $this->db->where('actief', 1);
        $query = $this->db->get('Jaargang');
        return $query->row();
    }

    function update($jaargang){
        $this->db->where('id', $jaargang->id);
        $this->db->update('Jaargang', $jaargang);
    }

    function add($jaargang){
        $this->db->insert('Jaargang', $jaargang);
        return $this->db->insert_id();
    }

    function getWithKeuzemogelijkheidWithOpties_byId($id){
        $this->load->model('keuzemogelijkheid_model');

        $output = [
            'jaargang' => $this->get_byId($id),
            'keuzemogelijkheden' => $this->keuzemogelijkheid_model->getAllWithKeuzeOpties_byJaargangId($id)
        ];
        
        return $output;

    }
}

?>
