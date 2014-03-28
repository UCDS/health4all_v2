<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<?php echo validation_errors(); ?>
<div class="col-md-8 col-md-offset-2">
    <center> 		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
 <h3><u>ADD GENERIC DETAILS</u></h3></center><br>
    <?php echo form_open('projects/generic',array('role'=>'form')); ?>
    <div class="form-group">
        <label for="grant_name" class="col-md-4">Generic Name</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="generic name"  id="grant_name" name="generic_name" />
        </div>
    </div>
   < div class="form-group">
        <label for="division" class="col-md-4" >Item Type<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <select name="item_type" id="division" class="form-control">
        <option value="">--SELECT--</option>
        <?php foreach($item_type as $d){
            echo "<option value='$d->item_type_id'>$d->item_type</option>";
        }
        ?>
        </select>
        </div>
    
       <div class="col-md-3 col-md-offset-4"> 
    <button class="btn btn-lg btn-primary btn-block" value="submit" type="submit">Submit</button>
    </div>
</div></div></div>