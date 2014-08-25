<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(function(){
		$("#screened_date").Zebra_DatePicker({
			direction:false
		});
	});
</script>


<div class="col-md-10 col-sm-9">
	<?php
	echo validation_errors();
	if(isset($msg)) {
		echo $msg;
		echo "<br />";
		echo "<br />";
	}
	?>
	<div>
		<?php if(count($inventory)==0){
			echo "No samples available for screening.";
		}
		else{
		?>
		<?php echo form_open('bloodbank/inventory/screening');?>
		<input type="text" id="from_id" placeholder="From" size="7" name="from_id" />
		<input type="text" id="to_id" placeholder="To" size="7" name="to_id" />
		<input type="submit" value="Filter" name="filter" />
		</form>
		<h3>Available samples : </h3>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead>
			<th>S.No</th>
			<th>Blood Unit</th>
			<th>HIV</th>
			<th>HBSAG</th>
			<th>HCV</th>
			<th>VDRL</th>
			<th>MP</th>
			<th>Irregular AB</th>
			<th>Tested</th>
		</thead>
		<?php 
		$j=1;
		echo form_open('bloodbank/inventory/screening',array('id'=>'screening_form'));
		foreach($inventory as $blood){
		?>
		<tr>
			<td><?php echo $j++; ?></td>
			<td><?php echo $blood['blood_unit_num'];?></td>
			<td><input type="checkbox" name="test_hiv_<?php echo $blood['donation_id'];?>" value="1" /></td>
			<td><input type="checkbox" name="test_hbsag_<?php echo $blood['donation_id'];?>" value="1" /></td>
			<td><input type="checkbox" name="test_hcv_<?php echo $blood['donation_id'];?>" value="1" /></td>
			<td><input type="checkbox" name="test_vdrl_<?php echo $blood['donation_id'];?>" value="1" /></td>
			<td><input type="checkbox" name="test_mp_<?php echo $blood['donation_id'];?>" value="1" /></td>
			<td><input type="checkbox" name="test_irregular_ab_<?php echo $blood['donation_id'];?>" value="1" /></td>
			<td><input type="checkbox" name="test[]" value="<?php echo $blood['donation_id'];?>" /></td>
				</tr>
		<?php 
		}
		?>
		<tr>
			<td colspan="3" align="right">
				<select name="staff" required>
					<option value="" disabled selected>Done By</option>
					<?php foreach($staff as $s){
						echo "<option value='$s->staff_id'>$s->name</option>";
					}
					?>
				</select>
			</td>
			<td colspan="3" align="right">
				Screened Date <input type="text" name="screened_date" size="12" form='screening_form' id="screened_date" required />
			</td>
			<td colspan="3" align="right">
				<input type="submit" value="Update"  />
			</td>
		</tr>
		</form>
		<?php
		}
		?>
		</table>
			
	</div>
</div>

