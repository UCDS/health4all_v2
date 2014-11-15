<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('register_model');
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
	public function op()
	{
		$this->load->helper('form');
		if($this->session->userdata('hospital')){		
			$this->data['departments']=$this->staff_model->get_departments();
			$this->data['districts']=$this->staff_model->get_districts();
			$this->data['userdata']=$this->session->userdata('logged_in');
			$this->data['title']="Out-Patient Registration";
			$this->load->view('templates/header',$this->data);
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
				$this->data['registered']=$this->register_model->register_op();
					$this->load->view('pages/op_registration',$this->data);

			}
			$this->load->view('templates/footer');
		}
		else{
			redirect('home','refresh');
		}
	}
	public function custom_form($form_id="",$visit_id=0)
	{
		$this->load->helper('form');
		if($this->session->userdata('hospital')){
			if($form_id=="")
				show_404();
			else{
			$this->data['departments']=$this->staff_model->get_department();
			$this->data['units']=$this->staff_model->get_unit();
			$this->data['areas']=$this->staff_model->get_area();
			$this->data['districts']=$this->staff_model->get_district();
			$this->data['userdata']=$this->session->userdata('logged_in');
			$this->data['title']="Patient Registration";
			$this->data['form_id']=$form_id;

			$this->data['fields']=$this->staff_model->get_form_fields($form_id);
			if(count($this->data['fields'])==0){
				show_404();
			}
			$form=$this->staff_model->get_form($form_id);
			$this->data['columns']=$form->num_columns;
			$this->data['form_name']=$form->form_name;
			$this->data['form_type']=$form->form_type;
			$this->data['patient']=array();
			$this->data['update']=0;
			$print_layout_page=$form->print_layout_page;
			$this->load->view('templates/header',$this->data);
			$this->load->library('form_validation');
			$this->form_validation->set_rules('form_type','Form Type','trim|xss_clean');
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('pages/custom_form',$this->data);
			}
			else{
				if($this->input->post('search_patients')){
					$this->data['patients']=$this->register_model->search();
				}
				else if($this->input->post('select_patient') && $visit_id!=0){
					$this->data['patient']=$this->register_model->select($visit_id);
					if($this->input->post('visit_type')=="IP"){
						$this->data['update']=1;
					}
				}
				else if($this->input->post('register')){
					$this->data['registered']=$this->register_model->register();
					$this->data['print_layout']="pages/print_layouts/$print_layout_page";
				}
				$this->load->view('pages/custom_form',$this->data);

			}	
			$this->load->view('templates/footer');
			}
		}
		else{
			redirect('home','refresh');
		}
		
	}
}

