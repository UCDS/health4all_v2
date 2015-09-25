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
<style>

</style>



<div class="col-md-10 col-sm-9">
<?php
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date('d-M-Y',strtotime($this->input->post('from_date')));
			$to_date=date('d-M-Y',strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
		 $this->input->post('from_date')==""?$from_date=date("d-M-Y",strtotime($this->input->post('to_date'))):$from_date=date("d-M-Y",strtotime($this->input->post('from_date')));
		 $to_date=$from_date;
		}
		else if(!!$from_date && !!$to_date){
			$from_date=date('d-M-Y',strtotime($from_date));
			$to_date=date('d-M-Y',strtotime($to_date));
		}
		else if(!!$from_date || !!$to_date){
		 $from_date=="0"?$from_date=$to_date:$to_date=$from_date;
		}
		else{
			$from_date=date('d-M-Y',strtotime('-10 Days'));
			$to_date=date('d-M-Y');
		 }
		if($this->input->post('from_num') && $this->input->post('to_num')){
			$from_num=trim($this->input->post('from_num'));
			$to_num=trim($this->input->post('to_num'));
		}
		else if($this->input->post('from_num') || $this->input->post('to_num')){
		 $this->input->post('from_num')==""?$from_num=$this->input->post('to_num'):$from_num=$this->input->post('from_num');
		 $to_num=$from_num;
		}
		else {
			$from_num="";
			$to_num="";
		}
?>
	<div>
		<?php echo form_open('bloodbank/user_panel/report_donations',array('role'=>'form','class'=>'form-custom')); ?>
		<div>
			<input type="date" name="from_date" placeholder="From date..." id="from_date" required readonly>
            <input type="date" name="to_date" placeholder="To date..." id="to_date" required readonly>


			<input type="text" placeholder="From Num" size="10" class="form-control" value="<?php echo $from_num;?>" name="from_num" id="from_num" />
			<input type="text" placeholder="To Num" size="10" class="form-control" value="<?php echo $to_num;?>" name="to_num" id="to_num" />
			<select name="camp" class="form-control">
					<option value="" selected>Location</option>
					<?php foreach($camps as $c){
						echo "<option value='$c->camp_id'>$c->camp_name</option>";
					}
					?>
			</select>
			<input type="submit" value="Search" name="search" class='btn btn-primary btn-md' />
		</div>
		</form>
		<hr>
		<?php
		if(isset($msg)) {
			echo "<div class='alert alert-info'>$msg</div>";
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
		if($row->donation_status_id==6 && $row->screening_result==1){
			$background="style='background:#C0FAB4'";
		}
		else if($row->donation_status_id==6 && $row->screening_result==0){
			$background="style='background:#FAB4B4'";
		}
		else if($row->donation_status_id==5){
			$background="style='background:#FAEDB4'";
		}
		?>
		<tr  <?php echo $background;?>>
			<td><?php echo $i++;?></td>
			<td><?php echo date("d-M-Y",strtotime($row->donation_date));?></td>
			<td><?php echo $row->blood_unit_num;?></td>
			<td><?php echo $row->name;?></td>
			<td><?php echo $row->blood_group;?></td>
			<td style="width:70px;"><?php echo $row->camp_name;?></td>
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

