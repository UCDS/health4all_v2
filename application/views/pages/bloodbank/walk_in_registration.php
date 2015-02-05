<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/jquery.mousewheel.js"></script>
<script>
	$(function(){
		var rowcount=1;
		$("#date").Zebra_DatePicker({
			direction:false
				});
		$("#dob").Zebra_DatePicker({
			view:"years",
			direction:'-6570',
			onSelect: function(rdate,ydate,date){
				var year=date.getYear("Y");
				var current_year=new Date().getYear();
				var age=current_year-year;
				$("#age").val(age);
				}
		});
		$(".time").timeEntry();
		$("#replacement").click(function(){
			$("#patient_details").show();
		});
		$("#voluntary").click(function(){
			$("#patient_details").hide();
		});
		$("#blood_bank").click(function(){
			$("#camps").hide();
		});
		$("#camp").click(function(){
			$("#camps").show();
		});
		$("#male").click(function(){
			$("#women").hide();
		});
		$("#female").click(function(){
			$("#women").show();
		});
		$flags=[];
			$(".medical_no,.medical_yes").each(function(){
				$(this).on('change',function(){
				if($(this).hasClass('medical_no')){
					if($.inArray($flags,$(this).attr('id').replace('no',''))!== -1){
						console.log("found");
					}
					else{
						$flags.push($(this).attr('id').replace('no',''));
					}
					console.log($flags[1]);
				}
				if($(this).hasClass('medical_yes')){
					$flags.push($(this).attr('id').replace('yes',''));
					console.log($flags[0]);
				}
				});
			});
	});
</script>

