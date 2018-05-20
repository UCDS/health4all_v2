<?php
class hospital_areas extends CI_Controller{                                           
    function __construct(){                                                             
        parent::__construct();                                                            
    }
    function add_area(){    
        if($this->session->userdata('logged_in')){                                    
            $this->data['userdata']=$this->session->userdata('logged_in');            
        }	
        else{
            show_404();                                                               
        }
        $user_id=$this->data['userdata']['user_id'];                                  
        $access = -1;
        $this->load->model('staff_model');
        $this->data['functions'] = $this->staff_model->user_function($user_id);        
        foreach($this->data['functions'] as $function){                               
            if($function->user_function=="Admin"){
                $access = 1;
		        break;
            }
	    }                                       
        if($access == -1){                                                          
            show_404();
        }                                                                                                    
        $this->load->helper('form');                                               
        $this->load->library('form_validation');                                   
        $this->data['title']="Add Area";
        $validations = array(                                                      
            array(                                                                 
                'field'=>'area_name',                                              
                'label'=>'Area name',                                              
                'rules'=>'required|alpha'                                          
            ),
            array(
                'field'=>'department_id',
                'label'=>'Department',
                'rules'=>'required'
            )
        );       
        $this->form_validation->set_rules($validations);                                
        $this->form_validation->set_message('message','Please input missing details.'); 
        if ($this->form_validation->run() == FALSE)                                     
        {
            $this->data['message']= "Validation failed.";                              
        } 
        else{     
	        $this->load->model('hospital_areas_model');                              
            if($this->hospital_areas_model->add_area()){                             
                $this->data['message'] = "Area added succesfully.";                     
            }
            else{
                $this->data['message'] = "Something went wrong please try again.";      
            }
        }                                                    
        $this->data['hospitals'] = $this->staff_model->user_hospital($user_id);         
        $this->data['all_departments'] = $this->staff_model->get_department();   
       
        $this->data['op_forms']=$this->staff_model->get_forms("OP");
        $this->data['ip_forms']=$this->staff_model->get_forms("IP");
        $this->load->view('templates/header',$this->data);                         
        $this->load->view('templates/leftnav',$this->data);                        					  
        $this->load->view('pages/hospital_area_view',$this->data);                     
        $this->load->view('templates/footer');                                         
    }
}