<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuzeOptie_Model
 *
 * @author deswe
 */
class KeuzeOptie_Model extends CI_Model{
    
    
    function __construct() {

        $this->load->database();

    }
    
    function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('KeuzeOptie');
        return $query->row();
    }
    
    function getAllByNaam()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('KeuzeOptie');
        return $query->result();
    }

    function getAllByNaamWhereKeuzeMogelijkheid($id)
    {
        $this->db->where('keuzemogelijkheidId', $id);
        $query = $this->db->get('KeuzeOptie');
        return $query->result();

    }

    function insertKeuzeoptie($naam, $plaatsId, $min, $max,$beginTijdstip, $eindTijdstip) 
    {
        $keuzeoptie = new stdClass();
        $keuzeoptie->naam = $naam;
        $keuzeoptie->beginTijdstip = $beginTijdstip;
        $keuzeoptie->eindTijdstip = $eindTijdstip;
        $keuzeoptie->min = $min;
        $keuzeoptie->max =$max;
        /*$keuzeoptie->plaatsId = $plaatsId;*/
        
        $this->db->insert('Keuzeoptie', $keuzeoptie);
        return $this->db->insert_id();
    }
}


?>
