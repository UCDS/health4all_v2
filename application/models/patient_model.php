<?php

class patient_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    //Method to get transfer information for a particular visit.
    function get_transfers_info($visit_id_param=0){
        if($this->input->post('selected_patient') || $this->input->post('visit_id') || $visit_id_param!=0){
            $visit_id = $this->input->post('selected_patient') ? $this->input->post('selected_patient') : $this->input->post('visit_id');
            $visit_id = $visit_id > 0 ? $visit_id :  $visit_id_param;
            $this->db->select('*')
                 ->from('internal_transfer')
                 ->where('visit_id',$visit_id);
            $query = $this->db->get();
            return $query->result();
        }
        return false;
    }
    
    //Method to get the arrival modes of patient for a particular visit.
    function get_arrival_modes(){
        $this->db->select('*')
                ->from('patient_arrival_mode');
        $query = $this->db->get();
        return $query->result();
    }
    
    //Method to retrieve visit type.
    function get_visit_types(){
        $this->db->select('*')
                ->from('visit_name');
        $query = $this->db->get();
        return $query->result();
    }
    
    function register_external_patient(){    //Presently used only for bloodbank module to be extended.
        $first_name="";
        $last_name="";
        $patient_age ="";
        $gender = "";
        $phone = "";
        $final_diagnosis ="";
        $ward_unit ="";
        if($this->input->post('first_name')){
            $first_name=$this->input->post('first_name');         
        }
        if($this->input->post('last_name')){ 
            $last_name=$this->input->post('last_name'); 
        }        
        if($this->input->post('patient_age')){
            $patient_age = $this->input->post('patient_age');
        }
        if($this->input->post('gender')){
            $gender=$this->input->post('gender');
        }
        if($this->input->post('phone')){
            $phone = $this->input->post('phone');
        }
        if($this->input->post('patient_diagnosis')){
            $final_diagnosis =$this->input->post('patient_diagnosis');
        }
        if($this->input->post('ward_unit')){
            $ward_unit = $this->input->post('ward_unit');
        }        
        
        $patient_data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'patient_age' => $patient_age,
            'gender' => $gender,
            'phone' => $phone    
        );
        
        $this->db->insert('patient',$patient_data);
        $patient_id=$this->db->insert_id();
        $this->db->select('count')->from('counter')->where('counter_name','OP');
        $query=$this->db->get();
        $result=$query->row();
        $hospital_id = $this->input->post('hospital');
        $hosp_file_no=++$result->count;
        $this->db->where('counter_name','OP');
        $this->db->update('counter',array('count'=>$hosp_file_no));
        
        $patient_visit_data = array(
            'patient_id' => $patient_id,
            'visit_type' => 'OP',
            'hosp_file_no' => $hosp_file_no,
            'unit' => $ward_unit,
            'final_diagnosis' => $final_diagnosis
        );        
        $this->db->insert('patient_visit',$patient_visit_data,false);
	$visit_id = $this->db->insert_id(); //store the visit_id from the inserted record
        return $visit_id;
    }
    
    function get_patient_info(){
        $patient_id = '';
        if($this->input->post('patient_id')){
            $patient_id = $this->input->post('patient_id');
        }
        else{
            return false;
        }
        
        $this->db->select('patient.patient_id, patient.first_name, patient.last_name, patient.phone, patient.blood_group, patient.gender, patient_visit.visit_id, patient_visit.hosp_file_no, patient_visit.provisional_diagnosis, patient_visit.final_diagnosis, patient_visit.hosp_file_no')
                ->from('patient')
                ->join('patient_visit','patient_visit.patient_id = patient.patient_id','left')
                ->where('patient.patient_id', "$patient_id");
        
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    function get_patients(){
        $year = '';
        $visit_type = '';
        $ip_op_number = '';
        $patient_id = '';
        $patient_name = '';
        $phone_number = '';
        
        if($this->input->post('search_year') || $this->input->post('search_visit_type') || $this->input->post('ip_op_number') || $this->input->post('patient_id') || $this->input->post('patient_name') || $this->input->post('phone_number')){
            
        }else{
            return false;
        }
        
        if($this->input->post('year')){
            $year = $this->input->post('year');
            $this->db->where('YEAR(patient_visit.admit_date)', "$year");
        }
        if($this->input->post('visit_type')){
            $visit_type = $this->input->post('visit_type');
            $this->db->where('patient_visit.visit_type', "$visit_type");
        }
        if($this->input->post('ip_op_number')){
            $ip_op_number = $this->input->post('ip_op_number');
            $this->db->where('patient_visit.hosp_file_no', "$ip_op_number");
        }
        if($this->input->post('patient_id')){
            $patient_id = $this->input->post('patient_id');
            $this->db->where('patient.patient_id', "$patient_id");
        }
        if($this->input->post('patient_name')){
            $patient_name = $this->input->post('patient_name');
            $this->db->or_like('patient.first_name',"$patient_name", 'both');
            $this->db->or_like('patient.last_name',"$patient_name", 'both');
        }
        if($this->input->post('phone_number')){
            $phone_number = $this->input->post('phone_number');
            $this->db->where('patient.phone', "$phone_number");
        }
        
        $this->db->select('patient.patient_id, patient.first_name, patient.last_name, patient.phone, patient.blood_group, patient.gender, patient_visit.visit_id, patient_visit.hosp_file_no, patient_visit.provisional_diagnosis, patient_visit.final_diagnosis')
                ->from('patient')
                ->join('patient_visit','patient_visit.patient_id = patient.patient_id','left')
                ->limit('300');
        
        $query = $this->db->get();        
        $result = $query->result();
        
        return $result;
    }
    
    function casesheet_mrd_status(){
        if($this->input->post('from_ip_number') && $this->input->post('to_ip_number')){
            $from_ip_number = $this->input->post('from_ip_number');
            $to_ip_number = $this->input->post('to_ip_number');
            if($from_ip_number >= $to_ip_number){
                $this->db->where('hosp_file_no <=', $from_ip_number); 
                $this->db->where('hosp_file_no >=', $to_ip_number);
            }else{
                $this->db->where('hosp_file_no >=', $from_ip_number); 
                $this->db->where('hosp_file_no <=', $to_ip_number);
            }
        }else{
            return false;
        }
        $this->db->select('patient_visit.outcome_date, patient_visit.visit_id, patient_visit.hosp_file_no, patient_visit.casesheet_at_mrd_date')
                ->from('patient_visit')
                ->where('visit_type','IP');
        
        $query = $this->db->get();        
        $result = $query->result();
        
        return $result;
    }
    
    function add_child(){
        $patient_obg_data = array();
        $post = (array)json_decode($this->security->xss_clean($this->input->raw_input_stream));
        
        if(key_exists('patient_id', $post)){
            $this->party_information['patient_id'] = $post['patient_id'];        
        }
        if(key_exists('conception_type', $post)){
            $this->party_information['conception_type'] = $post['conception_type'];        
        }
        if(key_exists('pregnancy_number', $post)){
            $this->party_information['pregnancy_number'] = $post['pregnancy_number'];        
        }
        if(key_exists('delivered', $post)){
            $this->party_information['delivered'] = $post['delivered'];        
        }
        if(key_exists('lmp_date', $post)){
            $this->party_information['lmp_date'] = $post['lmp_date'];        
        }
        if(key_exists('edd_date', $post)){
            $this->party_information['edd_date'] = $post['edd_date'];        
        }
        if(key_exists('delivery_outcome', $post)){
            $this->party_information['delivery_outcome'] = $post['delivery_outcome'];        
        }
        if(key_exists('booked', $post)){
            $this->party_information['booked'] = $post['booked'];        
        }
        if(key_exists('delivery_mode_id', $post)){
            $this->party_information['delivery_mode_id'] = $post['delivery_mode_id'];        
        }
        if(key_exists('date_of_birth', $post)){
            $this->party_information['date_of_birth'] = $post['date_of_birth'];        
        }
        if(key_exists('gender', $post)){
            $this->party_information['gender'] = $post['gender'];        
        }
        if(key_exists('weight_at_birth', $post)){
            $this->party_information['weight_at_birth'] = $post['weight_at_birth'];        
        }
        if(key_exists('apgar', $post)){
            $this->party_information['apgar'] = $post['apgar'];        
        }
        if(key_exists('nicu_admission', $post)){
            $this->party_information['nicu_admission'] = $post['nicu_admission'];        
        }
        if(key_exists('nicu_admission_reason', $post)){
            $this->party_information['nicu_admission_reason'] = $post['nicu_admission_reason'];        
        }
        if(key_exists('alive', $post)){
            $this->party_information['alive'] = $post['alive'];        
        }if(key_exists('date_of_death', $post)){
            $this->party_information['date_of_death'] = $post['date_of_death'];        
        }
        if(key_exists('cause_of_death', $post)){
            $this->party_information['cause_of_death'] = $post['cause_of_death'];        
        }
        
        $this->db->insert('patient_obstetric_history',$patient_obg_data,false);
	$obstetric_history_id = $this->db->insert_id(); //store the visit_id from the inserted record
        
        return $obstetric_history_id;
    }
    
    function get_obg_history($patient_id){
        
        if($patient_id)
        {
            
        }else{
            return -1;
        }
        
        $this->db->select('*')
            ->from('patient_obstetric_history')
            ->where('patient_id', $patient_id);
        
        $query = $this->db->get();        
        echo $this->db->last_query();
        $result = $query->result();
        
        return $result;
    }
    
}

?>