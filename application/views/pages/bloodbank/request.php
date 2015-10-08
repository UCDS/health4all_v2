<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
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
		</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.selectize.js"></script>
 <script>
	$(function(){
		var i=2;
		$("#add_blood_group").click(function(){
			var row='<tr class="bulk" id="row_'+i+'"><td><select name="blood_group[]" ><option value="" disabled selected>Select</option><option value="A+">A+</option><option value="B+">B+</option><option value="O+">O+</option><option value="AB+">AB+</option><option value="A-">A-</option><option value="B-">B-</option><option value="O-">O-</option><option value="AB-">AB-</option></select></td>';
			row+='<td><input type="text" name="whole_blood_units[]" size="3" /></td><td><input type="text" name="packed_cell_units" size="3" /></td>';
			row+='<td><input type="text" name="fp_units[]" size="3" /></td>';
			row+='<td><input type="text" name="ffp_units[]" size="3" /></td>';
			row+='<td><input type="text" name="prp_units[]" size="3" /></td>';
			row+='<td><input type="text" name="platelet_concentrate_units[]" size="3" /></td>';
			row+='<td><input type="text" name="cryoprecipitate_units[]" size="3" /></td>';
			row+='<td><input type="button" value="X" id="delete_blood_group" onclick="delete_row('+i+')" class="bulk" />';
			row+='</td>';
			row+='</tr>';
			$(".required_blood").append(row);
			i++;
		});
		$(".bulk").hide();
		$("#patient").click(function(){
			$("tr.bulk").remove();
			$(".bulk").hide();
			$(".patient").show();
		});
		$("#bulk").click(function(){
			$(".patient").hide();
			$(".bulk").show();
		});
		$("#request_date").Zebra_DatePicker();
		$("#patient_type").change(function(){
			if($(this).val()=="External"){
				$("#select-patient").attr("name","");
				$(".select-patient").addClass('sr-only');
				$(".enter-patient input").attr("name","hosp_file_no");
				$(".enter-patient input").attr("form","request_form");
				$(".enter-patient").removeClass('sr-only');
			}
			else{
				$(".enter-patient input").attr("name","")
				$(".enter-patient").addClass('sr-only');
				$("#select-patient").attr("name","hosp_file_no");
				$("#select-patient").attr("form","request_form");
				$(".select-patient").removeClass('sr-only');
			}
		});
	});
	function delete_row(i){
		$("#row_"+i).remove();
	}
