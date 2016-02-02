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
	$this->input->post('visit_type')?$visit_type = $this->input->post('visit_type'): $visit_type = "0";
	$from_date=0;$to_date=0;
	if($this->input->post('from_date')) $from_date=date("Y-m-d",strtotime($this->input->post('from_date'))); else $from_date = date("Y-m-d");
	if($this->input->post('to_date')) $to_date=date("Y-m-d",strtotime($this->input->post('to_date'))); else $to_date = date("Y-m-d");
	?>
	<div class="row">
		<h4>ICD Code - Summary Report</h4>	
		<?php echo form_open("reports/icd_summary",array('role'=>'form','class'=>'form-custom')); ?>
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
					<select name="visit_name" id="visit_name" class="form-control" >
					<option value="">All</option>
					<?php 
					foreach($visit_names as $v){
						echo "<option value='".$v->visit_name_id."'";
						if($this->input->post('visit_name') && $this->input->post('visit_name') == $v->visit_name_id) echo " selected ";
						echo ">".$v->visit_name."</option>";
					}
					?>
					</select>
					Visit Type : <select class="form-control" name="visit_type">
									<option value="" >All</option>
									<option value="OP" <?php if($visit_type == "OP") echo " selected ";?>>OP</option>
									<option value="IP" <?php if($visit_type == "IP" || $visit_type != 'OP') echo " selected ";?>>IP</option>
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
        <td stype="text-align:center" rowspan="2">SNo</td>
		<td style="text-align:center" rowspan="2">ICD Chapter</th>
		<td style="text-align:center" rowspan="2">ICD Block</th>
		<td style="text-align:center" rowspan="2">ICD Code</th>
		<td style="text-align:center" rowspan="1" colspan="3">Total </th>
        <td style="text-align:center" rowspan="1" colspan="2">Discharge</th>
        <td style="text-align:center" rowspan="1" colspan="2">LAMA</th>
        <td style="text-align:center" rowspan="1" colspan="2">Absconded</th>
        <td style="text-align:center" rowspan="1" colspan="2">Death</th>
        <td style="text-align:center" rowspan="1" colspan="2">Unupdated Records</th>
	</tr>
	<tr>
		<th>Male</th><th>Female</th><th>Total</th>
        <th>Count</th><th>%</th>
        <th>Count</th><th>%</th>
        <th>Count</th><th>%</th>
        <th>Count</th><th>%</th>
        <th>Count</th><th>%</th>
	</tr>
	</thead>
	<tbody>
	<?php 
    $serial_number=1;
	$total_male=0;
	$total_female=0;
	$total=0;
    $total_discharge=0;
    $total_lama=0;
    $total_absconded=0;
    $total_death=0;
    $total_unupdated=0;
	foreach($report as $s){
	?>
	<tr>
        <td><?php echo $serial_number++;?></td>
		<td><?php echo $s->chapter_id." - ".$s->chapter_title;?></td>
		<td><?php echo $s->block_id." - ".$s->block_title;?></td>
		<td><?php echo $s->icd_10." - ".$s->code_title;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/icd_detail/$s->icd_10/$s->department_id/$s->unit/$s->area/M/0/0/$from_date/$to_date/$s->visit_name_id/$visit_type";?>"><?php echo $s->male;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/icd_detail/$s->icd_10/$s->department_id/$s->unit/$s->area/F/0/0/$from_date/$to_date/$s->visit_name_id/$visit_type";?>"><?php echo $s->female;?></td>
		<td class="text-right"><a href="<?php echo base_url()."reports/icd_detail/$s->icd_10/$s->department_id/$s->unit/$s->area/0/0/0/$from_date/$to_date/$s->visit_name_id/$visit_type";?>"><?php echo $s->total;?></td>
        <td class="text-right"><a href="<?php echo base_url()."reports/icd_outcome_detail/$s->icd_10/$s->department_id/$s->unit/$s->area/0/0/0/$from_date/$to_date/$s->visit_name_id/$visit_type/'Discharge'";?>"><?php echo $s->total_discharge;?></td>
        <td class="text-right"><?php echo round(($s->total_discharge/$s->total)*100).'%';?></td>
        <td class="text-right"><a href="<?php echo base_url()."reports/icd_outcome_detail/$s->icd_10/$s->department_id/$s->unit/$s->area/0/0/0/$from_date/$to_date/$s->visit_name_id/$visit_type/'LAMA'";?>"><?php echo $s->total_lama;?></td>
        <td class="text-right"><?php echo round(($s->total_lama/$s->total)*100).'%';?></td>
        <td class="text-right"><a href="<?php echo base_url()."reports/icd_outcome_detail/$s->icd_10/$s->department_id/$s->unit/$s->area/0/0/0/$from_date/$to_date/$s->visit_name_id/$visit_type/'Absconded'";?>"><?php echo $s->total_absconded;?></td>
        <td class="text-right"><?php echo round(($s->total_absconded/$s->total)*100).'%';?></td>
        <td class="text-right"><a href="<?php echo base_url()."reports/icd_outcome_detail/$s->icd_10/$s->department_id/$s->unit/$s->area/0/0/0/$from_date/$to_date/$s->visit_name_id/$visit_type/'Death'";?>"><?php echo $s->total_death;?></td>
        <td class="text-right"><?php echo round(($s->total_death/$s->total)*100).'%';?></td>
        <td class="text-right"><a href="<?php echo base_url()."reports/icd_outcome_detail/$s->icd_10/$s->department_id/$s->unit/$s->area/0/0/0/$from_date/$to_date/$s->visit_name_id/$visit_type/'Unupdated'";?>"><?php echo $s->total_unupdated;?></td>
        <td class="text-right"><?php echo round(($s->total_unupdated/$s->total)*100).'%';?></td>
	</tr>
	<?php
	$total_male+=$s->male;
	$total_female+=$s->female;
	$total+=$s->total;
    $total_discharge+=$s->total_discharge;
    $total_lama+=$s->total_lama;
    $total_absconded+=$s->total_absconded;
    $total_death+=$s->total_death;
    $total_unupdated+=$s->total_unupdated;
	}
	?>
	<tfoot>
		<th>Total </th>
        <th></th>
		<th></th>
		<th></th>
		<th class="text-right" ><?php echo $total_male;?></th>
		<th class="text-right" ><?php echo $total_female;?></th>
		<th class="text-right" ><?php echo $total;?></th>
        <th class="text-right" ><?php echo $total_discharge;?></th>
        <th class="text-right" ><?php echo round(($total_discharge/$total)*100).'%';?></th>
        <th class="text-right" ><?php echo $total_lama;?></th>
        <th class="text-right" ><?php echo round(($total_lama/$total)*100).'%';?></th>
        <th class="text-right" ><?php echo $total_absconded;?></th>
        <th class="text-right" ><?php echo round(($total_absconded/$total)*100).'%';?></th>
        <th class="text-right" ><?php echo $total_death;?></th>
        <th class="text-right" ><?php echo round(($total_death/$total)*100).'%';?></th>
        <th class="text-right" ><?php echo $total_unupdated;?></th>
        <th class="text-right" ><?php echo round(($total_unupdated/$total)*100).'%';?></th>
	</tfoot>
	</tbody>
	</table>
	<?php } else { ?>
	No patient registrations on the given date.
	<?php } ?>
	</div>