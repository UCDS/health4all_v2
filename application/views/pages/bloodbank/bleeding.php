
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
		<thead><th>Name</th><th>Blood Group</th><th>Blood Unit</th><th>Segment</th><th>&nbsp;&nbsp;&nbsp;&nbsp;Bag Type/ Volume</th><th>UC</th><th>Done By</th><th></th></thead>
		<?php 
		$i=1;
		foreach($donors as $donor){
		?>
		<tr>
		<?php echo form_open("bloodbank/register/bleeding");?>
			<td width="15%">
				<input type="text" value="<?php echo $donor['donation_id'];?>" size="4" name="donation_id" hidden />
				<?php echo $donor['name'];?></td>
			<td width="10%"><div class="form-group"><select name="blood_group" class="form-control" >
			<option value="" selected disabled>----</option>
			<option value="A+" <?php if($donor['blood_group']=="A+") echo "selected";?>>A+</option>
			<option value="B+" <?php if($donor['blood_group']=="B+") echo "selected";?>>B+</option>
			<option value="O+" <?php if($donor['blood_group']=="O+") echo "selected";?>>O+</option>
			<option value="AB+" <?php if($donor['blood_group']=="AB+") echo "selected";?>>AB+</option>
			<option value="A-" <?php if($donor['blood_group']=="A-") echo "selected";?>>A-</option>
			<option value="B-" <?php if($donor['blood_group']=="B-") echo "selected";?>>B-</option>
			<option value="O-" <?php if($donor['blood_group']=="O-") echo "selected";?>>O-</option>
			<option value="AB-" <?php if($donor['blood_group']=="AB-") echo "selected";?>>AB-</option>
			</select></div></td>
			<td width="10%"><div class="form-group"><input type="number" class="form-control" name="blood_unit_num" required /></div></td>
			<td width="10%"><div class="form-group"><input type="text" class="form-control" name="segment_num" required /></div></td>
			<td width="33%"><div class="form-group col-lg-5"><select name="bag_type" class="form-control" required >
			<option value="" disabled selected>Bag</option>
			<option value="1">Single</option>
			<option value="2">Double</option>
			<option value="3">Triple</option>
			<option value="4">Quadruple</option>
			<option value="5">Quadruple-Sagm</option>
			</select></div>
			<div class="form-group col-lg-7">
			<select name="volume" class="form-control" required >
			<option value="" disabled selected>Volume</option>
			<option value="350">350ml</option>
			<option value="450">450ml</option>
			</select></div></td>
			<td><div class="checkbox"><input type="checkbox" value="1" name="incomplete" /></div></td>
			<td width="15%"><div class="form-group">
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

