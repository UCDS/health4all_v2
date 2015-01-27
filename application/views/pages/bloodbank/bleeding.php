
<div class="col-md-10 col-sm-9">
	<?php
	if(isset($msg)) {
		echo $msg;
		echo "<br />";
		echo "<br />";
	}
	echo validation_errors();
	if(count($donors)>0){
	?>
	<div>
		<h3>Donors waiting: </h3>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>Name</th><th>Blood Group</th><th>Blood Unit</th><th>Segment</th><th>Bag Type/ Volume</th><th>UC</th><th>Done By</th><th></th></thead>
		<?php 
		$i=1;
		foreach($donors as $donor){
		?>
		<tr>
		<?php echo form_open("bloodbank/register/bleeding");?>
			<td>
				<input type="text" value="<?php echo $donor['donation_id'];?>" size="4" name="donation_id" hidden />
				<?php echo $donor['name'];?></td>
			<td><select name="blood_group" style="width:50px;">
			<option value="" selected disabled>----</option>
			<option value="A+" <?php if($donor['blood_group']=="A+") echo "selected";?>>A+</option>
			<option value="B+" <?php if($donor['blood_group']=="B+") echo "selected";?>>B+</option>
			<option value="O+" <?php if($donor['blood_group']=="O+") echo "selected";?>>O+</option>
			<option value="AB+" <?php if($donor['blood_group']=="AB+") echo "selected";?>>AB+</option>
			<option value="A-" <?php if($donor['blood_group']=="A-") echo "selected";?>>A-</option>
			<option value="B-" <?php if($donor['blood_group']=="B-") echo "selected";?>>B-</option>
			<option value="O-" <?php if($donor['blood_group']=="O-") echo "selected";?>>O-</option>
			<option value="AB-" <?php if($donor['blood_group']=="AB-") echo "selected";?>>AB-</option>
			</select></td>
			<td><input type="number" size="6" name="blood_unit_num" required /></td>
			<td><input type="text" size="6" name="segment_num" required /></td>
			<td><select name="bag_type" style="width:70px;" required >
			<option value="" disabled selected>Bag</option>
			<option value="1">Single</option>
			<option value="2">Double</option>
			<option value="3">Triple</option>
			<option value="4">Quadruple</option>
			<option value="5">Quadruple-Sagm</option>
			</select><select name="volume" style="width:75px;" required >
			<option value="" disabled selected>Volume</option>
			<option value="350">350ml</option>
			<option value="450">450ml</option>
			</select></td>
			<td><input type="checkbox" value="1" name="incomplete" /></td>
			<td>
			<select name="staff" style="width:80px" required >
				<option value="" disabled selected>Done By</option>
				<?php foreach($staff as $s){
					echo "<option value='$s->staff_id'>$s->first_name $s->last_name</option>";
				}
				?>
			</select></td>
			<td><input type="submit" value="Update" /></td>
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

