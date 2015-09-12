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
<div class="col-md-8 col-md-offset-2">
	<?php if(isset($tests) && count($tests)>0){ ?>
	
		<button type="button" class="btn btn-default btn-md print">
		  <span class="glyphicon glyphicon-print"></span> Print
		</button>
	<table class="table table-bordered table-striped" id="table-sort">
	<thead>
	<tr>
		<th class="text-center">Area</th>
		<th class="text-center">Method</th>
		<th class="text-center">Name</th>
		<th class="text-center">Binary</th>
		<th class="text-center">Numeric</th>
		<th class="text-center">Text</th>
                <th class="text-center">Note</th>
                <th class="text-center">Ranges</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	foreach($tests as $test){
	?>
	<tr>
		<td><?php echo $test->test_area;?></td>
		<td><?php echo $test->test_method;?></td>
                <td><?php echo $test->test_name."(".$test->lab_unit.")";?></td>
                <td class="text-center"><?php if($test->binary_result) { ?> <i class="fa fa-check"></i><?php } ?></td>
                <td class="text-center"><?php if($test->numeric_result) { ?> <i class="fa fa-check"></i><?php } ?></td>
                <td class="text-center"><?php if($test->text_result) { ?> <i class="fa fa-check"></i><?php } ?></td>
                <td class="text-right"><?php echo $test->comments;?></td>
                <td class="text-right"><button type="button" style="border:none" class="btn btn-default" data-toggle="modal" data-target="#myModal<?php echo $test->test_master_id;?>"><?php echo $test->ranges_count;?></button></td>
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>
    <!-- Modal -->
    <?php foreach($tests as $test){
            ?>
    <div class="modal fade" id="myModal<?php echo $test->test_master_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3>Test</h3>
                    <table class="table table-bordered table-striped" id="table-sort">
                        <thead>
                        <tr>
                                <th class="text-center">Area</th>
                                <th class="text-center">Method</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Binary</th>
                                <th class="text-center">Numeric</th>
                                <th class="text-center">Text</th>
                                <th class="text-center">Note</th>
                                <th class="text-center">Ranges</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <td><?php echo $test->test_area;?></td>
                                <td><?php echo $test->test_method;?></td>
                                <td><?php echo $test->test_name."(".$test->lab_unit.")";?></td>
                                <td class="text-center"><?php if($test->binary_result) { ?> <i class="fa fa-check"></i><?php } ?></td>
                                <td class="text-center"><?php if($test->numeric_result) { ?> <i class="fa fa-check"></i><?php } ?></td>
                                <td class="text-center"><?php if($test->text_result) { ?> <i class="fa fa-check"></i><?php } ?></td>
                                <td class="text-right"><?php echo $test->comments;?></td>
                                <td class="text-right"><?php echo $test->ranges_count;?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-body">
                    <h3>Ranges</h3>
                    <table class="table table-bordered table-striped" id="table-sort">
                        <thead>
                            <tr>
                                <th class="text-center" rowspan="2">Gender</th>
                                <th class="text-center" rowspan="2">Age Type</th>
                                <th class="text-center" colspan="3">From</th>
                                <th class="text-center" colspan="3">To</th>
                                <th class="text-center" rowspan="2">Range Type</th>
                                <th class="text-center" rowspan="2">Minimum Value</th>
                                <th class="text-center" rowspan="2">Maximum Value</th>
                            </tr>
                            <tr>
                                <th class="text-center">Year</th>
                                <th class="text-center">Month</th>
                                <th class="text-center">Day</th>
                                <th class="text-center">Year</th>
                                <th class="text-center">Month</th>
                                <th class="text-center">Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($test_ranges as $test_range){
                                    if($test->test_master_id==$test_range->test_master_id){?>
                            <tr>
                                <td><?php if($test_range->gender==1){echo "Male";}else if($test_range->gender==2){echo "Female";}else if($test_range->gender==3){echo "Both";}?></td>
                                <?php if($test_range->age_type==2){?>
                                <td><?php echo "Age greater than";?></td>
                                <td class="text-right"><?php echo $test_range->from_year;?></td>
                                <td class="text-right"><?php echo $test_range->from_month;?></td>
                                <td class="text-right"><?php echo $test_range->from_day;?></td>
                                <td class="text-center"> -- </td>
                                <td class="text-center"> -- </td>
                                <td class="text-center"> -- </td>
                                <?php } else if($test_range->age_type==1){?>
                                <td><?php echo "Age less than";?></td>
                                <td class="text-center"> -- </td>
                                <td class="text-center"> -- </td>
                                <td class="text-center"> -- </td>
                                <td class="text-right"><?php echo $test_range->to_year;?></td>
                                <td class="text-right"><?php echo $test_range->to_month;?></td>
                                <td class="text-right"><?php echo $test_range->to_day;?></td>
                                <?php }
                                    else if($test_range->age_type==3){ ?>
                                <td><?php echo "Age in range";?></td>
                                <td class="text-right"><?php echo $test_range->from_year;?></td>
                                <td class="text-right"><?php echo $test_range->from_month;?></td>
                                <td class="text-right"><?php echo $test_range->from_day;?></td>
                                <td class="text-right"><?php echo $test_range->to_year;?></td>
                                <td class="text-right"><?php echo $test_range->to_month;?></td>
                                <td class="text-right"><?php echo $test_range->to_day;?></td>
                                <?php } ?>
                                
                                
                                <?php if($test_range->range_type==1){ ?>
                                <td><?php echo "Value less than";?></td>
                                <td class="text-center"> -- </td>
                                <td class="text-right"><?php echo $test_range->min;?></td>                                
                                <?php }                                 
                                else if($test_range->range_type==2){ ?>
                                <td><?php echo "Value greater than"; ?> </td>
                                <td class="text-center"> -- </td>
                                <td class="text-right"><?php echo $test_range->max;?></td>
                               <?php }
                                else if($test_range->range_type==3){  ?>
                                <td><?php echo "Value within range"; ?> </td>
                                <td class="text-right"><?php echo $test_range->min;?></td> 
                                <td class="text-right"><?php echo $test_range->max;?></td>
                                <?php }?>                             
                            </tr> 
                                  <?php }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     <?php                
        }
    }else { ?>
No tests set to date.
<?php } ?>
</div>