<?php
class Data_get_set_model extends CI_Model{
    private $set_data_route = array(
        "set_data_template" => array(
            "root_table" => "",
            "select_string" => "",
            "and_where_filters" => "",
            "session_filter" => "",
            "file_fields" => "",    //file settings => field_names array
            "session_fields" => ""
        )
    );
    private $get_data_route = array(
        "get_data_template" => array(
            "root_table" => "",
            "select_string" => "",
            "simple_join" => "",                                // untested
            "and_where_filters" => "",
            "session_filter" => "",
        ),
        "get_existing_databases" => array(
            "root_table" => "database_configuration",
            "select_string" => array("*"),
            "simple_join" => "",                                // untested
            "and_where_filters" => "",
            "session_filter" => "",
        )
    );
    private $file_fields = array(
        "default_public_image" => array(
            "fields"=>array(
                "field_name"=>"company_logo",
                "configuration"=>array(
                    "upload_path"=>"./assets/company_site_images/",
                    "allowed_types"=>"gif|jpg|png",
                    "file_ext_tolower"=>"TRUE",
                    "overwrite"=>"TRUE",
                    "max_size"=>"512",
                    "max_width"=>"1920",
                    "max_height"=>"1200",
                    "min_width"=>"1024",
                    "min_height"=>"768"
                )
            )
        ),
        "default_private_image" => array(
            "fields"=>array(
                "field_name"=>"company_logo",
                "configuration"=>array(
                    "upload_path"=>"./assets/company_site_images/",
                    "allowed_types"=>"gif|jpg|png",
                    "file_ext_tolower"=>"TRUE",
                    "overwrite"=>"TRUE",
                    "max_size"=>"512",
                    "max_width"=>"1920",
                    "max_height"=>"1200",
                    "min_width"=>"1024",
                    "min_height"=>"768"
                )
            )
        ),
        "default_doc" => array(

        ),
        "default_"
    );

    function __construct(){
        parent::__construct();
    }

    function add_data($route = FALSE, $mode = TRUE){        
        // Getting record, record set
        $record = $this->route["$route"]['root_table'];
        if(!$route){
            return false;
        }
        $input_data = array();
        
        // Build the data set
        // Getting data set, parameters set
        foreach($this->route[$route]['fields'] as $field){
            if($this->input->post($field) != NULL){
                $input_data[$field] = $this->input->post($field);
            }
        }
        
        if(array_key_exists('session_fields', $this->route["$route"])){
            $session_keys = array();
            $session_keys = $this->route["$route"]['session_fields'];
            foreach($session_keys as $session_key){              
                if($session_key != NULL && $this->session->has_userdata("$session_key")){
                    $input_data[$session_key] = $this->session->$session_key;
                }
            }
        }

        // Build the file set
        if(array_key_exists('file_fields', $this->route["$route"])){
            $file_field = $this->route["$route"]['file_fields'];
            foreach($file_field as $file){
                foreach($this->file_fields["$file"] as $field){
                    $this->load->library('upload');
                    $this->upload->initialize($field["configuration"]);
                    if($this->upload->do_upload($field["field_name"])){
                        $input_data[$field["field_name"]] = $this->upload->data('file_name');
                    }else{
                        $uploaded= $this->upload->display_errors();
                    }
                }
            }            
        }
        
        // Build and where filters
        $and_where_filters = array();
        if(array_key_exists("and_where_filters", $this->route["$route"])){
           $filters = $this->route["$route"]['and_where_filters'];
           foreach($filters as $filter){
               if($this->input->post("$filter") != NULL){
                   $and_where_filters[$filter] = $this->input->post("$filter");
               }else{
                   return false;
               }               
           } 
        }
        
        
        if(!empty($input_data)){
            if($mode){
                $this->db->insert($record, $input_data);
            }else if(!empty($and_where_filters)){
                $this->db->where($and_where_filters);
                $this->db->update("$record", $input_data);
            }
        }
        return true;
    }

    function get_data($routes = false, $set_filter = false){
        // Routes are set
        if(!$routes){
            return false;
        }
        $return_data = array();
        
        // Entering foreach
        foreach($routes as $route => $value){
            if(array_key_exists($route, $this->get_data_route)){
                  // Session filter
                  $session_filters = array_key_exists("session_filter", $this->get_data_route[$route]) ? $this->get_data_route[$route]['session_filter'] : FALSE;
                  // Select string                  
                  
                  $select_string = array();
                  foreach($this->get_data_route[$route]['select_string'] as $field){
                      $select_string[] = $this->get_data_route[$route]['root_table'].'.'.$field;    // Add an as here.
                  }

                  // And where filter
                  $and_where_array = array();
                  $where_not_set = true;           
                  if(array_key_exists('and_where_filters', $this->get_data_route[$route])){
                        $filters = !!$this->get_data_route[$route]['and_where_filters'] ? $this->get_data_route[$route]['and_where_filters'] : array();
                        foreach($filters as $filter){ 
                            if($this->input->post($filter) != NULL){                    
                                $and_where_array[$this->get_data_route[$route]['root_table'].'.'.$filter] = $this->input->post($filter);
                            }else if(!$set_filter && !$session_filters){
                                $where_not_set = false;
                            }
                        }                                    
                    }
                    //And where filter not set
                    if(!$where_not_set){
                        $return_data[$route] = false;
                        continue;
                    }


                    // Set filter for generic filters
                    if($set_filter){
                        foreach($set_filter as $key => $value){
                            $and_where_array[$this->get_data_route[$route]['root_table'].'.'.$key] = $value;
                        }
                    }
                    
                    // Build Session filters                       
                    if($session_filters){           
                        foreach($session_filters as $filter){
                            if($this->session->has_userdata("$filter")){
                                $and_where_array[$this->get_data_route[$route]['root_table'].'.'.$filter] = $this->session->$filter; 
                            }               
                        } 
                    }
   
                    $this->db->select($select_string);
                    $this->db->from($this->get_data_route[$route]['root_table']);
                    if(sizeof($and_where_array) > 0){
                        $this->db->where($and_where_array);
                    }                    
                    
                    $query = $this->db->get();        
                    $result = $query->result();
      
                    if($result){
                         $return_data[$route] = $result;    // Route exists with data    
                    }else{
                         $return_data[$route] = false;      // Route exists no data
                    }
            }else{
                $return_data[$route] = false;               // Route does not exist
            }
        }
        return $return_data;
    }
}

?>