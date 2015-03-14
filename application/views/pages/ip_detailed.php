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
		<th>Sno</th>
		<th>Admit Date</th>
		<th>IP No.</th>
		<th>Gender</th>
		<th>Name</th>
		<th>Age</th>
		<th>Parent / Spouse</th>
		<th>Address</th>
		<th>Phone</th>
		<th>Department</th>
		<th>Unit</th>
		<th>MLC Number</th>
	</thead>
	<tbody>
	<?php 
	$total_count=0;
	$i=1;
	foreach($report as $s){
	?>
	<tr>
		<td><?php echo $i++;?></td>
		<td><?php if($s->admit_date!=0) echo date("d-M-Y",strtotime($s->admit_date));?></td>
		<td><?php echo $s->hosp_file_no;?></td>
		<td><?php echo $s->gender;?></td>
		<td><?php echo $s->name;?></td>
		<td><?php echo $s->age_years;?></td>
		<td><?php echo $s->parent_spouse;?></td>
		<td><?php if($s->address!="") echo $s->address.", "; if($s->place!="") echo $s->place;?></td>
		<td><?php echo $s->phone;?></td>
		<td><?php echo $s->department;?></td>
		<td><?php echo $s->unit_name;?></td>
		<td><?php echo $s->mlc_number;?></td>
	</tr>
	<?php
	$total_count++;
	}
	?>
	</tbody>
	</table>
		
	<?php } else { ?>
	No patient registrations on the given date.
	<?php } ?>
	</div>