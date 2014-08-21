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
		$(".datepicker").Zebra_DatePicker({
			direction:1
				});
		$(".time").timeEntry();
		$("#addbutton").click(function(){
			var from_time="<td><input class='time' name='from_time[]' size='6' /></td>";
			var to_time="<td><input class='time' name='to_time[]' size='6' /></td>";
			var max_app="<td><input type='number' name='max_app[]' size='2' maxlength='3' /></td>";
			var remove="<td><input type='button' value='X' onclick='$(\"#slot_row_"+rowcount+"\").remove();' /></td>";
			$("#slot_table").append("<tr id='slot_row_"+rowcount+"'>"+from_time+to_time+max_app+remove+"</tr>");
			$(".time").timeEntry();
			rowcount++;

		});
	});
</script>

<div class="col-md-10 col-sm-9">
	<?php 
	if(isset($msg)) {
		echo $msg;
		echo "<br />";
		echo "<br />";
	}
	?>
	<h1>Create Slots for Blood Donation</h1>
	<?php echo validation_errors(); ?>
	<?php echo form_open("create_slots"); ?>
	<hr>
	<b>Select a period: </b>
	<br /><label for="from_date">From Date: </label>
	<input type="text" class="datepicker" id="from_date" name="from_date" required />
	
	<label for="to_date">To Date: </label>
	<input type="text" class="datepicker" id="to_date" name="to_date" required />
	<br />
	<hr>
	<b>Select slots for each day: </b>
	<table style="width:700px;text-align:center;border:1px solid #ccc;background:#f6f6f6;border-spacing:10px;"  id="slot_table">
		<tr>
			<th>From Time</th>
			<th>To Time</th>
			<th>Max Appointments</th>
			<th></th>
		</tr>
		<tr>
			<td>
			<input type="text" class="time" name="from_time[]" size="6" required />
			</td>
			<td><input type="text" class="time" name="to_time[]" size="6" required  /></td>
			<td><input type="number" class="number" name="max_app[]" size="2" maxlength="3" required /></td>
			<td><input type="button" id="addbutton" value="Add+" /></td>
		</tr>
	</table>
	<br />
	<hr>
	<b>Select working days: </b>
	<br />
	<div style="text-align:center;">
		<?php
		$days = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
		for($i=0;$i<7;$i++){
		echo "<input type='checkbox' value='$i' id='day$i' name='days[]' />
			<label for='day$i'>$days[$i]</label>";
		}
		?>
	</div>
	<hr>
	<div style="text-align:center;"><input type="submit" value="Submit" name="create_slots" /></div>
	</form>
</div>
