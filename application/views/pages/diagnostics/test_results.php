<script>

<!-- Scripts for printing output table -->
function printDiv(i)
{
var content = document.getElementById(i);
var pri = document.getElementById("ifmcontentstoprint").contentWindow;
pri.document.open();
pri.document.write(content.innerHTML);
pri.document.close();
pri.focus();
pri.print();
}
</script>
<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute;display:none"></iframe>

<div class="col-md-10 col-md-offset-2">
<?php 	echo validation_errors(); ?>
<?php if(isset($msg)){ ?> 
	<div class="alert alert-info"> <?php echo $msg;?>
	</div>
	<?php  }?>
<br>
<?php if(isset($order)){ ?>
		
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Order #<?php echo $order[0]->order_id;?>
			<small>
					<b>Order placed at : </b>
					<?php echo date("g:ia, d-M-Y",strtotime($order[0]->order_date_time));?>
			</small>
			</h4>
		</div>
		<div class="panel-body">
			<div class="row col-md-12">
				<div class="col-md-4">
					<b>Patient Name : </b>
					<?php echo $order[0]->first_name;?>
				</div>
				<div class="col-md-4">
					<b>Patient Type : </b>
					<?php echo $order[0]->visit_type;?>
				</div>
				<div class="col-md-4">
					<b><?php echo $order[0]->visit_type;?> Number : </b>
					<?php echo $order[0]->hosp_file_no;?>
				</div>
			</div>
			<div class="row col-md-12">
				<div class="col-md-4">
					<b>Department : </b>
					<?php echo $order[0]->department;?>
				</div>
				<div class="col-md-4">
					<b>Order By : </b>
					<?php echo $order[0]->staff_name;?>
				</div>
			</div>
			<br />
			<br />
			<br />
			<table class="table table-bordered">
				<th>Test</th>
				<th>Value</th>
				<th colspan="2">Report</th>				
			<?php foreach($order as $test){ 
					$positive="";$negative="";
				 if($test->test_status==2){ $readonly = "disabled"; }else $readonly="";
			?>
			<tr>
					<td>
						<?php echo $test->test_name;?>
					</td>
					<td>
					<?php if($test->numeric_result==1){ 

							if($test->test_status == 2) { 
								$result=$test->test_result." ".$test->lab_unit; 
							} 
							else{	
								$result="Test not done.";
							}
							echo $result;
						}
								else echo "-";
					 ?>
					</td>
					<td>
					<?php if($test->binary_result==1){ ?>
						<?php 
							if($test->test_status == 2) { 
								if($test->test_result_binary == 1 ) $result=$test->binary_positive ; 
								else $result=$test->binary_negative ; 
							} 
							else{	
								$result="Test not done.";
							}
						echo $result;
						?>
					<?php 
					}
						else echo "-";
					?>
					 </td>
					 <td>
					<?php if($test->text_result==1){ 

						if($test->test_status == 2) { 
							echo $test->test_result_text;
						} 
						else{	
							$result="Test not done.";
						}
						echo $result;
					 }
								else echo "-"; ?>
					 </td>
				</tr>
			<?php } ?>
			
		</table>
		</div>
		<div class="panel-footer">
			<input type="text" value="<?php echo $test->order_id;?>" name="order_id" class="sr-only hidden" />
			<input type="button" value="Print" class="btn btn-primary btn-md col-md-offset-5" name="print_results" onclick="printDiv('print_div')" />
		</div>
	</div>
	
	<div id="print_div" hidden class="sr-only">

					<style media="print">
						html{
							padding:5px;
							width:95%;
							font-size:14px;
						}
						td{
							padding:5px;
						}
						th{
							padding:10px;
						}
						.inner td,.inner th,.inner tr{
							border:1px solid #000;
						}
					</style>
	<table border="0">
		<thead>
			<tr>
			<th style="text-align:center" colspan="10">Department of <?php echo $order[0]->test_area;?></th>
			</tr>
			<tr>
			<th style="text-align:center" colspan="10"><?php echo $order[0]->hospital;?>, <?php echo $order[0]->place;?>, <?php echo $order[0]->district;?>, <?php echo $order[0]->state;?><br /></th>
			</tr>
			<tr>
			<th style="text-align:center" colspan="10"><u><?php echo $order[0]->test_method;?> Results</u><br /></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<b>Patient Name : </b>
					<?php echo $order[0]->first_name;?>
				</td>
				<td>
					<b>Patient Type : </b>
					<?php echo $order[0]->visit_type;?>
				</td>
				<td>
					<b><?php echo $order[0]->visit_type;?> Number : </b>
					<?php echo $order[0]->hosp_file_no;?>
				</td>
			</tr>
				<tr>
				<td>
					<b>Department : </b>
					<?php echo $order[0]->department;?>
				</td>
				<td>
					<b>Order By : </b>
					<?php echo $order[0]->staff_name;?>
				</td>
				<td>
					<b>Ordered On : </b>
					<?php echo date("g:ia, d-M-Y",strtotime($order[0]->order_date_time));?>
				</td>
				</tr>
			<tr>
				<td colspan="10" align="center">
						
					<table class="inner" style="boder:1px solid #ccc; border-collapse:collapse;">
					<thead>
						<th>Test</th>
						<th>Value</th>
						<th colspan="2">Report</th>
					<?php foreach($order as $test){
						$positive="";$negative="";
						 if($test->test_status==2){ $readonly = "disabled"; }else $readonly="";
					?>
							<tr>
								<td>
								<?php echo $test->test_name;?>
								</td>
								<td>
							<?php if($test->numeric_result==1){ 

									if($test->test_status == 2) { 
										$test->test_result?$result=$test->test_result." ".$test->lab_unit : $result=""; 
									} 
									else{
										$result="Test not done.";
									}
									echo $result;
								}
								else echo "-";
							 ?>
								</td>
								<td>
							<?php 
							if($test->text_result==1){ 

								if($test->test_status == 2) { 
									echo $test->test_result_text;
								} 
								else{	
									$result="Test not done.";
								}
								echo $result;
							 }
								else echo "-"; ?>
							</td>
								<td>
							<?php if($test->binary_result==1){ ?>
								<?php 
									if($test->test_status == 2) { 
										if($test->test_result_binary == 1 ) $result=$test->binary_positive ; 
										else $result=$test->binary_negative ; 
									} 
									else{	
										$result="Test not done.";
									}
								echo $result;
								?>
							<?php } ?>
								</td>
						</tr>
					<?php } ?>
					</table>
				<tr></tr>
				<tr>
					<th colspan="3" align="left"> <br /> <br />Technician</th>
					<th colspan="10"> <br /> <br />Doctor  </th>
				</tr>
		</tbody>
	</table>
	</div>
		
<?php	
	}
	else{
?>
<?php if(count($test_areas)>1){ ?>
	<?php echo form_open('diagnostics/view_results',array('role'=>'form'));?>
		<div class="form-group">
			<label for="test_area">Test Area<font color='red'>*</font></label>
			<select name="test_area" class="form-control"  id="test_area">
				<option value="" selected disabled>Select Test Area</option>
				<?php
					foreach($test_areas as $test_area){ ?>
						<option value="<?php echo $test_area->test_area_id;?>"><?php echo $test_area->test_area;?></option>
				<?php } ?>
			</select>
		</div>
		<input type="submit" value="Select" name="submit" class="btn btn-primary btn-md" /> 
<?php
}
if(isset($orders) && count($orders)>0){ ?>
	
<div class="panel panel-default">
	<div class="panel-heading">
		<h4>Test Orders</h4>
	</div>
	<div class="panel-body">
		<table class="table table-bordered table-striped">
		<thead>
			<th>#</th>
			<th>Order ID</th>
			<th>Order By</th>
			<th>Sample Code</th>
			<th>Specimen</th>
			<th>Patient ID</th>
			<th>Patient Name</th>
			<th>Department</th>
			<th>Tests</th>
		</thead>
		<tbody>
			<?php 
			$o=array();
			foreach($orders as $order){
				$o[]=$order->order_id;
			}
			$o=array_unique($o);
			$i=1;
			foreach($o as $ord){	?>
				<tr>
				<?php
				foreach($orders as $order) { 
					if($order->order_id==$ord){ ?>
						<td><?php echo $i++;?></td>
						<td>
							<?php echo form_open('diagnostics/view_results',array('role'=>'form','class'=>'form-custom')); ?>
							<?php echo $order->order_id;?>
							<input type="hidden" class="sr-only" name="order_id" value="<?php echo $order->order_id;?>" />
						</td>
						<td><?php echo $order->staff_name;?></td>
						<td><?php echo $order->sample_code;?></td>
						<td><?php echo $order->specimen_type;?></td>
						<td><?php echo $order->hosp_file_no;?></td>
						<td><?php echo $order->first_name." ".$order->last_name;?></td>
						<td><?php echo $order->department;?></td>
						<td>
							<?php foreach($orders as $order){
										if($order->order_id == $ord) {
											if($order->test_status==1) 
												$label="label-warning";
											else if($order->test_status == 3){ $label = "label-danger";}
											else if($order->test_status == 2){ $label = "label-success";}
											echo "<div class='label $label'>".$order->test_name."</div><br />";
										}
									} 
							?>
						</td>
						<td><button class="btn btn-sm btn-primary" type="submit" value="submit">Select</button></form></td>
				<?php break;
					}
				} ?>
				</tr>
			<?php } ?>
		</tbody>
		</table>
	</div>
	<div class="panel-footer">
		<div class="col-md-offset-4">
		</br>
		
		</div>
	</div>
</div>
<?php 
	}
	else if(isset($orders) && count($orders)==0){
		echo "No results to display";
	}
} 
?>
</div>
