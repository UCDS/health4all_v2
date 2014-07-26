<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".date").Zebra_DatePicker();
	$(".time").timeEntry();
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
	<?php echo validation_errors(); echo form_open('sanitation/evaluate',array('role'=>'form','class'=>'form-custom')); ?>
	    <label for="area_activity">Hospital</label>
		<select name="hospital" id="hospital" class="form-control">
		<option value="">Hospital</option>
		<?php foreach($hospitals as $d){
			echo "<option value='$d->hospital_id'>$d->hospital</option>";
		}
		?>
		</select>
	    <label for="area_activity">Area</label>
		<select name="area" id="area" class="form-control">
		<option value="">Area</option>
		<?php foreach($area as $d){
			echo "<option value='$d->area_id' class='$d->hospital_id' hidden disabled>$d->area_name</option>";
		}
		?>
		</select>
		<label for="date">Date</label>
		<input type="text" class="date form-control" name="date" />
		<input type="submit" value="Select" name="select_area" class="btn btn-primary btn-sm" />
	<?php if($this->input->post('select_area')){ ?>
	<br />
	<br />
	<div class="panel panel-default">
		<div class="panel panel-heading">
		<?php if($this->input->post('date')){ ?>
			<div class="pull-right">
				Date : <input type="text" value="<?php echo date("d-M-Y",strtotime($this->input->post('date')));?>" name="evaluation_date" class="form-control" readonly />
			</div>
		<?php } ?>
			<div class=""><h4>Evaluation Form</h4></div>
		</div>
		<div class="panel-body">
			<?php
				$daily_activities=array();
				$weekly_activities=array();
				$fortnightly_activities=array();
				$monthly_activities=array();
				foreach($sanitation_activity as $a){
					if(!in_array($a->activity_name,$daily_activities) && !in_array($a->activity_name,$weekly_activities) && !in_array($a->activity_name,$fortnightly_activities) && !in_array($a->activity_name,$monthly_activities)){
						if($a->frequency_type=="Daily")
							$daily_activities[]=$a->activity_name; 
						else if($a->frequency_type=="Weekly")
							$weekly_activities[]=$a->activity_name;
						else if($a->frequency_type=="Fortnightly")
							$fortnightly_activities[]=$a->activity_name;
						else if($a->frequency_type=="Monthly")
							$monthly_activities[]=$a->activity_name;
					}
				}
			?>
			
			
			<?php if(count($daily_activities)>0){ ?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th colspan="100">Daily</th>
					<tr>
						<th>#</th>
						<th>Activity</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;
				foreach($daily_activities as $activity){?>
					<tr>
						<td><?php echo $i++;?></td>
						<td><?php echo $activity;?></td>
						<?php foreach($sanitation_activity as $a){
								if($a->activity_name == $activity){
						?>
						<td>
							<input type="checkbox" value="<?php echo $a->activity_id;?>" name="activity_id[]"  />
							<input type="text" class="time form-control" value="<?php echo $a->day_activity_time;?>" name="activity_<?php echo $a->activity_id;?>" size="7" /></td>
						<?php }
						} ?>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<?php } ?>
			
			
			<?php if(count($weekly_activities)>0){ ?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th colspan="100">Weekly</th>
					<tr>
						<th>#</th>
						<th>Activity</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;
				foreach($weekly_activities as $activity){?>
					<tr>
						<td><?php echo $i++;?></td>
						<td><?php echo $activity;?></td>
						<?php foreach($sanitation_activity as $a){
								if($a->activity_name == $activity){
						?>
						<td>
							<input type="checkbox" value="<?php echo $a->activity_id;?>" name="weekly_activity_id[]"  />
							<input type="text" class="date form-control" placeholder="Date" value="<?php if($a->week_activity_date) echo date("d-M-Y",strtotime($a->week_activity_date));?>" name="activity_date_<?php echo $a->activity_id;?>" />
							<input type="text" class="time form-control" placeholder="Time" value="<?php echo $a->week_activity_time;?>" name="other_activity_<?php echo $a->activity_id;?>" size="7" />
							<input type="number" class="form-control" min=0 max="<?php echo $a->weightage;?>" value="<?php echo $a->weekly_score;?>" name="activity_score_<?php echo $a->activity_id;?>" size="3" /></td>
						<?php }
						} ?>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<?php } ?>
			<?php if(count($fortnightly_activities)>0){ ?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th colspan="100">Fortnightly</th>
					<tr>
						<th>#</th>
						<th>Activity</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;
				foreach($fortnightly_activities as $activity){?>
					<tr>
						<td><?php echo $i++;?></td>
						<td><?php echo $activity;?></td>
						<?php foreach($sanitation_activity as $a){
								if($a->activity_name == $activity){
						?>
						<td>
							<input type="checkbox" value="<?php echo $a->activity_id;?>" name="fortnightly_activity_id[]"  />
							<input type="text" class="date form-control" value="<?php if($a->fortnight_activity_date) echo date("d-M-Y",strtotime($a->fortnight_activity_date));?>" name="activity_date_<?php echo $a->activity_id;?>" />
							<input type="text" class="time form-control" value="<?php echo $a->fortnight_activity_time;?>" name="other_activity_<?php echo $a->activity_id;?>" size="7" /></td>
						<?php }
						} ?>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<?php } ?>
			<?php if(count($monthly_activities)>0){ ?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th colspan="100">Monthly</th>
					<tr>
						<th>#</th>
						<th>Activity</th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1;
				foreach($monthly_activities as $activity){?>
					<tr>
						<td><?php echo $i++;?></td>
						<td><?php echo $activity;?></td>
						<?php foreach($sanitation_activity as $a){
								if($a->activity_name == $activity){
						?>
						<td>
							<input type="checkbox" value="<?php echo $a->activity_id;?>" name="monthly_activity_id[]"  />
							<input type="text" class="date form-control" value="<?php if($a->month_activity_date) echo date("d-M-Y",strtotime($a->month_activity_date));?>" name="activity_date_<?php echo $a->activity_id;?>" />
							<input type="text" class="time form-control" value="<?php echo $a->month_activity_time;?>" name="other_activity_<?php echo $a->activity_id;?>" size="7" /></td>
						<?php }
						} ?>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<?php } ?>
		</div>
		<div class="panel-footer">
			<button class="btn btn-sm btn-primary col-md-offset-5" type="submit" name="submit" value="Submit">Submit</button>
		</div>
	</div>
	<?php } ?>
	</form>
</div>