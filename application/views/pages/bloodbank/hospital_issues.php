<script  type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >

<style>
.table-2 a{
	color:black;
	text-decoration:none;
}
</style>
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(document).ready(function(){$("#from_date").datepicker({
		dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1,onSelect:function(sdt)
		{$("#to_date").datepicker({dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1,})
		$("#to_date").datepicker("option","minDate",sdt)}})})
		
</script>

<div class="col-md-10 col-sm-9">
	
	<h4>Report of Issues to hospitals by Indian Red Cross Society Bloodbank - Vidyanagar</h4>
	<?php echo form_open('bloodbank/user_panel/hospital_issues'); ?>
	<div>
		<input type="date" name="from_date" placeholder="From date..." id="from_date" required readonly>
       <input type="date" name="to_date" placeholder="To date..." id="to_date" required readonly>
		<input type="submit" name="submit" value="Search" />
	</div>
	<br />
	<?php
	 if($this->input->post('from_date') && $this->input->post('to_date')){
		$from_date=$this->input->post('from_date');
		$to_date=$this->input->post('to_date');
		$date=date('d-M-Y',strtotime($this->input->post('from_date')))." to ".date('d-M-Y',strtotime($this->input->post('to_date')));
	 }
	 else if($this->input->post('from_date') || $this->input->post('to_date')){
		 if($this->input->post('from_date')==""){
			$date=$this->input->post('to_date');
			$to_date=$this->input->post('to_date');
		}
		else{
		$date=$this->input->post('from_date');
		$from_date=$this->input->post('from_date');
		}
	 }
	 else{
		$from_date=date("d-m-y",strtotime("-30 Days"));
		$to_date=date("d-m-y");
		$date= "Last 30 days issues";
	 }
	 ?>
	<table class="table-2 table table-striped table-bordered">
	<thead><th colspan="20">Blood Issued to Hospitals - <?php echo $date; ?></th>
	<thead>
		<th>Hospital</th>
		<th>A+</th>
		<th>A-</th>
		<th>B+</th>
		<th>B-</th>
		<th>AB+</th>
		<th>AB-</th>
		<th>O+</th>
		<th>O-</th>
		<th>Total</th>
	</thead>
	<?php 
	$Apos=0;$Aneg=0;$Bpos=0;$Bneg=0;$ABpos=0;$ABneg=0;$Opos=0;$Oneg=0;$total=0;
	$walk_in_male=0;$walk_in_female=0;$walk_in_Apos=0;$walk_in_Aneg=0;$walk_in_Bpos=0;$walk_in_Bneg=0;$walk_in_ABpos=0;$walk_in_ABneg=0;$walk_in_Opos=0;$walk_in_Oneg=0;$walk_in_total=0;
	foreach($summary as $s){
		$row_total=0;
		$row_total+=$s['A+']+$s['A-']+$s['B+']+$s['B-']+$s['AB+']+$s['AB-']+$s['O+']+$s['O-'];
	?>
	<tr>
		<td><?php echo $s['hospital'];?></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Apos/$from_date/$to_date/$s[hospital_id]";?>"><?php echo $s['A+'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Aneg/$from_date/$to_date/$s[hospital_id]";?>"><?php echo $s['A-'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Bpos/$from_date/$to_date/$s[hospital_id]";?>"><?php echo $s['B+'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Bneg/$from_date/$to_date/$s[hospital_id]";?>"><?php echo $s['B-'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/ABpos/$from_date/$to_date/$s[hospital_id]";?>"><?php echo $s['AB+'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/ABneg/$from_date/$to_date/$s[hospital_id]";?>"><?php echo $s['AB-'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Opos/$from_date/$to_date/$s[hospital_id]";?>"><?php echo $s['O+'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Oneg/$from_date/$to_date/$s[hospital_id]";?>"><?php echo $s['O-'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/0/$from_date/$to_date/$s[hospital_id]";?>"><?php echo $row_total;?></a></td>
	</tr>
	<?php
	$Apos+=$s['A+'];
	$Aneg+=$s['A-'];
	$Bpos+=$s['B+'];
	$Bneg+=$s['B-'];
	$ABpos+=$s['AB+'];
	$ABneg+=$s['AB-'];
	$Opos+=$s['O+'];
	$Oneg+=$s['O-'];
	$total+=$row_total;
	}
	?>
	<tr>
		<th colspan="1">Total </th>
		<th align="right"><?php echo $Apos;?></th>
		<th align="right"><?php echo $Aneg;?></th>
		<th align="right"><?php echo $Bpos;?></th>
		<th align="right"><?php echo $Bneg;?></th>
		<th align="right"><?php echo $ABpos;?></th>
		<th align="right"><?php echo $ABneg;?></th>
		<th align="right"><?php echo $Opos;?></th>
		<th align="right"><?php echo $Oneg;?></th>
		<th align="right"><?php echo $total;?></th>
	</tr>
	</table>
	
</div>
