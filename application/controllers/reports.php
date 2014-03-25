<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('reports_model');
	}
	public function index(){
		if($this->session->userdata('logged_in')){
		$data['userdata']=$this->session->userdata('logged_in');
		$data['title']="Reports";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
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
		$data['title']="Out-Patient Summary Report";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/op_summary');
		}
		else{
			$data['report']=$this->reports_model->get_op_summary();
			$this->load->view('pages/op_summary',$data);
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
		$data['title']="Out-Patient Detailed Report";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('from_date', 'From Date',
		'trim|required|xss_clean');
	    $this->form_validation->set_rules('to_date', 'To Date', 
	    'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/op_detailed');
		}
		else{
			$data['report']=$this->reports_model->get_op_detail();
			$this->load->view('pages/op_detailed',$data);
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}

}

