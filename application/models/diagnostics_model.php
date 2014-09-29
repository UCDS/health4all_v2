<?php 
class Diagnostics_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function order_test(){
		$this->db->select('visit_id')->from('patient_visit')
		->where('hosp_file_no',$this->input->post('visit_id'))
		->where('visit_type',$this->input->post('patient_type'))
		->where('YEAR(admit_date)',"YEAR(CURDATE())",false);
		$query=$this->db->get();
		$row=$query->row();
		$visit_id=$row->visit_id;
		$doctor_id=$this->input->post('order_by');
		$test_area_id=$this->input->post('test_area');
		$order_date_time=date("Y-m-d H:i:s",strtotime($this->input->post('order_date')." ".$this->input->post('order_time')));
		$order_status=0;
		$this->db->trans_start();
			$data=array(
				'visit_id'=>$visit_id,
				'doctor_id'=>$doctor_id,
				'test_area_id'=>$test_area_id,
				'order_date_time'=>$order_date_time,
				'order_status'=>$order_status
			);
			$this->db->insert('test_order',$data);
			$order_id=$this->db->insert_id();
			$sample_code=$this->input->post('sample_id');
			$sample_date_time = date("Y-m-d H:i:s");
			$specimen_type_id=$this->input->post('specimen_type');
			$sample_container_type=$this->input->post('sample_container');
			$sample_status_id=1;
			$data=array(
				'sample_code'=>$sample_code,
				'sample_date_time'=>$sample_date_time,
				'order_id'=>$order_id,
				'specimen_type_id'=>$specimen_type_id,
				'sample_container_type'=>$sample_container_type,
				'sample_status_id'=>$sample_status_id
			);
			$this->db->insert('test_sample',$data);
			$sample_id=$this->db->insert_id();
			$data=array();
			foreach($this->input->post('test_master') as $test_master){
				$data[]=array(
					'order_id'=>$order_id,
					'sample_id'=>$sample_id,
					'test_master_id'=>$test_master,
				);
			}
			$this->db->insert_batch('test',$data);
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
				$this->db->trans_rollback();
				return false;
		}
		else return true;				
	}
	
	function get_tests_ordered(){
		$test_area=$this->input->post('test_area');
		$this->db->select('test_id,test_order.order_id,test_sample.sample_id,test_method,test_name,department,patient.first_name, patient.last_name,
							staff.first_name staff_name,hosp_file_no,sample_code,specimen_type,sample_container_type,test_status')
		->from('test_order')->join('test','test_order.order_id=test.order_id')->join('test_sample','test_order.order_id=test_sample.order_id')
		->join('test_master','test.test_master_id=test_master.test_master_id')
		->join('test_method','test_master.test_method_id=test_method.test_method_id')
		->join('staff','test_order.doctor_id=staff.staff_id','left')
		->join('patient_visit','test_order.visit_id=patient_visit.visit_id')
		->join('patient','patient_visit.patient_id=patient.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('specimen_type','test_sample.specimen_type_id=specimen_type.specimen_type_id');
		$query=$this->db->get();
		return $query->result();
	}
	
	function get_order(){
		$order_id=$this->input->post('order_id');
		$this->db->select('test_id,test_order.order_id,test_sample.sample_id,test_method,
		test_name,department,patient.first_name, patient.last_name,patient_visit.visit_type,
		staff.first_name staff_name,order_date_time,hosp_file_no,sample_code,specimen_type,sample_container_type,
		binary_result,numeric_result,text_result,binary_positive,binary_negative,lab_unit.unit,test_status,
		test_result_binary,test_result,test_result_text')
		->from('test_order')->join('test','test_order.order_id=test.order_id')->join('test_sample','test_order.order_id=test_sample.order_id')
		->join('test_master','test.test_master_id=test_master.test_master_id')
		->join('lab_unit','test_master.numeric_result_unit=lab_unit.lab_unit_id','left')
		->join('test_method','test_master.test_method_id=test_method.test_method_id')
		->join('staff','test_order.doctor_id=staff.staff_id','left')
		->join('patient_visit','test_order.visit_id=patient_visit.visit_id')
		->join('patient','patient_visit.patient_id=patient.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('specimen_type','test_sample.specimen_type_id=specimen_type.specimen_type_id');
		$this->db->where('test_order.order_id',$order_id);
		$query=$this->db->get();
		return $query->result();
	}		
	
	function upload_test_results(){
		$tests=$this->input->post('test');
		$data=array();
		foreach($tests as $test){
			if($this->input->post('binary_result_'.$test) || $this->input->post('numeric_result_'.$test) || $this->input->post('text_result_'.$test)){
				$binary_result=$this->input->post('binary_result_'.$test);
				$numeric_result=$this->input->post('numeric_result_'.$test);
				$text_result=$this->input->post('text_result_'.$test);
				$data[]=array(
					'test_id'=>$test,
					'test_result_binary'=>$binary_result,
					'test_result'=>$numeric_result,
					'test_result_text'=>$text_result,
					'test_date_time'=>date("Y-m-d H:i:s"),
					'test_status'=>1
				);
			}
		}
		$this->db->trans_start();
		$this->db->update_batch('test',$data,'test_id');
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					return false;
		}
		else return true;			
	}
	
	function search_patients(){
		$this->db->select('first_name, last_name, age_years, age_months, age_days, hosp_file_no')
		->from('patient')
		->join('patient_visit','patient.patient_id = patient_visit.patient_id')
		->like('hosp_file_no',$this->input->post('q'),'after');
		$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result_array();
		}
		else return false;
	}
}
?>
