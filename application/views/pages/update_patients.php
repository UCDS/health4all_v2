<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet"  type="text/css" href="<?php echo base_url();?>assets/css/bootstrap_datetimepicker.css"></script>
<style>
    .obstetric_history_table { 
        border-collapse: collapse; 
    }
    .obstetric_history_table tr{
        display: block; float: left;
    }
    .obstetric_history_table td{
        display: block; 
        border: 1px solid black;
        height: 55px;
    }
</style>
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
<script type="text/javascript">
    $(document).ready(function() {
  $("input:radio[name=mlc_radio]").click(function() {
      if($('input[name=mlc_radio]:checked').val()=='-1'){          
          $("#mlc_number_manual").prop("disabled", true);
          $("#ps_name").prop("disabled", true);
          $("#brought_by").prop("disabled", true);
          $("#police_intimation").prop("disabled", true);
          $("#declaration_required").prop("disabled", true);
          $("#pc_number").prop("disabled", true);
      }else if($('input[name=mlc_radio]:checked').val()=='1'){          
          $("#mlc_number_manual").prop("disabled", false);
          $("#ps_name").prop("disabled", false);
          $("#brought_by").prop("disabled", false);
          $("#police_intimation").prop("disabled", false);
          $("#declaration_required").prop("disabled", false);
          $("#pc_number").prop("disabled", false);
      }
   });
   
   $("input:radio[name=insurance_case]").click(function() {
      if($('input[name=insurance_case]:checked').val()==0){
          $("#insurance_id").prop("disabled", true);
          $("#insurance_no").prop("disabled", true);
      }else if($('input[name=insurance_case]:checked').val()==1){
          $("#insurance_id").prop("disabled", false);
          $("#insurance_no").prop("disabled", false);
      }
   });
   var counter = 1;
   $("#add_obstetric_history").click(function(){
    var newRow = document.createElement('tr');
    alert('In add');
    newRow.innerHTML = '<td><input type="text" name="pregnancy_number[]" class="form-control pregnancy_number" id="pregnancy_number" placeholder="Pregnancy Number" /></td>'+
            '<td><input type="text" name="conception_type[]" class="form-control conception_type" id="conception_type" placeholder="Conception Type" /></td>'+
            '<td><input type="radio" name="delivered[]" class="form-control delivered" value="1" id="delivered" />Delivered <input type="radio" name="delivered[]" class="form-control delivered" value="-1" id="delivered" />Abortion'+
            '<td><input type="text" name="imp_date[]" class="form-control imp_date" id="imp_date" style="width:150px" /></td>' +
            '<td><input type="text" name="edd_date[]" class="form-control edd_date'+counter.toString()+'" id="edd_date'+counter.toString()+'" style="width:150px" /></td>' +            
            '<td><input type="text" name="delivery_outcome[]" class="form-control delivery_outcome" id="delivery_outcome" placeholder="Delivery Outcome" /></td>'+
            '<td><input type="radio" name="booked[]" class="form-control booked" value="1" id="booked" />Delivered <input type="radio" name="booked[]" class="form-control booked" value="-1" id="booked" />Abortion</td>' +
            '<td><input type="text" name="delivery_mode[]" class="form-control delivery_mode" id="delivery_mode" placeholder="Delivery Mode" /></td>' +
            '<td><input type="text" name="date_of_birth" class="form-control date_of_birth" id="date_of_birth" style="width:150px" /></td>' +
            '<td><input type="radio" name="gender[]" class="form-control gender" value="2" id="gender" />Male <input type="radio" name="gender[]" class="form-control gender" value="1" id="gender" />Female <input type="radio" name="gender[]" class="form-control gender" value="3" id="gender" />Other </td>' +
            '<td><input type="text" name="weight_at_birth[]" class="form-control weight_at_birth" id="weight_at_birth" placeholder="Weight at birth" /></td>'+
            '<td><input type="text" name="apgar[]" class="form-control apgar" id="apgar" placeholder="APGR" /></td>'+
            '<td><input type="radio" name="nicu_admission[]" class="form-control booked" value="1" id="booked" />Yes <input type="radio" name="nicu_admission[]" class="form-control booked" value="-1" id="booked" />No </td>' +
            '<td><input type="text" name="nicu_admission_reason[]" class="form-control nicu_admission_reason" id="nicu_admission_reason" placeholder="NICU Admission Reason" /></td>' +
            '<td><input type="radio" name="alive[]" class="form-control alive" value="1" id="alive" />Alive <input type="radio" name="alive[]" class="form-control alive" value="-1" id="alive" />Dead </td>' +
            '<td><input type="text" name="date_of_death" class="form-control date_of_death" id="date_of_death" style="width:150px" /></td>'+
            '<td><input type="text" name="cause_of_death[]" class="form-control cause_of_death" id="cause_of_death" placeholder="Cause of death" /></td>';
    $(".edd_date"+counter.toString()).Zebra_DatePicker();
    $('#obstetric_history').append(newRow);    
    counter++;
    document.getElementById('child_count') = counter;
    
   });
   
		$("#transfer_area").chained("#transfer_department");
		$("#from_area").chained("#from_department");
		$("#to_area").chained("#to_department");
});
</script>
<!-- $("#remove_obstetric_history").click(function(){
       alert('In remove');
       var rowCount = $("#obstetric_history").rows.length;
       var row = $("#obstetric_history").rows.[rowCount - 1];
       $("#obstetric_history").deleteRow(row);
   }); -->
