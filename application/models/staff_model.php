<?php 
class Staff_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
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
	function user_function($user_id){
		$this->db->select('user_function_id,user_function,add,edit,view')->from('user')
		->join('user_function_link','user.user_id=user_function_link.user_id')
		->join('user_function','user_function_link.function_id=user_function.user_function_id')
		->where('user_function_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	function user_hospital($user_id){
		$this->db->select('hospital.hospital_id,hospital,description,place,district,state,logo')->from('user')
		->join('user_hospital_link','user.user_id=user_hospital_link.user_id')
		->join('hospital','user_hospital_link.hospital_id=hospital.hospital_id')
		->where('user_hospital_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	function user_department($user_id){
		$this->db->select('department.department_id,department')->from('user')
		->join('user_department_link','user.user_id=user_department_link.user_id')
		->join('department','user_department_link.department_id=department.department_id')
		->where('user_department_link.user_id',$user_id);
		$query=$this->db->get();
		return $query->result();
	}
	function get_department(){
		$this->db->select("department_id,department")->from("department")->where('clinical','1');
		$query=$this->db->get();
		return $query->result();
	}
	function get_area(){
		$this->db->select("area_id,department_id,area_name")->from("area");
		$query=$this->db->get();
		return $query->result();
	}
	function get_unit(){
		$this->db->select("department_id,unit_id,unit_name")->from("unit");
		$query=$this->db->get();
		return $query->result();
	}
	function get_district(){
		$this->db->select("district_id,district")->from("district");
		$query=$this->db->get();
		return $query->result();
	}
	function get_user_function(){
		$this->db->select("user_function_id,user_function")->from("user_function");
		$query=$this->db->get();
		return $query->result();
	}
	function get_staff(){
		$this->db->select("staff_id,CONCAT(IF(first_name!='',first_name,''),' ',IF(last_name!='',last_name,'')) staff_name,department",false)
		->from("staff")
		->join('department','staff.department_id=department.department_id');
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
	function get_print_layouts(){
		$this->db->select("print_layout_id,print_layout_name")->from("print_layout");
		$query=$this->db->get();
		return $query->result();
	}
	function get_forms($form_type){
		$this->db->select("form_id,form_name")->from("form")->where("form_type",$form_type);
		$query=$this->db->get();
		return $query->result();
	}
	function get_form($form_id){
		$this->db->select("form_id,form_name,num_columns,form_type,print_layout_page")->from("form")->
		join('print_layout','form.print_layout_id=print_layout.print_layout_id')->where("form_id",$form_id);
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
	function create_user(){
		$data=array(
			'username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password')),
			'staff_id'=>$this->input->post('staff')
		);
		$this->db->trans_start();
		$this->db->insert('user',$data);
		$user_id=$this->db->insert_id();
		$user_function=$this->input->post('user_function');
		$user_function_data=array();
		foreach($user_function as $u){
			$add=0;
			$edit=0;
			$view=0;
			if($this->input->post($u)){
				foreach($this->input->post($u) as $access){
					if($access=="add") $add=1;
					if($access=="edit") $edit=1;
					if($access=="view") $view=1;
				}
				$user_function_data[]=array(
				'user_id'=>$user_id,
				'function_id'=>$u,
				'add'=>$add,
				'edit'=>$edit,
				'view'=>$view
				);
			}
		}
		$this->db->insert_batch('user_function_link',$user_function_data);
		$this->db->select('department_id,hospital_id')->from('staff')->where('staff_id',$this->input->post('staff'));
		$query=$this->db->get();
		$result=$query->row();
		if($this->input->post('department')){
			$department=0;
		}
		else
		$department=$result->department_id;
		$hospital=$result->hospital_id;
		$this->db->insert('user_department_link',array('user_id'=>$user_id,'department_id'=>$department));
		$this->db->insert('user_hospital_link',array('user_id'=>$user_id,'hospital_id'=>$hospital));
		$this->db->trans_complete();
		if($this->db->trans_status()===TRUE) return true; else return false;
	}

	function staff_list($hospital_id=0){
		$userdata=$this->session->userdata('hospital');
		if($hospital_id==0) $hospital_id=$userdata['hospital_id'];
		
		$this->db->select("*")->from("staff")->where("department_id","4")->where("hospital_id",$hospital_id);
		$query=$this->db->get();
		return $query->result();
	}
	function get_hospital(){
		$this->db->select("*")->from("hospital")->order_by('hospital','asc');
		$query=$this->db->get();
		return $query->result();
	}
	function add_camp($hospital_id){
		
		$data=array(
			'camp_name'=>$this->input->post('camp'),
			'location'=>$this->input->post('location'),
			'hospital_id'=>$hospital_id
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
