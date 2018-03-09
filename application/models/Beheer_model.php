<?php
class Beheer_model extends CI_Model {
    function login($username, $pass)
    {
        $this->db->where(array('username' => $username));
        $query = $this->db->get('Beheer');

        print_r($query->row());

        if (password_verify($query->row()->password, $hash)) {
            return $query->result();
        }
    }
}
?>