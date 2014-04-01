<!--<html>
<body>
<center style="font-size:24px;font-family:Tahoma"><u>Item Type</u>
	<br>
	<br>
<?php echo validation_errors();   echo form_open('home/item_type');?>
<table ><tr><td>Item type<font color="red" style="font-size:15px;">* </font></td><td><input type="text" name="item_type"></td></tr>




<tr><td></td><td><input type="submit" name="submit" value="insert"></td></tr></table</center>
</body>
</html>-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
    $("#date").Zebra_DatePicker({
        direction:false
    });
});
</script>
<?php echo validation_errors(); ?>
<div class="col-md-8 col-md-offset-2">
    <center>    <strong><?php if(isset($msg)){ echo $msg;}?></strong>
 <h3><u>ADD ITEM TYPE</u></h3></center><br>
    <?php echo form_open('projects/item_type',array('role'=>'form')); ?>
    <div class="form-group">
        <label for="grant_name" class="col-md-4">Item Type<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="item type name" name" id="grant_name" name="item_type" />
        </div>
    </div>

  
       <div class="col-md-3 col-md-offset-4"> 
    <button class="btn btn-lg btn-primary btn-block" value="submit" type="submit">Submit</button>
    </div>
</div>