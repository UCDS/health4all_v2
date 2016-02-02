<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript"
 src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.widgets.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.colsel.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.print.js"></script>
	<script type="text/javascript">
$(function(){
		var options = {
			widthFixed : true,
			showProcessing: true,
			headerTemplate : '{content} {icon}', // Add icon for jui theme; new in v2.7!

			widgets: [ 'default', 'zebra', 'print', 'stickyHeaders','filter'],

			widgetOptions: {

		  print_title      : 'table',          // this option > caption > table id > "table"
		  print_dataAttrib : 'data-name', // header attrib containing modified header name
		  print_rows       : 'f',         // (a)ll, (v)isible or (f)iltered
		  print_columns    : 's',         // (a)ll, (v)isible or (s)elected (columnSelector widget)
		  print_extraCSS   : '.table{border:1px solid #ccc;} tr,td{background:white}',          // add any extra css definitions for the popup window here
		  print_styleSheet : '', // add the url of your print stylesheet
		  // callback executed when processing completes - default setting is null
		  print_callback   : function(config, $table, printStyle){
			// do something to the $table (jQuery object of table wrapped in a div)
			// or add to the printStyle string, then...
			// print the table using the following code
			$.tablesorter.printTable.printOutput( config, $table.html(), printStyle );
			},
			// extra class name added to the sticky header row
			  stickyHeaders : '',
			  // number or jquery selector targeting the position:fixed element
			  stickyHeaders_offset : 0,
			  // added to table ID, if it exists
			  stickyHeaders_cloneId : '-sticky',
			  // trigger "resize" event on headers
			  stickyHeaders_addResizeEvent : true,
			  // if false and a caption exist, it won't be included in the sticky header
			  stickyHeaders_includeCaption : false,
			  // The zIndex of the stickyHeaders, allows the user to adjust this to their needs
			  stickyHeaders_zIndex : 2,
			  // jQuery selector or object to attach sticky header to
			  stickyHeaders_attachTo : null,
			  // scroll table top into view after filtering
			  stickyHeaders_filteredToTop: true,

			  // adding zebra striping, using content and default styles - the ui css removes the background from default
			  // even and odd class names included for this demo to allow switching themes
			  zebra   : ["ui-widget-content even", "ui-state-default odd"],
			  // use uitheme widget to apply defauly jquery ui (jui) class names
			  // see the uitheme demo for more details on how to change the class names
			  uitheme : 'jui'
			}
		  };
			$("#table-sort").tablesorter(options);
		  $('.print').click(function(){
			$('#table-sort').trigger('printTable');
		  });
});
</script>
<script type="text/javascript">
$(function(){
	$("#date,#calldate").Zebra_DatePicker({
			});
	$("#vendor").on('change',function(){
		var vendor_id=$(this).val();
		$("#contact_person_id option").hide();
		$("#contact_person_id option[class="+vendor_id+"]").show();
	});
});
</script>
<script>
	$(function(){
		
		$(".time").timeEntry();
	
	});
</script>
<div class="col-md-8 col-md-offset-2">

	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3>Edit  Service Issue</h3></center><br>
	<?php echo validation_errors(); echo form_open('equipments/edit/service_records',array('role'=>'form','id'=>'edit_service_record')); ?>

    
	<input type="hidden" class="form-control"  value='<?php echo $service_records[0]->request_id; ?>'   name="request_id" />
<div class="col-md-8">
	<div class="form-group">
		<div class="col-md-6">
		<label for="service_records" >Call Date<font color='red'>*</font></label>
		</div>
		<div  class="col-md-6">
	
		<input type="text" class="form-control" placeholder=" Call Date" form="add_service_record" id="calldate" name="call_date"
<?php if(isset($service_records)){
			echo "value='".$service_records[0]->call_date."' ";
			}
		?>		/>
		
		</div>
	</div>
	</div>
	<br><br>
	<div class="col-md-8">
	<div class="form-group">
	<div class="col-md-6">
		<label for="service_records" >Call Time<font color='red'>*</font></label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="time form-control"  size="6"  placeholder=" Call Time" id="service_records" name="call_time"
<?php if(isset($service_records)){
			echo "value='".$service_records[0]->call_time."' ";
			}
		?>		/>
		</div>
	</div></div><br><br>
		<div class="col-md-8">
<div class="form-group">
<div class="col-md-6">
		<label for="service_records" >Call Information Type</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Call Information Type" id="service_records" name="call_information_type"
		
		<?php if(isset($service_records)){
			echo "value='".$service_records[0]->call_information_type."' ";
			}
		?>/>
		</div>
	</div></div><br><br>
		<div class="col-md-8">
<div class="form-group">
<div class="col-md-6">
		<label for="service_records" >Call Information</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder=" Call Information" id="service_records" name="call_information"
<?php if(isset($service_records)){
			echo "value='".$service_records[0]->call_information."' ";
			}
		?>		/>
		</div>
	</div></div><br><br>
	
		<div class="col-md-8">
<div class="form-group">
<div class="col-md-6">
		<label for="description" > Working Status<font color='red'>*</font></label>
		</div>
		<div  class="col-md-6">
	        <input type="text" class="form-control" placeholder=" Call Information" id="service_records" name="working_status"
           
		   <?php
				if($service_records[0]->working_status==1)
				{
					echo  "value='".'Working'."' ";
				}
						else{
                        echo "value='".'Not working'."' ";	}?>
		  />


		</div>
	</div></div><br><br>


	<div class="col-md-8">
