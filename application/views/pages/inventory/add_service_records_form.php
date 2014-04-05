<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#date,#calldate").Zebra_DatePicker({
			});
});
</script>
		<div class="col-md-8 col-md-offset-2">
		<center>
		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
		<h3>Add Service Issue Details</h3></center><br>
	<center><?php echo validation_errors(); echo form_open('inventory/masters/add/service_records',array('role'=>'form','id'=>'add_service_record')); ?></center>

		<input type="hidden" class="form-control" placeholder=" Call Date"  form="user" id="" name="user" />

	<div class="form-group">
		<label for="drug_type" class="col-md-4">Call Date<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Call Date" form="add_service_record" id="calldate" name="call_date" />
		</div>
	</div>
	<div class="form-group">
		<label for="drug_type" class="col-md-4">Call Time<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="time" class="form-control" placeholder=" Call Time" id="drug_type" name="call_time" />
		</div>
	</div>
<div class="form-group">
		<label for="drug_type" class="col-md-4">Call Information Type</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Call Information Type" id="drug_type" name="call_information_type" />
		</div>
	</div>
<div class="form-group">
		<label for="drug_type" class="col-md-4">Call Information</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Call Information" id="drug_type" name="call_information" />
		</div>
	</div>
<div class="form-group">
		<label for="description" class="col-md-4"> Working Status<font color='red'>*</font></label>
		<div  class="col-md-8">
			<select name="working_status" id="division" class="form-control">
	<option	value="">Select Working Status</option>		
	<option	value="1">Working</option>		
	<option	value="0">Not Working</option>		<!--	<input type="text" class="form-control" placeholder=" Working Status" id="description" name="working_status" />
	
	-->
</select>

		</div>
	</div>

<div class="form-group">
		<label for="drug_type" class="col-md-4">Service Provider</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="  Service Provider" id="drug_type" name="service_provider" />
		</div>
	</div>
<div class="form-group">
		<label for="drug_type" class="col-md-4">Service Person</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="  Service Person" id="drug_type" name="service_person" />
		</div>
	</div>
<div class="form-group">
		<label for="drug_type" class="col-md-4">Service Person Remarks</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="  Service Remarks" id="drug_type" name="service_person_remarks" />
		</div>
	</div>
	<div class="form-group">

		<label for="drug_type" class="col-md-4">Service Date</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="   Service Date" id="date" form="add_service_record" name="service_date" />
		</div>
	</div>

	<div class="form-group">

		<label for="drug_type" class="col-md-4">Service Time</label>
		<div  class="col-md-8">
		<input type="time" class="form-control" placeholder="   Service Time" id="drug_type" name="service_time" />
		</div>
	</div>

	<div class="form-group">
		<label for="description" class="col-md-4"> Problem Status</label>
		<div  class="col-md-8">
		
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