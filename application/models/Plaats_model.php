<!-- 
    DAAN
    LAST UPDATED: 18 03 30
    PLAATS MODEL
-->

<?php
class Plaats_model extends CI_Model {

    function getAllByPlaatsnaam() {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('Plaats');
        return $query->result();
    }
    
        function insert($plaats) {
        $this->db->insert('Plaats', $plaats);
        return $this->db->insert_id();
    }

    function update($plaats) {
        $this->db->where('id', $plaats->id);
        $this->db->update('Plaats', $plaats);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('Plaats');
    }
}
?>