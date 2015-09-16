<div class="col-md-8 col-md-offset-2">
	<center>
		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
		<h3>Add Item Type</h3></center><br>
		<?php echo validation_errors(); echo form_open('consumables/add/item_type',array('class'=>'form-horizontal','role'=>'form','id'=>'add_item_type')); ?>
	</center>
	<div class="form-group">
		<label for="item_type" class="col-md-4">Item Type<font color='red'>*</font></label>
		<div  class="col-md-8">
			<input type="text" class="form-control" placeholder="Item Type" id="item_type" name="item_type"  required />
		</div>
	</div>
   	<div class="col-md-3 col-md-offset-4">
		<button class="btn btn-lg btn-primary btn-block" type="submit" value="submit">Submit</button>
	</div>
</div>
