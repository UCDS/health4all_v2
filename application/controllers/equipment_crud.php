<?php 

class Equipment_crud extends CI_Controller{
    private $navigate = array(
        "equipments_add" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/inventory/add_equipment_type_form",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "title",
            "data_sources" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
    /*
    private $host_names = array(
		"openaccounting.in" => array(
			"route"=>"welcome",
            "filters"=>false
		)
	);
    */
    function __construct(){
        parent::__construct();
        $this->load->model('equipment_crud_model');
    }   

    public function cr_data($navigate = FALSE){
        $headers = $this->input->request_headers();
	/*	if(!(array_key_exists('Host', $headers) && array_key_exists($headers['Host'], $this->host_names))){
			show_404();
			return;
		}
    */    
    /*    // Login check working
        if($this->session->logged_in != 'YES'){
            $navigate = 'login';
        }
    */
        // Navigation set check
        if($navigate == FALSE){
            $navigate = $this->input->get_post('navigate');
        }
        // Navigation set check
        if($navigate == NULL){
            $navigate = 'login';
        }       
        if(!array_key_exists($navigate, $this->navigate)){
            $navigate = 'login';
        }

        $this->data['empty'] = '';

        if($this->input->post('update') != NULL){
            $this->data["update_record"] = true;
        }else{
            $this->data["update_record"] = false;
        }

        // Add data to MySQL
        if($this->input->post('submit') != NULL && array_key_exists('add_record', $this->navigate["$navigate"])){            
           if($this->staff_crud_model->add_data($this->navigate["$navigate"]['add_record'])){
               $this->data['success']='Data succesfully added';  
           }else{
               $this->data['error']='Data not captured';
           }
        }
        // Update data to MySQL
        if($this->input->post('update_record') != NULL && array_key_exists('update_record', $this->navigate["$navigate"])){           
           if($this->staff_crud_model->add_data($this->navigate["$navigate"]['update_record'], FALSE)){
               $this->data['success']='Data succesfully captured';  
           }else{
               $this->data['error']='Data not captured';
           }
        }

        // Get data for view
        if(array_key_exists('data_source', $this->navigate["$navigate"])){
            $this->data['page_name'] = $this->navigate[$navigate]['page_name'];
			$filters = false; //$this->host_names[$headers['Host']]['filters'] ? $this->host_names[$headers['Host']]['filters'] : false;
			$data_sources = array();
			$data_sources = $this->navigate["$navigate"]['data_source'];            
            $data = $this->staff_crud_model->get_data($data_sources, $filters);
            var_dump($data);            
            foreach($data as $key => $value){
                $this->data["$key"] = $value;
            }            									
        }
       pages/inventory/report_$type
       // Add data to session.
       $session_data = array();
       if(array_key_exists('session_record', $this->navigate["$navigate"])){
           $session_data = $this->staff_crud_model->get_data($this->navigate[$navigate]['session_record']);
           if($session_data){
               foreach($this->navigate[$navigate]['session_record'] as $session_record){
                   if($session_data[$session_record]){
                       foreach($session_data[$session_record][0] as $key => $value){
                            $this->session->set_userdata("$key", "$value");
                       }
                   }                    
               }               
           }
       }
       
       $this->load->view($this->navigate[$navigate]['header']);
       $this->load->view($this->navigate[$navigate]['left_nav']);
       $this->load->view($this->navigate[$navigate]['page'], $this->data);
       $this->load->view($this->navigate[$navigate]['footer']);
       
    }
}

?>