<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<style>
.mandatory{
	color:red;
	cursor:default;
	font-size:25px;
	font-weight:bold;
}
.form-field{
	min-height:50px;
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".date").Zebra_DatePicker();
	$(".time").timeEntry();
	
	$("#dob").Zebra_DatePicker({
		view:"years",
		direction:false,
		onSelect: function(rdate,ydate,date){
				getAge(date);
		}
	});
	
	$("#spouse_name").prop('disabled',true);
	$(".gender").change(function(){
		if($(this).val()=="M"){
			$("#spouse_name").prop('disabled',true);
		}
		else{
			$("#spouse_name").prop('disabled',false);
		}
	});
	
	$("#department").on('change',function(){
		var department_id=$(this).val();
		$("#unit option,#area option").hide();
		$("#unit option[class="+department_id+"],#area option[class="+department_id+"]").show();
	});
	if($(".mlc:radio").val()==0)
	$(".mlc:text").parent().parent().hide();
	$(".mlc:radio").on('change',function(){
		if($(this).val()==1){
			$(".mlc:text").parent().parent().show();
		}
		else{
			$(".mlc:text").parent().parent().hide();
		}
	});
			
		
});
function DaysInMonth(Y, M) {
    	with (new Date(Y, M, 1, 12)) {
        setDate(0);
        return getDate();
	} 
}	
	
