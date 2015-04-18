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
	$(".detail_report").hide();
	$(".weighted_score").click(function(){
		var $month = $(this).attr('class');
		$("table.monthly").removeClass('sr-only');
		$("tr.monthly").addClass('sr-only');
		$month=$month.replace("weighted_score ","");
		$("."+$month).removeClass('sr-only');
		$(".detail_report").slideUp();
		$(this).prev(".detail_report").slideToggle();
	});
	$(".total_monthly").each(function(){
		if(parseFloat($(this).text().replace("%",""))<=75){
			$(this).css('background','#FF9999');
			$(this).parent().find('th:first').css('background','#FF9999');
		}
	});
});
</script>
		<style type="text/css">
		.alt:nth-child(odd){
			background:#CCCCFF !important;
		}
		.alt:nth-child(even){
			background:#6699FF !important;
		}
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
		.weighted_score{
			cursor:pointer;
		}
		.weighted_score:hover{
			background:white; !important
		}
		</style>
<div class="col-md-10 col-md-offset-2">
	<?php if(isset($msg)){ ?>
		<div class="alert alert-info"><?php echo $msg;?></div>
	<?php } ?>
	<?php echo validation_errors();?>	
	<?php echo form_open('sanitation/view_scores',array('role'=>'form','class'=>'form-custom')); ?>		
	<?php
	if($this->input->post('from_summary')) { ?>
			<div class="col-md-4">
				<select name="hospital" id="hospital" class="repositories" required >
				<option value="">Hospital</option>
				<?php foreach($all_hospitals as $d){
					echo "<option value='$d->hospital_id'";
					if($this->input->post('hospital') && $this->input->post('hospital')==$d->hospital_id) echo " selected ";
					echo ">$d->hospital</option>";
				}
				?>
				</select>
			</div>
		<input type="text" class="sr-only" value="1" name="from_summary" hidden />
	<?php } 
	else if(count($hospitals)==1){ ?>
			<input name="hospital" class="sr-only" value="<?php echo $hospitals[0]->hospital_id;?>" hidden />
			Hospital : <b><?php echo $hospitals[0]->hospital;?></b>&nbsp&nbsp&nbsp&nbsp&nbsp
		<?php } 
		else {
		?>
	    <label for="hospital">Hospital</label>
		<select name="hospital" id="hospital" class="form-control" required >
		<option value="">Hospital</option>
		<?php foreach($hospitals as $d){
			echo "<option value='$d->hospital_id'>$d->hospital</option>";
		}
		?>
		</select>
		<?php } ?>
	<label for="from_date">From Date</label>
	<input class="date form-control" name="from_date" id="from_date" <?php if($this->input->post('from_date')) { ?> value="<?php echo $this->input->post('from_date');?>" <?php } ?> type="text" required /> 
	<label for="to_date">To Date</label>
	<input class="date form-control" name="to_date" id="to_date" <?php if($this->input->post('to_date')) { ?> value="<?php echo $this->input->post('to_date');?>" <?php } ?> type="text" required /> 
	<input type="submit" class="btn btn-primary btn-md" name="submit" value="Submit" />
	<?php if(isset($scores) && count($scores)>0) { 
	$activities=array();
	$dates=array();
	foreach($scores as $s){
		if($s->frequency_type == "Weekly") 
		$activities[]=$s->activity_name;
	}
	
	$activities=array_unique($activities);
	if($this->input->post('from_date') && $this->input->post('to_date')){
		$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
		$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
	}
	else {
		$from_date = date("Y-m-d",strtotime('2014-07-01'));
		if(date("d")<7)
			$to_date = date("Y-m-29",strtotime('Last month'));
		else
		$to_date = date("Y-m-d",strtotime('-7 Days'));
	}
	$i=0;
	$date=$from_date;
	$dates[]=$date;
	while($i==0){
		if(date('d',strtotime($date))<28)
		$date=date("Y-m-d",strtotime($date."+7 days"));	
		if($date>$to_date){
			$i++;
			break;
		}	
		$dates[]=$date;

		if(date("d",strtotime($date))>28){
			$date=date("Y-m-d",strtotime($date."+7 days"));
			$date=date("Y-m-1",strtotime($date));
			if(date("U",strtotime($date))>date("U",strtotime($to_date))){
				$i++;
				break;
			}	
			$dates[]=$date;
		}
	}
	$dates=array_unique($dates);
	$for_months = $dates;
	$months=array();
	rsort($for_months);
	foreach($for_months as $date){
		if(!in_array(date("M,Y",strtotime($date)),$months)){
			$months[]=date("M,Y",strtotime($date));
		}
	}
	?>
	<br />
	<br />
	<div class="panel">
	<div class="pull-right">
		<span style="width:10px;background:#FF9999;margin:5px;">&nbsp&nbsp&nbsp&nbsp </span> Monthly score % <= 75 <br />
		<span style="width:10px;background:#99FF99;margin:5px;">&nbsp&nbsp&nbsp&nbsp </span> Weekly scores entered <br />
		<span style="width:10px;background:#FFCC66;margin:5px;">&nbsp&nbsp&nbsp&nbsp </span> Weekly scores not entered 
	</div>
	Sanitation scores for the period : <b><?php echo date("d-M-Y",strtotime($from_date));?></b> to <b><?php echo date('d-M-Y',strtotime($to_date));?></b><br />	
	</div>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
			<th colspan="100" class="text-center"><?php echo $scores[0]->hospital;?> - Detailed Report </th>
			</tr>
		</thead>
	<?php $i=1;
	foreach($months as $month){
	$week_total_score=0;
	$total_score=0;
	$week_total_weightage=0;
	$total_weightage=0;
	$total_days=0;
	?>
		<tbody class="detail_report" hidden>
			<tr>
			<th rowspan="2" class="text-center">From</th>
			<th rowspan="2" class="text-center">To</th>
			<th rowspan="2" class="text-center">No. Days</th>
			<?php foreach($activities as $activity){ ?>
				<th colspan="2" class="text-center alt"><?php echo $activity;?></th>
			<?php } ?>
			<th colspan="3" class="text-center">Overall</th>
			</tr>
			<tr>
			<?php foreach($activities as $activity){ ?>
				<th class="text-center">Score</th>
				<th class="text-center">Max. Marks</th>
			<?php } ?>
				<th class="text-center">Score</td>
				<th class="text-center">Max. Marks</td>
				<th class="text-center">%</td>
			</tr>
		<?php 
		foreach($dates as $d){
			$date_flag=0;
			if(date("M,Y",strtotime($d))==$month){
			?>
			<tr>
				<td class="text-center"><?php $from_date=date("d-M-Y",strtotime($d)); echo $from_date ?></td>
				<td class="text-center">
					<?php if(date('d',strtotime($d))>28){ $to_date=date("t-M-Y",strtotime($d)); } else $to_date = date("d-M-Y",strtotime($d.'+6 days'));
					echo $to_date;
					?>
				</td>
				<td class="text-center"><?php $days= (date("U",strtotime($to_date)) - date("U",strtotime($from_date)))/60/60/24+1;echo $days;?></td>
				<?php 
				$j=0;
				foreach($activities as $activity){
					$i=0; 
					foreach($scores as $s){
						if(date("Y-m-d",strtotime($d))==date('Y-m-d',strtotime($s->date)) && $s->activity_name==$activity){
						if($s->score==0 || $s->score == NULL) { $background_color = "#FFCC66"; } else $background_color = "#99FF99"; ?>					
						<td class="text-center" style="background-color : <?php echo $background_color;?> !important"><b><?php echo $s->score;?></b></td>
						<td class="text-center"><?php echo $s->weightage;?></td>
						<?php
						$week_total_score+=$s->score;
						$week_total_weightage+=$s->weightage;
						$date_flag = 1;
						break;
						}
						else if($s->score == NULL && $s->activity_name==$activity){
							  ?>
							<td class="text-center" style="background-color : #FFCC66"><b>0</b></td>
							<td class="text-center"><?php echo $s->weightage;?></td>
						<?php 
						$date_flag = 1;
						$week_total_weightage+=$s->weightage;
						break; 
						}
						$i++;
						if(($i>count($scores)-count($activities) && $s->activity_name==$activity)){
						 ?>
						<td class="text-center" style="background-color :#FFCC66 !important"><b>0</b></td>
						<td class="text-center"><?php echo $s->weightage;?></td>
					<?php 
						$week_total_weightage+=$s->weightage;
						$date_flag = 1;
						} 
					?>
				<?php }
				$j++;
				}
					if($date_flag!=1){
						foreach($activities as $activity){ ?>
						<?php foreach($scores as $s) { 
								if($s->activity_name == $activity) { ?>
									<td class="text-center" style="background-color :#FFCC66 !important"><b>0</b></td>
									<td class="text-center"><?php echo $s->weightage;?></td>
					<?php 	
							$week_total_weightage+=$s->weightage;
							break;
								}
							}
						}
					}
				
				if($s->score==0 || $s->score == NULL) { $background_color = "#FFCC66"; } else $background_color = "#99FF99"; ?>
				<td class="text-center"  style="background-color : <?php echo $background_color;?> !important"><b><?php echo number_format($week_total_score,1);?></b></td>
				<td class="text-center"><?php echo $week_total_weightage;?></td>
				<td class="text-center" style="background-color : <?php echo $background_color;?> !important"><?php echo number_format(($week_total_score/$week_total_weightage)*100,2);
				$total_score+=$week_total_score*$days; $week_total_score=0;
				$total_weightage+=$week_total_weightage*$days; $week_total_weightage=0;?>%</td>
			</tr>
		<?php $total_days+=$days;  } } ?>
		</tbody>
		<tbody class="weighted_score <?php echo date("mY",strtotime($month));?>">
			<tr>
				<th><?php echo $month;?></th>
				<th class="text-center">Total No. of Days</th>
				<th class="text-center"><?php echo $total_days;?></th>
				<th colspan="<?php echo ($j*2)+2;?>" class="text-right">	Total Weighted Monthly Score</th>
				<th class="text-center total_monthly"><?php echo number_format((($total_score/$total_days)/($total_weightage/$total_days))*100,2);?>%</th>
			</tr>
		</tbody>
		<?php }?>	
	</table>
	<?php if(count($months)>0){ ?>
	<table class="table table-bordered table-striped monthly sr-only" >
		<thead>
			<tr>
				<th colspan="100">Monthly</th>
			</tr>
			<tr>
				<th>#</th>
				<th>Month</th>
				<th>Activity</th>
				<th>Comment</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=1;
			foreach($scores as $s){
						foreach($months as $m){

				if($s->frequency_type == "Monthly" && in_array(date("M,Y",strtotime($s->date)),$months)){ ?>
					<tr class="<?php echo date("mY",strtotime($s->date));?> monthly sr-only">
						<td><?php echo $i++;?></td>
						<td><?php echo date("M, Y",strtotime($s->date));?></td>
						<td><?php echo $s->activity_name;?></td>
						<td><?php echo $s->comments;?></td>
					</tr>
				<?php break;}
			}
		}
			?>
		</tbody>
	</table>
	<?php } ?>
	<?php } ?>
</div>
