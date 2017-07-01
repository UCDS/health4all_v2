<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hospital extends CI_Controller {										//creating controller with name hospital.
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
    }   																	// end of constructor
	function add_hospital(){												//creating method with name 'add_hospital'.
	
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
		$this->load->helper('form');										//loading the 'form' helper .
		$this->load->library('form_validation'); 							//loading library 
		$data['title']="Add Hospital";										//storing value into an array with index title.
		$this->load->view('templates/header', $this->data);				//loading header view.
		$this->load->view('templates/leftnav');								//loading leftnav.
		$this->form_validation->set_rules('hospital','hospital','required');//setting rule for required field.
		if($this->form_validation->run()===FALSE) 							//if validation is false
		{
			
			$this->data['message']="validation failed";						//displays validation failed message.
		}
		else																//if validation true then executes below block of code
		{
		$this->load->model('hospital_model');								//instantiating hospital_model.
        if($this->hospital_model->add_hospital()){							//calling add_method 
		$this->data['msg']="hospital added succesfully";					//if above condition is true then it displays hospital added succesfully message.
		}
		}
		$this->load->view('pages/hospital_view');							//displaying hospitla_view page.
		$this->load->view('templates/footer');								//displaying footer page.
		}
		else show_404();
	}//add_hospital
}   																		//class
	