function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    var d = today.getDate() - birthDate.getDate();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--; m += 12;
	}
	if (d < 0) {
        m--;
        d += DaysInMonth(age, m);
    	}
   document.getElementsByName("age_years")[0].value=age;
   document.getElementsByName("age_months")[0].value=m;
   document.getElementsByName("age_days")[0].value=d;
}
<!-- Scripts for printing output table -->
function printDiv(i)
{
var content = document.getElementById(i);
var pri = document.getElementById("ifmcontentstoprint").contentWindow;
pri.document.open();
pri.document.write(content.innerHTML);
pri.document.close();
pri.focus();
pri.print();
}
</script>

		<?php if(isset($registered)){ ?>
		<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute;display:none"></iframe>
		<div class="sr-only" id="print-div" style="width:100%;height:100%;"> 
		<?php $this->load->view($print_layout);?>
		</div>
		<div class="row">
			<div class="panel panel-success col-md-6 col-md-offset-3" >
				<div class="panel-heading">		<h5><?php echo $form_name; ?> - Inserted Successfully</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<tr>
							<th>Patient ID</th>
							<td><?php echo $registered->patient_id;?></td>
							<th><?php echo $form_type;?> No. </th>
							<td><?php echo $registered->hosp_file_no;?></td>
						</tr>
						<tr>
							<th>Patient Name</th>
							<td><?php echo $registered->name;?></td>
							<th>Age</th>
							<td><?php echo $registered->age_years;?></td>
						</tr>
						<tr>
							<th>Gender</th>
							<td><?php echo $registered->gender;?></td>
							<th>Department</th>
							<td><?php echo $registered->department;?></td>
						</tr>
					</table>
				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-primary col-md-offset-5" onclick="printDiv('print-div')"> Print</button>
				</div>
			</div>
			</div>
		<?php } ?>

		<?php 
			if($columns==1){ $class="col-md-12";}
			else if($columns==2){$class="col-md-6";}
			else if($columns==3){$class="col-md-4";}
			$class.=" form-field";
		?>
		<?php echo validation_errors(); ?>
		<?php if($form_type=="OP" || count($patient)>0){ ?>
		<?php echo form_open("register/custom_form/$form_id",array('role'=>'form','class'=>'form-custom')); ?>
		<input type="text" class="sr-only" value="<?php echo $form_type;?>" name="form_type" />
		<div class="row">
		<div class="panel panel-default">
		<div class="panel-heading">
			<div class="pull-right">
				<div class="form-group">
				<?php if($patient){ ?>
				<label class="control-label">Patient ID</label>
				<input type="text" name="patient_id" class="form-control" size="3" value="<?php echo $patient->patient_id;?>" readonly />
				<?php } ?>
				<?php if($form_type=="IP"){ ?>
				<label class="control-label">IP No</label>
				<?php if($update){ ?>
				<input type="text" name="visit_id" class="form-control sr-only" size="3" value="<?php echo $patient->visit_id;?>" readonly />
				<?php } ?>
				<input type="text" name="hosp_file_no" <?php if($update){?> value="<?php echo $patient->hosp_file_no;?>" <?php } ?> class="form-control" size="3" />
				<?php } ?>
				<label class="control-label">Date</label>
				<input type="text" name="date" class="form-control date" value="<?php echo date("d-M-Y");?>" required />
				</div>
				<div class="form-group">
				<label class="control-label">Time</label>
				<input type="text" name="time" class="form-control time" value="<?php echo date("g:iA");?>"  required />
				</div>
			</div>
			<h4><?php echo $form_name; ?></h4>
		</div>
		<div class="panel-body">
			<?php
			foreach($fields as $field=>$mandatory){
				switch($field){
				
					case "first_name": ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">First Name<?php if($mandatory) { ?><span class="mandatory">*</span><?php } ?></label>
						<input type="text" name="first_name" class="form-control" placeholder="First" value="<?php if($patient) echo $patient->first_name;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "last_name": ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Last Name<?php if($mandatory) { ?><span class="mandatory">*</span><?php } ?></label>
						<input type="text" name="last_name" class="form-control" placeholder="Last" value="<?php  if($patient) echo $patient->last_name;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "dob":?>
					
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Birth Date<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="dob" class="form-control" id="dob" value="<?php if($update) echo $patient->dob;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
					
					<div class="<?php echo $class;?> sr-only">
						<div class="form-group">
						<label class="control-label">Age<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="age_years" class="form-control" size="1"  value="<?php if($patient)  echo $patient->age_years;?>" <?php if($mandatory) echo "required"; ?> />Y
						<input type="text" name="age_months" class="form-control" size="1" value="<?php if($patient)  echo $patient->age_months;?>" <?php if($mandatory) echo "required"; ?> />M
						<input type="text" name="age_days" class="form-control" size="1"  value="<?php if($patient)  echo $patient->age_days;?>" <?php if($mandatory) echo "required"; ?> />D
						</div>
					</div>
				<?php 
					break;
					
					case "age":?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Age<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="age_years" class="form-control" size="1"  value="<?php if($patient)  echo $patient->age_years;?>" <?php if($mandatory) echo "required"; ?> />Y
						<input type="text" name="age_months" class="form-control" size="1" tabindex="1000"  value="<?php if($patient)  echo $patient->age_months;?>" <?php if($mandatory) echo "required"; ?> />M
						<input type="text" name="age_days" class="form-control" size="1"  tabindex="1001" value="<?php if($patient)  echo $patient->age_days;?>" <?php if($mandatory) echo "required"; ?> />D
						</div>
					</div>
				<?php 
					break;
					
					case "gender" : ?>
					<div class="<?php echo $class;?>">
						<div class="radio">
						<label class="control-label"><input type="radio" class="gender" value="M" name="gender" <?php if($patient)  if($patient->gender=="M") echo " checked ";?> <?php if($mandatory) echo "required"; ?> />Male</label>
						<label class="control-label"><input type="radio" class="gender" value="F" name="gender" <?php if($patient)  if($patient->gender=="F") echo " checked ";?> <?php if($mandatory) echo "required"; ?> />Female</label>
						<label class="control-label"><input type="radio" class="gender" value="O" name="gender" <?php if($patient)  if($patient->gender=="O") echo " checked ";?> <?php if($mandatory) echo "required"; ?> />Others</label>
						<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?>
						</div>
					</div>
				<?php 
					break;
					
					case "address" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Address<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="address" class="form-control" value="<?php if($patient) echo $patient->address;?>"  <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "place":?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Place<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="place" class="form-control" value="<?php if($patient) echo $patient->place;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "district" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">District<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<select name="district" class="form-control" <?php if($mandatory) echo "required"; ?>>
						<option value="">--Select--</option>
						<?php 
						foreach($districts as $district){
							echo "<option value='".$district->district_id."'";
							if($patient) if($district->district_id==$patient->district_id) echo " selected ";
							echo ">".$district->district."</option>";
						}
						?>
						</select>
						</div>
					</div>
				<?php 
					break;
					
					case "phone" :  ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Phone<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="phone" class="form-control" value="<?php if($patient) echo $patient->phone;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "father_name": ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Father's Name<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="father_name" class="form-control" value="<?php if($patient) echo $patient->father_name;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					case "mother_name" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Mother's Name<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="mother_name" class="form-control" value="<?php if($patient) echo $patient->mother_name;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "spouse_name" :  ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Spouse Name<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="spouse_name" id="spouse_name" class="form-control" value="<?php if($patient) echo $patient->spouse_name;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "presenting_complaints" :  ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Complaints<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="presenting_complaints" class="form-control" value="<?php if($patient) echo $patient->presenting_complaints;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "department" :  ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Department<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<select name="department" class="form-control" id="department"  <?php if($mandatory) echo "required"; ?> >
						<option value="">--Select--</option>
						<?php 
						foreach($departments as $department){
							echo "<option value='".$department->department_id."'";
							if($update) if($department->department_id==$patient->department_id) echo " selected ";
							echo ">".$department->department."</option>";
						}
						?>
						</select>
						</div>
					</div>
				<?php 
					break;
					
					case "unit" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Unit<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<select name="unit" id="unit" class="form-control"  <?php if($mandatory) echo "required"; ?> >
						<option value="">--Select--</option>
						<?php 
						foreach($units as $unit){
							echo "<option value='".$unit->unit_id."' class='".$unit->department_id."'";
							if($update){ if($unit->department_id!=$patient->department_id) echo " hidden ";}
							if($update){ if($unit->unit_id==$patient->unit_id) echo " selected ";} else echo " hidden ";
							echo ">".$unit->unit_name."</option>";
						}
						?>
						</select>
						</div>
					</div>
				<?php 
					break;
					
					
					case "area" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Area<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<select name="area" id="area" class="form-control"  <?php if($mandatory) echo "required"; ?> >
						<option value="">--Select--</option>
						<?php 
						foreach($areas as $area){
							echo "<option value='".$area->area_id."' class='".$area->department_id."'";
							if($update){ if($area->department_id!=$patient->department_id) echo " hidden ";}
							if($update){ if($area->area_id==$patient->area_id) echo " selected ";} else echo " hidden ";
							echo ">".$area->area_name."</option>";
						}
						?>
						</select>
						</div>
					</div>
				<?php 
					break;
					
					case "mlc" : ?>
					<div class="<?php echo $class;?>">
						<div class="radio">
						<label class="control-label">MLC</label>
						<label class="control-label"><input type="radio" value="1" class="mlc" name="mlc" <?php if($update)  if($patient->mlc==1) echo " checked ";?> <?php if($mandatory) echo "required"; ?> />Yes</label>
						<label class="control-label"><input type="radio" value="0" class="mlc" name="mlc" <?php if($update) if($patient->mlc==0) echo " checked ";?>  <?php if($mandatory) echo "required"; ?> />No</label>
						<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?>
						</div>
					</div>
				<?php 
					break;
					
					case "mlc_number" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">MLC Number<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="mlc_number" class="form-control mlc" value="<?php if($update) echo $patient->mlc_number;?>"  <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "ps_name" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">PS Name<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="ps_name" class="form-control mlc" value="<?php if($update) echo $patient->ps_name;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "outcome" : ?>
					<div class="<?php echo $class;?>">
						<div class="radio">
						<label class="control-label">Outcome</label>
						<label class="control-label"><input type="radio" value="Discharge" name="outcome" <?php if($update) if($patient->outcome=="Discharge") echo " checked ";?> <?php if($mandatory) echo "required"; ?> />Discharge</label>
						<label class="control-label"><input type="radio" value="LAMA" name="outcome" <?php if($update) if($patient->outcome=="LAMA") echo " checked ";?> <?php if($mandatory) echo "required"; ?> />LAMA</label>
						<label class="control-label"><input type="radio" value="Absconded" name="outcome" <?php if($update) if($patient->outcome=="Absconded") echo " checked ";?>  <?php if($mandatory) echo "required"; ?> />Absconded</label>
						<label class="control-label"><input type="radio" value="Death" name="outcome" <?php if($update) if($patient->outcome=="Death") echo " checked ";?> <?php if($mandatory) echo "required"; ?> />Death</label>
						<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?>
						</div>
					</div>
				<?php 
					break;
					
					case "outcome_date" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Outcome Date<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="outcome_date" class="form-control date" value="<?php if($update) echo $patient->outcome_date;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "outcome_time" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Outcome Time<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="outcome_time" class="form-control time" value="<?php if($update) echo $patient->outcome_time;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "final_diagnosis" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Final Diag.<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="final_diagnosis" class="form-control" value="<?php if($update) echo $patient->final_diagnosis;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
					
					case "provisional_diagnosis" : ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Provisional Diag.<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="provisional_diagnosis" class="form-control" value="<?php if($update) echo $patient->provisional_diagnosis;?>" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
					break;
				}
			}
			?>
			</div>
			<div class="panel-footer">
				<button class="btn btn-primary btn-lg col-md-offset-5" name="register" value="1" ><?php if($update) echo "Update"; else echo "Submit";?></button>
			</div>
			</div>
		</div>
		</form>	
		<?php } ?>
		<div class="row">
			<?php echo form_open("register/custom_form/$form_id",array('role'=>'form','class'=>'form-custom')); ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					Search for a patient
				</div>
				<div class="panel-body">
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">OP Number</label>
						<input type="text" name="search_op_number" class="form-control" />
						</div>
					</div>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">IP Number</label>
						<input type="text" name="search_ip_number" class="form-control" />
						</div>
					</div>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Patient ID</label>
						<input type="text" name="search_patient_id" class="form-control" />
						</div>
					</div>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Patient Name</label>
						<input type="text" name="search_patient_name" class="form-control" />
						</div>
					</div>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Phone Number</label>
						<input type="text" name="search_phone" class="form-control" />
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-primary btn-sm" name="search_patients" value="1" >Search</button>
				</div>
			</div>
			</form>
			<?php if(isset($patients)){ 
			?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Search Results</h4> | 
							<?php if($this->input->post('search_patient_id')) echo "Patient ID : ".$this->input->post('search_patient_id')." | "; ?>
							<?php if($this->input->post('search_patient_name')) echo "Patient name starting with : ".$this->input->post('search_patient_name')." | "; ?>
							<?php if($this->input->post('search_op_number')) echo "OP Number : ".$this->input->post('search_op_number')." | "; ?>
							<?php if($this->input->post('search_phone')) echo "Phone Number : ".$this->input->post('search_phone')." | "; ?>
						</div>
						<div class="panel-body">
							<?php if(count($patients)>0){ ?>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Visit Type</th>
											<th>Name</th>
											<th>Age</th>
											<th>Sex</th>
											<th>Department</th>
											<th>Date</th>
											<th>Phone</th>
											<th>Parent/Spouse</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										$i=1;
										foreach($patients as $patient){ ?>
										
										
										<tr onclick="$('#form_<?php echo $patient->visit_id;?>').submit()">
											<td>
												<?php echo form_open("register/custom_form/$form_id/$patient->visit_id",array("role"=>"form","id"=>"form_$patient->visit_id"));?>
												<input type="text" class="sr-only" value="1" name="select_patient" />
												<input type="text" class="sr-only" value="<?php echo $patient->visit_type;?>" name="visit_type" />
												</form>
												<?php echo $i++; ?>
											</td>
											<td><?php echo $patient->visit_type; ?></td>
											<td><?php echo $patient->name; ?></td>
											<td>
												<?php 
													if($patient->age_years!=0) echo $patient->age_years."y ";
													if($patient->age_months) echo $patient->age_months."m "; 
													if($patient->age_days) echo $patient->age_days."d "; 
												?>
											</td>
											<td><?php echo $patient->gender;?></td>
											<td><?php echo $patient->department;?></td>
											<td><?php echo date("d-M-Y",strtotime($patient->admit_date));?></td>
											<td><?php echo $patient->phone;?></td>
											<td><?php echo $patient->parent_spouse;?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>	
							<?php }  else echo "No patients matched your search.";?>
							
						</div>
					</div>
				<?php } ?>
				
		</div>