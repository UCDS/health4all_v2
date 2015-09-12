<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test_mail extends CI_Controller
{
function __construct(){
parent::__construct();
}

function index(){
			$this->load->library('email');
			$this->email->from('mail@vivekc.in', 'Vivek C');
			$this->email->to("mail@vivekc.in");
			$this->email->bcc("contact@vivekc.in");
			$this->email->subject("Test");
			$this->email->message("TEst");
			if ( ! $this->email->send()) {
				$this->data['msg'] =  $this->email->print_debugger();
			}
			else{
				$this->data['msg'] =  $this->email->print_debugger();
			}
}
}

?>
