<?php 
class Reports_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function get_op_summary(){
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=$this->input->post('from_date'):$from_date=$this->input->post('to_date');
			$to_date=$from_date;
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}
		$this->db->select("          department 'department',
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'op',
		SUM(CASE WHEN gender = 'F'  THEN 1 ELSE 0 END) 'op_female',
		SUM(CASE WHEN gender = 'M'  THEN 1 ELSE 0 END) 'op_male',	
		SUM(CASE WHEN age_years <= 14 THEN 1 ELSE 0 END) 'op_child',
		  SUM(CASE WHEN gender = 'F' AND age_years <= 14 THEN 1 ELSE 0 END) 'op_fchild',
		  SUM(CASE WHEN gender = 'M' AND age_years <= 14 THEN 1 ELSE 0 END) 'op_mchild',
		  SUM(CASE WHEN age_years > 14 AND age_years <= 30 THEN 1 ELSE 0 END) 'op_14to30',
		  SUM(CASE WHEN gender = 'F' AND age_years > 14 AND age_years <= 30 THEN 1 ELSE 0 END) 'op_f14to30',
		  SUM(CASE WHEN gender = 'M' AND age_years > 14 AND age_years <= 30 THEN 1 ELSE 0 END) 'op_m14to30', 
		  SUM(CASE WHEN age_years > 30 AND age_years <= 50 THEN 1 ELSE 0 END) 'op_30to50',
		SUM(CASE WHEN gender = 'F' AND age_years > 30 AND age_years <= 50 THEN 1 ELSE 0 END) 'op_f30to50',
		  SUM(CASE WHEN gender = 'M' AND age_years > 30 AND age_years <= 50 THEN 1 ELSE 0 END) 'op_m30to50', 
		SUM(CASE WHEN age_years > 50 THEN 1 ELSE 0 END) 'op_50plus',
		SUM(CASE WHEN gender = 'F' AND age_years > 50 THEN 1 ELSE 0 END) 'op_f50plus',
		  SUM(CASE WHEN gender = 'M' AND age_years > 50 THEN 1 ELSE 0 END) 'op_m50plus'");
		 $this->db->from('patient_visit')->join('patient','patient_visit.patient_id=patient.patient_id')
		 ->join('department','patient_visit.department_id=department.department_id')
		 ->where('visit_type','OP')
		 ->where("(admit_date BETWEEN '$from_date' AND '$to_date')")
		 ->group_by('department');
		  
		$resource=$this->db->get();
		return $resource->result();
	}
	function get_ip_summary(){
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=$this->input->post('from_date'):$from_date=$this->input->post('to_date');
			$to_date=$from_date;
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}
		$this->db->select("department.department_id, department 'department',
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'ip',
		SUM(CASE WHEN gender = 'F'  THEN 1 ELSE 0 END) 'ip_female',
		SUM(CASE WHEN gender = 'M'  THEN 1 ELSE 0 END) 'ip_male',	
		SUM(CASE WHEN age_years <= 14 THEN 1 ELSE 0 END) 'ip_child',
		  SUM(CASE WHEN gender = 'F' AND age_years <= 14 THEN 1 ELSE 0 END) 'ip_fchild',
		  SUM(CASE WHEN gender = 'M' AND age_years <= 14 THEN 1 ELSE 0 END) 'ip_mchild',
		  SUM(CASE WHEN age_years > 14 AND age_years <= 30 THEN 1 ELSE 0 END) 'ip_14to30',
		  SUM(CASE WHEN gender = 'F' AND age_years > 14 AND age_years <= 30 THEN 1 ELSE 0 END) 'ip_f14to30',
		  SUM(CASE WHEN gender = 'M' AND age_years > 14 AND age_years <= 30 THEN 1 ELSE 0 END) 'ip_m14to30', 
		  SUM(CASE WHEN age_years > 30 AND age_years <= 50 THEN 1 ELSE 0 END) 'ip_30to50',
		SUM(CASE WHEN gender = 'F' AND age_years > 30 AND age_years <= 50 THEN 1 ELSE 0 END) 'ip_f30to50',
		  SUM(CASE WHEN gender = 'M' AND age_years > 30 AND age_years <= 50 THEN 1 ELSE 0 END) 'ip_m30to50', 
		SUM(CASE WHEN age_years > 50 THEN 1 ELSE 0 END) 'ip_50plus',
		SUM(CASE WHEN gender = 'F' AND age_years > 50 THEN 1 ELSE 0 END) 'ip_f50plus',
		  SUM(CASE WHEN gender = 'M' AND age_years > 50 THEN 1 ELSE 0 END) 'ip_m50plus'");
		 $this->db->from('patient_visit')->join('patient','patient_visit.patient_id=patient.patient_id')
		 ->join('department','patient_visit.department_id=department.department_id')
		 ->where('visit_type','IP')
		 ->where("(admit_date BETWEEN '$from_date' AND '$to_date')")
		 ->group_by('department');
		  
		$resource=$this->db->get();
		return $resource->result();
	}
	function get_order_summary(){
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=$this->input->post('from_date'):$from_date=$this->input->post('to_date');
			$to_date=$from_date;
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}
		$this->db->select("DATE(order_date_time) date,test_area,test_method,COUNT(test_id) count,test_area.test_area_id,test_method.test_method_id,test_master.test_master_id,test_master.test_name")
		->from('test')
		->join('test_order','test.order_id = test_order.order_id')
		->join('test_area','test_order.test_area_id = test_area.test_area_id')
		->join('test_master','test.test_master_id = test_master.test_master_id')
		->join('test_method','test_master.test_method_id = test_method.test_method_id')
		->where("(DATE(order_date_time) BETWEEN '$from_date' AND '$to_date')")
		->group_by('test_method.test_method,test_master.test_master_id');
		$resource=$this->db->get();
		return $resource->result();
	}
		
	function get_op_detail(){
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=$this->input->post('from_date'):$from_date=$this->input->post('to_date');
			$to_date=$from_date;
		}
		else{
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}

		$this->db->select("hosp_file_no,visit_id,CONCAT(IF(first_name=NULL,'',first_name),' ',IF(last_name=NULL,'',last_name)) name,gender,IF(gender='F' AND father_name=NULL,spouse_name,father_name) parent_spouse,age_years,place,phone,department",false);
		 $this->db->from('patient_visit')->join('patient','patient_visit.patient_id=patient.patient_id')
		 ->join('department','patient_visit.department_id=department.department_id')
		 ->where('visit_type','OP')
		 ->where("(admit_date BETWEEN '$from_date' AND '$to_date')");		  
		$resource=$this->db->get();
		return $resource->result();
	}
	function get_ip_detail($department,$gender,$from_age,$to_age,$from_date,$to_date){
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=$this->input->post('from_date'):$from_date=$this->input->post('to_date');
			$to_date=$from_date;
		}
		else if($from_date=='0' && $to_date=='0'){
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}
		if($department!='-1'){
			$this->db->where('department.department_id',$department);
		}
		if($gender!='0'){
			$this->db->where('gender',$gender);
		}
		if($from_age!='0' && $to_age!='0'){
			$this->db->where('age_years>=',$from_age,false);
			$this->db->where('age_years<=',$to_age,false);
		}
		if($from_age!='0' && $to_age=='0'){
			$this->db->where('age_years<=',$from_age,false);
		}
		if($from_age=='0' && $to_age!='0'){
			$this->db->where('age_years>=',$to_age,false);
		}
		$this->db->select("hosp_file_no,visit_id,CONCAT(IF(first_name=NULL,'',first_name),' ',IF(last_name=NULL,'',last_name)) name,gender,IF(gender='F' AND father_name=NULL,spouse_name,father_name) parent_spouse,age_years,place,phone,department",false);
		 $this->db->from('patient_visit')->join('patient','patient_visit.patient_id=patient.patient_id')
		 ->join('department','patient_visit.department_id=department.department_id')
		 ->where('visit_type','IP')
		 ->where("(admit_date BETWEEN '$from_date' AND '$to_date')");		  
		$resource=$this->db->get();
		return $resource->result();
	}
	
	function get_order_detail($test_master,$test_area,$test_method,$from_date,$to_date){
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=$this->input->post('from_date'):$from_date=$this->input->post('to_date');
			$to_date=$from_date;
		}
		else if($from_date=='0' && $to_date=='0'){
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		}
		if($test_area!='-1'){
			$this->db->where('test_area.test_area_id',$test_area);
		}
		if($test_method!='-1'){
			$this->db->where('test_method.test_method_id',$test_method);
		}
		if($test_master!='-1'){
			$this->db->where('test_master.test_master_id',$test_master);
		}
		$this->db->select('test_id,test_order.order_id,test_sample.sample_id,test_method,test_name,department,patient.first_name, patient.last_name,
							staff.first_name staff_name,hosp_file_no,sample_code,specimen_type,sample_container_type,test_status')
		->from('test_order')
		->join('test','test_order.order_id=test.order_id')
		->join('test_sample','test_order.order_id=test_sample.order_id')
		->join('test_master','test.test_master_id=test_master.test_master_id')
		->join('test_method','test_master.test_method_id=test_method.test_method_id')
		->join('test_area','test_master.test_area_id=test_area.test_area_id')
		->join('staff','test_order.doctor_id=staff.staff_id','left')
		->join('patient_visit','test_order.visit_id=patient_visit.visit_id')
		->join('patient','patient_visit.patient_id=patient.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('specimen_type','test_sample.specimen_type_id=specimen_type.specimen_type_id')
		 ->where("(DATE(order_date_time) BETWEEN '$from_date' AND '$to_date')");		  
		$query=$this->db->get();
		return $query->result();
	}
	
	function get_equipment_summary(){
		$this->db->select("equipment.equipment_type_id,equipment_type,equipment.department_id,department,equipment.area_id,area_name,equipment.unit_id,unit_name,
		SUM(CASE WHEN equipment_status=1 THEN 1 ELSE 0 END) 'working',
		SUM(CASE WHEN equipment_status=0 THEN 1 ELSE 0 END) 'not_working',
		SUM(CASE WHEN 1 THEN 1 ELSE 0 END) 'total',
		")
		->from("equipment")
		->join("equipment_type","equipment.equipment_type_id=equipment_type.equipment_type_id")
		->join("department","equipment.department_id=department.department_id")
		->join("unit","equipment.unit_id=unit.unit_id","left")
		->join("area","equipment.area_id=area.area_id","left")
		->group_by("equipment_type,department,equipment.area_id,equipment.unit_id")
		->order_by("equipment_type");
		$query=$this->db->get();
		return $query->result();
		
	}
}
?>
