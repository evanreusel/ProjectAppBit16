<!--
    ERIK
    LAST UPDATED: 18 03 30
    SJABLON MODEL
-->

<?php
class Mailsjabloon_model extends CI_Model {

    function get($id)
    {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('Mailsjabloon');

        return $query->result()[0];
    }
    function getAll() {
        //$this->db->order_by('timer', 'asc');
        $query = $this->db->get('Mailsjabloon');
        return $query->result();
    }


    function update($mailsjabloon){
        $this->db->where('id', $mailsjabloon->id);
        $this->db->update('Mailsjabloon', $mailsjabloon);
    }

    function add($mailsjabloon){
        $this->db->insert('Mailsjabloon', $mailsjabloon);
        return $this->db->insert_id();
    }


//    function update($plaats) {
//        $this->db->where('id', $plaats->id);
//        $this->db->update('Plaats', $plaats);
//    }
//
//    function delete($id) {
//        $this->db->where('id', $id);
//        $this->db->delete('Plaats');
//    }
}
?>