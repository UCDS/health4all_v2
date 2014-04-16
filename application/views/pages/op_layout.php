	<!-- Include scripts for jQuery Sortable -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.ui.core.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.ui.widget.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.ui.mouse.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.ui.sortable.min.js"></script> 
	<script>
	$(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
		$(".checklist").click(function(){
				$(".alert-info").hide();
			if($(this).is(":checked")){
				var id=$(this).attr('id');
				$("."+id).show();
			}
			else{
				var id=$(this).attr('id');
				$("."+id).hide();
			}
			//alert($("#new-form :visible,.mandatory").serialize())
		});
		$("#save-form").click(function(e){
			e.preventDefault();
			columns=$('input:radio[name=cols]:checked').val();
			form_name=$('input:text[name=form_name]').val();
			form_type=$('select[name=form_type]').val();

			fields={};
			fields['field_name']=[];
			fields['mandatory']=[];
			$(".layout-div:visible").each(function(){
				if($(this).find(".mandatory").is(":checked")){
					fields['mandatory'].push(1);
				}
				else{
					fields['mandatory'].push(0);
				}
				var cname=$(this).attr('class').replace(/col-md-[0-9]+/, "").replace(/layout-div/, "").trim();
				fields['field_name'].push(cname);
			});
			$.ajax({
				type:"POST",
				async:true,
				data : {form_name:form_name,columns:columns,form_type:form_type,fields:JSON.stringify(fields)},
				url : "<?php echo base_url()."user_panel/create_form"; ?>",
				success : function(returnData){
					if(returnData==1){
						$(".panel").parent().prepend("<div class='alert alert-success'>Form created successfully!</div>");
						$("#save-form").attr('disabled',true);
						window.setTimeout(function(){location.reload()},3000)
					}
					else{
						$(".panel").parent().prepend("<div class='alert alert-danger'>Oops! Some error occured! Please retry.</div>");
					}
				}
			});
		});
		$(".num_cols").click(function(){
			if($(this).val()==1){
				$(".form .layout-div").each(function(){
					$(this).removeClass("col-md-4").removeClass("col-md-6").addClass("col-md-12");
					$(this).css('width','100%');
				});
			}
			if($(this).val()==2){
				$(".layout-div").each(function(){
					$(this).removeClass("col-md-4").removeClass("col-md-12").addClass("col-md-6");
					$(this).css('width','50%');
				});
			}
			if($(this).val()==3){
				$(".form .layout-div").each(function(){
					$(this).removeClass("col-md-6").removeClass("col-md-12").addClass("col-md-4");
					$(this).css('width','33%');
				});
			}
		});
		$(".star").click(function(){
			if($(this).find(".mandatory").is(":checked")){
				$(this).find(".mandatory").prop('checked',false);
				$(this).css('color','#ccc');
			}
			else{
				$(this).find(".mandatory").prop('checked',true);
				$(this).css('color','red');
			}
				
		});
		
	});
  </script>

      <?php echo form_open('user_panel/op_layout',array('role'=>'form','class'=>'form-custom','id'=>'new-form')); ?>
			<div class="col-md-10" >
				<div class="panel panel-default">
				<div class="panel-heading">
				<div class="row">
					<div class="col-md-4">
						<label class="control-label">Select number of columns : </label>
						<div class="radio">
							<label class="control-label"><input type="radio" value="1" name="cols" class="num_cols" />1</label>
						</div>
						<div class="radio">
							<label class="control-label"><input type="radio" value="2" name="cols" class="num_cols" />2</label>
						</div>
						<div class="radio">
							<label class="control-label"><input type="radio" value="3" name="cols" class="num_cols" checked />3</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						<label class="control-label">Select form type</label>
						<select class="form-control" name="form_type" id="form-type">
							<option value="">Select</option>
							<option value="OP">OP</option>
							<option value="IP">IP</option>
						</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
						<label class="control-label">Form Name</label>
						<input type="text" name="form_name" class="form-control" />
						</div>
					</div>
				</div>
				</div>
				<div class="panel-body">
				<div class="alert alert-info">Select fields from the right menu to start creating the form! >></div>
				<div class="form row" id="sortable">
					<div class="layout-div col-md-4 patient_name ">
						<div class="form-group">
						<label class="control-label">Patient Name</label>
						<input type="text" name="patient_name" class="form-control" />
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					<div class="layout-div col-md-4 age">
						<div class="form-group">
						<label class="control-label">Age</label>
						<input type="text" name="age" class="form-control" size="1" />
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					<div class="layout-div col-md-4 gender">
						<div class="radio ">
						<label class="control-label">
							<input type="radio" name="gender" value="1" checked />Male
						</label>
						<label class="control-label">
							<input type="radio" name="gender" value="1" />Female
						</label>
						<label class="control-label">
							<input type="radio" name="gender" value="1" />Other
						</label>
						</div>					
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
					</div>

					<div class="layout-div col-md-4 address">
						<div class="form-group">
						<label class="control-label">Address</label>
						<input type="text" name="address" class="form-control" />
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					<div class="layout-div col-md-4 place">
						<div class="form-group">
						<label class="control-label">Place</label>
						<input type="text" name="place" class="form-control" />
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					<div class="layout-div col-md-4 district">
						<div class="form-group">
						<label class="control-label">District</label>
						<select name="district" class="form-control">
						<option value="">--Select--</option>
						<?php 
						foreach($districts as $district){
							echo "<option value='".$district->district_id."'>".$district->district."</option>";
						}
						?>
						</select>
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					<div class="layout-div col-md-4 phone">
						<div class="form-group">
						<label class="control-label">Phone</label>
						<input type="text" name="phone" class="form-control" />
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					<div class="layout-div col-md-4 father_name">
						<div class="form-group">
						<label class="control-label">Father Name</label>
						<input type="text" name="father_name" class="form-control" />
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					<div class="layout-div col-md-4 mother_name">
						<div class="form-group">
						<label class="control-label">Mother Name</label>
						<input type="text" name="mother_name" class="form-control" />
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					<div class="layout-div col-md-4 spouse_name">
						<div class="form-group">
						<label class="control-label">Spouse Name</label>
						<input type="text" name="spouse_name" class="form-control" />
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					<div class="layout-div col-md-4 department">
						<div class="form-group">
						<label class="control-label">Department</label>
						<select name="department" class="form-control">
						<option value="">--Select--</option>
						<?php 
						foreach($departments as $department){
							echo "<option value='".$department->department_id."'>".$department->department."</option>";
						}
						?>
						</select>	
						<span class="star" title="Click to toggle mandatory">*<input type="checkbox" value="1" class="mandatory" hidden /></span>
						</div>
					</div>
					</div>
				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-primary" id="save-form">Save</button>
				</div>
				</div>
				
			</div>
			<div class="col-sm-3 col-md-2 sidebar">
			<strong>Patient Information</strong>
			  <ul class="nav nav-sidebar">
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="patient_name" class="checklist" />Patient name</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="age" class="checklist" />Age</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="gender" class="checklist" />Gender</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="address" class="checklist" />Address</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="place" class="checklist" />Place</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="district" class="checklist" />District</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="phone" class="checklist" />Phone</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="father_name" class="checklist" />Father's Name</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="mother_name" class="checklist" />Mother's Name</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="spouse_name" class="checklist" />Spouse Name</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="id_proof" class="checklist" />ID Proof</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="occupation" class="checklist" />Occupation</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="education_level" class="checklist" />Education Level</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="education_qualification" class="checklist" />Education Qualification</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="blood_group" class="checklist" />Blood Group</label>
					</div>
				</li>
			</ul>
			<strong>Birth Information</strong>
			  <ul class="nav nav-sidebar">
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="gestation" class="checklist" />Gestation</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="gestation_type" class="checklist" />Gestation Type</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="delivery_mode" class="checklist" />Delivery Mode</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="delivery_place" class="checklist" />Delivery Place</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="delivery_location" class="checklist" />Delivery Location</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="hospital_type" class="checklist" />Hospital Type</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="delivery_location_type" class="checklist" />Delivery Location Type</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="delivery_plan" class="checklist" />Delivery Plan</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="birth_weight" class="checklist" />Birth Weight</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="congenial_anomalies" class="checklist" />Congenial Anomalies</label>
					</div>
				</li>     
			  </ul>
			<strong>Visit Information</strong>
			  <ul class="nav nav-sidebar">
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="hospital" class="checklist" />Hospital</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="department" class="checklist" />Department</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="unit" class="checklist" />Unit</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="area" class="checklist" />Area</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="doctor" class="checklist" />Doctor</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="nurse" class="checklist" />Nurse</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="insurance" class="checklist" />Insurance</label>
					</div>
				</li>
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="presenting_complaints" class="checklist" />Presenting Complaints</label>
					</div>
				</li>  
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="past_history" class="checklist" />Past History</label>
					</div>
				</li>  
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="admit_weight" class="checklist" />Admit Weight</label>
					</div>
				</li>  
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="pulse_rate" class="checklist" />Pulse Rate</label>
					</div>
				</li>  
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="respiratory_rate" class="checklist" />Respiratory Rate</label>
					</div>
				</li>  
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="temperature" class="checklist" />Temperature</label>
					</div>
				</li> 
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="blood_pressure" class="checklist" />Blood Pressure</label>
					</div>
				</li> 
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="provisional_diagnosis" class="checklist" />Provisional Diagnosis</label>
					</div>
				</li> 
				<li>  
					<div class="checkbox">
						<label><input type="checkbox" value="1" id="final_diagnosis" class="checklist" />Final Diagnosis</label>
					</div>
				</li> 
			</div>
      </form>

