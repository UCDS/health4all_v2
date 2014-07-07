<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sanitation extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('masters_model');
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
	function evaluate(){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['areas']=$this->staff_model->get_areas();
		
		
	}
	function add($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$userdata=$this->session->userdata('logged_in');
		$this->data['user_id']=$userdata['user_id'];
	if($type=="area_types"){
		 	$title="Add area_types";
		
			$config=array(
               array(
                     'field'   => 'area_type',
                     'label'   => 'area_type',
                     'rules'   => 'required|trim|xss_clean'
                  )
              
			);
}
		else if($type=="area_activity"){
			$title="Add area_activity";
			$config=array(
               array(
                     'field'   => 'activity_name',
                     'label'   => ' activity_name',
                     'rules'   => 'required|trim|xss_clean'
                  ) 	
		     
			);
			$this->data['area_types']=$this->masters_model->get_data("area_types");
		
		
		}
		else if($type=="department"){
			$title="Add department";
			$config=array(
               array(
                     'field'   => 'department_name',
                     'label'   => 'department_name',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);	
			$this->data['department']=$this->masters_model->get_data("department");
		}
		else if($type=="districts"){
			$title="Add districts";
			$config=array(
               array(
                     'field'   => 'district',
                     'label'   => 'district',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
			 $this->data['states']=$this->masters_model->get_data("states");
			 $this->data['districts']=$this->masters_model->get_data("districts");
		}
		else if($type=="hospital"){
			$title="Add Hospital";
			$config=array(
               array(
                     'field'   => 'hospital_name',
                     'label'   => 'Hospital Name',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
			 $this->data['facility_type']=$this->masters_model->get_data("facility_type");
			 $this->data['village_town']=$this->masters_model->get_data("village_town");
		}
		else if($type=="facility_type"){
			$title="Add facility_type";
			$config=array(
               array(
                     'field'   => 'facility_types',
                     'label'   => 'facility_types',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
			
		}
		else if($type=="facility_activity"){
			$title="Add facility_activity";
			$config=array(
               array(
                     'field'   => 'area_name',
                     'label'   => 'area_name',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
		 $this->data['area']=$this->masters_model->get_data("area");
		 $this->data['area_activity']=$this->masters_model->get_data("area_activity");

			
			
		}
		else if($type=="area"){
			$title="Add Area";
			$config=array(
               array(
                     'field'   => 'area_name',
                     'label'   => 'area_name',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
			 $this->data['area_types']=$this->masters_model->get_data("area_types");
			 
		}
		else if($type=="staff"){
			$title="Add staff";
			$config=array(
               array(
                     'field'   => 'first_name',
                     'label'   => 'first_name',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
		}
		else if($type=="states"){
			$title="Add states";
			$config=array(
               array(
                     'field'   => 'state',
                     'label'   => 'state',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
			 $this->data['states']=$this->masters_model->get_data("states");
			 
		}
		
		else if($type=="vendor"){
			$title="Add vendor";
			$config=array(
               array(
                     'field'   => 'vendor_name',
                     'label'   => 'vendor_name',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
			 $this->data['vendor']=$this->masters_model->get_data("vendor");
			 
		}
	    else if($type=="vendor_contracts"){
			$title="Add vendor_contracts";
			$config=array(
               array(
                     'field'   => 'status',
                     'label'   => 'status',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
			 
			 $this->data['vendor_contracts']=$this->masters_model->get_data("vendor_contracts");
			 $this->data['vendor']=$this->masters_model->get_data("vendor");
			 
			 
		}
		 else if($type=="village_town"){
			$title="Add village_town";
			$config=array(
               array(
                     'field'   => 'village_town',
                     'label'   => 'village_town',
                     'rules'   => 'trim|xss_clean'
                  )
			  
			);
			 $this->data['village_town']=$this->masters_model->get_data("village_town");
			 $this->data['districts']=$this->masters_model->get_data("districts");
			
	}
			
		else{
			show_404();
		}
		$page="pages/sanitation/add_".$type."_form";
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
		$this->data['user_id']=$this->session->userdata('logged_in')[0]['user_id'];
	if($type=="area_types"){
			$title="Edit area_types";
			$config=array(
               array(
                     'field'   => 'area_type',
                     'label'   => 'area_type',
                     'rules'   => 'trim|xss_clean'
                  )
               
		
			);
		$this->data['area_types']=$this->masters_model->get_data("area_types");

		}
		else if($type=="area_activity"){
			$title="Edit Area Activity";
			$config=array(
               array(
                     'field'   => 'search_agency_name',
                     'label'   => 'Agency Name',
                     'rules'   => 'trim|xss_clean'
                  ),
				   array(
                     'field'   => 'search_frequency',
                     'label'   => 'Frequency',
                     'rules'   => 'trim|xss_clean'
                  ),
				   array(
                     'field'   => 'search_weightage	',
                     'label'   => 'Weightage',
                     'rules'   => 'trim|xss_clean'
                  ),
				   array(
                     'field'   => 'search_area_type',
                     'label'   => 'Area type',
                     'rules'   => 'trim|xss_clean'
                  ),
				   array(
                     'field'   => 'search_frequency_type',
                     'label'   => 'Frequency Type',
                     'rules'   => 'trim|xss_clean'
                  )
			);
			$this->data['area_activity']=$this->masters_model->get_data("area_activity");
			$this->data['area_types']=$this->masters_model->get_data("area_types");

		}
		else if($type=="department"){
			$title="Edit Department";
			$config=array(
               array(
                     'field'   => 'department_name',
                     'label'   => 'Department Name',
                     'rules'   => 'trim|xss_clean'
                  )
			);

		}
		else if($type=="districts"){
			$title="Edit Districts";
			$config=array(
               array(
                     'field'   => 'district',
                     'label'   => 'District',
                     'rules'   => 'trim|xss_clean'
                  ),
                array(
                     'field'   => 'longitude',
                     'label'   => 'Longitude',
                     'rules'   => 'trim|xss_clean'
                  ),
				  array(
                     'field'   => 'state',
                     'label'   => 'state',
                     'rules'   => 'trim|xss_clean'
                  ),
				  array(
                     'field'   => 'latitude',
                     'label'   => 'Latitude',
                     'rules'   => 'trim|xss_clean'
                  ),
		
			);
			$this->data['districts']=$this->masters_model->get_data("districts");
			$this->data['states']=$this->masters_model->get_data("states");
		}
		else if($type=="hospital"){
			$title="Edit Hospital";
			$config=array(
               array(
                     'field'   => 'hospital_name',
                     'label'   => 'Hospital Name',
                     'rules'   => 'trim|xss_clean'
                  ),
                array(
                     'field'   => 'longitude',
                     'label'   => 'Longitude',
                     'rules'   => 'trim|xss_clean'
                  ),
				  array(
                     'field'   => 'address',
                     'label'   => 'address',
                     'rules'   => 'trim|xss_clean'
                  ),
				   array(
                     'field'   => 'village_town',
                     'label'   => 'village_town',
                     'rules'   => 'trim|xss_clean'
                  ),
				  array(
                     'field'   => 'latitude',
                     'label'   => 'Latitude',
                     'rules'   => 'trim|xss_clean'
                  ),
		
			);
			$this->data['facility']=$this->masters_model->get_data("facility");
			$this->data['village_town']=$this->masters_model->get_data("village_town");
		}
		
		else if($type=="facility_activity"){
			$title="Edit Facility Activity";
			$config=array(
               array(
                     'field'   => 'area_name',
                     'label'   => 'Area name',
                     'rules'   => 'required|trim|xss_clean'
                  ),
				  array(
                     'field'   => 'activity_name',
                     'label'   => 'Activity name',
                     'rules'   => 'required|trim|xss_clean'
                  ),
			);	
			$this->data['facility_activity']=$this->masters_model->get_data("facility_activity");
			$this->data['area_activity']=$this->masters_model->get_data("area_activity");	
		}
		else if($type=="area"){
			$title="Edit Area";
			$config=array(
               array(
                     'field'   => 'area_name',
                     'label'   => 'Area Name',
                     'runles'   => 'trim|xss_clean'
                  )
			);
			$this->data['area']=$this->masters_model->get_data("area");
			$this->data['area_types']=$this->masters_model->get_data("area_types");
		}

		
		else if($type=="facility_type"){
			$title="Edit Facility Type";
			$config=array(
               array(
                     'field'   => 'facility_type',
                     'label'   => 'facility name',
                     'rules'   => 'trim|xss_clean'
                  ),
				 
			);	
			$this->data['facility_type']=$this->masters_model->get_data("facility_type");
				
		}
		
	else if($type=="states"){
			$title="Edit States";
			$config=array(
               array(
                     'field'   => 'states',
                     'label'   => 'states',
                     'rules'   => 'trim|xss_clean'
                  ),
				 
			);	
			$this->data['states']=$this->masters_model->get_data("states");
				
		}
		else if($type=="vendor"){
			$title="Edit vendor";
			$config=array(
               array(
                     'field'   => 'vendor',
                     'label'   => 'vendor Name',
                     'rules'   => 'trim|xss_clean'
                  ),
				 
			);	
			$this->data['vendor']=$this->masters_model->get_data("vendor");
				
		}
		else if($type=="vendor_contracts"){
			$title="Edit Vendor contracts";
			$config=array(
               array(
                     'field'   => 'vendor_contracts',
                     'label'   => 'vendor_name',
                     'label'   => 'facility_name',
                     'rules'   => 'trim|xss_clean'
                  ),
				 
			);	
			$this->data['vendor_contracts']=$this->masters_model->get_data("vendor_contracts");
				
		}

		else if($type=="village_town"){
			$title="Edit Village Town";
			$config=array(
               array(
                     'field'   => 'village_town',
                     'label'   => 'village_town',
                     'rules'   => 'trim|xss_clean'
                  ),
				 
			);	
			$this->data['village_town']=$this->masters_model->get_data("village_town");
				
		}
		else{
			show_404();
		}
		
		$page="pages/sanitation/edit_".$type."_form";
		$this->data['title']=$title;
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
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
				$this->data[$type]=$this->masters_model->get_data($type);
				$this->data['mode']="select";
				$this->load->view($page,$this->data);
			}
			else if($this->input->post('search')){
				echo "search";
				$this->data['mode']="search";
				$this->data[$type]=$this->masters_model->get_data($type);
				$this->load->view($page,$this->data);
			}
		}
		$this->load->view('templates/footer');
	}
	
}

