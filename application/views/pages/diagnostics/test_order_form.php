<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.css">

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.selectize.js"></script>
<script>
	$(function(){
		$("#test_area").on('change',function(){
			$(".test_master").hide();
			$(".test_area_"+$(this).val()).show();
		});
	});
</script>
<div class="col-md-8 col-md-offset-2">
<center>
<strong><?php if(isset($msg)){ echo $msg;}?></strong>

</center>
<br>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4>Order a test</h4>
	</div>
	<div class="panel-body">
		<?php echo validation_errors(); echo form_open('diagnostics/test_order',array('role'=>'form','class'=>'form-custom')); ?>
		<div class="form-group">
			<label for="order_by">Order by<font color='red'>*</font></label>
			<select name="order_by" class="form-control"  id="order_by">
				<option value="" selected disabled>Select Doctor</option>
				<?php
					foreach($doctors as $doctor){ ?>
						<option value="<?php echo $doctor->staff_id;?>"><?php echo $doctor->name;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group pull-right">
			<input class="form-control date" name="order_date" value="<?php echo date("d-M-Y");?>" />
			<input class="form-control time" name="order_time" value="<?php echo date("g:ia");?>" />
		</div>
		<hr>
		<div class="form-group">
			<label for="test_area">Test Area<font color='red'>*</font></label>
			<select name="test_area" class="form-control"  id="test_area">
				<option value="" selected disabled>Select Test Area</option>
				<?php
					foreach($test_areas as $test_area){ ?>
						<option value="<?php echo $test_area->test_area_id;?>"><?php echo $test_area->test_area;?></option>
				<?php } ?>
			</select>
		</div>
		<hr>
		<div class="form-group">
			<label for="test_area">Patient ID<font color='red'>*</font></label>
		
		<hr>
		<h5>Individual Tests</h5>
		<div class="form-group">
		<?php foreach($test_masters as $test_master){ ?>
			<div class="col-md-4 panel test_master test_area_<?php echo $test_master->test_area_id;?>">
				<div class="checkbox">
					<input class="checkbox form-control" type="checkbox" name="test_master[]" id="<?php echo $test_master->test_name;?>" value="<?php echo $test_master->test_master_id;?>" />
					<label for="<?php echo $test_master->test_name;?>"><?php echo $test_master->test_name;?></label>
				</div>
			</div>
		<?php } ?>
		</div>
		<hr>
		<h5>Test Groups</h5>
		<?php foreach($test_groups as $test_group){ ?>
			<div class="col-md-3 panel test_group test_group_<?php echo $test_group->group_id;?>">
				<div class="checkbox">
					<input class="checkbox form-control" type="checkbox" name="test_group[]" id="<?php echo $test_group->group_name;?>" value="<?php echo $test_group->group_id;?>" />
					<label for="<?php echo $test_group->group_name;?>"><?php echo $test_group->group_name;?></label>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="panel-footer">
		<div class="col-md-offset-4">
		</br>
		<button class="btn btn-lg btn-primary" type="submit" value="submit" name="ta_add">Order</button>
		</div>
	</div>
</div>
</div>