<div class="form-group">
		<div class="col-md-6">
			<label for="vendor" >Vendor<font color='red'>*</font></label>
		</div>
			<div class="col-md-6">
			<select class="form-control" id="vendor" name="vendor">
				<option value=""> </option>
				<?php foreach($vendors as $u){
					echo "<option value='$u->vendor_id'>$u->vendor_name class='$u->vendor_id'";
					if($service_records[0]->vendor_id == $u->vendor_id)
					{
						echo ' selected';
					}
					echo ">$u->vendor_id</option>";
				}?>
			</select>
		</div>	
	
	</div></div><br><br>
		
		<div class="col-md-8">
	<div class="form-group">
		<div class="col-md-6">
			<label for="contact_person_id" > Contact Person</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="vendor" name="vendor">
				<option value=""> </option>
				<?php foreach($vendors as $d){
					echo "<option value='$d->contact_person_id'>$d->contact_person_first_name $d->contact_person_last_name class='$d->contact_person_id'";
					if($service_records[0]->contact_person_id == $u->contact_person_id)
					{
						echo ' selected';
					}
					echo ">$d->contact_person_id</option>";
				}?>
			</select>
		</div>	
		
	</div></div><br><br>
	


		<div class="col-md-8">
<div class="form-group">
<div class="col-md-6">
		<label for="service_records" >Service Person Remarks</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder="  Service Remarks" id="service_records" name="service_person_remarks"
<?php if(isset($service_records)){
			echo "value='".$service_records[0]->service_person_remarks."' ";
			}
		?>			/>
		</div>
	</div></div><br><br>
		<div class="col-md-8">
	<div class="form-group">
	<div class="col-md-6">
		<label for="service_records" >Service Date</label>
		</div>
		<div  class="col-md-6">
		<input type="text" class="form-control" placeholder="   Service Date" id="date" form="add_service_record" name="service_date"
<?php if(isset($service_records)){
			echo "value='".$service_records[0]->service_date."' ";
			}
		?>		/>
		</div>
	</div></div><br><br>
	<div class="col-md-8">
	<div class="form-group">
	<div class="col-md-6">
		<label for="service_records" >Service Time</label>
		</div>
		
		<div  class="col-md-6">
		<input type="text" class=" time form-control" placeholder="   Service Time" id="service_records" name="service_time" 
		<?php if(isset($service_records)){
			echo "value='".$service_records[0]->service_time."' ";
			}
		?>/>
		</div>
		</div>
	</div>
	<div class="col-md-8">
	<div class="form-group">
	<div class="col-md-6">
		<label for="service_records" >Issue status </label>
		</div>
			<div class="col-md-6">
		
			
<select name="problem_status" class="form-control">
		<option value="">Select Problem Status</option>

	<option value="Issue Reported">Issue Reported</option>
	<option value="Service Visit Made">Service Visit Made</option>
	<option value="Under Observation">Under Observation</option>
	<option value="Issue Resolved">Issue Resolved</option>



</select>
</div>

		</div>
	</div><br><br>
	</div>

</div>
	
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } 
	else { ?>
	
	<h3 class="col-md-12">List of Service Records </h3>
	<div class="col-md-12 ">
	</div>	
<button type="button" class="btn btn-default btn-md print">
		  <span class="glyphicon glyphicon-print"></span> Print
		</button>
		<table class="table table-bordered table-striped" id="table-sort">
	<thead>
	<th>S.No</th><th>Call Date </th><th>Call Time</th><th>Call Information Type</th><th>Call Information</th><th>Vendor</th><th>Contact Person</th><th>Service Person Remarks</th>
	<th>Service Date</th><th>Service Time</th><th>Problem Status</th><th>Working Status</th></thead>
	<tbody>
	<?php 
	$i=1;
	foreach($service_records as $a){ ?>
	<?php echo form_open('equipments/edit/service_records',array('id'=>'select_service_records_form_'.$a->request_id,'role'=>'form')); ?>
	<tr onclick="$('#select_service_records_form_<?php echo $a->request_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $a->call_date; ?>
		
		<input type="hidden" value="<?php echo $a->request_id; ?>" name="request_id" />
		<input type="hidden" value="select" name="select" />
		</td>
	
	
		<td><?php echo $a->call_time; ?></td>
		<td><?php echo $a->call_information_type; ?></td>
		<td><?php echo $a->call_information; ?></td>
		<td><?php foreach($vendors as $d){
			echo "<option value='$d->vendor_id'>$d->vendor_name</option>";
		}
		?></td>
		<td><?php foreach($contact_persons as $d){
			echo "<option value='$d->contact_person_id' class='$d->vendor_id' >$d->contact_person_first_name  $d->contact_person_last_name</option>";
		}
		?></td>
		<td><?php echo $a->service_person_remarks; ?></td>
		<td><?php echo $a->service_date; ?></td>
		<td><?php echo $a->service_time; ?></td>
		<td><?php echo $a->problem_status; ?></td>
		<td><?php
				if($a->working_status==1)
				{
					echo "Working";
				}
						else{
                        echo "Not working";	}?></td>
		                
		


			</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div></div>