<!-- 
    TIM
	LAST UPDATED: 18 03 30
	PERSOON MODEL
-->

<?php
class Mailreminder_model extends CI_Model {
    function get_HerinneringDag($datum)
    {
        $this->db->where(array('timer' => $datum));
        $query = $this->db->get('MailReminder');

        return $query->result();
    }
    function getAll() {
        $this->db->order_by('timer', 'asc');
        $query = $this->db->get('Mailreminder');
        return $query->result();

    }
    function get_PersonenInReminder($reminderId)
    {
        $this->db->where(array('mailreminderId' => $reminderId));
        $query = $this->db->get('PersoonInReminder');
        return $query->result();
    }

}
?>