<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipments extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('masters_model');
		$this->load->model('staff_model');
		$this->load->model('reports_model');
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
	function add($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$user=$this->session->userdata('logged_in');
		$this->data['user_id']=$user['user_id'];
		if($type=="equipment_type"){
		 	$title="Add Equipment Type";
		
			$config=array(
               array(
                     'field'   => 'equipment_type',
                     'label'   => 'Equipment Type',
                     'rules'   => 'required|trim|xss_clean'
                  )
             
			);
		}

		else if($type=="service"){
		 	$title="Add Service Records";
		
			$config=array(
                         array(
                     'field'   => 'working_status',
                     'label'   =>  'Working Status',
                     'rules'   => 'trim|xss_clean'
                  )
        
      
             
			);
		$this->data['service']=$this->masters_model->get_data("service");
     		
		}



else if($type=="service_records"){
		 	$title="Add Service Records";
		
			$config=array(
                         array(
                     'field'   => 'working_status',
                     'label'   =>  'Working Status',
                     'rules'   => 'required|trim|xss_clean'
                  )
        
             
             
			);
$this->data['user']=$this->masters_model->get_data("user");
		
}


	else if($type=="equipment"){
		 	$title="Add Equipment";
		
			$config=array(
               array(
                     'field'   => 'equipment_type',
                     'label'   => 'Equipment Type',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                       array(
                     'field'   => 'equipment_status',
                     'label'   => 'Equipment Status',
                     'rules'   => 'required|trim|xss_clean'
                  ),
		);

        $this->data['equipment_types']=$this->masters_model->get_data("equipment_types");
		$this->data['department']=$this->masters_model->get_data("department");
		$this->data['areas']=$this->masters_model->get_data("area");
		$this->data['units']=$this->masters_model->get_data("unit");
		

	}
			
		else{
			show_404();
		}
		$page="pages/inventory/add_".$type."_form";
		$this->data['title']=$title;
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/leftnav');
		$this->form_validation->set_rules($config);
 		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$this->data);
		}
		else{
				if(($this->input->post('submit'))||($this->masters_model->insert_data($type))){
					$this->data['msg']=" Inserted  Successfully";
					$this->load->view($page,$this->data);
				}
				else{
					$this->data['msg']="Failed";
					$this->load->view($page,$this->data);
				}
		}
		$this->load->view('templates/footer');
  	}	
function edit($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$user=$this->session->userdata('logged_in');
		$this->data['user_id']=$user['user_id'];
		if($type=="service"){
		 	$title="Edit Service Records";
		
			$config=array(
                         array(
                     'field'   => 'working_status',
                     'label'   =>  'Working Status',
                     'rules'   => 'trim|xss_clean'
                  )
        
             
             
			);
$this->data['equipments']=$this->masters_model->get_data("equipments");
		
}

		else if($type=="equipment_type"){
		 	$title="Edit Equipment Type";
		
			$config=array(
               array(
                     'field'   => 'equipment_type',
                     'label'   => 'Equipment Name',
                     'rules'   => 'trim|xss_clean'
                  )
             
			);
      
$this->data['equipment_types']=$this->masters_model->get_data("equipment_type");

}

else if($type=="equipments"){
		 	$title="Edit Equipment Details";
		
			$config=array(
               array(
                     'field'   => 'equipment_type',
                     'label'   => 'Equipment Name ',
                     'rules'   => 'trim|xss_clean'
                  )
			);
$this->data['equipments']=$this->masters_model->get_data("equipment");

$this->data['equipment_type']=$this->masters_model->get_data("equipment_types");
$this->data['hospital']=$this->masters_model->get_data("hospital");
$this->data['department']=$this->masters_model->get_data("department");
$this->data['user']=$this->masters_model->get_data("user");
 }

			
		else{
			show_404();
		}
		
		$page="pages/inventory/edit_".$type."_form";
		$this->data['title']=$title;
		$this->load->view('templates/header',$this->data);
      $this->load->view('templates/leftnav',$this->data);
		
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$this->data);
		}
		else{
			if($this->input->post('update')){
				if($this->masters_model->update_data($type)){
					$this->data['msg']="Updated Successfully";
		
					$this->load->view($page,$this->data);
				}
				else{
					$this->data['msg']="Failed";
					$this->load->view($page,$this->data);
				}
			}
			else if($this->input->post('select')){
            $this->data['mode']="select";
			   $this->data[$type]=$this->masters_model->get_data($type);
         
         	$this->load->view($page,$this->data);
			}
			else if($this->input->post('search')){
				$this->data['mode']="search";
				$this->data[$type]=$this->masters_model->get_data($type);
				$this->load->view($page,$this->data);
			}
		}
		$this->load->view('templates/footer');
	}

	function view($type,$equipment_type=0,$department=0,$area=0,$unit=0,$status=0){	
		$this->load->helper('form_helper');
		switch($type){
			case "equipments_detailed" : 
				$this->data['title']="Equipments Detailed report";
				$this->data['equipments']=$this->masters_model->get_data("equipment",$equipment_type,$department,$area,$unit,$status);
				break;
			case "equipments_summary" :
				$this->data['title']="Equipments Summary report";
				$this->data['summary']=$this->reports_model->get_equipment_summary();
				break;
		}				
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/leftnav',$this->data);
		$this->load->view("pages/inventory/report_$type",$this->data);
		$this->load->view('templates/footer');
	}
	
}

