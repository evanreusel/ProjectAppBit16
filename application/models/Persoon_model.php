<!-- 
    TIM
	LAST UPDATED: 18 03 30
	PERSOON MODEL
-->

<?php
class Persoon_model extends CI_Model {
    function __construct()
    {
 		$this->load->database();
    }
    
    function get_byId($id, $token)
    {
        $this->db->where(array('id' => $id, 'token' => $token));
        $query = $this->db->get('Persoon');

        return $query->result()[0];
    }

    function insert($persoon){        
        //haal het huidige jaargangid op om later te koppelen aan de persoon
        $this->load->model("Jaargang_model");
        $jaargang = $this->Jaargang_model->getActief();
        $persoon['jaarid'] = $jaargang->id;

        $persoon['token'] = $this->generatetoken();

        $this->db->insert('persoon', $persoon);
    }

    function generatetoken(){
        do{
        $token = bin2hex(random_bytes(30));
        }while($this->get_bytoken($token) != null);

        return $token;
    }

    function get_bytoken($token){        
        $this->db->where('token', $token);
        $query = $this->db->get('Persoon');
        return $query->row();
    }
}
?>