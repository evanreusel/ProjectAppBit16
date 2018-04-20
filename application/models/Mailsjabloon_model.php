<!--
    ERIK
    LAST UPDATED: 18 03 30
    SJABLON MODEL
-->

<?php
class Mailsjabloon_model extends CI_Model {

    function getAll() {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('Mailsjabloon');
        return $query->result();
    }

    function insert($sjabloon) {
        $this->db->insert('Sjabloon', $sjabloon);
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