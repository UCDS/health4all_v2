<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.widgets.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.colsel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.print.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#from_date,#to_date").Zebra_DatePicker();
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
	<?php 
	$from_date=0;$to_date=0;
	if($this->input->post('from_date')) $from_date=date("Y-m-d",strtotime($this->input->post('from_date'))); else $from_date = date("Y-m-d");
	if($this->input->post('to_date')) $to_date=date("Y-m-d",strtotime($this->input->post('to_date'))); else $to_date = date("Y-m-d");
	?>
	<div class="row">
		<h4>In-Patient Summary Report</h4>	
		<?php echo form_open("reports/ip_summary",array('role'=>'form','class'=>'form-custom')); ?>
					From Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y",strtotime($from_date)); ?>" name="from_date" id="from_date" size="15" />
					To Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y",strtotime($to_date)); ?>" name="to_date" id="to_date" size="15" />
					<select name="department" id="department" class="form-control">
					<option value="">Department</option>
					<?php 
					foreach($all_departments as $dept){
						echo "<option value='".$dept->department_id."'";
						if($this->input->post('department') && $this->input->post('department') == $dept->department_id) echo " selected ";
						echo ">".$dept->department."</option>";
					}
					?>
					</select>
					<select name="unit" id="unit" class="form-control" >
					<option value="">Unit</option>
					<?php 
					foreach($units as $unit){
						echo "<option value='".$unit->unit_id."' class='".$unit->department_id."'";
						if($this->input->post('unit') && $this->input->post('unit') == $unit->unit_id) echo " selected ";
						echo ">".$unit->unit_name."</option>";
					}
					?>
					</select>
					<select name="area" id="area" class="form-control" >
					<option value="">Area</option>
					<?php 
					foreach($areas as $area){
						echo "<option value='".$area->area_id."' class='".$area->department_id."'";
						if($this->input->post('area') && $this->input->post('area') == $area->area_id) echo " selected ";
						echo ">".$area->area_name."</option>";
					}
					?>
					</select>
					<input class="btn btn-sm btn-primary" type="submit" value="Submit" />
		</form>
	<br />
	<?php if(isset($report) && count($report)>0){ ?>
	
		<button type="button" class="btn btn-default btn-md print">
		  <span class="glyphicon glyphicon-print"></span> Print
		</button>
	<table class="table table-bordered table-striped" id="table-sort">
	<thead>
	<tr>
		<td style="text-align:center" rowspan="2">Department</th>
		<td style="text-align:center" colspan="3"><=14 Years</th>
		<td style="text-align:center" colspan="3">14 to 30 Years</th>
		<td style="text-align:center" colspan="3">30 to 50 Years</th>
		<td style="text-align:center" colspan="3">>50 Years</th>
		<td style="text-align:center" rowspan="1" colspan="3">Total IP Admits</th>
	</tr>
	<tr>
		<th>Male</th><th>Female</th><th>Total</th>
		<th>Male</th><th>Female</th><th>Total</th>
		<th>Male</th><th>Female</th><th>Total</th>
		<th>Male</th><th>Female</th><th>Total</th>
		<th>Male</th><th>Female</th><th>Total</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$total_mchild=0;
	$total_fchild=0;
	$total_child=0;
	$total_m14to30=0;
	$total_f14to30=0;
	$total_14to30=0;
	$total_m30to50=0;
	$total_f30to50=0;
	$total_30to50=0;
	$total_m50plus=0;
	$total_f50plus=0;
	$total_50plus=0;
	$total_male=0;
	$total_female=0;
	$total_ip=0;
	foreach($report as $s){
	?>
	<tr>
		<td><?php echo $s->department;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/M/14/0/$from_date/$to_date";?>"><?php echo $s->ip_mchild;?></a></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/F/14/0/$from_date/$to_date";?>"><?php echo $s->ip_fchild;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/0/14/0/$from_date/$to_date";?>"><?php echo $s->ip_child;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/M/14/30/$from_date/$to_date";?>"><?php echo $s->ip_m14to30;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/F/14/30/$from_date/$to_date";?>"><?php echo $s->ip_f14to30;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/0/14/30/$from_date/$to_date";?>"><?php echo $s->ip_14to30;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/M/30/50/$from_date/$to_date";?>"><?php echo $s->ip_m30to50;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/F/30/50/$from_date/$to_date";?>"><?php echo $s->ip_f30to50;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/0/30/50/$from_date/$to_date";?>"><?php echo $s->ip_30to50;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/M/0/50/$from_date/$to_date";?>"><?php echo $s->ip_m50plus;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/F/0/50/$from_date/$to_date";?>"><?php echo $s->ip_f50plus;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/0/0/50/$from_date/$to_date";?>"><?php echo $s->ip_50plus;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/M/0/0/$from_date/$to_date";?>"><?php echo $s->ip_male;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/F/0/0/$from_date/$to_date";?>"><?php echo $s->ip_female;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/ip_detail/$s->department_id/$s->unit/$s->area/0/0/0/$from_date/$to_date";?>"><?php echo $s->ip;?></td>
	</tr>
	<?php
	$total_mchild+=$s->ip_mchild;
	$total_fchild+=$s->ip_fchild;
	$total_child+=$s->ip_child;
	$total_m14to30+=$s->ip_m14to30;
	$total_f14to30+=$s->ip_f14to30;
	$total_14to30+=$s->ip_14to30;
	$total_m30to50+=$s->ip_m30to50;
	$total_f30to50+=$s->ip_f30to50;
	$total_30to50+=$s->ip_30to50;
	$total_m50plus+=$s->ip_m50plus;
	$total_f50plus+=$s->ip_f50plus;
	$total_50plus+=$s->ip_50plus;
	$total_male+=$s->ip_male;
	$total_female+=$s->ip_female;
	$total_ip+=$s->ip;
	}
	?>
	<tfoot>
		<th>Total </th>
		<th class="text-right" ><?php echo $total_mchild;?></th>
		<th class="text-right"><?php echo $total_fchild;?></th>
		<th class="text-right" ><?php echo $total_child;?></th>
		<th class="text-right" ><?php echo $total_m14to30;?></th>
		<th class="text-right" ><?php echo $total_f14to30;?></th>
		<th class="text-right" ><?php echo $total_14to30;?></th>
		<th class="text-right" ><?php echo $total_m30to50;?></th>
		<th class="text-right" ><?php echo $total_f30to50;?></th>
		<th class="text-right" ><?php echo $total_30to50;?></th>
		<th class="text-right" ><?php echo $total_m50plus;?></th>
		<th class="text-right" ><?php echo $total_f50plus;?></th>
		<th class="text-right" ><?php echo $total_50plus;?></th>
		<th class="text-right" ><?php echo $total_male;?></th>
		<th class="text-right" ><?php echo $total_female;?></th>
		<th class="text-right" ><?php echo $total_ip;?></th>
	</tfoot>
	</tbody>
	</table>
	<?php } else { ?>
	No patient registrations on the given date.
	<?php } ?>
	</div>