<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(function(){
		var rowcount=1;
		$("#donation_date").Zebra_DatePicker({
			direction:false
		});
	});
</script>
<div class="col-md-10 col-sm-9">
	<?php 
	echo validation_errors();
	if(isset($msg)) {
		echo $msg;
		echo "<br />";
		echo "<br />";
	}
	?>
	<table class="table-2 table table-striped table-bordered">
	<?php
	foreach($donor_details as $donor){
		echo "Donation ID: ".$donor['donation_id'];
		echo " | Name: ".$donor['name'];
		echo " | Age: ".$donor['age'];
		echo " | Blood Group: ".$donor['blood_group'];
		$donation_id=$donor['donation_id'];
	}
	?>
	</table>

	<div class="panel panel-default">
	<div class="panel panel-heading">
	<h3>Register Blood Donation</h3>
	</div>
	<?php echo form_open("bloodbank/register/medical_checkup/0/$donation_id",array('class'=>'form-custom'));?>
	<div class="panel-body" >
	<label class="col-md-4"> Weight : </label>
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
			<input type="text" placeholder="Weight" class="form-control" id="weight" name="weight" required />Kgs
		</div><br/>
	<label class="col-md-4" >Pulse : </label>
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
			<input type="text" placeholder="Pulse" class="form-control" id="pulse" name="pulse" required />/min
	</div><br />
	<label class="col-md-4" >Hb: </label> 
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Hb" class="form-control" id="hb" name="hb" required />gm/dL
	</div><br />
		<label class="col-md-4" >Bp: </label>  
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="SBP" class="form-control" id="sbp" name="sbp" required />/
		<input type="text" placeholder="DBP" id="dbp" class="form-control"name="dbp" required />
	</div><br />
		<label class="col-md-4" >Temperature: </label> 
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Temperature" class="form-control" id="temperature" name="temperature" required />
	</div><br />
	<label class="col-md-4" >Date of Donation: </label> 
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Date of Donation" class="form-control" id="donation_date" name="donation_date" required />
	</div><br />
	</div>
	<div class="panel-footer" style="margin-top:5px;margin-bottom:5px;">
		<div class="form-group">
			<input type="submit" value="Submit" class="btn btn-primary" name="update_medical" />
		</div>
	</div>
	<h1>Register Blood Donation</h1>
	<?php echo form_open("bloodbank/register/medical_checkup/0/$donation_id");?>
	<table>
	<tr><td>Weight : </td><td><input type="text" placeholder="Weight" size="5" id="weight" name="weight" required />Kgs</td></tr>
	<tr><td>Pulse : </td><td><input type="text" placeholder="Pulse" size="4" id="pulse" name="pulse" required />/min</td></tr>
	<tr><td>Hb : </td><td><input type="text" placeholder="Hb" size="3" id="hb" name="hb" required />gm/dL</td></tr>
	<tr><td>BP : </td><td><input type="text" placeholder="SBP" size="3" id="sbp" name="sbp" required />/<input type="text" placeholder="DBP" size="3" id="dbp" name="dbp" required /></td></tr>
	<tr><td>Temperature : </td><td><input type="text" placeholder="Temperature" size="8" id="temperature" name="temperature" required /></td></tr>
	<tr><td>Date of Donation</td><td><input type="text" placeholder="Date of Donation" size="15" id="donation_date" name="donation_date" required /></td></tr>
	<tr><td colspan="2"><input type="submit" value="Submit" name="update_medical" /></td></tr>
	</table>
	</form>
</div>
</div>
