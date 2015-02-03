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
		<input type="text" placeholder="Patient Name" name="patient_name" /><br />
		<input type="text" placeholder="IP Number" size="8" name="ip_no" /><br />
		<input type="text" placeholder="Ward / Unit" size="15" name="ward_unit" /><br />
		<select name="patient_blood_group">
		<option value="" disabled selected>Patient Blood Group</option>
		<option value="A+">A+</option>
		<option value="B+">B+</option>
		<option value="O+">O+</option>
		<option value="AB+">AB+</option>
		<option value="A-">A-</option>
		<option value="B-">B-</option>
		<option value="O-">O-</option>
		<option value="AB-">AB-</option>
		</select><br />	
	</div>

	</div>
	<br />
	<?php include "med_counselling_table.php"; ?>
	<div style="text-align:center;">
	<input type="submit" value="Submit" id="submit" name="submit" />
	</div>
	</form>
</div>
