<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$(".date").Zebra_DatePicker();
	$("#hospital").on('change',function(){
		var hospital_id=$(this).val();
		$("#area option").hide().attr('disabled',true);
		$("#area option[class="+hospital_id+"]").show().attr('disabled',false);
	});
});
</script>
<div class="col-md-10 col-md-offset-2">
	<?php if(isset($msg)){ ?>
		<div class="alert alert-info"><?php echo $msg;?></div>
	<?php } ?>
	<?php echo validation_errors();?>
	<?php echo form_open('sanitation/view_scores',array('role'=>'form','class'=>'form-custom')); ?>
	<label for="from_date">From Date</label>
	<input class="date form-control" name="from_date" type="text" /> 
	<label for="to_date">To Date</label>
	<input class="date form-control" name="to_date" type="text" /> 
	<input type="submit" class="btn btn-primary btn-lg" name="submit" value="Submit" />
	<?php if(isset($scores) && count($scores)>0) { ?>
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<th>#</th>
			<th>Hospital</th>
			<th>Daily Score</th>
			<th>Weekly Score</th>
			<th>Fortnightly Score</th>
			<th>Monthly Score</th>
			<th>Total Score</th>
			<th>%</th>
	<?php $i=1; foreach($scores as $s){ 
			$total_score=$s->daily_score+$s->weekly_score+$s->fortnightly_score+$s->monthly_score;
			$total=$s->daily_total+$s->weekly_total+$s->fortnightly_total+$s->monthly_total;
			?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo $s->hospital;?></td>
				<td><?php echo number_format($s->daily_score);?>/<?php echo number_format($s->daily_total);?></td>
				<td><?php echo number_format($s->weekly_score);?>/<?php echo number_format($s->weekly_total);?></td>
				<td><?php echo number_format($s->fortnightly_score);?>/<?php echo number_format($s->fortnightly_total);?></td>
				<td><?php echo number_format($s->monthly_score);?>/<?php echo number_format($s->monthly_total);?></td>
				<td><?php echo number_format($total_score);?>/<?php echo number_format($total);?></td>
				<td><?php echo number_format(($total_score/$total)*100);?>%</td>	
			</tr>
		<?php } ?>
	</table>
	<?php } ?>
	</form>
		
</div>