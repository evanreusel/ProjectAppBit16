<!-- 
    TIM SWERTS
	LAST UPDATED: 18 03 30
	KEUZEOPTIE MODEL
-->

<?php
class KeuzeOptie_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }
    
    function get($id)
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
        return $query->result();

    }

        

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('KeuzeOptie');
    }
}


?>
