<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('register_model');
	}
	public function op()
	{
		$this->load->helper('form');
		$this->load->model('staff_model');
		if($this->session->userdata('hospital')){
		
			$data['departments']=$this->staff_model->get_departments();
			$data['districts']=$this->staff_model->get_districts();
			$data['userdata']=$this->session->userdata('logged_in');
			$data['title']="Out-Patient Registration";
			$this->load->view('templates/header',$data);
			$this->load->view('templates/left_nav');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('first_name', 'Patient Name',
			'trim|required|xss_clean');
			$this->form_validation->set_rules('gender', 'Gender', 
			'trim|required|xss_clean');
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('pages/op_registration');
			}
			else{
				$data['registered']=$this->register_model->register_op();
					$this->load->view('pages/op_registration',$data);

			}
			$this->load->view('templates/footer');
			
		}
		else{
			redirect('home','refresh');
		}
	}
}

