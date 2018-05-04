<!-- 
    TIM SWERTS
	LAST UPDATED: 18 03 30
	Shiften MODEL
-->

<?php
class Shiften_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }
    
    function get_byId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('Shift');
        return $query->row();
    }
    
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('Shift');
        return $query->result();
    }


    function getAllByNaamWhereTaakId($id)
    {
        $this->db->where('taakId', $id);
        $query = $this->db->get('Shift');
        return $query->result();

    }

    function update($shift)
    {
        $this->db->where('id', $shift->id);
        $this->db->update('Shift', $shift);
    }

    function add($shift){
        $this->db->insert('Shift', $shift);
        return $this->db->insert_id();
    }
    

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('Shift');
    }
}


?>