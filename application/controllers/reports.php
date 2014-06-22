<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('reports_model');
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
	public function index(){
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="Reports";
		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/reports');
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function op_summary()
	{
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="OP Summary"){
				$access=1;
			}
		}
		if($access==1){
		$this->data['title']="Out-Patient Summary Report";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['report']=$this->reports_model->get_op_summary();
		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/op_summary');
		}
		else{
			$this->load->view('pages/op_summary',$this->data);
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
	public function ip_summary()
	{
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="IP Summary"){
				$access=1;
			}
		}
		if($access==1){
		$this->data['title']="In-Patient Summary Report";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['report']=$this->reports_model->get_ip_summary();
		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/ip_summary');
		}
		else{
			$this->load->view('pages/ip_summary',$this->data);
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
	
	public function op_detail($department=0,$gender=0,$from_age=0,$to_age=0,$from_date=0,$to_date=0)
	{
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="OP Detail"){
				$access=1;
			}
		}
		if($access==1){
		$this->data['title']="Out-Patient Detailed Report";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['report']=$this->reports_model->get_op_detail($department,$from_age,$to_age,$from_date,$to_date);
		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/op_detailed');
		}
		else{
			$this->load->view('pages/op_detailed',$this->data);
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
	public function ip_detail($department=-1,$gender=0,$from_age=0,$to_age=0,$from_date=0,$to_date=0)
	{
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$access=0;
		foreach($this->data['functions'] as $function){
			if($function->user_function=="IP Detail"){
				$access=1;
			}
		}
		if($access==1){
		$this->data['title']="In-Patient Detailed Report";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['report']=$this->reports_model->get_ip_detail($department,$gender,$from_age,$to_age,$from_date,$to_date);
		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/ip_detailed',$this->data);
		}
		else{
			$this->load->view('pages/ip_detailed',$this->data);
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

