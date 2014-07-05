<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#agreement_date").Zebra_DatePicker({
		direction:false
	});
	$("#probable_date_of_completion,#agreement_completion_date").Zebra_DatePicker({
		direction:1
	});
});
</script>
		<div class="col-md-8 col-md-offset-2">
		<center>
		<strong><?php 
		echo validation_errors(); 
		if(isset($msg)){ echo $msg;}?></strong>
		<h3><u>Add Staff</u></h3></center><br>
	<?php echo validation_errors(); echo form_open('masters/add/staff',array('role'=>'form')); ?>
	
	<div class="form-group">
	    <label for="first_name" class="col-md-4">First name</label>
	    <div class="col-md-8">
	    <input type="text" class="form-control" placeholder="First name" id="first_name" name="first_name"/>
	    </div>
	</div>
	
	<div class="form-group">
		<label for="last_name" class="col-md-4">Last Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name" />
		</div>
	</div>
	
    <div class="form-group">
		<label for="Staff-level" class="col-md-4">Staff level</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="staff level" id="staff_level" name="staff_level" />
		</div>
	</div>
	<div class="form-group">
		<label for="phone_number" class="col-md-4">Phone Number</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="phone number" id="phone_number" name="phone_number" />
		</div>
	</div>
    <div class="form-group">
	    <label for="email" class="col-md-4">Email Id</label>
		<div class="col-md-8">
		<input type="text"class="form-control" placeholder="email" id="email" name="email_id"/>
		</div>
	</div>
	<div class="form_group">
		 <label for="gender" class="col-md-4">Gender</label>
		<div class="col-md-8">
   <input type="radio" name="gender" value="female">Female
   <input type="radio" name="gender" value="male">Male
   <span class="error"> </span>
   <br><br>
		</div>
</div>
<div class="form-group">
		<label for="department_name" class="col-md-4">department name</label>
		<div  class="col-md-8">
		<select name="department" id="department_name" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($department as $d){
			echo "<option value='$d->department_id'>$d->department_name</option>";
		}
		?>
		</select>
		</div>	</div>
	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>