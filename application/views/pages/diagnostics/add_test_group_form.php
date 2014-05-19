<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
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
	
	</div>
   	<div class="col-md-3 col-md-offset-4">
	<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit" name="tm_add">Submit</button>
	</div>
</div>
