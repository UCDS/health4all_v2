<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/table2CSV.js"></script>
<script type="text/javascript">
$(function(){
	$("#from_date,#to_date").Zebra_DatePicker();
	$("#generate-csv").click(function(){
		$(".table").table2CSV();
	});
});
</script>
	<div class="row">
		<h4>In-Patient Detailed report</h4>	
		<?php echo form_open("reports/ip_detail",array('role'=>'form','class'=>'form-custom')); ?> 
					From Date : <input type="text" class="form-control" value="<?php echo date("d-M-Y"); ?>" name="from_date" id="from_date" size="15" />
					To Date : <input type="text" class="form-control" value="<?php echo date("d-M-Y"); ?>" name="to_date" id="to_date" size="15" />
					<input type="submit" class="btn btn-primary btn-sm" value="Submit" />
		</form>
	<br />
	
	<?php 
	if(isset($report) && count($report)>0){ ?>
	<table class="table table-bordered table-striped">
	<thead>
		<th>IP No.</th>
		<th>Gender</th>
		<th>Name</th>
		<th>Age</th>
		<th>Parent / Spouse</th>
		<th>Place</th>
		<th>Phone</th>
		<th>Department</th>
	</thead>
	<tbody>
	<?php 
	$total_count=0;
	foreach($report as $s){
	?>
	<tr>
		<td><?php echo $s->hosp_file_no;?></td>
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
	</tbody>
	</table>
		
	<?php } else { ?>
	No patient registrations on the given date.
	<?php } ?>
	</div>