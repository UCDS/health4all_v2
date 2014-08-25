<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
 <script>
	$(function(){
		var i=2;
		$("#add_blood_group").click(function(){
			var row='<tr class="bulk" id="row_'+i+'"><td><select name="blood_group[]" ><option value="" disabled selected>Select</option><option value="A+">A+</option><option value="B+">B+</option><option value="O+">O+</option><option value="AB+">AB+</option><option value="A-">A-</option><option value="B-">B-</option><option value="O-">O-</option><option value="AB-">AB-</option></select></td>';
			row+='<td><input type="text" name="whole_blood_units[]" size="3" /></td><td><input type="text" name="packed_cell_units" size="3" /></td>';
			row+='<td><input type="text" name="fp_units[]" size="3" /></td>';
			row+='<td><input type="text" name="ffp_units[]" size="3" /></td>';
			row+='<td><input type="text" name="prp_units[]" size="3" /></td>';
			row+='<td><input type="text" name="platelet_concentrate_units[]" size="3" /></td>';
			row+='<td><input type="text" name="cryoprecipitate_units[]" size="3" /></td>';
			row+='<td><input type="button" value="X" id="delete_blood_group" onclick="delete_row('+i+')" class="bulk" />';
			row+='</td>';
			row+='</tr>';
			$(".required_blood").append(row);
			i++;
		});
		$(".bulk").hide();
		$("#patient").click(function(){
			$("tr.bulk").remove();
			$(".bulk").hide();
			$(".patient").show();
		});
		$("#bulk").click(function(){
			$(".patient").hide();
			$(".bulk").show();
		});
		$("#request_date").Zebra_DatePicker();
	});
	function delete_row(i){
		$("#row_"+i).remove();
	}
</script>
<div class="col-md-10 col-sm-9">
	<?php
	if(isset($msg)) {
		if($msg='success'){
		echo "Your request has been submitted.";
		echo "<br />";
		echo "<br />";
		}
		else{
		echo "There was an error in registering your request. Please retry.";
		echo "<br />";
		echo "<br />";
		}
	}
	?>
	<div>
		<?php echo form_open('bloodbank/register/request');
		echo validation_errors();?>
		<h3>Request Form</h3>
		<table class="table-2 table table-striped table-bordered">
			<tr><td>Request Type : </td><td>
					<label><input type="radio" value="0" name="request_type" id="patient" />Patient</label>
					<label><input type="radio" value="1" name="request_type" id="bulk" />Bulk</label>
			</td>
			</tr>
			<tr class="patient"><td>Patient Name : </td><td><input type="text" name="patient"  /></td></tr>
			<tr class="patient"><td>Age : </td><td><input type="text" name="age" size="3" /></td></tr>
			<tr class="patient"><td>Gender : </td><td>
				<input type="radio" name="sex" id="male"  /><label for="male">Male</label>
				<input type="radio" name="sex" id="female"  /><label for="female">Female</label>
			</td></tr>
			<tr><td>Hospital : </td><td><select name="hospital" required>
			<option value="" selected disabled>SELECT HOSPITAL</option>
			<?php foreach($hospitals as $hosp){ echo "<option value='".$hosp->hospital_id."'>".$hosp->hospital."</option>"; }?>
			</select>
			</td></tr>
			<tr class="patient"><td>Ward/Unit : </td><td><input type="text" name="ward_unit" size="15"  /></td></tr>
			<tr class="patient"><td>IP No : </td><td><input type="text" name="ip_no" size="8" /></td></tr>
			<tr class="patient"><td>Diagnosis : </td><td><textarea name="diagnosis" ></textarea></td></tr>
			<tr><td>Required : </td>
			<td>
			<table class='required_blood'>
				<tr>
					<th>Blood Group</th>
					<th>Whole Blood</th>
					<th>Packed Cells</th>
					<th>Frozen Plasma</th>
					<th>Fresh Frozen Plasma</th>
					<th>Platelet Rich Plasma</th>
					<th>Platelet Concentrate</th>
					<th>Cryoprecipitate</th>
					<td></td>
				</tr>
				<tr>
					<td><select name="blood_group[]" required >
						<option value="" disabled selected>Select</option>
						<option value="A+">A+</option>
						<option value="B+">B+</option>
						<option value="O+">O+</option>
						<option value="AB+">AB+</option>
						<option value="A-">A-</option>
						<option value="B-">B-</option>
						<option value="O-">O-</option>
						<option value="AB-">AB-</option>
						</select>
					</td>
					<td><input type="text" name="whole_blood_units[]" size="3" /></td>
					<td><input type="text" name="packed_cell_units[]" size="3" /></td>
					<td><input type="text" name="fp_units[]" size="3" /></td>
					<td><input type="text" name="ffp_units[]" size="3" /></td>
					<td><input type="text" name="prp_units[]" size="3" /></td>
					<td><input type="text" name="platelet_concentrate_units[]" size="3" /></td>
					<td><input type="text" name="cryoprecipitate_units[]" size="3" /></td>
					<td>			
						<input type="button" value="+" id="add_blood_group" class="bulk" />
					</td>
				</tr>
			</table>
			</td></tr>
			<tr class="patient"><td>Request Type </td><td>
				<input type="radio" name="blood_transfusion" value="1" id="yes" /><label for="yes">Required</label>
				<input type="radio" name="blood_transfusion" value="0" id="no" /><label for="no">Reserve</label>
			</td></tr>
			<tr><td> Request Date : </td><td><input type="text" name="request_date" id="request_date" required /></td>
			<tr><td colspan="2" align="center"><input type="submit" value="Submit" /> </td></tr>
		</table>
		</form>	
	</div>
</div>
