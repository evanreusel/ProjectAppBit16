<!-- 
    TIM SWERTS
	LAST UPDATED: 18 03 30
	KEUZEMOGELIJKHEID MODEL
-->

<?php

// klasse voor gegevens van de activiteiten te beheren
class Keuzemogelijkheid_Model extends CI_Model {
    
    function __construct() {
        $this->load->database();
    }

    function get_byId($id)
    {
        $this->db->where($id);
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->row();
    }
    
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->result();
    }

    function getAllByNaamWithKeuzeOpties()
    {
        $keuzemogelijkheden = $this->getAllByNaam();
        $this->load->model('keuzeoptie_model');

        foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
            $keuzemogelijkheid->keuzeopties = $this->keuzeoptie_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);
        }

        return $keuzemogelijkheden;
    }

    // =================================================================================================== GREIF MATTHIAS
    function getAll_byJaargangId($id){
        // Get Keuzemogelijkheid by jaargangId
        $this->db->where('jaargangId', $id);
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->result();
    }

    function getAllWithKeuzeOpties_byJaargangId($id){
        // Get all keuzemogelijkheden
       $keuzemogelijkheden = $this->getAll_byJaargangId($id);

        // Get all opties voor keuzemogelijkheden
        $this->load->model('keuzeoptie_model');
        foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
            $keuzemogelijkheid->keuzeopties = $this->keuzeoptie_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);
        }

        return $keuzemogelijkheden;
    }
    // =================================================================================================== /GREIF MATTHIAS

    function update($keuzemogelijkheid)
    {
        $this->db->where('id', $keuzemogelijkheid->id);
        $this->db->update('KeuzeMogelijkheid', $keuzemogelijkheid);
    }

    function add($keuzemogelijkheid){
        $this->db->insert('KeuzeMogelijkheid', $keuzemogelijkheid);
        return $this->db->insert_id();
    }

    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('KeuzeMogelijkheid');
    }
   
}

?>
