<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
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
		$this->load->view('pages/dashboard_refresh');
	}

	public function view($organization="")
	{
		$this->load->model('reports_model');
		if(!!$organization) //if $organization variable is not empty
		{
			$this->load->helper('form');
			$this->data['organization']=$organization;
			$this->data['report']=$this->reports_model->dashboard($organization);
			$this->data['title']=$this->data['report'][0];
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/dashboard',$this->data);
		}
		else{
			show_404();
		}
		$this->load->view('templates/footer');
	}

	public function state($state=""){
			$this->load->model('reports_model');
			if(!!$state) //if $state variable is not empty
		{
				$this->load->helper('form');
				$this->data['state']=$state;

				$this->data['result']=$this->reports_model->dashboard("","state",$state);
				$this->data['title']=$this->data['result'][0];
				$this->data['report']=$this->data['result'][1];
				$this->load->view('templates/header',$this->data);
				$this->load->view('pages/state_dashboard',$this->data);

		}
		else{
			show_404();
		}
		$this->load->view('templates/footer');
	}
	public function helpline(){
		$this->load->helper('form');
		$this->data['title']="Helpline Dashboard";
		$this->load->model('helpline_model');
		$this->load->model('staff_model');
		$this->data['caller_type_report']=$this->helpline_model->dashboard('caller_type');
		$this->data['call_category_report']=$this->helpline_model->dashboard('call_category');
		$this->data['hospital_report']=$this->helpline_model->dashboard('hospital');
		$this->data['district_report']=$this->helpline_model->dashboard('district');
		$this->data['volunteer_report']=$this->helpline_model->dashboard('volunteer');
		$this->data['call_type_report']=$this->helpline_model->dashboard('call_type');
		$this->data['to_number_report']=$this->helpline_model->dashboard('to_number');
		$this->data['op_ip_report']=$this->helpline_model->dashboard('op_ip');
		$this->data['duration']=$this->helpline_model->dashboard('duration');
		$this->data['resolution_status']=$this->helpline_model->dashboard('resolution_status');
		$this->data['closed_tat']=$this->helpline_model->dashboard('closed_tat');
		$this->data['open_tat']=$this->helpline_model->dashboard('open_tat');
		$this->data['caller_type']=$this->helpline_model->get_caller_type();
		$this->data['call_category']=$this->helpline_model->get_call_category();
		$this->data['all_hospitals']=$this->staff_model->get_hospital();
		$this->data['hospital_districts']=$this->helpline_model->get_hospital_district();
		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/helpline/helpline_dashboard',$this->data);
		$this->load->view('templates/footer');
	}

	public function diagnostics_dashboard_1(){
		$this->data['title']="Diagnostics Dashboard - 1";
		$this->load->model('reports_model');
		$this->data['report']=$this->reports_model->diagnostic_dashboard_HospitalWise();
		$this->data['report1']=$this->reports_model->diagnostic_dashboard_AreaWise();
		$this->load->view('templates/header',$this->data);
		$this->load->helper('form');
		$this->load->view('pages/diagnostics_dashboard_1',$this->data);
		$this->load->view('templates/footer');
	}

	public function diagnostics_dashboard_2(){
		$this->data['title']="Diagnostics Board - 2";
		$this->load->model('reports_model');
		$this->data['report']=$this->reports_model->diagnostic_board();
		$this->data['report1']=$this->reports_model->diagnostic_board('lab_area');
		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/diagnostics_dashboard_2',$this->data);
		$this->load->view('templates/footer');
	}

	public function diagnostic_dashboard_hospitalwise($hospital_type=" "){
		$this->data['title']="Diagnostics Board";
		$this->data['type']="$hospital_type";
		$this->load->model('reports_model');
		$this->data['report']=$this->reports_model->diagnostic_hospital_board($hospital_type);
		$this->data['report1']=$this->reports_model->diagnostic_hospital_board($hospital_type,'lab_area');
		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/diagnostic_dashboard_hospitalwise',$this->data);
		$this->load->view('templates/footer');
	}
	/**
	* diagnostics_dashboard_1
	* diagnostics_dashboard_2
	* diagnostic_board_hospital
	* Added by : Manish Kumar
	*
	**/

	public function helpline_trend(){
		$this->load->helper('form');
		$this->data['title']="Helpline Trend Dashboard";
		$this->load->model('helpline_model');
		$this->load->model('staff_model');
		$this->data['caller_type']=$this->helpline_model->get_caller_type();
		$this->data['call_category']=$this->helpline_model->get_call_category();
		$this->data['resolution_status']=$this->helpline_model->get_resolution_status();
		$this->data['all_hospitals']=$this->staff_model->get_hospital();
		$this->data['hospital_districts']=$this->helpline_model->get_hospital_district();
		$this->data['report']=$this->helpline_model->helpline_trend();
		//var_dump($this->data['report']);
		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/helpline/helpline_trend',$this->data);
		$this->load->view('templates/footer');
	}

	public function bloodbanks(){
		$this->load->helper('form');
		$this->data['title']="Blood Banks Dashboard";
		$this->load->model('bloodbank/reports_model');
		$this->data['available']=$this->reports_model->get_available_blood(1);
		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/bloodbank/bloodbank_dashboard',$this->data);
		$this->load->view('templates/footer');
	}
	public function hospital($organization=""){
		$this->load->model('reports_model');
		$hospitalstarts=$this->reports_model->dashboard($organization,'hospital');
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($hospitalstarts));

	}
	public function department($organization=""){
		$this->load->model('reports_model');
		$deptstarts=$this->reports_model->dashboard($organization,'department');
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($deptstarts));

	}
	public function district($organization=""){
		$this->load->model('reports_model');
		$diststarts=$this->reports_model->dashboard($organization,'district');
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($diststarts));

	}

}
