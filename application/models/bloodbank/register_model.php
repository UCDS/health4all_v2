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
		if(strlen($this->input->post('donor_id'))>0)
		{
			$this->db->where('donor_id',$this->input->post('donor_id'));
			$this->db->update('blood_donor',$data);
			$donor_id=$this->input->post('donor_id');
		}
		else
		{
			$this->db->insert('blood_donor',$data);
			$donor_id=$this->db->insert_id();
		}
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

	/**
	* Search for donors
	*/
	function get_donors(){
		if($this->input->post('donor_id')){
			$this->db->like('LOWER(blood_donor.donor_id)',strtolower($this->input->post('donor_id')));
		}
		if($this->input->post('donor_name')){
			$this->db->like('LOWER(blood_donor.name)',strtolower($this->input->post('donor_name')));
		}
		if($this->input->post('donor_email')){
			$this->db->like('LOWER(blood_donor.email)',strtolower($this->input->post('donor_email')));
		}
		if($this->input->post('donor_mobile')){
			$this->db->like('blood_donor.phone',$this->input->post('donor_mobile'));
		}
		if($this->input->post('blood_group')){
			$this->db->where('blood_donor.blood_group',$this->input->post('blood_group'));
		}
		if($this->input->post('gender')){
			$this->db->where('blood_donor.sex',$this->input->post('gender'));
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
	}// get_checked_donors

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
	}// update_medical

	function update_bleeding($donation_id){
		if($this->input->post('incomplete')){
			$status_id=3;
			$blood_unit=$this->input->post('blood_unit_num');
		}
		else{
			$status_id=4;
			$blood_unit=$this->input->post('blood_unit_num');
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
	}//update_bleeding

	function make_request(){
		$userdata=$this->session->userdata('logged_in');
		$staff_id=$userdata['user_id'];
		$hospitaldata=$this->session->userdata('hospital');
		$bloodbank_id = $hospitaldata['hospital_id'];
		$patient_type = $this->input->post('patient_type');
		if($patient_type=='Internal'){
			$this->db->select('visit_id')->from('patient_visit')
			->where('hosp_file_no',$this->input->post('hosp_file_no'))
			->where('visit_type',$this->input->post('visit_type'))
			->where('YEAR(admit_date)',$this->input->post('year'),false); 
			$query=$this->db->get();
			echo $this->db->last_query();
			$row=$query->row();
			$visit_id=$row->visit_id;
		}
		else if($patient_type=='External'){
			$visit_id = $this->input->post('hosp_file_no');
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
		foreach($blood_groups as $blood_group){
		$data[]=array(
		'staff_id'=>$staff_id,
		'bloodbank_id'=>$bloodbank_id,
		'patient_id'=>$visit_id,
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
		$i++;
		}
		$this->db->trans_start();
		$this->db->insert_batch('blood_request',$data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}// make_request

	function get_camps($camp=''){
		$userdata=$this->session->userdata('hospital');
		$hospital=$userdata['hospital_id'];
		if($camp!=''){
			$this->db->where('camps.camp_id',$this->input->post('camp'));
		}
		$this->db->select('camps.camp_id,camp_name,location')
		->from('blood_donation_camp camps')
		->where('hospital_id',$hospital);
		$query=$this->db->get();
		return $query->result();
	}// get_camps

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
	}// check_unique

}
?>
