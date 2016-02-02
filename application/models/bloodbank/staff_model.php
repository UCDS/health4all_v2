<?php 
class Staff_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function login($username, $password){
	   $this -> db -> select('*');
	   $this -> db -> from('bb_users');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('password', MD5($password));
	   $this -> db -> limit(1);
	 
	   $query = $this -> db -> get();
	 
	   if($query -> num_rows() == 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	}
	function staff_list(){
		$this->db->select("*")->from("staff")->where("department_id","4")->order_by('staff_id');//->where('status',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_hospitals(){
		$this->db->select('*')->from('hospital')->order_by('hospital','asc');
		$query=$this->db->get();
		return $query->result();
	}
	function add_camp(){
		$data=array(
			'camp_name'=>$this->input->post('camp'),
			'location'=>$this->input->post('location')
			);
		$this->db->trans_start();
			$this->db->insert('blood_donation_camps',$data);
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
			$this->db->insert('hospitals',$data);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			return false;
		}
		else return true;
	}
	
}
?>
