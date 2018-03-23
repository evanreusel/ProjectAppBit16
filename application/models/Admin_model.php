<?php

class Admin_model extends CI_Model {

function __construct()
    {
 		$this->load->database();
    }

    function getAll()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('Beheer');
        return $query->result();
    }

    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('Beheer');
        return $query->row();
    }

    function update($admin)
    {
        $this->db->where('id', $admin->id);
        $this->db->update('Beheer', $admin);
    }

    function new($admin){
        $this->db->insert('Beheer', $admin);
        return $this->db->insert_id();
    }

    function verwijder($id){
        $this->db->where('id', $id);
        $this->db->delete('Beheer');
    }
}

?>