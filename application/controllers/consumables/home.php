
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		if($this->session->userdata('logged_in')){
			$data['title']="Home";
			$this->load->view('templates/header',$data);
			$this->load->view('templates/leftnav2',$data);
			$data['userdata']=$this->session->userdata('logged_in');
			$this->load->view('pages/consumables/home');
		}
		else{
			$data['title']="Login";
			$this->load->view('templates/header',$data);
			$this->load->view('pages/consumables/login');
		}
		$this->load->view('templates/footer');
	}

	function login()
	{	
		if(!$this->session->userdata('logged_in')){
			
		$data['title']="Login";

		$this->load->view('templates/header',$data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('password', 'Password', 
	    'trim|required|xss_clean|callback_check_database');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/consumables/login');
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

