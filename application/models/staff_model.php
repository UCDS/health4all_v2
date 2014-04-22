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
	function upload_form(){
		$fields=json_decode($this->input->post('fields'));
		$form_name=$this->input->post('form_name');
		$form_type=$this->input->post('form_type');
		$columns=$this->input->post('columns');
		$print_layout=$this->input->post('print_layout');
		$count=count($fields->field_name);
		$form_data=array(
			'form_name'=>$form_name,
			'form_type'=>$form_type,
			'num_columns'=>$columns,
			'print_layout_id'=>$print_layout
		);
		$this->db->trans_start();
		$this->db->insert('form',$form_data);
		$form_id=$this->db->insert_id();
		$fields_data=array();
		for($i=0;$i<$count;$i++){
			$fields_data[]=array(
				'field_name'=>$fields->field_name[$i],
				'mandatory'=>$fields->mandatory[$i],
				'form_id'=>$form_id
			);
		}
		$this->db->insert_batch('form_layout',$fields_data);
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
			return false;
		}
		else return true;
	}
	function get_forms($form_type){
		$this->db->select("form_id,form_name")->from("form")->where("form_type",$form_type);
		$query=$this->db->get();
		return $query->result();
	}
	function get_form($form_id){
		$this->db->select("form_id,form_name,num_columns,form_type")->from("form")->where("form_id",$form_id);
		$query=$this->db->get();
		return $query->row();
	}
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
}
?>
