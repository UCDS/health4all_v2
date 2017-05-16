<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {	

	function __construct(){
		parent::__construct();
		$this->load->model('reports_model');
	}

	public function view($organization="")
	{
		if(!!$organization) //if $organization variable is not empty
		{
			$this->load->helper('form');
			$this->data['organization']=$organization;
			$this->data['report']=$this->reports_model->dashboard($organization);	
			$this->load->view('pages/dashboard',$this->data);
		}
		else{
			show_404();
		}
		$this->load->view('templates/footer');
	}
}