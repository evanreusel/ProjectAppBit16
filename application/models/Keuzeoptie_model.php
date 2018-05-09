<!-- 
    TIM SWERTS
	LAST UPDATED: 18 03 30
	KEUZEOPTIE MODEL
-->

<?php
class Keuzeoptie_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }
    
    function get_byId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('KeuzeOptie');
        return $query->row();
    }
    
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('KeuzeOptie');
        return $query->result();
    }

    function getAllByNaamWhereKeuzeMogelijkheid($id)
    {
        $this->db->where('keuzemogelijkheidId', $id);
        $query = $this->db->get('KeuzeOptie');
        $keuzeoptie = $query->result();

        $this->load->model('Plaats_model');

        $keuzeoptie->plaats = $this->Plaats_model->getPlaatsById($keuzeoptie->plaatsId);
        return $keuzeoptie;
    }

    function update($keuzeoptie)
    {
        $this->db->where('id', $keuzeoptie->id);
        $this->db->update('KeuzeOptie', $keuzeoptie);
    }

    function add($keuzeoptie){
        $this->db->insert('KeuzeOptie', $keuzeoptie);
        return $this->db->insert_id();
    }
    

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('KeuzeOptie');
    }
}


?>