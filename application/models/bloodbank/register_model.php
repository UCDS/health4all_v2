<?php 
class Register_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function search($search_type,$search,$hospital_id){

		$userdata=$this->session->userdata('hospital');
		$hospital=$userdata['hospital_id'];
		$this->db->select("*")
		->from("bb_appointment")
		->join("bb_app_slot_link","bb_appointment.appointment_id=bb_app_slot_link.app_id","left")
		->join("bb_slot","bb_app_slot_link.slot_id=bb_slot.slot_id","left")
		->like(strtolower($search_type),strtolower($search))
		->where('hospital_id',$hospital);
		$query=$this->db->get();
		return $query->result();
	}// search

	function donor_register(){
		$place=$this->session->userdata('place');
		$userdata=$this->session->userdata('hospital');
		$hospital=$userdata['hospital_id'];
		$name=$this->input->post('name');
		$parent_spouse=$this->input->post('parent_spouse');
		$maritial=$this->input->post('maritial_status');
		$occupation=$this->input->post('occupation');
		$dob=date("Y-m-d",strtotime($this->input->post('dob')));
		$age=$this->input->post('age');
		$sex=$this->input->post('gender');
		$blood_group=$this->input->post('blood_group');
		$mobile=$this->input->post('mobile');
		$email=$this->input->post('email');
		$address=$this->input->post('address');
		$replacement_patient_id="";
		if(!!$place['camp_id']) $camp_id=$place['camp_id'];
		else $camp_id = 0;
		$data=array(
		'name'=>$name,
		'parent_spouse'=>$parent_spouse,
		'maritial_status'=>$maritial,
		'occupation'=>$occupation,
		'dob'=>$dob,
		'age'=>$age,
		'sex'=>$sex,
		'blood_group'=>$blood_group,
		'phone'=>$mobile,
		'email'=>$email,
		'address'=>$address
		);
		$this->db->trans_start();
		if($donation_type=$this->input->post('donation_type')){
			if($donation_type=="replacement"){
				$patient_name=$this->input->post('patient_name');
				$patient_ip=$this->input->post('ip_no');
				$patient_ward_unit=$this->input->post('ward_unit');
				$patient_blood_group=$this->input->post('patient_blood_group');
				$patient_data=array(
				'ip_number'=>$patient_ip,
				'name'=>$patient_name,
				'ward_unit'=>$patient_ward_unit,
				'blood_group'=>$patient_blood_group
				);
				$this->db->insert('bb_replacement_patient',$patient_data);
				$replacement_patient_id=$this->db->insert_id();
			}		
		}
		$this->db->insert('blood_donor',$data);
		$donor_id=$this->db->insert_id();
		$data=array(
                    'donor_id'=>$donor_id,
                    'replacement_patient_id'=>$replacement_patient_id,
                    'status_id'=>1,
                    'camp_id'=>$camp_id,
                    'hospital_id'=>$hospital
		);
		$this->db->insert('bb_donation',$data);
		$this->db->trans_complete();
		if($this->db->trans_status()==FALSE){
			return false;
		}
		else{
			return true;
		}
	}// donor_register
        
        function repeat_donor(){
            $place=$this->session->userdata('place');
            $userdata=$this->session->userdata('hospital');
            $hospital=$userdata['hospital_id'];
            $name=$this->input->post('name');
            $parent_spouse=$this->input->post('parent_spouse');
            $maritial=$this->input->post('maritial_status');
            $occupation=$this->input->post('occupation');
            $dob=date("Y-m-d",strtotime($this->input->post('dob')));
            $age=$this->input->post('age');
            $sex=$this->input->post('gender');
            $blood_group=$this->input->post('blood_group');
            $phone=$this->input->post('phone');
            $email=$this->input->post('email');
            $address=$this->input->post('address');
            $replacement_patient_id="";
            if(!!$place['camp_id']) $camp_id=$place['camp_id'];
            else $camp_id = 0;
            $data=array(
            'name'=>$name,
            'parent_spouse'=>$parent_spouse,
            'maritial_status'=>$maritial,
            'occupation'=>$occupation,
            'dob'=>$dob,
            'age'=>$age,
            'sex'=>$sex,
            'blood_group'=>$blood_group,
            'phone'=>$phone,
            'email'=>$email,
            'address'=>$address
            );
            $this->db->trans_start();
            if($donation_type=$this->input->post('donation_type')){
                if($donation_type=="replacement"){
                    $patient_name=$this->input->post('patient_name');
                    $patient_ip=$this->input->post('ip_no');
                    $patient_ward_unit=$this->input->post('ward_unit');
                    $patient_blood_group=$this->input->post('patient_blood_group');
                    $patient_data=array(
                    'ip_number'=>$patient_ip,
                    'name'=>$patient_name,
                    'ward_unit'=>$patient_ward_unit,
                    'blood_group'=>$patient_blood_group
                    );                    
                    $this->db->insert('bb_replacement_patient',$patient_data);
                    $replacement_patient_id=$this->db->insert_id();
                }		
            }
            $donor_id = $this->input->post('repeat_donor');
            $this->db->where('donor_id', $this->input->post('donor_id'));
            $this->db->update('blood_donor',$data);
            
            $data=array(
                'donor_id'=>$donor_id,
                'replacement_patient_id'=>$replacement_patient_id,
                'status_id'=>1,
                'camp_id'=>$camp_id,
                'hospital_id'=>$hospital
            );
            $this->db->insert('bb_donation',$data);
            $this->db->trans_complete();
            if($this->db->trans_status()==FALSE){
                    return false;
            }
            else{
                    return true;
            }
        }
        
	function get_registered_donors(){
		$args=func_get_args();
		$place=$this->session->userdata('place');

		$userdata=$this->session->userdata('hospital');
		$hospital=$userdata['hospital_id'];
		if(count($args)>0){
			$this->db->where('donation_id',func_get_arg(0));
		}
		$this->db->where('camp_id',$place['camp_id']);
		$this->db->select('*')
		->from('bb_donation')
		->join('blood_donor','bb_donation.donor_id=blood_donor.donor_id')
		->where('status_id',1)
		->where('hospital_id',$hospital);
		$query=$this->db->get();
		return $query->result();
	}// get_registered_donors

	function get_appointments(){
		$userdata=$this->session->userdata('hospital');
		$hospital=$userdata['hospital_id'];
		if($this->input->post('slot_date')){
			$date=$this->input->post('slot_date');
			$this->db->where('bb_slot.date',date("Y-m-d",strtotime($date)));
		}
		else{
			$this->db->where('bb_slot.date','CURDATE()',FALSE)
			->where('CURTIME() BETWEEN from_time AND to_time');
		}
		if($this->input->post('app_id')){
			$app_id=$this->input->post('app_id');
			$this->db->where('appointment_id',$app_id);
		}
		$this->db->select('*')
		->from('bb_appointment')
		->join('bb_slot','bb_appointment.slot_id=bb_slot.slot_id')
		->join('blood_donor','bb_appointment.donor_id=blood_donor.donor_id')
		->where('status','pending')
		->where('hospital_id',$hospital);
		$query=$this->db->get();
		return $query->result();
	}//get_appointments

	function register_donation($donor_id){

		$userdata=$this->session->userdata('hospital');
		$hospital=$userdata['hospital_id'];
		$this->db->trans_start();
		if($this->input->post('appointment_id')){
			$this->db->insert('bb_donation',array('donor_id'=>$donor_id,'status_id'=>1));
			$donation_id=$this->db->insert_id();
			$this->db->where('appointment_id',$this->input->post('appointment_id'));
			$this->db->update('bb_appointment',array('status'=>'donated'));
		}
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE){
		return $donation_id;
		}
		else return FALSE;
	}// register_donation
		
		
	function get_checked_donors(){
		$args=func_get_args();
		$place=$this->session->userdata('place');

		$userdata=$this->session->userdata('hospital');
		$hospital=$userdata['hospital_id'];
		if(count($args)>0){
			$this->db->where('donation_id',func_get_arg(0));
		}
		$this->db->where('camp_id',$place['camp_id']);
		$this->db->select('*')
		->from('bb_donation')
		->join('blood_donor','bb_donation.donor_id=blood_donor.donor_id')
		->where('status_id',2)
		->where('hospital_id',$hospital);
		$query=$this->db->get();
		return $query->result();
	}
	
	function update_medical($donation_id){
		$data=array(
		'weight'=>$this->input->post('weight'),
		'pulse'=>$this->input->post('pulse'),
		'hb'=>$this->input->post('hb'),
		'sbp'=>$this->input->post('sbp'),
		'dbp'=>$this->input->post('dbp'),
		'temperature'=>$this->input->post('temperature'),
		'donation_time'=>$this->input->post('donation_time'),
		'donation_date'=>date("Y-m-d",strtotime($this->input->post('donation_date'))),
		'status_id'=>2
		);
		$this->db->trans_start();
		$this->db->where('donation_id',$donation_id);
		$this->db->update('bb_donation',$data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function update_bleeding($donation_id){
		if($this->input->post('incomplete')){
			$status_id=3;
			$blood_unit=$this->input->post('blood_unit_num');
		}
		else{
			$status_id=4;
			$blood_unit=$this->input->post('blood_unit_num');
		}
		$this->db->select('blood_unit_num,donation_date'); 
		$this->db->where('blood_unit_num',$blood_unit);
		$this->db->where('YEAR(donation_date)',date("Y"));
		$this->db->from('bb_donation');
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			return 2; 
		}	
		$data=array(
		'blood_unit_num'=>$blood_unit,
		'segment_num'=>$this->input->post('segment_num'),
		'bag_type'=>$this->input->post('bag_type'),
		'collected_by'=>$this->input->post('staff'),
		'status_id'=>$status_id,
		);
		$blood_group=array(
		'blood_group'=>$this->input->post('blood_group')
		);
		$userdata=$this->session->userdata('logged_in');
		$result=$this->db->query("SELECT DATE_ADD((SELECT donation_date FROM bb_donation WHERE donation_id=$donation_id),INTERVAL 35 DAY) expiry_date");
		$row=$result->row();
		$blood=array(
		'component_type'=>'WB',
		'status_id'=>7,
		'donation_id'=>$donation_id,
		'volume'=>$this->input->post('volume'),
		'created_by'=>$userdata['user_id'],
		'expiry_date'=>$row->expiry_date,
		'datetime'=>date("Y-m-d H:m:s")
		);
		$screening=array(
		'donation_id'=>$donation_id
		);
		
		$this->db->trans_start();
		$this->db->where('donation_id',$donation_id);
		$this->db->update('bb_donation',$data);
		$this->db->where('donor_id','(SELECT donor_id FROM bb_donation WHERE donation_id='.$donation_id.')',FALSE);
		$this->db->update('blood_donor',$blood_group);
		$this->db->insert('blood_inventory',$blood,FALSE);
		$this->db->insert('blood_screening',$screening);		
		$this->db->select('name,email,donation_date')
		->from('blood_donor')->join('bb_donation','blood_donor.donor_id=bb_donation.donor_id')
		->where('donation_id',$donation_id);
		$query=$this->db->get();
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE){
		return $query->result();
		}
		else{
			return false;
		}
	}
	
	
	function get_camps($camp=''){

		$userdata=$this->session->userdata('hospital');
		$hospital=$userdata['hospital_id'];
		if($camp!=''){
			$this->db->where('camps.camp_id',$this->input->post('camp'));
		}
		$this->db->select('camps.camp_id,camp_name,location')
		->from('blood_donation_camp camps')
                ->order_by('camp_name','ASC');
		//->where('hospital_id',$hospital);
		$query=$this->db->get();
		return $query->result();
	}
	
	function check_unique($blood_unit_num){
		$userdata=$this->session->userdata('hospital');
		$hospital=$userdata['hospital_id'];
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year=$year_start; }
		else $year=date("Y-m-d",strtotime("April 1 Last year"));
		
		$this->db->select('donation_id')
		->from('bb_donation')
		->where('blood_unit_num',$blood_unit_num)
		->where('donation_date >=',$year)
		->where('hospital_id',$hospital);
		$query=$this->db->get();
		return $query;
	}
