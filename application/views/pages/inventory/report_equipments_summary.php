	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<div class="col-md-2"><h3>Equipments</h3></div>
	<div class="col-md-7 col-md-offset-2">
		<?php echo form_open("equipments/view/equipments_summary",array("role"=>"form","class"=>"form-custom"));?>
		<label class="control-label">Filter By..</label>
		<div class="form-group">
		<select name="department" id="department" class="form-control">
		<option value="">Department</option>
		<?php foreach($department as $d){
			echo "<option value='$d->department_id'>$d->department</option>";
		}
		?>
		</select>
		</div>
		<div class="form-group">
		<select name="area" id="area" class="form-control">
		<option value="">Area</option>
		<?php foreach($areas as $a){
			echo "<option value='$a->area_id' class='$a->department_id'>$a->area_name</option>";
		}
		?>
		</select>
		</div>
		<div class="form-group">
		<select name="unit" id="unit" class="form-control">
		<option value="">Unit</option>
		<?php foreach($units as $u){
			echo "<option value='$u->unit_id' class='$u->department_id'>$u->unit_name</option>";
		}
		?>
		</select>
		</div>
	</div>
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
		<td><a href="<?php echo base_url()."equipments/view/equipments_detailed/$s->equipment_type_id";?>"><?php echo $s->equipment_type;?></a></td>
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
