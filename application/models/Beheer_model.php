<?php
class Beheer_model extends CI_Model {
    function login($mail, $pass)
    {
        $this->db->where(array('mail' => 'tims@admins.project', 'pass' => 'e2b85840b1c0c1fc0732bc2116e2fadf'));
        $query = $this->db->get('Beheer');
        return $query->result();
    }
}
?>