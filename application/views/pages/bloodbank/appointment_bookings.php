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
		<?php echo form_open('bloodbank/user_panel/appointment_bookings'); ?>
		<div>
			<input type="text" placeholder="From date" size="10" name="from_date" id="from_date" />
			<input type="text" placeholder="To date" size="10" name="to_date" id="to_date" />
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
		<?php if(count($appointments)>0){ ?>
		<table class='table-2'>
			<tr>
				<th colspan="10">
			<?php
			if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date('d-M-Y',strtotime($this->input->post('from_date')));
			$to_date=date('d-M-Y',strtotime($this->input->post('to_date')));
			echo "Appointments from ".$from_date." to ".$to_date;
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
		 $this->input->post('from_date')==""?$date=$this->input->post('to_date'):$date=$this->input->post('from_date');
		 echo "Appointments on $date";
		}
		else{
			$from_date=date('d-M-Y',strtotime('-10 Days'));
			$to_date=date('d-M-Y');
			echo "Appointments in the last 10 days";	
		}
		?>
		</th></tr>
			<tr><th>S.No</th><th>App ID</th><th>Slot date</th><th>Booked On</th><th>Name</th><th>Age</th><th>Blood Group</th><th>Phone</th><th>Status</th></tr>
		<?php 
		$i=1;
		foreach($appointments as $donor){
		?>
		<tr>
		<?php echo form_open('bloodbank/register/appointment_register/'.$donor['donor_id']);?>
			<td><?php echo $i;?></td>
			<td><?php echo $donor['appointment_id'];?></td>
			<td><?php echo date('d-M-Y',strtotime($donor['date']));?></td>
			<td><?php echo date('d-M-Y',strtotime($donor['datetime']));?></td>
			<td><?php echo $donor['name'];?></td>
			<td><?php echo $donor['age'];?></td>
			<td><?php if($donor['blood_group']!="" && $donor['blood_group']!='0'){ echo $donor['blood_group']; }?></td>
			<td><?php echo $donor['phone'];?></td>
			<td><?php echo $donor['status'];?></td>
		</form>
		</tr>
		<?php 
		$i++;
		}
		?>
		</table>
		<?php }
		else{
			 ?>
			 <p>No appointments booked in the specified period.</p>
		<?php } ?>
	</div>
</div>

