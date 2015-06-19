<!--This page is used to generate a trend report of IP and OP patient.
This report is generated in response to the query submitted on this page.
This view is called in reports.php ip_op_trends method-->

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
                        cssInfoBlock : "tablesorter-no-sort",
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
		<h4>IP/OP Trend Report</h4>	
		<?php echo form_open("reports/ip_op_trends",array('role'=>'form','class'=>'form-custom')); ?>
                Visit Type:  
				<label><input type ="radio" name="visit_type" class ="form-control" value="IP" <?php if($this->input->post('visit_type') == "IP") echo " checked ";?> > IP</label>
                <label><input type="radio" name="visit_type" class ="form-control" value="OP" <?php if($this->input->post('visit_type') != "IP") echo " checked "; ?> > OP </label><br />
                Trend:  
				<label><input type ="radio" name="trend_type" class ="form-control" value="Day" checked > Daily</label>
                <label><input type="radio" name="trend_type" class ="form-control" value="Month" <?php if($this->input->post('trend_type') == "Month") echo " checked "; ?> > Monthly </label>
                <label><input type="radio" name="trend_type" class ="form-control" value="Year" <?php if($this->input->post('trend_type') == "Year") echo " checked "; ?> > Yearly </label><br>
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
		<th style="text-align:center" rowspan="2">Date</th>
		<th style="text-align:center" rowspan="1" colspan="3">Total Visits</th>
	</tr>
	<tr>
		<th style="text-align:center">Male</th><th style="text-align: center">Female</th><th style="text-align: center">Total</th>
	</tr>
	</thead>
	<tbody>
	<?php 
        // Simple total
	$total_male=0;
	$total_female=0;
	$total=0;
        
        // To calculate average of visits made by patients in the given date range.
        $number_of_records = 0;
        $average = 0;
        
        // To calculate median of visits made by patients in the given date range.
        $male_count_per_day = array();
        $female_count_per_day = array();
        $total_count_per_day= array();
        $median_male = 0;
        $median_female = 0;
        $median_total = 0;
        
	foreach($report as $s){
		if($this->input->post('trend_type')){
			$trend_type=$this->input->post('trend_type');
			if($trend_type == "Month"){
				$date = date("M, Y",strtotime($s->date));
			}
			else if($trend_type == "Year"){
				$date = $s->date;
			}
			else{
				$date = date("d-M-Y",strtotime($s->date));
			}
		}
		else{
			$date = date("d-M-Y",strtotime($s->date));
		}
	?>
	<tr>
		<td><?php echo $date;?></td>
		<td class="text-right"><?php echo $s->male;?></td>
		<td class="text-right"><?php echo $s->female;?></td>
		<td class="text-right"><?php echo $s->total;?></td>
	</tr>
	<?php
        
	$total_male+=$s->male;
	$total_female+=$s->female;
	$total+=$s->total; 
        // Preparing an array of number of visits per day to sort and find the median.
        $male_count_per_day[$number_of_records] = $s->male;
        $female_count_per_day[$number_of_records] = $s->female;
        $total_count_per_day[$number_of_records] = $s->total;
        $number_of_records++;        
	}
	?>
	</tbody>
        <tbody class="tablesorter-no-sort">
	<tr>
		<th>Total </th>
		<th class="text-right" ><?php echo number_format($total_male);?></th>
		<th class="text-right" ><?php echo number_format($total_female);?></th>
		<th class="text-right" ><?php echo number_format($total);?></th>
	</tr>
        <tr>
            <?php
            //This function is used to calculate the median of a given array.
            //It first sorts the array and then finds the element midway in the sorted array.
                function median($list){
                    sort($list);
                    if(sizeof($list) == 0){
                     return 0;
                    }
                    elseif(sizeof($list)== 1){
                        return $list[0];
                    }
                    elseif(sizeof($list)%2 == 0){
                        $middle = sizeof($list)/2;
                        
                        return ($list[$middle-1] + $list[$middle])/2;
                    }
                    else{
                        $middle = (sizeof($list) - 1)/2 + 1;
                        
                        return $list[$middle-1];
                    }
                }
            ?>
                <th>Median</th>
                <th class="text-right"><?php echo round(median($male_count_per_day)); ?></th>
                <th class="text-right"><?php echo round(median($female_count_per_day)); ?></th>
                <th class="text-right"><?php echo round(median($total_count_per_day)); ?></th>
        </tr>
        <tr>
                <th>Average</th>
                <th class="text-right"><?php echo round(($total_male/$number_of_records)); ?></th>
                <th class="text-right"><?php echo round(($total_female/$number_of_records));?></th>
                <th class="text-right"><?php echo round(($total/$number_of_records));?></th>
        </tr>
        </tbody>
	</table>
	<?php } else { ?>
	No patient registrations on the given date.
	<?php } ?>
	</div>