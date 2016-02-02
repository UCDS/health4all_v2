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
		<h4>Outcome- Summary Report</h4>	
		<?php echo form_open("reports/outcome_summary",array('role'=>'form','class'=>'form-custom')); ?>
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
                    <select name="date_type_selection" id="date_type_selection" class="form-control">
                        <option value="admit_date" selected>Admit date</option>
                        <option value="outcome_date">Outcome Date</option>
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
		<th style="text-align:center" rowspan="2">Department</th>
        <th style="text-align:center" colspan="3">Discharge</th>
        <th style="text-align:center" colspan="3">LAMA</th>
        <th style="text-align:center" colspan="3">Absconded</th>
        <th style="text-align:center" colspan="3">Death</th>
        <th style="text-align:center" colspan="3">Unupdated records</th>
        <th style="text-align:center" colspan="3">Total Visits</th>
    </tr>
    <tr>
        <th>Male</th><th>Female</th><th>Total</th>
        <th>Male</th><th>Female</th><th>Total</th>
        <th>Male</th><th>Female</th><th>Total</th>
        <th>Male</th><th>Female</th><th>Total</th>
        <th>Male</th><th>Female</th><th>Total</th>
		<th>Male</th><th>Female</th><th>Total</th>
	</tr>
	
	</thead>
	<tbody>
	<?php 
    $total_female_discharge=0;
    $total_male_discharge=0;
    $total_discharge=0;
    $total_female_lama=0;
    $total_male_lama=0;
    $total_lama=0;
    $total_female_absconded=0;
    $total_male_absconded=0;
    $total_absconded=0;
    $total_female_death=0;
    $total_male_death=0;
    $total_death=0;
    $total_female=0;
    $total_unupdated_male=0;
    $total_unupdated_female=0;
    $total_unupdated=0;
	$total_male=0;	
	$total_outcome=0;
	foreach($report as $s){
	?>
	<tr>
		<td><?php echo $s->department;?></td>
        <td class="text-right"><?php echo $s->male_discharge;?></td>
        <td class="text-right"><?php echo $s->female_discharge;?></td>
        <td class="text-right"><?php echo $s->total_discharge;?></td>
        <td class="text-right"><?php echo $s->male_lama;?></td>
        <td class="text-right"><?php echo $s->female_lama;?></td>
        <td class="text-right"><?php echo $s->total_lama;?></td>
        <td class="text-right"><?php echo $s->male_absconded;?></td>
        <td class="text-right"><?php echo $s->female_absconded;?></td>
        <td class="text-right"><?php echo $s->total_absconded;?></td>
        <td class="text-right"><?php echo $s->male_death;?></td>
        <td class="text-right"><?php echo $s->female_death;?></td>
        <td class="text-right"><?php echo $s->total_death;?></td>
        <td class="text-right"><?php echo $s->male_unupdated;?></td>
        <td class="text-right"><?php echo $s->female_unupdated;?></td>
        <td class="text-right"><?php echo $s->total_unupdated;?></td>
		<td class="text-right"><?php echo $s->outcome_male;?></td>
		<td class="text-right"><?php echo $s->outcome_female;?></td>
		<td class="text-right"><?php echo $s->outcome;?></td>
	</tr>
	<?php
	$total_female_discharge+=$s->female_discharge;
    $total_male_discharge+=$s->male_discharge;
    $total_discharge+=$s->total_discharge;
    $total_female_lama+=$s->female_lama;
    $total_male_lama+=$s->male_lama;
    $total_lama+=$s->total_lama;
    $total_female_absconded+=$s->female_absconded;
    $total_male_absconded+=$s->male_absconded;
    $total_absconded+=$s->total_absconded;
    $total_female_death+=$s->female_death;
    $total_male_death+=$s->male_death;
    $total_death+=$s->total_death;
    $total_unupdated_male+=$s->male_unupdated;
    $total_unupdated_female+=$s->female_unupdated;
    $total_unupdated+=$s->total_unupdated;
    $total_female+=$s->outcome_female;
	$total_male+=$s->outcome_male;	
	$total_outcome+=$s->outcome;
	}
	?>
	</tbody>
	<tbody class="tablesorter-no-sort">
        <tr>
		    <th>Total </th>
		    <td class="text-right"><?php echo $total_male_discharge;?></td>
            <td class="text-right"><?php echo $total_female_discharge;?></td>
            <td class="text-right"><?php echo $total_discharge;?></td>
            <td class="text-right"><?php echo $total_male_lama;?></td>
            <td class="text-right"><?php echo $total_female_lama;?></td>
            <td class="text-right"><?php echo $total_lama;?></td>
            <td class="text-right"><?php echo $total_male_absconded;?></td>
            <td class="text-right"><?php echo $total_female_absconded;?></td>
            <td class="text-right"><?php echo $total_absconded;?></td>
            <td class="text-right"><?php echo $total_male_death;?></td>
            <td class="text-right"><?php echo $total_female_death;?></td>
            <td class="text-right"><?php echo $total_death;?></td>
            <td class="text-right"><?php echo $total_unupdated_male;?></td>
            <td class="text-right"><?php echo $total_unupdated_female;?></td>
            <td class="text-right"><?php echo $total_unupdated;?></td>
		    <td class="text-right"><?php echo $total_male;?></td>
		    <td class="text-right"><?php echo $total_female;?></td>
		    <td class="text-right"><?php echo $total_outcome;?></td>
        </tr>
        <tr>
            <th>Percentage of total</th>
            <td class="text-right"><?php echo round(($total_male_discharge/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_female_discharge/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_discharge/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_male_lama/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_female_lama/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_lama/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_male_absconded/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_female_absconded/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_absconded/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_male_death/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_female_death/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_death/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_unupdated_male/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_unupdated_female/$total_outcome)*100).'%';?></td>
            <td class="text-right"><?php echo round(($total_unupdated/$total_outcome)*100).'%';?></td>
		    <td class="text-right"><?php echo round(($total_male/$total_outcome)*100).'%';?></td>
		    <td class="text-right"><?php echo round(($total_female/$total_outcome)*100).'%';?></td>
		    <td class="text-right"><?php echo round(($total_outcome/$total_outcome)*100).'%';?></td>
        </tr>
	</tbody>
	</table>
	<?php } else { ?>
	No patient registrations on the given date.
	<?php } ?>
	</div>