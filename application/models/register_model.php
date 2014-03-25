<?php 
class Register_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function register_op(){
		$date=date("Y-m-d",strtotime($this->input->post('date')));
		$time=date("H:i:s",strtotime($this->input->post('time')));
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$age_years=$this->input->post('age_years');
		$age_months=$this->input->post('age_months');
		$age_days=$this->input->post('age_days');
		$gender=$this->input->post('gender');
		$dob=$this->input->post('dob');
		$spouse_name=$this->input->post('spouse_name');
		$father_name=$this->input->post('father_name');
		$place=$this->input->post('place');
		$phone=$this->input->post('phone');
		$district=$this->input->post('district');
		$department=$this->input->post('department');
		$hospital=$this->session->userdata('hospital');
		$hospital_id=$hospital['hospital_id'];
		$data=array(
			'first_name'=>$first_name,
			'last_name'=>$last_name,
			'age_years'=>$age_years,
			'age_months'=>$age_months,
			'age_days'=>$age_days,
			'gender'=>$gender,
			'spouse_name'=>$spouse_name,
			'father_name'=>$father_name,
			'dob'=>$dob,
			'place'=>$place,
			'phone'=>$phone,
			'district_id'=>$district
		);
		$this->db->trans_start();
		$this->db->insert('patients',$data);
		$patient_id=$this->db->insert_id();
		$visit_data=array(
			'visit_type'=>'OP',
			'patient_id'=>$patient_id,
			'department_id'=>$department,
			'admit_date'=>$date,
			'admit_time'=>$time
		);
		$this->db->insert('patient_visits',$visit_data);
		$visit_id=$this->db->insert_id();
		$this->db->trans_complete();
		$this->db->select('patients.patient_id,visit_id,admit_date,admit_time,CONCAT(IF(first_name=NULL,"",first_name)," ",IF(last_name=NULL,"",last_name)) name,age_years,age_months,age_days,gender,IF(father_name=NULL,spouse_name,father_name) parent_spouse,department,place,phone',false)
		->from('patients')->join('patient_visits','patients.patient_id=patient_visits.patient_id')
		->join('departments','patient_visits.department_id=departments.department_id')
		->where('visit_id',$visit_id);
		$resource=$this->db->get();
		return $resource->result();

	}
}
?>
