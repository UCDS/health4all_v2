<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<script>
	$(document).ready(function(){$("#from_date").datepicker({
		dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1,onSelect:function(sdt)
		{$("#to_date").datepicker({dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1})
		$("#to_date").datepicker("option","minDate",sdt)}})})
		
</script>

<div class="col-md-10 col-sm-9">

	<div>
		<?php echo form_open('bloodbank/user_panel/report_screening'); ?>
		<div>
			<input type="text" placeholder="From date..." size="10" name="from_date" id="from_date" />
			<input type="text" placeholder="To date..." size="10" name="to_date" id="to_date" />
			<select name="screened_by">
					<option value="" disabled selected>Done By</option>
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
		<?php if(count($screened)>0){ ?>
		<b>
		<?php
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date('d-M-Y',strtotime($this->input->post('from_date')));
			$to_date=date('d-M-Y',strtotime($this->input->post('to_date')));
			echo "Samples Screened from ".$from_date." to ".$to_date;
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
		 $this->input->post('from_date')==""?$date=$this->input->post('to_date'):$date=$this->input->post('from_date');
		 echo "Samples Screened on $date";
		}
		else{
			$from_date=date('d-M-Y',strtotime('-10 Days'));
			$to_date=date('d-M-Y');
			echo "Screened in the last 10 days";	
		}
		?>
		</b>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>S.No</th><th>Date</th><th>Blood Unit No.</th><th>Donor Name</th><th>Blood Group</th><th>HIV</th><th>HBSAG</th><th>HCV</th><th>VDRL</th><th>MP</th><th>Irregular Ab</th><th>Screened By</th></thead>
		<?php 
		$i=1;
		foreach($screened as $row){
		?>
		<tr>
			<td><?php echo $i++;?></td>
			<td><?php echo date("d-M-Y",strtotime($row->screening_datetime));?></td>
			<td><?php echo $row->blood_unit_num;?></td>
			<td><?php echo $row->name;?></td>
			<td><?php echo $row->blood_group;?></td>
			<td><?php if($row->test_hiv==1) echo "Yes"; else echo "NR";?></td>
			<td><?php if($row->test_hbsag==1) echo "Yes"; else echo "Neg";?></td>
			<td><?php if($row->test_hcv==1) echo "Yes"; else echo "NR";?></td>
			<td><?php if($row->test_vdrl==1) echo "Yes"; else echo "NR";?></td>
			<td><?php if($row->test_mp==1) echo "Yes"; else echo "NF";?></td>
			<td><?php if($row->test_irregular_ab==1) echo "Yes"; else echo "Neg";?></td>
			<td><?php echo $row->staff_name;?></td>
			</tr>
		<?php 
		}
		?>
		</table>
		<?php }
		else{
			 ?>
			 <p>No screening record in the specified period.</p>
		<?php } ?>
	</div>
</div>

