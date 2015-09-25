<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(document).ready(function(){$("#from_date").datepicker({
		dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1,onSelect:function(sdt)
		{$("#to_date").datepicker({dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1})
		$("#to_date").datepicker("option","minDate",sdt)}})})
		
</script>

<div class="col-md-10 col-sm-9">

	<div>
		<?php echo form_open('bloodbank/user_panel/report_inventory'); ?>
		<div>
			<input type="text" placeholder="From date..." size="10" name="from_date" id="from_date" />
			<input type="text" placeholder="To date..." size="10" name="to_date" id="to_date" />
			<input type="text" placeholder="From Num" size="10" name="from_num" id="from_num" />
			<input type="text" placeholder="To Num" size="10" name="to_num" id="to_num" />
			<select name="camp">
					<option value="" disabled selected>Location</option>
					<?php foreach($camps as $c){
						echo "<option value='$c->camp_id'>$c->camp_name</option>";
					}
					?>
			</select>
			<input type="submit" value="Search" name="search" />
		</div>
		</form>
		<?php
		if(isset($msg)) {
			echo $msg;
			echo "<br />";
			echo "<br />";
		}
		?>
		<?php if(count($inventory)>0){ ?>
		<b>
		<?php

			echo "Inventory as on ".date("d-M-Y");	
		?>
		</b>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>S.No</th><th>Donation Date</th><th>Blood Unit No.</th><th>Blood Group</th><th>Component</th><th>Bag</th><th>Expiry Date</th><th>Status</th></thead>
		<?php 
		$i=1;
		foreach($inventory as $row){
		if($row['donation_status_id']==6 && $row['screening_result']==1){
			$background="style='background:#C0FAB4'";
		}
		if($row['donation_status_id']==6 && $row['screening_result']==0){
			$background="style='background:#FAB4B4'";
		}
		if($row['donation_status_id']==5){
			$background="style='background:#FAEDB4'";
		}
		?>
		<tr  <?php echo $background;?>>
			<td><?php echo $i++;?></td>
			<td><?php echo date("d-M-Y",strtotime($row['donation_date']));?></td>
			<td><?php echo $row['blood_unit_num'];?></td>
			<td><?php echo $row['blood_group'];?></td>
			<td><?php echo $row['component_type'];?></td>
			<td><?php echo $row['bag_type'];?></td>
			<td><?php echo $row['expiry_date'];?></td>
			<td><?php echo $row['inv_status'];?></td>
			</tr>
		<?php 
		}
		?>
		</table>
		<?php }
		else{
			 ?>
			 <p>No inventory with the specified conditions.</p>
		<?php } ?>
	</div>
</div>

