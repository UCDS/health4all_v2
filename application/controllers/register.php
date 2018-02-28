<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// OP and IP registration forms.
class Register extends CI_Controller {
	function __construct(){
		//Constructor loads the required models for this controller
		//Based on the user_id we get the hospitals,functions and departments the user has access to.
		parent::__construct();
		$this->load->model('register_model');
		$this->load->model('staff_model');
		$this->load->model('masters_model');
                $this->load->model('patient_model');
         //       $this->load->model('hospital_model');
                $this->load->model('counter_model');
		if($this->session->userdata('logged_in')){
		$userdata=$this->session->userdata('logged_in');
		$user_id=$userdata['user_id'];
		$this->data['hospitals']=$this->staff_model->user_hospital($user_id);
		$this->data['functions']=$this->staff_model->user_function($user_id);
		$this->data['departments']=$this->staff_model->user_department($user_id);
		}
		//The OP and IP forms in the application are loaded into a data variable for the menu.
		$this->data['op_forms']=$this->staff_model->get_forms("OP");
		$this->data['ip_forms']=$this->staff_model->get_forms("IP");
	}
	
	//custom_form() accepts a form ID to display the selected form (OP or IP) 
	//and also an optional visit_id when a patient is selected.
	public function custom_form($form_id="",$visit_id=0)
	{
		if(!$this->session->userdata('logged_in')){
			show_404();
		}
		//Loading the form helper
		$this->load->helper('form');
		
		if($this->session->userdata('hospital')){ //If the user has selected a hospital after log-in.
			if($form_id=="") //Form ID cannot be null, if so show a 404 error.
				show_404();
			else{		
			$access=1;        
			foreach($this->data['functions'] as $f){
				if(($f->user_function=="Out Patient Registration" || $f->user_function == "IP Registration")){
					$access = 1;
					break;
				}
				else{
					$access=0;
				}
			}
			if($access==1){
			//Load data required for the select options in views.
			$this->data['id_proof_types']=$this->staff_model->get_id_proof_type();
			$this->data['occupations']=$this->staff_model->get_occupations();
			$this->data['departments']=$this->staff_model->get_department();
			$this->data['visit_names']=$this->staff_model->get_visit_name();
			$this->data['units']=$this->staff_model->get_unit();
			$this->data['areas']=$this->staff_model->get_area();
			$this->data['districts']=$this->staff_model->get_district();
			$this->data['countries']=$this->masters_model->get_data('country_codes');
			$this->data['states_codes']=$this->masters_model->get_data('state_codes');
			$this->data['userdata']=$this->session->userdata('logged_in');//Load the session data into a variable to use in headers and models.
			$this->data['title']="Patient Registration"; //Set the page title to be used by the header.
			$this->data['form_id']=$form_id; //Store the form_id in a variable to access in the views.
			$this->data['fields']=$this->staff_model->get_form_fields($form_id); //Get the form fields based on the form_id
			if(count($this->data['fields'])==0){ //if there are no form fields available in the selected form.
				show_404();
			}
			$form=$this->staff_model->get_form($form_id); //Get the form details from database.
			$this->data['columns']=$form->num_columns;
			$this->data['form_name']=$form->form_name;
			$this->data['form_type']=$form->form_type;
			$this->data['patient']=array();
			$this->data['update']=0;
			$print_layout_page=$form->print_layout_page;
			$this->load->view('templates/header',$this->data);
			$this->load->library('form_validation');
			//Set validation rules for the forms
			$this->form_validation->set_rules('form_type','Form Type','trim|xss_clean');
			if ($this->form_validation->run() === FALSE)
			{
				//if the form validation fails, or the form has not been submitted yet
				$this->load->view('pages/custom_form',$this->data); //Load the view custom_form
			}
			else{
				if($this->input->post('search_patients')){
					//if the user searches for a patient, get the list of patients that matched the query.
					$this->data['patients']=$this->register_model->search();
					if(count($this->data['patients'])==1) {
						$visit_id = $this->data['patients'][0]->visit_id;
						$this->data['patient']=$this->register_model->select($visit_id);
                                                $this->data['ip_count'] = $this->counter_model->get_counters("IP");
						if($this->data['patient']->visit_type == "IP") {
                                                    $this->data['update']=1;                                                    
                                                }
					}
				}
				else if($this->input->post('select_patient') && $visit_id!=0){
					//else if the user has selected a patient after searching, get the patient details.
					$this->data['patient']=$this->register_model->select($visit_id);
                                         $this->data['ip_count'] = $this->counter_model->get_counters("IP");
					if($this->input->post('visit_type')=="IP"){
						//If the selected visit type is IP, the form only updates the values, else it inserts by default.
						$this->data['update']=1;
					}
				}
				else if($this->input->post('register')){
					// if the register button has been clicked, invoke the register function in register_model.
					// Get the inserted patient details from the function and store it in a variable to display
					// in the views.
						$this->data['registered']=$this->register_model->register(); 
					if(is_int($this->data['registered']) && $this->data['registered']==2){
						//If register function returns value 2 then we are setting a duplicate ip no error.
						$this->data['duplicate']=1;
					}
					
					//Set the print layout page based on the form selected.
					$this->data['print_layout']="pages/print_layouts/$print_layout_page";
				}
				//load the custom_form page with the data loaded.
				$this->load->view('pages/custom_form',$this->data);

			}

			//Load the footer.
			$this->load->view('templates/footer');
			}
			else {
				$this->data['title']="Patient Registration"; //Set the page title to be used by the header.
				$this->load->view('templates/header',$this->data);
				$this->load->view('pages/error_access');
				$this->load->view('templates/footer');
			}
			}
		}
		else{
			//else if the user hasn't selected a hospital yet, redirect to home page for selection.
			redirect('home','refresh');
		}
		
	}// custom_form
	
