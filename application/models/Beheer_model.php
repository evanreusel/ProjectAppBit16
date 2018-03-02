<?php
class Beheer_model extends CI_Model {
    function login($mail, $pass)
    {
        $this->db->where(array('mail' => $mail, 'pass' => $pass));
        $query = $this->db->get('Beheer');
        return json_encode($query->result());
    }
}
?>