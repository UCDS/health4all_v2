<link rel="stylesheet" href="<?php echo base_url();?>assets/css/selectize.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/modal-fullscreen.css" >
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.css">

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
			
		.modal-body,.modal-header{
			background:#111;
		}
		</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.selectize.js"></script>

<div class="col-md-8 col-md-offset-2">
	<?php if(isset($msg)){ ?> <div class="alert alert-info"> <?php echo $msg;?></div> <?php } ?>	

<?php if(!isset($mode)){ ?>
	<center><h3>Import from PACS</h3></center><br>
	<table class="table table-striped table-bordered">
	<thead>
		<th>S.No</th>
		<th>Patient ID</th>
		<th>Patient</th>
		<th>Modality</th>
		<th>Study Date</th>
		<th>Study Time</th>
		<th>View</th>
		<th>Import</th>
	</thead>
	<tbody>
	<?php	
	$i=1;
		foreach($dicoms as $d){ ?>
		<tr>
			<td>
				<?php echo form_open('pacs/import',array('role'=>'form','id'=>'import_form_'.$i)); ?>
				<?php echo $i;?>
			</td>
			<td><?php echo $d->pat_id;?></td>
			<td><?php echo  str_replace("^","",$d->pat_name)." | ".floor($d->age/12)."Y ".floor($d->age%12)."M | ".$d->pat_sex;?></td>
			<td><?php echo $d->body_part." ".$d->modality;?></td>
			<td><?php echo date("d-M-Y",strtotime($d->study_datetime));?></td>
			<td><?php echo date("g:ia",strtotime($d->study_datetime));?></td>
			<td>
				<a class="glyphicon glyphicon-eye-open" class="view_dicom" onclick="loadDicom('<?php echo $d->filepath;?>')" data-toggle="modal" data-target="#myModal" href="#"></a>
			</td>
			<td>
				<input type="text" class="sr-only" hidden name="patient_id" value="<?php echo $d->pat_id;?>" />
				<input type="text" class="sr-only" hidden name="patient_name" value="<?php echo str_replace("^","",$d->pat_name);?>" />
				<input type="text" class="sr-only" hidden name="patient_age" value="<?php echo floor($d->age/12)."Y ".floor($d->age%12)."M";?>" />
				<input type="text" class="sr-only" hidden name="patient_sex" value="<?php echo $d->pat_sex;?>" />
				<input type="text" class="sr-only" hidden name="study_modality" value="<?php echo $d->modality;?>" />
				<input type="text" class="sr-only" hidden name="study_datetime" value="<?php echo $d->study_datetime;?>" />
				<input type="text" class="sr-only" hidden name="filepath" value="<?php echo $d->filepath;?>" />
				<input type="text" class="sr-only" hidden name="select_test" value="<?php echo $d->study_id;?>" />
				<input type="submit" name="import" value="Import" class="btn btn-primary btn-sm" />
				</form>
			</td>
		</tr>
	<?php $i++;} ?>
	</tbody>
	</table>
	<script type="text/javascript">
				function loadDicom(path){
					 $object = "<object type=\"text/html\" id=\"dicom\" data=\"http://45.63.0.24/dwv/viewers/simplistic/index.php?input=http%3A%2F%2F45.63.0.24%2F"+path+"\" width=\"100%\" height=\"800px\" style=\"overflow:auto;border:3px ridge #ccc\"></object>";
					 $('.modal-body object').remove();
					 $('.modal-body').append($object);
				}
	</script>
	<div class="modal fade modal-fullscreen force-fullscreen" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-body">
		  <button type="button" class="close" data-dismiss="modal" style="color:white;opacity:0.8" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  </div>
		</div>
	  </div>
	</div>
<?php } 

