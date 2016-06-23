<?php 
class Register_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//register() function does the patient registration or updating the existing patient records.
	function register(){
		//All the post variables are stored in local variables; 
		//based on the field type we modify the data as required before storing in the variables.
		$date=date("Y-m-d",strtotime($this->input->post('date')));
		$time=date_format(date_create_from_format('h:ia', $this->input->post('time')),'H:i:s');
		if($this->input->post('first_name')) $first_name=$this->input->post('first_name'); else $first_name="";
		if($this->input->post('last_name')) $last_name=$this->input->post('last_name'); else $last_name="";
		$age_years=$this->input->post('age_years');
		$age_months=$this->input->post('age_months');
		$age_days=$this->input->post('age_days');
		$gender=$this->input->post('gender');
		if($this->input->post('dob'))$dob=date("Y-m-d",strtotime($this->input->post('dob'))); else $dob=0;
		if($this->input->post('spouse_name'))$spouse_name=$this->input->post('spouse_name'); else $spouse_name="";
		if($this->input->post('father_name'))$father_name=$this->input->post('father_name'); else $father_name="";
		if($this->input->post('mother_name'))$mother_name=$this->input->post('mother_name'); else $mother_name="";
		if($this->input->post('id_proof_type'))$id_proof_type=$this->input->post('id_proof_type'); else $id_proof_type="";
		if($this->input->post('id_proof_no'))$id_proof_no=$this->input->post('id_proof_no'); else $id_proof_no="";
		if($this->input->post('occupation'))$occupation=$this->input->post('occupation'); else $occupation=0;
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
                if($this->input->post('insurance_id')) $insurance_id=$this->input->post('insurance_id'); else $insurance_id="";
		if($this->input->post('sbp')) $sbp=$this->input->post('sbp'); else $sbp="";
		if($this->input->post('dbp')) $dbp=$this->input->post('dbp'); else $dbp="";
		if($this->input->post('pulse_rate')) $pulse_rate=$this->input->post('pulse_rate'); else $pulse_rate="";
		if($this->input->post('respiratory_rate')) $respiratory_rate=$this->input->post('respiratory_rate'); else $respiratory_rate="";
		if($this->input->post('temperature')) $temperature=$this->input->post('temperature'); else $temperature="";
		if($this->input->post('admit_weight')) $admit_weight=$this->input->post('admit_weight'); else $admit_weight="";
		if($this->input->post('discharge_weight')) $discharge_weight=$this->input->post('discharge_weight'); else $discharge_weight="";
		$phone=$this->input->post('phone');
		$alt_phone=$this->input->post('alt_phone');
		$country_code=$this->input->post('country');
		$state_code=$this->input->post('state');
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
                $mlc = $this->input->post('mlc');
		if(($this->input->post('mlc')=='1' || $this->input->post('mlc')=='0')) $mlc= $this->input->post('mlc'); else $mlc=-1;
		//check if it is an mlc case
		if($this->input->post('mlc')==1){
                    //if a manual mlc number has been entered, use it and ignore the auto counter		
                    $mlc_number_manual=$this->input->post('mlc_number_manual');
                    $this->db->select('count')->from('counter')->where('counter_name','MLC');
                    $query = $this->db->get();
                    $result = $query->row();
                    $mlc_number = ++$result->count;
                    $this->db->where('counter_name','MLC');
                    $this->db->update('counter',array('count'=>$mlc_number));

                    $ps_name=$this->input->post('ps_name');
                    $pc_number=$this->input->post('pc_number');
                    $brought_by=$this->input->post('brought_by');
                    $police_intimation=$this->input->post('police_intimation');
                    $declaration_required=$this->input->post('declaration_required');
		}
		else {
                    $mlc_number = "";
                    $mlc_number_manual = "";
		}
		$identification_marks=$this->input->post('identification_marks');
		$outcome=$this->input->post('outcome');
		if($this->input->post('outcome_date')) $outcome_date=date("Y-m-d",strtotime($this->input->post('outcome_date'))); else $outcome_date = 0;
		if($this->input->post('outcome_time')) $outcome_time=date("h:i:s",strtotime($this->input->post('outcome_time'))); else $outcome_time = 0;
		if($this->input->post('final_diagnosis')) $final_diagnosis=$this->input->post('final_diagnosis'); else $final_diagnosis="";
		if($this->input->post('congenital_anomalies')) $congenital_anomalies=$this->input->post('congenital_anomalies'); else $congenital_anomalies="";
		if($this->input->post('visit_name')) $visit_name_id=$this->input->post('visit_name'); else $visit_name_id=0;
		if($form_type=="IP"){
			$hosp_file_no=$this->input->post('hosp_file_no');
			if(!$this->input->post('visit_id')){
			//If it's an IP form, get the hospital file number from the input field.
			$this->db->select('hosp_file_no,admit_date'); //Here we are selecting hosp_file_no and admit_date with year for match  from the database
			$this->db->where('hosp_file_no',$hosp_file_no);
			$this->db->where('YEAR(admit_date)',date("Y",strtotime($date)));
			$this->db->from('patient_visit');
			$this->db->where('visit_type',$form_type);
			$query=$this->db->get();
			if($query->num_rows()>0)
			{
				//If the given IP no is matched in same year then this function returns 2;
				return 2; 
			}	
			}
		}
		else{
			//else, select the counter from the database to check the last OP number, increment it and 
			//use it as the hospital file number for out patients.
			$this->db->select('count')->from('counter')->where('counter_name',$form_type);
			$query=$this->db->get();
			$result=$query->row();
			$hosp_file_no=++$result->count;
		}

		//Creating an array with the database column names as keys and the post values as values. 
		$data=array(
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
			'occupation_id'=>$occupation,
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
			'alt_phone'=>$alt_phone,
			'country_code'=>$country_code,
			'state_code'=>$state_code,
			'district_id'=>$district,
			'identification_marks'=>$identification_marks,
		);
		
		//Start a mysql transaction.
		$this->db->trans_start();

		if($this->input->post('patient_id')){
			//if the patient id is received in the post variables, use it to update the particular patient.
			$patient_id=$this->input->post('patient_id');
			$this->db->where('patient_id',$patient_id);
			$this->db->update('patient',$data);
		}
		else{
			// else if it's a new patient, insert into the patient table using the data array.
			$this->db->insert('patient',$data);
			//get the patient id from the inserted row.
			$patient_id=$this->db->insert_id();
		}
		if($this->input->post('patient_picture')){
			$encoded_data = $this->input->post('patient_picture');
			$binary_data = base64_decode( $encoded_data );

			// save to server (beware of permissions)
			$result = file_put_contents("assets/images/patients/$patient_id.jpg", $binary_data );
			if (!$result) die("Could not save image!  Check file permissions.");
		}
		//Creating an array with the database column names as keys and the post values as values. 
		$visit_data=array( 
		    'hospital_id'=>$hospital_id,
			'department_id'=>$department,
			'insurance_case'=>$insurance_case,
			'insurance_no'=>$insurance_no,
                        'insurance_id'=>$insurance_id,
			'sbp'=>$sbp,
			'dbp'=>$dbp,
			'pulse_rate'=>$pulse_rate,
			'respiratory_rate'=>$respiratory_rate,
			'temperature'=>$temperature,
			'admit_weight'=>$admit_weight,
			'discharge_weight'=>$discharge_weight,
			'visit_type'=>$form_type,
			'visit_name_id'=>$visit_name_id,
			'patient_id'=>$patient_id,
			'hosp_file_no'=>$hosp_file_no,
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
			//if it's an update form, use the visit id from the post variables and update the record in the patient_visit table
			$visit_id=$this->input->post('visit_id');
			$this->db->where('visit_id',$visit_id);
			$this->db->update('patient_visit',$visit_data);
		}
		else{
			//else use the visit_data array and insert a new record into the patient visit table.
		$this->db->insert('patient_visit',$visit_data,false);
		$visit_id=$this->db->insert_id(); //store the visit_id from the inserted record
		}
		if($mlc==1 || $this->input->post('visit_id')){
			// if the mlc field is selected as "Yes"
			if($this->input->post('visit_id')){
				//if it's an update form, use the visit id to update the mlc record in the databse - mlc table.
			$this->db->where('visit_id',$visit_id);
			$this->db->update('mlc',array('mlc_number'=>$mlc_number,'ps_name'=>$ps_name));
			}
			else{
				//if it's a new entry, store the mlc data from the post variables.
			$mlc_data=array(
				'visit_id'=>$visit_id,
				'mlc_number'=>"A".$mlc_number,
				'mlc_number_manual'=>$mlc_number_manual,
				'ps_name'=>$ps_name,
				'pc_number'=>$pc_number,
				'brought_by'=>$brought_by,
				'police_intimation'=>$police_intimation,
				'declaration_required'=>$declaration_required
			);
			//insert into the mlc table.
			$this->db->insert('mlc',$mlc_data);
			}
		}
		//update the admit id, setting it equal to the visit id, only changes for transfer cases.
		$this->db->where('visit_id',$visit_id);
		$this->db->update('patient_visit',array('admit_id'=>$visit_id));
		//update the counter table with the new hospital file number.
		$this->db->where('counter_name',$form_type);
		$this->db->update('counter',array('count'=>$hosp_file_no));
		
		//Transaction ends here.
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		}
		else {
		//Select the inserted or updated patient record with the visit_id 
		$this->db->select('patient.*,patient_visit.*,
		patient.patient_id,patient_visit.visit_id visit_id1,
		CONCAT(IF(first_name=NULL,"",first_name)," ",IF(last_name=NULL,"",last_name)) name,
		IF(father_name=NULL OR father_name="",spouse_name,father_name) parent_spouse,visit_name,visit_name.visit_name_id,
		department,unit_name,area_name,district,op_room_no,mlc.*,occupation',false)
		->from('patient')->join('patient_visit','patient.patient_id=patient_visit.patient_id')
		->join('department','patient_visit.department_id=department.department_id','left')
		->join('unit','patient_visit.unit=unit.unit_id','left')
		->join('area','patient_visit.area=area.area_id','left')
		->join('district','patient.district_id=district.district_id','left')
		->join('mlc','patient_visit.visit_id=mlc.visit_id','left')
		->join('visit_name','patient_visit.visit_name_id=visit_name.visit_name_id','left')
		->join('occupation','patient.occupation_id=occupation.occupation_id','left')
		->where('patient_visit.visit_id',$visit_id);
		$resource=$this->db->get();
		//return the result array to the controller
		return $resource->row();
		}
	}

	//update() function for updating the existing patient records.
	function update(){
		//// All the post variables are stored in local variables; 
		// based on the field type we modify the data as required before storing in the variables.
		if($this->input->post('first_name')) $first_name=$this->input->post('first_name'); else $first_name="";
                if($this->input->post('middle_name')) $middle_name=$this->input->post('middle_name'); else $middle_name="";
		if($this->input->post('last_name')) $last_name=$this->input->post('last_name'); else $last_name="";
		$age_years=$this->input->post('age_years');
		$age_months=$this->input->post('age_months');
		$age_days=$this->input->post('age_days');
		$gender=$this->input->post('gender');
		if($this->input->post('dob'))$dob=date("Y-m-d",strtotime($this->input->post('dob'))); else $dob=0;
		if($this->input->post('spouse_name'))$spouse_name=$this->input->post('spouse_name'); else $spouse_name="";
		if($this->input->post('father_name'))$father_name=$this->input->post('father_name'); else $father_name="";
		if($this->input->post('mother_name'))$mother_name=$this->input->post('mother_name'); else $mother_name="";
		if($this->input->post('id_proof_type'))$id_proof_type=$this->input->post('id_proof_type'); else $id_proof_type="";
		if($this->input->post('id_proof_no'))$id_proof_no=$this->input->post('id_proof_no'); else $id_proof_no="";
		if($this->input->post('occupation'))$occupation=$this->input->post('occupation'); else $occupation=0;
		if($this->input->post('education_level'))$education_level=$this->input->post('education_level'); else $education_level="";
		if($this->input->post('education_qualification'))$education_qualification=$this->input->post('education_qualification'); else $education_qualification="";
                if($this->input->post('identification_marks'))$identification_marks=$this->input->post('identification_marks'); else $identification_marks="";
		if($this->input->post('blood_group'))$blood_group=$this->input->post('blood_group'); else $blood_group="";
		// if($this->input->post('gestation'))$gestation=$this->input->post('gestation'); else $gestation="";
		// if($this->input->post('gestation_type'))$gestation_type=$this->input->post('gestation_type'); else $gestation_type=""; 
		// if($this->input->post('delivery_mode'))$delivery_mode=$this->input->post('delivery_mode'); else $delivery_mode="";
		// if($this->input->post('delivery_place'))$delivery_place=$this->input->post('delivery_place'); else $delivery_place="";
		// if($this->input->post('delivery_location'))$delivery_location=$this->input->post('delivery_location'); else $delivery_location="";
		// if($this->input->post('hospital_type'))$hospital_type=$this->input->post('hospital_type'); else $hospital_type="";
		// if($this->input->post('delivery_location_type'))$delivery_location_type=$this->input->post('delivery_location_type'); else $delivery_location_type="";
		// if($this->input->post('delivery_plan'))$delivery_plan=$this->input->post('delivery_plan'); else $delivery_plan="";
		// if($this->input->post('birth_weight'))$birth_weight=$this->input->post('birth_weight'); else $birth_weight="";
		// if($this->input->post('congenial_anamalies'))$congenial_anamalies=$this->input->post('congenial_anamalies'); else $congenial_anamalies="";
		if($this->input->post('address')) $address=$this->input->post('address'); else $address="";
		if($this->input->post('place')) $place=$this->input->post('place'); else $place="";
	        if($this->input->post('doctor_Id')) $doctor_id=$this->input->post('doctor_id'); else $doctor_id="";
		if($this->input->post('nurse')) $nurse=$this->input->post('nurse'); else $nurse="";
                if($this->input->post('visit_name_id')) $visit_name_id=$this->input->post('visit_name_id'); else $visit_name_id="";
		if($this->input->post('insurance_case')) $insurance_case=$this->input->post('insurance_case'); else $insurance_case="";
		if($this->input->post('insurance_no')) $insurance_no=$this->input->post('insurance_no'); else $insurance_no="";
                if($this->input->post('refereal_hospital_id')) $refereal_hospital_id=$this->input->post('refereal_hospital_id'); else $refereal_hospital_id="";
                if($this->input->post('arrival_mode')) $arrival_mode=$this->input->post('arrival_mode'); else $arrival_mode="";
		if($this->input->post('sbp')) $sbp=$this->input->post('sbp'); else $sbp="";
		if($this->input->post('dbp')) $dbp=$this->input->post('dbp'); else $dbp="";
		if($this->input->post('pulse_rate')) $pulse_rate=$this->input->post('pulse_rate'); else $pulse_rate="";
		if($this->input->post('respiratory_rate')) $respiratory_rate=$this->input->post('respiratory_rate'); else $respiratory_rate="";
		if($this->input->post('temperature')) $temperature=$this->input->post('temperature'); else $temperature="";
		if($this->input->post('admit_weight')) $admit_weight=$this->input->post('admit_weight'); else $admit_weight="";
		// if($this->input->post('discharge_weight')) $discharge_weight=$this->input->post('discharge_weight'); else $discharge_weight="";
		if($this->input->post('phone')) $phone=$this->input->post('phone'); else $phone="";
		if($this->input->post('alt_phone')) $alt_phone=$this->input->post('alt_phone'); else $alt_phone="";
		$district=$this->input->post('district');
		$department=$this->input->post('department');
		$unit=$this->input->post('unit');
		$area=$this->input->post('area');
		if($this->input->post('presenting_complaints')) $presenting_complaints=$this->input->post('presenting_complaints'); else $presenting_complaints="";
		// if($this->input->post('provisional_diagnosis')) $provisional_diagnosis=$this->input->post('provisional_diagnosis'); else $provisional_diagnosis="";
	    if($this->input->post('past_history')) $past_history=$this->input->post('past_history'); else $past_history="";
	    if($this->input->post('family_history')) $family_history=$this->input->post('family_history'); else $family_history="";
	    if($this->input->post('clinical_findings')) $clinical_findings=$this->input->post('clinical_findings'); else $clinical_findings="";
	    if($this->input->post('cvs')) $cvs=$this->input->post('cvs'); else $cvs="";
	    if($this->input->post('rs')) $rs=$this->input->post('rs'); else $rs="";
	    if($this->input->post('pa')) $pa=$this->input->post('pa'); else $pa="";
	    if($this->input->post('cns')) $cns=$this->input->post('cns'); else $cns="";
		$hospital=$this->session->userdata('hospital');
		$hospital_id=$hospital['hospital_id'];
		// $form_type=$this->input->post('form_type');                
		
		$outcome=$this->input->post('outcome');
                if(($this->input->post('mlc_radio')=='1' || $this->input->post('mlc_radio')=='-1')) $mlc_radio= $this->input->post('mlc_radio'); else $mlc_radio=0;                
		if($this->input->post('outcome_date')) $outcome_date=date("Y-m-d",strtotime($this->input->post('outcome_date'))); else $outcome_date = 0;
		if($this->input->post('outcome_time')) $outcome_time=date("h:i:s",strtotime($this->input->post('outcome_time'))); else $outcome_time = 0;
		if($this->input->post('final_diagnosis')) $final_diagnosis=$this->input->post('final_diagnosis'); else $final_diagnosis="";
		if($this->input->post('decision')) $decision=$this->input->post('decision'); else $decision="";
		if($this->input->post('advise')) $advise=$this->input->post('advise'); else $advise="";
		if($this->input->post('icd_code')) $icd_code=$this->input->post('icd_code'); else $icd_code="";
		if($this->input->post('congenital_anomalies')) $congenital_anomalies=$this->input->post('congenital_anomalies'); else $congenital_anomalies="";

		//Creating an array with the database column names as keys and the post values as values. 
		$data=array(
                        'first_name'=>$first_name,
                        'middle_name'=>$middle_name,
			'last_name'=>$last_name,
			'age_years'=>$age_years,
			'age_months'=>$age_months,
			'age_days'=>$age_days,
                        'dob'=>$dob,
			'gender'=>$gender,
			'spouse_name'=>$spouse_name,
			'father_name'=>$father_name,
			'mother_name'=>$mother_name,
			'id_proof_type_id'=>$id_proof_type,
			'id_proof_number'=>$id_proof_no,
			'occupation_id'=>$occupation,
			'education_level'=>$education_level,
			'education_qualification'=>$education_qualification,
                        'identification_marks'=>$identification_marks,
			'blood_group'=>$blood_group,
			// 'gestation'=>$gestation, 
			// 'gestation_type'=>$gestation_type,
			// 'hospital_type'=>$hospital_type,
			// 'delivery_location_type'=>$delivery_location_type,
			// 'delivery_mode'=>$delivery_mode,
			// 'delivery_place'=>$delivery_place,
			// 'delivery_plan'=>$delivery_plan,
			// 'delivery_location'=>$delivery_location,
			// 'congenital_anomalies'=>$congenital_anomalies,
			// 'birth_weight'=>$birth_weight,
			// 'dob'=>$dob,
			'address'=>$address,
			'place'=>$place,
			'phone'=>$phone,
                        'alt_phone'=>$alt_phone,
			'district_id'=>$district,
                        
		);
		
		//Start a mysql transaction.
		$this->db->trans_start();

		if($this->input->post('patient_id')){
			//if the patient id is received in the post variables, use it to update the particular patient.
			$patient_id=$this->input->post('patient_id');
			$this->db->where('patient_id',$patient_id);
			$this->db->update('patient',$data);
		}
		// Update photograph
                if($this->input->post('patient_picture')){
			$encoded_data = $this->input->post('patient_picture');
			$binary_data = base64_decode( $encoded_data );

			// save to server (beware of permissions)
			$result = file_put_contents("assets/images/patients/$patient_id.jpg", $binary_data );
			if (!$result) die("Could not save image!  Check file permissions.");
		}
		//Creating an array with the database column names as keys and the post values as values. 
		$visit_data=array( 
		    'hospital_id'=>$hospital_id,
			'department_id'=>$department,
			// 'insurance_case'=>$insurance_case,
			// 'insurance_no'=>$insurance_no,
			'sbp'=>$sbp,
			'dbp'=>$dbp,
			'pulse_rate'=>$pulse_rate,
			'respiratory_rate'=>$respiratory_rate,
			'temperature'=>$temperature,
			'admit_weight'=>$admit_weight,
			// 'discharge_weight'=>$discharge_weight,
			// 'visit_type'=>$form_type,
			// 'patient_id'=>$patient_id,
			// 'hosp_file_no'=>$hosp_file_no,
			'unit'=>$unit,
			'area'=>$area,
			// 'provisional_diagnosis'=>$provisional_diagnosis,
			'presenting_complaints'=>$presenting_complaints,
			'past_history'=>$past_history,
			'family_history'=>$family_history,
			'clinical_findings'=>$clinical_findings,
			'cvs'=>$cvs,
			'rs'=>$rs,
			'pa'=>$pa,
			'cns'=>$cns,
			// 'admit_date'=>$date,
			// 'admit_time'=>$time,
			'mlc'=>$mlc_radio,
                        'visit_name_id'=>$visit_name_id,
                        'insurance_case'=>$insurance_case,
                        'insurance_no'=>$insurance_no,
                        'refereal_hospital_id'=>$refereal_hospital_id,
                        'arrival_mode' => $arrival_mode,
			'outcome'=>$outcome,
			'outcome_date'=>$outcome_date,
			'outcome_time'=>$outcome_time,
			'final_diagnosis'=>$final_diagnosis,
			'decision'=>$decision,
			'advise'=>$advise,
			'icd_10'=>$icd_code
		);
                $visit_id = '';
		if($this->input->post('visit_id')){
			//if it's an update form, use the visit id from the post variables and update the record in the patient_visit table
			$visit_id=$this->input->post('visit_id');
			$this->db->where('visit_id',$visit_id);
			$this->db->update('patient_visit',$visit_data);
                        if($this->input->post('transfer_department'))$transfer_department_id=$this->input->post('transfer_department'); else $transfer_department_id="";
                        if($this->input->post('transfer_area'))$transfer_area_id=$this->input->post('transfer_area'); else $transfer_area_id="";
                        if($this->input->post('transfer_date')) $transfer_date=date("Y-m-d",strtotime($this->input->post('transfer_date'))); else $transfer_date=0;
                        if($this->input->post('transfer_time'))$transfer_time=$this->input->post('transfer_time'); else $transfer_time="";
                        if(!empty($transfer_department_id)||!empty($transfer_area_id)){
                            $transfer_info = array(
                                'visit_id'=>$visit_id,
                                'department_id'=>$transfer_department_id,
                                'area_id'=>$transfer_area_id,
                                'transfer_date'=>$transfer_date,
                                'transfer_time'=>$transfer_time
                            );
                            $this->db->insert('internal_transfer',$transfer_info);
                        }
		}
                //check if it is an mlc case, i.e mlc is being updated.
                //if mlc_number value is 'unset', it means mlc has not be added while creating patient_visit, we need to add now.
                //if mlc_number has a value then it means the exisiting record needs to be updated with whatever values have been set.
                $mlc_number_manual='';
                $mlc_number = "";
                $ps_name = "";
                $pc_number= "";
                $brought_by = "";
                $police_intimation = "";
                $declaration_required= "";
                
		if($this->input->post('mlc_radio')=='1'){
                    $this->db->select('count')->from('counter')->where('counter_name','MLC');
                    $query = $this->db->get();
                    $result = $query->row();
                    $mlc_number = ++$result->count;
                    $this->db->where('counter_name','MLC');
                    $this->db->update('counter',array('count'=>$mlc_number));
                    $mlc_number_manual=$this->input->post('mlc_number_manual');
                    $ps_name=$this->input->post('ps_name');
                    $pc_number=$this->input->post('pc_number');
                    $brought_by=$this->input->post('brought_by');
                    $police_intimation=$this->input->post('police_intimation');
                    $declaration_required=$this->input->post('declaration_required');
		}
		else {
                    $mlc_number = "";
                    $mlc_number_manual = "";
		}
                $mlc_data=array(
                    'visit_id'=>$visit_id,
                    'mlc_number'=>"A".$mlc_number,
                    'mlc_number_manual'=>$mlc_number_manual,
                    'ps_name'=>$ps_name,
                    'pc_number'=>$pc_number,
                    'brought_by'=>$brought_by,
                    'police_intimation'=>$police_intimation,
                    'declaration_required'=>$declaration_required
                );
              
                if($this->input->post('mlc_radio')=='1'){
                    // if the mlc field is selected as "Yes", and mlc_number is not set.
                    if( $this->input->post('mlc_number')=="unset"){
                        $this->db->insert('mlc',$mlc_data);                            
                    }
                    else{
                        //if it's an update form, use the visit id to update the mlc record in the databse - mlc table.
                        $this->db->where('visit_id',$visit_id);
                        $this->db->update('mlc',$mlc_data);
                    }
		}
		
		if($this->input->post('prescription')){
			$prescription = $this->input->post('prescription');
			$prescription_data = array();
			foreach($prescription as $pre) {
			if($this->input->post('drug_'.$pre)){
			$duration=$this->input->post('duration_'.$pre);
			$frequency=$this->input->post('frequency_'.$pre);
			$bb=$this->input->post('bb_'.$pre);
			$ab=$this->input->post('ab_'.$pre);
			$bl=$this->input->post('bl_'.$pre);
			$al=$this->input->post('al_'.$pre);
			$bd=$this->input->post('bd_'.$pre);
			$ad=$this->input->post('ad_'.$pre);
			$quantity=$this->input->post('quantity_'.$pre);
			$unit=$this->input->post('lab_unit_'.$pre);
			$drug = $this->input->post('drug_'.$pre);
				$morning=0;$afternoon=0;$evening=0;
				if(!!$bb && !!$ab) $morning = 3;
				else if(!!$bb) $morning = 1;
				else if(!!$ab) $morning = 2;
				if(!!$bl && !!$al) $afternoon = 3;
				else if(!!$bl) $afternoon = 1;
				else if(!!$al) $afternoon = 2;
				if(!!$bd && !!$ad) $evening = 3;
				else if(!!$bd) $evening = 1;
				else if(!!$ad) $evening = 2;
				$prescription_data[] = array(
					'visit_id'=>$visit_id,
					'item_id'=>$drug,
					'duration'=>$duration,
					'frequency'=>$frequency,
					'morning'=>$morning,
					'afternoon'=>$afternoon,
					'evening'=>$evening,
					'quantity'=>$quantity,
					'unit_id'=>$unit
				);
				}
			}
			if(!!$prescription_data)
			$this->db->insert_batch('prescription',$prescription_data);
		}
		/*
		if($this->input->post('procedure')){
			$procedure_id = $this->input->post('procedure');
			if($this->input->post('procedure_date') $procedure_date = date("Y-m-d",strtotime($this->input->post('procedure_date')));
			else $procedure_date=0;
			if($this->input->post('procedure_time') $procedure_time = date("h:i:s",strtotime($this->input->post('procedure_time')));
			else $procedure_time=0;
			$duration = $this->input->post('duration');
			$procedure_note = $this->input->post('procedure_note');
			$procedure_findings = $this->input->post('procedure_findings');
			$post_procedure_note = $this->input->post('post_procedure_note');
			
				$prescription_data[] = array(
					'visit_id'=>$visit_id,
					'item_id'=>$drug,
					'duration'=>$duration,
					'frequency'=>$frequency,
					'morning'=>$morning,
					'afternoon'=>$afternoon,
					'evening'=>$evening,
					'quantity'=>$quantity,
					'unit_id'=>$unit
				);
				}
			}
			if(!!$prescription_data)
			$this->db->insert_batch('prescription',$prescription_data);
		}
		*/
		//Transaction ends here.
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		}
		else {
			return true;
		}

	}
	
	function search(){
		//Build the where conditions based on the input given by the user.
		if($this->input->post('search_patient_id')){
			$this->db->where('patient.patient_id',$this->input->post('search_patient_id'));
		}
		if($this->input->post('search_patient_name')){
			$name=$this->input->post('search_patient_name');
			$this->db->like("LOWER(CONCAT(first_name,' ',last_name))",strtolower($name),'after');
		}
		if($this->input->post('search_visit_type')){
			$this->db->where('visit_type',$this->input->post('search_visit_type'));
		}
		if($this->input->post('search_patient_number')){
			$this->db->where('hosp_file_no',$this->input->post('search_patient_number'));
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
			$this->db->or_where('alt_phone',$this->input->post('search_phone'));
		}
		if($this->input->post('selected_patient')){
			$this->db->where('patient_visit.visit_id',$this->input->post('selected_patient'));
		}
		if($this->input->post('visit_id')){
			$this->db->where('patient_visit.visit_id',$this->input->post('visit_id'));
		}
		if($this->input->post('search_year')){
			$this->db->where('YEAR(patient_visit.admit_date)',$this->input->post('search_year'));
		}
		//Build the query to retrieve the patient records based on the search query.
		$this->db->select("patient.*,patient_visit.*,CONCAT(first_name,' ',last_name) name,
		IF(father_name IS NULL OR father_name='',spouse_name,father_name) parent_spouse,patient.*,patient_visit.*,mlc.*,occupation.occupation,id_proof_type,
		area_name,state.state_id,state.state,unit_name,unit.unit_id,code_title,area.area_id,district,department,patient.patient_id,patient_visit.visit_id, 
                patient_procedure.procedure_duration, patient_procedure.procedure_note, patient_procedure.procedure_findings, visit_name.visit_name",false)
		->from('patient')
		->join('patient_visit','patient.patient_id=patient_visit.patient_id')
                ->join('visit_name','patient_visit.visit_name_id=visit_name.visit_name_id','left')
                ->join('patient_procedure','patient_procedure.visit_id = patient_visit.visit_id','left')
		->join('department','patient_visit.department_id=department.department_id','left')
		->join('district','patient.district_id=district.district_id','left')
		->join('state','district.state_id=state.state_id','left')
		->join('unit','patient_visit.unit=unit.unit_id','left')
		->join('area','patient_visit.area=area.area_id','left')
		->join('mlc','patient_visit.visit_id=mlc.visit_id','left')
		->join('occupation','patient.occupation_id=occupation.occupation_id','left')
		->join('id_proof_type','patient.id_proof_type_id=id_proof_type.id_proof_type_id','left')
		->join('icd_code','patient_visit.icd_10=icd_code.icd_code','left')
		->order_by('name','ASC');
		$query=$this->db->get();
		//return the search results
		return $query->result();
	}
	function select($visit_id=0){
		if($visit_id!=0) //if the visit_id is true, select the patient where visit_id equals the given visit id
			$this->db->where('patient_visit.visit_id',$visit_id);
		else return false; 
		
		$this->db->select('patient.*,patient_visit.*,department.department,unit.unit_id,unit.unit_name,area.area_id,area.area_name,mlc.mlc_number,mlc.mlc_number_manual,mlc.ps_name')
		->from('patient')->join('patient_visit','patient.patient_id=patient_visit.patient_id')
		->join('department','patient_visit.department_id=department.department_id','left')
		->join('unit','patient_visit.unit=unit.unit_id','left')
		->join('area','patient_visit.area=area.area_id','left')
		->join('mlc','patient_visit.visit_id=mlc.visit_id','left');
	    $query=$this->db->get();
		//return the patient details in a single row.
		return $query->row();
	}
	
	function get_visits($patient_id=0){
		if($patient_id!=0) //if the visit_id is true, select the patient where visit_id equals the given visit id
			$this->db->where('patient_visit.patient_id',$patient_id);
		else return false; 
		
		$this->db->select('patient.*,patient_visit.*,department.department,unit.unit_id,unit.unit_name,area.area_id,area.area_name,mlc.mlc_number,mlc.ps_name')
		->from('patient')->join('patient_visit','patient.patient_id=patient_visit.patient_id')
		->join('department','patient_visit.department_id=department.department_id','left')
		->join('unit','patient_visit.unit=unit.unit_id','left')
		->join('area','patient_visit.area=area.area_id','left')
		->join('mlc','patient_visit.visit_id=mlc.visit_id','left')
		->order_by('admit_date','desc')
		->order_by('admit_time','desc');
	    $query=$this->db->get();
		//return the patient details in a single row.
		return $query->result();
	}
	
	function search_icd_codes(){
		$this->db->select('icd_code, CONCAT(icd_code," ",code_title) as code_title',false)->from('icd_code')->order_by('code_title')->like('code_title',$this->input->post('query'),'both');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	function get_prescription($visit_id){
		$this->db->select('prescription.*,item_name,lab_unit')->from('prescription')
		->join('lab_unit','prescription.unit_id = lab_unit.lab_unit_id')
		->join('item','prescription.item_id = item.item_id')
		->where('visit_id',$visit_id)->where('status',1);
		$query=$this->db->get();
		return $query->result();
	}
}
?>
