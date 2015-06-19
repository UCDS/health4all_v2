<?php 
class Staff_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//login() accepts the username and password, searches the database for match and if found, returns the 
	//query result else returns false
	function login($username, $password){
	   $this -> db -> select('*');
	   $this -> db -> from('user');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('password', MD5($password));
	 
	   $query = $this -> db -> get();
	   if($query -> num_rows() > 0)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	}
	
	//user_function() takes user ID as parameter and returns a list of all the functions the user has access to.
	function user_function($user_id){
		$this->db->select('user_function_id,user_function,add,edit,view')->from('user')
		->join('user_function_link','user.user_id=user_function_link.user_id')
		->join('user_function','user_function_link.function_id=user_function.user_function_id')
		->where('user_function_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	
	//user_hospital() takes user ID as parameter and returns a list of all the hospitals the user has access to.	
	function user_hospital($user_id){
		$this->db->select('hospital.hospital_id,hospital,description,place,district,state,logo')->from('user')
		->join('user_hospital_link','user.user_id=user_hospital_link.user_id')
		->join('hospital','user_hospital_link.hospital_id=hospital.hospital_id')
		->where('user_hospital_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	//user_department() takes user ID as parameter and returns a list of all the departments the user has access to.
	function user_department($user_id){
		$this->db->select('department.department_id,department,department_email')->from('user')
		->join('user_department_link','user.user_id=user_department_link.user_id')
		->join('department','user_department_link.department_id=department.department_id')
		->where('user_department_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	
	//get_department() selects the clinical departments from the database and returns the result
	function get_department($clinical=1){
		$this->db->select("department_id,department")->from("department")->where('clinical',$clinical)->order_by('department');
		$query=$this->db->get();
		return $query->result();
	}
	
	//get_area() selects the areas from the database and returns the result
	function get_area(){
		$this->db->select("area_id,department_id,area_name")->from("area");
		$query=$this->db->get();
		return $query->result();
	}
	//get_unit() selects the units from the database and returns the result
	function get_unit(){
		$this->db->select("department_id,unit_id,unit_name")->from("unit");
		$query=$this->db->get();
		return $query->result();
	}
	//get_district() selects the districts from the database and returns the result
	function get_district(){
		$this->db->select("district_id,district")->from("district");
		$query=$this->db->get();
		return $query->result();
	}
	//get_id_proof_type() selects the ID Proof types from the database and returns the result
	function get_id_proof_type(){
		$this->db->select("id_proof_type_id,id_proof_type")->from("id_proof_type");
		$query=$this->db->get();
		return $query->result();
	}
	//get_occupations() selects the occupations from the database and returns the result
	function get_occupations(){
		$this->db->select("occupation_id,occupation")->from("occupation");
		$query=$this->db->get();
		return $query->result();
	}
	//get_user_function() selects the functions from the database and returns the result
	function get_user_function(){
		$this->db->select("user_function_id,user_function")->from("user_function");
		$query=$this->db->get();
		return $query->result();
	}
	//get_staff() selects the staff details from the database and returns the result
	function get_staff(){
		$this->db->select("staff_id,CONCAT(IF(first_name!='',first_name,''),' ',IF(last_name!='',last_name,'')) staff_name,department",false)
		->from("staff")
		->join('department','staff.department_id=department.department_id');
		$query=$this->db->get();
		return $query->result();
	}
	//upload_form() takes the post variables and inserts data into the form and form_layout tables
	function upload_form(){
		//storing all the post variables and json variables into local variables.
		$fields=json_decode($this->input->post('fields'));
		$form_name=$this->input->post('form_name');
		$form_type=$this->input->post('form_type');
		$columns=$this->input->post('columns');
		$print_layout=$this->input->post('print_layout');
		$count=count($fields->field_name); //count of the number of fields
		//building an array to insert into form table.
		$form_data=array(
			'form_name'=>$form_name,
			'form_type'=>$form_type,
			'num_columns'=>$columns,
			'print_layout_id'=>$print_layout
		);
		$this->db->trans_start(); //Transaction starts
		$this->db->insert('form',$form_data); //Insert the form data array into the "form" table
		$form_id=$this->db->insert_id();//get the form_id from the inserted record
		$fields_data=array();
		for($i=0;$i<$count;$i++){ //loop for the number of fields
			//build the fields data as an array of arrays having the column names of "form_layout" table in database.
			$fields_data[]=array(
				'field_name'=>$fields->field_name[$i],
				'mandatory'=>$fields->mandatory[$i],
				'form_id'=>$form_id
			);
		}
		//insert all the fields into form_layout using insert_batch() 
		$this->db->insert_batch('form_layout',$fields_data);
		$this->db->trans_complete(); //Transaction Completed
		if($this->db->trans_status()===FALSE){
			//if the transaction failed,return false.
			return false;
		}
		else return true;
	}
	//get_visit_name() selects the visit names from the database and returns the result
	function get_visit_name(){
		$this->db->select("visit_name_id,visit_name")->from("visit_name");
		$query=$this->db->get();
		return $query->result();
	}
	//get_print_layouts() selects the print layouts from the database and returns the result
	function get_print_layouts(){
		$this->db->select("print_layout_id,print_layout_name,print_layout_page")->from("print_layout");
		$query=$this->db->get();
		return $query->result();
	}
	//get_forms() takes a parameter $form_type, selects the forms with the given form type 
	//from the database and returns the result
	function get_forms($form_type){
		$this->db->select("form_id,form_name")->from("form")->where("form_type",$form_type);
		$query=$this->db->get();
		return $query->result();
	}
	//get_form() selects the form from the database with the $form_id passed and returns the result
	function get_form($form_id){
		$this->db->select("form_id,form_name,num_columns,form_type,print_layout_page")->from("form")->
		join('print_layout','form.print_layout_id=print_layout.print_layout_id')->where("form_id",$form_id);
		$query=$this->db->get();
		return $query->row();
	}
	//get_form_fields() selects the form fields from the database and returns the result
	function get_form_fields($form_id){
		$this->db->select("field_name,mandatory")->from("form_layout")->where("form_id",$form_id)->order_by("id","asc");
		$query=$this->db->get();
		
		$result=$query->result();
		$fields=array();
		foreach($result as $row){
			$fields[$row->field_name]=$row->mandatory;
		}
		return $fields;
	}
	//create_user() function adds the user details and the user access details into the database.
	function create_user(){
		//building the data array with the column names as keys and post variables as values.
		$data=array(
			'username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password')),
			'staff_id'=>$this->input->post('staff')
		);
		$this->db->trans_start(); //Transaction begins
		$this->db->insert('user',$data); //Insert into 'user' table the $data array
		$user_id=$this->db->insert_id(); //Get the user ID from the inserted record
		$user_function=$this->input->post('user_function'); //Get the user functions selected for the user.
		$user_function_data=array();
		foreach($user_function as $u){ //loop through the selected user functions
			//defining local variables add,edit and view with default values as 0
			$add=0; 
			$edit=0;
			$view=0;
			if($this->input->post($u)){ 
				//loop through each of the user_function selected, this will loop through the add,edit and view checkboxes
				foreach($this->input->post($u) as $access){
					//based on the access, set the variables.
					if($access=="add") $add=1; 
					if($access=="edit") $edit=1;
					if($access=="view") $view=1;
				}
				//build the user_function_data with the access controls
				$user_function_data[]=array(
				'user_id'=>$user_id,
				'function_id'=>$u,
				'add'=>$add,
				'edit'=>$edit,
				'view'=>$view
				);
			}
		}
		//insert all the user functions into the user_function_link table in the database.
		$this->db->insert_batch('user_function_link',$user_function_data);
		
		//Get the department and hospital ID from staff table, based on the selected staff.
		$this->db->select('department_id,hospital_id')->from('staff')->where('staff_id',$this->input->post('staff'));
		$query=$this->db->get();
		$result=$query->row(); //store the result in a result variable
		if($this->input->post('department')){
			$department=0;
		}
		else
		$department=$result->department_id; //store the department into a variable.
		$hospital=$result->hospital_id; //store the hospital into a variable.
		//insert into user_department_link and user_department_link the user ID, department ID and the hospital ID.
		$this->db->insert('user_department_link',array('user_id'=>$user_id,'department_id'=>$department));
		$this->db->insert('user_hospital_link',array('user_id'=>$user_id,'hospital_id'=>$hospital));
		$this->db->trans_complete(); //Transaction Ends
		if($this->db->trans_status()===TRUE) return true; else return false; //if transaction completed successfully return true, else false.
	}
	//staff_list() selects the staff details from the database and returns the result
	function staff_list($hospital_id=0){
		//Hard coded to get the staff details of the blood bank.
		$userdata=$this->session->userdata('hospital');
		if($hospital_id==0) $hospital_id=$userdata['hospital_id'];
		
		$this->db->select("*")->from("staff")->where("department_id","4")->where("hospital_id",$hospital_id);
		$query=$this->db->get();
		return $query->result();
	}
	//get_hospital() selects the hospitals from the database and returns the result
	function get_hospital(){
		$this->db->select("*")->from("hospital")->order_by('hospital','asc');
		$query=$this->db->get();
		return $query->result();
	}
	//change_password() takes user ID as a parameter and updates the database with the new password.
	function change_password($user_id){
		//select the old password from the database
		$this->db->select('password')->from('user')->where('user_id',$user_id);
		$query=$this->db->get();
		$password=$query->row();
		$form_password=$this->input->post('old_password'); //get the old password from the form
		if($password->password==md5($form_password)){ //match both the old passwords
			$this->db->where('user_id',$user_id); //search for the user in db
			if($this->db->update('user',array('password'=>md5($this->input->post('password'))))){ 
				//if the user table has been updated successfully, return true else false.
				return true;
				}
			else return false;
		}
		else return false; //if the old password entered doesn't match the database password, return false.
	}
	function add_camp(){
		$hospital = $this->session->userdata('hospital');
		$data=array(
			'camp_name'=>$this->input->post('camp'),
			'location'=>$this->input->post('location'),
			'hospital_id'=>$hospital['hospital_id']
			);
		$this->db->trans_start();
			$this->db->insert('blood_donation_camp',$data);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			return false;
		}
		else return true;
	}
	
	function add_hospital(){
		$hospital = $this->session->userdata('hospital');
		$data=array(
			'hospital'=>$this->input->post('hospital'),
			'place'=>$this->input->post('location'),
			'district'=>$this->input->post('district'),
			'state'=>$this->input->post('state')
			);
		$this->db->trans_start();
			$this->db->insert('hospital',$data);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			return false;
		}
		else return true;
	}
	
			
}
?>
