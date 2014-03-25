<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/table2CSV.js"></script>
<script type="text/javascript">
$(function(){
	$("#from_date,#to_date").Zebra_DatePicker();
	$(".table-2").table2CSV();
});
</script>
	<section id="right">
		<h1>Out-Patient Registration</h1>	
		<div >
		<?php echo form_open("reports/op_detail"); ?>
					From Date : <input type="text" value="<?php echo date("d-M-Y"); ?>" name="from_date" id="from_date" size="15" />
					To Date : <input type="text" value="<?php echo date("d-M-Y"); ?>" name="to_date" id="to_date" size="15" />
					<input type="submit" value="Submit" />
		</form>
	<table class="table-2">
	<tr>
		<th>Visit ID</th>
		<th>Gender</th>
		<th>Name</th>
		<th>Age</th>
		<th>Parent / Spouse</th>
		<th>Place</th>
		<th>Phone</th>
		<th>Department</th>
	</tr>
	<?php 
	$total_count=0;
	foreach($report as $s){
	?>
	<tr>
		<td><?php echo $s->visit_id;?></td>
		<td><?php echo $s->gender;?></td>
		<td><?php echo $s->name;?></td>
		<td><?php echo $s->age_years;?></td>
		<td><?php echo $s->parent_spouse;?></td>
		<td><?php echo $s->place;?></td>
		<td><?php echo $s->phone;?></td>
		<td><?php echo $s->department;?></td>
	</tr>
	<?php
	$total_count++;
	}
	?>
	<tr>
		<th>Total </th>
		<th ><?php echo $total_count;?></th>
	</tr>
	</table>
		
	</section>