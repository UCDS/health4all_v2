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

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<div class="col-md-10 col-sm-9">
	<?php
	if(validation_errors()){
		echo "<div class='alert alert-danger'>".validation_errors()."</div>";
	}
	if(isset($msg)) {
		echo "<div class='alert alert-info'>$msg</div>";
		echo "<br />";
	}
	?>
	<div>
		<?php echo form_open('bloodbank/inventory/screening',array('class'=>'form-custom'));?>
		<div class="form-group">
			<input type="text" id="from_id" placeholder="From Number"  value="<?php echo $this->input->post('from_id');?>" class="form-control" name="from_id" />
		</div>
		<div class="form-group">
			<input type="text" id="to_id" class="form-control" value="<?php echo $this->input->post('to_id');?>" placeholder="To Number"  name="to_id" />
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Filter" name="filter" />
		</div>
		<hr>
		</form>
		<?php if(count($inventory)==0){
			echo "<div class='alert alert-info'>No samples available for screening.</div>";
		}
		else{
		?>
		<h4>Available samples : </h4>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead>
			<th>S.No</th>
			<th><div data-toggle="popover" data-placement="bottom" data-content="Blood Unit No.">
																  
				Blood Unit No.</div></th>
			<th><div data-toggle="popover" data-placement="bottom" data-content="Human Immunodeficiency Virus">
																  
				HIV</div></th>	
			<th><div data-toggle="popover" data-placement="bottom" data-content="Hepatitis B Surface Antigen">
																  
				HBSAG</div></th>
			<th><div data-toggle="popover" data-placement="bottom" data-content="Hepatitis C Virus">
																  
				HCV</div></th>
			<th><div data-toggle="popover" data-placement="bottom" data-content="Venereal Disease Research Laboratory">
																  
				VDRL</div></th>
			<th><div data-toggle="popover" data-placement="bottom" data-content=" Metabolic panel">
																  
				MP</div></th> 
			<th><div data-toggle="popover" data-placement="bottom" data-content=" Irregular Antibody Screening">
																  
				Irregular AB</div></th>
			<th>Tested</th>
		</thead>
		<?php 
		$j=1;
		echo form_open('bloodbank/inventory/screening',array('id'=>'screening_form'));
		foreach($inventory as $blood){
		?>
		<tr>
			<td><?php echo $j++; ?></td>
			<td><?php echo $blood->blood_unit_num;?></td>
			<td><input type="checkbox" name="test_hiv_<?php echo $blood->donation_id;?>" value="1" /></td>
			<td><input type="checkbox" name="test_hbsag_<?php echo $blood->donation_id;?>" value="1" /></td>
			<td><input type="checkbox" name="test_hcv_<?php echo $blood->donation_id;?>" value="1" /></td>
			<td><input type="checkbox" name="test_vdrl_<?php echo $blood->donation_id;?>" value="1" /></td>
			<td><input type="checkbox" name="test_mp_<?php echo $blood->donation_id;?>" value="1" /></td>
			<td><input type="checkbox" name="test_irregular_ab_<?php echo $blood->donation_id;?>" value="1" /></td>
			<td><input type="checkbox" name="test[]" value="<?php echo $blood->donation_id;?>" /></td>
				</tr>
		<?php 
		}
		?>
		<tr>
			<td colspan="3" align="right">
				<div class="form-group col-lg-8"><select name="staff" class="form-control" required>
					<option value="" disabled selected>Done By</option>
					<?php foreach($staff as $s){
						echo "<option value='$s->staff_id'>$s->first_name $s->last_name</option>";
					}
					?>
				</select></div>
			</td>
			<td colspan="3" align="right">
				<div class="form-group col-lg-7"><input type="text" name="screened_date" class="form-control" placeholder="Screened Date" form='screening_form' id="screened_date" required /></div>
			</td>
			<td colspan="3" align="right">
				<div class="form-group"><input type="submit"  class="btn btn-primary" name="submit" value="Update"  /></div>
			</td>
		</tr>
		</form>
		<?php
		}
		?>
		</table>
			
	</div>
</div>

