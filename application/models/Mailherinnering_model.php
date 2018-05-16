<!-- 
    ERIK
	LAST UPDATED: 18 03 30
	MAILREMINDER MODEL
-->

<?php
class Mailherinnering_model extends CI_Model {
    /**
     * Haalt een mailherinnering op adhv id
     * @param int $id
     *  Id van mailherinnering
     */
    function get_HerinneringDag($datum)
    {
        $this->db->where(array('timer' => $datum));
        $query = $this->db->get('MailHerinnering');
        return $query->result();
    }
    /**
     * Haalt alle mailherinneringen
     */
    function getAll() {
        $this->db->order_by('timer', 'asc');
        $query = $this->db->get('MailHerinnering');
        return $query->result();
    }
    /**
     * Haalt alle personen in een mailherinneringen op
     * @param int $id
     *  Id van mailherinnering
     */
    function get_PersonenInReminder($reminderId)
    {
        $this->db->where(array('mailherinneringId' => $reminderId));
        $query = $this->db->get('PersoonInHerinnering');
        return $query->result();
    }
    /**
     * Voegt een mailherinnering op
     * @param mailherinnering $mailherinnering
     *  object van mailherinnering
     */
    function insert($herinnering) {
        $this->db->insert('MailHerinnering', $herinnering);
        return $this->db->insert_id();
    }
    /**
     * Past een mailherinnering aan
     * @param mailherinnering $mailherinnering
     *  object van mailherinnering
     */
    function update($herinnering) {
        $this->db->where('id', $herinnering->id);
        $this->db->update('MailHerinnering', $herinnering);
    }
    /**
     * Voegt een mailherinnering op adhv id
     * @param int $herinneringId
     *  object van mailherinnering
     */
    function delete($herinneringId) {
        $this->db->where('herinneringId', $herinneringId);
        $this->db->delete('MailHerinnering');
    }

}
?>