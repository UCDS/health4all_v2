<?php 
class Register_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function register(){
		$date=date("Y-m-d",strtotime($this->input->post('date')));
		$time=date_format(date_create_from_format('h:ia', $this->input->post('time')),'H:i:s');
		if($this->input->post('first_name')) $first_name=$this->input->post('first_name'); else $first_name="";
		if($this->input->post('last_name')) $last_name=$this->input->post('last_name'); else $last_name="";
		$age_years=$this->input->post('age_years');
		$age_months=$this->input->post('age_months');
		$age_days=$this->input->post('age_days');
		$gender=$this->input->post('gender');
		$dob=$this->input->post('dob');
		if($this->input->post('spouse_name'))$spouse_name=$this->input->post('spouse_name'); else $spouse_name="";
		if($this->input->post('father_name'))$father_name=$this->input->post('father_name'); else $father_name="";
		if($this->input->post('mother_name'))$mother_name=$this->input->post('mother_name'); else $mother_name="";
		if($this->input->post('address')) $address=$this->input->post('address'); else $address="";
		if($this->input->post('place')) $place=$this->input->post('place'); else $place="";
		$phone=$this->input->post('phone');
		$district=$this->input->post('district');
		$department=$this->input->post('department');
		$unit=$this->input->post('unit');
		$area=$this->input->post('area');
		if($this->input->post('presenting_complaints')) $complaints=$this->input->post('presenting_complaints'); else $complaints="";
		if($this->input->post('provisional_diagnosis')) $provisional_diagnosis=$this->input->post('provisional_diagnosis'); else $provisional_diagnosis="";
		$hospital=$this->session->userdata('hospital');
		$hospital_id=$hospital['hospital_id'];
		$form_type=$this->input->post('form_type');
		$mlc=$this->input->post('mlc');
		$mlc_number=$this->input->post('mlc_number');
		$ps_name=$this->input->post('ps_name');
		$outcome=$this->input->post('outcome');
		$outcome_date=date("Y-m-d",strtotime($this->input->post('outcome_date')));
		$outcome_time=date("h:i:s",strtotime($this->input->post('outcome_time')));
		if($this->input->post('final_diagnosis')) $final_diagnosis=$this->input->post('final_diagnosis'); else $final_diagnosis="";
		$this->db->select('count')->from('counter')->where('counter_name',$form_type);
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
			'address'=>$address,
			'place'=>$place,
			'phone'=>$phone,
			'district_id'=>$district
		);
		$this->db->trans_start();
		if($this->input->post('patient_id')){
			$patient_id=$this->input->post('patient_id');
			$this->db->where('patient_id',$patient_id);
			$this->db->update('patient',$data);
		}
		else{
			$this->db->insert('patient',$data);
			$patient_id=$this->db->insert_id();
		}
		$visit_data=array(
			'visit_type'=>$form_type,
			'patient_id'=>$patient_id,
			'hosp_file_no'=>$hosp_file_no,
			'department_id'=>$department,
			'unit'=>$unit,
			'area'=>$area,
			'provisional_diagnosis'=>$provisional_diagnosis,
			'presenting_complaints'=>$complaints,
			'admit_date'=>$date,
			'admit_time'=>$time,
			'mlc'=>$mlc,
			'outcome'=>$outcome,
			'outcome_date'=>$outcome_date,
			'outcome_time'=>$outcome_time,
			'final_diagnosis'=>$final_diagnosis
		);
		if($this->input->post('visit_id')){
			$visit_id=$this->input->post('visit_id');
			$this->db->where('visit_id',$visit_id);
			$this->db->update('patient_visit',$visit_data);
		}
		else{
		$this->db->insert('patient_visit',$visit_data,false);
		$visit_id=$this->db->insert_id();
		}
		if($mlc==1 || $this->input->post('visit_id')){
			if($this->input->post('visit_id')){
			$this->db->where('visit_id',$visit_id);
			$this->db->update('mlc',array('mlc_number'=>$mlc_number,'ps_name'=>$ps_name));
			}
			else{
			$mlc_data=array(
				'visit_id'=>$visit_id,
				'mlc_number'=>$mlc_number,
				'ps_name'=>$ps_name
			);
			$this->db->insert('mlc',$mlc_data);
			}
		}
		$this->db->where('visit_id',$visit_id);
		$this->db->update('patient_visit',array('admit_id'=>$visit_id));
		$this->db->where('counter_name',$form_type);
		$this->db->update('counter',array('count'=>$hosp_file_no));
		$this->db->trans_complete();
		$this->db->select('patient.patient_id,patient_visit.visit_id,hosp_file_no,admit_date,
		admit_time,CONCAT(IF(first_name=NULL,"",first_name)," ",IF(last_name=NULL,"",last_name)) name,
		age_years,age_months,age_days,gender,
		IF(father_name=NULL OR father_name="",spouse_name,father_name) parent_spouse,
		department,unit_name,area_name,address,place,phone,district,op_room_no,presenting_complaints,mlc,mlc_number,ps_name',false)
		->from('patient')->join('patient_visit','patient.patient_id=patient_visit.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('unit','patient_visit.unit=unit.unit_id','left')
		->join('area','patient_visit.area=area.area_id','left')
		->join('district','patient.district_id=district.district_id','left')
		->join('mlc','patient_visit.visit_id=mlc.visit_id','left')
		->where('patient_visit.visit_id',$visit_id);
		$resource=$this->db->get();
		return $resource->row();

	}
	function search(){
		if($this->input->post('search_patient_id')){
			$this->db->where('patient.patient_id',$this->input->post('search_patient_id'));
		}
		if($this->input->post('search_patient_name')){
			$name=$this->input->post('search_patient_name');
			$this->db->like("LOWER(CONCAT(first_name,' ',last_name))",strtolower($name),'after');
		}
		if($this->input->post('search_op_number')){
			$this->db->where('hosp_file_no',$this->input->post('search_op_number'));
			$this->db->where('visit_type','OP');
		}
		if($this->input->post('search_ip_number')){
			$this->db->where('hosp_file_no',$this->input->post('search_ip_number'));
			$this->db->where('visit_type','IP');
		}
		if($this->input->post('search_phone')){
			$this->db->where('phone',$this->input->post('search_phone'));
		}
		$this->db->select("patient.patient_id,visit_type,visit_id,first_name,last_name,CONCAT(first_name,' ',last_name) name,
		age_years,age_months,age_days,gender,phone,department,
		IF(father_name=NULL OR father_name='',spouse_name,father_name) parent_spouse,admit_date",false)
		->from('patient')
		->join('patient_visit','patient.patient_id=patient_visit.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->order_by('name','ASC');
		$query=$this->db->get();
		return $query->result();
	}
	function select($visit_id=0){
		if($visit_id!=0)
			$this->db->where('patient_visit.visit_id',$visit_id);
		else return false;
		
		$this->db->select('patient.*,patient_visit.*,department.department,unit.unit_id,unit.unit_name,area.area_id,area.area_name,mlc.mlc_number,mlc.ps_name')
		->from('patient')->join('patient_visit','patient.patient_id=patient_visit.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('unit','patient_visit.unit=unit.unit_id','left')
		->join('area','patient_visit.area=area.area_id','left')
		->join('mlc','patient_visit.visit_id=mlc.visit_id','left');
		$query=$this->db->get();
		return $query->row();

	}
		
}
?>
