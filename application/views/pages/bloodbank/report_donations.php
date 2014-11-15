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
		<?php echo form_open('bloodbank/user_panel/report_donations'); ?>
		<div>
			<input type="text" placeholder="From date" size="10" name="from_date" id="from_date" />
			<input type="text" placeholder="To date" size="10" name="to_date" id="to_date" />
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
		<?php if(count($donated)>0){ ?>
		<b>
		<?php
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date('d-M-Y',strtotime($this->input->post('from_date')));
			$to_date=date('d-M-Y',strtotime($this->input->post('to_date')));
			echo "Donations from ".$from_date." to ".$to_date;
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
		 $this->input->post('from_date')==""?$date=$this->input->post('to_date'):$date=$this->input->post('from_date');
		 echo "Donations on $date";
		}
		else{
			echo "Donations report";	
		}
		?>
		</b>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>S.No</th><th>Date</th><th>Blood Unit No.</th><th>Donor Name</th><th>Blood Group</th><th>Donated at</th></thead>
		<?php 
		$i=1;
		$background="";
		foreach($donated as $row){
		if($row['donation_status_id']==6 && $row['screening_result']==1){
			$background="style='background:#C0FAB4'";
		}
		else if($row['donation_status_id']==6 && $row['screening_result']==0){
			$background="style='background:#FAB4B4'";
		}
		else if($row['donation_status_id']==5){
			$background="style='background:#FAEDB4'";
		}
		?>
		<tr  <?php echo $background;?>>
			<td><?php echo $i++;?></td>
			<td><?php echo date("d-M-Y",strtotime($row['donation_date']));?></td>
			<td><?php echo $row['blood_unit_num'];?></td>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['blood_group'];?></td>
			<td style="width:70px;"><?php echo $row['camp_name'];?></td>
			</tr>
		<?php 
		}
		?>
		</table>
		<?php }
		else{
			 ?>
			 <p>No donations in the specified period.</p>
		<?php } ?>
	</div>
</div>

