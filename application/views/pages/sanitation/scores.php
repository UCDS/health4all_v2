<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.selectize.js"></script>
<script type="text/javascript">
$(function(){
	$("#from_date").Zebra_DatePicker({
	  disabled_dates : ['* * * *'],
	  enabled_dates: ['1,8,15,22,29 * * *'],
	  direction:false
	});
	$("#to_date").Zebra_DatePicker({
	  disabled_dates : ['* * * *'],
	  enabled_dates: ['7,14,21,28-31 * * *'],
	  direction:false
	});
	$("#hospital").selectize();
});
</script>
		<style type="text/css">
		.selectize-control.repositories .selectize-dropdown > div {
			border-bottom: 1px solid rgba(0,0,0,0.05);
		}
		.selectize-control.repositories .selectize-dropdown .by {
			font-size: 11px;
			opacity: 0.8;
		}
		.selectize-control.repositories .selectize-dropdown .by::before {
			content: 'by ';
		}
		.selectize-control.repositories .selectize-dropdown .name {
			font-weight: bold;
			margin-right: 5px;
		}
		.selectize-control.repositories .selectize-dropdown .title {
			display: block;
		}
		.selectize-control.repositories .selectize-dropdown .description {
			font-size: 12px;
			display: block;
			color: #a0a0a0;
			white-space: nowrap;
			width: 100%;
			text-overflow: ellipsis;
			overflow: hidden;
		}
		.selectize-control.repositories .selectize-dropdown .meta {
			list-style: none;
			margin: 0;
			padding: 0;
			font-size: 10px;
		}
		.selectize-control.repositories .selectize-dropdown .meta li {
			margin: 0;
			padding: 0;
			display: inline;
			margin-right: 10px;
		}
		.selectize-control.repositories .selectize-dropdown .meta li span {
			font-weight: bold;
		}
		.selectize-control.repositories::before {
			-moz-transition: opacity 0.2s;
			-webkit-transition: opacity 0.2s;
			transition: opacity 0.2s;
			content: ' ';
			z-index: 2;
			position: absolute;
			display: block;
			top: 12px;
			right: 34px;
			width: 16px;
			height: 16px;
			background: url(<?php echo base_url();?>assets/images/spinner.gif);
			background-size: 16px 16px;
			opacity: 0;
		}
		.selectize-control.repositories.loading::before {
			opacity: 0.4;
		}
		</style>


<div class="col-md-10 col-md-offset-2">
	<?php if(isset($msg)){ ?>
		<div class="alert alert-info"><?php echo $msg;?></div>
	<?php } ?>
	<?php echo validation_errors();?>
	<?php echo form_open('sanitation/view_scores',array('role'=>'form','class'=>'form-custom')); ?>
	<div class="col-md-4">
		<select name="hospital" id="hospital" class="repositories" required >
		<option value="">Hospital</option>
		<?php foreach($all_hospitals as $d){
			echo "<option value='$d->hospital_id'>$d->hospital</option>";
		}
		?>
		</select>
	</div>
	<label for="from_date">From Date</label>
	<input class="date form-control" name="from_date" id="from_date" type="text" required /> 
	<label for="to_date">To Date</label>
	<input class="date form-control" name="to_date" id="to_date" type="text" required /> 
	<input type="text" class="sr-only" value="1" name="from_summary" hidden />
	<input type="submit" class="btn btn-primary btn-md" name="submit" value="Submit" />
	</form>
	<?php if(isset($scores) && count($scores)>0) {
		$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
		$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		?>
	<!--
	<script>
	$(function(){
	/*
	sortType="Alpha";
    chart=new Highcharts.Chart({
        chart: {
			renderTo : 'container1',
			height : <?php echo count($scores)*25;?>,
            type: 'bar'
        },
        title: {
            text: 'Sanitation Performance'
        },
        subtitle: {
            text: 'Summary'
        },
        xAxis: {
            categories: [<?php $i=count($scores); foreach ($scores as $s){echo "'".$s->hospital."'"; if($i!=1) echo ",";$i--;}?> ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Scores (%)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Score (%)',
            data: [<?php $i=count($scores); foreach ($scores as $s){ $total_score=$s->daily_score+$s->weekly_score+$s->fortnightly_score+$s->monthly_score;$total=$s->daily_total+$s->weekly_total+$s->fortnightly_total+$s->monthly_total;echo number_format(($total_score/$total)*100,1); if($i!=1) echo ",";$i--;}?>]
        }]
    });
	});
	*/
	</script>
	-->
	<br />
	<br />
	<div class="panel">
		Sanitation scores for the period : <b><?php echo $this->input->post('from_date');?></b> to <b><?php echo $this->input->post('to_date');?></b>
	<?php echo form_open('sanitation/view_summary',array('role'=>'form','class'=>'form-custom','id'=>'sort_form')); ?>
		<input type="text" class="sr-only" name="from_date" value="<?php echo $this->input->post('from_date');?>" readonly hidden />
		<input type="text" class="sr-only" name="to_date" value="<?php echo $this->input->post('to_date');?>" readonly hidden />
		<label class="pull-right">Sort By &nbsp; <select name="order_by" class="form-control pull-right" onchange="$('#sort_form').submit();" >
			<option value="asc" <?php if($this->input->post('order_by')=="asc") echo "selected"; ?>>Ascending Scores</option>
			<option value="desc" <?php if($this->input->post('order_by')=="desc") echo "selected"; ?>>Descending Scores</option>
			<option value="alpha" <?php if($this->input->post('order_by')=="alpha") echo "selected"; ?>>Alphabetic</option>
		</select>
		</label>
	</form>
	</div>
	
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
			<th colspan="4" class="text-center">Summary Report</th>
			</tr>
			<th>#</th>
			<th>Hospital</th>
			<!--
			<th>Score</th>
			<th>%</th>
			-->
		</thead>
	<?php $i=1; foreach($scores as $s){ 
			$total_score=$s->daily_score+$s->weekly_score+$s->fortnightly_score+$s->monthly_score;
			$total=$s->daily_total+$s->weekly_total+$s->fortnightly_total+$s->monthly_total;
			?>
			<tr onclick="$('#select_hospital_<?php echo $s->hospital_id;?>').submit();" <?php if(number_format(($total_score/$total)*100,1)>75){$color = "#CCFFCC";} else $color = "#FF9D9D";?> style="cursor:pointer;background-color:<?php echo $color;?>">
				<td>
					<?php echo form_open('sanitation/view_scores',array('role'=>'form','id'=>'select_hospital_'.$s->hospital_id));?>
					<?php echo $i++; ?>
					<input type="text" name="hospital" form="select_hospital_<?php echo $s->hospital_id;?>" value="<?php echo $s->hospital_id;?>" class="sr_only" hidden />
					<input type="text" name="from_date" form="select_hospital_<?php echo $s->hospital_id;?>" value="<?php echo $from_date;?>" class="sr_only" hidden />
					<input type="text" name="to_date" form="select_hospital_<?php echo $s->hospital_id;?>" value="<?php echo $to_date;?>" class="sr_only" hidden />
					</form>
				</td>
				<td><?php echo $s->hospital;?></td>
				<!--
				<td><?php echo number_format($s->weekly_score);?>/<?php echo number_format($s->weekly_total);?></td>
				<td><?php echo number_format(($total_score/$total)*100,1);?>%</td>	
				-->
			</tr>
		<?php } ?>
	</table>
	<?php } ?>
	<!-- <div id="container1" style="min-width: 310px; max-width: 800px; margin: 0 auto;background:#ccc"></div> -->
	
</div>