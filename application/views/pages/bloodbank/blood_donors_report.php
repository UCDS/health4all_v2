<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(function(){
		$(".date").Zebra_DatePicker({
			direction:false
		});
	});
</script>
<div class="col-md-10 col-sm-9">
	<h1>Donors Report</h1>
	<?php echo form_open('bloodbank/user_panel/blood_donors'); ?>
	<div>
		<input type="text" class="date" size="12" name="donation_date" />
		<select name="blood_group" style="width:50px;">
			<option value="" selected disabled>----</option>
			<option value="A+">A+</option>
			<option value="B+">B+</option>
			<option value="O+">O+</option>
			<option value="AB+">AB+</option>
			<option value="A-">A-</option>
			<option value="B-">B-</option>
			<option value="O-">O-</option>
			<option value="AB-">AB-</option>
		</select>
		<input type="submit" name="submit" value="Search" />
	</div>
	
	<?php 
	if($this->input->post('donation_date')) echo "Donors who donated on or before ".date("d-M-y",strtotime($this->input->post('donation_date'))). " | ";
	if($this->input->post('blood_group')) echo "Blood Group : ".$this->input->post('blood_group');
	if(count($donors)>0){ ?>
	<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
	<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead>
		<th>S.No</th>
		<th>Donor No.</th>
		<th>Name</th>
		<th>Age</th>
		<th>Sex</th>
		<th>Blood Group</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Address</th>
		<th>Last Donated on</th>
		<th>Status</th>
		</thead>
	<?php 
	$i=1;
	foreach($donors as $s){
	?>
	<tr>
		<td><?php echo $i++;?></td>
		<td><?php echo $s['blood_unit_num'];?></td>
		<td><?php echo $s['name'];?></td>
		<td><?php echo $s['age'];?></td>
		<td><?php echo $s['sex'];?></td>
		<td><?php echo $s['blood_group'];?></td>
		<td><?php echo $s['email'];?></td>
		<td><?php echo $s['phone'];?></td>
		<td><?php echo $s['address'];?></td>
		<td><?php if($s['donation_date']!=0) echo date("d-M-y",strtotime($s['donation_date']));?></td>
		<td><?php echo $s['status'];?></td>
	</tr>
	<?php
	}
	?>
	</table>
	<?php } 
	else {
	?>
	<h2> No Donors found</h2>
	<?php } ?>
</div>
