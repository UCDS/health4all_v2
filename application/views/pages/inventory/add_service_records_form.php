<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#date,#calldate").Zebra_DatePicker({
			});
	$("#vendor").on('change',function(){
		var vendor_id=$(this).val();
		$("#contact_person_id option").hide();
		$("#contact_person_id option[class="+vendor_id+"]").show();
	});
});
</script>

<div class="col-md-8 col-md-offset-2">
	
	<center>
		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
		<h3>Add Service Issue Details</h3>
	</center><br>
	
	<center>
		<?php echo validation_errors(); ?>
	</center>
	<?php 
	echo form_open('equipments/add/service_records',array('class'=>'form-horizontal','role'=>'form','id'=>'add_service_record')); 
	?>
	
		<input type="hidden" class="form-control" placeholder=" Call Date"  form="user" id="" name="user" />

	<div class="form-group">
		<div class="col-md-3">
		<label for="drug_type" >Call Date<font color='red'>*</font></label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Call Date" form="add_service_record" id="calldate" name="call_date" />
		</div>
	</div>
	<div class="form-group">
	<div class="col-md-3">
		<label for="drug_type" >Call Time<font color='red'>*</font></label>
		</div>
		<div  class="col-md-6">
		<input type="time" class="form-control" placeholder=" Call Time" id="drug_type" name="call_time" />
		</div>
	</div>
<div class="form-group">
<div class="col-md-3">
		<label for="drug_type" >Call Information Type</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Call Information Type" id="drug_type" name="call_information_type" />
		</div>
	</div>
<div class="form-group">
<div class="col-md-3">
		<label for="drug_type" >Call Information</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Call Information" id="drug_type" name="call_information" />
		</div>
	</div>
<div class="form-group">
<div class="col-md-3">
		<label for="description" > Working Status<font color='red'>*</font></label>
		</div>
		<div  class="col-md-6">
			<select name="working_status" id="division" class="form-control">
	<option	value="">Select Working Status</option>		
	<option	value="1">Working</option>		
	<option	value="0">Not Working</option>
</select>

		</div>
	</div>




	<div class="form-group">
		<div class="col-md-3">
			<label for="vendor" >Vendor<font color='red'>*</font></label>
		</div>
		<div class="col-md-6">
			<select name="vendor" id="vendor" class="form-control">
		<option value="">--select--</option>
		<?php foreach($vendors as $d){
			echo "<option value='$d->vendor_id'>$d->vendor_name</option>";
		}
		?>
		</select>
		
		</div>
	</div>
	
		
	
	<div class="form-group">
		<div class="col-md-3">
			<label for="contact_person_id" > Contact Person</label>
		</div>
		<div class="col-md-6">
			<select name="contact_person" id="contact_person_id" class="form-control">
		<option value="">--select--</option>
		<?php foreach($contact_persons as $d){
			echo "<option value='$d->contact_person_id' class='$d->vendor_id' >$d->contact_person_first_name  $d->contact_person_last_name</option>";
		}
		?>
		</select>
		</div>
	</div>
	

<!--
<div class="col-md-3">
<div class="col-md-3">
		<label for="drug_type" >Service Provider</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder="  Service Provider" id="drug_type" name="service_provider" />
		</div>
	</div>
<div class="form-group">
<div class="col-md-3">
		<label for="drug_type" >Service Person</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder="  Service Person" id="drug_type" name="service_person" />
		</div>
	</div>
-->	
	
<div class="form-group">
<div class="col-md-3">
		<label for="drug_type" >Service Person Remarks</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder="  Service Remarks" id="drug_type" name="service_person_remarks" />
		</div>
	</div>
	<div class="form-group">
	<div class="col-md-3">
		<label for="drug_type" >Service Date</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder="   Service Date" id="date" form="add_service_record" name="service_date" />
		</div>
	</div>

	<div class="form-group">
	<div class="col-md-3">
		<label for="drug_type" >Service Time</label>
		</div>
		<div  class="col-md-6">
		<input type="time" class="form-control" placeholder="   Service Time" id="drug_type" name="service_time" />
		</div>
	</div>

	<div class="form-group">
	<div class="col-md-3">
		<label for="description" class="col-md-3> Problem Status</label>
		</div>
		<div  class="col-md-6">
		
<select name="problem_status" class="form-control">
		<option value="">Select Problem Status</option>

	<option value="Issue Reported">Issue Reported</option>
	<option value="Service Visit Made">Service Visit Made</option>
	<option value="Under Observation">Under Observation</option>
	<option value="Issue Resolved">Issue Resolved</option>



</select>


		</div>
	</div>
	
<br>

   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit">Submit</button>
	</div>
</div>