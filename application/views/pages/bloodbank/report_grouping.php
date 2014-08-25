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
		<?php echo form_open('bloodbank/user_panel/report_screening'); ?>
		<div>
			<input type="text" placeholder="From date" size="10" name="from_date" id="from_date" />
			<input type="text" placeholder="To date" size="10" name="to_date" id="to_date" />
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
		<?php if(count($grouped)>0){ ?>
		<b>
		<?php
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date('d-M-Y',strtotime($this->input->post('from_date')));
			$to_date=date('d-M-Y',strtotime($this->input->post('to_date')));
			echo "Blood grouped from ".$from_date." to ".$to_date;
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
		 $this->input->post('from_date')==""?$date=$this->input->post('to_date'):$date=$this->input->post('from_date');
		 echo "Blood grouped on $date";
		}
		else{
			$from_date=date('d-M-Y',strtotime('-10 Days'));
			$to_date=date('d-M-Y');
			echo "Blood grouped in the last 10 days";	
		}
		?>
		</b>

		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>S.No</th><th>Date</th><th>Blood Unit No.</th><th>Donor Name</th><th>Blood Group</th><th>Anti A</th><th>Anti B</th><th>Anti AB</th><th>Anti D</th><th>A Cells</th><th>B Cells</th><th>O Cells</th><th>Du</th><th>Forward Done By</th><th>Reverse Done By</th></thead>
		<?php 
		$i=1;
		foreach($grouped as $row){
		?>
		<tr>
			<td><?php echo $i++;?></td>
			<td><?php echo date("d-M-Y",strtotime($row['grouping_date']));?></td>
			<td><?php echo $row['blood_unit_num'];?></td>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['blood_group'];?></td>
			<td><?php echo $row['anti_a'];?></td>
			<td><?php echo $row['anti_b'];?></td>
			<td><?php echo $row['anti_ab'];?></td>
			<td><?php echo $row['anti_d'];?></td>
			<td><?php echo $row['a_cells'];?></td>
			<td><?php echo $row['b_cells'];?></td>
			<td><?php echo $row['o_cells'];?></td>
			<td><?php echo $row['du'];?></td>
			<td><?php echo $row['forward_done_by'];?></td>
			<td><?php echo $row['reverse_done_by'];?></td>
			</tr>
		<?php 
		}
		?>
		</table>
		<?php }
		else{
			 ?>
			 <p>No grouping record in the specified period.</p>
		<?php } ?>
	</div>
</div>

