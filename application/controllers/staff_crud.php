<?php 
class Staff_crud extends CI_Controller{
    private $navigate = array(
        "staff_add" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/staff/add_staff_form",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "Add Staff Details",
          "data_sources" => array("functions","op_forms","ip_forms","hospital","department","staff_category","unit","area","staf_role "),                                 // set, get data navigate            
            //"data_sources" => array("functions"),                                 // set, get data navigate 
           // var_dump($data_sources);           
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
        "login" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/login",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "Add Staff Details",
            "data_sources" => array("hospital","department","staff_category","unit","area","staf_role "),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
        "staff_edit" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/staff/edit_staff_form",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "Edit Staff",
            "data_sources" => array("department","unit","area","staff_role","designation","staff_category"),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
        "staff_view" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/staff/view_staff_form",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "View Staff",
            "data_sources" => array("department","unit","area","staff_category","staff_role","designation","transaction"),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
        "staff_add_transaction" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/staff/add_staff_transaction_form",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "Edit Transaction Category",
            "data_sources" => array("hr_transaction_types"),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
        "search_staff" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/staff/search_staff_form",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "search staff",
            "data_sources" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
        "staff_search_doctor" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/staff/search_doctor_form",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "search_doctor",
            "data_sources" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
        "staff_search_hospital" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/staff/search_hospital_form",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "search_hospital",
            "data_sources" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
        "staff_summary" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "pages/staff/staff_summary",
            "footer"=> "templates/footer",
            "page_name" => "page",
            "title" => "View Staff Summary",
            "data_sources" => array("department","staff_category","unit","area"),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "session_record" => array("")
        ),
    );
    /*

    private $host_names = array(
		"openaccounting.in" => array(
			"route"=>"welcome",
            "filters"=>false
		)
	);
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model('staff_crud_model');
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
        var_dump($this->data['empty'] = '');

        if($this->input->post('update') != NULL){
            $this->data["update_record"] = true;
        }else{
            $this->data["update_record"] = false;
            var_dump($this->data["update_record"]=false);
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
               //var_dump($this->data['success']);
           }else{
               $this->data['error']='Data not captured';
               //var_dump($this->data['error']='Data not captured');
           }
        }

        // Get data for view
        if(array_key_exists('data_source', $this->navigate["$navigate"])){
           // var_dump($navigate);
            $this->data['page_name'] = $this->navigate[$navigate]['page_name'];
            //var_dump( $this->data['page_name']);
			$filters = false; //$this->host_names[$headers['Host']]['filters'] ? $this->host_names[$headers['Host']]['filters'] : false;
			$data_sources = array();
			$data_sources = $this->navigate["$navigate"]['data_source'];            
            $data = $this->staff_crud_model->navigate_get($data_sources, $filters);           
            foreach($data as $key => $value){
                $this->data["$key"] = $value;
            }            									
        }
       //pages/inventory/report_$type
       // Add data to session.
       $session_data = array();
       if(array_key_exists('session_record', $this->navigate["$navigate"])){
           $session_data = $this->staff_crud_model->navigate_get($this->navigate[$navigate]['session_record']);
           if($session_data){
               foreach($this->navigate[$navigate]['session_record'] as $session_record){
                   if($session_data[$session_record])
                   {
                       foreach($session_data[$session_record][0] as $key => $value)
                       {
                            $this->session->set_userdata("$key", "$value");
                       }
                   }                    
               }               
           }
       }

       $this->load->view($this->navigate[$navigate]['header'],$this->data);
      // var_dump($this->data);
       $this->load->view($this->navigate[$navigate]['left_nav'],$this->data);
       $this->load->view($this->navigate[$navigate]['page'], $this->data);
       $this->load->view($this->navigate[$navigate]['footer'],$this->data);
       
    }
}

?>