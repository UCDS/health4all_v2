<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.css">
<style>
	.row{
		margin-bottom: 1.5em;
	}
	.alt{
		margin-bottom:0;
		padding:0.5em;
	}
	.alt:nth-child(odd){
		background:#eee;
	}
		.selectize-control.repositories .selectize-dropdown > div {
			border-bottom: 1px solid rgba(0,0,0,0.05);
		}
		.selectize-control.repositories .selectize-dropdown .by {
			font-size: 11px;
			opacity: 0.8;
		}
		.selectize-control.repositories .selectize-dropdown .by::before {
			content: 'by ';
		}
		.selectize-control.repositories .selectize-dropdown .name {
			font-weight: bold;
			margin-right: 5px;
		}
		.selectize-control.repositories .selectize-dropdown .title {
			display: block;
		}
		.selectize-control.repositories .selectize-dropdown .description {
			font-size: 12px;
			display: block;
			color: #a0a0a0;
			white-space: nowrap;
			width: 100%;
			text-overflow: ellipsis;
			overflow: hidden;
		}
		.selectize-control.repositories .selectize-dropdown .meta {
			list-style: none;
			margin: 0;
			padding: 0;
			font-size: 10px;
		}
		.selectize-control.repositories .selectize-dropdown .meta li {
			margin: 0;
			padding: 0;
			display: inline;
			margin-right: 10px;
		}
		.selectize-control.repositories .selectize-dropdown .meta li span {
			font-weight: bold;
		}
		.selectize-control.repositories::before {
			-moz-transition: opacity 0.2s;
			-webkit-transition: opacity 0.2s;
			transition: opacity 0.2s;
			content: ' ';
			z-index: 2;
			position: absolute;
			display: block;
			top: 12px;
			right: 34px;
			width: 16px;
			height: 16px;
			background: url(<?php echo base_url();?>assets/images/spinner.gif);
			background-size: 16px 16px;
			opacity: 0;
		}
		.selectize-control.repositories.loading::before {
			opacity: 0.4;
		}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.selectize.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".date").Zebra_DatePicker();
	$(".time").timeEntry();
	$("#from_date,#to_date").Zebra_DatePicker();
});
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

	<div class="row">
		<div class="panel panel-default">
		<div class="panel-heading">
		<h4>Search Patients</h4>	
		</div>
		<div class="panel-body">
		<?php echo form_open("register/update_patients",array('role'=>'form','class'=>'form-custom')); ?>
					<div class="row">
					<div class="col-md-12 col-xs-12">
						<div class="form-group">
						<label class="control-label">Year</label>
						<select class="form-control" name="search_year">
							<?php 
								$i=2013;
								$year = date("Y");
								while($year>=$i){ ?>
								<option value="<?php echo $year;?>"><?php echo $year--;?></option>
							<?php
								}
							?>
						</select>
						</div>
						<div class="form-group">
							<label class="control-label">Visit Type</label>
							<select class="form-control" name="search_visit_type">
								<option value=''>All</option>
								<option value='IP'>IP</option>
								<option value='OP'>OP</option>
							</select>
						<label class="control-label">IP/OP Number</label>
						<input type="text" name="search_patient_number" size="5" class="form-control" />
						</div>
						<div class="form-group">
						<label class="control-label">Patient Name</label>
						<input type="text" name="search_patient_name" class="form-control" />
						</div>
						<div class="form-group">
						<label class="control-label">Phone Number</label>
						<input type="text" name="search_phone" class="form-control" />
						</div>
					</div>
				</div>
		</div>
		<div class="panel-footer">
			<div class="text-center">
			<input class="btn btn-sm btn-primary" name="search_patients" type="submit" value="Submit" />
			</div>
			</form>
		</div>
		</div>
	</div>
	<br />
	<?php if(isset($patients) && count($patients)>1){ ?>
	<table class="table table-bordered table-hover table-striped" id="table-sort">
	<thead>
		<th style="text-align:center">#</th>
		<th style="text-align:center">IP/OP No.</th>
		<th style="text-align:center">Patient</th>
		<th style="text-align:center">Admit Date</th>
		<th style="text-align:center">Department</th>
		<th style="text-align:center">Phone</th>
		<th style="text-align:center">Parent/Spouse</th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($patients as $p){
		$age="";
		if($p->age_years!=0) $age.=$p->age_years."Y ";
		if($p->age_months!=0) $age.=$p->age_months."M ";
		if($p->age_days!=0) $age.=$p->age_days."D ";
		if($p->age_days==0 && $p->age_months == 0 && $p->age_years == 0) $age.="0D ";
	?>
	<tr onclick="$('#select_patient_<?php echo $p->visit_id;?>').submit()" style="cursor:pointer">
		<td>
			<?php echo form_open('register/update_patients',array('role'=>'form','id'=>'select_patient_'.$p->visit_id));?>
			<input type="text" class="sr-only" hidden value="<?php echo $p->visit_id;?>" form="select_patient_<?php echo $p->visit_id;?>" name="selected_patient" />
			</form>
			<?php echo $i++;?>
		</td>
		<td><?php echo $p->visit_type." #".$p->hosp_file_no;?></td>
		<td><?php echo $p->first_name." ".$p->last_name." | ".$age." | ".$p->gender;?></td>
		<td><?php echo date("d-M-Y",strtotime($p->admit_date));?></td>
		<td><?php echo $p->department;?></td>
		<td><?php echo $p->phone;?></td>
		<td><?php echo $p->parent_spouse;?></td>
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>
	<?php } 
	else if(isset($patients) && count($patients)==1){ ?>
	<?php if(isset($msg)) { ?>
		<div class="alert alert-info"><?php echo $msg;?></div>
	<?php } ?>
	<?php echo form_open('register/update_patients',array('class'=>'form-custom','role'=>'form')); ?>
	<div class="panel panel-default">
	<div class="panel-body">
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Update Patients") { ?>
					<li role="presentation" class="active"><a href="#patient" aria-controls="patient" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Patient Info</a></li>
				<?php 
				break;
				} 
			}
		?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Clinical" && ($f->add==1 || $f->edit==1)) { ?>
					<li role="presentation"><a href="#clinical" aria-controls="clinical" role="tab" data-toggle="tab"><i class="fa fa-stethoscope"></i>Clinical</a></li>
				<?php 
				break;
				 } 
			}
		?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "View Diagnostics") { ?>
					<li role="presentation"><a href="#diagnostics" aria-controls="diagnostics" role="tab" data-toggle="tab"><i class="glyph-icon flaticon-chemistry20"></i> Diagnostics</a></li>
				<?php 
				break;
				 } 
			}
		?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Procedures" && ($f->add==1 || $f->edit==1)) { ?>
					<li role="presentation"><a href="#procedures" aria-controls="procedures" role="tab" data-toggle="tab"><i class="fa fa-scissors"></i> Procedures</a></li>
				<?php 
				break;
				 } 
			}
		?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Prescription" && ($f->add==1 || $f->edit==1)) { ?>
					<li role="presentation"><a href="#prescription" aria-controls="prescription" role="tab" data-toggle="tab"><i class="glyph-icon flaticon-drugs5"></i> Prescription</a></li>
				<?php 
				break;
				 } 
			}
		?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Discharge" && ($f->add==1 || $f->edit==1)) { ?>
					<li role="presentation"><a href="#discharge" aria-controls="discharge" role="tab" data-toggle="tab"><i class="fa fa-sign-out"></i> Discharge</a></li>
				<?php 
				break;
				 } 
			}
		?>
	  </ul>
	  <!-- Tab panes -->
	  <div class="tab-content">
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Update Patients") { ?>
		<div role="tabpanel" class="tab-pane active" id="patient">
			<?php
				$patient = $patients[0];
				$age="";
				if($patient->age_years!=0) $age.=$patient->age_years."Y ";
				if($patient->age_months!=0) $age.=$patient->age_months."M ";
				if($patient->age_days!=0) $age.=$patient->age_days."D ";
				if($patient->age_days==0 && $patient->age_months ==0 && $patient->age_years==0) $age.="0D ";
			?>
			

		<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute;display:none"></iframe>
		<div class="sr-only" id="print-div" style="width:100%;height:100%;"> 
		<?php $this->load->view('pages/print_layouts/patient_summary');?>
		</div>
			<div class="row alt">
			<div class="col-md-4 col-xs-6">
				<b><?php echo $patient->visit_type; ?> Number: </b><?php echo $patient->hosp_file_no;?>
			</div>
			<div class="col-md-4 col-xs-6">
				<b><?php if( $patient->visit_type == "IP") echo "Admit Date:"; else echo "Visit Date:";?></b>
				<?php echo date("d-M-Y", strtotime($patient->admit_date)).", ".date("g:ia", strtotime($patient->admit_time));?>
			</div>
			</div>
			<div class="row alt">
			<div class="col-md-4 col-xs-6">
				<label class="control-label">First Name
				<input type="text" name="first_name" class="form-control" placeholder="First" value="<?php if($patient) echo $patient->first_name;?>" required />
				</label>
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Last Name
				<input type="text" name="last_name" class="form-control" placeholder="Last" value="<?php  if($patient) echo $patient->last_name;?>" />
				</label>
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Age</label>
				<input type="text" name="age_years" class="form-control" size="1"  value="<?php if($patient)  echo $patient->age_years;?>" />Y
				<input type="text" name="age_months" class="form-control" size="1" value="<?php if($patient)  echo $patient->age_months;?>" />M
				<input type="text" name="age_days" class="form-control" size="1"  value="<?php if($patient)  echo $patient->age_days;?>" />D
			</div>
			</div>
			<div class="row alt">
			<div class="col-md-4 col-xs-6">
				<label class="control-label"><input type="radio" class="gender" value="M" name="gender" <?php if($patient)  if($patient->gender=="M") echo " checked ";?> required />Male</label>
				<label class="control-label"><input type="radio" class="gender" value="F" name="gender" <?php if($patient)  if($patient->gender=="F") echo " checked ";?> required />Female</label>
				<label class="control-label"><input type="radio" class="gender" value="O" name="gender" <?php if($patient)  if($patient->gender=="O") echo " checked ";?> required />Others</label>
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Department<span class="mandatory" >*</span></label>
				<select name="department" class="form-control department" id="department" required >
				<option value="">--Select--</option>
				<?php 
				foreach($all_departments as $department){
					echo "<option value='".$department->department_id."'";
						if($department->department_id==$patient->department_id) echo " selected ";
					echo ">".$department->department."</option>";
				}
				?>
				</select>
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Unit</label>
				<select name="unit" id="unit" class="form-control unit" >
				<option value="">--Select--</option>
				<?php 
				foreach($units as $unit){
					echo "<option value='".$unit->unit_id."' class='".$unit->department_id."'";
					if($unit->unit_id==$patient->unit_id) echo " selected ";
					echo ">".$unit->unit_name."</option>";
				}
				?>
				</select>
			</div>
			</div>
			<div class="row alt">
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Area</label>
				<select name="area" id="area" class="form-control area" >
				<option value="">--Select--</option>
				<?php 
				foreach($areas as $area){
					echo "<option value='".$area->area_id."' class='".$area->department_id."'";
					if($area->area_id==$patient->area_id) echo " selected ";
					echo ">".$area->area_name."</option>";
				}
				?>
				</select>
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Father's Name</label>
				<input type="text" name="father_name" class="form-control" value="<?php if($patient) echo $patient->father_name;?>" />				
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Mother's Name</label>
				<input type="text" name="mother_name" class="form-control" value="<?php if($patient) echo $patient->mother_name;?>" />				
			</div>
			</div>
			<div class="row alt">
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Spouse Name</label>
				<input type="text" name="spouse_name" class="form-control" value="<?php if($patient) echo $patient->spouse_name;?>" />				
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Address <span class="mandatory" >*</span></label>
				<input type="text" name="address" class="form-control" value="<?php if($patient) echo $patient->address;?>" required />
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Place</label>
				<input type="text" name="place" class="form-control" value="<?php if($patient) echo $patient->place;?>"/>
			</div>
			</div>
			<div class="row alt">
			<div class="col-md-4 col-xs-6">
				<label class="control-label">District<span class="mandatory" >*</span></label>
				<select name="district" class="form-control" required>
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
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Phone<span class="mandatory" >*</span></label>
				<input type="text" name="phone" class="form-control" value="<?php if($patient) echo $patient->phone;?>" required />
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">MLC</label>
				<label class="control-label"><input type="radio" value="1" class="mlc" name="mlc" <?php  if($patient->mlc==1) echo " checked ";?> required />Yes</label>
				<label class="control-label"><input type="radio" value="0" class="mlc" name="mlc" <?php if($patient->mlc==0) echo " checked ";?> required />No</label>
				<span class="mandatory">*</span>
			</div>
				<div class="col-md-4 col-xs-6"	<?php if(!$patient->mlc){ echo " hidden "; } ?>>
					<label class="control-label">MLC Number</label>
					<input type="text" name="mlc_number" class="form-control mlc" value="<?php echo $patient->mlc_number;?>" />
				</div>
				<div class="col-md-4 col-xs-6"	<?php if(!$patient->mlc){ echo " hidden "; } ?>>
					<label class="control-label">PS Name</label>
					<input type="text" name="ps_name" class="form-control mlc" value="<?php echo $patient->ps_name;?>" />
				</div>
			</div>
			<div class="row alt">
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Id Proof Type</label>
				<select name="id_proof_type" class="form-control">
				<option value="">--Select--</option>
				<?php 
				foreach($id_proof_types as $id_proof_type){
					echo "<option value='".$id_proof_type->id_proof_type_id."'";
					if($patient) if($id_proof_type->id_proof_type_id==$patient->id_proof_type_id) echo " selected ";
					echo ">".$id_proof_type->id_proof_type."</option>";
				}
				?>
				</select>
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Id Proof No</label>
				<input type="text" name="id_proof_no" id="id_proof_no" class="form-control" value="<?php if($patient) echo $patient->id_proof_number;?>" />				
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Occupation</label>
				<select name="occupation" class="form-control">
				<option value="">--Select--</option>
				<?php 
				foreach($occupations as $occupation){
					echo "<option value='".$occupation->occupation_id."'";
					if($patient) if($occupation->occupation_id==$patient->occupation_id) echo " selected ";
					echo ">".$occupation->occupation."</option>";
				}
				?>
				</select>
			</div>
			</div>
		</div>
		<?php 
				break;
				 }}?>
		
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Clinical" && ($f->add==1 || $f->edit==1)) { ?>
		<div role="tabpanel" class="tab-pane" id="clinical">
			<div class="row alt">
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Admit Weight</label>
					<input type="text" name="admit_weight" class="form-control" value="<?php if(!!$patient->admit_weight) echo $patient->admit_weight;?>"  />
				</div>
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Pulse Rate</label>
					<input type="text" name="pulse_rate" class="form-control pulse_rate" value="<?php if(!!$patient->pulse_rate)  echo $patient->pulse_rate;?>"  />
				</div>
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Temperature</label>
					<input type="text" name="temperature" class="form-control" value="<?php if(!!$patient->temperature)  echo $patient->temperature;?>" />
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Blood Group</label>
					<select name="blood_group" class="form-control">
						<option value="">--Select--</option> 
						<option value="A+" <?php if($patient->blood_group == "A+") echo " selected ";?>>A+</option>
						<option value="A-" <?php if($patient->blood_group == "A-") echo " selected ";?>>A-</option>
						<option value="B+" <?php if($patient->blood_group == "B+") echo " selected ";?>>B+</option>
						<option value="B-" <?php if($patient->blood_group == "B-") echo " selected ";?>>B-</option>
						<option value="AB+" <?php if($patient->blood_group == "AB+") echo " selected ";?>>AB+</option>
						<option value="AB-" <?php if($patient->blood_group == "AB-") echo " selected ";?>>AB-</option>
						<option value="O+" <?php if($patient->blood_group == "O+") echo " selected ";?>>O+</option>
						<option value="O-" <?php if($patient->blood_group == "O-") echo " selected ";?>>O-</option>
					</select>
				</div>
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Blood Pressure</label>
					<input type="text" name="sbp" style="width:50px" class="form-control blood_pressure" value="<?php if(!!$patient->sbp) echo $patient->sbp;?>" />/
					<input type="text" name="dbp"  style="width:50px" class="form-control blood_pressure" value="<?php if(!!$patient->dbp) echo $patient->dbp;?>"  />
				</div>
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Respiratory Rate</label>
					<input type="text" name="respiratory_rate" class="form-control mlc" value="<?php if(!!$patient->respiratory_rate) echo $patient->respiratory_rate;?>" />
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						Symptoms
					</label>
					<textarea name="presenting_complaints" cols="60" class="form-control" placeholder="Symptoms/ Presenting Complaints"><?php echo $patient->presenting_complaints;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						Past History
					</label>
					<textarea name="past_history" cols="60" class="form-control" placeholder="Past History"><?php echo $patient->past_history;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						Family History
					</label>
					<textarea name="family_history" cols="60" class="form-control" placeholder="Family History"><?php echo $patient->family_history;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						Clinical Findings
					</label>
					<textarea name="clinical_findings" cols="60" class="form-control" placeholder="Clinical Findings"><?php echo $patient->clinical_findings;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						CVS
					</label>
					<textarea name="cvs" cols="60" class="form-control" placeholder="CVS"><?php echo $patient->cvs;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						RS
					</label>
					<textarea name="rs" cols="40" class="form-control" placeholder="RS" ><?php echo $patient->rs;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						PA
					</label>
					<textarea name="pa" cols="60" class="form-control" placeholder="PA"><?php echo $patient->pa;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						CNS
					</label>
					<textarea name="cns" cols="40" class="form-control" placeholder="CNS"><?php echo $patient->cns;?></textarea>
				</div>
			</div>
		</div>
		<?php 
				break;
				 } } ?>
		
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "View Diagnostics") { ?>
		<div role="tabpanel" class="tab-pane" id="diagnostics">
			
			<?php 
			if(isset($tests) && count($tests)>0){ ?>
				<table class="table table-bordered table-striped table-hover" id="table-sort">
				<thead>
					<th style="width:3em">#</th>
					<th style="width:10em">Order ID</th>
					<th style="width:10em">Order Date</th>
					<th style="width:10em">Specimen</th>
					<th style="width:12em">Test</th>
					<th style="width:10em">Value</th>
					<th style="width:5em">Report - Binary</th>
					<th style="width:10em">Report</th>
				</thead>
				<tbody>
					<?php 
					$o=array();
					foreach($tests as $order){
						$o[]=$order->order_id;
					}
					$o=array_unique($o);
					$i=1;
					foreach($o as $ord){	?>
						<?php
						foreach($tests as $order) { 
							if($order->order_id == $ord) { ?>
						<tr <?php if($order->test_status == 2) { ?> onclick="$('#order_<?php echo $ord;?>').submit()" <?php } ?>>
								<td><?php echo $i++;?></td>
								<td>
									<?php echo form_open("diagnostics/view_results",array('role'=>'form','class'=>'form-custom','id'=>'order_'.$order->order_id)); ?>
									<?php echo $order->order_id;?>
									<input type="hidden" class="sr-only" name="order_id" value="<?php echo $order->order_id;?>" />
									</form>
								</td>
								<td>
									<?php echo date("d-M-Y",strtotime($order->order_date_time));?>
								</td>
								<td><?php echo $order->specimen_type;?></td>
								<td>
								<?php
													if($order->test_status==1){
														$label="label-warning"; $status="Completed"; }
													else if($order->test_status == 2){ $label = "label-success"; $status = "Approved"; }
													else if($order->test_status == 0){ $label = "label-default"; $status = "Ordered"; }
													echo '<label class="label '.$label.'" title="'.$status.'">'.$order->test_name."</label><br />";									
									?>
								</td>
								<td>
									<?php if($order->test_status==2 && $order->numeric_result == 1) echo $order->test_result." ".$order->lab_unit; else echo "NA";?>
								</td>
								<td>
									<?php if($order->test_status==2 && $order->binary_result == 1) echo $order->test_result_binary; else echo "NA";?>
								</td>
								<td>
									<?php if($order->test_status==2 && $order->text_result == 1) echo $order->test_result_text; else echo "NA";?>
								</td>
						</tr>
						<?php
						}
						} ?>
					<?php } ?>
				</tbody>
				</table>
				
			<?php } else { ?>
			No tests on the given date.
			<?php } ?>
		</div>
		<?php 
				break;
				 } }?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Procedures" && ($f->add==1 || $f->edit==1)) { ?>
		<div role="tabpanel" class="tab-pane" id="procedures">
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Procedure</label>
				</div>
				<div class="col-md-8">
					<select name="procedure" class="form-control">
					<option value="" selected>--SELECT--</option>
					<?php foreach($procedures as $procedure){ ?>
						<option value="<?php echo $procedure->procedure_id;?>"><?php echo $procedure->procedure_name;?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Date, Time</label>
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control date" name="procedure_date" />
					<input type="text" class="form-control time" name="procedure_time" />
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Duration</label>
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="procedure_duration" />
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Notes</label>
				</div>
				<div class="col-md-8">
					<textarea type="text" class="form-control" name="procedure_note"></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Findings</label>
				</div>
				<div class="col-md-8">
					<textarea type="text" class="form-control" name="procedure_findings"></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Post Procedure Notes</label>
				</div>
				<div class="col-md-8">
					<textarea type="text" class="form-control" name="post_procedure_notes"></textarea>
				</div>
			</div>
			<?php 
			if(isset($tests) && count($tests)>0){ ?>
				<table class="table table-bordered table-striped table-hover" id="table-sort">
				<thead>
					<th style="width:3em">#</th>
					<th style="width:10em">Order ID</th>
					<th style="width:10em">Order Date</th>
					<th style="width:10em">Specimen</th>
					<th style="width:12em">Test</th>
					<th style="width:10em">Value</th>
					<th style="width:5em">Report - Binary</th>
					<th style="width:10em">Report</th>
				</thead>
				<tbody>
					<?php 
					$o=array();
					foreach($tests as $order){
						$o[]=$order->order_id;
					}
					$o=array_unique($o);
					$i=1;
					foreach($o as $ord){	?>
						<?php
						foreach($tests as $order) { 
							if($order->order_id == $ord) { ?>
						<tr <?php if($order->test_status == 2) { ?> onclick="$('#order_<?php echo $ord;?>').submit()" <?php } ?>>
								<td><?php echo $i++;?></td>
								<td>
									<?php echo form_open("diagnostics/view_results",array('role'=>'form','class'=>'form-custom','id'=>'order_'.$order->order_id)); ?>
									<?php echo $order->order_id;?>
									<input type="hidden" class="sr-only" name="order_id" value="<?php echo $order->order_id;?>" />
									</form>
								</td>
								<td>
									<?php echo date("d-M-Y",strtotime($order->order_date_time));?>
								</td>
								<td><?php echo $order->specimen_type;?></td>
								<td>
								<?php
													if($order->test_status==1){
													$label="label-warning"; $status="Completed"; }
													else if($order->test_status == 2){ $label = "label-success"; $status = "Approved"; }
													else if($order->test_status == 0){ $label = "label-default"; $status = "Ordered"; }
													echo '<label class="label '.$label.'" title="'.$status.'">'.$order->test_name."</label><br />";									
								?>
								</td>
								<td>
									<?php if($order->test_status==2 && $order->numeric_result == 1) echo $order->test_result." ".$order->lab_unit; else echo "NA";?>
								</td>
								<td>
									<?php if($order->test_status==2 && $order->binary_result == 1) echo $order->test_result_binary; else echo "NA";?>
								</td>
								<td>
									<?php if($order->test_status==2 && $order->text_result == 1) echo $order->test_result_text; else echo "NA";?>
								</td>
						</tr>
						<?php
						}
						} ?>
					<?php } ?>
				</tbody>
				</table>
				
			<?php } ?>
		</div>
		<?php  
				break;
				} }?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Prescription" && ($f->add==1 || $f->edit==1)) { ?>
		<div role="tabpanel" class="tab-pane" id="prescription">
			<div class="row">
			<div class="col-md-12 alt">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
						<th rowspan="3" class="text-center">Drug</th>
						<th rowspan="3" class="text-center">Duration (in Days)</th>
						<th rowspan="3" class="text-center">Frequency</th>
						<th colspan="6" class="text-center">Timings</th>
						<th rowspan="3" class="text-center">Quantity</th>
						<th rowspan="3" class="text-center">Unit</th>
						</tr>
						<tr>
							<th colspan="2" class="text-center">Morning</th>
							<th colspan="2" class="text-center">Afternoon</th>
							<th colspan="2" class="text-center">Evening</th>
						</tr>
						<tr>
							<th>BB</th>
							<th>AB</th>
							<th>BL</th>
							<th>AL</th>
							<th>BD</th>
							<th>AD</th>
						</tr>
					</thead>
					<tbody>
						<tr class="prescription">
							<td>
								<select name="drug_0" class="form-control">
								<option value="">--Select--</option>
								<?php 
								foreach($drugs as $drug){
									echo "<option value='".$drug->item_id."'>".$drug->item_name."</option>";
								}
								?>
								</select>
							</td>
							<td>
								<input type="text" name="duration_0" placeholder="in Days" style="width:100px" class="form-control" />
							</td>
							<td>
								<select name="frequency_0" class="form-control">
									<option value="">Select</option>
									<option value="Daily" selected>Daily</option>
									<option value="Alternate Days">Alternate Days</option>
								</select>
							</td>
							<td>
								<label><input type="checkbox" name="bb_0" value="1" /></label>
							</td>
							<td>
								<label><input type="checkbox" name="ab_0" value="1" /></label>
							</td>
							<td>
								<label><input type="checkbox" name="bl_0" value="1" /></label>
							</td>
							<td>
								<label><input type="checkbox" name="al_0" value="1" /></label>
							</td>
							<td>
								<label><input type="checkbox" name="bd_0" value="1" /></label>
							</td>
							<td>
								<label><input type="checkbox" name="ad_0" value="1" /></label>
							</td>
							<td>
								<input type="text" name="quantity_0" style="width:100px" class="form-control" />
							</td>
							<td>
								<select name="lab_unit_0" class="form-control">
								<option value="">--Select--</option>
								<?php 
								foreach($lab_units as $unit){
									echo "<option value='".$unit->lab_unit_id."'>".$unit->lab_unit."</option>";
								}
								?>
								</select>
								<input type="text" name="prescription[]" class="sr-only" value="0" />
							</td>
							<td>
								<button type="button" class="btn btn-primary btn-sm" id="prescription_add">Add</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			</div>
			<div class="row alt">
				<?php if(isset($prescription) && !!$prescription){ ?>
					<table class="table table-bordered table-striped">
					<thead>
						<tr>
						<th rowspan="3" class="text-center">Drug</th>
						<th rowspan="3" class="text-center">Duration</th>
						<th rowspan="3" class="text-center">Frequency</th>
						<th colspan="6" class="text-center">Timings</th>
						<th rowspan="3" class="text-center">Quantity</th>
						<th rowspan="3" class="text-center"></th>
						</tr>
						<tr>
							<th colspan="2" class="text-center">Morning</th>
							<th colspan="2" class="text-center">Afternoon</th>
							<th colspan="2" class="text-center">Evening</th>
						</tr>
						<tr>
							<th>BB</th>
							<th>AB</th>
							<th>BL</th>
							<th>AL</th>
							<th>BD</th>
							<th>AD</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($prescription as $pres){ ?>
					<tr>
						<td><?php echo $pres->item_name;?></td>
						<td><?php echo $pres->duration;?></td>
						<td><?php echo $pres->frequency;?></td>
						<td><?php if($pres->morning == 1 || $pres->morning == 3) echo "<i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->morning == 2 || $pres->morning == 3) echo " <i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->afternoon == 1 || $pres->afternoon == 3) echo "<i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->afternoon == 2 || $pres->afternoon == 3) echo "<i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->evening == 1 || $pres->evening == 3) echo "<i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->evening == 2 || $pres->evening == 3) echo "<i class='fa fa-check'></i>";?></td>
						<td><?php echo $pres->quantity;?> <?php echo $pres->lab_unit;?></td>
						<td>
							<?php echo form_open('register/update_patients',array('class'=>'form-custom'));?>
							<input type="text" class="sr-only" value="<?php echo $pres->prescription_id;?>" name="prescription_id" hidden />
							<input type="text" class="sr-only" value="<?php echo $pres->visit_id;?>" name="visit_id" hidden />
							<button type="submit" id="remove_prescription" class="btn btn-danger btn-sm">X</button>
							</form>
						</td>
					</tr>
					<?php } ?>
					</tbody>
				</table>
			<?php } ?>
			</div>
		</div>
		<?php 
				break;
				 }} ?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Discharge" && ($f->add==1 || $f->edit==1)) { ?>
		<div role="tabpanel" class="tab-pane" id="discharge">
			<div class="row">
			<div class="col-md-12 alt">
				<div class="col-md-2">
				<label class="control-label">Outcome</label>
				</div>
				<div class="col-md-8">
				<label><input type="radio" value="Discharge" name="outcome" <?php if(!!$patient->outcome) if($patient->outcome=="Discharge") echo " checked ";?> />Discharge</label>
				<label><input type="radio" value="LAMA" name="outcome" <?php if(!!$patient->outcome) if($patient->outcome=="LAMA") echo " checked ";?> />LAMA</label>
				<label><input type="radio" value="Absconded" name="outcome" <?php if(!!$patient->outcome) if($patient->outcome=="Absconded") echo " checked ";?>  />Absconded</label>
				<label><input type="radio" value="Death" name="outcome" <?php if(!!$patient->outcome) if($patient->outcome=="Death") echo " checked ";?> />Death</label>
				</div>
			</div>
			<div class="col-md-12 alt">
				<div class="col-md-2">
				<script>
				$(function(){
					$(".outcome_date").Zebra_DatePicker({
						direction:[false,'<?php echo date("d-M-Y",strtotime($patient->admit_date));?>']
					});
				});
				</script>
				<label>Outcome Date</label>
				</div>
				<div class="col-md-8">
				<input type="text" name="outcome_date" class="form-control outcome_date" value="<?php if($patient->outcome_date!=0) echo $patient->outcome_date;?>" />
				</div>
			</div>
			<div class="col-md-12 alt">
				<div class="col-md-2">
				<label class="control-label">Outcome Time</label>
				</div>
				<div class="col-md-8">
				<input type="text" name="outcome_time" class="form-control time" value="<?php if($patient->outcome_time != '00:00:00') echo $patient->outcome_time;?>" />
				</div>
			</div>
			<div class="col-md-12 alt ">
				<div class="col-md-2">
				<label class="control-label">Final Diag.</label>
				</div>
				<div class="col-md-8">
				<textarea name="final_diagnosis" class="form-control" cols="40"><?php if(!!$patient->final_diagnosis) echo $patient->final_diagnosis;?></textarea>
				</div>
			</div>
			<div class="col-md-12 alt ">
				<div class="col-md-2">
				<label class="control-label">Decision</label>
				</div>
				<div class="col-md-8">
				<textarea name="decision" class="form-control" cols="40"><?php if(!!$patient->decision) echo $patient->decision;?></textarea>
				</div>
			</div>
			<div class="col-md-12 alt ">
				<div class="col-md-2">
				<label class="control-label">Advise</label>
				</div>
				<div class="col-md-8">
				<textarea name="advise" class="form-control" cols="40"><?php if(!!$patient->advise) echo $patient->advise;?></textarea>
				</div>
			</div>
			<div class="col-md-12 alt">	
				<div class="col-md-2">
					<label>ICD Code</label>
				</div>
				<div class="col-md-8">
					<select id="icd_code" class="repositories" placeholder="Search ICD codes" name="icd_code" >
					<?php if(!!$patient->icd_10){ ?>
						<option value="<?php echo $patient->icd_10;?>"><?php echo $patient->icd_10;?></option>
					<?php } ?>
					</select>
				</div>
				</div>
			</div>
		</div>
		<?php 
				break;
		}} ?>
	  </div>

			<div class="col-md-12 text-center">
				<input type="text" name="visit_id" class="sr-only" value="<?php echo $patient->visit_id;?>" hidden readonly />
				<input type="text" name="patient_id" class="sr-only" value="<?php echo $patient->patient_id;?>" hidden readonly />
				<button class="btn btn-md btn-primary" value="Update" name="update_patient">Update</button>
				<button class="btn btn-md btn-warning" value="Print" type="button" onclick="printDiv('print-div')">Print Summary</button>
			</div>
	</div>
	</div>
	</form>		
	<?php }
	else if(isset($patients)){
		echo "No patients found with the given search terms";
	}
	?>
	</div>
	
