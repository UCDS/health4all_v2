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
<script>
$(document).ready(function(){$("#from_date").datepicker({
		dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1,onSelect:function(sdt)
		{$("#to_date").datepicker({dateFormat:"dd/mm/yy",changeYear:1,changeMonth:1})
		$("#to_date").datepicker("option","minDate",sdt)}})})
		
		
</script>


    <div class="col-md-10 col-sm-9">
	<h4>Report of Blood Donations at <?php echo $hospitaldata['hospital'];?></h4>
	<?php echo form_open('bloodbank/user_panel/donation_summary'); ?>
	   <input type="date" name="from_date" placeholder="From date..." id="from_date" required readonly>
<input type="date" name="to_date" placeholder="To date..." id="to_date" required readonly>
		<input type="submit" name="submit" value="Search" />

	<br />
	<br>
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
		$from_date=date("Y-m-d",strtotime("-30 Days"));
		$to_date=date("Y-m-d");
		$date= "Last 30 days donations recieved ";
	 }
	 ?>
	<table class="table-2 table table-striped table-bordered">
	<thead><th colspan="20">Blood Donation Camp Report - <?php echo $date; ?></th>
	<thead>
		<th>Date</th>
		<th>Venue of Camp</th>
		<th>Male</th>
		<th>Female</th>
		<th>Total</th>
		<th>A+</th>
		<th>A-</th>
		<th>B+</th>
		<th>B-</th>
		<th>AB+</th>
		<th>AB-</th>
		<th>O+</th>
		<th>O-</th>
	</thead>
	<?php 
	$male=0;$female=0;$Apos=0;$Aneg=0;$Bpos=0;$Bneg=0;$ABpos=0;$ABneg=0;$Opos=0;$Oneg=0;$total=0;
	$walk_in_male=0;$walk_in_female=0;$walk_in_Apos=0;$walk_in_Aneg=0;$walk_in_Bpos=0;$walk_in_Bneg=0;$walk_in_ABpos=0;$walk_in_ABneg=0;$walk_in_Opos=0;$walk_in_Oneg=0;$walk_in_total=0;
	foreach($summary as $s){
		$day_total=0;
		$day_total+=$s->Apos+$s->Aneg+$s->Bpos+$s->Bneg+$s->ABpos+$s->ABneg+$s->Opos+$s->Oneg;
		if($s->camp_id!=0 ){
	?>
	<tr>
		<td><?php if($s->donation_date!=0) echo date("d-M-Y",strtotime($s->donation_date));?></td>
		<td><?php echo $s->camp_name;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/0/m/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->male;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/0/f/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->female;?></a></td>
		<th align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/0/0/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->total;?></a></th>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/Apos/0/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->Apos;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/Aneg/0/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->Aneg;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/Bpos/0/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->Bpos;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/Bneg/0/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->Bneg;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/ABpos/0/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->ABpos;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/ABneg/0/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->ABneg;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/Opos/0/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->Opos;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/$s->camp_id/Oneg/0/$s->donation_date/$from_date/$to_date";?>"><?php echo $s->Oneg;?></a></td>
	</tr>
	<?php
		}
		else {
			$walk_in_male+=$s->male;
			$walk_in_female+=$s->female;
			$walk_in_Apos+=$s->Apos;
			$walk_in_Aneg+=$s->Aneg;
			$walk_in_Bpos+=$s->Bpos;
			$walk_in_Bneg+=$s->Bneg;
			$walk_in_ABpos+=$s->ABpos;
			$walk_in_ABneg+=$s->ABneg;
			$walk_in_Opos+=$s->Opos;
			$walk_in_Oneg+=$s->Oneg;
			$walk_in_total+=$day_total;
		}
	$male+=$s->male;
	$female+=$s->female;
	$Apos+=$s->Apos;
	$Aneg+=$s->Aneg;
	$Bpos+=$s->Bpos;
	$Bneg+=$s->Bneg;
	$ABpos+=$s->ABpos;
	$ABneg+=$s->ABneg;
	$Opos+=$s->Opos;
	$Oneg+=$s->Oneg;
	$total+=$day_total;
	}
	?>
	<tr>
		<td colspan="2"><b>Camp Collection Total</b></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/0/m/0/$from_date/$to_date";?>"><?php echo $male-$walk_in_male;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/0/f/0/$from_date/$to_date";?>"><?php echo $female-$walk_in_female;?></td>
		<th align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/0/0/0/$from_date/$to_date";?>"><?php echo $total-$walk_in_total;?></th>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/Apos/0/0/$from_date/$to_date";?>"><?php echo $Apos-$walk_in_Apos;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/Aneg/0/0/$from_date/$to_date";?>"><?php echo $Aneg-$walk_in_Aneg;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/Bpos/0/0/$from_date/$to_date";?>"><?php echo $Bpos-$walk_in_Bpos;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/Bneg/0/0/$from_date/$to_date";?>"><?php echo $Bneg-$walk_in_Bneg;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/ABpos/0/0/$from_date/$to_date";?>"><?php echo $ABpos-$walk_in_ABpos;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/ABneg/0/0/$from_date/$to_date";?>"><?php echo $ABneg-$walk_in_ABneg;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/Opos/0/0/$from_date/$to_date";?>"><?php echo $Opos-$walk_in_Opos;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/c/Oneg/0/0/$from_date/$to_date";?>"><?php echo $Oneg-$walk_in_Oneg;?></td>
	</tr>
	<tr>
		<td colspan="2"><b>Collected at <?php echo $hospitaldata['hospital'];?> </b></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/0/m/0/$from_date/$to_date";?>"><?php echo $walk_in_male;?></a></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/0/f/0/$from_date/$to_date";?>"><?php echo $walk_in_female;?></td>
		<th align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/0/0/0/$from_date/$to_date";?>"><?php echo $walk_in_total;?></th>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/Apos/0/0/$from_date/$to_date";?>"><?php echo $walk_in_Apos;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/Aneg/0/0/$from_date/$to_date";?>"><?php echo $walk_in_Aneg;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/Bpos/0/0/$from_date/$to_date";?>"><?php echo $walk_in_Bpos;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/Bneg/0/0/$from_date/$to_date";?>"><?php echo $walk_in_Bneg;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/ABpos/0/0/$from_date/$to_date";?>"><?php echo $walk_in_ABpos;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/ABneg/0/0/$from_date/$to_date";?>"><?php echo $walk_in_ABneg;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/Opos/0/0/$from_date/$to_date";?>"><?php echo $walk_in_Opos;?></td>
		<td align="right"><a href="<?php echo base_url()."bloodbank/user_panel/report_donations/0/Oneg/0/0/$from_date/$to_date";?>"><?php echo $walk_in_Oneg;?></td>
	</tr>
	<tr>
		<th colspan="2">Total </th>
		<th align="right"><?php echo $male;?></th>
		<th align="right"><?php echo $female;?></th>
		<th align="right"><?php echo $total;?></th>
		<th align="right"><?php echo $Apos;?></th>
		<th align="right"><?php echo $Aneg;?></th>
		<th align="right"><?php echo $Bpos;?></th>
		<th align="right"><?php echo $Bneg;?></th>
		<th align="right"><?php echo $ABpos;?></th>
		<th align="right"><?php echo $ABneg;?></th>
		<th align="right"><?php echo $Opos;?></th>
		<th align="right"><?php echo $Oneg;?></th>
	</tr>
	</table>
	
</div>
