<?php

// klasse voor gegevens van de activiteiten te beheren
class Keuzemogelijkheid_Model extends CI_Model {
    
    function __construct() {
        $this->load->database();
    }

    function get_byId($id)
    {
        $this->db->where($id);
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->row();
    }
    
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->result();
    }

    function getAllByNaamWithKeuzeOpties()
    {
        $activiteiten = $this->getAllByNaam();
        $this->load->model('keuzeoptie_model');

        foreach ($activiteiten as $activiteit) {
            $activiteit->keuzeopties = $this->keuzeoptie_model->getAllByNaamWhereKeuzeMogelijkheid($activiteit->id);
        }

        return $activiteiten;
    }
    
    function update($keuzemogelijkheid)
    {
        $this->db->where('id', $keuzemogelijkheid->id);
        $this->db->update('KeuzeMogelijkheid', $keuzemogelijkheid);
    }

    function add($keuzemogelijkheid){
        $this->db->insert('KeuzeMogelijkheid', $keuzemogelijkheid);
        return $this->db->insert_id();
    }

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('KeuzeMogelijkheid');
    }
   
}

?>
