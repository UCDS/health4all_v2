<?php 
class Masters_model extends CI_Model{
	
	
	function get_data($type,$equipment_type=0,$department=0,$area=0,$unit=0,$status="",$hospitals=0){
		if($type=="equipment_types"){
			$this->db->select("equipment_type_id,equipment_type")->from("equipment_type");
		}
		else if($type=="hospital"){
			$this->db->select("hospital_id,hospital")->from("hospital");
		}
		else if($type=="department"){
			$this->db->select("department_id,hospital_id,department")->from("department")->order_by('department');
		}
		else if($type=="area"){
			if($hospitals!=0){
				$hosp_id=array();
				foreach($hospitals as $hospital){
					$hosp_id[]=$hospital->hospital_id;
				}
				$this->db->where_in('hospital_id',$hosp_id);
			}
			$this->db->select("area_id,area_name,area.department_id,hospital_id")->from("area")->join('department','area.department_id=department.department_id','left');
		}
		else if($type=="unit"){
			$this->db->select("unit_id,unit_name,department_id")->from("unit");
		}
		else if($type=="user"){
			$this->db->select("user_id,username")->from("user");
		}
		else if($type=='staff')
		{
			if($this->input->post('search'))
			{
				$staff = strtolower($this->input->post('staff'));
				$this->db->like('LOWER(first_name)',$staff,'after');
			}
			if($this->input->post('select'))
			{
				$staff_id = $this->input->post('staff_id');
				$this->db->where('staff_id',$staff_id);
			}
			$this->db->select("staff_id,first_name,last_name,gender,date_of_birth,department_id,unit_id,area_id,staff_role_id,staff_category_id,designation,email,phone,specialisation,research,research_area")->from("staff");
			
		}
		else if($type=="staff_category")
		{	
			if($this->input->post('search'))
			{
				$staff_category = strtolower($this->input->post('staff_category'));
				$this->db->like('LOWER(staff_category)',$staff_category,'after');
			}
			if($this->input->post('staff_category_id'))
			{
				
				$staff_category_id = $this->input->post('staff_category_id');
				$this->db->where('staff_category_id',$staff_category_id);
			}
			
			$this->db->select("staff_category_id,staff_category")->from("staff_category");
		}
		else if($type=="staff_role")
		{
		if($this->input->post('search'))
			{
				$staff_role = strtolower($this->input->post('staff_role'));
				$this->db->like('LOWER(staff_role)',$staff_role,'after');
			}
			if($this->input->post('staff_role_id'))
			{
				$staff_role_id = $this->input->post('staff_role_id');
				$this->db->where('staff_role_id',$staff_role_id);
			}
			
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

			}
			elseif ($type=="test_group") 
			{
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
			if($department!=0 && count($department)>0){
				$deps = array();
				foreach($department as $d){
					$deps[]=$d->department_id;
				}
				$this->db->where_in('department_id',$deps);
			}
			$this->db->select("test_master_id,test_name,test_master.test_method_id,test_master.test_area_id,test_method")->from("test_master")->join('test_method','test_master.test_method_id=test_method.test_method_id')->join('test_area','test_master.test_area_id=test_area.test_area_id')->order_by('test_name');


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
			if($department!=0 && count($department)>0){
				$deps = array();
				foreach($department as $d){
					$deps[]=$d->department_id;
				}
				$this->db->where_in('department_id',$deps);
			}
			$this->db->select("test_area_id,test_area")->from("test_area")->order_by('test_area');


		}
		
		elseif ($type=="antibiotic") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$test_id=$this->input->post('antibiotic_id');
					$this->db->where('antibiotic_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('antibiotic')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('antibiotic'));
		  	    	$this->db->like('LOWER(antibiotic)',$search_method,'after');
	    	}
			$this->db->select("antibiotic_id,antibiotic")->from("antibiotic")->order_by('antibiotic');
			
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
					$this->db->where('specimen_type_id',$test_id);
			}
	    	if($this->input->post('search') && $this->input->post('specimen_type')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('specimen_type'));
		  	    	$this->db->like('LOWER(specimen_type)',$search_method,'after');
	    	}
			$this->db->select("specimen_type_id,specimen_type")->from("specimen_type")->order_by('specimen_type');

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
		elseif ($type=="lab_unit") {
			if($this->input->post('select'))  //query to retrieve row from table when a result is selected from search results
			{
					$lab_unit_id=$this->input->post('lab_unit_it');
					$this->db->where('lab_unit_id',$lab_unit_id);
			}
	    	if($this->input->post('search') && $this->input->post('lab_unit')!="")  //query to retrieve matches for the text entered in the field from table test_type
	    	{
	 		 		$search_method=strtolower($this->input->post('lab_unit'));
		  	    	$this->db->like('LOWER(lab_unit)',$search_method,'after');
	    	}
			$this->db->select("lab_unit_id,lab_unit")->from("lab_unit")->order_by('lab_unit');

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
		else if($type=="area"){
			$this->db->select("area_id,area_name")->from("area");
		}
			else if($type=="vendor"){
			$this->db->select("vendor_id,vendor_name")->from("vendor");
		}
		else if($type=="vendor_contracts"){
			
			$this->db->select("contract_id,status")->from("vendor_contracts");

		}
		else if($type=="village_town"){
			$this->db->select("village_town_id,village_town")->from("village_town");
		}
		else if($type=="sanitation_activity"){
			$date=date("Y-m-d",strtotime($this->input->post('date')));
			$day = date('w',strtotime($this->input->post('date')));
			if(date("d",strtotime($date))>'28'){
				$week_start = date('Y-m-29', strtotime($date));
			}
			else{
				$week_start = date('Y-m-d', strtotime("$date - 6 days"));
			}
			$week_end = date('Y-m-d', strtotime($date.' +  days'));
			$fortnight_start_date=date("Y-m-1",strtotime($date));
			if($date-$fortnight_start_date>15)
			$fortnight_end_date=date("Y-m-15",strtotime($date));
			else { 
				$fortnight_start_date=date("Y-m-15",strtotime($date));
				$fortnight_end_date=date("Y-m-t",strtotime($date));
			}
			$this->db->select('activity_name,frequency,weightage,frequency_type,activity_id,day_done.*,week_done.*,fortnight_done.*,month_done.*')
			->from('facility_activity')
			->join('area_activity','facility_activity.area_activity_id=area_activity.area_activity_id')
			->join('area','facility_activity.facility_area_id=area.area_id')
			->join("(SELECT activity_id day_activity_done,date day_activity_date,time day_activity_time,score daily_score FROM activity_done JOIN facility_activity USING(activity_id) JOIN area_activity USING(area_activity_id) WHERE frequency_type='Daily' AND date='$date') day_done",'facility_activity.activity_id=day_done.day_activity_done','left')
			->join("(SELECT activity_id week_activity_done,date week_activity_date,time week_activity_time,score weekly_score,comments FROM activity_done JOIN facility_activity USING(activity_id) JOIN area_activity USING(area_activity_id) WHERE frequency_type='Weekly' AND date='$week_start' ) week_done",'facility_activity.activity_id=week_done.week_activity_done','left')
			->join("(SELECT activity_id fortnight_activity_done,date fortnight_activity_date,time fortnight_activity_time,score fortnightly_score FROM activity_done JOIN facility_activity USING(activity_id) JOIN area_activity USING(area_activity_id) WHERE frequency_type='Fortnightly' AND (date BETWEEN '$fortnight_start_date' AND '$fortnight_end_date')) fortnight_done",'facility_activity.activity_id=fortnight_done.fortnight_activity_done','left')
			->join("(SELECT activity_id month_activity_done,date month_activity_date,time month_activity_time,score monthly_score,comments FROM activity_done JOIN facility_activity USING(activity_id) JOIN area_activity USING(area_activity_id) WHERE frequency_type='Monthly' AND MONTH(date)=MONTH('$week_start') AND YEAR(date)=YEAR('$week_start')) month_done",'facility_activity.activity_id=month_done.month_activity_done','left')
			->where('area.area_id',$this->input->post('area'));
		}
		$query=$this->db->get();		
		return $query->result();
	
}
function update_data($type){
	if($type=="drugs"){
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
	 $binary=0;
	 $numeric=0;
	 $text=0;
 		foreach($this->input->post('output_format') as $output_format){
			if($output_format==1){
				$binary=1;
			}
			if($output_format==2){
				$numeric=1;
			}
			if($output_format==3){
				$text=1;
			}
		}
				
    $data=array(
		'test_name'=>$this->input->post('test_name'),
		'test_method_id'=>$this->input->post('test_method'),
		'test_area_id'=>$this->input->post('test_area'),
		'binary_result'=>$binary,
		'numeric_result'=>$numeric,
		'text_result'=>$text,
		'binary_positive'=>$this->input->post('binary_pos'),
		'binary_negative'=>$this->input->post('binary_neg'),
		'numeric_result_unit'=>$this->input->post('numeric_result_unit')
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
 elseif ($type=="antibiotic") {
 		
    $data=array('antibiotic'=>$this->input->post('antibiotic'));
 	$r=$this->input->post('antibiotic_id');
 	$this->db->where('antibiotic_id',$this->input->post('antibiotic_id'));
   $table="antibiotic";	
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
 	 $this->db->where('specimen_type_id',$this->input->post('specimen_type_id'));
   $table="specimen_type";	
 }	
 elseif ($type=="sample_status") {
    $data=array('sample_status'=>$this->input->post('sample_status'));
 	 $this->db->where('sample_status_id',$this->input->post('sample_status_id'));
   $table="sample_status";	
 }
 elseif ($type=="lab_unit") {
    $data=array('lab_unit'=>$this->input->post('lab_unit'));
 	 $this->db->where('lab_unit_id',$this->input->post('lab_unit_id'));
   $table="lab_unit";	
 }
		else if($type == 'staff')
		{
			$date = $this->input->post('date_of_birth');
			$date = date("Y-m-d",strtotime($date));
			//echo $date;
			$data = array(
					  'first_name'=>$this->input->post('first_name'),
					  'last_name'=>$this->input->post('last_name'),
					  'gender'=>$this->input->post('gender'),
					  'date_of_birth'=>$date,
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
			$this->db->where('staff_id',$this->input->post('staff_id'));
			$table = 'staff';
		}
		
 		else if($type=='staff_role')
		{
			//cunstructing array for attributes to be updated.
			$data = array(
						'staff_role' => $this->input->post('staff_role'),
						'staff_role_id' => $this->input->post('staff_role_id')
					);
			//setting where condition		
			$this->db->where('staff_role_id',$data['staff_role_id']);
			$table = 'staff_role';
		}
 		
		else if($type=='staff_category')
		{
			//cunstructing array for attributes to be updated.
			$data = array(
						'staff_category_id' => $this->input->post('staff_category_id'),
						'staff_category' => $this->input->post('staff_category')
					);
			//setting where condition		
			$this->db->where('staff_category_id',$data['staff_category_id']);
			$table = 'staff_category';
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
					  'hospital_id'=>$this->input->post('hospital'),
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
			 $binary=0;
			 $numeric=0;
			 $text=0;
				foreach($this->input->post('output_format') as $output_format){
					if($output_format==1){
						$binary=1;
					}
					if($output_format==2){
						$numeric=1;
					}
					if($output_format==3){
						$text=1;
					}
				}
						
			$data=array(
				'group_name'=>$this->input->post('group_name'),
				'test_method_id'=>$this->input->post('test_method'),
				'binary_result'=>$binary,
				'numeric_result'=>$numeric,
				'text_result'=>$text,
				'binary_positive'=>$this->input->post('binary_pos'),
				'binary_negative'=>$this->input->post('binary_neg'),
				'numeric_result_unit'=>$this->input->post('numeric_result_unit')
			);
			$this->db->trans_start();
			$this->db->insert('test_group',$data);
			$group_id = $this->db->insert_id();
			$data=array();
			foreach($this->input->post('test_name') as $test_name){
				$data[]=array(
					'test_master_id'=>$test_name,
					'group_id'=>$group_id
				);
			}
			$this->db->insert_batch('test_group_link',$data);
			$this->db->trans_complete();
			
			if($this->db->trans_status()===FALSE){
				$this->db->trans_rollback();
				return false;
			}	
			else return true;
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
			 $binary=0;
			 $numeric=0;
			 $text=0;
				foreach($this->input->post('output_format') as $output_format){
					if($output_format==1){
						$binary=1;
					}
					if($output_format==2){
						$numeric=1;
					}
					if($output_format==3){
						$text=1;
					}
				}
						
			$data=array(
				'test_name'=>$this->input->post('test_name'),
				'test_method_id'=>$this->input->post('test_method'),
				'test_area_id'=>$this->input->post('test_area'),
				'binary_result'=>$binary,
				'numeric_result'=>$numeric,
				'text_result'=>$text,
				'binary_positive'=>$this->input->post('binary_pos'),
				'binary_negative'=>$this->input->post('binary_neg'),
				'numeric_result_unit'=>$this->input->post('numeric_result_unit')
			);
			$table="test_master";	
		}
		elseif ($type=="test_area") {
			$data=array('test_area'=>$this->input->post('test_area'));
			$table="test_area";
		}
		elseif ($type=="antibiotic") {
			$data=array('antibiotic'=>$this->input->post('antibiotic'));
		$table="antibiotic";
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
		elseif ($type=="lab_unit") {
			$data=array('lab_unit'=>$this->input->post('lab_unit'));
		$table="lab_unit";
		}
		
		if($type=="area_types"){
		$data = array(
					  'area_type'=>$this->input->post('area_type')
			);

		$table="area_types";
		}
		elseif($type=="area_activity"){
		$data = array(
					  'activity_name'=>$this->input->post('activity_name'),
					 'frequency'=>$this->input->post('frequency'),
					   'weightage'=>$this->input->post('weightage'),
					   'area_type_id'=>$this->input->post('area_type'),
					   'frequency_type'=>$this->input->post('frequency_type')
			);

		$table="area_activity";
		}
		elseif($type=="activity_done"){
		$data = array(
					  'date'=>date("Y-m-d",strtotime($this->input->post('date'))),
					 'time'=>$this->input->post('time'),
					 'staff_id'=>$this->input->post('staff'),
					  'activity_id'=>$this->input->post('activity_name'));

		$table="activity_done";
		}
		elseif($type=="department"){
		$data = array(
					  'department'=>$this->input->post('department_name'),
					  'hospital_id'=>$this->input->post('hospital'));

		$table="department";
		}
		elseif($type=="districts"){
		$data = array(
					  'district'=>$this->input->post('district'),
					 'state_id'=>$this->input->post('states'),
					   'longitude'=>$this->input->post('longitude'),
					   'latitude'=>$this->input->post('latitude')
			);

		$table="district";
		}
		elseif($type=="hospital"){
		$data = array(
					  'hospital'=>$this->input->post('hospital_name'),
					 'hospital_type_id'=>$this->input->post('facility_type'),
					   'place'=>$this->input->post('address'),
					   'village_town_id'=>$this->input->post('village_town')
			);

		$table="hospital";
		}
		elseif($type=="facility_activity"){
			$this->db->select('frequency')->from('area_activity')->where('area_activity_id',$this->input->post('area_activity'));
			$query=$this->db->get();
			$result=$query->row();
			$frequency=$result->frequency;
			$data=array();
			for($i=0;$i<$frequency;$i++){
				$data[] = array(
						'facility_area_id'=>$this->input->post('area'),
						'area_activity_id'=>$this->input->post('area_activity')
					);
			}
			$this->db->trans_start();
			$this->db->insert_batch('facility_activity',$data);
			$this->db->trans_complete();
			if($this->db->trans_status()===FALSE)
				return false;
			else return true;
		}
		
		
		
		elseif($type=="facility_type"){
		$data = array(
					  'facility_type'=>$this->input->post('facility_type')
			);

		$table="facility_type";
		}
		
		elseif($type=="area"){
		$data = array(
					  'area_name'=>$this->input->post('area_name'),
					   'department_id'=>$this->input->post('department'),
					   'area_type_id'=>$this->input->post('area_type')
			);

		$table="area";
		}
		elseif($type=="states"){
		$data = array(
					  'state'=>$this->input->post('state'),
					   'longitude'=>$this->input->post('longitude'),
					   'latitude'=>$this->input->post('latitude')
			);

		$table="states";
		}
		elseif($type=="vendor"){
		$data = array(
					  'vendor_name'=>$this->input->post('vendor_name'),
					   'vendor_address'=>$this->input->post('vendor_address'),
					  'contact_name'=>$this->input->post('contact_name'),
					  'contact_number'=>$this->input->post('contact_number'),
					  'contact_email'=>$this->input->post('contact_email'),
			);

		$table="vendor";
		}
		elseif($type=="vendor_contracts"){
		$data = array(
					  'vendor_name'=>$this->input->post('vendor_name'),
					   'facility_name'=>$this->input->post('facility_name'),
					  'form_date'=>$this->input->post('form_date'),
					  'to_date'=>$this->input->post('to_date'),
					  'status'=>$this->input->post('status'),
			);

		$table="vendor_contracts";
		}
		elseif($type=="village_town"){
		$data = array(
					  'village_town'=>$this->input->post('village_town'),
					   'district_id'=>$this->input->post('district'),
					  'pin_code'=>$this->input->post('pin_code'),
					  'longitude'=>$this->input->post('longitude'),
					  'latitude'=>$this->input->post('latitude'),
			);

		$table="village_town";
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
