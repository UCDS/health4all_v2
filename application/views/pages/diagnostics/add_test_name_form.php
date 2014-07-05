<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
 <script>
 $(function(){
  var i=2;
    $("#b_test_name").click(function(){
        var test_name="<div id='add_test_name_"+i+"' ><div class='col-md-10'></br>";
        test_name+="<input type='text' name='test_name[]' form='add_test_name' class='form-control' size='2' /></div><div class='col-md-2'></br>";
        test_name+="<input type='button' class='btn btn-danger btn-sm' value='X' onclick='remove_test_name("+i+")' /></div></div>";
        $(".test_name").append(test_name);
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
		<h3>Add Test Name </h3>
	</center><br>
	<center>
		<?php  echo validation_errors(); echo form_open('diagnostics/add/test_name',array('role'=>'form','class'=>'form-custom','id'=>'add_test_name')); ?>
	</center>
	
	<div class="form-group">
		<label for="test_method" class="col-md-4">Test Method<font color='red'>*</font></label>
		<div  class="col-md-8">
		<select name="test_method" id="test_method" class="form-control">
		<option value="">Test Method</option>
		<?php foreach($test_methods as $d){
			echo "<option value='$d->test_method_id'>$d->test_method</option>";
		}
		?>
		</select>
		</div>
		</br>		</br>
		</br>

		<label for="test_name" class="col-md-4">Test Name<font color='red'>*</font></label>
		<div  class="col-md-8 test_name" id="add_test_name" >
			<input type="text" class="form-control" placeholder="Test Name" id="test_name" form="add_test_name" name="test_name[]" /></br><input type='button' id='b_test_name' value='Add' />
		</div>
	
	</div>
   	<div class="col-md-3 col-md-offset-4">
	</br>
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit" name="test_name_add">Submit</button>
	</div>
</div>
