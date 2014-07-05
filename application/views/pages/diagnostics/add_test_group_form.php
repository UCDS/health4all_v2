<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script>
 $(function(){
  var i=2;
    $("#b_test_name").click(function(){
        var test_name="<div id='add_test_name_"+i+"' ><div class='col-md-10'></br>";
        test_name+="<select form="add_test_group" name="test_name[]" id="test_name" class="form-control">;
		test_name+="<option value="">Test Name</option>";
		test_name+="<?php foreach($test_names as $d){ echo "<option value='$d->test_master_id'>$d->test_name</option>";}?>";
		test_name+="</select></div><div class='col-md-2'></br>";
        test_name+="<input type='button' class='btn btn-danger btn-sm' value='X' onclick='remove_test_name("+i+")' /></div></div>";
        $(".form-control").append(test_name);
        i++;
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
		</br>

		<label for="test_name" class="col-md-4">Test Name<font color='red'>*</font></label>
		<div  class="col-md-8" id="add_test_name">
		<select form="add_test_group" name="test_name[]" id="test_name" class="form-control">
		<option value="">Test Name</option>
		<?php foreach($test_names as $d){
			echo "<option value='$d->test_master_id'>$d->test_name</option>";
		}
		?>
		</select>
		</br><input type='button' id='b_test_name' value='Add' />
		</div>
	</div>
   	<div class="col-md-3 col-md-offset-4">
	</br>
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit" name="tm_add">Submit</button>
	</div>
</div>
