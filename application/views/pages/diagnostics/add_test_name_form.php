<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
 <script>
 $(function(){
	$(":checked").attr('checked',false);
  var i=2;
    $("#b_test_name").click(function(){
        var test_name="<div id='add_test_name_"+i+"' ><div class='col-md-10'></br>";
        test_name+="<input type='text' name='test_name[]' form='add_test_name' class='form-control' size='2' /></div><div class='col-md-2'></br>";
        test_name+="<input type='button' class='btn btn-danger btn-sm' value='X' onclick='remove_test_name("+i+")' /></div></div>";
        $(".test_name").append(test_name);
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
</script>
<div class="col-md-8 col-md-offset-2">
	<center>
		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
		<h3>Add Test Name </h3>
	</center><br>
	<center>
		<?php  echo validation_errors(); echo form_open('diagnostics/add/test_name',array('role'=>'form','class'=>'form-custom','id'=>'add_test_name')); ?>
	</center>
	
	<div class="form-group">
		<label for="test_method" class="col-md-4">Test Method<font color='red'>*</font></label>
		<div  class="col-md-8">
		<select name="test_method" id="test_method" class="form-control">
		<?php foreach($test_methods as $d){
			echo "<option value='$d->test_method_id'>$d->test_method</option>";
		}
		?>
		</select>
		</div>
		<br />
		<br />
		<label for="test_area" class="col-md-4">Test Area<font color='red'>*</font></label>
		<div  class="col-md-8">
		<select name="test_area" id="test_area" class="form-control">
		<?php foreach($test_areas as $d){
			echo "<option value='$d->test_area_id'>$d->test_area</option>";
		}
		?>
		</select>
		</div>
		<br />
		<br />

		<label for="test_name" class="col-md-4">Test Name<font color='red'>*</font></label>
		<div  class="col-md-8 test_name" id="add_test_name" >
			<input type="text" class="form-control" placeholder="Test Name" id="test_name" form="add_test_name" name="test_name" required />
			<input type="text" class="form-control" placeholder="Note" id="test_note" form="add_test_note" name="test_note" />
		</div>
		<br />
		<br />

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
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit" name="test_name_add">Submit</button>
	</div>
</div>
