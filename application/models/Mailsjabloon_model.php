<!--
    ERIK
    LAST UPDATED: 18 03 30
    SJABLON MODEL
-->

<?php
class Mailsjabloon_model extends CI_Model {
    /**
     * Haalt een mailsjabloon op adhv id
     * @param sjabloon $id
     *  Id van sjabloon
     */
    function get($id)
    {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('Mailsjabloon');

        return $query->result()[0];
    }
    /**
     * Haalt alle mailsjablonen op

     */
    function getAll() {
        //$this->db->order_by('timer', 'asc');
        $query = $this->db->get('Mailsjabloon');
        return $query->result();
    }
    /**
     * Past een mailsjabloon aan adhv id
     * @param sjabloon $id
     *  Id van sjabloon
     */

    function update($mailsjabloon){
        $this->db->where('id', $mailsjabloon->id);
        $this->db->update('Mailsjabloon', $mailsjabloon);
    }
    /**
     * Voegt een mailsjabloon toe adhv id
     * @param sjabloon $id
     *  Id van sjabloon
     */
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