else if($mode == "select"){ ?>
<?php echo validation_errors(); echo form_open('pacs/import',array('role'=>'form','class'=>'form-custom')); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4>Import a Test 
			<small color="black">
			#<?php echo $this->input->post('patient_id');?>, 
			<?php echo $this->input->post('patient_name');?>, 
			<?php echo $this->input->post('patient_age');?>, 
			<?php echo $this->input->post('patient_sex');?>, 
			<?php echo $this->input->post('study_modality');?>, 
			<?php echo date("d-M-Y, g:iA",strtotime($this->input->post('study_datetime')));?>
			</small>
		</h4>
	</div>
	<div class="panel-body">
		<div class="col-md-12">
			<div class="col-md-6">
			<select class="form-control" id="visit_type" style="width:100px" name="patient_type">
				<option value=\" disabled>Select Patient Type</option>
				<option value="OP">OP</option>
				<option value="IP" selected>IP</option>
			</select>
			<select class="form-control" id="year" style="width:100px"  name="year">
				<option value=\" disabled>Select Admission Year</option>
				<option value="<?php echo date("Y",strtotime("Last Year"));?>"><?php echo date("Y",strtotime("Last Year"));?></option>
				<option value="<?php echo date("Y");?>" selected><?php echo date("Y");?></option>
			</select>
			<font color='red'>*</font>
			</div>
			<div class="col-md-6">
			<select id="select-patient" class="repositories" placeholder="Select a Patient..." name="visit_id" required ></select>
			</div>
		</div>
		<div class='col-md-12 selected_patient'>
		</div>
		<hr>
		<?php
		$test_areas=array();	
	
		foreach($test_masters as $test_master){
			$test_areas[]=$test_master->test_area_id;
		}
		$test_areas=array_unique($test_areas);
		foreach($test_areas as $test_area){ 
		?>
		<div class="form-group test_areas col-md-12" id="test_area_<?php echo $test_area;?>">
		<?php 
		$test_methods=array();
		foreach($test_masters as $test_master){
			if($test_master->test_area_id == $test_area)
			$test_methods[]=[
				'test_method' => $test_master->test_method,
				'test_area_id' => $test_master->test_area_id
			];
		}
	
		$test_methods=array_unique($test_methods, SORT_REGULAR);
		
		foreach($test_methods as $test_method){ ?>
			<div class="col-md-12 test_method">
				<div class="alert well-sm alert-info"><b><?php echo $test_method['test_method'];?></b></div>
		<?php		
		if(!!$test_masters) { ?>
		<div class="col-md-12 well well-sm">Individual Tests</div>
		<?php 
			foreach($test_masters as $test_master){ 
				if($test_master->test_method == $test_method['test_method'] && $test_master->test_area_id == $test_method['test_area_id']) { ?>
				<div class="col-md-4 panel">
					<div class="radio">
						<label for="<?php echo $test_master->test_name;?>">
							<?php echo $test_master->test_name;?>
							<input class="radio form-control" type="radio" name="test_master" id="<?php echo $test_master->test_name;?>" value="<?php echo $test_master->test_master_id;?>" />
						</label>
						
					</div>
				</div>
			<?php
				}
			}
		}?>
		</div>		
		<?php } ?>
		</div>
		<?php } ?>
	</div>
	<div class="panel-footer">
		<div class="col-md-offset-4">	
		<label for="emergency"><input type="checkbox" id="emergency" name="emergency" value="1" class="form-control" />Emergency</label>
		<input type="text" class="sr-only" hidden name="patient_id" value="<?php echo $this->input->post('patient_id');?>" />
		<input type="text" class="sr-only" hidden name="patient_name" value="<?php echo $this->input->post('patient_name');?>" />
		<input type="text" class="sr-only" hidden name="study_modality" value="<?php echo $this->input->post('study_modality');?>" />
		<input type="text" class="sr-only" hidden name="study_datetime" value="<?php echo $this->input->post('study_datetime');?>" />
		<input type="text" class="sr-only" hidden name="filepath" value="<?php echo $this->input->post('filepath');?>" />
		<input type="text" class="sr-only" hidden name="study_id" value="<?php echo $this->input->post('select_test');?>" />
		<input type="text" class="sr-only" hidden name="test_area_id" value="<?php echo $test_master->test_area_id;?>" />
		</br><input class="form-control" id="submit" name="import_dicom" value="submit" type="hidden"/>
		<button class="btn btn-lg btn-primary" type="submit" value="submit" name="ta_add">Import</button>
		</div>
	</div>
</div>
<?php
}
?>

	
	

</div>




<script>
		var $year=$("#year").val();
		var $visit_type=$("#visit_type").val();
	$(function(){
		$("#visit_type").change(function(){
			$visit_type=$(this).val();
			selectize = $("#select-patient")[0].selectize;
			selectize.clear();
			selectize.clearOptions();
			selectize.clearCache();
			selectize.renderCache={};
		});
		$("#year").change(function(){
			$year=$(this).val();
			selectize = $("#select-patient")[0].selectize;
			selectize.clear();
			selectize.clearOptions();
			selectize.clearCache();
			selectize.renderCache={};
		});
		selectize = $("#select-patient")[0].selectize;
		selectize.on('change',function(){
			var test = selectize.getOption(selectize.getValue());
			test.find('.hosp_file_no').text()!=""?$(".selected_patient").text(test.find('.hosp_file_no').text()+", "+test.find('.language').text()+", Age : "+test.find('.watchers').text()):$(".selected_patient").text("").removeClass('well well-sm');
			$(".selected_patient").text()!=""?$(".selected_patient").addClass('well well-sm') : $(".selected_patient").removeClass('well well-sm');
		});
	});
	$('#select-patient').selectize({
    valueField: 'hosp_file_no',
    labelField: 'hosp_file_no',
    searchField: 'hosp_file_no',
    create: false,
    render: {
        option: function(item, escape) {

            return '<div>' +
                '<span class="title">' +
                    '<span class="hosp_file_no">' + escape(item.hosp_file_no) + '</span>' +
                '</span>' +
                '<ul class="meta">' +
                    (item.first_name ? '<li class="language">' + escape(item.first_name) + ' ' : '') +
                    (item.last_name ? '' + escape(item.last_name) + '</li>' : '') +
                    '<li class="watchers"><span>' + escape(item.age_years) + '</span> yrs<span>' + 
					(item.age_months!=0 ? escape(item.age_months) + '</span> months<span>' : '') + 
					(item.age_days!=0 ? escape(item.age_days) + '</span> days</li>' : '') +
                '</ul>' +
            '</div>';
        }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
		$.ajax({
            url: '<?php echo base_url();?>diagnostics/search_patients',
            type: 'POST',
			dataType : 'json',
			data : {visit_type:$visit_type,year:$year,query:query},
            error: function(res) {
                callback();
            },
            success: function(res) {
                callback(res.patients.slice(0, 10));
            }
        });
    }
	});
</script>