<script>
	$(function(){
		selectize = $("#icd_code")[0].selectize;
		selectize.on('change',function(){
			var test = selectize.getOption(selectize.getValue());
			console.log(test);
		});
		$i=1;
		$("#prescription_add").click(function(){
			$row = '<tr class="prescription">'+
						'	<td>'+
								'<select name="drug_'+$i+'" class="form-control">'+
								'<option value="">--Select--</option>'+
								'<?php foreach($drugs as $drug){ echo '<option value="'.$drug->item_id.'">'.$drug->item_name.'</option>';}?>'+
								'</select>'+
							'</td>'+
							'<td>'+
								'<input type="text" name="duration_'+$i+'" placeholder="in Days" style="width:100px" class="form-control" />'+
							'</td>'+
							'<td>'+
								'<select name="frequency_'+$i+'" class="form-control">'+
									'<option value="">Select</option>'+
									'<option value="Daily" selected>Daily</option>'+
									'<option value="Alternate Days">Alternate Days</option>'+
								'</select>'+
							'</td>'+
							'<td>'+
								'<label><input type="checkbox" name="bb_'+$i+'" value="1" /></label>'+
							'</td>'+
							'<td>'+
								'<label><input type="checkbox" name="ab_'+$i+'" value="1" /></label>'+
							'</td>'+
							'<td>'+
								'<label><input type="checkbox" name="bl_'+$i+'" value="1" /></label>'+
							'</td>'+
							'<td>'+
								'<label><input type="checkbox" name="al_'+$i+'" value="1" /></label>'+
							'</td>'+
							'<td>'+
								'<label><input type="checkbox" name="bd_'+$i+'" value="1" /></label>'+
							'</td>'+
							'<td>'+
								'<label><input type="checkbox" name="ad_'+$i+'" value="1" /></label>'+
							'</td>'+
							'<td>'+
								'<input type="text" name="quantity_'+$i+'" style="width:100px" class="form-control" />'+
							'</td>'+
							'<td>'+
								'<select name="lab_unit_'+$i+'" class="form-control">'+
								'<option value="">--Select--</option>'+
								'<?php foreach($lab_units as $unit){ echo '"<option value="'.$unit->lab_unit_id.'">'.$unit->lab_unit.'</option>'; }?>'+
								'</select>'+
							'<input type="text" name="prescription[]" class="sr-only" value="'+$i+'" /></td>'+
							'<td>'+
								'<button type="button" class="btn btn-danger btn-sm" onclick="$(this).parent().parent().remove()">X</button>'+
							'</td>'+
						'</tr>';
			$i++;
			$(".prescription").parent().append($row);
		});
	});
	$('#icd_code').selectize({
    valueField: 'icd_code',
    labelField: 'code_title',
    searchField: 'code_title',
    create: false,
    render: {
        option: function(item, escape) {

            return '<div>' +
                '<span class="title">' +
                    '<span class="icd_code">' + escape(item.code_title) + '</span>' +
                '</span>' +
            '</div>';
        }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
		$.ajax({
            url: '<?php echo base_url();?>register/search_icd_codes',
            type: 'POST',
			dataType : 'JSON',
			data : {query:query},
            error: function(res) {
                callback();
            },
            success: function(res) {
                callback(res.icd_codes.slice(0, 10));
            }
        });
    }
	});
</script>