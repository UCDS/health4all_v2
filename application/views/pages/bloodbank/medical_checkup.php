<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
 <script type="text/javascript"
 src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
 <script type="text/javascript"
 src="<?php echo base_url();?>assets/js/jquery.mousewheel.js"></script>
<script>
    $(document).ready(function() {

                $('#btnYes').click(function () {
                    $('#modal-dialog').modal('toggle');
                    $('#update_checkup')[0].submit();

                });
 
    });
	$(function(){
		var rowcount=1;
		$("#donation_date").Zebra_DatePicker({
			direction:false
		});
		$(".time").timeEntry();
       
	});
        
        function validate() {
            alert("test");
            return false;
        }
                  //my editing.
        function validation_submit(){
		weight=document.getElementById("weight").value;//taking all values from form.
		pulse=document.getElementById("pulse").value;
        hb=document.getElementById("hb").value;
		sbp=document.getElementById("sbp").value;
		dbp=document.getElementById("dbp").value;
		tem=document.getElementById("temperature").value;
		
		if (weight<70 ){ 			//checking given values are satisfied or not.
			 $('#modal-dialog').modal('show');
             $("#ërror-msg").html("Enter correct WEIGHT");
					return false;
		}
		else if (pulse<70){
               $('#modal-dialog').modal('show');
               $("#ërror-msg").html("Enter correct PULSE");
        } 
        else if (hb<70){
			$('#modal-dialog').modal('show'); 
            $("#ërror-msg").html("Enter correct HB");
             
		}
		else if (sbp<70){  
			$('#modal-dialog').modal('show'); 
            $("#ërror-msg").html("Enter correct SBP");                       
		}
		else if (dbp<70){
			$('#modal-dialog').modal('show'); 
            $("#ërror-msg").html("Enter correct DBP");
		}
		else if (tem<70){
            $('#modal-dialog').modal('show');
            $("#ërror-msg").html("Enter correct Temparature");
		}
		else{
			return true;
		}
        return false;         
	}//upto here...
</script>
<div class="col-md-10 col-sm-9">
	<?php 
	echo validation_errors();
	if(isset($msg)) {
		echo $msg;
		echo "<br />";
		echo "<br />";
	}
	?>
	<div class="alert alert-info">
	<?php
	foreach($donor_details as $donor){
		echo "Donation ID: ".$donor->donation_id;
		echo " | Name: ".$donor->name;
		echo " | Age: ".$donor->age;
		echo " | Blood Group: ".$donor->blood_group;
		$donation_id=$donor->donation_id;
	}
	?>
	</div>

	<div class="panel panel-default">
	<div class="panel panel-heading">
	<h4>Medical checkup</h4>
	</div>
	<?php echo form_open("bloodbank/register/medical_checkup/0/$donation_id",array('class'=>'form-custom','id' => 'update_checkup', 'onsubmit' => "return validation_submit()"));
        ?>
           
	<div class="panel-body" >
	<label class="col-md-4"> Weight : </label>
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
			<input type="text" placeholder="Weight" class="form-control" id="weight" name="weight" required />Kgs
		</div><br/>
	<label class="col-md-4" >Pulse : </label>
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
			<input type="text" placeholder="Pulse" class="form-control" id="pulse" name="pulse" required />/min
	</div><br />
	<label class="col-md-4" >Hb: </label> 
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Hb" class="form-control" id="hb" name="hb" required  />gm/dL
	</div><br />
		<label class="col-md-4" >Bp: </label>  
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="SBP" class="form-control" id="sbp" name="sbp" required/>/
		<input type="text" placeholder="DBP" id="dbp" class="form-control"name="dbp" required value="65" />
	</div><br />
		<label class="col-md-4" >Temperature(Farheit)</label> 
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Temperature" class="form-control" id="temperature" name="temperature" required  />
	</div><br />
	<label class="col-md-4" >Date of Donation: </label> 
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Date of Donation" class="form-control" id="donation_date" name="donation_date" required/>
	</div><br />    
	<label class="col-md-4" >Donation time: </label> 
	<div class="form-group col-md-8" style="margin-top:5px;margin-bottom:5px;">
		<input type="text" placeholder="Donation time" class="time form-control"  id="donation_time" name="donation_time" required />
	</div><br />
	</div>
	<div class="panel-footer" style="margin-top:5px;margin-bottom:5px;">
		<div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary" data-target="#myModal"  />
                        </div>
        </div>   
        <!--start from here its about modal(a pop up window which shows are you sure to submit.)-->                 
<div class="container">
</div>        
<div id="modal-dialog" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
                 <h3>Are you sure</h3>
            </div>
            <div class="modal-body" id="ërror-msg">              
            </div>
            <div class="modal-footer"> 
                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">Cancel</a>
                <a href="#" id="btnYes" name="medical_checkup" class="btn confirm">Submit</a>
            </div>
        </div>
    </div>
</div>
<!--modal code end here-->
</form>  
        </div>
