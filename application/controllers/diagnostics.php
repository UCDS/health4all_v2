<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class diagnostics extends CI_Controller
{
function __construct(){
parent::__construct();
		$this->load->model('masters_model');
		$this->load->model('staff_model');
		$this->load->model('diagnostics_model');
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

function test_order(){
	if(!$this->session->userdata('logged_in')){
		show_404();
	}
	$this->load->helper('form');
	$this->load->library('form_validation');
	$user=$this->session->userdata('logged_in');
	$this->data['user_id']=$user['user_id'];	  
	$this->data['title']="Order Test";
	$page="pages/diagnostics/test_order_form";
	$this->load->view('templates/header',$this->data);
	$this->load->view('templates/leftnav');
	$this->form_validation->set_rules('visit_id','Patient','required|trim|xss_clean');
	$this->data['test_areas']=$this->masters_model->get_data('test_area');
	$this->data['test_masters']=$this->masters_model->get_data('test_name');
	$this->data['test_groups']=$this->masters_model->get_data('test_group');
	$this->data['specimen_types']=$this->masters_model->get_data('specimen_type');
	if ($this->form_validation->run() === FALSE){
		$this->load->view($page,$this->data);
	}
	else{	
		if(($this->input->post('submit'))||($this->diagnostics_model->order_test())){
		$this->data['msg']="Order has been placed successfully";
		$this->load->view($page,$this->data);
		}
		else{
		$this->data['msg']="Order could not be placed. Please try again.";
		$this->load->view($page,$this->data);
		}
	}
	$this->load->view('templates/footer');
}


function view_orders(){
	if(!$this->session->userdata('logged_in')){
		show_404();
	}
	$this->load->helper('form');
	$this->load->library('form_validation');
	$user=$this->session->userdata('logged_in');
	$this->data['user_id']=$user['user_id'];	  
	$this->data['title']="View Orders";
	$page="pages/diagnostics/test_orders";
	$this->load->view('templates/header',$this->data);
	$this->load->view('templates/leftnav');
	$this->form_validation->set_rules('order_id','Order','trim|xss_clean');
	$this->data['test_areas']=$this->masters_model->get_data('test_area');
	if ($this->form_validation->run() === FALSE){
		$this->load->view($page,$this->data);
	}
	else{
		if($this->input->post('submit_results')){
			if($this->diagnostics_model->upload_test_results()){
				$this->data['msg']="Test results saved successfully";
			}
			else{
				$this->data['msg']="Test results could not be saved";
			}
			$this->data['order']=$this->diagnostics_model->get_order();
			$this->load->view($page,$this->data);
		}	
			
		else if($this->input->post('order_id')){
			$this->data['order']=$this->diagnostics_model->get_order();
			$this->load->view($page,$this->data);
		}	
		else{
			$this->data['orders']=$this->diagnostics_model->get_tests_ordered();
			$this->load->view($page,$this->data);
		}
	}
	$this->load->view('templates/footer');
}

function search_patients(){
	if($patients = $this->diagnostics_model->search_patients()){
		return json_encode($patients);
	}
	else return json_encode("hello");
}
	
//************************************************************************************//  	
// Function for Add Forms in Diagnostics Module commence here   	
//************************************************************************************//	
function add($type=""){
	if(!$this->session->userdata('logged_in')){
	show_404();
	}
	$this->load->helper('form');
	$this->load->library('form_validation');
	$user=$this->session->userdata('logged_in');
	$this->data['user_id']=$user['user_id'];	
	if($type=="test_method")
	{
		$title="Test Method";
		$config=array(
		array('field' => 'test_method',
		'label' => 'Test Method',
		'rules' => 'required|trim|xss_clean',
		)
		);
	}
	if($type=="test_group"){
			$title="Test Group";
			$config=array(array('field' => 'group_name','label'=>'Group_Name','rules'=>'required|trim|xss_clean' ));
			$this->data['test_names']=$this->masters_model->get_data("test_name");

		}
	if($type=="test_status_type"){
			$title="Test Status Type";
			$config=array(array('field' => 'test_status_type','label'=>'Test_Status_Type','rules'=>'required|trim|xss_clean' ));

		}
	if($type=="test_name"){
			$title="Test Name";
			$config=array(
				array(
					'field' => 'test_name[]',
					'label'=>'Test Name',
					'rules'=>'required|xss_clean' 
				),
				array(
					'field' => 'test_method',
					'label'=>'Test Method',
					'rules'=>'required|xss_clean' 
				),
				array(
					'field' => 'test_area',
					'label'=>'Test Area',
					'rules'=>'required|xss_clean' 
				)
			);
			$this->data['test_methods']=$this->masters_model->get_data("test_method");
			$this->data['test_areas'] = $this->masters_model->get_data("test_area");
		}
	if($type=="test_area"){
			$title="Test Area";
			$config=array(array('field' => 'test_area','label'=>'Test Area','rules'=>'required|trim|xss_clean' ));
		}
	if($type=="antibody"){
			$title="antibody";
			$config=array(array('field' => 'antibody','label'=>'Antibody','rules'=>'required|trim|xss_clean' ));

		}
		if($type=="micro_organism"){
			$title="micro_organism";
			$config=array(array('field' => 'micro_organism','label'=>'Micro_Organism','rules'=>'required|trim|xss_clean' ));

		}
	if($type=="specimen_type"){
			$title="Specimen Type";
			$config=array(array('field' => 'specimen_type','label'=>'Specimen_Type','rules'=>'required|trim|xss_clean' ));

		}
	if($type=="sample_status"){
			$title="Sample Status";
			$config=array(array('field' => 'sample_status','label'=>'Sample Status','rules'=>'required|trim|xss_clean' ));

	}
	if($type=="lab_unit"){
			$title="Add Lab Units";
			$config=array(array('field' => 'lab_unit','label'=>'Lab Unit','rules'=>'required|trim|xss_clean' ));

	}
	   $this->data['title']=$title;
	$page="pages/diagnostics/add_".$type."_form";
	$this->load->view('templates/header',$this->data);
	$this->load->view('templates/leftnav');
	$this->form_validation->set_rules($config);
	 
	if ($this->form_validation->run() === FALSE){
	$this->load->view($page,$this->data);
	}
	else{	
	if(($this->input->post('submit'))||($this->masters_model->insert_data($type))){
	$this->data['msg']=" Inserted Successfully";
	$this->load->view($page,$this->data);
	}
	else{
	$this->data['msg']="Failed";
	$this->load->view($page,$this->data);
	}

	}
	  $this->load->view('templates/footer');
}

//************************************************************************************//  	
// Function for Edit Forms in Diagnostics Module commence here   	
//************************************************************************************//
function edit($type="")
{
	$this->load->helper('form');
	$this->load->library('form_validation');
	$user=$this->session->userdata('logged_in');
	$this->data['user_id']=$user['user_id'];	
	if ($type=="test_method")
	{
	$title="Edit Test Method";
	//Defining field,name label and rules for the text field
	$config=array( array(
		   'field' => 'test_method',
		   'label' => 'Test Method',
		   'rules' => 'trim|xss_clean',
			));
			//load model and execute select query in order to populate search results
	$this->data['test_methods']=$this->masters_model->get_data("test_method");
	}
	if ($type=="test_group") {
			$title="Edit Test Group";
			//Defining  field,name label and rules for the text field
			$config=array( array(
		   'field' => 'group_name',
		   'label'   => 'Group Name ',
		   'rules'   => 'trim|xss_clean',
			));
			//load model and execute select query in order to populate search results
			$this->data['test_groups']=$this->masters_model->get_data("test_group");

		}
		
	if ($type=="test_status_type") {
			$title="Edit Test Group";
			//Defining  field,name label and rules for the text field
			$config=array( array(
		   'field' => 'test_status_type',
		   'label'   => 'Test Status Type ',
		   'rules'   => 'trim|xss_clean',
			));
			//load model and execute select query in order to populate search results
			$this->data['test_status_types']=$this->masters_model->get_data("test_status_type");

		}
		
		if ($type=="test_name") {
			$title="Edit Test Name";
			//Defining  field,name label and rules for the text field
			$config=array( array(
		   'field' => 'test_name[]',
		   'label'   => 'Test Name ',
		   'rules'   => 'xss_clean',
			));
			//load model and execute select query in order to populate search results
			$this->data['test_names']=$this->masters_model->get_data("test_name");
			$this->data['test_methods']=$this->masters_model->get_data("test_method");


		}
		if ($type=="test_area") {
			$title="Edit Test Area";
			//Defining  field,name label and rules for the text field
			$config=array( array(
		   'field' => 'test_area',
		   'label'   => 'Test Area ',
		   'rules'   => 'trim|xss_clean',
			));
			//load model and execute select query in order to populate search results
			$this->data['test_areas']=$this->masters_model->get_data("test_area");

		}
		if ($type=="antibody") {
			$title="Edit Antibody";
			//Defining  field,name label and rules for the text field
			$config=array( array(
		   'field' => 'antibody',
		   'label'   => 'Antibody ',
		   'rules'   => 'trim|xss_clean',
			));
			//load model and execute select query in order to populate search results
			$this->data['antibodys']=$this->masters_model->get_data("antibody");

		}
		if ($type=="micro_organism") {
			$title="Edit Micro Organism";
			//Defining  field,name label and rules for the text field
			$config=array( array(
		   'field' => 'micro_organism',
		   'label'   => 'Micro Organism ',
		   'rules'   => 'trim|xss_clean',
			));
			//load model and execute select query in order to populate search results
			$this->data['micro_organisms']=$this->masters_model->get_data("micro_organism");

		}
		if ($type=="specimen_type") {
			$title="Edit Specimen Type";
			//Defining  field,name label and rules for the text field
			$config=array( array(
		   'field' => 'specimen_type',
		   'label'   => 'Specimen Type',
		   'rules'   => 'trim|xss_clean',
			));
			//load model and execute select query in order to populate search results
			$this->data['specimen_types']=$this->masters_model->get_data("specimen_type");

		}
			if ($type=="sample_status") {
			$title="Edit Sample Status";
			//Defining  field,name label and rules for the text field
			$config=array( array(
		   'field' => 'sample_status',
		   'label'   => 'Sample Status',
		   'rules'   => 'trim|xss_clean',
			));
			//load model and execute select query in order to populate search results
			$this->data['sample_statuses']=$this->masters_model->get_data("sample_status");

		}	

	//defining filenname in view and also loading header,left nav bar and footer
	$page="pages/diagnostics/edit_".$type."_form";
	$this->data['title']=$title;
	$this->load->view('templates/header',$this->data);
		$this->load->view('templates/leftnav',$this->data);
	$this->form_validation->set_rules($config);
	if ($this->form_validation->run() === FALSE)
	{
	$this->load->view($page,$this->data);
	}
	else
	{
	if($this->input->post('update')) //when update button is clicked
	{
	if($this->masters_model->update_data($type)){ //if successfull
	$this->data['msg']="Updated Successfully";
	$this->load->view($page,$this->data);
	}
	else //if failed
	{
	$this->data['msg']="Failed";
	$this->load->view($page,$this->data);
	}
	}
	else if($this->input->post('select')) //when some row is selected from the results
	{

			$this->data['mode']="select";
	$this->data[$type]=$this->masters_model->get_data($type);
	   $this->load->view($page,$this->data);
	}
	else if($this->input->post('search')) //when user clicks search button
	{
	$this->data['mode']="search";
	$this->data[$type]=$this->masters_model->get_data($type);	
	$this->load->view($page,$this->data);
	}	
	}
	$this->load->view('templates/footer');
	}
}
?>