</script>
<div class="col-md-10 col-sm-9 header-shadow">
	<?php
	if(isset($msg)) {
		if($msg='success'){
		echo "<div class='alert alert-info'>Your request has been submitted.</div>";
		echo "<br />";
		}
		else{
		echo "<div class='alert alert-danger'>There was an error in registering your request. Please retry.</div>";
		echo "<br />";
		}
	}
	?>
	<div>
		<?php echo form_open('bloodbank/register/request',array('role'=>'form','class'=>'form-custom','id'=>'request_form'));
		if(validation_errors()) echo "<div class='alert alert-info'>".validation_errors()."</div>";?>
		<h4>Request Form</h4>
		<table class="table table-striped table-bordered">
			<tr><td>Request Type : </td>
			<td>
					<label><input type="radio" value="0" name="request_type" id="patient" checked />Patient</label>
					<label><input type="radio" value="1" name="request_type" id="bulk" />Bulk</label>
			</td>
			</tr>
			<tr class="patient">
				<td> Patient Type : </td>
				<td>
				<div class="col-md-12">
					<div class="col-md-12">
						<select class="form-control" id="patient_type" name="patient_type">
							<option value="" disabled>Select Patient Type</option>
							<option value="Internal" selected>Internal</option>
							<option value="External">External</option>
						</select>
						<font color='red'>*</font>
					</div>
				</div>
				</td>
			</tr>
			<tr class="patient">
				<td> Patient : </td>
				<td>
				<div class="col-md-12">
					<div class="col-md-12">
					<select class="form-control" id="visit_type" name="visit_type">
						<option value="" disabled>Select Patient Type</option>
						<option value="OP">OP</option>
						<option value="IP" selected>IP</option>
					</select>
					<select class="form-control" id="year"  name="year">
						<option value="" disabled>Select Admission Year</option>
						<option value="<?php echo date("Y",strtotime("Last Year"));?>"><?php echo date("Y",strtotime("Last Year"));?></option>
						<option value="<?php echo date("Y");?>" selected><?php echo date("Y");?></option>
					</select>
					<font color='red'>*</font>
					</div>
					<div class="col-md-6 select-patient">
						<select id="select-patient" class="repositories" placeholder="Select a Patient..." name="hosp_file_no" ></select>
					</div>
					<div class="col-md-8 sr-only enter-patient">
						<input class="form-control" placeholder="Enter Patient IP Number" size="50px" />
					</div>
				</div>
				<div class='col-md-12 selected_patient'>
				</div>
				
				</td>
				
			</tr>
			<tr class="doctor">
			
			<td>Doctor</td>
			<td>
					 <div class="col-md-6">
                <select id="select_doctor" class="repositories" placeholder="Select a Doctor..." name="staff_id" required ></select>
            </div>
            <div class="col-md-8 sr-only enter-patient">
						<input class="form-control" placeholder="Enter Doctor Name" size="50px" />
					</div>
		    <div class='col-md-10 selected_doctor'>
		    </div>
				</td>
			</tr>
			<tr>
			<td>Required : </td>
			<td>
			<table class='required_blood'>
				<tr>
					<th>Blood Group</th>
					<th>Whole Blood</th>
					<th>Packed Cells</th>
					<th>Frozen Plasma</th>
					<th>Fresh Frozen Plasma</th>
					<th>Platelet Rich Plasma</th>
					<th>Platelet Concentrate</th>
					<th>Cryoprecipitate</th>
					<td></td>
				</tr>
				<tr>
					<td><select name="blood_group[]" required >
						<option value="" disabled selected>Select</option>
						<option value="A+">A+</option>
						<option value="B+">B+</option>
						<option value="O+">O+</option>
						<option value="AB+">AB+</option>
						<option value="A-">A-</option>
						<option value="B-">B-</option>
						<option value="O-">O-</option>
						<option value="AB-">AB-</option>
						</select>
					</td>
					<td><input type="text" name="whole_blood_units[]" size="3" /></td>
					<td><input type="text" name="packed_cell_units[]" size="3" /></td>
					<td><input type="text" name="fp_units[]" size="3" /></td>
					<td><input type="text" name="ffp_units[]" size="3" /></td>
					<td><input type="text" name="prp_units[]" size="3" /></td>
					<td><input type="text" name="platelet_concentrate_units[]" size="3" /></td>
					<td><input type="text" name="cryoprecipitate_units[]" size="3" /></td>
					<td>			
						<input type="button" value="+" id="add_blood_group" class="bulk" />
					</td>
				</tr>
			</table>
			</td>
			</tr>
			<tr><td> Request Date : </td><td><input type="text" name="request_date" id="request_date" required /></td>
			<tr><td colspan="2" align="center"><input type="submit" value="Submit" /> </td></tr>
		</table>
		</form>	
	</div>
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

<script>
    
    $(function(){
		selectize = $("#select_doctor")[0].selectize;
		selectize.on('change',function(){
			var test = selectize.getOption(selectize.getValue());
			test.find('.staff_id').text()!=""?$(".selected_doctor").text(test.find('.language').text()+", "+test.find('.staff_id').text()) :  $(".selected_doctor").text("").removeClass('well well-sm');
			$(".selected_doctor").text()!=""?$(".selected_doctor").addClass('well well-sm') : $(".selected_doctor").removeClass('well well-sm');
            
		});
	});

    $('#select_doctor').selectize({
    valueField: 'staff_id',
    labelField: 'first_name',
    searchField: 'first_name',
    create: false,
    render: {
        option: function(item, escape) {

            return '<div>' +                
                '<ul class="meta">' +
                    (item.first_name ? '<li class="language">' + escape(item.first_name) + ' ' : '') +
                    (item.last_name ? '' + escape(item.last_name) + '</li>' : '') +                    
                '</ul>' +
                '<span class="title">' +
                    '<span class="doctor_reg_no">' + escape(item.doctor_reg_no) + '</span>' +
                '</span>' +
            '</div>';
        }
    },
    load: function(query, callback) {
        if (!query.length) return callback();
		$.ajax({
            url: '<?php echo base_url();?>staff/search_doctor',
            type: 'POST',            
			dataType : 'json',
            data : {query:query},			
            error: function(res) {
                callback();
            },
            success: function(res) {
                callback(res.doctors.slice(0, 10));
            }
        });
    }
	});
    </script>