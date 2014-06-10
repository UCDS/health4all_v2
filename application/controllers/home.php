<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {	

	function __construct(){
		parent::__construct();
		$this->load->model('staff_model');
		$this->data['op_forms']=$this->staff_model->get_forms("OP");
		$this->data['ip_forms']=$this->staff_model->get_forms("IP");
	}

	public function index()
	{
		$this->load->helper('form');
		if($this->session->userdata('logged_in')){
			$this->data['title']="Home";
			$this->load->view('templates/header',$this->data);
			$data['userdata']=$this->session->userdata('logged_in');
			$hospitals=array();
			foreach($data['userdata'] as $temp){
				$hospitals[]=$temp['hospital_id'];
			}
			if(count(array_unique($hospitals))>1){
				$this->load->library('form_validation');
				$this->form_validation->set_rules('organisation', 'Organisation',
				'trim|required|xss_clean');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('pages/home',$data);
				}
				else{
					if($this->input->post('organisation')){
						foreach($this->session->userdata('logged_in') as $row){
							if($row['hospital_id']==$this->input->post('organisation')){
								$sess_array = array(
								'user_id' => $row['user_id'],
								 'username' => $row['username'],
								 'hospital_id' => $row['hospital_id'],
								 'hospital' => $row['hospital'],
								 'description' => $row['description'],
								 'place' => $row['place'],
								 'district' => $row['district'],
								 'state' => $row['state'],
								 'logo' => $row['logo'],
								 'user_function_id'=>$row['user_function_id'],
								 'user_function'=>$row['user_function']
								);
								$this->session->set_userdata('hospital',$sess_array);
							}
						}
						$this->load->view('pages/home',$data);
					}
				}
			}
			else{
				foreach($this->session->userdata('logged_in') as $row){
							$sess_array = array(
							'user_id' => $row['user_id'],
							'username' => $row['username'],
							'hospital_id' => $row['hospital_id'],
							'hospital' => $row['hospital'],
							'description' => $row['description'],
							'place' => $row['place'],
							'district' => $row['district'],
							'state' => $row['state'],
							'logo' => $row['logo'],
							'user_function_id'=>$row['user_function_id'],
							'user_function'=>$row['user_function']
							);
							$this->session->set_userdata('hospital',$sess_array);
				}
				$this->load->view('pages/home',$data);
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
	     $sess_array = array();
	     foreach($result as $row)
	     {
	         $sess_array[] = array(
	         'user_id' => $row->user_id,
	         'username' => $row->username,
	         'hospital_id' => $row->hospital_id,
	         'hospital' => $row->hospital,
	         'description' => $row->description,
	         'place' => $row->place,
	         'district' => $row->district,
	         'state' => $row->state,
	         'logo' => $row->logo,
			 'user_function_id'=>$row->function_id,
			 'user_function'=>$row->user_function,
			 );
	       $this->session->set_userdata('logged_in', $sess_array);
	     }
	     return TRUE;
	   }
	   else
	   {
	     $this->form_validation->set_message('check_database', 
	     'Invalid username or password');
	     return false;
	   }
	 }
	 
	 function logout()
	 {
	   $this->session->unset_userdata('logged_in');
	   $this->session->unset_userdata('hospital');
	   $this->session->sess_destroy();
	   redirect('home', 'refresh');
	 }
}

