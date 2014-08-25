<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(function(){
		$(".date").Zebra_DatePicker({
			direction:false
		});
	});
	<!-- Scripts for printing output table -->
	function printDiv(i)
	{
	var content = document.getElementById(i);
	var pri = document.getElementById("ifmcontentstoprint").contentWindow;
	pri.document.open();
	pri.document.write(content.innerHTML);
	pri.document.close();
	pri.focus();
	pri.print();
	}
</script>
<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute;display:none"></iframe>
<div class="col-md-10 col-sm-9">
	<h1>Donors Report</h1>
	<?php echo form_open('bloodbank/user_panel/print_certificates'); ?>
	<div>
		<input type="text" class="date" size="12" name="donation_date" />
		<select name="blood_group" style="width:50px;">
			<option value="" selected disabled>----</option>
			<option value="A+">A+</option>
			<option value="B+">B+</option>
			<option value="O+">O+</option>
			<option value="AB+">AB+</option>
			<option value="A-">A-</option>
			<option value="B-">B-</option>
			<option value="O-">O-</option>
			<option value="AB-">AB-</option>
		</select>
		<select name="camp_id" id="camps" style="width:150px;">
				<option value="">--Select Location--</option>
				<?php foreach($camps as $camp){
					echo "<option value='".$camp->camp_id."' id='camp".$camp->camp_id."'>$camp->camp_name, $camp->location</option>";
				?>
					
				<?php
				}
				?>
		</select>
		<input type="text" placeholder="From" name="from_num" size=4 />
		<input type="text" placeholder="To" name="to_num" size=4 />
		<input type="submit" name="submit" value="Search" />
	</form>
	<input type="button" value="Print" onclick="printDiv('print_div')" />
	</div>
	
	<?php 
	if($this->input->post('donation_date')) echo "Donors who donated on or before ".date("d-M-y",strtotime($this->input->post('donation_date'))). " | ";
	if($this->input->post('blood_group')) echo "Blood Group : ".$this->input->post('blood_group');
	if(count($donors)>0){ ?>
	<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
	<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead>
		<th>S.No</th>
		<th>Donor No.</th>
		<th>Name</th>
		<th>Date</th>
		<th>Camp</th>
		<th>Camp Address</th>
		</thead>
	<?php 
	$i=1;
	foreach($donors as $s){
	?>
	<tr>
		<td><?php echo $i++;?></td>
		<td><?php echo $s['blood_unit_num'];?></td>
		<td><?php echo $s['name'];?></td>
		<td><?php if($s['donation_date']!=0) echo date("d-M-y",strtotime($s['donation_date']));?></td>
		<td><?php echo $s['camp_name'];?></td>
		<td><?php echo $s['location'];?></td>
	</tr>
	<?php
	}
	?>
	</table>
	<div id="print_div" style="min-width:100%;min-height:100%;" hidden>
	<?php 
	foreach($donors as $d){
	?>
	<div style="min-width:100%;width:100%;min-height:100%;height:100%;font-size:1.4em;font-family:'Trebuchet MS'">
		<div style="left:20%;top:18%;position:relative;">
			<?php echo strtoupper($d['name']); ?>
		</div>
		<div style="left:75%;top:14%;position:relative;">
			<?php echo date('d-M-Y',strtotime($d['donation_date'])); ?>
		</div>
		<div style="left:22%;top:65%;position:relative;width:25%;">
			<?php echo strtoupper($d['camp_name'])."<br />".strtoupper($d['location']); ?>
		</div>
	</div>
	<?php 
	}
	?>
	</div>
	<?php
	} 
	else {
	?>
	<h2> No Donors found</h2>
	<?php } ?>
</div>