/**
	* Search for donors
	*/
	function get_donors(){
		if($this->input->post('donor_id')){
                    $donor_id = $this->input->post('donor_id');
                    $this->db->where('blood_donor.donor_id',$donor_id);
		}
		if($this->input->post('donor_name')){
                    $donor_name = $this->input->post('donor_name');
                    $this->db->like('LOWER(blood_donor.name)',strtolower($donor_name));
		}
		if($this->input->post('donor_email')){
                    $donor_email = $this->input->post('donor_email');
                    $this->db->like('LOWER(blood_donor.email)',strtolower($donor_email));
		}
		if($this->input->post('donor_mobile')){
                    $donor_mobile = $this->input->post('donor_mobile');
                    $this->db->where('blood_donor.phone', $donor_mobile);
		}
		if($this->input->post('blood_group')){
                    $blood_group = $this->input->post('blood_group');
                    $this->db->where('blood_donor.blood_group', $blood_group);
		}
		if($this->input->post('gender')){
                    $gender = $this->input->post('gender');
                    $this->db->where('blood_donor.sex', $gender);
		}
		$this->db->select("donor_id, name, parent_spouse,
		occupation,	
		dob, sex, blood_group, phone, email, address");
		 $this->db->from('blood_donor');

		$resource=$this->db->get();
		return $resource->result();
	}// get_donors

/**
	* Get donor details form db
	*/
	function get_donor_details($donor_id=""){
		/**
		* Check for valid donor id
		*/
		if(strlen($donor_id) > 0)
		{
			$this->db->where('blood_donor.donor_id',$donor_id);
			$this->db->select("donor_id,name,parent_spouse,
			maritial_status,
			occupation,
			dob,age,sex,blood_group,phone,email,address");
			 $this->db->from('blood_donor');

			$resource=$this->db->get();
			return $resource->result();
		}//if
	}//get_donor_details

function make_request(){
        $userdata=$this->session->userdata('logged_in');
        $staff_id=$userdata['user_id'];
        $hospital_id=$this->session->userdata('hospital_id');
        $request_type = $this->input->post('request_type');
        //$bloodbank_id = $hospitaldata['hospital_id'];
        $patient_id = 0;
        $visit_id = 0;
        $patient_type = $this->input->post('patient_type');
        $doctor_name = $this->input->post('doctor_name');
        $patient_visit = $this->input->post('hospital_internal_id');
        if($patient_type=='Internal' && isset($patient_visit) && $request_type!=1){
            $this->db->select('visit_id,hospital_id,patient_id')->from('patient_visit')
            ->where('hosp_file_no',$this->input->post('hosp_file_no'));
       //     ->where('visit_type',$this->input->post('visit_type'))
        //    ->where('YEAR(admit_date)',$patient_visit,false);
         //   ->where('hospital_id',$this->input->post('hospital_internal_id')); 
            $query=$this->db->get();
            $row_result=$query->row(1);
            $visit_id=$row_result->visit_id;
            $hospital_id=$row_result->hospital_id;
            $patient_id = $row_result->patient_id;
        }
        else if($patient_type=='External' && $request_type!=1){
            //All the post variables are stored in local variables; 
		//based on the field type we modify the data as required before storing in the variables.
		$date=date("Y-m-d",strtotime($this->input->post('date')));
	//	$time=date_format(date_create_from_format('h:ia', $this->input->post('time')),'H:i:s');
		if($this->input->post('patient_first_name')) $first_name=$this->input->post('patient_first_name'); else $first_name="";
		if($this->input->post('patient_last_name')) $last_name=$this->input->post('patient_last_name'); else $last_name="";
		$age_years=$this->input->post('patient_age');
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
	//	if($this->input->post('blood_group'))$blood_group=$this->input->post('blood_group'); else $blood_group="";
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
		$alt_phone=$this->input->post('alt_phone');
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
		if($this->input->post('outcome_date')) $outcome_date=date("Y-m-d",strtotime($this->input->post('outcome_date'))); else $outcome_date = 0;
		if($this->input->post('outcome_time')) $outcome_time=date("h:i:s",strtotime($this->input->post('outcome_time'))); else $outcome_time = 0;
		if($this->input->post('patient_diagnosis')) $final_diagnosis=$this->input->post('patient_diagnosis'); else $final_diagnosis="";
		if($this->input->post('congenital_anomalies')) $congenital_anomalies=$this->input->post('congenital_anomalies'); else $congenital_anomalies="";
		if($this->input->post('visit_name')) $visit_name_id=$this->input->post('visit_name'); else $visit_name_id=0;
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
			'blood_group'=>'',
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
			'district_id'=>$district
		);
                $this->db->insert('patient',$data);
		$patient_id=$this->db->insert_id();
                $this->db->select('count')->from('counter')->where('counter_name','OP');
			$query=$this->db->get();
			$result=$query->row();
			$hospital_id = $this->input->post('hospital');
			$hosp_file_no=++$result->count;
			$this->db->where('counter_name','OP');
		$this->db->update('counter',array('count'=>$hosp_file_no));
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
			'visit_type'=>'OP',
			'visit_name_id'=>$visit_name_id,
			'patient_id'=>$patient_id,
			'hosp_file_no'=>$hosp_file_no,
			'unit'=>$unit,
			'area'=>$area,
			'provisional_diagnosis'=>$provisional_diagnosis,
			'presenting_complaints'=>$presenting_complaints,
			'past_history'=>$past_history,
			'admit_date'=>date('Y/m/d'),
			'admit_time'=>date('H:i:s'),
			'mlc'=>$mlc,
			'outcome'=>$outcome,
			'outcome_date'=>$outcome_date,
			'outcome_time'=>$outcome_time,
			'final_diagnosis'=>$final_diagnosis
		);
         $this->db->insert('patient_visit',$visit_data,false);
	     $visit_id=$this->db->insert_id(); //store the visit_id from the inserted record
        }
        
        $blood_transfusion_required=$this->input->post('blood_transfusion');
        $blood_groups=$this->input->post('blood_group');
        $whole_blood_units=$this->input->post('whole_blood_units');
        $packed_cell_units=$this->input->post('packed_cell_units');
        $fp_units=$this->input->post('fp_units');
        $ffp_units=$this->input->post('ffp_units');
        $prp_units=$this->input->post('prp_units');
        $platelet_concentrate_units=$this->input->post('platelet_concentrate_units');
        $cryoprecipitate_units=$this->input->post('cryoprecipitate_units');
        $request_date=date("Y-m-d",strtotime($this->input->post('request_date')));
        $i=0;
        $data = array();
        
        if($request_type==1)
               $patient_id = 0;
        foreach($blood_groups as $blood_group){
        $data[]=array(
        'staff_id'=>$staff_id,
        'request_type'=>$request_type,
        'hospital_id'=>$this->input->post('hospital'),
        //'bloodbank_id'=>$bloodbank_id,
        'patient_id'=>$patient_id,
        'visit_id' => $visit_id,
        'blood_group'=>$blood_group,
        'blood_transfusion_required'=>$blood_transfusion_required,
        'whole_blood_units'=>$whole_blood_units[$i],
        'packed_cell_units'=>$packed_cell_units[$i],
        'ffp_units'=>$ffp_units[$i],
        'fp_units'=>$fp_units[$i],
        'prp_units'=>$prp_units[$i],
        'platelet_concentrate_units'=>$platelet_concentrate_units[$i],
        'cryoprecipitate_units'=>$cryoprecipitate_units[$i],
        'request_date'=>$request_date,
        'request_status'=>"Pending",
        'patient_type'=>$patient_type
        );
        }
        $this->db->trans_start();
        $this->db->insert_batch('blood_request',$data);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

 function search_patients(){
 $name = array(
                   'LOWER(patient.first_name)'=>strtolower($this->input->post('query')), 
                   'LOWER(patient.last_name)'=>strtolower($this->input->post('query')),
                   'LOWER(patient.patient_id)'=>strtolower($this->input->post('query')),
                   'LOWER(patient.phone)'=>strtolower($this->input->post('query'))
        );
        $this->db->select('first_name,last_name,hosp_file_no,patient.patient_id,age_years,age_months,age_days')
        ->from('patient')
        ->join('patient_visit','patient.patient_id = patient_visit.patient_id','left')
        ->or_like($name,'both')
        ->or_like('LOWER(patient_visit.hosp_file_no)',strtolower($this->input->post('query')),'both')
        ->where('YEAR(admit_date)',$this->input->post('year'))
        ->where('visit_type',$this->input->post('visit_type'));

        $query=$this->db->get();
        if($query->num_rows()>0){
        return $query->result_array();
        }
        else return false;
    }
    
    function remove_donation($donation_id){
        $donor_cancel_details =array(
		'donation_id'=>$donation_id,
		'reason'=>$this->input->post('reason_for_cancel'),
		);
        $this->db->trans_start();
        $this->db->where('donation_id',$donation_id);
        $this->db->where('status_id','1');
	$this->db->update('bb_donation',array('status_id'=>'-1'));
        $this->db->insert('bb_donation_cancel',$donor_cancel_details);
        $this->db->trans_complete();
        if($this->db->trans_status()==TRUE){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    /* removing donor from bleeding and inserting the reason for cancelling*/
    function remove_donation_from_bleeding($donation_id){
        $bleeding_cancel_details =array(
		'donation_id'=>$donation_id,
		'reason'=>$this->input->post('reason_for_cancel'),
		);
        $this->db->trans_start();
        $this->db->where('donation_id',$donation_id);
        $this->db->where('status_id','2');
	$this->db->update('bb_donation',array('status_id'=>'-1')); //changing the status id from 2 to -1
        $this->db->insert('bb_donation_cancel',$bleeding_cancel_details);
        $this->db->trans_complete();
        if($this->db->trans_status()==TRUE){
            return true;
        }
        else{
            return false;
        }
        
    }
		
}
?>