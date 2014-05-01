<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('masters_model');
		$this->load->model('staff_model');
		$this->load->model('reports_model');
		$this->data['op_forms']=$this->staff_model->get_forms("OP");
		$this->data['ip_forms']=$this->staff_model->get_forms("IP");
	}
	function add($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$user=$this->session->userdata('logged_in');
		$data['user_id']=$user[0]['user_id'];
		switch($type){
			case "staff":
				$title="Add Staff Details";
			
				$config=array(
						array(
						 'field'   => 'first_name',
						 'label'   => 'First Name',
						 'rules'   => 'required|trim|xss_clean'
						),
						array(
						 'field'   => 'gender',
						 'label'   => 'Gender',
						 'rules'   => 'required|trim|xss_clean'
						)
				);
				$data['department']=$this->masters_model->get_data("department");
				$data['unit']=$this->masters_model->get_data("unit");
				$data['area']=$this->masters_model->get_data("area");
				$data['staff_category']=$this->masters_model->get_data("staff_category");
				$data['staff_role']=$this->masters_model->get_data("staff_role");
				break;
			default: show_404();	
		}
		$page="pages/staff/add_".$type."_form";
		$this->data['title']=$title;
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/leftnav');
		$this->form_validation->set_rules($config);
 		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$data);
		}
		else{
				if(($this->input->post('submit'))||($this->masters_model->insert_data($type))){
					$data['msg']=" Inserted  Successfully";
					$this->load->view($page,$data);
				}
				else{
					$data['msg']="Failed";
					$this->load->view($page,$data);
				}
		}
		$this->load->view('templates/footer');
  	}	
  	
	function edit($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$user=$this->session->userdata('logged_in');
		$data['user_id']=$user[0]['user_id'];
		if($type=="drugs"){
			$title="Edit Drugs";
			$config=array(
               array(
                     'field'   => 'drug_type',
                     'label'   => 'Drugs',
                     'rules'   => 'trim|xss_clean'
                  ),
               array(
                     'field'   => 'description',
                     'label'   => 'Description',
                     'rules'   => 'trim|xss_clean'
                  )
		
			);
		$data['drug']=$this->masters_model->get_data("drugs");
		}
		else{
			show_404();
		}
		
		$page="pages/inventory/edit_".$type."_form";
		$this->data['title']=$title;
		$this->load->view('templates/header',$this->data);
      $this->load->view('templates/leftnav',$data);
		
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$data);
		}
		else{
			if($this->input->post('update')){
				if($this->masters_model->update_data($type)){
					$data['msg']="Updated Successfully";
		
					$this->load->view($page,$data);
				}
				else{
					$data['msg']="Failed";
					$this->load->view($page,$data);
				}
			}
			else if($this->input->post('select')){
            $data['mode']="select";
			   $data[$type]=$this->masters_model->get_data($type);
         
         	$this->load->view($page,$data);
			}
			else if($this->input->post('search')){
				$data['mode']="search";
				$data[$type]=$this->masters_model->get_data($type);
				$this->load->view($page,$data);
			}
		}
		$this->load->view('templates/footer');
	}

	function view($type,$equipment_type=0,$department=0,$area=0,$unit=0,$status=0){	
		$this->load->helper('form_helper');
		switch($type){
			case "equipments_detailed" : 
				$this->data['title']="Equipments Detailed report";
				$data['equipments']=$this->masters_model->get_data("equipments",$equipment_type,$department,$area,$unit,$status);
				break;
			case "equipments_summary" :
				$this->data['title']="Equipments Summary report";
				$data['summary']=$this->reports_model->get_equipments_summary();
				break;
		}				
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/leftnav',$this->data);
		$this->load->view("pages/inventory/report_$type",$data);
		$this->load->view('templates/footer');
	}
	
}

