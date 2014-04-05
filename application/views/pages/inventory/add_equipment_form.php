<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#supply_date").Zebra_DatePicker({
		
	});
	
});
</script>
		<div class="col-md-8 col-md-offset-2">
		<center>
		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
		<h3>Add Equipment Details</h3></center><br>
	<center><?php echo validation_errors(); echo form_open('equipments/add/equipment',array('role'=>'form','id'=>'add_equipment')); ?></center>
	<div class="form-group">
		<label for="equpiment" class="col-md-4">Equiment Type<font color='red'>*</font></label>
		<div  class="col-md-8">
		<select name="equipment_type" id="division" class="form-control">
		<option value="">Equipment Type</option>
		<?php foreach($equipment_types as $d){
			echo "<option value='$d->equipment_type_id'>$d->equipment_name</option>";
		}
		?>
		</select>
		
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Make</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Make" id="description" name="make" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Model</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Model" id="description" name="model" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Serial Number</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Serial Number" id="description" name="serial_number" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Asset Number</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Asset Number" id="description" name="asset_number" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Procured By</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Procured By" id="description" name="procured_by" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Cost</label>
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
		<input type="text" class="form-control" placeholder="Supply Date" id="supply_date" form="add_equipment" name="supply_date" />
		</div>
	</div>
	<div class="form-group">
		<label for="description" class="col-md-4"> Warranty Period</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Warranty Period" id="description" name="warranty_period" />
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
		<label for="agency_address" class="col-md-4">Hospital</label>
		<div  class="col-md-8">
		<select name="hospital" id="division" class="form-control">
		<option value="">Hospital </option>
		<?php foreach($hospital as $d){
			echo "<option value='$d->hospital_id'>$d->hospital</option>";
		}
		?>
		</select>
		
		</div>
	</div>
	<div class="form-group">
		<label for="agency_contact_name" class="col-md-4">Department</label>
		<div  class="col-md-8">
		<select name="department" id="division" class="form-control">
		<option value="">Department</option>
		<?php foreach($department as $d){
			echo "<option value='$d->department_id'>$d->department</option>";
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