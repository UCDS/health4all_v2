<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hospital_model
 *
 * @author gokul
 */
class hospital_model extends CI_Model {
    //put your code here
    function __construct() {
        parent::__construct();
    }
    
    function get_hospitals(){
        $this->db->select('*')
                ->from('hospital');
        $query = $this->db->get();
        return $query->result();
    }
}
