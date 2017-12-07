<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('api_model');
	}

	public function eaushadi($visit_id)
	{
    echo json_encode($this->api_model->get_data_aushadi($visit_id));
  }
}
