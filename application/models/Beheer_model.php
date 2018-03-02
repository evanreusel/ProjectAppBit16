<?php
class Beheer_model extends CI_Model {
    function login($username, $pass)
    {
        $this->db->where(array('username' => $username, 'pass' => $pass));
        $query = $this->db->get('Beheer');
        return $query->result();
    }
}
?>