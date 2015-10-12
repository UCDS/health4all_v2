<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<div class="col-md-10 col-sm-9">
	<?php
	if(isset($msg)) {
		echo "<div class='alert alert-info'>$msg</div>";
		echo "<br />";		
	}
	if(validation_errors()){
		echo "<div class='alert alert-danger'>".validation_errors()."</div>";
	}
	if(count($donors)>0){
	?>
	<div>
		<h4>Donors waiting: </h4>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>Name</th>
				<th><div data-toggle="popover" data-placement="bottom" data-content="Please enter  Blood group">
																  
				Blood Group</div></th>
				<th><div data-toggle="popover" data-placement="bottom" data-content="Please enter  Blood Unit">
																  
				Blood Unit</div></th>
				<th><div data-toggle="popover" data-placement="bottom" data-content="Please enter  Segment Number">
																  
				Segment</div></th>
				<th><div data-toggle="popover" data-placement="bottom" data-content="Please enter  Bag Type/ Volume">
																  
				Bag Type/ Volume</div></th>
				<th><div data-toggle="popover" data-placement="bottom" data-content="Under Collection ">
																  
				UC</div></th>
				<th><div data-toggle="popover" data-placement="bottom" data-content="Staff Name ">
																  
				Done By</div></th>
				<th></th>
				</thead>
		<?php 
		$i=1;
		foreach($donors as $donor){
		?>
		<tr>
		<?php echo form_open("bloodbank/register/bleeding");?>

			<td>
				<input type="text" value="<?php echo $donor->donation_id;?>" size="4" name="donation_id" hidden />
				<?php echo $donor->name;?>
			</td>
			<td><div class="form-group"><select name="blood_group" class="form-control" >
			<option value="" selected disabled>----</option>
			<option value="A+" <?php if($donor->blood_group=="A+") echo "selected";?>>A+</option>
			<option value="B+" <?php if($donor->blood_group=="B+") echo "selected";?>>B+</option>
			<option value="O+" <?php if($donor->blood_group=="O+") echo "selected";?>>O+</option>
			<option value="AB+" <?php if($donor->blood_group=="AB+") echo "selected";?>>AB+</option>
			<option value="A-" <?php if($donor->blood_group=="A-") echo "selected";?>>A-</option>
			<option value="B-" <?php if($donor->blood_group=="B-") echo "selected";?>>B-</option>
			<option value="O-" <?php if($donor->blood_group=="O-") echo "selected";?>>O-</option>
			<option value="AB-" <?php if($donor->blood_group=="AB-") echo "selected";?>>AB-</option>
			</select></div></td>
			<td><div class="form-group"><input type="number" class="form-control" name="blood_unit_num" required /></div></td>
			<td><div class="form-group"><input type="text" class="form-control" name="segment_num" required /></div></td>
			<td>
			<div class="form-group col-lg-6">
				<select name="bag_type" style="width:100px" class="form-control" required >
				<option value="" disabled selected>Bag</option>
				<option value="1">Single</option>
				<option value="2">Double</option>
				<option value="3">Triple</option>
				<option value="4">Quadruple</option>
				<option value="5">Quadruple-Sagm</option>
				</select>
			</div>
			<div class="form-group col-lg-6">
			<select name="volume" class="form-control" required >
			<option value="" disabled selected>Vol</option>
			<option value="350">350ml</option>
			<option value="450">450ml</option>
			</select></div></td>
			<td><div class="checkbox"><input type="checkbox" value="1" name="incomplete" /></div></td>
			<td><div class="form-group">
			<select name="staff" class="form-control" required >
				<option value="" disabled selected>Done By</option>
				<?php foreach($staff as $s){
					echo "<option value='$s->staff_id'>$s->first_name $s->last_name</option>";
				}
				?>
			</select></div></td>
			<td><div class="form-group"><input type="submit" class="btn btn-primary" value="Update" /></div></td>
		</form>
		</tr>
		<?php 
		$i++;
		}
		?>
		</table>
			
	</div>
	<?php 
	}
	else if(isset($donor_details)){
	}
	else{
		echo "No donors waiting.";
	}
	?>
</div>

