<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<div class="col-md-8 col-md-offset-2">
<center>
<strong><?php if(isset($msg)){ echo $msg;}?></strong>
<h3>Add Test Area</h3>
</center><br>
<center>
<?php echo validation_errors(); echo form_open('diagnostics/add/test_area',array('role'=>'form')); ?>
</center>
<div class="form-group">
<label for="test_area" class="col-md-4">Test Area<font color='red'>*</font></label>
<div class="col-md-8">
<input type="text" class="form-control" placeholder="Test Area" id="test_area" name="test_area" />
</div>
</div>
<div class="col-md-3 col-md-offset-4">
</br>
<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit" name="ta_add">Submit</button>
</div>
</div>