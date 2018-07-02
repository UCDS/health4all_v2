<?php
class Equipment_Model extends CI_Model {
	

	function get_data($type,$equipment_type=0,$department=0,$area=0,$unit=0,$status=-1,$hospitals=0){
		
	if($type=="equipment_types"){
			$this->db->select("equipment_type_id,equipment_type")->from("equipment_type");
			$this->db->order_by("equipment_type");
		}
		
		$hospital=$this->session->userdata('hospital');
		if($type=="equipment_type"){
				if($this->input->post('select')){
							$equipment_type_id=$this->input->post('equipment_type_id');

							$this->db->where('equipment_type_id',$equipment_type_id);
			}
		$this->db->select("equipment_type_id,equipment_type,equipment_category.category_id,category_name")->from("equipment_type")
		->join("equipment_category","equipment_type.category_id=equipment_category.category_id",'left' )
		->order_by("equipment_type");
		}
		
		else if($type=="hospital"){
			$this->db->select("hospital_id,hospital")->from("hospital");
		}
		else if($type=="department"){
		 $this->db->where('hospital_id',$hospital['hospital_id']);
		$this->db->select("department_id,hospital_id,department")->from("department")
		 ->order_by('department');
		}
		else if($type=="count_service"){
		 $this->db->select("equipment.equipment_id,equipment.equipment_type_id,equipment.department_id,contact_person.contact_person_id,vendor.vendor_id,request_id,equipment_type,call_date,call_time,call_information_type,call_information,service_person_remarks,service_date,service_time,problem_status,working_status,vendor_name,contact_person_first_name,contact_person_last_name,
		 working_status,request_id ,COUNT(*) as service_count,COUNT(working_status) as working_count, ")
		 ->from("service_record")
		 ->join("equipment","service_record.equipment_id=equipment.equipment_id")
		->join("vendor","service_record.vendor_id=vendor.vendor_id",'left')
		->join("contact_person","service_record.contact_person_id=contact_person.contact_person_id",'left')
		->join("equipment_type","equipment.equipment_type_id=equipment_type.equipment_type_id")
		->join("department","equipment.department_id=department.department_id" )
		 ->group_by('working_status')
		->group_by('equipment_id'); 
		$query=$this->db->get();
		return $query->result();
		 
		}
		
		else if($type=="count_working_status"){
		 $this->db->select("equipment.equipment_id,equipment.equipment_type_id,equipment.department_id,contact_person.contact_person_id,vendor.vendor_id,request_id,equipment_type,call_date,call_time,call_information_type,call_information,service_person_remarks,service_date,service_time,problem_status,working_status,vendor_name,contact_person_first_name,contact_person_last_name, working_status, request_id ,COUNT(*) as count,COUNT(working_status) as working_count, ")
		 ->from("service_record") 
		 ->join("equipment","service_record.equipment_id=equipment.equipment_id")
		->join("vendor","service_record.vendor_id=vendor.vendor_id",'left')
		->join("contact_person","service_record.contact_person_id=contact_person.contact_person_id",'left')
		->join("equipment_type","equipment.equipment_type_id=equipment_type.equipment_type_id")
		->join("department","equipment.department_id=department.department_id" )
	      ->group_by('working_status')
		  ->group_by('equipment_id'); 
		  $query=$this->db->get();
		return $query->result();
		
		
		}
		
		
		else if($type=="area"){
			if($hospitals!=0){
				$hosp_id=array();
				foreach($hospitals as $hospital){
					$hosp_id[]=$hospital->hospital_id;
				}
				$this->db->where_in('hospital_id',$hosp_id);
			}
			$this->db->select("area_id,area_name,area.department_id,hospital_id")->from("area")
			->join('department','area.department_id=department.department_id','left');
		}
		else if($type=="unit"){
			$this->db->select("unit_id,unit_name,department_id")->from("unit");
		}
			elseif($type=="equipment_filter")
		{
			
			 if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("d-m-Y",strtotime($this->input->post('from_date')));
			$to_date=date("d-m-Y",strtotime($this->input->post('to_date')));
			
		}
		
		else {
			
			$from_date=date("Y-m-d");
			$to_date=$from_date;
		} 
		if($this->input->post('department')){
			$this->db->where('equipment.department_id',$this->input->post('department'));
		}
		if($this->input->post('unit')){
			$this->db->where('equipment.unit_id',$this->input->post('unit'));
		}
		if($this->input->post('area')){
			$this->db->where('equipment.area_id',$this->input->post('area'));
		}
		if($this->input->post('equipment_status')!=NULL){
			$this->db->where('equipment.equipment_status',$this->input->post('equipment_status'));
		}
		if($this->input->post('purchase_Status')){
			$this->db->where('equipment.equipment_status_id',$this->input->post('purchase_Status'));
		}
		if($this->input->post('location')){
			$this->db->where('equipment.equipment_location_id',$this->input->post('location'));
		}
		if($this->input->post('equipment_category')){
			$this->db->where('equipment.category_id',$this->input->post('equipment_category'));
		}
		if($this->input->post('equipment_type')){
			$this->db->where('equipment.equipment_type_id',$this->input->post('equipment_type'));
		}
		$this->db->select("equipment.equipment_type_id,equipment.equipment_status_id,equipment_purchase_status.equipment_status_id,equipment.category_id,equipment.contributed_by,equipment.equipment_location_id,status_name,equipment_type,vendor_name,voucher_no,purchase_order_date,accessories,journal_type,contributed_by,equipment_location_id,category_name,hospital,equipment.department_id,department,equipment.area_id,area_name,equipment.unit_id,unit_name,equipment_status,equipment_id,make,model,serial_number,asset_number,procured_by,cost,supply_date,warranty_start_date,warranty_end_date,service_engineer,service_engineer_contact,department
		")
		->from("equipment")
		->join("equipment_type","equipment.equipment_type_id=equipment_type.equipment_type_id",'left')
		->join("department","equipment.department_id=department.department_id")
		->join("unit","equipment.unit_id=unit.unit_id")
		->join("area","equipment.area_id=area.area_id")
		->join("equipment_purchase_status","equipment.equipment_status_id=equipment_purchase_status.equipment_status_id")
		->join("equipment_category","equipment.category_id=equipment_category.category_id")
		->join("hospital","equipment.equipment_location_id=hospital.hospital_id",'left')
		->join("vendor","equipment.contributed_by=vendor.vendor_id")
		->where("(supply_date BETWEEN '$from_date' AND '$to_date')")
		->where("(purchase_order_date BETWEEN '$from_date' AND '$to_date')")
		->order_by("equipment_type");
		$query=$this->db->get();
		return $query->result();
		
		}
		//filter type is used to join all the tables and 
		elseif($type=="filter")
		{
			
		
		if($this->input->post('department')){
			$this->db->where('equipment.department_id',$this->input->post('department'));
		}
		if($this->input->post('unit')){
			$this->db->where('equipment.unit_id',$this->input->post('unit'));
		}
		if($this->input->post('area')){
			$this->db->where('equipment.area_id',$this->input->post('area'));
		}
		if($this->input->post('equipment_status')!=NULL){
			$this->db->where('equipment.equipment_status',$this->input->post('equipment_status'));
		}
		if($this->input->post('purchase_Status')){
			$this->db->where('equipment.equipment_status_id',$this->input->post('purchase_Status'));
		}
		if($this->input->post('location')){
			$this->db->where('equipment.equipment_location_id',$this->input->post('location'));
		}
		if($this->input->post('equipment_category')){
			$this->db->where('equipment.category_id',$this->input->post('equipment_category'));
		}
		if($this->input->post('equipment_type')){
			$this->db->where('equipment.equipment_type_id',$this->input->post('equipment_type'));
		}
		$this->db->select("equipment.equipment_type_id,equipment.equipment_status_id,equipment_purchase_status.equipment_status_id,equipment.category_id,equipment.contributed_by,equipment.equipment_location_id,status_name,equipment_type,vendor_name,voucher_no,purchase_order_date,accessories,journal_type,contributed_by,equipment_location_id,category_name,hospital,equipment.department_id,department,equipment.area_id,area_name,equipment.unit_id,unit_name,equipment_status,equipment_id,make,model,serial_number,asset_number,procured_by,cost,supply_date,warranty_start_date,warranty_end_date,service_engineer,service_engineer_contact,department
		")
		->from("equipment")
		->join("equipment_type","equipment.equipment_type_id=equipment_type.equipment_type_id",'left')
		->join("department","equipment.department_id=department.department_id")
		->join("unit","equipment.unit_id=unit.unit_id")
		->join("area","equipment.area_id=area.area_id")
		->join("equipment_purchase_status","equipment.equipment_status_id=equipment_purchase_status.equipment_status_id")
		->join("equipment_category","equipment.category_id=equipment_category.category_id")
		->join("hospital","equipment.equipment_location_id=hospital.hospital_id",'left')
		->join("vendor","equipment.contributed_by=vendor.vendor_id")
		->order_by("equipment_type");
		$query=$this->db->get();
		return $query->result();
		
		}
			elseif($type=="service_filter")
		{
			if($this->input->post('equipment_id')){
				$this->db->where('service_record.equipment_id',$this->input->post('equipment_id'));
				$this->db->where('working_status',$this->input->post('working_status'));
			}
				if($this->input->post('department')){
			$this->db->where('equipment.department_id',$this->input->post('department'));
				
		}
		if($this->input->post('equipment_type')){
			$this->db->where('equipment.equipment_type_id',$this->input->post('equipment_type'));
		}
		if($this->input->post('working_status')!=NULL){
			$this->db->where('service_record.working_status',$this->input->post('working_status'));
		}
		$this->db->select("equipment.equipment_id,equipment.equipment_type_id,equipment.department_id,contact_person.contact_person_id,vendor.vendor_id,request_id,equipment_type,call_date,call_time,call_information_type,call_information,service_person_remarks,service_date,service_time,problem_status,working_status,vendor_name,contact_person_first_name,contact_person_last_name
		")
		->from("service_record")
		->join("equipment","service_record.equipment_id=equipment.equipment_id")
		->join("vendor","service_record.vendor_id=vendor.vendor_id",'left')
		->join("contact_person","service_record.contact_person_id=contact_person.contact_person_id",'left')
		->join("equipment_type","equipment.equipment_type_id=equipment_type.equipment_type_id")
		->join("department","equipment.department_id=department.department_id" )
		->group_by("equipment_type,department,equipment.area_id,equipment.unit_id")
		->group_by("request_id ")
		->order_by("equipment_id");
		$query=$this->db->get();
		return $query->result();
	
		
		
		}
		
		else if($type=="service_records"){
			if($this->input->post('select')){
							$request_id=$this->input->post('request_id');

							$this->db->where('request_id',$request_id);
			}
			if($this->input->post('search')){
						$service=strtolower($this->input->post('call_information_type'));
						$this->db->like('LOWER(call_information_type)',$service,'after');						
						
			}
			
			$this->db->select("equipment_id,request_id,call_date,call_time,vendor_id,contact_person_id,call_information_type,call_information,service_person_remarks,contact_person_id,service_date,service_time,problem_status,working_status")->from("service_record");
			
	
			
					

		}
		else if($type=="equipment"){
			if($this->input->post('select')){
					$equipment_id=$this->input->post('equipment_id');

					$this->db->where('equipment_id',$equipment_id);					
			}
			if($this->input->post('search')){
						$equipment=strtolower($this->input->post('equipment_type'));
						$this->db->like('LOWER(equipment_type)',$equipment,'after');
						
			}
			
			if($equipment_type!=0){
				$this->db->where("equipment.equipment_type_id",$equipment_type);
			}
			if($department!=0){
				$this->db->where("equipment.department_id",$department);
			}
			if($area!=0){
				$this->db->where("equipment.area_id",$area);
			}
			if($unit!=0){
				$this->db->where("equipment.unit_id",$unit);
			}
			
			if($status!="-1"){
				$this->db->where("equipment.equipment_status",$status);
			}
		
			$this->db->select("equipment_id,make,serial_number,asset_number,equipment.equipment_status_id,equipment_type,hospital,category_name,equipment_type.equipment_type_id,status_name,model,procured_by,cost,supplier,service_engineer,service_engineer_contact,vendor_name,supply_date,warranty_start_date,warranty_end_date,contact_person_first_name,contact_person_last_name, contact_person_contact,hospital,department,equipment_status,hospital.hospital_id,department.department_id")->from("equipment")
				->join('equipment_type','equipment.equipment_type_id=equipment_type.equipment_type_id','left')
				//->join('hospital','equipment.hospital_id=hospital.hospital_id','left')
				->join("hospital","equipment.equipment_location_id=hospital.hospital_id",'left')
				->join('department','equipment.department_id=department.department_id','left')
				->join("equipment_category","equipment.category_id=equipment_category.category_id")
				->join("equipment_purchase_status","equipment.equipment_status_id=equipment_purchase_status.equipment_status_id")
				->join('vendor','vendor.vendor_id=equipment.vendor_id','left')
				->join('contact_person','contact_person.contact_person_id=equipment.contact_person_id','left')
				->join('user','equipment.user_id=user.user_id','left')
				->order_by('equipment_type');	
			
			
		}
			else if($type=="services"){
			if($this->input->post('select')){
							$equipment_id=$this->input->post('equipment_id');

							$this->db->where('equipment_id',$equipment_id);
							
			}
			if($this->input->post('search')){
						$equipment=strtolower($this->input->post('equipment_type'));
						$this->db->like('LOWER(equipment_type)',$equipment,'after');						
						
			}
			$this->db->select("equipment_id,make,serial_number,asset_number,equipment_type,equipment.equipment_id,equipment.equipment_type_id,model,procured_by,cost,supplier,supply_date,warranty_period,service_engineer,service_engineer_contact,hospital,department,username,equipment_status,hospital.hospital_id,department.department_id,user.user_id")->from("equipment")
						->join('equipment_type','equipment.equipment_type_id=equipment_type.equipment_type_id','left')
						->join('hospital','equipment.hospital_id=hospital.hospital_id','left')
						->join('department','equipment.department_id=department.department_id','left')
						->join('user','equipment.user_id=user.user_id','left')
						->order_by('equipment_type');	
				

		}
		
		else if($type=="equipment_type"){
			if($this->input->post('select')){
				$equipment_type_id=$this->input->post('equipment_type_id');
				$this->db->where('equipment_type_id',$equipment_type_id);	
			}
			if($this->input->post('search')){
							
						$equipment_type_id=strtolower($this->input->post('equipment_type'));
						$this->db->like('LOWER(equipment_type)',$equipment_type_id,'after');
						
			}
					$this->db->select("equipment_type_id,equipment_type")->from("equipment_type")->order_by("equipment_type");
					
		}
		$query=$this->db->get();
		return $query->result();
		
		
	}
	function update_data($type){
		
		 if($type=="equipment_type"){
			
		
			$data = array(
					  'equipment_type'=>$this->input->post('equipment_type')
				);
			$this->db->where('equipment_type_id',$this->input->post('equipment_type_id'));
			$table="equipment_type";
		
		
	}
	else if($type=="equipment"){
		    if($this->input->post('supply_date')) $date_supply = date("Y-m-d",strtotime($this->input->post('supply_date')));
			else $date_supply=0;
			if($this->input->post('warranty_start_date')) $warranty_start_date = date("Y-m-d",strtotime($this->input->post('warranty_start_date')));
			else $warranty_start_date=0;
			if($this->input->post('warranty_end_date')) $warranty_end_date = date("Y-m-d",strtotime($this->input->post('warranty_end_date')));
			else $warranty_end_date=0;
			$data = array(
			
					  'equipment_type_id'=>$this->input->post('equipment_type'),
					  'make'=>$this->input->post('make'),	
					  'model'=>$this->input->post('model'),	
					  'serial_number'=>$this->input->post('serial_number'),	
					  'asset_number'=>$this->input->post('asset_number'),	
					  'procured_by'=>$this->input->post('procured_by'),	
					  'cost'=>$this->input->post('cost'),	
					  'supplier'=>$this->input->post('supplier'),	
					  'supply_date'=>$date_supply,
					  'warranty_start_date'=>$warranty_start_date,
					  'warranty_end_date'=>$warranty_end_date,
					  'service_engineer'=>$this->input->post('service_engineer'),	
					  'service_engineer_contact'=>$this->input->post('service_engineer_contact'),	
					  'hospital_id'=>$this->input->post('hospital'),	
					  'department_id'=>$this->input->post('department'),	
				
					  'equipment_status'=>$this->input->post('equipment_status')	
					  	
				
				);
			$this->db->where('equipment_id',$this->input->post('equipment_id'));
			$table="equipment";
		

	}
	
	elseif($type=="service_records"){
			/*if($this->input->post('call_date')) $call_date = date("d-m-Y",strtotime($this->input->post('call_date')));
			else $call_date=0;
			  if($this->input->post('service_date')) $service_date = date("d-m-Y",strtotime($this->input->post('service_date')));
			else $service_date=0;*/
			$date = $this->input->post('call_date');
			$date = date("Y-m-d",strtotime($date));
			$service_date = $this->input->post('service_date');
			$service_date = date("Y-m-d",strtotime($service_date));
		$data = array(
		
					//'request_id'=>$this->input->post('request_id'),
					 'call_date'=>$date,
					 'call_time'=>$this->input->post('call_time'),
					 //'user_id'=>$this->input->post('user'),
				     'call_information_type'=>$this->input->post('call_information_type'),
					 'call_information'=>$this->input->post('call_information'),
					 'vendor_id'=>$this->input->post('vendor_id'),
					 'contact_person_id'=>$this->input->post('contact_person'),
					 'service_person_remarks'=>$this->input->post('service_person_remarks'),
					 'service_date'=>$service_date,
					 'service_time'=>$this->input->post('service_time'),
					 'problem_status'=>$this->input->post('problem_status'),
					 'working_status'=>$this->input->post('working_status')
			);
		
         	$this->db->where('request_id',$this->input->post('request_id'));
		$table="service_record";
	
		}
		
		$this->db->trans_start();
			$this->db->update($table,$data);

		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
			return false;
		}
		else{
		  return true;
		}
		
		
		
		
		
		
		
		
		
	}	
	
	function insert_data($type){
		
	
		
		 if($type=="equipment"){
			if($this->input->post('supply_date')) $date_supply = date("Y-m-d",strtotime($this->input->post('supply_date')));
			else $date_supply=0;
			if($this->input->post('purchase_Order_Date')) $purchase_date = date("Y-m-d",strtotime($this->input->post('purchase_Order_Date')));
			else $purchase_date=0;
			if($this->input->post('warranty_start_date')) $warranty_start_date = date("Y-m-d",strtotime($this->input->post('warranty_start_date')));
			else $warranty_start_date=0;
			if($this->input->post('warranty_end_date')) $warranty_end_date = date("Y-m-d",strtotime($this->input->post('warranty_end_date')));
			else $warranty_end_date=0;
		$data = array(
				'equipment_type_id'=>$this->input->post('equipment_type'),	
				'make'=>$this->input->post('make'),
				'model'=>$this->input->post('model'),
				'serial_number'=>$this->input->post('serial_number'),
				'asset_number'=>$this->input->post('asset_number'),
				'procured_by'=>$this->input->post('procured_by'),
				'cost'=>$this->input->post('cost'),
				'supplier'=>$this->input->post('supplier'),
				'service_engineer'=>$this->input->post('service_engineer'),
				'service_engineer_contact'=>$this->input->post('service_engineer_contact'),
				'vendor_id'=>$this->input->post('vendor'),
				'purchase_order_date'=>$purchase_date,
				'supply_date'=>$date_supply,
				'warranty_start_date'=>$warranty_start_date,
				'warranty_end_date'=>$warranty_end_date,
				'vendor_id'=>$this->input->post('vendor_id'),
				'contact_person_id'=>$this->input->post('contact_person'),
				//'hospital_id'=>$hospital_id,
				'department_id'=>$this->input->post('department'),
				'area_id'=>$this->input->post('area'),
				'unit_id'=>$this->input->post('unit'),
				//'user_id'=>$this->input->post('user'),
				'equipment_status'=>$this->input->post('equipment_status'),
				'category_id'=>$this->input->post('equipment_category'),
				'equipment_location_id'=>$this->input->post('location'),
				'equipment_status_id'=>$this->input->post('purchase_Status'),
				'contributed_by'=>$this->input->post('Countributed'),
				'journal_type'=>$this->input->post('journal_Type'),
				'voucher_no'=>$this->input->post('voucher_no'),	
				'accessories'=>$this->input->post('accessories')
				);

		$table="equipment";
		}
		else if($type=="equipment_type")
		{
			
			$data = array(
			'equipment_type'=>$this->input->post('equipment_type'),
			'category_id'=>$this->input->post('equipment_category')
			);
			$table="equipment_type";
		}
			elseif($type=="services"){
			  if($this->input->post('supply_date')) $supply_date = date("Y-m-d",strtotime($this->input->post('supply_date')));
			else $supply_date=0;
		$data = array(
					  'equipment_type_id'=>$this->input->post('equipment_type'),
					 'make'=>$this->input->post('make'),
					 'model'=>$this->input->post('model'),
					  'serial_number'=>$this->input->post('serial_number'),
					   'asset_number'=>$this->input->post('asset_number'),
					   'procured_by'=>$this->input->post('procured_by'),
					    'cost'=>$this->input->post('cost'),
					     'supplier'=>$this->input->post('supplier'),
					      'supply_date'=>$supply_date,
					       'warranty_period'=>$this->input->post('warranty_period'),
					        'service_engineer'=>$this->input->post('service_engineer'),
					        'service_engineer_contact'=>$this->input->post('service_engineer_contact'),
					        'hospital_id'=>$this->input->post('hospital'),
					        'department_id'=>$this->input->post('department'),
		'user_id'=>$this->input->post('user'),
		'equipment_status'=>$this->input->post('equipment_status')
		
			);

		$table="equipment";
		}
		
		
		elseif($type=="service_records"){
			  if($this->input->post('call_date')) $call_date = date("Y-m-d",strtotime($this->input->post('call_date')));
			else $call_date=0;
			  if($this->input->post('service_date')) $service_date = date("Y-m-d",strtotime($this->input->post('service_date')));
			else $service_date=0;
			
		$data = array(
				      'equipment_id'=>$this->input->post('equipment_id'),
					  'call_date'=>$call_date,
					 'call_time'=>$this->input->post('call_time'),
					 //'user_id'=>$this->input->post('user'),
					
					 'call_information_type'=>$this->input->post('call_information_type'),
					 'call_information'=>$this->input->post('call_information'),
					 'vendor_id'=>$this->input->post('vendor_id'),
					 'contact_person_id'=>$this->input->post('contact_person'),
					 'service_person_remarks'=>$this->input->post('service_person_remarks'),
					 'service_date'=>$service_date,
					 'service_time'=>$this->input->post('service_time'),
					 'problem_status'=>$this->input->post('problem_status'),
					 'working_status'=>$this->input->post('working_status')
			);

		 $this->db->trans_start();
		$this->db->insert('service_record',$data);
		$request_id=$this->db->insert_id();
		$this->db->trans_complete();
		if($this->db->trans_status()==FALSE){
			return false;
		}
		else{
				$this->db->select("equipment.equipment_id,equipment.equipment_type_id,equipment.department_id,
				contact_person.contact_person_id,vendor.vendor_id,request_id,equipment_type,call_date,call_time,
				call_information_type,call_information,service_person_remarks,service_date,service_time,
				problem_status,working_status,vendor_name,contact_person_first_name,contact_person_last_name,
				serial_number,asset_number,model
		")
		->from("service_record")
		->join("equipment","service_record.equipment_id=equipment.equipment_id")
		->join("vendor","service_record.vendor_id=vendor.vendor_id",'left')
		->join("contact_person","service_record.contact_person_id=contact_person.contact_person_id",'left')
		->join("equipment_type","equipment.equipment_type_id=equipment_type.equipment_type_id",'left')
		->join("department","equipment.department_id=department.department_id" )
		//->where('service_record.equipment_id',$request_id)
		->where_in('request_id',$request_id);
	
	
		
		$query=$this->db->get();
		return $query->result();
		
		}
	
			
		
		}
		
		
		$this->db->trans_start();
         if(isset($table)){
		
		$this->db->insert($table,$data);
		 }
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
			return false;
		}
		else{
		  return true;
		}
		
		
		
	
	
	
	
	
	
	
	}
}
?>