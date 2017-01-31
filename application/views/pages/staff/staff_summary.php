<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>


<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>

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

//create function for  for Excel report
  function fnExcelReport() {
      //created a variable named tab_text where 
      
    var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    //row and columns arrangements
    tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
    tab_text = tab_text + '<x:Name>Excel Sheet</x:Name>';

    tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
    tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

    tab_text = tab_text + "<table border='100px'>";
    //id is given which calls the html table
    tab_text = tab_text + $('#table-sort').html();
    tab_text = tab_text + '</table></body></html>';
    var data_type = 'data:application/vnd.ms-excel';
    $('#test').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
    //downloaded excel sheet name is given here
    $('#test').attr('download', 'staff_detailed.xlsx');

  }

</script>
	

	<script type="text/javascript">
	$(function(){
		$("#date_of_birth").Zebra_DatePicker();
		$("#department").on('change',function(){
			var department_id=$(this).val();
			$("#unit option,#area option").hide();
			$("#unit option[class="+department_id+"],#area option[class="+department_id+"]").show();
		});
	});
	</script>

	<?php 
	
		if($this->input->post('sub_by')){
			$sub_by = $this->input->post('sub_by');
		}
		else $sub_by = 'area_id';
	?>
<div class="col-md-offset-2 col-md-10">
<div class="panel panel default">
	<div class="panel-body">
	<?php echo form_open('staff/summary',array('class'=>'form-custom','role'=>'form')); ?>
		<div class="row">
					<select name="department_id" id="department" class="form-control">
					<option value="">Department</option>
					<?php 
					foreach($department as $dept){
						echo "<option value='".$dept->department_id."'";
						if($this->input->post('department_id') && $this->input->post('department_id') == $dept->department_id) echo " selected ";
						echo ">".$dept->department."</option>";
					}
					?>
					</select>
					<select name="area_id" id="area" class="form-control">
					<option value="">Area</option>
					<?php 
					foreach($area as $ar){
						echo "<option value='".$ar->area_id."'";
						if($this->input->post('area_id') && $this->input->post('area_id') == $ar->area_id) echo " selected ";
						echo ">".$ar->area_name."</option>";
					}
					?>
					</select>
					
					<select name="designation" id="designation" class="form-control">
					<option value="">Designation</option>
					<?php 
					
					foreach($designation as $des){
						echo "<option value='".$des->designation."'";
						if($this->input->post('designation') && $this->input->post('designation') == $des->designation) echo " selected ";
						echo ">".$des->designation."</option>";
					}
					?>
					</select>
					
					<select name="staff_category" id="staff_category" class="form-control">
					<option value="">Staff Category</option>
					<?php 
					foreach($staff_category as $staff_cat){
						echo "<option value='".$staff_cat->staff_category_id."'";
						if($this->input->post('staff_category') && $this->input->post('staff_category') == $staff_cat->staff_category_id) echo "selected ";
						echo ">".$staff_cat->staff_category."</option>";
					}
					?>
					</select>					
					
					<select name="gender" id="gender" class="form-control">
						<option value="">Gender</option>
						<option value ="M" <?php if($this->input->post('gender') && $this->input->post('gender')=='M') echo "selected ";?>>Male</option>
						<option value ="F" <?php if($this->input->post('gender') && $this->input->post('gender')=='F') echo "selected ";?>>Female</option>
					</select>
					
					<select name="mci_flag" id="mci_flag" class="form-control">
						<option value="">MCI</option>
						<option value ="1" <?php if($this->input->post('mci_flag') && $this->input->post('mci_flag')==1) echo "selected ";?>>Yes</option>
						<option value ="0" <?php if($this->input->post('mci_flag') && $this->input->post('mci_flag')==0) echo "selected ";?>>No</option>
					</select>
					
					<input name="search_staff" value="true" type="hidden"></input>
					<br />
					<br />
		</div>
		Sub Group By
		<select name="sub_by" class="form-control">
			<option value="area_id" <?php if($sub_by == 'area_id') echo " selected "; ?>>Area</option>
			<option value="department_id" <?php if($sub_by == 'department_id') echo " selected "; ?>>Department</option>
			<option value="unit_id" <?php if($sub_by == 'unit_id') echo " selected "; ?>>Unit</option>
			<option value="staff_category_id" <?php if($sub_by == 'staff_category_id') echo " selected "; ?>>Staff Category</option>
		</select><br /><br />
		<input type="submit" class="btn btn-sm btn-info"  value="Go" />
	</form>
	</div>
</div>
	<div class="text-right" style="float:right">
		<button class="text-right btn btn-default btn-sm print"><span class="glyphicon glyphicon-print" title="Print"></span></button>
		<a class="text-right btn btn-default btn-sm" id="test" onClick="javascript:fnExcelReport();" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span></a>
	</div>
<h3>Staff Summary</h3>
<table class="table table-bordered table-striped" id="table-sort">
	<thead>
		<th>#</th>
		<th>Department</th>
		<th>Unit</th>
		<th>Area</th>
		<th>Designation</th>
		<th>Staff Category</th>
		<th>Count</th>
	</thead>
	<tbody>
		<?php 
		$i=1;
		$sub_category=array();
		$total=0;
		foreach($summary as $s){
		if(!in_array($s->$sub_by,$sub_category)){
			$sub_category[]=$s->$sub_by;
			if($i>1){ 
				$total += ${$sub_by.'_sub_total'};
			?>
				<tr>
					<th colspan="6" class="text-right">Sub Total</th>
					<th class="text-right"><?php echo ${$sub_by.'_sub_total'};?></th> 
				</tr>
			<?php 
			}
			${$sub_by.'_sub_total'}=$s->count;
		}
		else{
			${$sub_by.'_sub_total'}+=$s->count;
		}
		$s->designation != ""?$designation=$s->designation:$designation="";
		?>
		<tr>
			<td>
				<?php echo $i;?>
				<?php echo form_open('staff/view/view_staff',array('class'=>'form-custom','id'=>"detail_$i",'role'=>'form')); ?>
				<input type="text" class="sr-only" hidden value="<?php echo $s->department_id;?>" name="department_id" />
				<input type="text" class="sr-only" hidden value="<?php echo $s->unit_id;?>" name="unit_id" />
				<input type="text" class="sr-only" hidden value="<?php echo $s->area_id;?>" name="area_id" />
				<input type="text" class="sr-only" hidden value="<?php echo $designation;?>" name="designation" />
				<input type="text" class="sr-only" hidden value="<?php echo $s->staff_category_id;?>" name="staff_category" />
				<input type="text" class="sr-only" hidden value="search" name="search_staff" />
				<input type="submit" name="submit_form" class="sr-only" hidden form />
				</form>
			</td>
			<td><?php echo $s->department;?></td>
			<td><?php echo $s->unit_name;?></td>
			<td><?php echo $s->area_name;?></td>
			<td><?php echo $s->designation;?></td>
			<td><?php echo $s->staff_category;?></td>
			<td class="text-right" onclick="$('#detail_<?php echo $i;?>').submit();" style="cursor:pointer" ><a href="#"><?php echo $s->count;?></a></td>
		</tr>
		<?php
			$i++;
			if($i>count($summary)){ 				
			$total += ${$sub_by.'_sub_total'};
		?>
				<tr>
					<th colspan="6" class="text-right">Sub Total</th>
					<th class="text-right"><?php echo ${$sub_by.'_sub_total'};?></th> 
				</tr>
				<tr>
					<th colspan="6" class="text-right">Total</th>
					<th class="text-right"><?php echo $total;?></th> 
				</tr>
			<?php 
			}
		} ?>
	</tbody>
</table>
</div>	
	