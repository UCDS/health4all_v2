<?php

class Hospital_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function get_hospitals(){  //Function that returns all the details of the hospitals.
        $filters = array();
        if($this->input->post('hospital_type')){
            $filters['hospital_type'] = $this->input->post('hospital_type');
        }
        $this->db->select('*')
            ->from('hospital_information')
            ->where($filters);
        
        $query = $this->db->get();
        $result = $query->result();
        
        return $result;
    }
    
    function get_hospital_types(){
        $this->db->select('*')
            ->from('hospital_type');
        
        $query = $this->db->get();
        $result = $query->result();
        
        return $result;
    }
    
    function get_hospital_sub_types(){
        $this->db->select('*')
            ->from('hospital_subtypes');
        
        $query = $this->db->get();
        $result = $query->result();
        
        return $result;
    }
    
    function get_ip_op_summary_by_hospital($long_period, $short_period){
        //Set short_period to zero for today.        
        $today = date("Y-m-d");
        $dbdefault = $this->load->database('default',TRUE);
        $hospitals_status = array();
        $this->db->select('hospital_id, host_name,username,database_name,database_password')
        ->from('hospitals');
        $query=$this->db->get();
        $result = $query->result();
        foreach($result as $r){
            $this->db->select('hospital_information.*')
            ->from('hospital_information')               
            ->where('hospital_information.hospital_id',"$r->hospital_id");
            $query2 = $this->db->get();
            
            $current_hospital = $query2->result();
            if(sizeof($current_hospital) == 0){
                continue;
            }
            $current_hospital = $current_hospital[0];
            $config['hostname'] = "$r->host_name";
            $config['username'] = "$r->username";
            $config['password'] = "$r->database_password";
            $config['database'] = "$r->database_name";
            $config['dbdriver'] = 'mysql';
            $config['dbprefix'] = '';
            $config['pconnect'] = TRUE;
            $config['db_debug'] = TRUE;
            $config['cache_on'] = FALSE;
            $config['cachedir'] = '';
            $config['char_set'] = 'utf8';
            $config['dbcollat'] = 'utf8_general_ci';
            $dbt=$this->load->database($config,TRUE);
            $query = $dbt->query("SELECT  total_ip_registrations_long_period, total_op_registrations_long_period,"
                . "total_ip_registrations_short_period, total_op_registrations_short_period,"
                . "'$current_hospital->hospital_id' hospital_id, "
                . "'$current_hospital->hospital_name' hospital_name, '$current_hospital->hospital_short_name' hospital_short_name, '$current_hospital->district' district, '$current_hospital->latitude_n' lattitude, '$current_hospital->longitude_e' longitude FROM (
                SELECT COUNT( * ) total_ip_registrations_long_period
                    FROM  patient_visit
                    WHERE (admit_date = '$today') AND visit_type = 'IP'
                ) AS total_ip_registrations_long_period
                CROSS JOIN (
                SELECT COUNT( * ) total_op_registrations_long_period
                    FROM  patient_visit
                    WHERE (admit_date = '$today') AND visit_type = 'OP'
                ) AS total_op_registrations_long_period
                CROSS JOIN(
                    SELECT COUNT(*) total_ip_registrations_short_period
                    FROM patient_visit
                    WHERE (admit_date = '$today') AND visit_type = 'IP'
                ) AS total_ip_registrations_short_period "  
                . "CROSS JOIN(
                    SELECT COUNT(*) total_op_registrations_short_period
                    FROM patient_visit
                    WHERE (admit_date = '$today') AND visit_type = 'OP'
                ) AS total_op_registrations_short_period");
            
            $hospitals_status[] = $query->row();
        }
        return $hospitals_status;
    }
	function add_hospital(){
        $get_hospital = array();
        if($this->input->post('hospital')){
            $get_hospital['hospital'] = $this->input->post('hospital');
        }   //if
		 if($this->input->post('place')){
             $get_hospital['place'] = $this->input->post('place');
        } 
        if($this->input->post('hospital_short_name')){
            $get_hospital['hospital_short_name'] = $this->input->post('hospital_short_name');
        }   //if        
		if($this->input->post('district')){
             $get_hospital['district'] = $this->input->post('district');
        }
		if($this->input->post('state')){
             $get_hospital['state'] = $this->input->post('state');
        }		
        if($this->input->post('type1')){
             $get_hospital['type1'] = $this->input->post('type1');
        }
        if($this->input->post('type2')){
             $get_hospital['type2'] = $this->input->post('type2');
        }
        if($this->input->post('type3')){
             $get_hospital['type3'] = $this->input->post('type3');
        }
        if($this->input->post('type4')){
             $get_hospital['type4'] = $this->input->post('type4');
        }
        if($this->input->post('type5')){
             $get_hospital['type5'] = $this->input->post('type5');
        }
        if($this->input->post('type6')){
             $get_hospital['type6'] = $this->input->post('type6');
        }
		 if($this->input->post('description')){
            $get_hospital['description'] = $this->input->post('description');
        } 
        $hospital_id='';
        if($this->input->post('hospital_id')){
            $hospital_id=$this->input->post('hospital_id');
        }
       
		$this->db->trans_start();
        $this->db->insert('hospital',$get_hospital);
      
	  
        $this->db->trans_complete();
        if($this->db->trans_status()==FALSE){
		    return false;
		}
        else{
           return true;
        }       
    }
}
