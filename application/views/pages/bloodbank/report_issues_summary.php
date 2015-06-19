<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<style>
.table-2 a{
	color:black;
	text-decoration:none;
}
</style>
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(function(){
		$(".date").Zebra_DatePicker({
			direction:false
		});
	});
</script>

<div class="col-md-10 col-sm-9">
	
	<h4>Report of Blood Donors at Indian Red Cross Society Bloodbank - Vidyanagar</h4>
	<?php echo form_open('bloodbank/user_panel/issue_summary'); ?>
	<div>
		<input type="text" class="date" size="12" id="from_date" name="from_date" />
		<input type="text" class="date" size="12" name="to_date" />
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
		$from_date=date("Y-m-d",strtotime("-30 Days"));
		$to_date=date("Y-m-d");
		$date= "Issues in the last 30 days.";
	 }
	 ?>
	<table class="table-2 table table-striped table-bordered">
	<thead><th colspan="20">Blood Issue Report - <?php echo $date; ?></th>
	<thead>
		<th>Date</th>
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
	$Apos=0;$Aneg=0;$Bpos=0;$Bneg=0;$ABpos=0;$ABneg=0;$Opos=0;$Oneg=0;$total=0;
	foreach($summary as $s){
		$day_total=0;
		$day_total+=$s['A+']+$s['A-']+$s['B+']+$s['B-']+$s['AB+']+$s['AB-']+$s['O+']+$s['O-'];
		$s['issue_date']=date("Y-m-d",strtotime($s['issue_date']));
	?>
	<tr>
		<td><?php if($s['issue_date']!=0) echo date("d-M-Y",strtotime($s['issue_date']));?></td>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/$s[issue_date]/0/$from_date/$to_date";?>"><?php echo $s['total'];?></a></th>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/$s[issue_date]/Apos/$from_date/$to_date";?>"><?php echo $s['A+'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/$s[issue_date]/Aneg/$from_date/$to_date";?>"><?php echo $s['A-'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/$s[issue_date]/Bpos/$from_date/$to_date";?>"><?php echo $s['B+'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/$s[issue_date]/Bneg/$from_date/$to_date";?>"><?php echo $s['B-'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/$s[issue_date]/ABpos/$from_date/$to_date";?>"><?php echo $s['AB+'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/$s[issue_date]/ABneg/$from_date/$to_date";?>"><?php echo $s['AB-'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/$s[issue_date]/Opos/$from_date/$to_date";?>"><?php echo $s['O+'];?></a></td>
		<td align="right"><a href="<?php echo base_url()."user_panel/report_issue/$s[issue_date]/Oneg/$from_date/$to_date";?>"><?php echo $s['O-'];?></a></td>
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
	$total+=$day_total;
	}
	?>
	
	<tr>
		<th>Total </th>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/0/$from_date/$to_date";?>"><?php echo $total;?></a></th>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Apos/$from_date/$to_date";?>"><?php echo $Apos;?></a></th>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Aneg/$from_date/$to_date";?>"><?php echo $Aneg;?></a></th>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Bpos/$from_date/$to_date";?>"><?php echo $Bpos;?></a></th>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Bneg/$from_date/$to_date";?>"><?php echo $Bneg;?></a></th>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/ABpos/$from_date/$to_date";?>"><?php echo $ABpos;?></a></th>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/ABneg/$from_date/$to_date";?>"><?php echo $ABneg;?></a></th>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Opos/$from_date/$to_date";?>"><?php echo $Opos;?></a></th>
		<th align="right"><a href="<?php echo base_url()."user_panel/report_issue/0/Oneg/$from_date/$to_date";?>"><?php echo $Oneg;?></a></th>
	</tr>
	</table>
	
</div>
