<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class diagnostics extends CI_Controller
{
function __construct(){
		parent::__construct();
		$this->load->model('masters_model');
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

   $this->data['title']=$title;
$page="pages/diagnostics/add_".$type."_form";
$this->load->view('templates/header',$this->data);
$this->load->view('templates/diagnosis_leftnav');
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

//defining filenname in view and also loading header,left nav bar and footer
$page="pages/diagnostics/edit_".$type."_form";
$this->data['title']=$title;
$this->load->view('templates/header',$this->data);
	$this->load->view('templates/diagnosis_leftnav',$this->data);
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