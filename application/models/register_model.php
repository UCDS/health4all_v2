<?php 
class Register_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function register(){
		$date=date("Y-m-d",strtotime($this->input->post('date')));
		$time=date_format(date_create_from_format('h:ia', $this->input->post('time')),'H:i:s');
		if($this->input->post('first_name')){
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		}
		else{
			$first_name=$this->input->post('patient_name');
			$last_name="";
		}
		$age_years=$this->input->post('age');
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
		$form_type=$this->input->post('form_type');
		$this->db->select('count')->from('counters')->where('counter_name',$form_type);
		$query=$this->db->get();
		$result=$query->row();
		$hosp_file_no=++$result->count;
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
			'visit_type'=>$form_type,
			'patient_id'=>$patient_id,
			'hosp_file_no'=>$hosp_file_no,
			'department_id'=>$department,
			'admit_date'=>$date,
			'admit_time'=>$time
		);
		$this->db->insert('patient_visits',$visit_data,false);
		$visit_id=$this->db->insert_id();
		$this->db->where('counter_name',$form_type);
		$this->db->update('counters',array('count'=>$hosp_file_no));
		$this->db->trans_complete();
		$this->db->select('patients.patient_id,visit_id,hosp_file_no,admit_date,admit_time,CONCAT(IF(first_name=NULL,"",first_name)," ",IF(last_name=NULL,"",last_name)) name,age_years,age_months,age_days,gender,IF(father_name=NULL OR father_name="",spouse_name,father_name) parent_spouse,department,place,phone,op_room_no,presenting_complaints',false)
		->from('patients')->join('patient_visits','patients.patient_id=patient_visits.patient_id')
		->join('departments','patient_visits.department_id=departments.department_id')
		->where('visit_id',$visit_id);
		$resource=$this->db->get();
		return $resource->row();

	}
}
?>
