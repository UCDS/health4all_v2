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
        if($this->input->post('patient_first_name')){
            $first_name=$this->input->post('patient_first_name');         
        }
        if($this->input->post('patient_last_name')){ 
            $last_name=$this->input->post('patient_last_name'); 
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
    
    function get_patient_visits_info(){
        $filter = file_get_contents('php://input');
        $filter = (array)json_decode($this->security->xss_clean($filter));
        
        $patient_id = '';
        if(key_exists('patient_id', $filter)){
            $patient_id = $filter['patient_id'];        
        }else{
            return false;
        }
        
        $this->db->select('patient.patient_id, patient.first_name, patient.last_name, patient.phone, patient.blood_group, '
            . 'patient.gender, patient_visit.*, department.department, unit.unit_name, staff.first_name, staff.last_name')
                ->from('patient')
                ->join('patient_visit', 'patient_visit.patient_id = patient.patient_id', 'left')
                ->join('department', 'department.department_id = patient_visit.department_id', 'left')
                ->join('unit', 'unit.unit_id = patient_visit.unit','left')
                ->join('staff', 'patient_visit.doctor_id = staff.staff_id', 'left')
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
        $patient_obg_data = file_get_contents('php://input');
        $patient_obg_data = (array)json_decode($this->security->xss_clean($patient_obg_data));
        $patient_obg_data_insert = [];
        if(key_exists('patient_id', $patient_obg_data)){
            $patient_obg_data_insert['patient_id'] = $patient_obg_data['patient_id'];        
        }
        if(key_exists('conception_type', $patient_obg_data)){
            $patient_obg_data_insert['conception_type'] = $patient_obg_data['conception_type'];        
        }
        if(key_exists('pregnancy_number', $patient_obg_data)){
            $patient_obg_data_insert['pregnancy_number'] = $patient_obg_data['pregnancy_number'];        
        }
        if(key_exists('delivered', $patient_obg_data)){
            $patient_obg_data_insert['delivered'] = $patient_obg_data['delivered'];        
        }
        if(key_exists('lmp_date', $patient_obg_data)){
            $patient_obg_data_insert['lmp_date'] = $patient_obg_data['lmp_date'];        
        }
        if(key_exists('edd_date', $patient_obg_data)){
            $patient_obg_data_insert['edd_date'] = $patient_obg_data['edd_date'];        
        }
        if(key_exists('delivery_outcome', $patient_obg_data)){
            $patient_obg_data_insert['delivery_outcome'] = $patient_obg_data['delivery_outcome'];        
        }
        if(key_exists('booked', $patient_obg_data)){
            $patient_obg_data_insert['booked'] = $patient_obg_data['booked'];        
        }
        if(key_exists('delivery_mode_id', $patient_obg_data)){
            $patient_obg_data_insert['delivery_mode_id'] = $patient_obg_data['delivery_mode_id'];        
        }
        if(key_exists('date_of_birth', $patient_obg_data)){
            $patient_obg_data_insert['date_of_birth'] = $patient_obg_data['date_of_birth'];        
        }
        if(key_exists('gender', $patient_obg_data)){
            $patient_obg_data_insert['gender'] = $patient_obg_data['gender'];        
        }
        if(key_exists('weight_at_birth', $patient_obg_data)){
            $patient_obg_data_insert['weight_at_birth'] = $patient_obg_data['weight_at_birth'];        
        }
        if(key_exists('apgar', $patient_obg_data)){
            $patient_obg_data_insert['apgar'] = $patient_obg_data['apgar'];        
        }
        if(key_exists('nicu_admission', $patient_obg_data)){
            $patient_obg_data_insert['nicu_admission'] = $patient_obg_data['nicu_admission'];        
        }
        if(key_exists('nicu_admission_reason', $patient_obg_data)){
            $patient_obg_data_insert['nicu_admission_reason'] = $patient_obg_data['nicu_admission_reason'];        
        }
        if(key_exists('alive', $patient_obg_data)){
            $patient_obg_data_insert['alive'] = $patient_obg_data['alive'];        
        }if(key_exists('date_of_death', $patient_obg_data)){
            $patient_obg_data_insert['date_of_death'] = $patient_obg_data['date_of_death'];        
        }
        if(key_exists('cause_of_death', $patient_obg_data)){
            $patient_obg_data_insert['cause_of_death'] = $patient_obg_data['cause_of_death'];        
        }
        
        $this->db->insert('patient_obstetric_history',$patient_obg_data_insert);
	$obstetric_history_id = $this->db->insert_id(); //store the visit_id from the inserted record
        
        $this->db->select('*')
            ->from('patient_obstetric_history')
            ->where('obstetric_history_id', $obstetric_history_id);
        $query = $this->db->get();
        $inserted_record = $query->result();
        
        return $inserted_record;
    }
    
    function get_patient_obg_info(){
        $filters = file_get_contents('php://input');
        $filters = (array)json_decode($this->security->xss_clean($filters));
        
        $result = array();
        
        if(key_exists('patient_id', $filters)){
            $this->db->where('patient_id', $filters['patient_id']);
        }else{
            return $result;
        }
        
        $this->db->select('*')
            ->from('patient_obstetric_history');
        $query = $this->db->get();
       
        $result = $query->result();
        
        return $result;
    }
    
    function get_patients_summary(){
        $filters = file_get_contents('php://input');
        $filters = (array)json_decode($this->security->xss_clean($filters));
        $search_year = '';
        $visit_type = '';
        $ip_op_number = '';
        $patient_name = '';
        $patient_phone_number = '';
        
        if(key_exists('search_year', $filters)){
            $this->db->where('YEAR(insert_datetime)', $filters['search_year']);
        }else{
            $from_date = date("Y-m-d", strtotime('-1 day'));        // Yesterday to today
            $to_date = date("Y-m-d");
        }
        
        if(key_exists('visit_type', $filters)){
            $this->db->where('patient_visit.visit_type', $filters['visit_type']);
        }
        
        if(key_exists('ip_op_number', $filters)){
            $this->db->where('patient_visit.hosp_file_no', $filters['ip_op_number']);
        }
        
        if(key_exists('patient_name', $filters)){
            $this->db->or_like('LOWER(first_name)', strtolower($filters['patient_name']));
            $this->db->or_like('LOWER(last_name)', strtolower($filters['patient_name']));
            $this->db->or_like('LOWER(middle_name)', strtolower($filters['patient_name']));
        }
        
        if(key_exists('patient_phone_number', $filters)){
            $this->db->or_like('LOWER(phone)', strtolower($filters['patient_phone_number']));
            $this->db->or_like('LOWER(alt_phone)', strtolower($filters['patient_phone_number']));
        }
        
        $this->db->select('patient.patient_id, patient.first_name, patient.last_name, patient.phone, '
            . 'patient.blood_group, patient.gender, patient_visit.visit_id, patient_visit.hosp_file_no, '
            . 'patient_visit.provisional_diagnosis, patient_visit.final_diagnosis')
            ->from('patient')
            ->join('patient_visit','patient_visit.patient_id = patient.patient_id','left')
            ->limit('1000');
        
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }
    
    function get_patient_personal_info(){
        $filters = file_get_contents('php://input');
        $filters = (array)json_decode($this->security->xss_clean($filters));
        $result = array();
        
        if(key_exists('patient_id', $filters)){
            $this->db->where('patient_id', $filters['patient_id']);
        }else{
            return $result;
        }
        
        $this->db->select('*')
            ->from('patient');
        
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }
    
    function get_patient_mlc_info(){
        $filters = file_get_contents('php://input');
        $filters = (array)json_decode($this->security->xss_clean($filters));
        $result = array();
        
        if(key_exists('patient_id', $filters)){
            $this->db->where('patient.patient_id', $filters['patient_id']);
        }else{
            return $result;
        }
        
        $this->db->select('patient.patient_id, patient_visit.visit_type, patient_visit.hosp_file_no,'
            . 'patient_visit.admit_date, patient_visit.admit_time, mlc.*')
            ->from('patient')
            ->join('patient_visit', 'patient.patient_id = patient_visit.patient_id')
            ->join('mlc', 'patient_visit.visit_id = mlc.visit_id');
        
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }
    
    function get_patient_prescriptions(){
        $filters = file_get_contents('php://input');
        $filters = (array)json_decode($this->security->xss_clean($filters));
        $result = array();
        
        if(key_exists('patient_id', $filters)){
            $this->db->where('patient.patient_id', $filters['patient_id']);
        }else{
            return $result;
        }
        
        $this->db->select('patient.patient_id, patient_visit.visit_type, patient_visit.hosp_file_no,'
            . 'patient_visit.admit_date, patient_visit.admit_time, prescription.*')
            ->from('patient')
            ->join('patient_visit', 'patient.patient_id = patient_visit.patient_id')
            ->join('prescription', 'prescription.visit_id = patient_visit.visit_id');
        
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }
    
    function get_patient_diagnostics(){
        $filters = file_get_contents('php://input');
        $filters = (array)json_decode($this->security->xss_clean($filters));
        $result = array();
        
        if(key_exists('patient_id', $filters)){
            $this->db->where('patient.patient_id', $filters['patient_id']);
        }else{
            return $result;
        }
        
        $this->db->select('patient.patient_id, patient_visit.visit_type, patient_visit.hosp_file_no,'
            . 'patient_visit.admit_date, patient_visit.admit_time, test.*')
            ->from('patient')
            ->join('patient_visit', 'patient.patient_id = patient_visit.patient_id')
            ->join('test_order', 'test_order.visit_id = patient_visit.visit_id')
            ->join('test', 'test.order_id = test_order.order_id')
            ->join('test_master', 'test_master.test_master_id = test.test_master_id');
        
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }
    
    function get_patient_procedures_info(){
        $filters = file_get_contents('php://input');
        $filters = (array)json_decode($this->security->xss_clean($filters));
        $result = array();
        
        if(key_exists('patient_id', $filters)){
            $this->db->where('patient.patient_id', $filters['patient_id']);
        }else{
            return $result;
        }
        
        $this->db->select('patient.patient_id, patient_visit.visit_type, patient_visit.hosp_file_no,'
            . 'patient_visit.admit_date, patient_visit.admit_time, procedure_plan.*, procedure.procedure_name')
            ->from('patient')
            ->join('patient_visit', 'patient.patient_id = patient_visit.patient_id')
            ->join('procedure_plan', 'procedure_plan.visit_id = patient_visit.visit_id')
            ->join('procedure', 'procedure.procedure_id = procedure_plan.procedure_id')
            ->join('procedure_type', 'procedure.procedure_type_id = procedure_plan.procedure_type_id');
        
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }
}

?>