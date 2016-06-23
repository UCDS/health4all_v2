<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_panel extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('bloodbank/reports_model');		
		$this->load->model('bloodbank/register_model');	
        $this->load->model('bloodbank/inventory_model');		
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
	function place(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['title']="Places";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['hospitaldata']=$this->session->userdata('hospital');
		$this->data['camps']=$this->register_model->get_camps();
		if($this->input->post('add_camp')){
				if($this->staff_model->add_camp()){
					$this->data['camps']=$this->register_model->get_camps();
					$this->data['msg']="Camp added successfully";

					$this->load->view('templates/header',$this->data);
					$this->load->view('templates/panel_nav',$this->data);
					$this->load->view('pages/bloodbank/place',$this->data);
				}
		}
		else if($this->input->post('reset')){
			$this->session->unset_userdata('place');
				$this->session->set_userdata('place',array('camp_id'=>0,'name'=>'Blood Bank'));

				$this->load->view('templates/header',$this->data);
				$this->load->view('templates/panel_nav',$this->data);
				$this->load->view('pages/bloodbank/place');
		}
		else if($this->input->post('set_camp')){
			$this->session->unset_userdata('place');
			$camp=$this->register_model->get_camps($this->input->post('camp'));
			$sess_array=array(
				'camp_id'=>$camp[0]->camp_id,
				'name'=>$camp[0]->camp_name,
				'location'=>$camp[0]->location
			);
			$this->session->set_userdata('place',$sess_array);

			$this->load->view('templates/header',$this->data);
			$this->load->view('templates/panel_nav',$this->data);
			$this->load->view('pages/bloodbank/place',$this->data);
		}
		else{
			$this->load->view('templates/header',$this->data);
			$this->load->view('templates/panel_nav',$this->data);
			$this->load->view('pages/bloodbank/place',$this->data);
		}
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function blood_donors(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="Blood Donors";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['donors']=$this->reports_model->get_donors();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/blood_donors_report',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function blood_components(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="Blood & Components";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['donors']=$this->reports_model->get_components();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/blood_components_report',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function donation_summary(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="Donations Summary";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['hospitaldata']=$this->session->userdata('hospital');
		$this->data['summary']=$this->reports_model->get_donation_summary();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/panel_index',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function issue_summary(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="Issues Summary";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['summary']=$this->reports_model->get_issue_summary();
		$this->data['staff']=$this->staff_model->staff_list();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/report_issues_summary',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
		function invite_donor(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->load->library('email');
		$this->data['title']="Invite Donor";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/panel_nav',$this->data);
		$this->data['camps']=$this->register_model->get_camps();
		if($this->input->post('submit')){
			$this->data['donors']=$this->reports_model->send_sms_email_invite();
          $this->data['msg']="Sms Sent.";			
		}
		$this->data['donors']=$this->reports_model->get_invite_donors();
		$this->load->view('pages/bloodbank/invite_donor',$this->data);
		$this->load->view('templates/footer');	
		}
		
		else {
			show_404();
		}
		
	}
	function available_blood(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="Available Blood";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['available']=$this->reports_model->get_available_blood();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/available_blood_report',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function appointment_bookings(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="User Panel";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['appointments']=$this->reports_model->get_booked_appointments();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/appointment_bookings',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}

	function report_donations($camp="t",$blood_group=0,$sex=0,$donation_date=0,$from_date=0,$to_date=0){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="Donations detailed report";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['camps']=$this->register_model->get_camps();
		$this->data['from_date']=$from_date;
		$this->data['to_date']=$to_date;
		$this->data['donated']=$this->reports_model->get_donated_blood($camp,$blood_group,$sex,$donation_date,$from_date,$to_date);
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/report_donations',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function report_inventory($blood_group=0,$component_type=0){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="Inventory detailed report";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['inventory']=$this->reports_model->get_inventory($blood_group,$component_type);
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/report_inventory',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function report_screening(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['staff']=$this->staff_model->staff_list();
		$this->data['title']="User Panel";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['screened']=$this->reports_model->get_screened_blood();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/report_screening',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function report_issue($issue_date=0,$blood_group=0,$from_date=0,$to_date=0,$hospital=0){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['staff']=$this->staff_model->staff_list();
		$this->data['staff']=$this->staff_model->staff_list();
		$this->data['title']="Issue Report";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['issued']=$this->reports_model->get_issues($issue_date,$blood_group,$from_date,$to_date,$hospital);
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/report_issue',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function report_grouping(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['staff']=$this->staff_model->staff_list();
		$this->data['title']="User Panel";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['grouped']=$this->reports_model->get_grouped_blood();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/report_grouping',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function discard_report(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="User Panel";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['inventory']=$this->reports_model->get_discard_report();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/discard_report',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	function print_certificates(){
		if($this->session->userdata('logged_in')){
		if($to_date==0) {$to_date=date('Y-m-d');}	
		$this->load->helper('form');
		$this->data['title']="User Panel";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['camps']=$this->register_model->get_camps();
		$this->data['donors']=$this->reports_model->get_donors();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/print_certificates',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
	
	function hospital_issues(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="Issues - Hospital wise";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['summary']=$this->reports_model->get_hospital_issue_summary();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/reports_nav',$this->data);
		$this->load->view('pages/bloodbank/hospital_issues',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}
}
