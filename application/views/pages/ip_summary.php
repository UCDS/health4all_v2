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
		<h4>In-Patient Summary Report</h4>	
		<?php echo form_open("reports/ip_summary",array('role'=>'form','class'=>'form-custom')); ?>
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
	<?php if(count($report)>0){ ?>
	<table class="table table-bordered table-striped">
	<thead>
		<th style="text-align:center" rowspan="2">Department</th>
		<th style="text-align:center" colspan="3"><=14 Years</th>
		<th style="text-align:center" colspan="3">14 to 30 Years</th>
		<th style="text-align:center" colspan="3">30 to 50 Years</th>
		<th style="text-align:center" colspan="3">>50 Years</th>
		<th style="text-align:center" rowspan="1" colspan="3">Total IP Admits</th>
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
	$total_ip=0;
	foreach($report as $s){
	?>
	<tr>
		<td><?php echo $s->department;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/M/14/0/$from_date/$to_date";?>"><?php echo $s->ip_mchild;?></a></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/F/14/0/$from_date/$to_date";?>"><?php echo $s->ip_fchild;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/0/14/0/$from_date/$to_date";?>"><?php echo $s->ip_child;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/M/14/30/$from_date/$to_date";?>"><?php echo $s->ip_m14to30;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/F/14/30/$from_date/$to_date";?>"><?php echo $s->ip_f14to30;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/0/14/30/$from_date/$to_date";?>"><?php echo $s->ip_14to30;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/M/30/50/$from_date/$to_date";?>"><?php echo $s->ip_m30to50;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/F/30/50/$from_date/$to_date";?>"><?php echo $s->ip_f30to50;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/0/30/50/$from_date/$to_date";?>"><?php echo $s->ip_30to50;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/M/0/50/$from_date/$to_date";?>"><?php echo $s->ip_m50plus;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/F/0/50/$from_date/$to_date";?>"><?php echo $s->ip_f50plus;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/0/0/50/$from_date/$to_date";?>"><?php echo $s->ip_50plus;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/M/0/0/$from_date/$to_date";?>"><?php echo $s->ip_male;?></td>
		<td><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/F/0/0/$from_date/$to_date";?>"><?php echo $s->ip_female;?></td>
		<th><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/0/0/0/$from_date/$to_date";?>"><?php echo $s->ip;?></th>
	</tr>
	<?php
	$total_mchild+=$s->ip_mchild;
	$total_fchild+=$s->ip_fchild;
	$total_child+=$s->ip_child;
	$total_m14to30+=$s->ip_m14to30;
	$total_f14to30+=$s->ip_f14to30;
	$total_14to30+=$s->ip_14to30;
	$total_m30to50+=$s->ip_m30to50;
	$total_f30to50+=$s->ip_f30to50;
	$total_30to50+=$s->ip_30to50;
	$total_m50plus+=$s->ip_m50plus;
	$total_f50plus+=$s->ip_f50plus;
	$total_50plus+=$s->ip_50plus;
	$total_male+=$s->ip_male;
	$total_female+=$s->ip_female;
	$total_ip+=$s->ip;
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
		<th ><?php echo $total_ip;?></th>
	</thead>
	</tbody>
	</table>
	<?php } else { ?>
	No patient registrations on the given date.
	<?php } ?>
	</div>