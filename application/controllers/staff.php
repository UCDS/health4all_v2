<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('staff_model');
	}
	function index(){
		$data['title']="Staff List";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/donate_nav');
		$data['staff']=$this->staff_model->staff_list();
		$this->load->view('pages/staff_list',$data);
	}
	function login()
	{	
		if(!$this->session->userdata('logged_in')){
			
		$data['title']="Staff Login";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/donate_nav');
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
			redirect('user_panel/donation_summary', 'refresh');
		}
		
		$this->load->view('templates/footer');
		}
		else {
			redirect('user_panel/donation_summary','refresh');
		}
	}
	
	
	function check_database($password){
	   //Field validation succeeded.  Validate against database
	   $username = $this->input->post('username');
	 
	   //query the database
	   $result = $this->staff_model->login($username, $password);
	 
	   if($result)
	   {
	     $sess_array = array();
	     foreach($result as $row)
	     {
	       $sess_array = array(
	         'user_id' => $row->user_id,
	         'username' => $row->username,
	         'hospital' => $row->hospital,
	         'description' => $row->description,
	         'place' => $row->place,
	         'district' => $row->district,
	         'state' => $row->state
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
	   session_destroy();
	   redirect('home', 'refresh');
	 }
}
