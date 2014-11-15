<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {	

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
	}

	public function index()
	{
		$this->load->helper('form');
		if($this->session->userdata('logged_in')){
			$this->data['title']="Home";
			$this->load->view('templates/header',$this->data);
			if(count($this->data['hospitals'])>1){
			$this->load->library('form_validation');
				$this->form_validation->set_rules('organisation', 'Organisation',
				'trim|required|xss_clean');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('pages/home',$this->data);
				}
				else{
					if($this->input->post('organisation')){
						foreach($this->data['hospitals'] as $row){
							if($row->hospital_id==$this->input->post('organisation')){
								$sess_array = array(
								 'hospital_id' => $row->hospital_id,
								 'hospital' => $row->hospital,
								 'description' => $row->description,
								 'place' => $row->place,
								 'district' => $row->district,
								 'state' => $row->state,
								 'logo' => $row->logo
								);
								$this->session->set_userdata('hospital',$sess_array);
								break;
							}
						}
						$this->load->view('pages/home',$this->data);
					}
				}
			}
			else{
				foreach($this->data['hospitals'] as $row){
							$sess_array = array(
							 'hospital_id' => $row->hospital_id,
							 'hospital' => $row->hospital,
							 'description' => $row->description,
							 'place' => $row->place,
							 'district' => $row->district,
							 'state' => $row->state,
							 'logo' => $row->logo
							);
							$this->session->set_userdata('hospital',$sess_array);
							break;
				}
				$this->load->view('pages/home',$this->data);
			}
		}
		
		else{
			$this->data['title']="Login";
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/login');
		}
		$this->load->view('templates/footer');
	}

	function login()
	{	
		if(!$this->session->userdata('logged_in')){
			
		$this->data['title']="Login";

		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('password', 'Password', 
	    'trim|required|xss_clean|callback_check_database');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/login');
		}
		else{
			redirect('home', 'refresh');
		}
		
		$this->load->view('templates/footer');
		}
		else {
			redirect('home','refresh');
		}
	}
	
	
	function check_database($password){
		$this->load->model('staff_model');
	   //Field validation succeeded.  Validate against database
	   $username = $this->input->post('username');
	 
	   //query the database
	   $result = $this->staff_model->login($username, $password);
	   if($result)
	   {
	     foreach($result as $row)
	     {
	         $sess_array = array(
	         'user_id' => $row->user_id,
	         'username' => $row->username
			 );
	       $this->session->set_userdata('logged_in', $sess_array);
		   break;
	     }
	     return TRUE;
	   }
	   else
	   {
	     $this->form_validation->set_message('check_database','Invalid username or password');
	     return false;
	   }
	 }
	 
	 function logout()
	 {
	   $this->session->sess_destroy();
	   redirect('home', 'refresh');
	 }
}

