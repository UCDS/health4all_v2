<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(function(){
		$("#from_date,#to_date").Zebra_DatePicker();
	});
</script>

<div class="col-md-10 col-sm-9">

	<div>
		<?php echo form_open('bloodbank/user_panel/report_issue'); ?>
		<div>
			<input type="text" placeholder="From date" size="10" name="from_date" id="from_date" />
			<input type="text" placeholder="To date" size="10" name="to_date" id="to_date" />
			<select name="issued_by">
					<option value="" disabled selected>Issued By</option>
					<?php foreach($staff as $s){
						echo "<option value='$s->staff_id'>$s->name</option>";
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
		<?php if(count($issued)>0){ ?>
		<b>
		<?php
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date('d-M-Y',strtotime($this->input->post('from_date')));
			$to_date=date('d-M-Y',strtotime($this->input->post('to_date')));
			echo "Blood issued from ".$from_date." to ".$to_date;
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
		 $this->input->post('from_date')==""?$date=$this->input->post('to_date'):$date=$this->input->post('from_date');
		 echo "Blood issued on $date";
		}
		else{
			$from_date=date('d-M-Y',strtotime('-10 Days'));
			$to_date=date('d-M-Y');
			echo "Blood issues report";	
		}
		?>
		</b>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>S.No</th><th>Date</th><th>Time</th><th>Blood Unit No.</th><th>Component</th><th>Patient Name</th><th>Blood Group</th><th>Diagnosis</th><th>Hospital</th><th>Issued By</th><th>Croos Matched By</th></thead>
		<?php 
		$i=1;
		foreach($issued as $row){
		?>
		<tr>
			<td><?php echo $i++;?></td>
			<td><?php echo date("d-M-Y",strtotime($row['issue_date']));?></td>
			<td><?php echo date("g:ia",strtotime($row['issue_time']));?></td>
			<td><?php echo $row['blood_unit_num'];?></td>
			<td><?php echo $row['component_type'];?></td>
			<td><?php echo $row['patient_name'];?></td>
			<td><?php echo $row['blood_group'];?></td>
			<td><?php echo $row['diagnosis'];?></td>
			<td><?php echo $row['hospital'];?></td>
			<td><?php echo $row['issued_staff_name'];?></td>
			<td><?php echo $row['cross_matched_staff_name'];?></td>
			</tr>
		<?php 
		}
		?>
		</table>
		<?php }
		else{
			 ?>
			 <p>No issues in the specified period.</p>
		<?php } ?>
	</div>
</div>

