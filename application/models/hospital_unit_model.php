<?php
class Hospital_unit_model extends CI_Model{

    function __construct() {
        parent::__construct();
    }
		//Function to add_unit
    function add_unit(){
		//storing fields data into data array
        $data=array();
        if($this->input->post('unit_head_staff_id')){
            $data['unit_head_staff_id'] = $this->input->post('unit_head_staff_id');
        }
        if($this->input->post('unit_name')){
           $data['unit_name'] = $this->input->post('unit_name');
        }
        if($this->input->post('department_id')){
           $data['department_id'] = $this->input->post('department_id');
        }
         if($this->input->post('beds')){
            $data['beds'] = $this->input->post('beds');
        }
         if($this->input->post('lab_report_staff_id')){
            $data['lab_report_staff_id'] = $this->input->post('lab_report_staff_id');
        }
        //inserting retrieving data into database
        $this->db->trans_start();
        //inserting data to 'unit'table
        $this->db->insert('unit', $data);
        $this->db->trans_complete();
        //checking the status of inserting data
        if($this->db->trans_status()==FALSE){
                return false;
        }
        else{
                return true; 
        }
   }
    

     
            
        
    


    
}
   
