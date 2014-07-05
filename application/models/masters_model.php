<?php 
class Masters_model extends CI_Model{
	
	
	function get_data($type,$equipment_type=0,$department=0,$area=0,$unit=0,$status=""){
		if($type=="equipment_types"){
			
			$this->db->select("equipment_type_id,equipment_type")->from("equipment_type");
		}
		else if($type=="hospital"){
		
			$this->db->select("hospital_id,hospital")->from("hospital");
		}
		else if($type=="department"){
			
			$this->db->select("department_id,department")->from("department")->order_by('department');
		}
		else if($type=="area"){
			
			$this->db->select("area_id,area_name,department_id")->from("area");
		}
		else if($type=="unit"){
			
			$this->db->select("unit_id,unit_name,department_id")->from("unit");
		}
		else if($type=="user"){
			
			$this->db->select("user_id,username")->from("user");
		}
		else if($type=="staff_category"){
			
			$this->db->select("staff_category_id,staff_category")->from("staff_category");
		}
		else if($type=="staff_role"){
			
			$this->db->select("staff_role_id,staff_role")->from("staff_role");
		}
		else if($type=="item_type"){
			$this->db->select("item_type_id,item_type")->from("item_type");
		}
		else if($type=="drug_type"){
			$this->db->select("drug_type_id,drug_type,description")->from("drug_type");
		}
		
		else if($type=="dosage"){

			if($this->input->post('search')){
					
			$dosage_type=strtolower($this->input->post('dosage_name'));
				$this->db->like('LOWER(dosage)',$dosage_type,'after');
				}
			if($this->input->post('select')){
					$dosage_id=$this->input->post('dosage_id');

					$this->db->where('dosage_id',$dosage_id);
			}
			$this->db->select("dosage,dosage_id,dosage_unit")->from("dosage");
						
		}
	
		else if($type=="generics"){
		
			if($this->input->post('select')){
					$generic_id=$this->input->post('generic_item_id');

					$this->db->where('generic_item_id',$generic_id);
					
			}
			if($this->input->post('search')){
				$generic_type=strtolower($this->input->post('generic_name'));
				$this->db->like('LOWER(generic_name)',$generic_type,'after');
				}
				$this->db->select("generic_item_id,generic_name,drug_type,item_type,drug_type.drug_type_id,item_type.item_type_id")->from("generic_item")
				->join('drug_type','generic_item.drug_type_id=drug_type.drug_type_id','left')
				->join('item_type','generic_item.item_type_id=item_type.item_type_id','left')
				->order_by('generic_name');	

			
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
			if($status!=""){
				$this->db->where("equipment.equipment_status",$status);
			}
			$this->db->select("equipment_id,make,serial_number,asset_number,equipment_type,equipment_type.equipment_type_id,model,procured_by,cost,supplier,supply_date,warranty_start_date,warranty_end_date,service_engineer,service_engineer_contact,hospital,department,username,equipment_status,hospital.hospital_id,department.department_id,user.user_id")->from("equipment")
				->join('equipment_type','equipment.equipment_type_id=equipment_type.equipment_type_id','left')
				->join('hospital','equipment.hospital_id=hospital.hospital_id','left')
				->join('department','equipment.department_id=department.department_id','left')
				->join('user','equipment.user_id=user.user_id','left')
				
				->order_by('equipment_type');	
			
		}

		else if($type=="service"){
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
		else if($type=="drug_type"){
			if($this->input->post('search')){
				$drug_type=strtolower($this->input->post('drug_type'));
				$this->db->like('LOWER(drug_type)',$drug_type,'after');
	
				}
			if($this->input->post('select')){
					
					$drug_id=$this->input->post('drug_type_id');
					$this->db->where('drug_type_id',$drug_id);
			}
			
			$this->db->select("drug_type_id,drug_type,description")->from("drug_type");	

		}		

		else if($type=="test_method")

			{

				if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results

				{

						$test_id=$this->input->post('test_method_id');

						$this->db->where('test_method_id',$test_id);

				}

		    	if($this->input->post('search') && $this->input->post('test_method')!="")  //query to retrieve matches for the text entered in the field from table test_type

		    	{

		 		 		$search_method=strtolower($this->input->post('test_method'));

			  	    	$this->db->like('LOWER(test_method)',$search_method,'after');

		    	}

				$this->db->select("test_method_id,test_method")->from("test_method")->order_by('test_method');

			}elseif ($type=="test_group") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$test_id=$this->input->post('test_group_id');
					$this->db->where('group_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('group_name')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('group_name'));
		  	    	$this->db->like('LOWER(group_name)',$search_method,'after');
	    	}
			$this->db->select("group_id,group_name")->from("test_group")->order_by('group_name');


		}
		elseif ($type=="test_status_type") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$test_id=$this->input->post('test_status_type_id');
					$this->db->where('test_status_type_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('test_status_type')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('test_status_type'));
		  	    	$this->db->like('LOWER(test_status_type)',$search_method,'after');
	    	}
			$this->db->select("test_status_type_id,test_status_type")->from("test_status_type")->order_by('test_status_type');


		}
		elseif ($type=="test_name") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$test_id=$this->input->post('test_master_id');
					$this->db->where('test_master_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('test_name')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('test_name'));
		  	    	$this->db->like('LOWER(test_name)',$search_method,'after');
	    	}
			$this->db->select("test_master_id,test_name,test_master.test_method_id")->from("test_master")->join('test_method','test_master.test_method_id=test_method.test_method_id')->order_by('test_name');


		}
		elseif ($type=="test_area") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$test_id=$this->input->post('test_area_id');
					$this->db->where('test_area_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('test_area')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('test_area'));
		  	    	$this->db->like('LOWER(test_area)',$search_method,'after');
	    	}
			$this->db->select("test_area_id,test_area")->from("test_area")->order_by('test_area');


		}
		
		elseif ($type=="antibody") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$test_id=$this->input->post('antibody_id');
					$this->db->where('antibody_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('antibody')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('antibody'));
		  	    	$this->db->like('LOWER(antibody)',$search_method,'after');
	    	}
			$this->db->select("antibody_id,antibody")->from("antibody")->order_by('antibody');
			
			}
			
		elseif ($type=="micro_organism") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$test_id=$this->input->post('micro_organism_id');
					$this->db->where('micro_organism_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('micro_organism')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('micro_organism'));
		  	    	$this->db->like('LOWER(micro_organism)',$search_method,'after');
	    	}
			$this->db->select("micro_organism_id,micro_organism")->from("micro_organism")->order_by('micro_organism');
			
			}
		elseif ($type=="specimen_type") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$test_id=$this->input->post('specimen_type_id');
					$this->db->where('speciment_type_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('specimen_type')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('specimen_type'));
		  	    	$this->db->like('LOWER(specimen_type)',$search_method,'after');
	    	}
			$this->db->select("speciment_type_id,specimen_type")->from("specimen_type")->order_by('specimen_type');

		}
			elseif ($type=="sample_status") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$test_id=$this->input->post('sample_status_id');
					$this->db->where('sample_status_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('sample_status')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('sample_status'));
		  	    	$this->db->like('LOWER(sample_status)',$search_method,'after');
	    	}
			$this->db->select("sample_status_id,sample_status")->from("sample_status")->order_by('sample_status');

		}
		else if($type=="districts"){
			
			$this->db->select("district_id,district")->from("district");
		}
		else if($type=="states"){
			$this->db->select("state_id,state")->from("states");
		}
		else if($type=="area_types"){
			$this->db->select("area_type_id,area_type")->from("area_types");
		}
		else if($type=="area_activity"){
			$this->db->select("area_activity_id,activity_name")->from("area_activity");
		}
		else if($type=="vendor"){
			$this->db->select("vendor_id,vendor_name")->from("vendor");
		}
		else if($type=="facility_activity"){
			$this->db->select("activity_id")->from("facility_activity");
		}
		else if($type=="activity_done"){
			$this->db->select("*")->from("activity_done");
		}	
		else if($type=="facility_type"){
			$this->db->select("facility_type_id,facility_type")->from("facility_type");
		}
		else if($type=="facility_area"){
			$this->db->select("facility_area_id,area_name")->from("facility_area");
		}
			else if($type=="vendor"){
			$this->db->select("vendor_id,vendor_name")->from("vendor");
		}
		else if($type=="vendor_contracts"){
			
			$this->db->select("contract_id,status")->from("vendor_contracts");

		}
		else if($type=="facility"){
			$this->db->select("facility_id,facility_name")->from("facility");
		}
		else if($type=="village_town"){
			$this->db->select("village_town_id,village_town")->from("village_town");
		}		

		$query=$this->db->get();
		return $query->result();
	
}
function update_data($type){
		if($type=="facility"){
			$data = array(
					  'facility_type_id'=>$this->input->post('facility_type'),
					  'facility_name'=>$this->input->post('facility_name'),
					  'division_id'=>$this->input->post('division'),
					   'longitude'=>$this->input->post('longitude'),
					   'latitude'=>$this->input->post('latitude')
			);
			$this->db->where('facility_id',$this->input->post('facility_id'));
			$table="facilities";
		
		
	}
		else if($type=="drugs"){
			$data = array(
					  'drug_type'=>$this->input->post('drug_type'),
					  'description'=>$this->input->post('description'),
					  	
				
				);
			$this->db->where('drug_type_id',$this->input->post('drug_type_id'));
			$table="drug_type";
		
		
	}
	else if($type=="equipment_type"){
			$data = array(
					  'equipment_type'=>$this->input->post('equipment_type')
				);
			$this->db->where('equipment_type_id',$this->input->post('equipment_type_id'));
			$table="equipment_type";
		
		
	}
	else if($type=="equipment"){
			$data = array(
					  'equipment_type_id'=>$this->input->post('equipment_type'),
					  'make'=>$this->input->post('make'),	
					  'model'=>$this->input->post('model'),	
					  'serial_number'=>$this->input->post('serial_number'),	
					  'asset_number'=>$this->input->post('asset_number'),	
					  'procured_by'=>$this->input->post('procured_by'),	
					  'cost'=>$this->input->post('cost'),	
					  'supplier'=>$this->input->post('supplier'),	
					  'supply_date'=>date("Y-m-d",strtotime($this->input->post('service_date'))),
					  'warranty_period'=>$this->input->post('warranty_period'),	
					  'service_engineer'=>$this->input->post('service_engineer'),	
					  'service_engineer_contact'=>$this->input->post('service_engineer_contact'),	
					  'hospital_id'=>$this->input->post('hospital'),	
					  'department_id'=>$this->input->post('department'),	
					  'user_id'=>$this->input->post('user'),	
					  'equipment_status'=>$this->input->post('equipment_status')	
					  	
				
				);
			$this->db->where('equipment_id',$this->input->post('equipment_id'));
			$table="equipment";
		

	}


else if($type=="generics"){
			$data = array(
					  'generic_name'=>$this->input->post('generic_name'),
					  'item_type_id'=>$this->input->post('item_type'),
					   'drug_type_id'=>$this->input->post('drug_type')
					  );
			$this->db->where('generic_item_id',$this->input->post('generic_item_id'));
			$table="generic_item";
		
		
	}
else if($type=="dosage"){
			$data = array(
					  'dosage'=>$this->input->post('dosage'),
					  'dosage_unit'=>$this->input->post('dosage_unit')
					  );
			$this->db->where('dosage_id',$this->input->post('dosage_id'));
			$table="dosage";
		
		
	}
 

 elseif ($type=="test_method") {      //updating when update button is clicked
	$data=array('test_method'=>$this->input->post('test_method'));

	$this->db->where('test_method_id',$this->input->post('test_method_id'));

   $table="test_method";

 }

 elseif ($type=="test_group") {
 		
    $data=array('group_name'=>$this->input->post('group_name'));
 	$r=$this->input->post('test_group_id');
 	$this->db->where('group_id',$this->input->post('test_group_id'));
   $table="test_group";	
 }
 
 elseif ($type=="test_status_type") {
 		
    $data=array('test_status_type'=>$this->input->post('test_status_type'));
 	$r=$this->input->post('test_status_type_id');
 	$this->db->where('test_status_type_id',$this->input->post('test_status_type_id'));
   $table="test_status_type";	
 }
 elseif ($type=="test_name") {
 		
    $data=array('test_name'=>$this->input->post('test_name'),
	'test_method_id'=>$this->input->post('test_method')
	);
 	$r=$this->input->post('test_master_id');
 	$this->db->where('test_master_id',$this->input->post('test_master_id'));
   $table="test_master";	
 }
 elseif ($type=="test_area") {
 		
    $data=array('test_area'=>$this->input->post('test_area'));
 	$r=$this->input->post('test_area_id');
 	$this->db->where('test_area_id',$this->input->post('test_area_id'));
   $table="test_area";	
 }
 elseif ($type=="test_name") {
 		
    $data=array('test_name'=>$this->input->post('test_name'));
 	$r=$this->input->post('test_master_id');
 	$this->db->where('test_master_id',$this->input->post('test_master_id'));
   $table="test_master";	
 }
 elseif ($type=="antibody") {
 		
    $data=array('antibody'=>$this->input->post('antibody'));
 	$r=$this->input->post('antibody_id');
 	$this->db->where('antibody_id',$this->input->post('antibody_id'));
   $table="antibody";	
 }
 elseif ($type=="micro_organism") {
 		
    $data=array('micro_organism'=>$this->input->post('micro_organism'));
 	$r=$this->input->post('micro_organism_id');
 	$this->db->where('micro_organism_id',$this->input->post('micro_organism_id'));
   $table="micro_organism";	
 }
	elseif ($type=="specimen_type") {
    $data=array('specimen_type'=>$this->input->post('specimen_type'));
 	$r=$this->input->post('specimen_type_id');
 	 $this->db->where('speciment_type_id',$this->input->post('specimen_type_id'));
   $table="specimen_type";	
 }	
 elseif ($type=="sample_status") {
    $data=array('sample_status'=>$this->input->post('sample_status'));
 	 $this->db->where('sample_status_id',$this->input->post('sample_status_id'));
   $table="sample_status";	
 }elseif ($type=="test_method") {      //updating when update button is clicked
	$data=array('test_method'=>$this->input->post('test_method'));

	$this->db->where('test_method_id',$this->input->post('test_method_id'));

   $table="test_method";

 }

 elseif ($type=="test_group") {
 		
    $data=array('group_name'=>$this->input->post('group_name'));
 	$r=$this->input->post('test_group_id');
 	$this->db->where('group_id',$this->input->post('test_group_id'));
   $table="test_group";	
 }
 
 elseif ($type=="test_status_type") {
 		
    $data=array('test_status_type'=>$this->input->post('test_status_type'));
 	$r=$this->input->post('test_status_type_id');
 	$this->db->where('test_status_type_id',$this->input->post('test_status_type_id'));
   $table="test_status_type";	
 }
 elseif ($type=="test_name") {
 		
    $data=array('test_name'=>$this->input->post('test_name'),
	'test_method_id'=>$this->input->post('test_method')
	);
 	$r=$this->input->post('test_master_id');
 	$this->db->where('test_master_id',$this->input->post('test_master_id'));
   $table="test_master";	
 }
 elseif ($type=="test_area") {
 		
    $data=array('test_area'=>$this->input->post('test_area'));
 	$r=$this->input->post('test_area_id');
 	$this->db->where('test_area_id',$this->input->post('test_area_id'));
   $table="test_area";	
 }
 elseif ($type=="test_name") {
 		
    $data=array('test_name'=>$this->input->post('test_name'));
 	$r=$this->input->post('test_master_id');
 	$this->db->where('test_master_id',$this->input->post('test_master_id'));
   $table="test_master";	
 }
 elseif ($type=="antibody") {
 		
    $data=array('antibody'=>$this->input->post('antibody'));
 	$r=$this->input->post('antibody_id');
 	$this->db->where('antibody_id',$this->input->post('antibody_id'));
   $table="antibody";	
 }
 elseif ($type=="micro_organism") {
 		
    $data=array('micro_organism'=>$this->input->post('micro_organism'));
 	$r=$this->input->post('micro_organism_id');
 	$this->db->where('micro_organism_id',$this->input->post('micro_organism_id'));
   $table="micro_organism";	
 }
	elseif ($type=="specimen_type") {
    $data=array('specimen_type'=>$this->input->post('specimen_type'));
 	$r=$this->input->post('specimen_type_id');
 	 $this->db->where('speciment_type_id',$this->input->post('specimen_type_id'));
   $table="specimen_type";	
 }	
 elseif ($type=="sample_status") {
    $data=array('sample_status'=>$this->input->post('sample_status'));
 	 $this->db->where('sample_status_id',$this->input->post('sample_status_id'));
   $table="sample_status";	
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

		$hospital=$this->session->userdata('hospital');
		$hospital_id=$hospital['hospital_id'];
		if($type=="drug_type"){
		$data = array(
					  'drug_type'=>$this->input->post('drug_type'),
					 'description'=>$this->input->post('description')
		);

		$table="drug_type";
		}
		elseif($type=="equipment_type")
		{
			$data = array('equipment_type'=>$this->input->post('equipment_type'));
			$table="equipment_type";
		}
		
		elseif($type=="dosage"){
		$data = array(
					  'dosage_unit'=>$this->input->post('dosage_unit'),
					 'dosage'=>$this->input->post('dosage')
		);

		$table="dosage";
		}
		elseif($type=="generic"){
		$data = array(
					  'generic_name'=>$this->input->post('generic_name'),
					 'item_type_id'=>$this->input->post('item_type'),
					 'drug_type_id'=>$this->input->post('drug_type')
		);

		$table="generic_item";
		}
		elseif($type=="equipment"){
		$data = array(
				'equipment_type_id'=>$this->input->post('equipment_type'),
				'make'=>$this->input->post('make'),
				'model'=>$this->input->post('model'),
				'serial_number'=>$this->input->post('serial_number'),
				'asset_number'=>$this->input->post('asset_number'),
				'procured_by'=>$this->input->post('procured_by'),
				'cost'=>$this->input->post('cost'),
				'supplier'=>$this->input->post('supplier'),
				'supply_date'=>date("Y-m-d",strtotime($this->input->post('supply_date'))),
				'warranty_start_date'=>date("Y-m-d",strtotime($this->input->post('warranty_start_date'))),
				'warranty_end_date'=>date("Y-m-d",strtotime($this->input->post('warranty_end_date'))),
				'service_engineer'=>$this->input->post('service_engineer'),
				'service_engineer_contact'=>$this->input->post('service_engineer_contact'),
				'hospital_id'=>$hospital_id,
				'department_id'=>$this->input->post('department'),
				'area_id'=>$this->input->post('area'),
				'unit_id'=>$this->input->post('unit'),
				'user_id'=>$this->input->post('user'),
				'equipment_status'=>$this->input->post('equipment_status')
				);

		$table="equipment";
		}
	
		elseif($type=="service"){
		$data = array(
					  'equipment_type_id'=>$this->input->post('equipment_type'),
					 'make'=>$this->input->post('make'),
					 'model'=>$this->input->post('model'),
					  'serial_number'=>$this->input->post('serial_number'),
					   'asset_number'=>$this->input->post('asset_number'),
					   'procured_by'=>$this->input->post('procured_by'),
					    'cost'=>$this->input->post('cost'),
					     'supplier'=>$this->input->post('supplier'),
					      'supply_date'=>date("Y-m-d",strtotime($this->input->post('supply_date'))),
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
		$data = array(
					  'call_date'=>date("Y-m-d",strtotime($this->input->post('call_date'))),
					 'call_time'=>$this->input->post('call_time'),
					 'user_id'=>$this->input->post('user'),
					
					 'call_information_type'=>$this->input->post('call_information_type'),
					  'call_information'=>$this->input->post('call_information'),
					   'service_provider'=>$this->input->post('service_provider'),
					   'service_person'=>$this->input->post('service_person'),
					    'service_person_remarks'=>$this->input->post('service_person_remarks'),
					     'service_date'=>date("Y-m-d",strtotime($this->input->post('service_date'))),
					      'service_time'=>$this->input->post('service_time'),
					       'problem_status'=>$this->input->post('problem_status'),
					        'working_status'=>$this->input->post('working_status')
			);

		$table="service_records";
		}
		
		elseif($type=="equipment_type"){
		$data = array(
					  'equipment_type'=>$this->input->post('equipment_type')
		);

		$table="equipment_type";
		}
		
		elseif($type=="staff"){
		$data = array(
					  'first_name'=>$this->input->post('first_name'),
					  'last_name'=>$this->input->post('last_name'),
					  'gender'=>$this->input->post('gender'),
					  'date_of_birth'=>$this->input->post('date_of_birth'),
					  'department_id'=>$this->input->post('department'),
					  'unit_id'=>$this->input->post('unit'),
					  'area_id'=>$this->input->post('area'),
					  'staff_role_id'=>$this->input->post('staff_role'),
					  'staff_category_id'=>$this->input->post('staff_category'),
					  'designation'=>$this->input->post('designation'),
					  'staff_type'=>$this->input->post('staff_type'),
					  'email'=>$this->input->post('email'),
					  'phone'=>$this->input->post('phone'),
					  'specialisation'=>$this->input->post('specialisation'),
					  'research_area'=>$this->input->post('research_area'),
					  'research'=>$this->input->post('research')
		);

		$table="staff";
		}
		elseif($type=="staff_role"){
		$data = array(
					  'staff_role'=>$this->input->post('staff_role')
		);

		$table="staff_role";
		}
		elseif($type=="staff_category"){
		$data = array(
					  'staff_category'=>$this->input->post('staff_category')
		);

		$table="staff_category";
		}
				

		elseif ($type=="test_method") {

			$data=array('test_method'=>$this->input->post('test_method'));

		$table="test_method";			

		}
			elseif ($type=="test_group") {
			$data=array('group_name'=>$this->input->post('group_name'));
		$table="test_group";
		}
		elseif ($type=="test_area") {
			$data=array('test_area'=>$this->input->post('test_area'));
		$table="test_area";
		}
		elseif ($type=="test_status_type") {
			$data=array('test_status_type'=>$this->input->post('test_status_type'));
		$table="test_status_type";
		}
		elseif ($type=="test_name") {
			$data=array();
			foreach($this->input->post('test_name') as $test_name){
				$data[]=array(
					'test_name'=>$test_name,
					'test_method_id'=>$this->input->post('test_method')
				);
			}
		$table="test_master";
		}
		elseif ($type=="test_area") {
			$data=array('test_area'=>$this->input->post('test_area'));
			$table="test_area";
		}
		elseif ($type=="antibody") {
			$data=array('antibody'=>$this->input->post('antibody'));
		$table="antibody";
		}
		elseif ($type=="micro_organism") {
			$data=array('micro_organism'=>$this->input->post('micro_organism'));
		$table="micro_organism";
		}
		elseif ($type=="specimen_type") {
			$data=array('specimen_type'=>$this->input->post('specimen_type'));
		$table="specimen_type";
		}
			elseif ($type=="sample_status") {
			$data=array('sample_status'=>$this->input->post('sample_status'));
		$table="sample_status";
		}

		$this->db->trans_start();
		$this->db->insert($table,$data);
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
