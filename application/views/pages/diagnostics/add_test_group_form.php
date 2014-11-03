<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script>
 $(function(){
  var i=2;
  	$(":checked").attr('checked',false);

    $("#b_test_name").click(function(){
        var test_name="<div id='add_test_name_"+i+"' ><div class='col-md-10'></br>";
        test_name+="<select form='add_test_group' name='test_name[]' id='test_name' class='form-control'>";
		test_name+="<option value=''>Test Name</option>";
		test_name+="<?php foreach($test_names as $d){ echo "<option value='$d->test_master_id'>$d->test_name</option>";}?>";
		test_name+="</select></div><div class='col-md-2'></br>";
        test_name+="<input type='button' class='btn btn-danger btn-sm' value='X' onclick='remove_test_name("+i+")' /></div></div>";
		console.log(test_name);
        $("#add_test_name").append(test_name);
        i++;
    });
	
    $("#binary_output").click(function(){
		if($(this).is(":checked")) { 
			$(".binary_output_labels").show();
			$(".binary_output_labels").find("input").attr('required',true);
		}
		else {
			$(".binary_output_labels").hide();
			$(".binary_output_labels").find("input").attr('required',false);
		}
	});
    
    $("#numeric_output").click(function(){
		if($(this).is(":checked")) { 
			$(".numeric_output_units").show();
			$(".numeric_output_range").show();
			$(".numeric_output_units").find("select").attr('required',true);
		}
		else {
			$(".numeric_output_units").hide();
			$(".numeric_output_units").find("select").attr('required',false);
		}
	});
});
function remove_test_name(i){
        $("#add_test_name_"+i).remove();
}
</script>
<div class="col-md-8 col-md-offset-2">
	<center>
		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
		<h3>Add Test Group</h3>
	</center><br>
	<center>
		<?php  echo validation_errors(); echo form_open('diagnostics/add/test_group',array('role'=>'form')); ?>
	</center>
	
	<div class="form-group">
		<label for="test_group" class="col-md-4">Test Group<font color='red'>*</font></label>
		<div  class="col-md-8">
			<input type="text" class="form-control" placeholder="Test Group" id="group_name" name="group_name" />
		</div>
		</br>		</br>
	

		<label for="test_name" class="col-md-4">Test Name<font color='red'>*</font></label>
		<div  class="col-md-8" id="add_test_name">
		<select form="add_test_group" name="test_name[]" id="test_name" class="form-control" form="add_test_name" style="width:250px">
		<option value="">Test Name</option>
		<?php foreach($test_names as $d){
			echo "<option value='$d->test_master_id'>$d->test_name</option>";
		}
		?>
		</select>
		<input type='button' id='b_test_name' value='Add' />
		</div>
		
		<label for="output_format" class="col-md-4">Output Format<font color='red'>*</font></label>
		<div  class="col-md-8 output_format" id="add_output_format" >
			<input type="checkbox" id="binary_output" form="add_test_name" value="1" name="output_format[]" />
			<label for="binary_output">Binary</label>
			<input type="checkbox" id="numeric_output" form="add_test_name" value="2" name="output_format[]" />
			<label for="numeric_output">Numeric</label>
			<input type="checkbox" id="text_output" form="add_test_name" value="3" name="output_format[]" />
			<label for="text_output">Text</label>
		</div>
		<br />
		<br />

		<label for="binary_output_labels" class="col-md-4 binary_output_labels" hidden>Binary Labels<font color='red'>*</font></label>
		<div  class="col-md-8 binary_output_labels" id="binary_output_labels"  hidden>
			<input type="text" class="form-control binary_output" placeholder="Binary Positive Label" id="binary_pos" form="add_test_name" name="binary_pos" />
			<input type="text" class="form-control binary_output" placeholder="Binary Negative Label" id="binary_neg" form="add_test_name" name="binary_neg" />			
		
		<br />
		</div>

		<label for="numeric_output_units" class="col-md-4 numeric_output_units" hidden>Numeric output units<font color='red'>*</font></label>
		<div  class="col-md-8 numeric_output_units" id="numeric_output_units"  hidden>
			<select name="numeric_result_unit" class="form-control">
				<option value="" selected disabled>Select</option>
				<?php foreach($lab_units as $unit){ ?>
					<option value="<?php echo $unit->lab_unit_id;?>"><?php echo $unit->lab_unit;?></option>
				<?php } ?>
			</select>
		</div>
		<label for="numeric_output_range" class="col-md-4 numeric_output_range" hidden>Numeric output Range</label>
		<div  class="col-md-8 numeric_output_range" id="numeric_output_range"  hidden>
			<input type="text" class="form-control numeric-range-min" placeholder="Minimum" />
			<input type="text" class="form-control numeric-range-max" placeholder="Maximum" />
		</div>
	
	</div>
   	<div class="col-md-3 col-md-offset-4">
	</br>
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit" name="tm_add">Submit</button>
	</div>
</div>
