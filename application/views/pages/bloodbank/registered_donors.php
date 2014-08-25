<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(function(){
		$("#slot_date").Zebra_DatePicker();
	});
</script>

<div class="col-md-10 col-sm-9">

	<div>
		<?php echo form_open('bloodbank/register/donation'); ?>
		<div>
			<input type="text" placeholder="Slot date" size="10" name="slot_date" id="slot_date" />
			<input type="text" placeholder="Appointment ID" size="12" name="app_id" />
			<input type="submit" value="Search" name="search" />
		</div>
		</form>
		<?php
		if(isset($msg)) {
			echo $msg;
			echo "<br />";
			echo "<br />";
		}
		?>
		<h3>Registered donors : </h3>
		<table class="table-2 table table-striped table-bordered">
			<tr><th>S.No</th><th>Name</th><th>Age</th><th>Blood Group</th><th>Phone</th><th></th></tr>
		<?php 
		$i=1;
		foreach($donors as $donor){
		?>
		<tr>
		<form>
			<td><?php echo $i;?></td>
			<td><?php echo $donor['name'];?></td>
			<td><?php echo $donor['age'];?></td>
			<td><?php if($donor['blood_group']!='' && $donor['blood_group']!='0'){  echo $donor['blood_group'];}?></td>
			<td><?php echo $donor['phone'];?></td>
			<td>
				<input type="submit" value="Update" formaction="<?php echo base_url();?>register/medical_checkup/0/<?php echo $donor['donation_id'];?>" />
				<input type="submit" value="X" formaction="<?php echo base_url();?>register/delete_donor/$donation_id"/></td>
		</form>
		</tr>
		<?php 
		$i++;
		}
		?>
		</table>
		<?php if(count($appointments)>0){ ?>
		<table class='table-2'>
			<tr><th colspan="10">Appointments for current slot</th></tr>
			<tr><th>App ID</th><th>Name</th><th>Age</th><th>Blood Group</th><th>Phone</th><th></th></tr>
		<?php 
		$i=1;
		foreach($appointments as $donor){
		?>
		<tr>
		<?php echo form_open('bloodbank/register/medical_checkup/'.$donor['donor_id']);?>
			<td><?php echo $donor['appointment_id'];?>
			<input type="text" value="<?php echo $donor['appointment_id'];?>" name="appointment_id" hidden /></td>
			<td><?php echo $donor['name'];?></td>
			<td><?php echo $donor['age'];?></td>
			<td><?php if($donor['blood_group']!="" && $donor['blood_group']!='0'){ echo $donor['blood_group']; }?></td>
			<td><?php echo $donor['phone'];?></td>
			<td>
				<input type="submit" value="Update" />
				<input type="button" value="X" /></td>
		</form>
		</tr>
		<?php 
		$i++;
		}
		?>
		</table>
		<?php } ?>
<!--
		<table class='table-2'>
		<tr><th colspan='2'>Search donors</th></tr>
		<tr>
			<td>Search By: </td>
			<td>
				<select name="search_type">
					<option value="appointment_id">Appointment ID</option>
					<option value="phone">Donor mobile</option>
					<option value="name">Name</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Seach:</td>
			<td><input type="text" name="search" /></td>
		</tr>
		</table>
-->			
	</div>
</div>

