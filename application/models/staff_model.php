<?php 
class Staff_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function login($username, $password){
	   $this -> db -> select('*');
	   $this -> db -> from('users');
	   $this -> db -> join('user_department_links','users.user_id=user_department_links.user_id');
	   $this -> db -> join('user_function_links','users.user_id=user_function_links.user_id');
	   $this -> db -> join('user_functions','user_function_links.function_id=user_functions.user_function_id');
	   $this -> db -> join('user_hospital_links','users.user_id=user_hospital_links.user_id');
	   $this -> db -> join('hospitals','user_hospital_links.hospital_id=hospitals.hospital_id');
	   $this -> db -> join('departments','user_department_links.department_id=departments.department_id');
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
	function get_departments(){
		$this->db->select("department_id,department")->from("departments")->where('clinical','1');
		$query=$this->db->get();
		return $query->result();
	}
	function get_districts(){
		$this->db->select("district_id,district")->from("districts");
		$query=$this->db->get();
		return $query->result();
	}

}
?>
