
<div class="col-md-10 col-md-offset-2">
<?php 	echo validation_errors(); ?>
<?php if(isset($msg)){ ?> 
	<div class="alert alert-info"> <?php echo $msg;?>
	</div>
	<?php  }?>
<br>
<?php if(isset($order)){ ?>
	<?php echo form_open('diagnostics/view_orders',array('role'=>'form','class'=>'form-custom','id'=>'order_submit'));?>
		
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
					<b>Patient Number : </b>
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
			<?php 
			$groups=array();
			$group_tests=array();
			$i=0;
			foreach($order as $test){
				if($test->group_id!=0){
					$groups[]=$test->group_id;
					$group_tests[]=array(
						'group_id'=>$test->group_id,
						'test_id'=>$test->test_id,
						'test_name'=>$test->test_name,
						'test_status'=>$test->test_status,
						'binary_result'=>$test->binary_result,
						'numeric_result'=>$test->numeric_result,
						'text_result'=>$test->text_result,
						'test_result_binary'=>$test->test_result_binary,
						'test_result'=>$test->test_result,
						'test_result_text'=>$test->test_result_text,
						'binary_postitive'=>$test->binary_positive,
						'binary_negative'=>$test->binary_negative,
						'lab_unit'=>$test->lab_unit
					);
					array_splice($order,$i,1);
					$i--;
				}
				$i++;
			}
			$groups=array_unique($groups);
			foreach($groups as $group){
				echo $group;
			}
			foreach($order as $test){ 
					$positive="";$negative="";
				 if($test->test_status==1){ $readonly = "disabled"; }else $readonly="";
			?>
				<div class="panel panel-warning col-md-12">
					<h4>
						<?php echo $test->test_name;?>
					</h4>
					<?php if($test->binary_result==1){ ?>
					<div class="col-md-4">
						<?php if($test->test_status == 1) { if($test->test_result_binary == 1 ) $positive="checked" ; else $negative = "checked" ; } ?>
							<input type="radio" value="1" id="binary_result_pos" form='order_submit' name="binary_result_<?php echo $test->test_id;?>" <?php echo $readonly." ".$positive;?> />
							<label for="binary_result_pos"><?php echo $test->binary_positive;?></label>
							<input type="radio" value="0" id="binary_result_neg" form='order_submit'  name="binary_result_<?php echo $test->test_id;?>" <?php echo $readonly." ".$negative;?> />
							<label for="binary_result_neg"><?php echo $test->binary_negative;?></label>
					</div>
					<?php } ?>
					<?php if($test->numeric_result==1){ ?>
					<div class="col-md-4" class="form-group">
							<input type="number" class="form-control" placeholder="Numeric" style="width:100px" form='order_submit' name="numeric_result_<?php echo $test->test_id;?>" step="any" value="<?php echo $test->test_result;?>" <?php echo $readonly;?> />
							<label class="control-label"><?php echo $test->lab_unit;?></label>
					</div>
					<?php } ?>
					<?php if($test->text_result==1){ ?>
					<div class="col-md-4">
							<textarea name="text_result_<?php echo $test->test_id;?>" class="form-control" form='order_submit' placeholder="Descriptive result" value="<?php echo $test->test_result_text;?>"  <?php echo $readonly;?>></textarea>
					</div>
					<?php } ?>
			<input type="text" value="<?php echo $test->test_id;?>" name="test[]" class="sr-only hidden" />
				</div>
			<?php } ?>
			
		</div>
		<div class="panel-footer">
			<input type="text" value="<?php echo $test->order_id;?>" form='order_submit' name="order_id" class="sr-only hidden" />
			<input type="submit" value="Submit" class="btn btn-primary btn-md col-md-offset-5" form='order_submit'  name="submit_results" />
		</div>
	</div>
		
<?php	
	}
	else{
?>
<?php if(count($test_areas)>1){ ?>
	<?php echo form_open('diagnostics/view_orders',array('role'=>'form'));?>
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
	</form>
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
							<?php echo form_open('diagnostics/view_orders',array('role'=>'form','class'=>'form-custom')); ?>
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
												$label="label-success";
											else $label = "label-danger";
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
		echo "No orders to update";
	}
} 
?>
</div>
