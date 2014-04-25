<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('reports_model');
		$this->load->model('staff_model');
		$this->data['op_forms']=$this->staff_model->get_forms("OP");
		$this->data['ip_forms']=$this->staff_model->get_forms("IP");
	}
	public function index(){
		if($this->session->userdata('logged_in')){
		$data['userdata']=$this->session->userdata('logged_in');
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
		$data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="Out-Patient Summary Report";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['report']=$this->reports_model->get_op_summary();
		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/op_summary');
		}
		else{
			$this->load->view('pages/op_summary',$data);
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function ip_summary()
	{
		if($this->session->userdata('logged_in')){
		$data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="In-Patient Summary Report";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['report']=$this->reports_model->get_ip_summary();
		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/ip_summary');
		}
		else{
			$this->load->view('pages/ip_summary',$data);
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	
	public function op_detail()
	{
		if($this->session->userdata('logged_in')){
		$data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="Out-Patient Detailed Report";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['report']=$this->reports_model->get_op_detail();
		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/op_detailed');
		}
		else{
			$this->load->view('pages/op_detailed',$data);
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function ip_detail()
	{
		if($this->session->userdata('logged_in')){
		$data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="In-Patient Detailed Report";
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['report']=$this->reports_model->get_ip_detail();
		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/ip_detailed');
		}
		else{
			$this->load->view('pages/ip_detailed',$data);
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}

}

