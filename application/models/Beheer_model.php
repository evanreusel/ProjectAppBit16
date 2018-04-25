<?php
/*
GREIF MATTHIAS
LAST UPDATED: 18 03 30
BEHEER MODEL
*/

class Beheer_model extends CI_Model {
    function __construct()
    {
 		$this->load->database();
    }

    function login($username, $pass)
    {
        $this->db->where(array('username' => $username));
        $query = $this->db->get('Beheer');

        if (password_verify($pass, $query->row()->pass)) {
            return $query->result()[0];
        }
    }

    function login_byId($id, $pass)
    {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('Beheer');

        if (password_verify($pass, $query->row()->pass)) {
            return $query->result()[0];
        }

        return null;
    }

    function getAll()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('Beheer');
        return $query->result();
    }

    function get_byId($id)
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

    function add($admin){
        $this->db->insert('Beheer', $admin);
        return $this->db->insert_id();
    }

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('Beheer');
    }
}
?>