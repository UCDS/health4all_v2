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
