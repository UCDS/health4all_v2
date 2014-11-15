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
		<h4>Out-Patient Summary Report</h4>	
		<?php echo form_open("reports/op_summary",array('role'=>'form','class'=>'form-custom')); ?>
					From Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y"); ?>" name="from_date" id="from_date" size="15" />
					To Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y"); ?>" name="to_date" id="to_date" size="15" />
					<input class="btn btn-sm btn-primary" type="submit" value="Submit" />
		</form>
	<br />
	<?php if(isset($report) && count($report)>0){ ?>
	<table class="table table-bordered table-striped">
	<thead>
		<th style="text-align:center" rowspan="2">Department</th>
		<th style="text-align:center" colspan="3"><=14 Years</th>
		<th style="text-align:center" colspan="3">14 to 30 Years</th>
		<th style="text-align:center" colspan="3">30 to 50 Years</th>
		<th style="text-align:center" colspan="3">>50 Years</th>
		<th style="text-align:center" rowspan="1" colspan="3">Total OP Visits</th>
	</thead>
	<thead>
		<th></th><th>Male</th><th>Female</th><th>Total</th>
		<th>Male</th><th>Female</th><th>Total</th>
		<th>Male</th><th>Female</th><th>Total</th>
		<th>Male</th><th>Female</th><th>Total</th>
		<th>Male</th><th>Female</th><th>Total</th>
	</thead>
	<tbody>
	<?php 
	$total_mchild=0;
	$total_fchild=0;
	$total_child=0;
	$total_m14to30=0;
	$total_f14to30=0;
	$total_14to30=0;
	$total_m30to50=0;
	$total_f30to50=0;
	$total_30to50=0;
	$total_m50plus=0;
	$total_f50plus=0;
	$total_50plus=0;
	$total_male=0;
	$total_female=0;
	$total_op=0;
	foreach($report as $s){
	?>
	<tr>
		<td><?php echo $s->department;?></td>
		<td><?php echo $s->op_mchild;?></td>
		<td><?php echo $s->op_fchild;?></td>
		<td><?php echo $s->op_child;?></td>
		<td><?php echo $s->op_m14to30;?></td>
		<td><?php echo $s->op_f14to30;?></td>
		<td><?php echo $s->op_14to30;?></td>
		<td><?php echo $s->op_m30to50;?></td>
		<td><?php echo $s->op_f30to50;?></td>
		<td><?php echo $s->op_30to50;?></td>
		<td><?php echo $s->op_m50plus;?></td>
		<td><?php echo $s->op_f50plus;?></td>
		<td><?php echo $s->op_50plus;?></td>
		<td><?php echo $s->op_male;?></td>
		<td><?php echo $s->op_female;?></td>
		<th><?php echo $s->op;?></th>
	</tr>
	<?php
	$total_mchild+=$s->op_mchild;
	$total_fchild+=$s->op_fchild;
	$total_child+=$s->op_child;
	$total_m14to30+=$s->op_m14to30;
	$total_f14to30+=$s->op_f14to30;
	$total_14to30+=$s->op_14to30;
	$total_m30to50+=$s->op_m30to50;
	$total_f30to50+=$s->op_f30to50;
	$total_30to50+=$s->op_30to50;
	$total_m50plus+=$s->op_m50plus;
	$total_f50plus+=$s->op_f50plus;
	$total_50plus+=$s->op_50plus;
	$total_male+=$s->op_male;
	$total_female+=$s->op_female;
	$total_op+=$s->op;
	}
	?>
	<thead>
		<th>Total </th>
		<th ><?php echo $total_mchild;?></th>
		<th ><?php echo $total_fchild;?></th>
		<th ><?php echo $total_child;?></th>
		<th ><?php echo $total_m14to30;?></th>
		<th ><?php echo $total_f14to30;?></th>
		<th ><?php echo $total_14to30;?></th>
		<th ><?php echo $total_m30to50;?></th>
		<th ><?php echo $total_f30to50;?></th>
		<th ><?php echo $total_30to50;?></th>
		<th ><?php echo $total_m50plus;?></th>
		<th ><?php echo $total_f50plus;?></th>
		<th ><?php echo $total_50plus;?></th>
		<th ><?php echo $total_male;?></th>
		<th ><?php echo $total_female;?></th>
		<th ><?php echo $total_op;?></th>
	</thead>
	</tbody>
	</table>
	<?php } else { ?>
	No patient registrations on the given date.
	<?php } ?>
	</div>