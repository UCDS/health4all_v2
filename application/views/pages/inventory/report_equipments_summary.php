	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h3>Equipments</h3>
	
	<table class="table table-bordered">
	<thead>
		<th>#</th>
		<th>Equipment</th>
		<th>Department</th>
		<th>Unit</th>
		<th>Area</th>
		<th>Working</th>
		<th>Not Working</th>
		<th>Total</th>
	</thead>
	<tbody>

	<?php 
	$total_count=0;
	$working_total=0;
	$not_working_total=0;
	$i=1;
	foreach($summary as $s){
	?>
	<tr>
		<td><?php echo $i++;?></td>
		<td><a href="<?php echo base_url()."equipments/view/equipments_detailed/$s->equipment_type_id";?>"><?php echo $s->equipment_name;?></a></td>
		<td><a href="<?php echo base_url()."equipments/view/equipments_detailed/0/$s->department_id";?>"><?php echo $s->department;?></td>
		<td><a href="<?php echo base_url()."equipments/view/equipments_detailed/0/0/$s->area_id";?>"><?php echo $s->area_name;?></td>
		<td><a href="<?php echo base_url()."equipments/view/equipments_detailed/0/0/0/$s->unit_id";?>"><?php echo $s->unit_name;?></td>
		<td><a href="<?php echo base_url()."equipments/view/equipments_detailed/$s->equipment_type_id/$s->department_id/$s->area_id/$s->unit_id/1";?>"><?php echo $s->working;?></td>
		<td><a href="<?php echo base_url()."equipments/view/equipments_detailed/$s->equipment_type_id/$s->department_id/$s->area_id/$s->unit_id/0";?>"><?php echo $s->not_working;?></td>
		<td><a href="<?php echo base_url()."equipments/view/equipments_detailed/$s->equipment_type_id/$s->department_id/$s->area_id/$s->unit_id";?>"><?php echo $s->total;?></td>
	</tr>
	<?php
	$working_total+=$s->working;
	$not_working_total+=$s->not_working;
	$total_count+=$s->total;
	}
	?>
	<tr>
		<th colspan="5">Total </th>
		<th><a href="<?php echo base_url()."equipments/view/equipments_detailed/0/0/0/0/1";?>"><?php echo $working_total;?></th>
		<th><a href="<?php echo base_url()."equipments/view/equipments_detailed/0/0/0/0/0";?>"><?php echo $not_working_total;?></th>
		<th><a href="<?php echo base_url()."equipments/view/equipments_detailed/";?>"><?php echo $total_count;?></th>
	</tr>
	</tbody>
	</table>
	</div>
	</div>
