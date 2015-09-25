<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<script type="text/javascript"
 
<script>
	$(document).ready(function(){$("#from_date").datepicker({
		dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1,onSelect:function(sdt)
		{$("#to_date").datepicker({dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1})
		$("#to_date").datepicker("option","minDate",sdt)}})})
		
</script>

<div class="col-md-10 col-sm-9">

	<div>
		<?php echo form_open('bloodbank/user_panel/discard_report'); ?>
		<div>
		<div class="col-md-6">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">From date </span>
		  <input type="date" placeholder="From date..." class="form-control"  name="from_date" id="from_date"   aria-describedby="basic-addon1" required>
		</div>		
		</div>
			<div class="col-md-6">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">To date </span>
		  <input type="date" placeholder="To date..."  class="form-control" name="to_date" id="to_date"   aria-describedby="basic-addon1" required>
		</div>		
		</div>
		<br><br><br>
		    <div class="col-md-6 col-md-offset-5">
			<input type="submit" value="Search" class="btn btn-primary" name="search" />
			</div>
		</div>
		</form>
			<?php
	$search="";
	$expired="";
	$expiring="";
	$under_collection="";
	$screening_failed="";
	if(isset($msg)) {
		echo $msg;
		echo "<br />";
		echo "<br />";
	}
	?>
		<?php if(count($inventory)>0){ ?>
		<b>
		<?php
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date('d-M-Y',strtotime($this->input->post('from_date')));
			$to_date=date('d-M-Y',strtotime($this->input->post('to_date')));
			echo "Discard report from ".$from_date." to ".$to_date;
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
		 $this->input->post('from_date')==""?$date=$this->input->post('to_date'):$date=$this->input->post('from_date');
		 echo "Blood grouped on $date";
		}
		else{
			$from_date=date('d-M-Y',strtotime('-10 Days'));
			$to_date=date('d-M-Y');	
		}
		?>
		</b>
         
		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>Blood Unit number</th><th>Component Type</th><th>Blood Group</th><th>Date</th><th>Reason</th></thead>
		<?php 
		foreach($inventory as $inv){
			if($this->input->post('search')){
				$search.="<tr>";
				$search.=form_open('bloodbank/inventory/discard');
				$search.="<input type='text' value='$inv->inventory_id' readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv->expiry_date))."</td>";
				
				$search.="<td><input type='text' name='notes' readonly required /></td>
				
				</form>
				</tr>";
			}
			else{
			if($inv->donation_status==3){
				$under_collection.="<tr>";
				$under_collection.=form_open('bloodbank/inventory/discard');
				$under_collection.="<input type='text' value='$inv->inventory_id' readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv['expiry_date']))."</td>";
				
				$under_collection.="<td><input type='text' value='Under Collection'  readonly name='notes' required /></td>
					
				</form>
				</tr>";
			}
			else if($inv->donation_status==6 && $inv->screening_result==0){
				$screening_failed.="<tr>";
				$screening_failed.=form_open('bloodbank/inventory/discard');
				$screening_failed.="<input type='text' value='$inv->inventory_id' readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv->expiry_date))."</td>";
			
				$screening_failed.="<td><input  readonly type='text' value='Screening failed.' name='notes' required /></td>
					
				</form>
				</tr>";
			}
			else if($inv->expiry_date>date('Y-m-d',strtotime("+7 Days"))){
				continue;
			}
			else if($inv->expiry_date>=date('Y-m-d')){
				$expiring.="<tr>";
				$expiring.=form_open('bloodbank/inventory/discard');
				$expiring.="<input type='text' value='$inv->inventory_id' readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv->expiry_date))."</td>";
			
				$expiring.="<td></td>
					
				</form>
				</tr>";			
			}
			else if($inv->expiry_date<date('Y-m-d')){
				$expired.="<tr>";
				$expired.=form_open('bloodbank/inventory/discard');
				$expired.="<input type='text' value='$inv->inventory_id readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv->expiry_date))."</td>";
				
				$expired.="<td><input value='Expired' name='notes' readonly required /></td>
					
				</form>
				</tr>";
			}
			}
		}?>
		<?php
		if($expiring!=""){
			
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Expiring in the next 7 days</font></th></tr>
			<?php
				echo $expiring;
			}
			if($expired!=""){
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Expired Blood</font></th></tr>
			<?php
				echo $expired;
			}
			if($under_collection!=""){
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Under Collection</font></th></tr>
			<?php
				echo $under_collection;
			}
			if($screening_failed!=""){
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Screening failed</font></th></tr>
			<?php
				echo $screening_failed;
			}
			if($search!=""){
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Searched for..</font></th></tr>
			<?php
				echo $search;
			}
		
		?>
		</table>
		<?php }
		else{
			 ?>
			 <p>No Discard records are specified period.</p>
		<?php } ?>
	</div>
</div>

