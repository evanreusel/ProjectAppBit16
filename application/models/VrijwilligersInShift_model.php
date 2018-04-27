<?php
class VrijwilligersInShift_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }
    
    function get_byPersoonId($id)
    {
        $this->db->where('persoonId', $id);
        $query = $this->db->get('VrijwilligersInShift');
        return $query->result();
    }
    function add($VrijwilligerInShift){
        $this->db->insert('VrijwilligersInShift', $VrijwilligerInShift);
        // return $this->db->insert_id();
    }
    

    function delete($persoonId, $shiftId){
        $this->db->where('persoonId', $persoonId);
        $this->db->where('shiftId'),$shiftId);
        $this->db->delete('VrijwilligersInShift');
    }
}
?>