<?php
class Beheer_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function login($mail, $pass)
    {
        $this->db->where(array('mail' => $mail, 'pass' => $pass));
        $query = $this->db->get('Beheer');
        return $query->result();
    }
}
?>