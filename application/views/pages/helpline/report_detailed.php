<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.widgets.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.colsel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.print.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >

<script type="text/javascript">
$(function(){
	$(".date").Zebra_DatePicker();
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
  }); 
</script>

<div class="row">
	<?php if(!!$msg) { ?>
		<div class="alert alert-info">
			<?php echo $msg; ?>
		</div>
	<?php } ?>
	
	<?php 
			if($this->input->post('date')){
				$date = date("d-M-Y",strtotime($this->input->post('date')));
			}
			else $date = date("d-M-Y");
			echo form_open('helpline/detailed_report',array('role'=>'form','class'=>'form-custom'));
	?>
			<h4>Calls on <input type="text" class="date" value="<?php echo $date;?>" name="date" /> <input type="submit" value="Go" name="submit" class="btn btn-primary btn-sm" /></form></h4>
	<?php
		if(!!$calls){
	?>
		<table class="table table-striped table-bordered" id="table-sort">
			<thead>
				<th>#</th>
				<th>Call</th>
				<th>From-To</th>
				<th>Recording</th>
				<th>Caller Type</th>
				<th>Call Category</th>
				<th>Resolution Status</th>
				<th>Hospital</th>
				<th>Patient</th>
				<th>Note</th>
			</thead>
			<tbody>
			<?php 
				$i=1;
				foreach($calls as $call){ ?>
					<tr>
						<td>
							<?php echo $i++;?>
						</td>
						<td>
							<?php if($call->call_type == "incomplete") { ?>
								<span class="glyphicon glyphicon-arrow-left" style="color:red" title="Missed Call"></span>	
							<?php } 
							else if($call->call_type == "client-hangup"){ ?>
								<span class="glyphicon glyphicon-arrow-left" style="color:red" title="Client Hangup"></span>
							<?php }
							else if($call->direction == "incoming"){ ?>
								<span class="glyphicon glyphicon-arrow-left" style="color:green" title="Incoming"></span>
							<?php } 
							else if($call->direction == "outbound-dial"){ ?>
								<span class="glyphicon glyphicon-arrow-right" style="color:green" title="Outgoing"></span>
							<?php } ?>
							<small>
								<?php echo $call->dial_call_duration;?><br />
								<?php echo date("d-M-Y g:iA",strtotime($call->start_time));?>
							</small>
						</td>
						<td>
							<small><?php echo $call->from_number;?><br />
							<?php echo $call->to_number;?>
							</small>
						</td>
						<td><small><?php echo $call->dial_whom_number;?>
							<audio controls preload="none">
								<source src="<?php echo $call->recording_url;?>" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio>
							</small>
						</td>
						<td>
							<?php echo $call->caller_type;?>	
						</td>
						<td>
							<?php echo $call->call_category;?>		
						</td>
						<td>
							<?php echo $call->resolution_status;?>		
						</td>
						<td>
							<?php echo $call->hospital;?>		
						</td>
						<td>
							<?php echo $call->ip_op;?> <?php if($call->visit_id !=0) echo "#".$call->visit_id;?>	
						</td>
						<td>
							<?php echo $call->note;?>
						</td>
					</tr>
				<?php } 
				?>
				</tbody>
			</table>
		<?php				
			echo form_close();
			} 
		else{
			echo "No calls on the given day.";
		}
		?>
</div>

					
				