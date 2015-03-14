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
	<?php 
	$this->input->post('visit_type')?$visit_type = $this->input->post('visit_type'): $visit_type = "0";
	$from_date=date("Y-m-d");$to_date=$from_date;
	if($this->input->post('from_date')) $from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
	if($this->input->post('to_date')) $to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
	?>
		<h4>Test Orders Summary Report</h4>	
		<?php echo form_open("reports/order_summary/$type",array('role'=>'form','class'=>'form-custom')); ?>
					Visit Type : <select class="form-control" name="visit_type">
									<option value="" selected>All</option>
									<option value="OP" <?php if($visit_type == "OP") echo " selected ";?>>OP</option>
									<option value="IP" <?php if($visit_type == "IP") echo " selected ";?>>IP</option>
								</select>
					From Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y",strtotime($from_date)); ?>" name="from_date" id="from_date" size="15" />
					To Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y",strtotime($to_date)); ?>" name="to_date" id="to_date" size="15" />
					<input class="btn btn-sm btn-primary" type="submit" value="Submit" />
		</form>
	<br />
	<?php if(isset($report) && count($report)>0){ ?>
	<table class="table table-bordered table-striped">
	<thead>
		<th style="text-align:center">Department</th>
		<th style="text-align:center">Area</th>
		<th style="text-align:center">Test</th>
		<th style="text-align:center">Ordered</th>
		<th style="text-align:center">Completed</th>
		<th style="text-align:center">Reported</th>
		<th style="text-align:center">Rejected</th>
	</thead>
	<tbody>
	<?php 
	$tests_ordered=0;
	$tests_completed=0;
	$tests_reported=0;
	$tests_rejected=0;
	foreach($report as $s){
	?>
	<tr>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->department_id/$s->test_method_id/$visit_type/$from_date/$to_date/-1/$type";?>"><?php echo $s->department;?></a></td>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->department_id/$s->test_method_id/$visit_type/$from_date/$to_date/-1/$type";?>"><?php echo $s->test_method;?></a></td>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->department_id/$s->test_method_id/$visit_type/$from_date/$to_date/-1/$type";?>"><?php echo $s->test_name;?></a></td>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->department_id/$s->test_method_id/$visit_type/$from_date/$to_date/0/$type";?>"><?php echo $s->tests_ordered;?></a></td>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->department_id/$s->test_method_id/$visit_type/$from_date/$to_date/1/$type";?>"><?php echo $s->tests_completed;?></a></td>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->department_id/$s->test_method_id/$visit_type/$from_date/$to_date/2/$type";?>"><?php echo $s->tests_reported;?></a></td>
		<td><a href="<?php echo base_url()."reports/order_detail/$s->test_master_id/$s->department_id/$s->test_method_id/$visit_type/$from_date/$to_date/3/$type";?>"><?php echo $s->tests_rejected;?></a></td>
	</tr>
	<?php
	$tests_ordered+=$s->tests_ordered;
	$tests_completed+=$s->tests_completed;
	$tests_reported+=$s->tests_reported;
	$tests_rejected+=$s->tests_rejected;
	}
	?>
	<thead>
		<th colspan="3">Total </th>
		<th ><?php echo $tests_ordered;?></th>
		<th ><?php echo $tests_completed;?></th>
		<th ><?php echo $tests_reported;?></th>
		<th ><?php echo $tests_rejected;?></th>
	</thead>
	</tbody>
	</table>
	<?php } else { ?>
	No Orders on the given date.
	<?php } ?>
	</div>