<br />
	<?php 
        $pic_set = 1;
        if(isset($patients) && count($patients)>1){ ?>
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
	else if(isset($patients) && count($patients)==1){
            ?>
<?php if(isset($duplicate)) { ?>
		<!-- If duplicate IP no is found then it displays the error message -->
			<div class="alert alert-danger">Entered Patient Manual ID Number already exists.</div>
<?php } ?>
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
				if($f->user_function == "Update Patients"  || $f->user_function == "Clinical" || $f->user_function == "Diagnostics" || $f->user_function == "Procedures" || $f->user_function == "Prescription" || $f->user_function == "Discharge") { ?>
					<li role="presentation" class="active"><a href="#patient" aria-controls="patient" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Patient Info</a></li>
				<?php 
				break;
				} 
			}
		?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Update Patients") { ?>
					<li role="presentation"><a href="#patient_visit" aria-controls="patient_visit" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Patient Visit</a></li>
				<?php 
				break;
				} 
			}
		?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Patient Transport") { ?>
					<li role="presentation"><a href="#patient_transport" aria-controls="patient_transport" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Patient Transport</a></li>
				<?php 
				break;
				} 
			}
		?>
                <?php 
			foreach($functions as $f){ 
				if($f->user_function == "mlc") { ?>
					<li role="presentation"><a href="#mlc" aria-controls="mlc" role="tab" data-toggle="tab"><i class="fa fa-user"></i> MLC Details</a></li>
				<?php 
				break;
				} 
			}
		?>
                       
                <?php 
			foreach($functions as $f){ 
				if($f->user_function == "obg" && ($f->add==1 || $f->edit==1)) { ?>
					<li role="presentation"><a href="#obg" aria-controls="obg" role="tab" data-toggle="tab"><i class="fa fa-stethoscope"></i>OBG</a></li>
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
          <?php
				$patient = $patients[0];
				$age="";
				if($patient->age_years!=0) $age.=$patient->age_years."Y ";
				if($patient->age_months!=0) $age.=$patient->age_months."M ";
				if($patient->age_days!=0) $age.=$patient->age_days."D ";
				if($patient->age_days==0 && $patient->age_months ==0 && $patient->age_years==0) $age.="0D ";
            ?>
	  <!-- Tab panes -->
	  <div class="tab-content">
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Update Patients" || $f->user_function == "Clinical" || $f->user_function == "Diagnostics" || $f->user_function == "Procedures" || $f->user_function == "Prescription" || $f->user_function == "Discharge") { ?>
		<div role="tabpanel" class="tab-pane active" id="patient">			
                <div class="col-md-4 col-lg-3">
                    <div class="well well-sm text-center">
                        <img src="<?php echo base_url()."assets/images/patients/".$patient->patient_id;?>.jpg" alt="Image" style="width:50%;height:50%" onError="this.onerror=null;this.src='<?php echo base_url()."assets/images/patients/default.png";?>';" />
                    </div>
                </div>
		<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute;display:none"></iframe>
		<div class="sr-only" id="print-div" style="width:100%;height:100%;"> 
		<?php $this->load->view('pages/print_layouts/patient_summary');?>
		</div>
                <div class="col-md-8">
			<div class="row alt">
                            <div class="col-md-4 col-xs-12 col-lg-3">
                                <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                            </div>
			<div class="col-md-4 col-xs-12 col-lg-4">
				<b><?php echo $patient->visit_type; ?> Number: </b><?php echo $patient->hosp_file_no;?>
			</div>
			<div class="col-md-4 col-xs-12 col-lg-5">
				<b><?php if( $patient->visit_type == "IP") echo "Admit Date:"; else echo "Visit Date:";?></b>
				<?php echo date("d-M-Y", strtotime($patient->admit_date)).", ".date("g:ia", strtotime($patient->admit_time));?>
			</div>
			</div>
			<div class="row alt">
                        <div class="col-md-4 col-xs-12 col-lg-4">
				<label class="control-label">Patient ID Manual
				<input type="text" name="patient_id_manual" class="form-control" placeholder="Patient ID Manual" value="<?php if($patient) echo $patient->patient_id_manual;?>" <?php if($f->edit==1 && empty($patient->patient_id_manual)) echo ''; else echo ' readonly'; ?> />
				</label>
			</div>
			<div class="col-md-4 col-xs-12 col-lg-4">
				<label class="control-label">First Name
				<input type="text" name="first_name" class="form-control" placeholder="First" value="<?php if($patient) echo $patient->first_name;?>" <?php if($f->edit==1 && empty($patient->first_name)) echo ' required'; else echo ' readonly'; ?> />
				</label>
			</div>
                        <div class="col-md-4 col-xs-12 col-lg-4">
				<label class="control-label">Middle Name
				<input type="text" name="middle_name" class="form-control" placeholder="Middle" value="<?php if($patient) echo $patient->middle_name;?>" <?php if($f->edit==1 && empty($patient->middle_name)) echo ''; else echo ' readonly'; ?> />
				</label>
			</div>
			<div class="col-md-4 col-xs-12 col-lg-4">
				<label class="control-label">Last Name
				<input type="text" name="last_name" class="form-control" placeholder="Last" value="<?php  if($patient) echo $patient->last_name;?>" <?php if($f->edit==1 && empty($patient->last_name)) echo ''; else echo ' readonly'; ?>/>
				</label>
			</div>
			
			</div>
                        <div class="row alt">
			<div class="col-md-4 col-xs-4">
				<label class="control-label"><input type="radio" class="gender" value="M" name="gender" <?php if($patient)  if($patient->gender=="M") echo " checked ";?> <?php if($f->edit==1 && empty($patient->gender)) echo ' required'; else echo ' readonly'; ?> />Male</label>
				<label class="control-label"><input type="radio" class="gender" value="F" name="gender" <?php if($patient)  if($patient->gender=="F") echo " checked ";?> <?php if($f->edit==1 && empty($patient->gender)) echo ' required'; else echo ' readonly'; ?> />Female</label>
				<label class="control-label"><input type="radio" class="gender" value="O" name="gender" <?php if($patient)  if($patient->gender=="O") echo " checked ";?> <?php if($f->edit==1 && empty($patient->gender)) echo ' required'; else echo ' readonly'; ?> />Others</label>
			</div>			
			<div class="col-md-6 col-xs-12">
				<label class="control-label">Age</label>
				<input type="text" name="age_years" class="form-control" size="1"  value="<?php if($patient)  echo $patient->age_years;?>" <?php if($f->edit==1 && empty($patient->age_years)) echo ''; else echo ' readonly'; ?>/>Y
				<input type="text" name="age_months" class="form-control" size="1" value="<?php if($patient)  echo $patient->age_months;?>" <?php if($f->edit==1 && empty($patient->age_moths)) echo ''; else echo ' readonly'; ?>/>M
				<input type="text" name="age_days" class="form-control" size="1"  value="<?php if($patient)  echo $patient->age_days;?>" <?php if($f->edit==1 && empty($patient->age_days)) echo ''; else echo ' readonly'; ?>/>D
			</div>			
			</div>
                    <div class ="row alt">
                        <div class="col-md-12 col-xs-12">
                                <label class="control-label">Date of Birth</label>
                                <input type="text" name="dob" class="form-control dob" value="<?php if($patient->dob!='0000-00-00') echo date("d-M-Y",strtotime($patient->dob)); else echo ""; ?>" <?php if($f->edit==1&& empty($patient->dob)) echo ''; else echo ' readonly'; ?> />
                             <!--   <input type="date" name="dob" class="form-control" value="<?php if($patient)  echo $patient->dob;?>" <?php if($f->edit==1 && empty($patient->dob)) echo ''; else echo ' readonly'; ?>/> -->
                        </div>
                    </div>
                 </div>
               <div class="col-md-12">
			
                        <div class="row alt">
                            <div class="col-md-4 col-xs-6">
				<label class="control-label">Father's Name</label>
				<input type="text" name="father_name" class="form-control" value="<?php if($patient) echo $patient->father_name;?>" <?php if($f->edit==1 && empty($patient->father_name)) echo ''; else echo ' readonly'; ?>/>				
                            </div>
                            <div class="col-md-4 col-xs-6">
				<label class="control-label">Mother's Name</label>
				<input type="text" name="mother_name" class="form-control" value="<?php if($patient) echo $patient->mother_name;?>" <?php if($f->edit==1 && empty($patient->mother_name)) echo ''; else echo ' readonly'; ?>/>				
                            </div>
                            <div class="col-md-4 col-xs-6">
				<label class="control-label">Spouse Name</label>
				<input type="text" name="spouse_name" class="form-control" value="<?php if($patient) echo $patient->spouse_name;?>" <?php if($f->edit==1 && empty($patient->spouse_name)) echo ''; else echo ' readonly'; ?>/>				
                            </div>
                        </div>
			<div class="row alt">
			
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Address</span></label>
				<input type="text" name="address" class="form-control" value="<?php if($patient) echo $patient->address;?>" <?php if($f->edit==1 && empty($patient->address)) echo ''; else echo ' readonly'; ?>/>
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Place</label>
				<input type="text" name="place" class="form-control" value="<?php if($patient) echo $patient->place;?>" <?php if($f->edit==1 && empty($patient->place)) echo ''; else echo ' readonly'; ?>/>
			</div>
                        <div class="col-md-4 col-xs-6">
				<label class="control-label">District</label>
                                <?php if($f->edit==1 && empty($patient->district_id)) { ?>
				<select name="district" class="form-control">
				<option value="">--Select--</option>
				<?php  						
				foreach($districts as $district){
					echo "<option value='".$district->district_id."'";
					if($patient) if($district->district_id==$patient->district_id) echo " selected ";
					echo ">".$district->district."</option>";
				}
				?>
				</select>
                                <?php }else{
                                    foreach($districts as $district){
                                        if($district->district_id==$patient->district_id){
                                            echo "<input type='text' id='district' class='form-control' value='$district->district' disabled/>";
                                            echo "<input type='hidden' name='district' id='district' class='form-control' value='$district->district_id'/>";
                                        }
                                    }
                                } ?>
			</div>
			</div>
			<div class="row alt">
			
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Phone</label>
				<input type="text" name="phone" class="form-control" value="<?php if($patient) echo $patient->phone;?>" <?php if($f->edit==1 && empty($patient->phone)) echo ''; else echo ' readonly'; ?>/>
			</div>
                        <div class="col-md-4 col-xs-6">
				<label class="control-label">Alt Phone</label>
				<input type="text" name="alt_phone" class="form-control" value="<?php if($patient) echo $patient->alt_phone;?>" <?php if($f->edit==1 && empty($patient->phone)) echo ''; else echo ' readonly'; ?>/>
			</div>
                        </div>
			<div class="row alt">
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Id Proof Type</label>
                                <?php if($f->edit==1 && empty($patient->id_proof_type_id)){ ?>
				<select name="id_proof_type" class="form-control">
				<option value="">--Select--</option>
				<?php 
				foreach($id_proof_types as $id_proof_type){
					echo "<option value='".$id_proof_type->id_proof_type_id."'";
					if($id_proof_type->id_proof_type_id==$patient->id_proof_type_id) echo " selected ";
					echo ">".$id_proof_type->id_proof_type."</option>";
				}
				?>
				</select>
                                <?php }else {
                                    foreach($id_proof_types as $id_proof_type){
                                        if($id_proof_type->id_proof_type_id==$patient->id_proof_type_id){
                                            echo "<input type='text' id='id_proof_type' class='form-control' value='$id_proof_type->id_proof_type' disabled/>";
                                            echo "<input type='hidden' name='id_proof_type' id='id_proof_type' class='form-control' value='$id_proof_type->id_proof_type_id'/>";
                                        }
                                    }
                                }?>
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Id Proof No</label>
				<input type="text" name="id_proof_no" id="id_proof_no" class="form-control" value="<?php if($patient) echo $patient->id_proof_number;?>" <?php if($f->edit==1 && empty($patient->id_proof_type_id)) echo ''; else echo ' readonly'; ?>/>				
			</div>
			<div class="col-md-4 col-xs-6">
				<label class="control-label">Occupation</label>
                                <?php if($f->edit==1 && empty($patient->occupation_id)){?>
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
                                <?php } else { 
                                    foreach($occupations as $occupation){
                                        if($occupation->occupation_id==$patient->occupation_id){
                                            echo "<input type='text' id='occupation' class='form-control' value='$occupation->occupation' disabled/>";
                                            echo "<input type='hidden' name='occupation' id='occupation_id' class='form-control' value='$occupation->occupation_id'/>";
                                        }
                                    }
                                     } ?>
			</div>
			</div>
                <div class="row alt">
                    <div class="col-md-4 col-xs-6">
                        <label class="control-label">Education Level</label>
                        <input type="text" name="education_level" id="education_level" class="form-control" value="<?php if($patient) echo $patient->education_level;?>" <?php if($f->edit==1 && empty($patient->education_level)) echo ''; else echo ' readonly'; ?>/>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label class="control-label">Edu. Qualification</label>
                        <input type="text" name="education_qualification" id="education_qualification" class="form-control" value="<?php if($patient) echo $patient->education_qualification;?>" <?php if($f->edit==1 && empty($patient->education_qualification)) echo ''; else echo ' readonly'; ?>/>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label class="control-label">Identification Marks</label>
                        <input type="text" name="identification_marks" id="identification_marks" class="form-control" value="<?php if($patient) echo $patient->identification_marks;?>" <?php if($f->edit==1 && empty($patient->identification_marks)) echo ''; else echo ' readonly'; ?>/>
                    </div>
                </div>
                <div class="row alt">                    
                    <div class="col-md-4 col-xs-6">
                        <label class="control-label">Blood Group</label>
                        <?php if($f->edit==1  && empty($patient->blood_group)){ ?>
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
                        <?php } else {?>
                            <input type="text" name="blood_group" id="blood_group" class="form-control" value="<?php if($patient) echo $patient->blood_group;?>" readonly/>
                        <?php } ?>
                    </div>
                </div>
                </div>
                <?php if(!(file_exists("assets/images/patients/".$patient->patient_id.".jpg"))){ ?>
               <div class="row alt">
                <div class="col-md-12">
						<div class="form-group well well-sm">
						<div class="row">
							<div class="col-md-12">
							<p class="col-md-6" id="results-text">Captured image will appear here..</p>
							<p class="col-md-6">Camera View</p>
							<div id="results" class="col-md-6 results"></div>
							
							<div id="my_camera" class="col-md-6"></div>
							</div>
						</div>
							<div class="col-md-offset-6" style="position:relative;top:5px">
							
							<!-- A button for taking snaps -->
								<div id="button">
									<input id="patient_picture" type="hidden" class="sr-only" name="patient_picture" value=""/>
									<button class="btn btn-default btn-sm" type="button" onclick="save_photo()"><i class="fa fa-camera"></i> Take Picture</button>
								</div>
							</div>
							<!-- First, include the Webcam.js JavaScript Library -->
							<script type="text/javascript" src="<?php echo base_url();?>assets/js/webcam.min.js"></script>
							
							<!-- Configure a few settings and attach camera -->
							<script language="JavaScript">
								Webcam.set({
									width: 320,
									height: 240,
									// device capture size
									dest_width: 320,
									dest_height: 240,
									// final cropped size
									crop_width: 200,
									crop_height: 240,											
									image_format: 'jpeg',
									jpeg_quality: 90
								});
								Webcam.attach( '#my_camera' );
							</script>
							
							<!-- Code to handle taking the snapshot and displaying it locally -->
							<script language="JavaScript">
								
								function save_photo() {
									// actually snap photo (from preview freeze) and display it
									Webcam.snap( function(data_uri) {
										// display results in page
										document.getElementById('results').innerHTML = 
											'<img src="'+data_uri+'"/>';
										document.getElementById('results-text').innerHTML = 
											'Captured Image';
										//Store image data in input field.
										var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
										
										document.getElementById('patient_picture').value = raw_image_data;
										
										// swap buttons back
										document.getElementById('pre_take_buttons').style.display = '';
										document.getElementById('post_take_buttons').style.display = 'none';
									} );
								}
							</script>
							
						</div>
					</div>
                </div>
                <?php } ?>
                </div>
		<?php 
				break;
				 }}?>
		
              <?php 
                    foreach($functions as $f){
                        if($f->user_function == "patient_visit"){
                            ?>
                             <div role="tabpanel" class="tab-pane" id="patient_visit">
                                 <div class="row alt">
                                <div class="col-md-4 col-xs-6">
                                    <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                                </div>
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
				<label class="control-label">Department<span class="mandatory" >*</span></label>
                                <?php if($f->edit==1 && empty($patient->department_id)){ ?>
				<select name="department" class="form-control department" id="department">
				<option value="">--Select--</option>
				<?php 
				foreach($all_departments as $department){
					echo "<option value='".$department->department_id."'";
						if($department->department_id==$patient->department_id) echo " selected ";
					echo ">".$department->department."</option>";
				}
				?>
				</select>
                                <?php 
                                    }else{
                                    foreach($all_departments as $department){
                                        if($department->department_id==$patient->department_id){
                                            echo "<input type='text' id='department' class='form-control' value='$department->department' disabled/>";
                                            echo "<input type='hidden' name='department' id='department' class='form-control' value='$department->department_id'/>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                                 
                            <div class="col-md-4 col-xs-6">
				<label class="control-label">Unit</label>
                                <?php if($f->edit==1 && empty($patient->unit_id)){ ?>
				<select name="unit" id="unit" class="form-control unit">
				<option value="">--Select--</option>
				<?php 
				foreach($units as $unit){
					echo "<option value='".$unit->unit_id."' class='".$unit->department_id."'";
					if($unit->unit_id==$patient->unit_id) echo " selected ";
					echo ">".$unit->unit_name."</option>";
				}
				?>
				</select>
                                <?php 
                                }else{
                                    foreach($units as $unit){
                                        if($unit->unit_id==$patient->unit_id){
                                            echo "<input type='text' id='unit_id' class='form-control' value='$unit->unit_name' disabled/>";
                                            echo "<input type='hidden' name='unit' id='unit_id' class='form-control' value='$unit->unit_id'/>";
                                        }
                                    }
                                }
                                ?>
			</div>
                                     <div class="col-md-4 col-xs-6">
				<label class="control-label">Area</label>
                                <?php if($f->edit==1 && empty($patient->area_id)){ ?>
				<select name="area" id="area" class="form-control area">
				<option value="">--Select--</option>
				<?php 
				foreach($areas as $area){
					echo "<option value='".$area->area_id."' class='".$area->department_id."'";
					if($area->area_id==$patient->area_id) echo " selected ";
					echo ">".$area->area_name."</option>";
				}
				?>
				</select>
                                <?php 
                                }else{
                                    foreach($areas as $area){
                                        if($area->area_id==$patient->area_id){
                                            echo "<input type='text' id='area_id' class='form-control' value='$area->area_name' disabled/>";
                                            echo "<input type='hidden' name='area' id='area_id' class='form-control' value='$area->area_id'/>";
                                        }
                                    }
                                }
                                ?>
                                </div>
                                 </div>
			<div class="row alt">
                            <div class="col-md-4 col-xs-6">
                                <label class="control-label">Visit Name</label>
                                <?php if($f->edit==1 && empty($patient->visit_name_id)){ ?>
                                <select name="visit_name_id" id="visit_name_id" class="form-control visit_name">
                                    <option value="">--Select--</option>
                                    <?php 
                                    foreach($visit_names as $visit_name){
                                        echo "<option value='".$visit_name->visit_name_id."' class='".$visit_name->visit_name_id."'";
					if($visit_name->visit_name_id==$patient->visit_name_id) echo " selected ";
					echo ">".$visit_name->visit_name."</option>";
                                    }
                                    ?>
                                </select>
                                <?php 
                                }else{
                                    foreach($visit_names as $visit_name){
                                        if($visit_name->visit_name_id==$patient->visit_name_id){
                                            echo "<input type='text' id='visit_name' class='form-control' value='$visit_name->visit_name' disabled/>";
                                            echo "<input type='hidden' name='visit_name_id' id='visit_name' class='form-control' value='$patient->visit_name_id'/>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <label class="control-label">Doctor</label>
                                <?php if($f->edit==1 && empty($patient->doctor_id)){ ?>
                                <select name="doctor_id" id="doctor_id" class="form-control doctor">
                                    <option value="">--Select--</option>
                                    <?php 
                                    foreach($doctors as $doctor){
                                        echo "<option value='".$doctor->staff_id."' class='".$doctor->staff_id."'";
					if($doctor->staff_id==$patient->doctor_id) echo " selected ";
					echo ">".$doctor->first_name." ".$doctor->last_name."</option>";
                                    }
                                    ?>
                                </select>
                                <?php 
                                }else{
                                    foreach($doctors as $doctor){
                                        if($doctor->staff_id==$patient->doctor_id){
                                            echo "<input type='text' id='doctor_id' class='form-control' value='".$doctor->first_name." ".$doctor->last_name."' disabled/>";
                                            echo "<input type='hidden' name='doctor_id' id='doctor_id' class='form-control' value='$doctor->staff_id'/>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <label class="control-label">Nurse</label>
                                <input type="text" name="nurse" class="form-control" value="<?php if($patient) echo $patient->nurse;?>" <?php if($f->edit==1 && empty($patient->nurse)) echo ''; else echo ' readonly'; ?>/>
                            </div>
                        </div>
                                 <div class="row alt">
                                     <div class="col-md-4 col-xs-6">
                                         <label class="control-label">Insurance Case: </label>
                                         <input type="radio" name="insurance_case" class="form-control" value="1" <?php if($patient){ if($patient->insurance_case=='1') echo "checked";};?> <?php if($f->edit==1 && empty($patient->insurance_case)) echo ''; else echo ' readonly'; ?>/>Yes
                                         <input type="radio" name="insurance_case" class="form-control" value="0" <?php if($patient){ if($patient->insurance_case=='0') echo "checked";};?> <?php if($f->edit==1 && empty($patient->insurance_case)) echo ''; else echo ' readonly'; ?>/>No
                                     </div>
                                     <div class="col-md-4 col-xs-6">
                                         <label class="control-label">Insurance ID</label>
                                         <input type="text" name="insurance_id" id="insurance_id" class="form-control" value="<?php if($patient) echo $patient->insurance_id;?>" <?php if($f->edit==1 && empty($patient->insurance_id)) echo ''; else echo ' readonly'; ?>/>
                                     </div>
                                     <div class="col-md-4 col-xs-6">
                                         <label class="control-label">Insurance Number</label>
                                         <input type="text" name="insurance_no" id="insurance_no" class="form-control" value="<?php if($patient) echo $patient->insurance_no;?>" <?php if($f->edit==1 && empty($patient->insurance_no)) echo ''; else echo ' readonly'; ?>/>
                                     </div>
                                 </div>
                                 <div class="row alt">                                     
                                     <div class="col-md-4 col-xs-6">
                                         <label class="control-label">Arrival Mode</label>
                                         <?php if($f->edit==1 && empty($patient->arrival_mode)){?>
                                         <select name="arrival_mode" id="arrival_mode" class="form-control arrival_mode">
                                            <option value="">--Select--</option>
                                            <?php 
                                            foreach($arrival_modes as $arrival_mode){
                                                echo "<option value='".$arrival_mode->arrival_mode."' class='".$arrival_mode->arrival_mode."'";
                                                if($arrival_mode->arrival_mode==$patient->arrival_mode) echo " selected ";
                                                echo ">".$arrival_mode->arrival_mode."</option>";
                                            }
                                            ?>
                                        </select>
                                         <?php 
                                            }else{
                                                foreach($arrival_modes as $arrival_mode){
                                                    if($arrival_mode->arrival_mode==$patient->arrival_mode){
                                                        echo "<input type='text' id='arrival_mode' class='form-control' value='$arrival_mode->arrival_mode' disabled/>";
                                                        echo "<input type='hidden' name='arrival_mode' id='arrival_mode' class='form-control' value='$arrival_mode->arrival_mode'/>";
                                                    }
                                                }
                                            }
                                            ?>
                                     </div>                                     
                                     <div class="col-md-8 col-xs-6">
                                        <label class="control-label">Referral Hospital</label>
                                        <?php if($f->edit==1 && empty($patient->refereal_hospital_id)){ ?>
                                        <select name="refereal_hospital_id" id="refereal_hospital_id" class="form-control refereal_hospital_id">
                                            <option value="">--Select--</option>
                                            <?php 
                                            foreach($hospitals as $hospital){
                                                echo "<option value='".$hospital->hospital_id."' class='".$hospital->hospital_id."'";
                                                if($hospital->hospital_id==$patient->refereal_hospital_id) echo " selected ";
                                                echo ">".$hospital->hospital."</option>";
                                            }
                                            ?>
                                        </select>
                                        <?php 
                                            }else{
                                                foreach($hospitals as $hospital){
                                                    if($hospital->hospital_id==$patient->refereal_hospital_id){
                                                        echo "<input type='text' id='hospital_id' class='form-control' value='$hospital->hospital' disabled/>";
                                                        echo "<input type='hidden' name='refereal_hospital_id' id='hospital_id' class='form-control' value='$hospital->hospital_id'/>";
                                                    }
                                                }
                                            }
                                            ?>
                                     </div>                                     
                                 </div>
                                 <div class="row alt">
                                     &nbsp;
                                 </div>
                                 <div class="row">
                                 <!--Patient transfers-->
                                 <div class="col-md-12 col-xs-12">
                                     <table class="table table-striped table-bordered">
                                         <thead>
                                            <th colspan="4">Patient Transfer Information</th>
                                         </thead>
                                         <tr>
                                             <td><b>Department</b></td>
                                             <td><b>Area</b></td>
                                             <td><b>Transfer Date & Time</b></td>
                                         </tr>
                                         <?php
                                            if(isset($transfers) && $transfers!=false){
                                                foreach($transfers as $transfer){
                                                    ?>
                                         <tr>
                                         <td>
                                             <?php 
                                             foreach($all_departments as $department){ 
                                                 if($department->department_id == $transfer->department_id){
                                                    echo $department->department;
                                                    break;
                                                 }
                                             }?>
                                         </td>            
                                         <td>
                                             <?php 
                                             foreach($areas as $area){ 
                                                 if($area->area_id == $transfer->area_id){
                                                    echo $area->area_name;
                                                    break;
                                                 }
                                             }
                                             ?>
                                         </td>
                                         <td>
                                            <?php echo date("d-M-Y",strtotime($transfer->transfer_date)); ?>
                                             <?php echo date("g:iA",strtotime($transfer->transfer_time)); ?>
                                         </td>
                                                    <?php
                                                }
                                            }
                                         ?>
                                         </tr>
                                         <tr>
                                         <td>
                                             <select name="transfer_department" class="form-control transfer_department" id="transfer_department">
                                                <option value="">--Select--</option>
                                                <?php 
                                                    foreach($all_departments as $department){
                                                    echo "<option value='".$department->department_id."'>".$department->department."</option>";
                                                }
                                                ?>
                                            </select>
                                         </td>
                                         <td>
                                             <select name="transfer_area" id="transfer_area" class="form-control transfer_area">
                                            <option value="">--Select--</option>
                                            <?php 
                                            foreach($areas as $area){
                                                    echo "<option value='".$area->area_id."' class='".$area->department_id."'>".$area->area_name."</option>";
                                            }
                                            ?>
                                            </select>
                                         </td>
                                         <td>
                                         <input type="text" name="transfer_date" class="form-control transfer_date" value="<?php echo date("d-M-Y g:iA");?>" id="transfer_date" />
                                   
                                         </td>
                                         </tr>
                                     </table>
                                 </div>
                                 </div>
                             </div>
                            <?php
                            break;
                        }
                    }
              ?>
              <?php 
                foreach($functions as $f){
                    if($f->user_function== "Patient Transport"){
                        ?>
              <div role="tabpanel" class="tab-pane" id="patient_transport">
                  <div class="row alt">
                                <div class="col-md-4 col-xs-6">
                                    <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php echo $patient->visit_type; ?> Number: </b><?php echo $patient->hosp_file_no;?>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php if( $patient->visit_type == "IP") echo "Admit Date:"; else echo "Visit Date:";?></b>
                                    <?php echo date("d-M-Y", strtotime($patient->admit_date)).", ".date("g:ia", strtotime($patient->admit_time));?>
                                </div>
                  </div>
                  <div class="row alt">
					
					 <!--Patient transfers-->
					 <div class="col-md-12 col-xs-12">
						 <table class="table table-striped table-bordered">
							 <thead>
								<th colspan="4">Patient Transport Information</th>
							 </thead>
							 <tr>
								 <td><b>From Area</b></td>
								 <td><b>To Area</b></td>
								 <td><b>Transported By</b></td>
								 <td><b>Transport Start Date & Time</b></td>
								 <td><b>Transport End Date & Time</b></td>
							 </tr>
							 <?php
								if(isset($transport) && $transport!=false){
									foreach($transport as $t){
										?>
							 <tr>
							 <td>
								 <?php 
										echo $t->from_area;
								 ?>
							 </td>            
							 <td>
								 <?php 
										echo $t->to_area;
								 ?>
							 </td>      
							 <td>
								 <?php 
										echo $t->transported_by;
								 ?>
							 </td>
							 <td>
								<?php echo date("d-M-Y",strtotime($t->start_date_time)); ?>
								 <?php echo date("g:iA",strtotime($t->start_date_time)); ?>
							 </td>
							 <td>
								<?php echo date("d-M-Y",strtotime($t->end_date_time)); ?>
								 <?php echo date("g:iA",strtotime($t->end_date_time)); ?>
							 </td>
							 </tr>
										<?php
									}
								}
							 ?>
						 </table>
					 </div>
				</div>
              </div>              
                        <?php
                        break;
                    }
                }
              ?>
              <?php 
                foreach($functions as $f){
                    if($f->user_function== "mlc"){
                        ?>
              <div role="tabpanel" class="tab-pane" id="mlc">
                  <div class="row alt">
                                <div class="col-md-4 col-xs-6">
                                    <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                                </div>
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
				<label class="control-label">MLC</label>
				<label class="control-label"><input type="radio" value="1" class="mlc" name="mlc_radio" id="mlc_radio" <?php  if($patient->mlc=='1') echo " checked ";?> <?php if($f->edit==1  && $patient->mlc==0) echo ''; else echo ' disabled'; ?> />Yes</label>
				<label class="control-label"><input type="radio" value="-1" class="mlc" name="mlc_radio" id="mlc_radio" <?php if($patient->mlc=='-1') echo " checked ";?> <?php if($f->edit==1 && $patient->mlc==0) echo ''; else echo ' disabled'; ?> />No</label>
                             <?php if($patient->mlc!=0) { ?><input type="hidden" value=<?php echo $patient->mlc; ?> name="mlc_radio" /> <?php } ?>
			
			</div>
                      <div class="col-md-4 col-xs-6">
                          <label class="control-label">MLC Number- System</label>
                          <input name="mlc_number" class="form-control mlc" id="mlc_number" value="<?php if(!empty($patient->mlc_number)) echo $patient->mlc_number; else echo "unset"?>" type="text" readonly/>
                      </div>
                        <div class="col-md-4 col-xs-6">
                                <label class="control-label">MLC Number Manual</label>
                                <input type="text" name="mlc_number_manual" class="form-control mlc" id="mlc_number_manual" value="<?php if(!empty($patient->mlc_number_manual)) echo $patient->mlc_number_manual; else echo ''; ?>" <?php if($f->edit==1 && ((empty($patient->mlc_number_manual) && $patient->mlc!='-1') || $patient->mlc==0)) echo ''; else echo ' readonly'; ?> />
                        </div>
                      
		</div>
                  <div class="row alt">
                      <div class="col-md-4 col-xs-6">
                                <label class="control-label">PS Name</label>
                                <input type="text" name="ps_name" class="form-control mlc" id="ps_name" value="<?php echo $patient->ps_name;?>" <?php if($f->edit==1 && ((empty($patient->ps_name) && $patient->mlc!='-1') || $patient->mlc==0)) echo ''; else echo ' readonly'; ?>/>
                        </div>
                      
                      <div class="col-md-4 col-xs-6">
                          <label class="control-label">Police Intimation</label>
                          <input type="text" name="police_intimation" class="form-control mlc" id="police_intimation" value="<?php echo $patient->police_intimation;?>" <?php if($f->edit==1 && ((empty($patient->police_intimation) && $patient->mlc!='-1') || $patient->mlc==0)) echo ''; else echo ' readonly'; ?> />
                      </div>
                      <div class="col-md-4 col-xs-6">
                          <label class="control-label">PC Number</label>
                          <input type="text" name="pc_number" class="form-control mlc" id="pc_number" value="<?php echo $patient->pc_number;?>" <?php if($f->edit==1 && ((empty($patient->pc_number) && $patient->mlc!='-1') || $patient->mlc==0)) echo ''; else echo ' readonly'; ?> />
                      </div>
                  </div>
                  <div class="row alt">
                      <div class="col-md-4 col-xs-6">
                          <label class="control-label">Brought By</label>
                          <input type="text" name="brought_by" class="form-control mlc" id="brought_by" value="<?php echo $patient->brought_by;?>" <?php if($f->edit==1 && ((empty($patient->brought_by) && $patient->mlc!='-1') || $patient->mlc==0)) echo ''; else echo ' readonly'; ?> />
                      </div>
                      <div class="col-md-4 col-xs-6">
                          <label class="control-label">Declaration Required</label>
                          <input type="text" name="declaration_required" class="form-control mlc" id="declaration_required" value="<?php echo $patient->declaration_required;?>" <?php if($f->edit==1 && ((empty($patient->declaration_required) && $patient->mlc!='-1') || $patient->mlc==0)) echo ''; else echo ' readonly'; ?> />
                      </div>                                            
                  </div>
              </div>              
                        <?php
                        break;
                    }
                }
              ?>
              <?php 
                foreach($functions as $f){
                    if($f->user_function== "obg"){
                        ?>
              <div role="tabpanel" class="tab-pane" id="obg">
                  <div class="row alt">
                                <div class="col-md-4 col-xs-6">
                                    <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php echo $patient->visit_type; ?> Number: </b><?php echo $patient->hosp_file_no;?>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php if( $patient->visit_type == "IP") echo "Admit Date:"; else echo "Visit Date:";?></b>
                                    <?php echo date("d-M-Y", strtotime($patient->admit_date)).", ".date("g:ia", strtotime($patient->admit_time));?>
                                </div>
                  </div>
                  <div class="row alt">
                            <!--OBG-->
                                 <div class="col-md-12 col-xs-12">
                                     <table class="table table-striped table-bordered">
                                         <thead>
                                            <th colspan="5">Summary</th>
                                         </thead>
                                         <tr>
                                             <td><b>Gravida</b></td>
                                             <td><b>Para</b></td>
                                             <td><b>Abortions</b></td>
                                             <td><b>Live Births</b></td>
                                             <td><b>Living Children</b></td>
                                         </tr>
                                         
                                         <tr>
                                         <td>
                                         </td>            
                                         <td>                                             
                                         </td>
                                         <td>                                            
                                         </td>
                                         <td>                                             
                                         </td>
                                         <td>                                             
                                         </td>
                                         
                                                 
                                         </tr>
                                         
                                     </table>
                                 </div>    
                  </div>
                  <div class="row alt">
                      <!--OBG, table transpose has been applied on the table class obstetric_history, check in style sheets. -->
                                 <div class="col-md-12 col-xs-12">
                                     <table class="table table-striped table-bordered obstetric_history_table" id="obstetric_history">
                                         <thead>
                                            <th colspan="17">Table (obstetric_history)</th>
                                         </thead>
                                         <tr>
                                             <td><b>Conception ( pregnancy_number )</b></td>
                                             <td><b>conception_type (1,2,3,4)</b></td>
                                             <td><b>Delivery(1) / Abortion(0) - add field</b></td>
                                             <td><b>LMP (date)</b></td>
                                             <td><b>EDD (date)</b></td>
                                             <td><b>Live Birth (1) / Still Birth (0) - change field to delivery_outcome</b></td>
                                             <td><b>Booked (1) / Unbooked (0)</b></td>
                                             <td><b>Delivery Mode (lov)</b></td>
                                             <td><b>Date of Birth</b></td>
                                             <td><b>Girl (1) / Boy (0) / Other ( 2)</b></td>
                                             <td><b>Birth Weight</b></td>
                                             <td><b>APGAR</b></td>
                                             <td><b>NICU Admission Y-1, N-0</b></td>NICU Admission reason
                                             <td><b>NICU Admission reason</b></td>
                                             <td><b>Alive (1) / Dead (0) - add field living_status</b></td>
                                             <td><b>Date of Death</b></td>
                                             <td><b>Cause of Death</b></td>
                                         </tr>
                                         <?php if(isset($obstetric_history)){ 
                                             foreach($obstetric_history as $history){ ?>
                                         <tr>
                                         <td>
                                             <?php echo $history->pregnancy_number ; ?>
                                         </td>
                                         <td>
                                             <?php echo $history->conception_type ; ?>
                                         </td>                                         
                                         <td>
                                             <?php if($history->delivered == '1') echo "Delivered"; else echo "Abortion"; ?>
                                         </td>
                                         <td>
                                             <?php echo Date('d-M-Y',strtotime($history->imp_date)); ?>
                                         </td>
                                         <td>
                                             <?php echo Date('d-M-Y',strtotime($history->edd_date)); ?>
                                         </td>
                                         <td>
                                             <?php echo $history->delivery_outcome ; ?>
                                         </td>
                                         <td>
                                             <?php if($history->booked == '1') echo "Booked"; else echo "Unbooked"; ?>
                                         </td>
                                         <td>
                                             <?php echo $history->delivery_mode ; ?>
                                         </td>
                                         <td>
                                             <?php echo Date('d-M-Y',strtotime($history->date_of_birth)); ?> 
                                         </td>
                                         <td>
                                             <?php if($history->gender == '1') echo "Female"; else if($history->gender =='2') echo "Male"; else echo "Other";?>
                                         </td>
                                         <td>
                                             <?php echo $history->weight_at_birth ; ?>
                                         </td>
                                         <td>
                                             <?php echo $history->apgar ; ?>
                                         </td>
                                         <td>
                                             <?php if($history->nicu_admission == '1') echo "Yes"; else echo "No"; ?>
                                         </td>
                                         <td>
                                             <?php echo $history->nicu_admission_reason; ?>
                                         </td>
                                         <td>
                                             <?php if($history->alive == '1') echo "Alive"; else echo "Dead"; ?> 
                                         </td>
                                         <td>
                                             <?php echo Date('d-M-Y',strtotime($history->date_of_death)); ?> 
                                         </td>
                                         <td>
                                             <?php echo $history->cause_of_death; ?>
                                         </td>   
                                         </tr>
                                         <?php }                                         
                                         } ?>
                                         <?php if($f->edit==1){ ?>
                                         <tr>
                                         <td>
                                             <input type="text" name="pregnancy_number[]" class="form-control pregnancy_number" id="pregnancy_number" placeholder="Pregnancy Number" />
                                         </td>
                                         <td>
                                             <input type="text" name="conception_type[]" class="form-control conception_type" id="conception_type" placeholder="Conception Type" />                                             
                                         </td>                                                     
                                         <td>
                                             <input type="radio" name="delivered[]" class="form-control delivered" value="1" id="delivered" />Delivered
                                             <input type="radio" name="delivered[]" class="form-control delivered" value="-1" id="delivered" />Abortion                                             
                                         </td>
                                         <td>
                                             <input type="text" name="imp_date[]" class="form-control imp_date" id="imp_date" style="width:150px" />                                             
                                         </td>
                                         <td>
                                             <input type="text" name="edd_date[]" class="form-control edd_date" id="edd_date" style="width:150px" />                                             
                                         </td>
                                         <td>
                                             <input type="text" name="delivery_outcome[]" class="form-control delivery_outcome" id="delivery_outcome" placeholder="Delivery Outcome" />                                             
                                         </td>
                                         <td>
                                             <input type="radio" name="booked[]" class="form-control booked" value="1" id="booked" />Delivered
                                             <input type="radio" name="booked[]" class="form-control booked" value="-1" id="booked" />Abortion                                             
                                         </td>
                                         <td>
                                             <input type="text" name="delivery_mode[]" class="form-control delivery_mode" id="delivery_mode" placeholder="Delivery Mode" />
                                         </td>
                                         <td>
                                             <input type="text" name="date_of_birth" class="form-control date_of_birth" id="date_of_birth" style="width:150px" />                                             
                                         </td>
                                         <td>
                                             <input type="radio" name="gender[]" class="form-control gender" value="2" id="gender" />Male
                                             <input type="radio" name="gender[]" class="form-control gender" value="1" id="gender" />Female
                                             <input type="radio" name="gender[]" class="form-control gender" value="3" id="gender" />Other                                             
                                         </td>
                                         <td>
                                             <input type="text" name="weight_at_birth[]" class="form-control weight_at_birth" id="weight_at_birth" placeholder="Weight at birth" />                                             
                                         </td>
                                         <td>
                                             <input type="text" name="apgar[]" class="form-control apgar" id="apgar" placeholder="APGR" />                                             
                                         </td>
                                         <td>
                                             <input type="radio" name="nicu_admission[]" class="form-control booked" value="1" id="booked" />Yes
                                             <input type="radio" name="nicu_admission[]" class="form-control booked" value="-1" id="booked" />No                                             
                                         </td>
                                         <td>
                                             <input type="text" name="nicu_admission_reason[]" class="form-control nicu_admission_reason" id="nicu_admission_reason" placeholder="NICU Admission Reason" />                                                                                          
                                         </td>
                                         <td>
                                             <input type="radio" name="alive[]" class="form-control alive" value="1" id="alive" />Alive
                                             <input type="radio" name="alive[]" class="form-control alive" value="-1" id="alive" />Dead                                             
                                         </td>
                                         <td>
                                             <input type="text" name="date_of_death" class="form-control date_of_death" id="date_of_death" style="width:150px" />                                             
                                         </td>
                                         <td>
                                             <input type="text" name="cause_of_death[]" class="form-control cause_of_death" id="cause_of_death" placeholder="Cause of death" />                                             
                                         </td>   
                                         </tr>
                                         <?php } ?>
                                     </table>
                                     <?php if($f->edit==1) { ?>
                                     <div class="btn-group" role="group">
                                         <input type="hidden" name="child_count" id="child_count" value="1" />
                                        <button type="button" id='add_obstetric_history'>Add</button>
                                        <button type="button" id='remove_obstetric_history'>Remove Last</button>
                                    </div>
                                     <?php } ?>
                                 </div>
		</div>
                  <div class="row alt">
                                            
                  </div>
              </div>              
                        <?php
                        break;
                    }
                }
              ?>
		<?php 
			foreach($functions as $f){ 
				if($f->user_function == "Clinical" && ($f->add==1 || $f->edit==1)) { ?>
		<div role="tabpanel" class="tab-pane" id="clinical">
                    <div class="row alt">
                                <div class="col-md-4 col-xs-6">
                                    <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                                </div>
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
					<label class="control-label">Admit Weight</label>
					<input type="text" name="admit_weight" class="form-control" value="<?php if(!!$patient->admit_weight) echo $patient->admit_weight;?>" <?php if($f->edit==1  && empty($patient->admit_weight)) echo ''; else echo ' readonly'; ?> />
				</div>
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Pulse Rate</label>
					<input type="text" name="pulse_rate" class="form-control pulse_rate" value="<?php if(!!$patient->pulse_rate)  echo $patient->pulse_rate;?>"  <?php if($f->edit==1  && empty($patient->pulse_rate)) echo ''; else echo ' readonly'; ?> />
				</div>
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Temperature</label>
					<input type="text" name="temperature" class="form-control" value="<?php if(!!$patient->temperature)  echo $patient->temperature;?>" <?php if($f->edit==1 && empty($patient->temperature)) echo ''; else echo ' readonly'; ?> />
				</div>
			</div>
			<div class="row alt">
				
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Blood Pressure</label>
					<input type="text" name="sbp" style="width:50px" class="form-control blood_pressure" value="<?php if(!!$patient->sbp) echo $patient->sbp;?>" <?php if($f->edit==1 && empty($patient->sbp)) echo ''; else echo ' readonly'; ?> />/
					<input type="text" name="dbp"  style="width:50px" class="form-control blood_pressure" value="<?php if(!!$patient->dbp) echo $patient->dbp;?>" <?php if($f->edit==1 && empty($patient->dbp)) echo ''; else echo ' readonly'; ?> />
				</div>
				<div class="col-md-4 col-xs-6">
					<label class="control-label">Respiratory Rate</label>
					<input type="text" name="respiratory_rate" class="form-control respiratory_rate" value="<?php if(!!$patient->respiratory_rate) echo $patient->respiratory_rate;?>" <?php if($f->edit==1  && empty($patient->respiratory_rate)) echo ''; else echo ' readonly'; ?> />
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						Symptoms
					</label>
					<textarea name="presenting_complaints" cols="60" class="form-control" placeholder="Symptoms/ Presenting Complaints" <?php if($f->edit==1  && empty($patient->presenting_complaints)) echo ''; else echo ' readonly'; ?> ><?php echo $patient->presenting_complaints;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						Past History
					</label>
					<textarea name="past_history" cols="60" class="form-control" placeholder="Past History" <?php if($f->edit==1  && empty($patient->past_history)) echo ''; else echo ' readonly'; ?> ><?php echo $patient->past_history;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						Family History
					</label>
					<textarea name="family_history" cols="60" class="form-control" placeholder="Family History" <?php if($f->edit==1  && empty($patient->family_history)) echo ''; else echo ' readonly'; ?> ><?php echo $patient->family_history;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						Clinical Findings
					</label>
					<textarea name="clinical_findings" cols="60" class="form-control" placeholder="Clinical Findings" <?php if($f->edit==1 && empty($patient->clinical_findings)) echo ''; else echo ' readonly'; ?> ><?php echo $patient->clinical_findings;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						CVS
					</label>
					<textarea name="cvs" cols="60" class="form-control" placeholder="CVS" <?php if($f->edit==1 && empty($patient->cvs)) echo ''; else echo ' readonly'; ?> ><?php echo $patient->cvs;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						RS
					</label>
					<textarea name="rs" cols="40" class="form-control" placeholder="RS" <?php if($f->edit==1  && empty($patient->rs)) echo ''; else echo ' readonly'; ?> ><?php echo $patient->rs;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						PA
					</label>
					<textarea name="pa" cols="60" class="form-control" placeholder="PA" <?php if($f->edit==1 && empty($patient->pa)) echo ''; else echo ' readonly'; ?> ><?php echo $patient->pa;?></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-12 col-xs-12">
					<label class="control-label">
						CNS
					</label>
					<textarea name="cns" cols="40" class="form-control" placeholder="CNS" <?php if($f->edit==1 && empty($patient->cns)) echo ''; else echo ' readonly'; ?> ><?php echo $patient->cns;?></textarea>
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
			<div class="row alt">
                                <div class="col-md-4 col-xs-6">
                                    <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php echo $patient->visit_type; ?> Number: </b><?php echo $patient->hosp_file_no;?>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php if( $patient->visit_type == "IP") echo "Admit Date:"; else echo "Visit Date:";?></b>
                                    <?php echo date("d-M-Y", strtotime($patient->admit_date)).", ".date("g:ia", strtotime($patient->admit_time));?>
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
                                <div class="col-md-4 col-xs-6">
                                    <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php echo $patient->visit_type; ?> Number: </b><?php echo $patient->hosp_file_no;?>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php if( $patient->visit_type == "IP") echo "Admit Date:"; else echo "Visit Date:";?></b>
                                    <?php echo date("d-M-Y", strtotime($patient->admit_date)).", ".date("g:ia", strtotime($patient->admit_time));?>
                                </div>
                    </div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Procedure</label>
				</div>
				<div class="col-md-8">
                                    <?php if($f->edit==1 && empty($patient->procedure_name)){ ?>
					<select name="procedure" class="form-control">
					<option value="" selected>--SELECT--</option>
					<?php foreach($procedures as $procedure){ ?>
						<option value="<?php echo $procedure->procedure_id;?>"><?php echo $procedure->procedure_name;?></option>
					<?php } ?>
					</select>
                                    <?php }else{
                                    foreach($procedures as $procedure){
                                        if($procedure->procedure_id==$patient->procedure_id){
                                            echo "<input type='text' id='procedure_id' class='form-control' value='$procedure->procedure_name' disabled/>";
                                            echo "<input type='hidden' name='procedure' id='procedure_id' class='form-control' value='$procedure->procedure_name'/>";
                                        }
                                    }
                                } ?>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Date, Time</label>
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control date" name="procedure_date"  <?php if($f->edit==1 && empty($patient->procedure_date)) echo ''; else echo ' readonly'; ?> />
					<input type="text" class="form-control time" name="procedure_time"  <?php if($f->edit==1 && empty($patient->procedure_time)) echo ''; else echo ' readonly'; ?> />
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Duration</label>
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="procedure_duration" value=<?php echo '"'.$patient->procedure_duration.'"';?> <?php if($f->edit==1 && empty($patient->procedure_duration)) echo ''; else echo ' readonly'; ?>  />
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Notes</label>
				</div>
				<div class="col-md-8">
					<textarea type="text" class="form-control" name="procedure_note" value=<?php echo '"'.$patient->procedure_note.'"';?><?php if($f->edit==1 && empty($patient->procedure_note)) echo ''; else echo ' readonly'; ?> ></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Findings</label>
				</div>
				<div class="col-md-8">
					<textarea type="text" class="form-control" name="procedure_findings" value=<?php echo '"'.$patient->procedure_findings.'"';?> <?php if($f->edit==1 && empty($patient->procedure_findings)) echo ''; else echo ' readonly'; ?> ></textarea>
				</div>
			</div>
			<div class="row alt">
				<div class="col-md-4">
					<label class="control-label">Post Procedure Notes</label>
				</div>
				<div class="col-md-8">
					<textarea type="text" class="form-control" name="post_procedure_notes" <?php if($f->edit==1 && empty($patient->post_procedure_notes)) echo ''; else echo ' readonly'; ?> ></textarea>
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
                    <div class="row alt">
                                <div class="col-md-4 col-xs-6">
                                    <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php echo $patient->visit_type; ?> Number: </b><?php echo $patient->hosp_file_no;?>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php if( $patient->visit_type == "IP") echo "Admit Date:"; else echo "Visit Date:";?></b>
                                    <?php echo date("d-M-Y", strtotime($patient->admit_date)).", ".date("g:ia", strtotime($patient->admit_time));?>
                                </div>
                                </div>
			<div class="row alt">
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
								<select name="drug_0" class="form-control" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> >
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
								<select name="frequency_0" class="form-control" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> >
									<option value="">Select</option>
									<option value="Daily" selected>Daily</option>
									<option value="Alternate Days">Alternate Days</option>
								</select>
							</td>
							<td>
								<label><input type="checkbox" name="bb_0" value="1" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> /></label>
							</td>
							<td>
								<label><input type="checkbox" name="ab_0" value="1" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> /></label>
							</td>
							<td>
								<label><input type="checkbox" name="bl_0" value="1" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> /></label>
							</td>
							<td>
								<label><input type="checkbox" name="al_0" value="1" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> /></label>
							</td>
							<td>
								<label><input type="checkbox" name="bd_0" value="1" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> /></label>
							</td>
							<td>
								<label><input type="checkbox" name="ad_0" value="1" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> /></label>
							</td>
							<td>
								<input type="text" name="quantity_0" style="width:100px" class="form-control" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> />
							</td>
							<td>
								<select name="lab_unit_0" class="form-control" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> >
								<option value="">--Select--</option>
								<?php 
								foreach($lab_units as $unit){
									echo "<option value='".$unit->lab_unit_id."'>".$unit->lab_unit."</option>";
								}
								?>
								</select>
								<input type="text" name="prescription[]" class="sr-only" value="0"  <?php if($f->edit==1) echo ''; else echo ' readonly'; ?> />
							</td>
							<td>
								<button type="button" class="btn btn-primary btn-sm" id="prescription_add" <?php if($f->edit==1) echo ''; else echo ' readonly'; ?>>Add</button>
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
                                <div class="col-md-4 col-xs-6">
                                    <b>Patient ID: <?php echo $patient->patient_id; ?> </b>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php echo $patient->visit_type; ?> Number: </b><?php echo $patient->hosp_file_no;?>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <b><?php if( $patient->visit_type == "IP") echo "Admit Date:"; else echo "Visit Date:";?></b>
                                    <?php echo date("d-M-Y", strtotime($patient->admit_date)).", ".date("g:ia", strtotime($patient->admit_time));?>
                                </div>
                    </div>
			<div class="row">
			<div class="col-md-12 alt">
				<div class="col-md-2">
				<label class="control-label">Outcome</label>
				</div>
				<div class="col-md-8">
				<label><input type="radio" value="Discharge" name="outcome" <?php if(!!$patient->outcome) if($patient->outcome=="Discharge") echo " checked ";?> <?php if($f->edit==1 && empty($patient->outcome)) echo ''; else echo ' readonly'; ?> />Discharge</label>
				<label><input type="radio" value="LAMA" name="outcome" <?php if(!!$patient->outcome) if($patient->outcome=="LAMA") echo " checked ";?> <?php if($f->edit==1&& empty($patient->outcome)) echo ''; else echo ' readonly'; ?> />LAMA</label>
				<label><input type="radio" value="Absconded" name="outcome" <?php if(!!$patient->outcome) if($patient->outcome=="Absconded") echo " checked ";?> <?php if($f->edit==1&& empty($patient->outcome)) echo ''; else echo ' readonly'; ?> />Absconded</label>
				<label><input type="radio" value="Death" name="outcome" <?php if(!!$patient->outcome) if($patient->outcome=="Death") echo " checked ";?> <?php if($f->edit==1&& empty($patient->outcome)) echo ''; else echo ' readonly'; ?> />Death</label>
				</div>
			</div>
                            <script>
				$(function(){
					$(".ip_file_received").Zebra_DatePicker({
						direction:[false,'<?php echo date("d-M-Y",strtotime($patient->ip_file_received));?>']
					});
				});
                            </script>
                        <div class="col-md-12 alt">
                            <div class="col-md-2">
                                <label class="control-label">Case Sheet Recieved at MRD on </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="ip_file_received" class="form-control ip_file_received" value="<?php if($patient->ip_file_received!=0) echo $patient->ip_file_received;?>" <?php if($f->edit==1&& empty($patient->ip_file_received)) echo ''; else echo ' readonly'; ?> />
                            </div>
			</div>
			<div class="col-md-12 alt">
				<div class="col-md-2">
				<script>
				$(function(){
					<?php if($patient->outcome_date == 0){ ?>
					$('.outcome_date').datetimepicker({
						format : "D-MMM-YYYY h:ssA",
						minDate : "<?php echo date("Y/m/d ",strtotime($patient->admit_date)).date("g:i A",strtotime($patient->admit_time));?>",
						defaultDate : false
					});
					<?php } ?>
					$(".transfer_date").datetimepicker({
						format : "D-MMM-YYYY h:ssA",
                        minDate:'<?php if(isset($transfers) && sizeof($transfers) !=0) echo date("Y/m/d ",strtotime($transfers[sizeof($transfers)-1]->transfer_date)).date("g:i A",strtotime($transfers[sizeof($transfers)-1]->transfer_time)); else echo date("Y/m/d ",strtotime($patient->admit_date)).date("g:i A",strtotime($patient->admit_time));?>',
						defaultDate : false
                    });
					$(".transport_start_date,.transport_end_date").datetimepicker({
						format : "D-MMM-YYYY h:ssA",
						defaultDate : false
                    });
					$(".imp_date").Zebra_DatePicker();
					$(".edd_date").Zebra_DatePicker();
					$(".date_of_birth").Zebra_DatePicker();
					$(".date_of_death").Zebra_DatePicker();
					$(".dob").Zebra_DatePicker({
						direction:[false,'<?php echo date("d-M-Y",strtotime($patient->dob));?>']
					});
                                $(".transfer_time").timeEntry();
					$(".time").timeEntry({minTime: new Date(<?php echo date("Y,m,d",strtotime($patient->admit_date)).date(",h,i,s",strtotime($patient->admit_time));?>)});
				});
				</script>
				<label>Outcome Date & Time</label>
				</div> 
				<div class="col-md-8">
				<input type="text" name="outcome_date" class="form-control outcome_date" value="<?php if($patient->outcome_date!=0) echo date("d-M-Y",strtotime($patient->outcome_date))." ".date("g:iA",strtotime($patient->outcome_time));?>" <?php if($f->edit==1 && $patient->outcome_date==0) echo ' '; else echo ' readonly '; ?> />
				</div>
			</div>
			<div class="col-md-12 alt ">
				<div class="col-md-2">
				<label class="control-label">Final Diag.</label>
				</div>
				<div class="col-md-8">
				<textarea name="final_diagnosis" class="form-control" cols="40" <?php if($f->edit==1&& empty($patient->final_diagnosis)) echo ''; else echo ' readonly'; ?> ><?php if(!!$patient->final_diagnosis) echo $patient->final_diagnosis;?></textarea>
				</div>
			</div>
			<div class="col-md-12 alt ">
				<div class="col-md-2">
				<label class="control-label">Decision</label>
				</div>
				<div class="col-md-8">
				<textarea name="decision" class="form-control" cols="40" <?php if($f->edit==1&& empty($patient->decision)) echo ''; else echo ' readonly'; ?> ><?php if(!!$patient->decision) echo $patient->decision;?></textarea>
				</div>
			</div>
			<div class="col-md-12 alt ">
				<div class="col-md-2">
				<label class="control-label">Advise</label>
				</div>
				<div class="col-md-8">
				<textarea name="advise" class="form-control" cols="40" <?php if($f->edit==1&& empty($patient->advise)) echo ''; else echo ' readonly'; ?> ><?php if(!!$patient->advise) echo $patient->advise;?></textarea>
				</div>
			</div>
			<div class="col-md-12 alt">	
				<div class="col-md-2">
					<label>ICD Code</label>
				</div>
				<div class="col-md-8">
					<select id="icd_code" class="repositories" placeholder="Search ICD codes" name="icd_code" <?php if($f->edit==1&& empty($patient->icd_10)) echo ''; else echo ' readonly'; ?> >
					<?php if(!!$patient->icd_10){ ?>
						<option value="<?php echo $patient->icd_10;?>"><?php echo $patient->icd_10." ".$patient->code_title;?></option>
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
	<br/>
<div class="col-md-12">
		<div class="panel panel-default">
		<div class="panel-heading">
		<h4>Search Patients</h4>	
		</div>
		<div class="panel-body">
		<?php echo form_open("register/update_patients",array('role'=>'form','class'=>'form-custom')); ?>
					<div class="row">
					<div class="col-md-10">
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
	