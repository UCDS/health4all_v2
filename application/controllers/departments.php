<?php
class Departments extends CI_Controller {		//creating controller with name Departments.
    function __construct() {				
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
	}
    
	function add_department(){	
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
		$this->load->helper('form');		    //loading helper form.
        $this->load->library('form_validation'); //loading library with name form_validation.
        $this->data['title']="Add department";	// storing the value into the data array with the index of title.
		$this->load->view('templates/header',$this->data);		//loading header file with data.
        $this->load->view('templates/leftnav',$this->data);	
        //$this->load->view(pages/'department_view',$this->data);
        
        
        $validations=array(			//creating two dimensional array and store in validations variable.
            array(
                'field'=>'department',     		//array with department field name ,label and rules.
                'label'=>'Department',
                'rules'=>'required'
            ),
            array(
                'field'=>'hospital_id',			//array with hospital_id field name,label and rules.
                'label'=>'Hospital',
                'rules'=>'required'
            )
        );
        $this->form_validation->set_rules($validations);		//load the fields for validation.
		$this->form_validation->set_message('message','Please input missing details.');        //if any input is missing then display message 'please input missing details.'
        if ($this->form_validation->run() === FALSE)		//checking for validation is successful or not
        {
            $this->data['message']= "Validation failed.";		// if validation is  unsuccessful then display validation failed.
        }
        else{
			$this->load->model('department_model');           //if validation is successful then load the hopital_model.
            if($this->department_model->add_department()){		//checking for add_department method in hospital_model.
                $this->data['message']= "Department added succesfully.";     //if department added successfully then display the message department is added successfully.           
            }
            else{
                $this->data['message']= "Something went wrong, please try again.";      //if department added unsuccessful print the message something went wrong please try again.          
            }            
        }
        $this->data['list_departments']=$this->staff_model->get_list_department();	
        $this->load->view('pages/department_view',$this->data);			//load the department_view file with data.
        $this->load->view('templates/footer');	
		}
		else show_404();
        
	}
}


