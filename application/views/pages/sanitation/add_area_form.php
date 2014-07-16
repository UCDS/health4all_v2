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
		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
		<h3><u>Add Area</u></h3></center><br>
	<?php echo validation_errors(); echo form_open('sanitation/add/facility_area',array('role'=>'form')); ?>
	
	<div class="form-group">
	    <label for="area_name" class="col-md-4">Area Name</label>
	    <div class="col-md-8">
	    <input type="text" class="form-control" placeholder="area name" id="area_name" name="area_name"/>
	    </div>
	</div>
	<div class="form-group">
	    <label for="facility_name" class="col-md-4">Hospital Name</label>
	    <div class="col-md-8">
	   <select name="hospital" id="hospital_name" class="form-control">
		<option value="">Hospital</option>
		<?php foreach($hospitals as $d){
			echo "<option value='$d->hospital_id'>$d->hospital</option>";
		}
		?>
		</select>
	   </div>
	   <div class="form-group">
	    <label for="department" class="col-md-4">Department</label>
	    <div class="col-md-8">
	   <select name="department" id="district" class="form-control">
		<option value="">department</option>
		<?php foreach($departments as $d){
			echo "<option value='$d->department_id'>$d->department</option>";
		}
		?>
		</select>
	   </div>
	</div>
	<div class="form-group">
	    <label for="area_types" class="col-md-4">Area type</label>
	    <div class="col-md-8">
	   <select name="area_type" id="district" class="form-control">
		<option value="">area type</option>
		<?php foreach($area_types as $d){
			echo "<option value='$d->area_type_id'>$d->area_type</option>";
		}
		?>
		</select>
	   </div>
	</div>

	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit">submit</button>
	</div></div>
	</div>