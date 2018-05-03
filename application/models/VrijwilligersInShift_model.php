<?php
class VrijwilligersInShift_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }

    function get_byShiftId($id)
    {
        $this->db->where('shiftId', $id);
        $query = $this->db->get('VrijwilligersInShift');
        return $query->result();
    }

    function getAllByShiftId($shiftId)
    {
        $this->db->where('shiftId', $shiftId);
        $shiften = $this->db->get('VrijwilligersInShift');

        // $this->load->model('Persoon_model');
        // foreach ($shiften as $shift) {
        //     $shift->persoon = $this->Persoon_model->get_Id();
        // }

        return $shiften->result(); 
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
    

    function delete($shiftId, $persoonId){
        $this->db->where('persoonId', $persoonId);
        $this->db->where('shiftId',$shiftId);
        $this->db->delete('VrijwilligersInShift');
    }
}
?>