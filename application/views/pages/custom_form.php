<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<style>
.mandatory{
	color:red;
	cursor:default;
	font-size:25px;
	font-weight:bold;
}
.form-field{
	min-height:50px;
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#dob").Zebra_DatePicker({
		view:"years",
		direction:false,
		onSelect: function(rdate,ydate,date){
				getAge(date);
		}
	});
	$("#date").Zebra_DatePicker({
		direction:false
	});
	$("#spouse").prop('disabled',true);
	$(".gender").change(function(){
		if($(this).val()=="M"){
			$("#spouse").prop('disabled',true);
		}
		else{
			$("#spouse").prop('disabled',false);
		}
	});
});
function DaysInMonth(Y, M) {
    	with (new Date(Y, M, 1, 12)) {
        setDate(0);
        return getDate();
	} 
}	
	
function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    var d = today.getDate() - birthDate.getDate();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--; m += 12;
	}
	if (d < 0) {
        m--;
        d += DaysInMonth(age, m);
    	}
   document.getElementById("age_years").value=age;
   document.getElementById("age_months").value=m;
   document.getElementById("age_days").value=d;
}
<!-- Scripts for printing output table -->
function printDiv(i)
{
var content = document.getElementById(i);
var pri = document.getElementById("ifmcontentstoprint").contentWindow;
pri.document.open();
pri.document.write(content.innerHTML);
pri.document.close();
pri.focus();
pri.print();
}
</script>

<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute;display:none"></iframe>
		<?php if(isset($registered)){ ?>
		<div class="row">
			<div class="panel panel-success col-md-4 col-md-offset-5" >
				<div class="panel-heading">Inserted Successfully</div>
				<div class="panel-body">
					<table class="table">
						<tr>
							<td>Patient ID</td>
							<td><?php echo $registered->patient_id;?></td>
						</tr>
						<tr>
							<td>Visit ID</td>
							<td><?php echo $registered->visit_id;?></td>
						</tr>
						<tr>
							<td>Patient Name</td>
							<td><?php echo $registered->name;?></td>
						</tr>
						<tr>
							<td>Age</td>
							<td><?php echo $registered->age_years;?></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td><?php echo $registered->gender;?></td>
						</tr>
					</table>
				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-primary col-md-offset-5"> Print</button>
				</div>
			</div>
			</div>
		<?php } ?>
		<?php echo validation_errors(); ?>
		<?php echo form_open("register/custom_form/$form_id",array('role'=>'form','class'=>'form-custom')); ?>
		<input type="text" class="sr-only" value="<?php echo $form_type;?>" name="form_type" />
		<div class="row">
		<div class="panel panel-default">
		<div class="panel-heading">
			<div class="pull-right">
				<div class="form-group">
				<label class="control-label">Date</label>
				<input type="text" name="date" class="form-control" value="<?php echo date("d-M-Y");?>" required />
				</div>
				<div class="form-group">
				<label class="control-label">Time</label>
				<input type="text" name="time" class="form-control" value="<?php echo date("h:ia");?>"  required />
				</div>
			</div>
			<h4><?php echo $form_name; ?></h4>
		</div>
		<div class="panel-body">
		<?php 
			if($columns==1){ $class="col-md-12";}
			else if($columns==2){$class="col-md-6";}
			else if($columns==3){$class="col-md-4";}
			$class.=" form-field";
		?>
			<?php
			foreach($fields as $field=>$mandatory){
				if($field=="patient_name"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Patient Name<?php if($mandatory) { ?><span class="mandatory">*</span><?php } ?></label>
						<input type="text" name="patient_name" class="form-control" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
				}
				else if($field=="age"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Age<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="age" class="form-control" size="2" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
				}
				else if($field=="gender"){ ?>
					<div class="<?php echo $class;?>">
						<div class="radio">
						<label class="control-label"><input type="radio" value="M" name="gender" <?php if($mandatory) echo "required"; ?> />Male</label>
						<label class="control-label"><input type="radio" value="F" name="gender" <?php if($mandatory) echo "required"; ?> />Female</label>
						<label class="control-label"><input type="radio" value="O" name="gender" <?php if($mandatory) echo "required"; ?> />Others</label>
						<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?>
						</div>
					</div>
				<?php 
				}
				else if($field=="address"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Address<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="address" class="form-control" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
				}
				else if($field=="place"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Place<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="place" class="form-control" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
				}
				else if($field=="district"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">District<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<select name="district" class="form-control" <?php if($mandatory) echo "required"; ?>>
						<option value="">--Select--</option>
						<?php 
						foreach($districts as $district){
							echo "<option value='".$district->district_id."'>".$district->district."</option>";
						}
						?>
						</select>
						</div>
					</div>
				<?php 
				}
				else if($field=="phone"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Phone<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="phone" class="form-control" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
				}
				else if($field=="father_name"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Father's Name<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="father_name" class="form-control" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
				}
				else if($field=="mother_name"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Mother's Name<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="mother_name" class="form-control" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
				}
				else if($field=="spouse_name"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Spouse Name<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<input type="text" name="spouse_name" class="form-control" <?php if($mandatory) echo "required"; ?> />
						</div>
					</div>
				<?php 
				}
				else if($field=="department"){ ?>
					<div class="<?php echo $class;?>">
						<div class="form-group">
						<label class="control-label">Department<?php if($mandatory) { ?><span class="mandatory" >*</span><?php } ?></label>
						<select name="department" class="form-control"  <?php if($mandatory) echo "required"; ?> >
						<option value="">--Select--</option>
						<?php 
						foreach($departments as $department){
							echo "<option value='".$department->department_id."'>".$department->department."</option>";
						}
						?>
						</select>
						</div>
					</div>
				<?php 
				}
			}
			?>
			</div>
			<div class="panel-footer">
				<button class="btn btn-primary btn-lg col-md-offset-5">Submit</button>
			</div>
			</div>
		</div>
		</form>	
	</section>