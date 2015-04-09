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
		<h3>Add Vendor Details</h3>
	</center><br>
	
	<center>
		<?php echo validation_errors(); ?>
	</center>
	<?php 
	echo form_open('vendor/add/vendor',array('class'=>'form-horizontal','role'=>'form','id'=>'add_vendor')); 
	?>
	
	<div class="form-group">
		<label for="vendor_name" class="col-md-3"> Vendor name<font color='red'>*</font></label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Vendor" id="vendor_name" name="vendor_name" required />
		</div>
	</div>
	
	
	<div class="form-group">
		<div class="col-md-3">
			<label for="vendor_type_id" >Vendor Type<font color='red'>*</font></label>
		</div>
		<div class="col-md-6">
			<select name="vendor_type_id" id="vendor_type_id" class="form-control">
		<option value="">--select--</option>
		<?php foreach($vendor_types as $d){
			echo "<option value='$d->vendor_type_id'>$d->vendor_type</option>";
		}
		?>
		</select>
		
		</div>
	</div>
	
	<div class="form-group">
		<label for="vendor_address" class="col-md-3"> Address</label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Address" id="vendor_address" name="vendor_address" />
		</div>
	</div>
	<div class="form-group">
		<label for="vendor_city" class="col-md-3"> City</label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" City" id="vendor_city" name="vendor_city" />
		</div>
	</div>
	<div class="form-group">
		<label for="vendor_state" class="col-md-3"> State</label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" State" id="description" name="vendor_state" />
		</div>
	</div>
	<div class="form-group">
		<label for="vendor_country" class="col-md-3"> Country</label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Country" id="vendor_country" name="vendor_country" />
		</div>
	</div>
	<div class="form-group">
		<label for="account_no" class="col-md-3"> Bank Account Number</label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Bank Account Number" id="account_no" name="account_no" />
		</div>
	</div>
	
	<div class="form-group">
		<label for="bank_name" class="col-md-3"> Bank Name</label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Bank Name" id="bank_name" name="bank_name" />
		</div>
	</div>
	<div class="form-group">
		<label for="branch" class="col-md-3"> Bank Branch</label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Bank Branch" id="branch" name="branch" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label for="vendor_email" > Email</label>
		</div>
		<div class="col-md-6">
		<input type="text"  class="form-control" placeholder=" Email" id="vendor_email" name="vendor_email" />
		</div>
	</div>
	<div class="form-group">
		<label for="vendor_phone" class="col-md-3"> Phone Number</label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder="Phone number" id="vendor_phone" name="vendor_phone" />
		
		</div>
	</div>
	<div class="form-group">
		<label for="vendor_pan" class="col-md-3"> PAN</label>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" PAN" id="vendor_pan" name="vendor_pan" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-3">
			<label for="contact_person_id">  Primary Contact Person</label>
		</div>
		<div class="col-md-6">
			<select name="contact_person_id" id="vendor" class="form-control">
		<option value="">--select--</option>
		<?php foreach($contact_persons as $d){
			echo "<option value='$d->contact_person_id'>$d->contact_person_first_name $d->contact_person_first_name </option>";
		}
		?>
		</select>
		
		</div>
	</div>
	
	
	</div>	
	
	<input type="hidden" class="form-control" value='1' placeholder=" Service Engineer Contact" id="description" name="user" />
	
	
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit">Submit</button>
	</div>
</div>