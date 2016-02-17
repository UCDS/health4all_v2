<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.widgets.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.colsel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.tablesorter.print.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/theme.default.css" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
<script type="text/javascript">
$(document).ready(function(){$("#from_date").datepicker({
		dateFormat:"dd-M-yy",changeYear:1,changeMonth:1,onSelect:function(sdt)
		{$("#to_date").datepicker({dateFormat:"dd-M-yy",changeYear:1,changeMonth:1})
		$("#to_date").datepicker("option","minDate",sdt)}})
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
<style>
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{ color:black;
    text-shadow:0px 1px #388DBE;
    border:1px solid #bbb; 
    background:#F9F9F9; 
    background:-moz-linear-gradient(#F9F9F9);
    background:-webkit-gradient(#F9F9F9));
}
ul.tsc_pagination li a
{ 
    color:#333;
    border:1px solid #bbb;
    background:#EEEEEE; 
}
#div1{
	opacity:0.8;
}
</style>
<div class="col-md-10 col-sm-9">
<?php
	$search=$this->input->post('search');
      if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date('Y-m-d',strtotime($this->input->post('from_date')));
			$to_date=date('Y-m-d',strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
		 $this->input->post('from_date')==""?$date=$this->input->post('to_date'):$date=$this->input->post('from_date');
		 }
		else if( (!$search && isset($from_date) && isset($to_date) ) == false){
			$from_date=date('Y-m-d',strtotime('-90 Days'));
			$to_date=date('Y-m-d');
		}
		?>
	<div>
		<?php echo form_open('bloodbank/user_panel/report_screening',array('role'=>'form','class'=>'form-custom')); ?>
		<div>
			From Date : <input class="form-control" style = "background-color:#EEEEEE" type="text" value="<?php echo date("d-M-Y",strtotime($from_date)); ?>" name="from_date" id="from_date" size="15" />
			To Date : <input  class="form-control" type="text" style = "background-color:#EEEEEE" value="<?php echo date("d-M-Y",strtotime($to_date)); ?>" name="to_date" id="to_date" size="15" />
			<select class="form-control" style = "background-color:#EEEEEE" name="screened_by">
					<option class="form-control" value="" disabled selected>Done By</option>
					<?php foreach($staff as $s){
						echo "<option value='$s->staff_id'>$s->name</option>";
					}
					?>
			</select>
			<input type="submit" class="form-control" value="Search" style = "background-color:#EEEEEE" name="search" />
		</div>
		</form>
		<?php
		if(isset($msg)) {
			echo $msg;
			echo "<br />";
			echo "<br />";
		}
		?>
		<?php if(count($screened)>0){ ?>
		
		<table class="table table-bordered table-striped"></table>
		<button type="button" class="btn btn-default btn-md print">
		  <span class="glyphicon glyphicon-print"></span> Print
		</button>
		<div id="pagination">
        <ul class="tsc_pagination">
		<?php 
		foreach($page1 as $d)
		{
			echo '<li>'.$d.'<li>';
		}
	    ?>
		</ul>	
		</div>
		<div id="div1">
		<?php		
      $counttotal1=$counttotal;	
      $limit=$limit;
      $val2=$offset*$limit;
	  if($val2<$counttotal) {
			echo'&nbsp&nbsp&nbsp'.'Showing   '.((($offset*$limit)-$limit)+1) .'  to    '.(($offset*$limit)).'  out off '.$counttotal;
		}
      else
		  echo '&nbsp&nbsp&nbsp'.'Showing   '.((($offset*$limit)-$limit)+1) .'  to   '.$counttotal.'  out off '.$counttotal;
					?>	
					</div>
		<table class="table table-bordered table-striped" id="table-sort">
		<thead><th>S.No</th><th>Date</th><th>Blood Unit No.</th><th>Donor Name</th><th>Blood Group</th><th>HIV</th><th>HBSAG</th><th>HCV</th><th>VDRL</th><th>MP</th><th>Irregular Ab</th><th>Screened By</th></thead>
		<?php 
		$i=1;
		foreach($screened as $row){
		?>
		<tr>
			<td><?php echo $i++;?></td>
			<td><?php echo date("d-M-Y",strtotime($row->screening_datetime));?></td>
			<td><?php echo $row->blood_unit_num;?></td>
			<td><?php echo $row->name;?></td>
			<td><?php echo $row->blood_group;?></td>
			<td><?php if($row->test_hiv==1) echo "Yes"; else echo "NR";?></td>
			<td><?php if($row->test_hbsag==1) echo "Yes"; else echo "Neg";?></td>
			<td><?php if($row->test_hcv==1) echo "Yes"; else echo "NR";?></td>
			<td><?php if($row->test_vdrl==1) echo "Yes"; else echo "NR";?></td>
			<td><?php if($row->test_mp==1) echo "Yes"; else echo "NF";?></td>
			<td><?php if($row->test_irregular_ab==1) echo "Yes"; else echo "Neg";?></td>
			<td><?php echo $row->staff_name;?></td>
			</tr>
		<?php 
		}
		?>
		</table>
		<div id="pagination">
        <ul class="tsc_pagination">
		<?php 
		foreach($page1 as $d)
		{
			echo '<li>'.$d.'<li>';
		}
	    ?>
		</ul>	
		</div>
		<div id="div1">
		<?php		
      $counttotal1=$counttotal;	
      $limit=$limit;
      $val2=$offset*$limit;
	  if($val2<$counttotal) {
			echo'&nbsp&nbsp&nbsp'.'Showing   '.((($offset*$limit)-$limit)+1) .'  to    '.(($offset*$limit)).'  out off '.$counttotal;
		}
      else
		  echo '&nbsp&nbsp&nbsp'.'Showing   '.((($offset*$limit)-$limit)+1) .'  to   '.$counttotal.'  out off '.$counttotal;
					?>	
					</div>
		<?php }
		else{
			 ?>
			 <p>No screening record in the specified period.</p>
		<?php } ?>
	</div>
</div>

