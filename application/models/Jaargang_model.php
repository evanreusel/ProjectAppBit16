<!-- 
    GREIF MATTHIAS
    LAST UPDATED: 18 03 30
    JAARGANG MODEL
-->

<?php

class Jaargang_model extends CI_Model {
    /**
	 * Default Constructor
 	*/
    function __construct() {
        $this->load->database();
    }

    /**
	 * Vraag informatie over jaargang
	 * @param int $id
	 *  Id van jaargang
     * @retval Jaargang
     *  Jaargang
 	*/
    function get_byId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('Jaargang');
        return $query->row();
    }
    
    /**
	 * Vraag alle jaargangen op
     * @retval List<Jaargang>
     *  Jaargang lijst
 	*/
    function getAll()
    {
        $query = $this->db->get('Jaargang');
        return $query->result();
    }

    /**
	 * Vraag alle jaargangen op gesorteerd op naam
     * @retval List<Jaargang>
     *  Jaargang lijst
 	*/
    function getAllByJaargang() {
        $this->db->order_by('naam', 'DESC');
        $query = $this->db->get('Jaargang');
        return $query->result();
    }

    /**
	 * Vraag alle jaargangen op gesorteerd op begintijdstip
     * @retval List<Jaargang>
     *  Jaargang lijst
 	*/
    function getAllbyBeginTijdstip(){
        $this->db->order_by('beginTijdstip', 'DESC');
        $query = $this->db->get('Jaargang');
        return $query->result();
    }

    /**
	 * Beeindig jaargang
	 * @param Jaargang $jaargang
	 *  Jaargang Object dat verwijderd moet worden
 	*/
    function end($jaargang){
        $this->db->where('id', $jaargang->id);
        $this->db->update('Jaargang', $jaargang);
    }   

    /**
	 * Vraag actieve jaargang op
     * @retval Jaargang
     *  Jaargang
 	*/
    function getActief(){
        $this->db->where('actief', 1);
        $query = $this->db->get('Jaargang');
        return $query->row();
    }

    /**
	 * Update jaargang
     * @param Jaargang $jaargang
	 *  Jaargang Object dat aangepast word
 	*/
    function update($jaargang){
        $this->db->where('id', $jaargang->id);
        $this->db->update('Jaargang', $jaargang);
    }

    /**
	 * Voeg jaargang toe
     * @param Jaargang $jaargang
	 *  Jaargang Object dat toegevoegd word
     * @retval int
     *  Id van jaargang dat toegevoegd word
 	*/
    function add($jaargang){
        $this->db->insert('Jaargang', $jaargang);
        return $this->db->insert_id();
    }

    /**
	 * Vraag jaargang op met keuzemogelijkheden
     * @param int $id
	 *  Id van jaargang
     * @retval List<Jaargang, Keuzemogelijkheid>
     *  Lijst met Objects die Jaargang met Keuzemogelijkheid bevatten
 	*/
    function getWithKeuzemogelijkheidWithOpties_byId($id){
        $this->load->model('keuzemogelijkheid_model');

        $output = [
            'jaargang' => $this->get_byId($id),
            'keuzemogelijkheden' => $this->keuzemogelijkheid_model->getAllWithKeuzeOpties_byJaargangId($id)
        ];
        
        return $output;
    }
}

?>
