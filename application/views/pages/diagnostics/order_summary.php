<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/table2CSV.js"></script>
<script type="text/javascript">
$(function(){
	$("#from_date,#to_date").Zebra_DatePicker();
	$("#generate-csv").click(function(){
		$(".table").table2CSV();
	});
});
</script>
	<div class="row">
		<h4>Test Orders Summary Report</h4>	
		<?php echo form_open("reports/order_summary",array('role'=>'form','class'=>'form-custom')); ?>
					From Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y"); ?>" name="from_date" id="from_date" size="15" />
					To Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y"); ?>" name="to_date" id="to_date" size="15" />
					<input class="btn btn-sm btn-primary" type="submit" value="Submit" />
		</form>
	<br />
	<?php 
	$from_date=0;$to_date=0;
	if($this->input->post('from_date')) $from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
	if($this->input->post('to_date')) $to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
	?>
	<?php if(isset($report) && count($report)>0){ ?>
	<table class="table table-bordered table-striped">
	<thead>
		<th style="text-align:center">Department</th>
		<th style="text-align:center">Area</th>
		<th style="text-align:center">Test</th>
		<th style="text-align:center">Count</th>
	</thead>
	<tbody>
	<?php 
	$total_m14to30=0;
	foreach($report as $s){
	?>
	<tr>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->test_area_id/$s->test_method_id/$from_date/$to_date";?>"><?php echo $s->test_area;?></a></td>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->test_area_id/$s->test_method_id/$from_date/$to_date";?>"><?php echo $s->test_method;?></a></td>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->test_area_id/$s->test_method_id/$from_date/$to_date";?>"><?php echo $s->test_name;?></a></td>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->test_area_id/$s->test_method_id/$from_date/$to_date";?>"><?php echo $s->count;?></a></td>
	</tr>
	<?php
	$total_m14to30+=$s->count;
	}
	?>
	<thead>
		<th colspan="3">Total </th>
		<th ><?php echo $total_m14to30;?></th>
	</thead>
	</tbody>
	</table>
	<?php } else { ?>
	No Orders on the given date.
	<?php } ?>
	</div>