	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h3>Equipments</h3>
	
	<table class="table table-bordered">
	<thead>
		<th>#</th>
		<th>Equipment</th>
		<th>Make</th>
		<th>Model</th>
		<th>Serial No.</th>
		<th>Asset No.</th>
		<th>Procured By</th>
		<th>Cost</th>
		<th>Vendor (Supplier)</th>
		<th>Supplied Date</th>
		<th>Warranty Period</th>
		<th>Serivce Engineer</th>
		<th>Service Engineer Contact</th>
		<th>Department</th>
		<th>Equipment Status</th>
	</thead>
	<tbody>

	<?php 
	$total_count=0;
	$i=1;
	foreach($equipments as $e){
	?>
	<tr>
		<td><?php echo $i++;?></td>
		<td><?php echo $e->equipment_type;?></td>
		<td><?php echo $e->make;?></td>
		<td><?php echo $e->model;?></td>
		<td><?php echo $e->serial_number;?></td>
		<td><?php echo $e->asset_number;?></td>
		<td><?php echo $e->procured_by;?></td>
		<td><?php echo number_format($e->cost);?></td>
		<td><?php echo $e->vendor_name;?></td>
		<td><?php if($e->supply_date!=0) echo date("d-M-Y",strtotime($e->supply_date));?></td>
		<td><?php if($e->warranty_start_date!=0 && $e->warranty_end_date!=0) echo date("d-M-y",strtotime($e->warranty_start_date))." to ".date("d-M-y",strtotime($e->warranty_end_date));?></td>
		<td><?php echo $e->contact_person_first_name. " " .$e->contact_person_last_name;?></td>
		<td><?php echo $e->contact_person_contact;?></td>
		<td><?php echo $e->department;?></td>
		<td><?php if($e->equipment_status==1) echo "Working"; else echo "Not Working";?></td>
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
	</div>
	</div>
