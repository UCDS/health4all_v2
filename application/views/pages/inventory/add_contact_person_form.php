<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#warranty_start_date,#warranty_end_date").Zebra_DatePicker();
	$("#supply_date").Zebra_DatePicker({
		onSelect : function(date){
		$("#warranty_start_date").val(date);
		}
	});
	$("#department").on('change',function(){
		var department_id=$(this).val();
		$("#unit option,#area option").hide();
		$("#unit option[class="+department_id+"],#area option[class="+department_id+"]").show();
	});
});
</script>
		<div class="col-md-8 col-md-offset-2">
		<center>
		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
		<h3>Add Contact Person Details</h3></center><br>
	<center><?php echo validation_errors(); echo form_open('equipments/add/contact_person',array('role'=>'form','id'=>'add_contact_person')); ?></center>
	
	<div class="form-group">
		<label for="contact_person_first_name" class="col-md-4"> First Name<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" First Name" id="description" name="contact_person_first_name" required />
		</div>
	</div>
	<div class="form-group">
		<label for="contact_person_last_name" class="col-md-4"> Last Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Last Name" id="description" name="contact_person_last_name" />
		</div>
	</div>
	<div class="form-group">
		<label for="contact_person_contact" class="col-md-4"> Contact Number<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Contact Number" id="description" name="contact_person_contact" required />
		</div>
	</div>
	<div class="form-group">
		<label for="contact_person_email" class="col-md-4"> Contact Email</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Contact Email" id="description" name="contact_person_email" />
		</div>
	</div>
	<div class="form-group">
		<label for="vendor" class="col-md-4">Vendor<font color='red'>*</font></label>
		<div  class="col-md-8">
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
		<label for="description" class="col-md-4"> Gender</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Procured By" id="description" name="procured_by" />
		</div>
	</div>
	<div class="form-group">
		<label for="designation" class="col-md-4"> Designation</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Designation" id="description" name="designation" />
		</div>
	</div>
	
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit">Submit</button>
	</div>
</div>