<?php
class Beheer_model extends CI_Model {
    function login($username, $pass)
    {
        $this->db->where(array('username' => $username));
        $query = $this->db->get('Beheer');

        if (password_verify($pass, $query->row()->pass)) {
            return $query->result()[0];
        }
    }
}
?>