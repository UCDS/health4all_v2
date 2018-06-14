 <?php 

class sanitation_crud extends CI_Controller{
    private $navigate = array(
        "evaluate" => array(
            "header"=> "templates/header",
            "left_nav"=> "templates/leftnav",
            "page"=> "page",
            "footer"=> "templates/footer",
            "page_name" => "pages/sanitation/evaluation_form",
            "title" => ""Evaluate Sanitation Works"",
            "data_source" => array('sanitation_activity',),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        ),
        "view_scores" => array(
            "header"=>"templates/header",
            "left_nav"=>"templates/leftnav",
            "page"=>"page",
            "footer"=>"templates/footer",
            "page_name" => "'pages/sanitation/scores_detail'",
            "title" => "Evaluate Sanitation Works",
            "data_source" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        ),
        "view_summary" => array(
            "header"=>"templates/header",
            "left_nav"=>"templates/leftnav",
            "page"=>"page",
            "footer"=>"templates/footer",
            "page_name" => "pages/sanitation/scores",
            "title" => "Evaluate Sanitation Works",
            "data_source" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        ),
        "add" => array(
            "header"=>"templates/header",
            "left_nav"=>"templates/leftnav",
            "page"=>"pages/sanitation/add_".$type."_form"",
            "footer"=>"templates/footer",
            "page_name" => "page",
            "title" => "Add Area Type",
            "data_source" => array('area_types','hospital','states','districts','facility_type','village_town','area_activity','area_types','department','vendor','vendor_contracts'),                                 // set, get data navigate            
            "add_record" => array(""),                                   // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        ),
        "edit" => array(
            "header"=>"templates/header",
            "left_nav"=>"templates/leftnav",
            "page"=>""pages/sanitation/edit_".$type."_form"",
            "footer"=>"templates/footer",
            "page_name" => "page",
            "title" => "Edit area_types",
            "data_source" => array("area_types","area_activity","districts","states","facility","village_town","facility_activity","area","vendor","vendor_contracts","$type",'masters_model'),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        ),
        "db_alter" => array(
            "header"=>"header",
            "left_nav"=>"",
            "page"=>"db_alter",
            "footer"=>"footer",
            "page_name" => "Alter Database",
            "title" => "Alter-Database",
            "data_source" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        ),
        "db_create" => array(
            "header"=>"header",
            "left_nav"=>"",
            "page"=>"db_create",
            "footer"=>"footer",
            "page_name" => "Database Create",
            "title" => "Database-Create",
            "data_source" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        ),
        "define_access_control" => array(
            "header"=>"header",
            "left_nav"=>"",
            "page"=>"define_access_control",
            "footer"=>"footer",
            "page_name" => "Define Access Control",
            "title" => "Define-Access-Control",
            "data_source" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        ),
        "get_existing_databases" => array(
            "header"=>"header",
            "left_nav"=>"database_analysis/left_nav",
            "page"=>"database_analysis/get_existing_databases",
            "footer"=>"footer",
            "page_name" => "Define Access Control",
            "title" => "Define-Access-Control",
            "data_source" => array(
                "get_existing_databases" => array(
                    "html_elements" => array(
                        "db_select_drop_down" => array(
                            "functions" => array(
                                'create_dropdown' => array(
                                    'current_value' => false,                       //Mandatory fields for all methods failing with you will get an empty element
                                    'dataset' => 'get_existing_database',           //Mandatory fields for all methods failing with you will get an empty element
                                    'input_name' => 'set_current_database',         //Mandatory fields for all methods failing with you will get an empty element
                                    'visible_data_point' => 'database_name',
                                    'value_data_point'  => 'database_id' 
                                )
                            )
                        ),
                    ),
                    "html_containers" => array(
                        "name" => array(
                            "function" => array(),
                            "data_from_data_sources" => array()
                        ),
                        "select_db_div" => array(
                            'create_div' => array(
                                'elements' => array(
                                    'db_select_drop_down'  
                                ),
                                'containers' => false
                            )                            
                        )
                    ) 
                ),
            ),           // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        ),
        "table_create" => array(
            "header"=>"header",
            "left_nav"=>"",
            "page"=>"define_access_control",
            "footer"=>"footer",
            "page_name" => "Define Access Control",
            "title" => "Define-Access-Control",
            "data_source" => array(""),                                 // set, get data navigate            
            "add_record" => array(""),                                  // sequence
            "update_record" => array(""),                               // sequence
            "data_session" => array("")
        )
    );
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
        $this->load->model('data_get_set_model');
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
        if($navigate === FALSE){
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
        if($this->input->post('submit') != NULL && array_key_exists('add_record', $this->navigate[" "])){            
           if($this->data_capture_model->add_data($this->navigate["$navigate"]['add_record'])){
               $this->data['success']='Data succesfully added';  
           }else{
               $this->data['error']='Data not captured';
           }
        }
        // Update data to MySQL
        if($this->input->post('update_record') != NULL && array_key_exists('update_record', $this->navigate["$navigate"])){           
           if($this->data_capture_model->add_data($this->navigate["$navigate"]['update_record'], FALSE)){
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
            $data = $this->data_get_set_model->get_data($data_sources, $filters);
            var_dump($data);            
            foreach($data as $key => $value){
                $this->data["$key"] = $value;
            }            									
        }
       
       // Add data to session.
       $session_data = array();
       if(array_key_exists('session_record', $this->navigate["$navigate"])){
           $session_data = $this->data_get_set_model->get_data($this->navigate[$navigate]['session_record']);
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
       
       $this->load->view($this->navigate[$navigate]['header'], $this->data);
       $this->load->view($this->navigate[$navigate]['left_nav'], $this->data);
       $this->load->view($this->navigate[$navigate]['page'], $this->data);
       $this->load->view($this->navigate[$navigate]['footer'], $this->data);
       
    }
}

?>