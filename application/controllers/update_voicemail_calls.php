<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.widgets.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.colsel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.print.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.ptTimeSelect.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.ptTimeSelect.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.selectize.js"></script>


<script type="text/javascript">
$(function(){
	$(".date").Zebra_DatePicker();
    $('.time').ptTimeSelect();
		var options = {
			widthFixed : true,
			showProcessing: true,
			headerTemplate : '{content} {icon}', // Add icon for jui theme; new in v2.7!

			widgets: [ 'default', 'zebra', 'print', 'stickyHeaders'],

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
	<?php if(isset($msg)) { ?>
		<div class="alert alert-info">
			<?php echo $msg; ?>
		</div>
	<?php } ?>

	<?php
			if($this->input->post('date')){
				$date = date("d-M-Y",strtotime($this->input->post('date')));
			}
			else $date = date("d-M-Y");
			echo form_open('helpline/update_call',array('role'=>'form','class'=>'form-custom'));
	?>
		<h4>Calls on <input type="text" class="date" value="<?php echo $date;?>" name="date" /> <input type="submit" value="Go" name="change_date" class="btn btn-primary btn-sm" /></form></h4>
	</form>


	<?php
		if(!!$calls){
	?>
	<?php echo form_open("helpline/update_call",array("class"=>"form-custom","role"=>"form"));?>
		<p><b>Select the calls to update.</b></p>
		<table class="table table-striped table-bordered" id="table-sort">
			<thead>
				<th>#</th>
				<th><span class="glyphicon glyphicon-ok"></span></th>
				<th>Call ID</th>
				<th>Call</th>
				<th>From-To</th>
				<th>Recording</th>
				<th>Note</th>
				<th>Caller Type</th>
				<th>Call Category</th>
				<th>Call Group</th>
				<th>Resolution Status</th>
				<th>Hospital</th>
				<th>Patient Type</th>
				<th>Visit ID</th>
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
							<input type="checkbox" value="<?php echo $call->call_id;?>" name="call[]" />
						</td>
						<td>
							<?php echo $call->call_id;?>
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
								<span id="call_date_<?= $call->call_id;?>"><?php echo date("d-M-Y g:iA",strtotime($call->start_time));?></span>
							</small>
						</td>
						<td>
							<small><span id="from_number_<?= $call->call_id;?>"><?php echo $call->from_number;?></span><br />
							<?php echo $call->to_number;?>
							</small>
						</td>
						<td><small><?php echo $call->dial_whom_number;?>
							<audio controls preload="none">
								<source src="<?php echo $call->recording_url;?>" id="recording_<?= $call->call_id;?>" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio>
							</small>
						</td>
						<td>
							<textarea name="note_<?php echo $call->call_id;?>" id="note_<?= $call->call_id;?>" rows="1" class="form-control"><?php echo $call->note;?></textarea>
						</td>
						<td>
							<select name="caller_type_<?php echo $call->call_id;?>"  id="caller_type_<?php echo $call->call_id;?>" style="width:100px" class="form-control">
								<option value="">Select</option>
								<?php foreach($caller_type as $ct){ ?>
									<option value="<?php echo $ct->caller_type_id;?>"
									<?php if($call->caller_type_id == $ct->caller_type_id) echo " selected "; ?>
									><?php echo $ct->caller_type;?></option>
								<?php } ?>
							</select>
						</td>
						<td>
							<select name="call_category_<?php echo $call->call_id;?>" id="call_category_<?php echo $call->call_id;?>" style="width:100px" class="form-control">
								<option value="">Select</option>
								<?php foreach($call_category as $cc){ ?>
									<option value="<?php echo $cc->call_category_id;?>"
									<?php if($call->call_category_id == $cc->call_category_id) echo " selected "; ?>
									><?php echo $cc->call_category;?></option>
								<?php } ?>
							</select>
						</td>
						<td>
							<?php if(!!$call->call_group_id){
								echo $call->group_name;
						 	}
							?>
							<select class="repositories call_group" placeholder="Select a Group..." name="group_<?php echo $call->call_id;?>">
							</select>
						</td>
						<td>
							<select name="resolution_status_<?php echo $call->call_id;?>" style="width:100px" class="form-control">
								<option value="">Select</option>
								<?php foreach($resolution_status as $rs){ ?>
									<option value="<?php echo $rs->resolution_status_id;?>"
									<?php if($call->resolution_status_id == $rs->resolution_status_id) echo " selected "; ?>
									><?php echo $rs->resolution_status;?></option>
								<?php } ?>
							</select>
							<input class="date form-control" name="resolution_date_<?php echo $call->call_id;?>" value="<?php if($call->resolution_date_time != 0) echo date("d-M-Y",strtotime($call->resolution_date_time)); else echo '';?>" placeholder="Resolution Date" />
							<input class="time form-control" name="resolution_time_<?php echo $call->call_id;?>" value="<?php if($call->resolution_date_time != 0) echo date("g:i A",strtotime($call->resolution_date_time)); else echo '';?>" placeholder="Resolution Time" />
						</td>
						<td>
							<select name="hospital_<?php echo $call->call_id;?>" id="hospital_<?php echo $call->call_id;?>" style="width:100px" class="form-control">
								<option value="">Select</option>
								<?php foreach($all_hospitals as $hosp){ ?>
									<option value="<?php echo $hosp->hospital_id;?>"
									<?php if($call->hospital_id == $hosp->hospital_id) echo " selected "; ?>
									><?php echo $hosp->hospital;?></option>
								<?php } ?>
							</select>
						</td>
						<td>
							<select name="visit_type_<?php echo $call->call_id;?>" id="visit_type_<?php echo $call->call_id;?>" style="width:100px" class="form-control">
								<option value="">Select</option>
									<option value="OP"
									<?php if($call->ip_op == "OP") echo " selected "; ?>
									>OP</option>
									<option value="IP"
									<?php if($call->ip_op == "IP") echo " selected "; ?>
									>IP</option>
							</select>
						</td>
						<td>
							<input type="text" style="width:100px" name="visit_id_<?php echo $call->call_id;?>" id="visit_id_<?php echo $call->call_id;?>" class="form-control" value="<?php echo $call->visit_id;?>" />
						</td>
						<td>
							<button class="btn btn-default btn-sm" onclick="sendEmail(<?= $call->call_id;?>)" data-toggle="modal" data-target="#emailModal"><i class="fa fa-envelope"></i> Send</button>
					</tr>
				<?php }
				?>
				</tbody>
				<tfoot>
					<th colspan="20" class="text-center">
						<input type="submit" class="btn btn-sm btn-primary" name="submit" value="Update" />
					</th>
				</tfoot>
			</table>
		<?php
			echo form_close();
			}
		else echo "No calls on the given date.";
		?>
</div>

<!-- Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Email</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-md-3">Call ID: </div>
			<div class="col-md-9">
				<input class="call_id_email form-control" readonly name="call_id_email" form="send_email_form">
			</div>
		</div>
		<div class="row">
		<div class="col-md-3">From Number: </div>
		<div class="col-md-9">
				<input class="from_number form-control" readonly name="from_number" form="send_email_form">
		</div>
		</div>
		<div class="row">
		<div class="col-md-3">Date: </div>
		<div class="col-md-9">
				<input class="call_date form-control" readonly name="call_date" form="send_email_form">
		</div>
		</div>
		<div class="row caller_type_row">
		<div class="col-md-3">Caller: </div>
		<div class="col-md-9">
				<input class="caller_type form-control" readonly name="caller_type" form="send_email_form">
		</div>
		</div>
		<div class="row category_row">
		<div class="col-md-3">Category: </div>
		<div class="col-md-9">
				<input class="call_category form-control" readonly name="call_category" form="send_email_form">
		</div>
		</div>
		<div class="row hospital_row">
		<div class="col-md-3">Hospital: </div>
		<div class="col-md-9">
				<input class="hospital form-control" readonly name="hospital" form="send_email_form">
		</div>
		</div>
		<div class="row patient_row">
		<div class="col-md-3">Patient: </div>
		<div class="col-md-9">
				<input class="patient form-control" readonly name="patient" form="send_email_form">
		</div>
		</div>
		<div class="row recording_row sr-only">
		<div class="col-md-3">Recording: </div>
		<div class="col-md-9">
				<input class="recording form-control" readonly name="recording" form="send_email_form">
		</div>
		</div>
		<div class="row">
		<?php echo form_open("helpline/update_call",array("class"=>"form-custom","role"=>"form","id"=>"send_email_form"));?>
		<div class="col-md-3">To</div>
		<div class="col-md-9"><input type="text" class="form-control" name="to_email" form="send_email_form" required placeholder="Comma separated for multiple emails" style="width:100%" /></div>
        <div class="col-md-3">CC</div>
		<div class="col-md-9"><input type="text" class="form-control" name="cc_email" form="send_email_form" placeholder="Comma separated for multiple emails" style="width:100%" /></div>
        <div class="col-md-3">Greeting</div>
		<div class="col-md-9"><input type="text" class="form-control" name="greeting" form="send_email_form" required placeholder="Dear Mr. X" /></div>
        <div class="col-md-3">Share Phone #? </div>
		<div class="col-md-9">
			<label><input type="radio" class="form-control" name="phone_shared" form="send_email_form" required value="1" />Yes</label>
			<label><input type="radio" class="form-control" name="phone_shared" form="send_email_form" required value="0" />No</label>
		</div>
		 <div class="col-md-3">Note</div>
		 <div class="col-md-9"><textarea name="note" class="form-control note" form="send_email_form" required rows="6" cols="6" style="width:100%"></textarea></div>
      </div>
      </div>
      <div class="modal-footer">
		<input type="text" class="sr-only" value="<?php echo $date;?>" name="date" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="send_email_form" required name="send_email" value="1">Save changes</button>
		</form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function sendEmail(callId){
		$(".category_row,.patient_row,.hospital_row").show();
		$(".from_number").val($("#from_number_"+callId).text());
		$(".call_date").val($("#call_date_"+callId).text());
		$(".recording").val($("#recording_"+callId).attr('src'));
		if($("#call_category_"+callId).val()!=''){
		$(".call_category").val($("#call_category_"+callId+" :selected").text());
		}
		else $(".category_row").hide();
		if($("#hospital_"+callId).val()!=''){
		$(".hospital").val($("#hospital_"+callId+" :selected").text());
		}
		else $('.hospital_row').hide();
		if($("#visit_type_"+callId).val()!='' && $("#visit_id_"+callId).val()!='0'){
		$(".patient").val($("#visit_type_"+callId+" :selected").text() +" #"+ $("#visit_id_"+callId).val());
		}
		else $(".patient_row").hide();
		if($("#caller_type_"+callId).val()!=''){
		$(".caller_type").val($("#caller_type_"+callId+" :selected").text());
		}
		else $(".caller_type_row").hide();
		$(".note").text($("#note_"+callId).val());
		$(".call_id_email").val(callId);
	}

	$(function(){

		$('.call_group').selectize({
	    valueField: 'call_group_id',
	    labelField: 'group_name',
	    searchField: 'group_name',
	    create: false,
	    render: {
	        option: function(item, escape) {

	            return '<div>' +
	                '<span class="title">' +
	                    '<span class="group_name">' + escape(item.group_name) + '</span>' +
	                '</span>' +
	                '<ul class="meta">' +
	                    '<li class="watchers"><span>' + escape(item.group_datetime) + '</span>' +
	                '</ul>' +
	            '</div>';
	        }
	    },
	    load: function(query, callback) {
	        if (!query.length) return callback();
			$.ajax({
	            url: '<?php echo base_url();?>helpline/search_call_groups',
	            type: 'POST',
				dataType : 'json',
				data : {query:query},
	            error: function(res) {
	                callback();
	            },
	            success: function(res) {
	                callback(res.groups.slice(0, 10));
	            }
	        });
	    }
		});
	});
	</script>
