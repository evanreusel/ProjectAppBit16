<!-- 
    ERIK
	LAST UPDATED: 18 03 30
	MAILREMINDER MODEL
-->

<?php
class Mailreminder_model extends CI_Model {
    function get_HerinneringDag($datum)
    {
        $this->db->where(array('timer' => $datum));
        $query = $this->db->get('MailHerinnering');
        return $query->result();
    }
    function getAll() {
        $this->db->order_by('timer', 'asc');
        $query = $this->db->get('MailHerinnering');
        return $query->result();

    }
    function get_PersonenInReminder($reminderId)
    {
        $this->db->where(array('mailherinneringId' => $reminderId));
        $query = $this->db->get('PersoonInHerinnering');
        return $query->result();
    }

}
?>