<?php
/*
GREIF MATTHIAS
LAST UPDATED: 18 03 30
BEHEER MODEL
*/

class Beheer_model extends CI_Model {
    /**
	 * Default Constructor
 	*/
    function __construct()
    {
 		$this->load->database();
    }
    
    /**
	 * Controleer inloggegevens van gebruiker
	 * @param string $username
	 *  Gebruikersnaam van gebruiker
	 * @param string $pass
	 *  Wachtwoord van gebruiker
 	*/
    function login($username, $pass)
    {
        $this->db->where(array('username' => $username));
        $query = $this->db->get('Beheer');

        if (password_verify($pass, $query->row()->pass)) {
            return $query->result()[0];
        }
    }

    /**
	 * Controleer inloggegevens van gebruiker bij Id
	 * @param int $id
	 *  Id van gebruiker
	 * @param string $pass
	 *  Wachtwoord van gebruiker
 	*/
    function login_byId($id, $pass)
    {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('Beheer');

        if (password_verify($pass, $query->row()->pass)) {
            return $query->result()[0];
        }

        return null;
    }

    /**
	 * Vraag alle administrators op
 	*/
    function getAll()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('Beheer');
        return $query->result();
    }

    /**
	 * Vraag administratorinformatie op bij Id
	 * @param int $id
	 *  Id van administrator
 	*/
    function get_byId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('Beheer');
        return $query->row();
    }

    /**
	 * Update administratorgegevens
	 * @param string $admin
	 *  Admin Object die informatie van administrator bevat
 	*/
    function update($admin)
    {
        $this->db->where('id', $admin->id);
        $this->db->update('Beheer', $admin);
    }

    /**
	 * Update administratorgegevens
	 * @param string $admin
	 *  Admin Object die informatie van administrator bevat
 	*/
    function add($admin){
        $this->db->insert('Beheer', $admin);
        return $this->db->insert_id();
    }

    /**
	 * Verwijder administrator
	 * @param int $id
	 *  Id van administrator
 	*/
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('Beheer');
    }
}
?>