	function get_states() {
		$result = json_encode($this->masters_model->get_data('state_codes'));
		print $result;
	}// get_states;
	
	function get_districts() {
		$result = json_encode($this->staff_model->get_district_codes());
		print $result;
	}// get_districts

	function view_patients(){
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="View Patients"){
				$access=1;
			}
		}
		if($access==1){
		$this->data['title']="View Patients";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['all_departments']=$this->staff_model->get_department();
		$this->data['units']=$this->staff_model->get_unit();
		$this->data['areas']=$this->staff_model->get_area();
		$this->form_validation->set_rules('patient_number', 'IP/OP Number',
		'trim|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/view_patients',$this->data);
		}
		else{
			$this->data['patients']=$this->register_model->search();
			if(count($this->data['patients'])==1){
				$this->load->model('diagnostics_model');
				$visit_id = $this->data['patients'][0]->visit_id;
				$patient_id = $this->data['patients']['0']->patient_id;
				$this->data['prescription']=$this->register_model->get_prescription($visit_id);
				$this->data['previous_visits']=$this->register_model->get_visits($patient_id);
				$this->data['tests']=$this->diagnostics_model->get_all_tests($visit_id);
			}
			$this->load->view('pages/view_patients',$this->data);
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
		}
		else{
		show_404();
		}
	}
	function update_patients(){
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="Update Patients"){
				$access=1;
			}
		}
		if($access==1){
		$this->data['title']="Update Patients";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['all_departments']=$this->staff_model->get_department();
		$this->data['units']=$this->staff_model->get_unit();
		$this->data['areas']=$this->staff_model->get_area();
		$this->data['districts']=$this->staff_model->get_district();
		$this->data['id_proof_types']=$this->staff_model->get_id_proof_type();
		$this->data['occupations']=$this->staff_model->get_occupations();
		$this->data['lab_units'] = $this->masters_model->get_data("lab_unit");
		$this->data['drugs'] = $this->masters_model->get_data("drugs");
		$this->data['procedures'] = $this->masters_model->get_data("procedure");
		$this->data['defaults'] = $this->staff_model->get_transport_defaults();
              //  $this->data['hospitals'] = $this->hospital_model->get_hospitals();
              //  $this->data['arrival_modes'] = $this->patient_model->get_arrival_modes();
        $this->data['visit_names'] = $this->staff_model->get_visit_name();
		$this->form_validation->set_rules('patient_number', 'IP/OP Number',
		'trim|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/update_patients',$this->data);
		}
		else{
		
			$this->data['transporters'] = $this->staff_model->get_staff("Transport");
			if($this->input->post('update_patient')){
				$update = $this->register_model->update();
                if(is_int($update) && $update==2){
					//If register function returns value 2 then we are setting a duplicate ip no error.
					$this->data['duplicate']=1;
				}
				$this->data['transfers'] = $this->patient_model->get_transfers_info();
				$this->data['transport'] = $this->staff_model->get_transport_log();
				$this->data['patients']=$this->register_model->search();
				$this->data['msg'] = "Patient information has been updated successfully";
				if(count($this->data['patients'])==1){
					$this->load->model('diagnostics_model');
					$visit_id = $this->data['patients'][0]->visit_id;
					$this->data['prescription']=$this->register_model->get_prescription($visit_id);
					$this->data['tests']=$this->diagnostics_model->get_all_tests($visit_id);
				}
				$this->load->view('pages/update_patients',$this->data);
			}
			else{
				$this->data['patients']=$this->register_model->search();
				if(count($this->data['patients'])==1){
					$this->load->model('diagnostics_model');
					$visit_id = $this->data['patients'][0]->visit_id;
                    $this->data['transfers'] = $this->patient_model->get_transfers_info($visit_id);
					$this->data['transport'] = $this->staff_model->get_transport_log();
					$this->data['prescription']=$this->register_model->get_prescription($visit_id);
					$this->data['tests']=$this->diagnostics_model->get_all_tests($visit_id);
				}
				$this->load->view('pages/update_patients',$this->data);
			}
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
		}
		else{
		show_404();
		}
	}
	function search_icd_codes(){
		if($icd_codes = $this->register_model->search_icd_codes()){
			$list=array(
				'icd_codes'=>$icd_codes
			);
			
				echo json_encode($list);
		}
		else return false;
	}
	
	function transport(){		
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="Patient Transport"){
				$access=1;
			}
		}
		if($access==1){
		$this->data['title']="Patient Transport";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['all_departments']=$this->staff_model->get_department();
		$this->data['units']=$this->staff_model->get_unit();
		$this->data['areas']=$this->staff_model->get_area();
		$this->data['defaults'] = $this->staff_model->get_transport_defaults();
        $this->data['visit_names'] = $this->staff_model->get_visit_name();
		$this->data['transporters'] = $this->staff_model->get_staff("Transport");
		$this->form_validation->set_rules('patient_number', 'IP/OP Number', 'trim|xss_clean');
		$this->data['transport_queue_np'] = $this->staff_model->get_transport_log("active","np");
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/transport',$this->data);
		}
		else{
		
			if($this->input->post('transport')){
				if($this->register_model->transport()){
					$this->data['msg']="Updated Successfully";
				}
				$this->data['transport_queue'] = $this->staff_model->get_transport_log("active");
				$this->data['patients']=$this->register_model->search();
				if(count($this->data['patients'])==1){
					$visit_id = $this->data['patients'][0]->visit_id;
				}
				$this->load->view('pages/transport',$this->data);
			}
			else if($this->input->post('transport_np')){
				if($this->register_model->transport("np"))
					$this->data['msg']="Updated Successfully";
				$this->data['transport_queue_np'] = $this->staff_model->get_transport_log("active","np");
				$this->load->view('pages/transport',$this->data);
			}
			else{
				$this->data['patients']=$this->register_model->search();
				if(count($this->data['patients'])==1){
					$visit_id = $this->data['patients'][0]->visit_id;
					$this->data['transport_queue'] = $this->staff_model->get_transport_log("active");
				}
				$this->load->view('pages/transport',$this->data);
			}
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
		}
		else{
		show_404();
		}
		
	}
}