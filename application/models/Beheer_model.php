<?php

class Beheer_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function login($mail, $pass)
    {
        $this->db->where(array('mail' => $mail, 'pass' => $pass));
        $query = $this->db->get('beheer');
        return $query->result();
    }

    // function get($id)
    // {
    //     $this->db->where('id', $id);
    //     $query = $this->db->get('bmw_adres');	// genereert SELECT * FROM bmw_auto WHERE id = $id
    //     return $query->row();                   // 1 auto-object
    // }

    // function getByCountryName($countryname)
    // {
    //     $this->db->where('land', $countryname);
    //     $query = $this->db->get('bmw_adres');	// genereert SELECT * FROM bmw_auto WHERE id = $id
    //     return $query->row();                   // 1 adres-object
    // }
}
?>