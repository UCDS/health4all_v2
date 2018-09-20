<?php
class Staff_crud_model extends CI_Model{
    private $navigate_get = array(
        "navigate_get_template"=>array(
            "root_table" => "hospital",
            "select_string" => array("hospital_id","hospital"),
            "simple_join" => array(
                "tables" => array(
                    'table_name'=>array('fields'), //..
                ),
                "join_on" => array(
                    array('table', 'join_fields', 'join_type'), //...
                )
            ),                                // untested
          //  "and_where_filters" => "",
            "session_filter" => array("hospital"),
        ),
        "hospital" => array(
            "root_table" => "hospital",
            "select_string" => array("hospital_id","hospital"),
            "simple_join" => "",
          //  "and_where_filters" => "",
            "session_filter" => array("hospital"),
        ),
        "department" => array(
            "root_table" => "department",
            "select_string" => array("department_id","hospital_id","department"),
            "simple_join" => "",
          //  "and_where_filters" => "",
            "session_filter" => array("hospital"),
        ),
        /*"hospitals" => array(
            "root_table" => "user",
            "select_string" => array("hospital.hospital_id","hospital","hospital_short_name","description","place","district","state","logo"),
            "simple_join" => "",
            "and_where_filters" => "",
            "session_filter" => "hospital",
        ),
        "departments" => array(
            "root_table" => "user",
            "select_string" => array("department.department_id","department","department_email"),
            "simple_join" => "",
            "and_where_filters" => "",
            "session_filter" => "hospital",
        ),*/
        "staff_category" => array(
            "root_table" => "staff_category",
            "select_string" => array("staff_category_id","staff_category"),
            "simple_join" => "",
            //"and_where_filters" => "",
            "session_filter" => array("hospital"),
        ),
        "unit" => array(
            "root_table" => "unit",
            "select_string" => array("unit_id","unit_name","department_id"),
            "simple_join" => "",
           // "and_where_filters" => "",
            "session_filter" => array("hospital"),
        ),
        "area" => array(
            "root_table" => "area",
            "select_string" => array("area_id","area_name","area.department_id","hospital_id"),
            "simple_join" => "",
            //"and_where_filters" => "",
            "session_filter" => array("hospital"),
        ),  
        "staff_role" => array(
            "root_table" => "staff_role",
            "select_string" => array("staff_role_id","staff_role"),
            "simple_join" => "",
           // "and_where_filters" => "",
            "session_filter" => array("hospital"),
        ),
        "functions" => array(
            "root_table" => "user",
            "select_string" => array("user_function_id","user_function","add","edit","view"),
            "simple_join" => array(
                "tables" => array(
                    'user_function_link'=>array("user_id"), //..
                ),
                "join_on" => array(
                    array( "user_function_link","user.user_id=user_function_link.user_id",""), //...
                    array("user_function","user_function_link.function_id=user_function.user_function_id","")
                )
            ),
            "and_where_filters" => array("user_function_link.user_id","user_function_link.active"),
            "session_filter" => array("user_id"),
        ),
        "op_forms" => array(
            "root_table" => "forms",
            "select_string" => array("form_id","form_name"),
            "simple_join" => "",
            //"and_where_filters" => "",
            "session_filter" => array("hospital"),
        ),
        "ip_forms" => array(
            "root_table" => "forms",
            "select_string" => array("form_id","form_name"),
            "simple_join" => "",
            //"and_where_filters" => "",
            "session_filter" => array("hospital"),
        ),
    );
    private $set_data_route = array(
        "set_data_template" => array(
            "root_table" => "",
            "select_string" => "",                                     // untested
            "and_where_filters" => "",
            "file_fields" => "",    //file settings => field_names array
            "session_fields" => "",
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
    function navigate_get($routes = false, $set_filter = false){
        // Routes are set
        if(!$routes){
            return false;
        }
        $return_data = array();
        
        // Entering foreach
        foreach($routes as $route){
            if(array_key_exists($route, $this->navigate_get)){
                  // Session filter
                  $session_filters = array_key_exists("session_filter", $this->navigate_get[$route]) ? $this->navigate_get[$route]['session_filter'] : FALSE;
                  // Select string                  
                  $select_string = array();
                  //var_dump($this->navigate_get[$route]['select_string']);
                  foreach($this->navigate_get[$route]['select_string'] as $field){
                      $select_string[] = $this->navigate_get[$route]['root_table'].'.'.$field;    // Add an as here.
                  }

                  // And where filter
                  $and_where_array = array();
                  $where_not_set = true;           
                  if(array_key_exists('and_where_filters', $this->navigate_get[$route])){
                        $filters = $this->navigate_get[$route]['and_where_filters'];
                        foreach($filters as $filter){ 
                            if($this->input->post($filter) != NULL){                    
                                $and_where_array[$this->navigate_get[$route]['root_table'].'.'.$filter] = $this->input->post($filter);
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
                            $and_where_array[$this->navigate_get[$route]['root_table'].'.'.$key] = $value;
                        }
                    }
                    
                    // Build Session filters                       
                    if($session_filters){           
                        foreach($session_filters as $filter){
                            if($this->session->has_userdata("$filter")){
                                $and_where_array[$this->navigate_get[$route]['root_table'].'.'.$filter] = $this->session->$filter; 
                            }               
                        } 
                    }
                    $simple_join = array_key_exists("simple_joins", $this->navigate_get[$route]) ? $this->navigate_get[$route]['simple_joins'] : FALSE;
                    if(!!$simple_join) {
                        foreach($simple_join['tables'] as $table => $fields) {
                            foreach($fields as $field){
                                $select_string .= $table.'.'.$field;
                            }
                            foreach($simple_join['join_on'] as $join_on) {
                                $this->db->join($join_on['table'],$join_on['join_fields'],$join['join_type']);
                            }
                        }                        
                    }
                    $this->db->select($select_string);
                    $this->db->from($this->navigate_get[$route]['root_table']);
                    if(sizeof($and_where_array) > 0){
                        $this->db->where($and_where_array);
                    }                    
                    
                    $query = $this->db->get();        
                    $result = $query->result();
                    echo $this->db->last_query();
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