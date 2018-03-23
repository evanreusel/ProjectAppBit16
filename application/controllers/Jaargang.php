<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuzemogelijkheid extends CI_Controller{
    
     public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
    }
}

?>