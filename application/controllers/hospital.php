
	<?php
class Hospital extends CI_Controller {										//creating controller with name hospital.
    function __construct() {
		   parent::__construct();											//calling CI_Contoller (parent) constructor
    }   																	// end of constructor
	function add_hospital(){												//creating method with name 'add_hospital'.
	
		if($this->session->userdata('logged_in')){  						//checking whether user is logged in or not.(permits you maintain a user's "state" )
            $this->data['userdata']=$this->session->userdata('logged_in');  //storing details in an array.
        }	
        else{
            show_404(); 													//if user is not logged in then it show error msg.
        } 
		  $this->data['userdata']=$this->session->userdata('logged_in');
		 $user_id=$this->data['userdata']['user_id']; 
		$this->load->model('staff_model');									//instantiating staff_model.
		$this->data['functions']=$this->staff_model->user_function($user_id);
		$access = -1;
		//var_dump($user_id);
        foreach($this->data['functions'] as $function){
            if($function->user_function=="Admin"){
                $access = 1;
				break;
            }
		}
		if($access != 1){
			show_404();
		}
		$user_id=$this->data['userdata']['user_id']; 
		$this->load->helper('form');										//loading the 'form' helper .
		$this->load->library('form_validation'); 							//loading library 
		$data['title']="Add Hospital";										//storing value into an array with index title.
		$this->load->view('templates/header', $this->data);				//loading header view.
		$this->load->view('templates/leftnav');								//loading leftnav.
		$this->form_validation->set_rules('hospital','hospital','required');//setting rule for required field.
		if($this->form_validation->run()===FALSE) 							//if validation is false
		{
			
		}
		else																//if validation true then executes below block of code
		{
		$this->load->model('hospital_model');								//instantiating hospital_model.
        if($this->hospital_model->add_hospital()){							//calling add_method 
		$this->data['msg']="Hospital added Succesfully";					//if above condition is true then it displays hospital added succesfully message.
		}
		}
		$this->load->view('pages/hospital_view',$this->data);							//displaying hospitla_view page.
		$this->load->view('templates/footer');								//displaying footer page.
    }   																	//add_hospital
	
}   																		//class
	