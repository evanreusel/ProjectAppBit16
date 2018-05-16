<?php
//TIM SWERTS
//LAST UPDATED: 18 03 30
//KEUZEMOGELIJKHEID MODEL
/// Klasse voor gegevens van de activiteiten te beheren
class Keuzemogelijkheid_Model extends CI_Model {
    /**
     * Default constructor
 	*/
    function __construct() {

        $this->load->database();
    }

    /**
     * Functie voor het ophalen van de specifieke keuzemogelijkheid op basis van een id
	 * @param string $id
	 *  Id van de Keuzeoptie die gezocht moet worden
 	*/
    function get_byId($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->row();
    }
    
    /**
     * Ophalen van alle keuzemogelijkheden gesorteerd op basis van naam
 	*/
    function getAllByNaam($jaargangid)
    {
        $this->db->order_by('naam', 'asc');
        $this->db->where('jaargangId', $jaargangid);
        $query = $this->db->get('KeuzeMogelijkheid');
        return $query->result();
    }
    
    /**
     * Ophalen van alle keuzemogelijkheden samen met de onderliggende keuzeopties. Regel 36 zorgt ervoor dat alle keuzeopties bij de juiste keuzemogelijkheid worden geplaatst
 	*/
    function getAllByNaamWithKeuzeOpties($jaargangid)
    {
        $keuzemogelijkheden = $this->getAllByNaam();
        $this->load->model('Keuzeoptie_model');

        foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
            $keuzemogelijkheid->keuzeopties = $this->Keuzeoptie_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);
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
        $this->load->model('Keuzeoptie_model');
        foreach ($keuzemogelijkheden as $keuzemogelijkheid) {
            $keuzemogelijkheid->keuzeopties = $this->Keuzeoptie_model->getAllByNaamWhereKeuzeMogelijkheid($keuzemogelijkheid->id);
        }

        return $keuzemogelijkheden;
    }
    // =================================================================================================== /GREIF MATTHIAS

    /**
     * Functie voor de aanpassen van een keuzemogelijkheid die mee wordt gegeven
	 * @param stdClass $keuzemogelijkheid
	 *  Id van de Keuzemogelijkheid die aangepast moet worden
     */
    function update($keuzemogelijkheid)
    {
        $this->db->where('id', $keuzemogelijkheid->id);
        $this->db->update('KeuzeMogelijkheid', $keuzemogelijkheid);
    }

    /**
     * Functie voor de toevoegen van een keuzemogelijkheid die mee wordt gegeven
	 * @param stdClass $keuzemogelijkheid
	 *  Id van de Keuzemogelijkheid die toegevoegd moet worden
     */
    function add($keuzemogelijkheid){
        $this->db->insert('KeuzeMogelijkheid', $keuzemogelijkheid);
        return $this->db->insert_id();
    }
    
    /**
     * Functie voor het verwijderen van de keuzemogelijkheid waarvan het id wordt meegegeven
	 * @param string $id
	 *  Id van de Keuzemogelijheid die verwijderd moet worden
 	*/
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('KeuzeMogelijkheid');
    }
   
}

?>
