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
		<h3><u>Add Facility Activity</u></h3></center><br>
	<?php echo validation_errors(); echo form_open('masters/add/facility_activity',array('role'=>'form')); ?>
	
	<div class="form-group">
	    <label for="facility_area" class="col-md-4"> Area Activity</label>
	    <div class="col-md-8">
	    <select name="area_activity" id="district" class="form-control">
		<option value="">Area Activity</option>
		<?php foreach($area_activity as $d){
			echo "<option value='$d->area_activity_id'>$d->activity_name</option>";
		}
		?>
		</select>
		
		</div>

	<div class="form-group">
	    <label for="area_activity" class="col-md-4">Facility area</label>
	    <div class="col-md-8">
<select name="facility_area" id="district" class="form-control">
		<option value="">Facility Area</option>
		<?php foreach($facility_area as $d){
			echo "<option value='$d->facility_area_id'>$d->area_name</option>";
		}
		?>
		</select>
			   
	   </div></div>
	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
	</div>
</div></div>