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

<div class="form-group">
		<label for="drug_type" class="col-md-4">User<font color='red'>*</font></label>
		<div  class="col-md-8">
<select name="user" id="division" class="form-control">
		<option value="">Select User</option>
		<?php foreach($user as $d){
			echo "<option value='$d->user_id'>$d->username</option>";
		}
		?>
		</select>
		</div></div>
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
		<label for="drug_type" class="col-md-4">Call Information Type<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Call Information Type" id="drug_type" name="call_information_type" />
		</div>
	</div>
<div class="form-group">
		<label for="drug_type" class="col-md-4">Call Information<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Call Information" id="drug_type" name="call_information" />
		</div>
	</div>
<div class="form-group">
		<label for="drug_type" class="col-md-4">Service Provider<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="  Service Provider" id="drug_type" name="service_provider" />
		</div>
	</div>
<div class="form-group">
		<label for="drug_type" class="col-md-4">Service Person<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="  Service Person" id="drug_type" name="service_person" />
		</div>
	</div>
<div class="form-group">
		<label for="drug_type" class="col-md-4">Service Person Remarks<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="  Service Remarks" id="drug_type" name="service_person_remarks" />
		</div>
	</div>
	<div class="form-group">

		<label for="drug_type" class="col-md-4">Service Date<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="   Service Date" id="date" form="add_service_record" name="service_date" />
		</div>
	</div>

	<div class="form-group">

		<label for="drug_type" class="col-md-4">Service Time<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="time" class="form-control" placeholder="   Service Time" id="drug_type" name="service_time" />
		</div>
	</div>

	<div class="form-group">
		<label for="description" class="col-md-4"> Problem Status<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Problem Status" id="description" name="problem_status" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Working Status<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Working Status" id="description" name="working_status" />
		</div>
	</div>

<br>

   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit">Submit</button>
	</div>
</div>