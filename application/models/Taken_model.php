<!-- 
    TIM SWERTS
	LAST UPDATED: 18 03 30
	TAAK MODEL
-->

<?php
class Taken_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }
    
    function get_byId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('Taak');
        return $query->row();
    }
    
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('Taak');
        return $query->result();
    }

    function getAllByNaamWhereKeuzeMogelijkheid($id)
    {
        $this->db->where('keuzemogelijkheidId', $id);
        $query = $this->db->get('Taak');
        return $query->result();

    }

    function update($taak)
    {
        $this->db->where('id', $taak->id);
        $this->db->update('Taak', $taak);
    }

    function add($taak){
        $this->db->insert('Taak', $taak);
        return $this->db->insert_id();
    }
    

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('Taak');
    }
}


?>