<?php
class Hospital_areas_model extends CI_Model {                                          //create a model class with name hospital_areas_model which extends CI_model.
    function __construct() {                                                           //constructor definition.
        parent::__construct();                                                         //calling code igniter (parent) constructor.
    }//constructor
     function add_area(){                                                              //add_area function definition.
        $area=array();                                                                 //declare an array with name area.
        
        if($this->input->post('area_name')){                                           //checking whether user giving area_name or empty value.
            $area['area_name'] = $this->input->post('area_name');                      //store area_name into  an area array of index:area_name.
        }//if
        if($this->input->post('department_id')){                                       //checking whether user giving department_id or empty value.
            $area['department_id'] = $this->input->post('department_id');               //store department_id into  an area array of index:department_id.
        }//if
          if($this->input->post('beds')){                                              //checking whether user giving no of beds or empty value.
            $area['beds'] = $this->input->post('beds');                                //store no of beds into  an area array of index:beds.
         }//if
          if($this->input->post('area_type_id')){                                      //checking whether user giving area_type_id or empty value.
            $area['area_type_id'] = $this->input->post('area_type_id');                 //store area_type_id into  an area array of index:area_type_id.
         }//if
          if($this->input->post('lab_report_staff_id')){                               //checking whether user giving lab_report_staff_id or empty value.
            $area['lab_report_staff_id'] = $this->input->post('lab_report_staff_id');   //store lab_report_staff_id into  an area array of index:lab_report_staff_id.
         }//if
          
        $this->db->trans_start();                                                      //transaction started here.
        $this->db->insert('area', $area); 
        echo "inserted successfully" ;                                           //insert array (area) into area table.
        $this->db->trans_complete();                                                   //transaction completed here.
        if($this->db->trans_status()==FALSE){                                          //checking transaction status.If it fails return false else return true.
                return false;
        }//if
        else{
                return true;
    }//else
  }//add_area
}//hospital_areas_model

