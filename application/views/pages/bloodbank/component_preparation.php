<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
  <script type="text/javascript"
 src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
 <script type="text/javascript"
 src="<?php echo base_url();?>assets/js/jquery.mousewheel.js"></script>
<script>
	$(function(){
		$("#preparation_date").Zebra_DatePicker({
			direction:false
		});
		$(".time").timeEntry();
	});
</script>

<div class="col-md-10 col-sm-9">
	<?php
	if(isset($msg)) {
		echo "<div class='alert alert-info'>$msg</div>";
		echo "<br />";
	}
	?>
	<div>
	
		<?php echo form_open('bloodbank/inventory/prepare_components',array('class'=>'form-custom'));?>
		<div class="form-group fields"><input type="text" id="from_id" placeholder="From Number" value="<?php echo $this->input->post('from_id');?>" class="form-control" name="from_id" /></div>
		<div class="form-group fields"><input type="text" id="to_id" placeholder="To Number" value="<?php echo $this->input->post('to_id');?>" class="form-control" name="to_id" /></div>
		<div class="form-group fields"><select class="form-control" name="bag_type" >
			<option value="" disabled selected>Bag Type</option>
			<option value="1">Single</option>
			<option value="2">Double</option>
			<option value="3">Triple</option>
			<option value="4">Quadruple</option>
		</select></div>
		<div class="form-group fields"><input type="submit" class="btn btn-primary" value="Filter" name="filter" /></div>
		<hr>
		</form>
		<?php if(count($inventory)==0){
			echo "<div class='alert alert-info'>No bags available for component preparation.</div>";
		}
		else{
		?>
		<h4>Available bags : </h4>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>S.No</th><th>Blood Unit No.</th><th>PC</th><th>FP</th><th>FFP</th><th>PRP</th><th>Platelet Conc.</th><th>Cryo</th><th>Component preparation time</th><th>Prepared</th></thead>
		<?php echo form_open('bloodbank/inventory/prepare_components',array('id'=>'prepare_components'));?>
		<?php 
		$i=1;
		foreach($inventory as $blood){
		?>
		<tr>

			<td>
				<?php echo $i++;?>
			</td>
			<td>
				<?php echo $blood->blood_unit_num;?>
			</td>
				<?php if($blood->bag_type==1){ ?>
				<td><input type="checkbox" value="PC"  name="<?php echo $blood->donation_id;?>[]"/> </td>
				<td><input type="checkbox" value="FP"  name="<?php echo $blood->donation_id;?>[]" /></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<?php }
				else if($blood->bag_type>=2){ ?>
				<td><input type="checkbox" value="PC"  name="<?php echo $blood->donation_id;?>[]"/> </td>
				<td><input type="checkbox" value="FP"  name="<?php echo $blood->donation_id;?>[]" /></td>
				<td><input type="checkbox" value="FFP"  name="<?php echo $blood->donation_id;?>[]" /></td>
				<?php if($blood->bag_type>2){ ?>
				<td><input type="checkbox" value="PRP" id="prp"  name="<?php echo $blood->donation_id;?>[]" /></td> 
				<td><input type="checkbox" value="Platelet Concentrate"  name="<?php echo $blood->donation_id;?>[]" /></td> 
				<td><input type="checkbox" value="Cryo" name="<?php echo $blood->donation_id;?>[]" /></td>
				<?php }
				else{ ?>
				<td></td>
				<td></td>
				<td></td>
				<?php } } ?>
			</td>
				<td>
			<input type="text" placeholder="Component preparation time" class="time form-control" id="com_pre_time" name="<?php echo $blood['donation_id'].'com_prep_time';?>" required /></td>
			<td>
				<input type="checkbox" value="<?php echo $blood->donation_id;?>" name="donation_id[]"   /></td>
		</tr>
		<?php 
		}
		?>
		<tr>
		<td colspan="3" >	
			<div class="form-group col-lg-8"><select name="staff" class="form-control" required>
				<option value="" disabled selected>Done By</option>
				<?php foreach($staff as $s){
					echo "<option value='$s->staff_id'>$s->first_name $s->last_name</option>";
				}
				?>
			</select></div>
		</td>
		<td colspan="6" ><div class="form-group col-lg-7"> <input type="text" class="form-control" placeholder="Date" name="preparation_date" id="preparation_date" form="prepare_components" required />
		
		
		</div></td>
		
		<td colspan="3" align="right" ><div class="form-group"><input type="submit" class="btn btn-primary" name="Update" value="Update" /></div></td></tr>
		</form>
		<?php
		}
		?>
</table>
			
	</div>
</div>

