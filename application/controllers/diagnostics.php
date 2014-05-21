<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class diagnostics extends CI_Controller
{
function __construct(){
parent::__construct();
$this->load->model('masters_model');
}
function add($type=""){
$this->load->helper('form');
$this->load->library('form_validation');
$user=$this->session->userdata('logged_in');
$data['user_id']=$user[0]['user_id'];	
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

	}
if($type=="specimen_type"){
		$title="Specimen Type";
		$config=array(array('field' => 'specimen_type','label'=>'Specimen_Type','rules'=>'required|trim|xss_clean' ));

	}
if($type=="sample_status"){
		$title="Sample Status";
		$config=array(array('field' => 'sample_status','label'=>'Sample Status','rules'=>'required|trim|xss_clean' ));

	}
   $data['title']=$title;
$page="pages/diagnostics/add_".$type."_form";
$this->load->view('templates/header',$data);
$this->load->view('templates/diagnosis_leftnav');
$this->form_validation->set_rules($config);
 
if ($this->form_validation->run() === FALSE){
$this->load->view($page,$data);
}
else{	
if(($this->input->post('submit'))||($this->masters_model->insert_data($type))){
$data['msg']=" Inserted Successfully";
$this->load->view($page,$data);
}
else{
$data['msg']="Failed";
$this->load->view($page,$data);
}

}
  $this->load->view('templates/footer');
}

function edit($type="")
{
$this->load->helper('form');
$this->load->library('form_validation');
$user=$this->session->userdata('logged_in');
$data['user_id']=$user[0]['user_id'];	
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
$data['test_methods']=$this->masters_model->get_data("test_method");
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
		$data['test_groups']=$this->masters_model->get_data("test_group");

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
		$data['specimen_types']=$this->masters_model->get_data("specimen_type");

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
		$data['sample_statuses']=$this->masters_model->get_data("sample_status");

	}	

//defining filenname in view and also loading header,left nav bar and footer
$page="pages/diagnostics/edit_".$type."_form";
$data['title']=$title;
$this->load->view('templates/header',$data);
	$this->load->view('templates/diagnosis_leftnav',$data);
$this->form_validation->set_rules($config);
if ($this->form_validation->run() === FALSE)
{
$this->load->view($page,$data);
}
else
{
if($this->input->post('update')) //when update button is clicked
{
if($this->masters_model->update_data($type)){ //if successfull
$data['msg']="Updated Successfully";
$this->load->view($page,$data);
}
else //if failed
{
$data['msg']="Failed";
$this->load->view($page,$data);
}
}
else if($this->input->post('select')) //when some row is selected from the results
{

		$data['mode']="select";
$data[$type]=$this->masters_model->get_data($type);
   $this->load->view($page,$data);
}
else if($this->input->post('search')) //when user clicks search button
{
$data['mode']="search";
$data[$type]=$this->masters_model->get_data($type);	
$this->load->view($page,$data);
}	
}
$this->load->view('templates/footer');
}
}
?>