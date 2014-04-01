<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
    $("#date").Zebra_DatePicker({
        direction:false
    });
});
$(function(){
    $("#date1").Zebra_DatePicker({
        direction:false
    });
});

</script>
<?php echo validation_errors(); ?>
<div class="col-md-8 col-md-offset-2">
    <center> 		<strong><?php if(isset($msg)){ echo $msg;}?></strong>
 <h3><u>ADD ITEM DETAILS</u></h3></center><br>
    <?php echo form_open('projects/items',array('role'=>'form')); ?>
    <div class="form-group">
        
<div class="form-group">
        <label for="item_name" class="col-md-4"> Item Name<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Item Name"  id="grant_name" name="item_name" />
        </div>
    </div>


    <label for="division" class="col-md-4" >Generic Type Name<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <select name="generic_name" id="division" class="form-control">
        <option value="">Generic Item</option>
        <?php foreach($generic_name as $d){
            echo "<option value='$d->generic_type_id'>$d->generic_name</option>";
        }
        ?>
        </select>
        </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4"> Manufacture Vendor<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
       <select name="vendor_name" id="division" class="form-control">
        <option value="">Manfacturer Vendor</option>
        <?php foreach($vendor_name as $d){
            echo "<option value='$d->vendor_id'>$d->vendor_name</option>";
        }
        ?>
        </select>

        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4">Description</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Description "  id="grant_name" name="description" />
        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4">Model</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Model"  id="grant_name" name="model" />
        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4">Serial Number</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Serial Number"  id="grant_name"   name="serial_number" />
        </div>
    </div>

<div class="form-group">
        <label for="grant_name" class="col-md-4">Asset Number</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Asset Number"  id="grant_name"   name="asset_number" />
        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4"> Procured By</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Procured By"  id="grant_name"   name="procured_by" />
        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4"> Cost</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Cost"  id="grant_name"   name="cost" />
        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4">Supplier Vendor<font color="red" size="5">*</font></label>
         <div  class="col-md-8">
        <select name="vendor_name" id="division" class="form-control">
        <option value="">Vendor</option>
        <?php foreach($vendor_name as $d){
            echo "<option value='$d->vendor_id'>$d->vendor_name</option>";
        }
        ?>
        </select>
       
    </div></div>

<div class="form-group">
        <label for="grant_name" class="col-md-4"> Supply Date<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <input type="date" class="form-control" placeholder="Supply Date"  id="date"   name="supply_date" />
        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4"> Warrenty Period<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Warrenty Period"  id="grant_name"   name="warranty_period" />
        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4">  Expiry Date<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <input type="date" class="form-control" placeholder="Expiry Date"  id="date1"   name="expire_date" />
        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4"> Contact Person<font color="red" size="5">*</font></label>
         <div  class="col-md-8">
        <select name="contact_person_first_name" id="division" class="form-control">
        <option value="">Contact Person</option>
        <?php foreach($contact_person_first_name as $d){
            echo "<option value='$d->contact_person_id'>$d->contact_person_first_name</option>";
        }
        ?>
        </select>
       
    </div></div>

<div class="form-group">
        <label for="grant_name" class="col-md-4"> Hospitals<font color="red" size="5">*</font></label>
         <div  class="col-md-8">
        <select name="hospital_id" id="division" class="form-control">
        <option value="">Hospital</option>
        <option value="1"<?php echo set_select('hospital_id','Hospital 1'); ?>>Gandhi Hospital</option>
       <option value="2"<?php echo set_select('hospital_id','Hospital 2'); ?>>Osmania Hospital</option>
        
        </select>
       
    </div></div>

<!--<div class="form-group">
        <label for="grant_name" class="col-md-4">  Hospitals</label>
        <div  class="col-md-8">
        <select name="hospital_id" id="hospital">
<option value="">---Select---</option>
<option value="1"<?php echo set_select('hospital_id','Hospital 1'); ?>>Gandhi Hospital</option>
<option value="2"<?php echo set_select('hospital_id','Hospital 2'); ?>>Osmania Hospital</option>

</select>
        </div>
    </div>-->
<div class="form-group">
        <label for="grant_name" class="col-md-4">Department<font color="red" size="5">*</font></label>
         <div  class="col-md-8">
        <select name="department" id="division" class="form-control">
        <option value="">Department</option>
        <?php foreach($department as $d){
            echo "<option value='$d->department_id'>$d->department</option>";
        }
        ?>
        </select>
       
    </div></div>

<div class="form-group">
        <label for="grant_name" class="col-md-4">   Item Status</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="Item Status"  id="grant_name"   name="item_status" />
        </div>
    </div>
  <div class="form-group">
        <label for="grant_name" class="col-md-4">Batch Number<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="batch number"  id="grant_name" name="batch_number" />
        </div>
    </div>
    <div class="form-group">
        <label for="grant_name" class="col-md-4">Item Quantity</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="item quantity"  id="grant_name" name="item_quantity" />
        </div>
    </div>
    
<div class="form-group">
        <label for="grant_name" class="col-md-4">Form Name<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="form name"  id="grant_name" name="form_name" />
        </div>
    

    <div class="form-group">
        <label for="grant_name" class="col-md-4">Dosages Unit<font color="red" size="5">*</font> </label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="dosages unit" name" id="grant_name" name="dosage_unit" />
        </div>
    </div>
 <div class="form-group">
        <label for="grant_name" class="col-md-4">Dosage </label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="dosage" name" id="grant_name" name="dosage" />
        </div>
    </div>
 <div class="form-group">
        <label for="grant_name" class="col-md-4">Drug Type<font color="red" size="5">*</font></label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="drug type"  id="grant_name" name="drug_type" />
        </div>
    </div>
<div class="form-group">
        <label for="grant_name" class="col-md-4">Description</label>
        <div  class="col-md-8">
        <input type="text" class="form-control" placeholder="description"  id="grant_name" name="description" />
        </div>
    </div>


       <div class="col-md-3 col-md-offset-4"> 
    <button class="btn btn-lg btn-primary btn-block" value="submit" type="submit">Submit</button>
    </div>
</div></div>