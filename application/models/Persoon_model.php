<!-- 
    TIM
	LAST UPDATED: 18 03 30
	PERSOON MODEL
-->

<?php
class Persoon_model extends CI_Model {
    function get_byId($id, $token)
    {
        $this->db->where(array('id' => $id, 'token' => $token));
        $query = $this->db->get('Persoon');

        return $query->result()[0];
    }
}
?>