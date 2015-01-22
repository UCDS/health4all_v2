<?php 
class Register_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function register(){
		//HERE WE USE IF STATEMENT FOR DISPLAYING REQUIRED FIELD THAT WE NEED 
		//HER WE ARE KEEPING THE FIELDS LIKE first_name,last_name,age_days,age_months,age_years,address,dob,spouse_name,father_name,mother_name,id_proof_type in patient table 
		//HER WE ARE KEEPING THE FIELDS LIKE id_proof_no,occupation,education_level,education_qualification,gestation,gestation_type,blood_group,delivery_location in patient table
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
		if($this->input->post('id_proof_type'))$id_proof_type=$this->input->post('id_proof_type'); else $id_proof_type="";
		if($this->input->post('id_proof_no'))$id_proof_no=$this->input->post('id_proof_no'); else $id_proof_no="";
		if($this->input->post('occupation'))$occupation=$this->input->post('occupation'); else $occupation="";
		if($this->input->post('education_level'))$education_level=$this->input->post('education_level'); else $education_level="";
		if($this->input->post('education_qualification'))$education_qualification=$this->input->post('education_qualification'); else $education_qualification="";
		if($this->input->post('blood_group'))$blood_group=$this->input->post('blood_group'); else $blood_group="";
		if($this->input->post('gestation'))$gestation=$this->input->post('gestation'); else $gestation="";
		if($this->input->post('gestation_type'))$gestation_type=$this->input->post('gestation_type'); else $gestation_type=""; 
		if($this->input->post('delivery_mode'))$delivery_mode=$this->input->post('delivery_mode'); else $delivery_mode="";
		if($this->input->post('delivery_place'))$delivery_place=$this->input->post('delivery_place'); else $delivery_place="";
		if($this->input->post('delivery_location'))$delivery_location=$this->input->post('delivery_location'); else $delivery_location="";
		if($this->input->post('hospital_type'))$hospital_type=$this->input->post('hospital_type'); else $hospital_type="";
		if($this->input->post('delivery_location_type'))$delivery_location_type=$this->input->post('delivery_location_type'); else $delivery_location_type="";
		if($this->input->post('delivery_plan'))$delivery_plan=$this->input->post('delivery_plan'); else $delivery_plan="";
		if($this->input->post('birth_weight'))$birth_weight=$this->input->post('birth_weight'); else $birth_weight="";
		if($this->input->post('congenial_anamalies'))$congenial_anamalies=$this->input->post('congenial_anamalies'); else $congenial_anamalies="";
		if($this->input->post('address')) $address=$this->input->post('address'); else $address="";
		if($this->input->post('place')) $place=$this->input->post('place'); else $place="";
	    if($this->input->post('doctor_Id')) $doctor_id=$this->input->post('doctor_id'); else $doctor_id="";
		if($this->input->post('nurse')) $nurse=$this->input->post('nurse'); else $nurse="";
		if($this->input->post('insurance_case')) $insurance_case=$this->input->post('insurance_case'); else $insurance_case="";
		if($this->input->post('insurance_no')) $insurance_no=$this->input->post('insurance_no'); else $insurance_no="";
		if($this->input->post('sbp')) $sbp=$this->input->post('sbp'); else $sbp="";
		if($this->input->post('dbp')) $dbp=$this->input->post('dbp'); else $dbp="";
		if($this->input->post('pulse_rate')) $pulse_rate=$this->input->post('pulse_rate'); else $pulse_rate="";
		if($this->input->post('respiratory_rate')) $respiratory_rate=$this->input->post('respiratory_rate'); else $respiratory_rate="";
		if($this->input->post('temperature')) $temperature=$this->input->post('temperature'); else $temperature="";
		if($this->input->post('admit_weight')) $admit_weight=$this->input->post('admit_weight'); else $admit_weight="";
		if($this->input->post('discharge_weight')) $discharge_weight=$this->input->post('discharge_weight'); else $discharge_weight="";
		$phone=$this->input->post('phone');
		$district=$this->input->post('district');
		$department=$this->input->post('department');
		$unit=$this->input->post('unit');
		$area=$this->input->post('area');
		if($this->input->post('presenting_complaints')) $presenting_complaints=$this->input->post('presenting_complaints'); else $presenting_complaints="";
		if($this->input->post('provisional_diagnosis')) $provisional_diagnosis=$this->input->post('provisional_diagnosis'); else $provisional_diagnosis="";
	    if($this->input->post('past_history')) $past_history=$this->input->post('past_history'); else $past_history="";
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
		if($this->input->post('congenital_anomalies')) $congenital_anomalies=$this->input->post('congenital_anomalies'); else $congenital_anomalies="";
		if($form_type=="IP"){
		$hosp_file_no=$this->input->post('hosp_file_no');
		}
		else{
			$this->db->select('count')->from('counter')->where('counter_name',$form_type);
			$query=$this->db->get();
			$result=$query->row();
			$hosp_file_no=++$result->count;
		}
		$data=array(
//HER WE ARE KEEPING THE FIELDS LIKE first_name,last_name,age_days,age_months,age_years,address,dob,spouse_name,father_name,mother_name,id_proof_type,id_proof_no,occupation,education_level,education_qualification,gestation,gestation_type,blood_group,delivery_location,hospital_type,delivery_location_type,delivery_mode,delivery_place,delivery_plan in patent table
	        'first_name'=>$first_name,
			'last_name'=>$last_name,
			'age_years'=>$age_years,
			'age_months'=>$age_months,
			'age_days'=>$age_days,
			'gender'=>$gender,
			'spouse_name'=>$spouse_name,
			'father_name'=>$father_name,
			'mother_name'=>$mother_name,
			'id_proof_type_id'=>$id_proof_type,
			'id_proof_number'=>$id_proof_no,
			'occupation'=>$occupation,
			'education_level'=>$education_level,
			'education_qualification'=>$education_qualification,
			'blood_group'=>$blood_group,
			'gestation'=>$gestation, 
			'gestation_type'=>$gestation_type,
			'hospital_type'=>$hospital_type,
			'delivery_location_type'=>$delivery_location_type,
			'delivery_mode'=>$delivery_mode,
			'delivery_place'=>$delivery_place,
			'delivery_plan'=>$delivery_plan,
			'delivery_location'=>$delivery_location,
			'congenital_anomalies'=>$congenital_anomalies,
			'birth_weight'=>$birth_weight,
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
		//here we are using the array to store the values of patient_visit table 
		//here hospital_id is column name and in that we are storing the variable values in subsequent column name 
		$visit_data=array( 
		    'hospital_id'=>$hospital_id,
			'department_id'=>$department,
			'insurance_case'=>$insurance_case,
			'insurance_no'=>$insurance_no,
			'sbp'=>$sbp,
			'dbp'=>$dbp,
			'pulse_rate'=>$pulse_rate,
			'respiratory_rate'=>$respiratory_rate,
			'temperature'=>$temperature,
			'admit_weight'=>$admit_weight,
			'discharge_weight'=>$discharge_weight,
			'visit_type'=>$form_type,
			'patient_id'=>$patient_id,
			'hosp_file_no'=>$hosp_file_no,
			'department_id'=>$department,
			'unit'=>$unit,
			'area'=>$area,
			'provisional_diagnosis'=>$provisional_diagnosis,
			'presenting_complaints'=>$presenting_complaints,
			'past_history'=>$past_history,
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
		->join('department','patient_visit.department_id=department.department_id','left')
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
