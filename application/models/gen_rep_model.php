<?php
class Gen_rep_Model extends CI_Model {
    private $queries = array(    //'sbp,dbp,rbs,hb,hb1ac'
        'query_name'=>array(
            'filters'=>array(   // set or false

            ),
            'where'=>array(

            ),
            'join_sequence'=>array(

            ),
            'group_by'=>array(

            ),
            'having'=>array(

            )
        ),
        'sbp'=>array(
            'filters'=>array(   // set or false
                '>='=>array('sbp-patient_visit.sbp')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as sbp',
            'from'=>'patient_visit',
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false
        ),
        'dbp'=>array(
            'filters'=>array(   // set or false
                '>='=>array('dbp-patient_visit.dbp')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as dbp',
            'from'=>'patient_visit',
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false
        ),
        'rbs'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '>='=>array('rbs-patient_visit.blood_sugar')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as rbs',
            'from'=>'patient_visit',
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false
        ),
        'hb'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '<='=>array('hb-patient_visit.hb')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as hb',
            'from'=>'patient_visit',
            'where'=>false,             // test_master.test_name = rbs, 
            'join_sequence'=>false,     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false
        ),
        'hb1ac'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '>='=>array('hb1ac-patient_visit.hb1ac')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as hb',
            'from'=>'patient_visit',
            'where'=>false,             // test_master.test_name = rbs, 
            'join_sequence'=>false,     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false
        ),
        'nsbp'=>array(
            'filters'=>array(   // set or false
                '<'=>array('*sbp-patient_visit.sbp')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as sbp',
            'from'=>'patient_visit',
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false
        ),
        'ndbp'=>array(
            'filters'=>array(   // set or false
                '<'=>array('*dbp-patient_visit.dbp')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as dbp',
            'from'=>'patient_visit',
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false
        ),
        'nrbs'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '<'=>array('*rbs-patient_visit.blood_sugar')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as rbs',
            'from'=>'patient_visit',
            'where'=>false,             // test_master.test_name = rbs, 
            'join_sequence'=>false,     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false
        ),
        'nhb'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '>'=>array('*hb-patient_visit.hb')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as hb',
            'from'=>'patient_visit',
            'where'=>false,             // test_master.test_name = rbs, 
            'join_sequence'=>false,     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false
        ),
        'nhb1ac'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '<'=>array('*hb1ac-patient_visit.hb1ac')
            ),
            'select'=>'COUNT(DISTINCT(patient_id)) as hb',
            'from'=>'patient_visit',
            'where'=>false,             // test_master.test_name = rbs, 
            'join_sequence'=>false,     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false
        ),
        'sbp_detail'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '>='=>array('sbp-patient_visit.sbp')
            ),
            'select'=>"patient.patient_id, patient_visit.hosp_file_no as OP_IP_Number, DATE_FORMAT(patient_visit.admit_date, '%d %b %Y') as date, patient_visit.admit_time as time, patient.gender, CONCAT(patient.first_name,' ', patient.last_name) as name, patient.age_years, CONCAT(patient.father_name,' ', patient.mother_name, ' ', patient.spouse_name) as relative, patient.place, CONCAT(patient.phone, ' ', patient.alt_phone) as phone, department.department, CONCAT(unit.unit_name, '-', area.area_name) as Unit,  GROUP_CONCAT(patient_visit.sbp SEPARATOR ', ') as SBP,GROUP_CONCAT(patient_visit.dbp SEPARATOR ', ') as DBP,GROUP_CONCAT(patient_visit.blood_sugar SEPARATOR ', ') as blood_sugar, GROUP_CONCAT(patient_visit.hb SEPARATOR ', ') as HB,GROUP_CONCAT(patient_visit.hb1ac SEPARATOR ', ') as HB1AC",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'department.department_id=patient_visit.department_id',
                'unit.unit_id=patient_visit.unit',
                'area.area_id=patient_visit.area',
            ),     // patient_visit -> test -> test_master
            'group_by'=>array('patient_id'),
            'having'=>false,
            'limit'=>1000
        ),
        'dbp_detail'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '>='=>array('dbp-patient_visit.dbp')
            ),
            'select'=>"patient.patient_id, patient_visit.hosp_file_no as OP_IP_Number, DATE_FORMAT(patient_visit.admit_date, '%d %b %Y') as date, patient_visit.admit_time as time, patient.gender, CONCAT(patient.first_name,' ', patient.last_name) as name, patient.age_years, CONCAT(patient.father_name,' ', patient.mother_name, ' ', patient.spouse_name) as relative, patient.place, CONCAT(patient.phone, ' ', patient.alt_phone) as phone, department.department, CONCAT(unit.unit_name, '-', area.area_name) as Unit,  GROUP_CONCAT(patient_visit.sbp SEPARATOR ', ') as SBP,GROUP_CONCAT(patient_visit.dbp SEPARATOR ', ') as DBP,GROUP_CONCAT(patient_visit.blood_sugar SEPARATOR ', ') as blood_sugar, GROUP_CONCAT(patient_visit.hb SEPARATOR ', ') as HB,GROUP_CONCAT(patient_visit.hb1ac SEPARATOR ', ') as HB1AC",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'department.department_id=patient_visit.department_id',
                'unit.unit_id=patient_visit.unit',
                'area.area_id=patient_visit.area',
            ),     // patient_visit -> test -> test_master
            'group_by'=>array('patient_id'),
            'having'=>false,
            'limit'=>1000
        ),
        'rbs_detail'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '>='=>array('rbs-patient_visit.blood_sugar')
            ),
            'select'=>"patient.patient_id, patient_visit.hosp_file_no as OP_IP_Number, DATE_FORMAT(patient_visit.admit_date, '%d %b %Y') as date, patient_visit.admit_time as time, patient.gender, CONCAT(patient.first_name,' ', patient.last_name) as name, patient.age_years, CONCAT(patient.father_name,' ', patient.mother_name, ' ', patient.spouse_name) as relative, patient.place, CONCAT(patient.phone, ' ', patient.alt_phone) as phone, department.department, CONCAT(unit.unit_name, '-', area.area_name) as Unit,  GROUP_CONCAT(patient_visit.sbp SEPARATOR ', ') as SBP,GROUP_CONCAT(patient_visit.dbp SEPARATOR ', ') as DBP,GROUP_CONCAT(patient_visit.blood_sugar SEPARATOR ', ') as blood_sugar, GROUP_CONCAT(patient_visit.hb SEPARATOR ', ') as HB,GROUP_CONCAT(patient_visit.hb1ac SEPARATOR ', ') as HB1AC",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'department.department_id=patient_visit.department_id',
                'unit.unit_id=patient_visit.unit',
                'area.area_id=patient_visit.area',
            ),     // patient_visit -> test -> test_master
            'group_by'=>array('patient_id'),
            'having'=>false,
            'limit'=>1000
        ),
        'hb_detail'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '<='=>array('hb-patient_visit.hb')
            ),
            'select'=>"patient.patient_id, patient_visit.hosp_file_no as OP_IP_Number, DATE_FORMAT(patient_visit.admit_date, '%d %b %Y') as date, patient_visit.admit_time as time, patient.gender, CONCAT(patient.first_name,' ', patient.last_name) as name, patient.age_years, CONCAT(patient.father_name,' ', patient.mother_name, ' ', patient.spouse_name) as relative, patient.place, CONCAT(patient.phone, ' ', patient.alt_phone) as phone, department.department, CONCAT(unit.unit_name, '-', area.area_name) as Unit,  GROUP_CONCAT(patient_visit.sbp SEPARATOR ', ') as SBP,GROUP_CONCAT(patient_visit.dbp SEPARATOR ', ') as DBP,GROUP_CONCAT(patient_visit.blood_sugar SEPARATOR ', ') as blood_sugar, GROUP_CONCAT(patient_visit.hb SEPARATOR ', ') as HB,GROUP_CONCAT(patient_visit.hb1ac SEPARATOR ', ') as HB1AC",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'department.department_id=patient_visit.department_id',
                'unit.unit_id=patient_visit.unit',
                'area.area_id=patient_visit.area',
            ),     // patient_visit -> test -> test_master
            'group_by'=>array('patient_id'),
            'having'=>false,
            'limit'=>1000
        ),
        'hb1ac_detail'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '>='=>array('hb1ac-patient_visit.hb1ac')
            ),
            'select'=>"patient.patient_id, patient_visit.hosp_file_no as OP_IP_Number, DATE_FORMAT(patient_visit.admit_date, '%d %b %Y') as date, patient_visit.admit_time as time, patient.gender, CONCAT(patient.first_name,' ', patient.last_name) as name, patient.age_years, CONCAT(patient.father_name,' ', patient.mother_name, ' ', patient.spouse_name) as relative, patient.place, CONCAT(patient.phone, ' ', patient.alt_phone) as phone, department.department, CONCAT(unit.unit_name, '-', area.area_name) as Unit,  GROUP_CONCAT(patient_visit.sbp SEPARATOR ', ') as SBP,GROUP_CONCAT(patient_visit.dbp SEPARATOR ', ') as DBP,GROUP_CONCAT(patient_visit.blood_sugar SEPARATOR ', ') as blood_sugar, GROUP_CONCAT(patient_visit.hb SEPARATOR ', ') as HB,GROUP_CONCAT(patient_visit.hb1ac SEPARATOR ', ') as HB1AC",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'department.department_id=patient_visit.department_id',
                'unit.unit_id=patient_visit.unit',
                'area.area_id=patient_visit.area',
            ),     // patient_visit -> test -> test_master
            'group_by'=>array('patient_id'),
            'having'=>false,
            'limit'=>1000
        ),
        'get_patient'=>array(
            'filters'=>array(   // set or false
                '='=>array('patient.patient_id')
            ),
            'select'=>"patient.*",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>false,
            'group_by'=>false,
            'having'=>false,
            'limit'=>5000,
            'apply_date'=>false
        ),
        'patient_visits_all'=>array(
            'filters'=>array(   // set or false
                '='=>array('patient.patient_id')
            ),
            'select'=>"patient.patient_id, patient.gender, CONCAT(patient.first_name,' ', patient.last_name) as name, CONCAT(patient.phone,' ', patient.alt_phone) as phone, patient.age_years, patient.age_months, patient.age_days, CONCAT(patient.father_name,' ', patient.mother_name, ' ', patient.spouse_name) as parent_spouse, CONCAT(patient.father_name,' ', patient.mother_name, ' ', patient.spouse_name) as relative, patient.place, patient.address, patient_visit.hosp_file_no, patient_visit.admit_date, patient_visit.visit_type, patient_visit.admit_time, patient_visit.outcome_date, patient_visit.outcome_time, patient_visit.outcome, patient_visit.admit_weight, patient_visit.pulse_rate, patient_visit.temperature, patient_visit.respiratory_rate, patient_visit.presenting_complaints, patient_visit.past_history, patient_visit.family_history, patient_visit.clinical_findings, patient_visit.cvs, patient_visit.rs, patient_visit.pa, patient_visit.cns, patient_visit.final_diagnosis, patient_visit.advise, patient_visit.visit_id, CONCAT(staff.first_name, staff.last_name) as doctor_name, staff.designation, department.department, CONCAT(unit.unit_name, area.area_name) as unit_name, patient_visit.sbp, patient_visit.dbp, patient_visit.blood_sugar, patient_visit.hb, patient_visit.hb1ac, patient_visit.visit_id, patient_visit.signed_consultation",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'department.department_id=patient_visit.department_id',
                'unit.unit_id=patient_visit.unit',
                'area.area_id=patient_visit.area',
                'staff.staff_id = patient_visit.signed_consultation'
            ),     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false,
            'limit'=>5000,
            'apply_date'=>false
        ),
        'clinical_notes'=>array(
            'filters'=>array(   // set or false
                '='=>array('patient.patient_id')
            ),
            'select'=>"patient_clinical_notes.note_time, patient_clinical_notes.clinical_note, patient_clinical_notes.visit_id",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'patient_clinical_notes.visit_id=patient_visit.visit_id'
            ),     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false,
            'limit'=>5000,
            'apply_date'=>false
        ),
        'tests_ordered'=>array(
            'filters'=>array(   // set or false
                '='=>array('patient.patient_id')
            ),
            'select'=>"test_order.order_id, test_order.order_date_time, test_order.visit_id, test.test_result as numeric_result, test.test_result_binary as binary_result, test.test_result_text  as text_result, test.test_status, test_master.test_name, specimen_type.specimen_type,test_order.visit_id",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'test_order.visit_id=patient_visit.visit_id',
                'test.order_id = test_order.order_id',
                'test_master.test_master_id = test.test_master_id',
                'test_sample.order_id = test_order.order_id',
                'specimen_type.specimen_type_id = test_sample.specimen_type_id'
            ),     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false,
            'limit'=>5000,
            'apply_date'=>false,
            'join_type'=>''
        ),
        'prescriptions'=>array(
            'filters'=>array(   // set or false
                '='=>array('patient.patient_id')
            ),
            'select'=>"prescription.frequency, prescription.duration, prescription.morning, prescription.afternoon, prescription.evening, prescription.quantity, item.item_name, prescription.visit_id",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'prescription.visit_id=patient_visit.visit_id',
                'item.item_id=prescription.item_id'
            ),     // patient_visit -> test -> test_master
            'group_by'=>false,
            'having'=>false,
            'limit'=>5000,
            'apply_date'=>false
        ),
        'Condition_met_detail'=>array(
            'filters'=>array(           // set or false test.test_result >= post
                '>='=>array('hb1ac-patient_visit.hb1ac'),
                '<='=>array('hb1ac-patient_visit.hb'),
                '>='=>array('hb1ac-patient_visit.sbp'),
                '>='=>array('hb1ac-patient_visit.dbp'),
                '>='=>array('hb1ac-patient_visit.blood_sugar')
            ),
            'select'=>"patient.patient_id, CONCAT(patient.first_name,' ', patient.last_name) as name, patient_visit.admit_date,GROUP_CONCAT(patient_visit.hb1ac SEPARATOR ', ') as hb1ac,GROUP_CONCAT(patient_visit.hb SEPARATOR ', ') as HB,GROUP_CONCAT(patient_visit.sbp SEPARATOR ', ') as SBP,GROUP_CONCAT(patient_visit.dbp SEPARATOR ', ') as DBP,GROUP_CONCAT(patient_visit.blood_sugar SEPARATOR ', ') as blood_sugar",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id'
            ),
            'group_by'=>array('patient_id'),
            'having'=>false,
            'limit'=>1000
        ),
        'vitals_detailed'=>array(
            'filters'=>array(   // set or false
                '>='=>array('sbp-patient_visit.sbp','dbp-patient_visit.dbp','rbs-patient_visit.blood_sugar','hba1c-patient_visit.hb1ac'),
                '<='=>array('hb-patient_visit.hb')
            ),
            'select'=>"patient.patient_id, patient_visit.hosp_file_no as OP_IP_Number, DATE_FORMAT(patient_visit.admit_date, '%d %b %Y') as date, patient_visit.admit_time as time, patient.gender, CONCAT(patient.first_name,' ', patient.last_name) as name, patient.age_years, CONCAT(patient.father_name,' ', patient.mother_name, ' ', patient.spouse_name) as relative, patient.place, CONCAT(patient.phone, ' ', patient.alt_phone) as phone, department.department, CONCAT(unit.unit_name, '-', area.area_name) as Unit,  GROUP_CONCAT(patient_visit.sbp SEPARATOR ', ') as SBP,GROUP_CONCAT(patient_visit.dbp SEPARATOR ', ') as DBP,GROUP_CONCAT(patient_visit.blood_sugar SEPARATOR ', ') as blood_sugar, GROUP_CONCAT(patient_visit.hb SEPARATOR ', ') as HB,GROUP_CONCAT(patient_visit.hb1ac SEPARATOR ', ') as HB1AC",
            'from'=>'patient',
            'where'=>false,
            'join_sequence'=>array(
                'patient_visit.patient_id=patient.patient_id',
                'department.department_id=patient_visit.department_id',
                'unit.unit_id=patient_visit.unit',
                'area.area_id=patient_visit.area',
            ),     // patient_visit -> test -> test_master
            'group_by'=>array('patient_id'),
            'having'=>false,
            'limit'=>5000,
            'apply_date'=>true
        ),
        'patient_id'=>array(
            'filters'=>array(   // set or false
                '='=>array('patient_visit.visit_id')
            ),
            'select'=>"patient.patient_id",
            'from'=>'patient_visit',
            'where'=>false,
            'join_sequence'=>array(
                'patient.patient_id=patient_visit.patient_id'
            ),
            'group_by'=>false,
            'having'=>false,
            'limit'=>1,
            'apply_date'=>false
        )
    );
    
    function __construct() {
        parent::__construct();
    }

    function simple_join($query, $post_data=false) {
        // Failure condition
        if(!array_key_exists($query, $this->queries))
            return false;
        if(!$post_data){
            $post_data = $this->security->xss_clean($_POST);
        }
        //var_dump($post_data);
        // Filters{operator=>array(input_key-table_name.column_name)}
        $filters = $this->queries[$query]['filters'] ? $this->queries[$query]['filters'] : array();
        foreach($filters as $op => $filters) {
            foreach($filters as $filter){
                $temp = explode('-', $filter);      // Filter name to input field name
                $column = '';
                $input = '';
                $mandatory = false;                 // Mandatory filter
                if(sizeof($temp)>1){
                    $input = $temp[0];
                    $column = $temp[1];
                    if(strpos($input, '*', 0) === 0){
                        $mandatory = true;
                        $temp = substr($input, 1);
                        $input = $temp;
                    }
                } else {
                    $temp = explode('.', $filter);
                    $input = $temp[1];
                    $column = $filter;
                }
            
                if(array_key_exists($input, $post_data)) { //EMPTY IS TEMPORARY FIX ONLY
                    $value = $post_data[$input];
        
                    if($value != ''){
                        $value = $post_data[$input];
                        $this->db->where("$column ".$op, "$value");
                        
                //        $this->db->where("$column IS NOT NULL AND $column != '' AND $column!=0");
                    } else if($mandatory){
                      //  return array(0);
                    } else{
                     //   $this->db->where("$column IS NOT NULL AND $column != '' AND $column!=0");
                    }                    
                }
            }
        }

        // query extraction
        $select = $this->queries[$query]['select'] ? $this->queries[$query]['select'] : array();
        $from = $this->queries[$query]['from'] ? $this->queries[$query]['from'] : array();
        $where = $this->queries[$query]['where'] ? $this->queries[$query]['where'] : array();
        $join_sequence = $this->queries[$query]['join_sequence'] ? $this->queries[$query]['join_sequence'] : array();
        $group_by = $this->queries[$query]['group_by'] ? $this->queries[$query]['group_by'] : array();
        $having = $this->queries[$query]['having'] ? $this->queries[$query]['having'] : array();
        $limit = array_key_exists('limit', $this->queries[$query]) ? $this->queries[$query]['limit'] : 1000;
        $apply_date = array_key_exists('apply_date', $this->queries[$query]) ? $this->queries[$query]['apply_date'] : true;
        $join_type = array_key_exists('join_type', $this->queries[$query]) ? $this->queries[$query]['join_type'] : 'left';
        $this->db->select($select, false);
        $this->db->from($from);
        
        // Default where condition // Date
        // Set to today and submit by default
        if($apply_date && array_key_exists('from_date', $post_data) && array_key_exists('to_date', $post_data)){
            if($post_data['from_date']){
                $from_date = date("Y-m-d",strtotime($post_data['from_date']));
                $to_date = date("Y-m-d",strtotime($post_data['to_date']));
                $this->db->where('(patient_visit.admit_date BETWEEN "'.$from_date.'" AND "'.$to_date.'")');
            }
        }
        else if($apply_date){
            $date = date("Y-m-d");
            $this->db->where('(patient_visit.admit_date BETWEEN "'.$date.'" AND "'.$date.'")');
        }
        // Session filters
        if($this->session->userdata('hospital')){
            $hosptial_id = $this->session->userdata('hospital')['hospital_id'];
            $this->db->where('patient_visit.hospital_id', $hosptial_id);
        }
        // Where conditions{string}{(operator_value-table_name.column_name)}
        foreach($where as $op => $columns) {
            foreach($columns as $column){
                $temp = explode('-', $column);
                if($op != ''){
                    $this->db->where("$temp[1] ".$op, "$temp[0]");
                }else {
                    $this->db->where("$column");
                }
                
            }
        }

        // Join conditions{join_from_table_name.column_name, join_to_table_name.column_name}
        foreach($join_sequence as $join) {
            $tables = explode('=', $join);
            $temp = explode('.', $tables[0]);
            $table_one = $temp[0];
            $this->db->join("$table_one", "$join", $join_type);
        }
        // Group by conditions{table_name.column_name, table_name.column_name}{string}
        foreach($group_by as $group) {
            $this->db->group_by("$group");
        }
        // Having conditions{$op=>value-table_name.column_name}
        foreach($having as $op => $column) {
            $value = explode('-', $column);
            $value = $value[0];
            $this->db->having("$column $op $value");
        }
        // Execute query
        $this->db->limit($limit);
        $query = $this->db->get();
    //    echo $this->db->last_query();
        $result = $query->result();    
        return $result;
    }
}