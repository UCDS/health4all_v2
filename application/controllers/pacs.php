<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pacs extends CI_Controller
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
	function import(){
        if($this->session->userdata('logged_in'))
		    $this->data['userdata']=$this->session->userdata('logged_in');
        else
            show_404();
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="Diagnostics"){
				$access=1;
			}
		}
		if($access==1){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$user=$this->session->userdata('logged_in');
			$this->data['user_id']=$user['user_id'];
			$title = 'Import DICOM Images';
			$config = array(
				array(
					'field' => 'patient_id',
					'label' => 'Patient',
					'rules' => 'trim|xss_clean'
				)  
			 );
			$this->data['test_masters']=$this->masters_model->get_data('test_name',0,$this->data['departments']);
			$page="pages/diagnostics/pacs/dicom_import";
			$this->data['title']=$title;
			$this->load->view('templates/header',$this->data);
			$this->load->view('templates/leftnav');
			//form configuration is set based on the option selected from the menu
			$this->form_validation->set_rules($config);

			//if the form contains any invalid data same page along with error msg is shown.
			if ($this->form_validation->run() === FALSE)
			{
				$this->data['dicoms'] = $this->diagnostics_model->get_new_dicoms();
				$this->load->view($page,$this->data);
			}
			else
			{
				if($this->input->post('select_test')){	
					$this->data['mode']='select';
					
					$this->data['test_masters']=$this->diagnostics_model->get_test_masters_radiology();
					$this->load->view($page,$this->data);	
				}
				else if($this->input->post('import_dicom')){	
					if($this->diagnostics_model->import_dicom()){
						$this->data['msg'] = "Test imported successfully";
					}
					else{
						$this->data['msg'] = "Error while importing, please try again.";
					}
				$this->data['dicoms'] = $this->diagnostics_model->get_new_dicoms();
					$this->load->view($page,$this->data);
				}
				else
					$this->load->view($page,$this->data);				
			}
			$this->load->view('templates/footer');
		}
		else show_404();
    }
	
	
	function view($study){
        if($this->session->userdata('logged_in'))
		    $this->data['userdata']=$this->session->userdata('logged_in');
        else
            show_404();
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="Diagnostics"){
				$access=1;
			}
		}
		if($access==1){
			$user=$this->session->userdata('logged_in');
			$this->data['user_id']=$user['user_id'];
			$title = 'DICOM Image Viewer';
			$this->data['images'] = $this->diagnostics_model->get_dicom_images($study);
			$page="pages/diagnostics/pacs/dicom_view";
			$this->data['title']=$title;
			$this->load->view($page,$this->data);
		}
		else show_404();
    }
}
?>