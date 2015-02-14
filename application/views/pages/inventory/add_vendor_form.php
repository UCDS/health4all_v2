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
		<h3>Add Vendor Details</h3></center><br>
	<center><?php echo validation_errors(); echo form_open('equipments/add/vendor',array('role'=>'form','id'=>'add_vendor')); ?></center>
	
	<div class="form-group">
		<label for="vendor_name" class="col-md-4"> Vendor</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Vendor" id="vendor_name" name="vendor" />
		</div>
	</div>
	<div class="form-group">
		<label for="vendor_address" class="col-md-4"> Address</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Address" id="vendor_address" name="model" />
		</div>
	</div>
	<div class="form-group">
		<label for="vendor_city" class="col-md-4"> City</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" City" id="vendor_city" name="serial_number" />
		</div>
	</div>
	<div class="form-group">
		<label for="vendor_state" class="col-md-4"> State</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" State" id="description" name="vendor_state" />
		</div>
	</div>
	<div class="form-group">
		<label for="vendor_country" class="col-md-4"> Country</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Procured By" id="vendor_country" name="procured_by" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Bank Account Number</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Cost" id="description" name="cost" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Supplier</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Supplier" id="description" name="supplier" />
		</div>
	</div>
	<div class="form-group">
		<label for="supply_date" class="col-md-4"> Supply Date</label>
		<div  class="col-md-8">
		<input type="text" class="form-control date" placeholder="Supply Date" id="supply_date" form="add_equipment" name="supply_date" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Warranty Period</label>
		<div  class="col-md-8">
		<input type="text" class="form-control date" placeholder="Start" form="add_equipment" id="warranty_start_date" name="warranty_start_date" />
		<input type="text" class="form-control date" placeholder="End"  form="add_equipment" id="warranty_end_date" name="warranty_end_date" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Service Engineer</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Service Engineer" id="description" name="service_engineer" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4">  Service Engineer Contact</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Service Engineer Contact" id="description" name="service_engineer_contact" />
		</div>
	</div>
	<div class="form-group">
		<label for="agency_contact_name" class="col-md-4">Department</label>
		<div  class="col-md-8">
		<select name="department" id="department" class="form-control">
		<option value="">Department</option>
		<?php foreach($department as $d){
			echo "<option value='$d->department_id'>$d->department</option>";
		}
		?>
		</select>
		
		</div>
	</div>	
		<div class="form-group">
		<label for="area" class="col-md-4">Area</label>
		<div  class="col-md-8">
		<select name="area" id="area" class="form-control">
		<option value="">Area</option>
		<?php foreach($areas as $a){
			echo "<option value='$a->area_id' class='$a->department_id'>$a->area_name</option>";
		}
		?>
		</select>
		
		</div>
	</div>	
	<div class="form-group">
		<label for="unit" class="col-md-4">Unit</label>
		<div  class="col-md-8">
		<select name="unit" id="unit" class="form-control">
		<option value="">Unit</option>
		<?php foreach($units as $u){
			echo "<option value='$u->unit_id' class='$u->department_id'>$u->unit_name</option>";
		}
		?>
		</select>
		
		</div>
	</div>	
	<input type="hidden" class="form-control" value='1' placeholder=" Service Engineer Contact" id="description" name="user" />
	
	<div class="form_group">
		<label for="agency_contact_no" class="col-md-4">  Equipment Status</label>
		<div  class="col-md-8">
<select name="equipment_status"  id="equipment_status" class="form-control">
<option value="">Select Status</option>

<option value="1">Working</option>
<option value="0">Not Working</option>
</select>
	</div>
	</div>
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit">Submit</button>
	</div>
</div>