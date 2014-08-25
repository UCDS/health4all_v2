<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_panel extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('bloodbank/reports_model');		
		$this->load->model('bloodbank/register_model');	
		$this->load->model('staff_model');
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$user_id=$this->data['userdata']['user_id'];
		$this->data['hospitals']=$this->staff_model->user_hospital($user_id);
		$this->data['functions']=$this->staff_model->user_function($user_id);
		$this->data['departments']=$this->staff_model->user_department($user_id);
		}
		$this->data['op_forms']=$this->staff_model->get_forms("OP");
		$this->data['ip_forms']=$this->staff_model->get_forms("IP");		
	}
	function place(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['title']="Places";
		$this->data['userdata']=$this->session->userdata('hospital');
		$hospital=$this->data['userdata']['hospital'];
		$this->data['camps']=$this->register_model->get_camps();
		if($this->input->post('add_camp')){
				if($this->staff_model->add_camp()){
					$this->data['camps']=$this->register_model->get_camps();
					$this->data['msg']="Camp added successfully";

					$this->load->view('templates/header',$this->data);
					$this->load->view('templates/panel_nav',$this->data);
					$this->load->view('pages/bloodbank/place',$this->data);
				}
		}
		else if($this->input->post('reset')){
			$this->session->unset_userdata('place');
				$this->session->set_userdata('place',array('camp_id'=>0,'name'=>"$hospital"));

				$this->load->view('templates/header',$this->data);
				$this->load->view('templates/panel_nav',$this->data);
				$this->load->view('pages/bloodbank/place');
		}
		else if($this->input->post('camp')){
			$this->session->unset_userdata('place');
			$camp=$this->register_model->get_camps($this->input->post('camp'));
			$sess_array=array(
				'camp_id'=>$camp[0]->camp_id,
				'name'=>$camp[0]->camp_name,
				'location'=>$camp[0]->location
			);
			$this->session->set_userdata('place',$sess_array);

			$this->load->view('templates/header',$this->data);
			$this->load->view('templates/panel_nav',$this->data);
			$this->load->view('pages/bloodbank/place',$this->data);
		}
		else{
			if(!$this->session->userdata('place')){
				$this->session->set_userdata('place',array('camp_id'=>0,'name'=>"$hospital"));
			}
			$this->load->view('templates/header',$this->data);
			$this->load->view('templates/panel_nav',$this->data);
			$this->load->view('pages/bloodbank/place',$this->data);
		}
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
}
