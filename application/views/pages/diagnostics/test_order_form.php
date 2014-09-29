<link rel="stylesheet" href="<?php echo base_url();?>assets/css/selectize.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.css">

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.selectize.js"></script>
<script>
	$(function(){
		var url="<?php echo base_url();?>diagnostics/search_patients";
		$('#select_patient').selectize({
			valueField: 'title',
			labelField: 'title',
			searchField: 'title',
			options: [],
			create: false,
			render: {
				option: function(item, escape) {
					var actors = [];
					for (var i = 0, n = item.abridged_cast.length; i < n; i++) {
						actors.push('<span>' + escape(item.abridged_cast[i].name) + '</span>');
					}

					return '<div>' +
						'<img src="' + escape(item.posters.thumbnail) + '" alt="">' +
						'<span class="title">' +
							'<span class="name">' + escape(item.title) + '</span>' +
						'</span>' +
						'<span class="description">' + escape(item.synopsis || 'No synopsis available at this time.') + '</span>' +
						'<span class="actors">' + (actors.length ? 'Starring ' + actors.join(', ') : 'Actors unavailable') + '</span>' +
					'</div>';
				}
			},
			load: function(query, callback) {
				if (!query.length) return callback();
				$.ajax({
					url: '<?php echo base_url();?>diagnostics/search_patients',
					type: 'POST',
					dataType: 'JSON',
					data: {
						q: query,
						page_limit: 10
					},
					error: function(e) {
						alert('hi');
						callback();
					},
					success: function(res) {
						callback(res.movies);
					}
				});
			}
		});
		$(".test_method").hide();
		$("#test_area").on('change',function(){
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
			<select class="form-control" name="patient_type">
				<option value="" selected disabled>Select Patient Type</option>
				<option value="OP">OP</option>
				<option value="IP">IP</option>
			</select><font color='red'>*</font>
			<label>OP/IP Number<font color='red'>*</font></label>
			<select  name="visit_id" id="select_patient"></select>
		</div>
		<hr>
		<div class="form-group">
			<select class="form-control" name="specimen_type">
				<option value="" selected disabled>Specimen Type</option>
				<?php foreach($specimen_types as $specimen){ ?>
					<option value="<?php echo $specimen->specimen_type_id;?>"><?php echo $specimen->specimen_type;?></option>
				<?php } ?>
			</select><font color='red'>*</font>
			<label>Sample ID<font color='red'>*</font></label>
			<input type="text" placeholder="Sample ID" name="sample_id" class="form-control" />
			<input type="text" placeholder="Sample Container Type" name="sample_container" class="form-control" />
		</div>	
		<hr>
		<h5>Individual Tests</h5>
		<div class="form-group">
		<?php 
		$test_methods=array();
		foreach($test_masters as $test_master){
			$test_methods[]=$test_master->test_method;
		}
		$test_methods=array_unique($test_methods);
		foreach($test_methods as $test_method){ ?>
			<div class="col-md-4 test_method test_area_<?php echo $test_master->test_area_id;?>">
				<b><?php echo $test_method;?></b>
		<?php
			foreach($test_masters as $test_master){
				if($test_master->test_method == $test_method) { ?>
				<div class="col-md-12 panel">
					<div class="checkbox">
						<input class="checkbox form-control" type="checkbox" name="test_master[]" id="<?php echo $test_master->test_name;?>" value="<?php echo $test_master->test_master_id;?>" />
						<label for="<?php echo $test_master->test_name;?>"><?php echo $test_master->test_name;?></label>
					</div>
				</div>
			<?php }
				} ?>
			</div>
		<?php } ?>
		</div>
		<hr>
		<?php /*
		<h5>Test Groups</h5>
		<?php foreach($test_groups as $test_group){ ?>
			<div class="col-md-3 panel test_group test_group_<?php echo $test_group->group_id;?>">
				<div class="checkbox">
					<input class="checkbox form-control" type="checkbox" name="test_group[]" id="<?php echo $test_group->group_name;?>" value="<?php echo $test_group->group_id;?>" />
					<label for="<?php echo $test_group->group_name;?>"><?php echo $test_group->group_name;?></label>
				</div>
			</div>
		<?php } 
		*/
		?>
	</div>
	<div class="panel-footer">
		<div class="col-md-offset-4">
		</br>
		<button class="btn btn-lg btn-primary" type="submit" value="submit" name="ta_add">Order</button>
		</div>
	</div>
</div>
</div>
