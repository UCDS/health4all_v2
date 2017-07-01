<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospital_units extends CI_Controller
{
    function __construct(){
		parent::__construct();	
		$this->load->model('staff_model');
		if($this->session->userdata('logged_in')){
		$userdata=$this->session->userdata('logged_in');
		$user_id=$userdata['user_id'];
		$this->data['hospitals']=$this->staff_model->user_hospital($user_id);
		$this->data['functions']=$this->staff_model->user_function($user_id);
		$this->data['departments']=$this->staff_model->user_department($user_id);
		}
		$this->data['op_forms']=$this->staff_model->get_forms("OP");
		$this->data['ip_forms']=$this->staff_model->get_forms("IP");	
    }//_construct

   function add_unit(){   
	
		if($this->session->userdata('logged_in')){                                    //checking whether user is in logging state or not;session:state of a user.
            $this->data['userdata']=$this->session->userdata('logged_in');            //taking session data into data array of index:userdata                   
        }	
        else{
            show_404();                                                               //if user is not logged in then this error will be thrown.
        }
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="Admin"){
					$access=1;
					break;
			}
		}
        if($access==1){ 
        $this->load->helper('form');                                   
        $this->load->library('form_validation');                       
        $this->data['title']="add unit";                  
        $this->load->view('templates/header',$this->data);             
        $this->load->view('templates/leftnav');                        
        
        $validations=array(                                            
            array(   
                'field'=>'department_id',                                 
                'label'=>'departmentID',                                 
                'rules'=>'required'                                   
            ),
            array(
                'field'=>'unit_name',
                'label'=>'Unit Name',
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
			$this->load->model('hospital_unit_model');     
            if($this->hospital_unit_model->add_unit()){                       
                $this->data['message']= "unit added succesfully.";             
            }
            else{
               $this->data['message']= "Something went wrong please try again.";                
            }            
        }
        $this->load->view('pages/hospital_unit_view',$this->data);
        $this->load->view('templates/footer');
		}
		else show_404();
	}
    
   
    
}
?>

  