<div class="col-md-10 col-sm-9">
	<div style="color:red;padding:5px;font-size:14px;">
	<?php echo validation_errors(); ?></div>
	<?php 
	if(isset($msg)) {
		echo $msg;
		echo "<br />";
		echo "<br />";
	}
	?>

	<div class="panel panel-default">
	<div class="panel-heading">
	<h4>Register Blood Donation</h4>
	</div>
	<div class="panel-body">
	<div class="text-right"><b><small>fields marked with * are mandatory.</small></b></div>
	<?php echo form_open("bloodbank/register",array('class'=>'form-custom')); ?>
	<label class="col-md-4" for="full name">Full Name<font color='red'>*</font></label>
	<div class="form-group col-md-8">
		<input type="text" placeholder="Full Name" class="form-control" id="name" name="name" required />
	</div><br />
	<label class="col-md-4" for="dob">DOB : </label>
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Date of Birth" class="form-control" id="dob" name="dob" />
	</div><br />
		<label class="col-md-4" for="age">Age  <font color='red'>*</font></label>
	<div class="form-group col-md-8"  style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Age" class="form-control" id="age" name="age" required />
	</div><br>
		<label class="col-md-4" for="gender">Gender  <font color='red'>*</font></label>
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="radio" name="gender" id="male" value="male" required /><label for="male">Male</label>&nbsp;&nbsp;
		<input type="radio" name="gender" id="female" value="female" required /><label for="female">Female</label>
	</div><br />
	<label class="col-md-4" for="maritulstatus">Marital Status</label>
	<div class="form-group col-md-8"  style="margin-top:5px;margin-bottom:5px;">
		<input type="radio" name="maritial_status" id="single" value="single" /><label for="single">Single</label>&nbsp;&nbsp;
		<input type="radio" name="maritial_status" id="married" value="married" /><label for="married">Married</label>
	</div><br />
	<label class="col-md-4" for="Parentorspousename">Parent (or) Spouse name :</label>
	<div class="form-group col-md-8"  style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Parent or Spouse Name" class="form-control" name="parent_spouse" /><br />
	</div><br />
	<label class="col-md-4">Occupation :</label>
	<div class="form-group col-md-8"  style="margin-top:5px;margin-bottom:5px;">
		<input type="text" name="occupation" placeholder="Occupation" class="form-control" id="occupation" /><br />
	</div><br>
	<label class=col-md-4	for="address">Address :</label>
	<div class="form-group col-md-8"  style="margin-top:5px;margin-bottom:5px;">
		<textarea placeholder="Address" cols="60" class="form-control" id="address" name="address" rows="4"></textarea><br />
	</div><br />
	<label class="col-md-4">Blood Group :</label>
	<div class="form-group col-md-8"  style="margin-top:5px;margin-bottom:5px;">
		<select class="form-control" name="blood_group">
			<option value="" disabled selected>Blood Group</option>
			<option value="A+">A+</option>
			<option value="B+">B+</option>
			<option value="O+">O+</option>
			<option value="AB+">AB+</option>
			<option value="A-">A-</option>
			<option value="B-">B-</option>
			<option value="O-">O-</option>
			<option value="AB-">AB-</option>
		</select>
	</div><br>
	<label class="col-md-4">Phone.no : </label>
	<div class="form-group col-md-8"  style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Phone Number" class="form-control" id="phone" name="mobile" />
	</div><br />
	<label class="col-md-4">Email Id : </label>
	<div class="form-group col-md-8"  style="margin-top:5px;margin-bottom:5px;">
		<input type="email" placeholder="Email" class="form-control" id="email" name="email" />
	</div><br />
	<label class="col-md-4">Documenation Type :</label>
	<div class="form-group col-md-8"  style="margin-top:5px;margin-bottom:5px;">
		<input type="radio" name="donation_type" id="replacement" value="replacement" required /><label for="replacement">Replacement</label>&nbsp;&nbsp;
		<input type="radio" name="donation_type" id="voluntary" value="voluntary" required />	<label for="voluntary">Voluntary</label>
	</div><br />
	<h1>Register Blood Donation</h1>
	<hr>
		<font size="2">fields marked with * are mandatory.</font>
	<hr>
	<div style="border:1px solid #ccc;padding:10px;">
	<?php echo form_open("bloodbank/register"); ?>
	<input type="text" placeholder="Full Name" size="20" id="name" name="name" required />*<br />
	<input type="text" placeholder="Date of Birth" size="12" id="dob" name="dob" /><br />
	<input type="text" placeholder="Age" size="8" id="age" name="age" required />*<br />
	Gender : <input type="radio" name="gender" id="male" value="male" required /><label for="male">Male</label>
	<input type="radio" name="gender" id="female" value="female" required /><label for="female">Female</label>*<br />
	Maritial Status : <input type="radio" name="maritial_status" id="single" value="single" /><label for="single">Single</label>
	<input type="radio" name="maritial_status" id="married" value="married" /><label for="married">Married</label><br />
	<input type="text" placeholder="Parent or Spouse Name" size="20" name="parent_spouse" /><br />
	<input type="text" name="occupation" placeholder="Occupation" size="20" id="occupation" /><br />
	<textarea placeholder="Address" cols="40" id="address" name="address" rows="4"></textarea><br />
	<select name="blood_group">
	<option value="" disabled selected>Blood Group</option>
	<option value="A+">A+</option>
	<option value="B+">B+</option>
	<option value="O+">O+</option>
	<option value="AB+">AB+</option>
	<option value="A-">A-</option>
	<option value="B-">B-</option>
	<option value="O-">O-</option>
	<option value="AB-">AB-</option>
	</select><br />
	<input type="text" placeholder="Phone Number" size="16" id="phone" name="mobile" /><br />
	<input type="email" placeholder="Email" size="24" id="email" name="email" /><br />
	<input type="radio" name="donation_type" id="replacement" value="replacement" required /><label for="replacement">Replacement</label>
	<input type="radio" name="donation_type" id="voluntary" value="voluntary" required /><label for="voluntary">Voluntary</label><br />

	<div id="patient_details" hidden>
		<div class="form-group"><input type="text" placeholder="Patient Name" class="form-control" name="patient_name" /></div><br /><br />
		<div class="form-group"><input type="text" placeholder="IP Number" class="form-control" name="ip_no" /></div><br /><br />
		<div class="form-group"><input type="text" placeholder="Ward / Unit" class="form-control" name="ward_unit" /></div><br /><br />
		<div class="form-group"><select name="patient_blood_group" class="form-control">
		<option value="" disabled selected>Patient Blood Group</option>
		<option value="A+">A+</option>
		<option value="B+">B+</option>
		<option value="O+">O+</option>
		<option value="AB+">AB+</option>
		<option value="A-">A-</option>
		<option value="B-">B-</option>
		<option value="O-">O-</option>
		<option value="AB-">AB-</option>
		</select></div><br />	
	</div>
	
	</div>
	<?php include "med_counselling_table.php"; ?>
	<div class="form-group" style="text-align:center;">
	<input type="submit" value="Submit" class="btn btn-lg btn-primary" id="submit" name="submit" />
	</div>
	</form>
</div>
