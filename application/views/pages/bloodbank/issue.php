<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
 <script type="text/javascript"
 src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
<script>
	$(function(){
		$("#issue_date").Zebra_DatePicker({
			direction:false
		});
		$("#issue_time").timeEntry();
		$("#show_universal").click(function(){
			$('.universal').toggle('slow');
		});
		$(".select_component").click(function(){
		var blood_unit=[];
			$(".select_component").each(function(){
				if($(this).is(":checked")){
					blood_unit.push($(this).parent().parent().find("td:eq(0)").text()+" - "+$(this).parent().parent().find("td:eq(1)").text());
				}
				$(".selected_components").text("");
				for($i=0;$i<blood_unit.length;$i++){
					$(".selected_components").append("<div class='well well-sm col-md-3'><b>"+blood_unit[$i]+"</b></div>");
				}
			});			
		});
	});
</script>

<div class="col-md-10 col-sm-9">
	<?php
	if(isset($msg)) {
		echo $msg;
		echo "<br />";
		echo "<br />";
	}
	?>
	<div>
	<div class="panel panel-default">
		<div class="panel-heading">
		<?php
		echo form_open('bloodbank/inventory/issue',array('id'=>'issue_form'));
		foreach($request as $request){
				echo "<input type='text' value='$request[request_id]' hidden name='request_id' />";
				echo "Request ID: ".$request['request_id']."<br />Requested for ";
				echo "Blood Group: <b>$request[blood_group] ";
				if($request['whole_blood_units']!=0){
					echo "| WB: ".$request['whole_blood_units'];
					echo "<input type='text' value='WB' hidden name='components[]' /> | ";
				}
				if($request['packed_cell_units']!=0){
					echo "| PC: ".$request['packed_cell_units'];
					echo "<input type='text' value='PC' hidden name='components[]' /> | ";
				}
				if($request['fp_units']!=0){
					echo "| FP: ".$request['fp_units'];
					echo "<input type='text' value='FP' hidden name='components[]' /> | ";
				}
				if($request['ffp_units']!=0){
					echo "| FFP: ".$request['ffp_units'];
					echo "<input type='text' value='FFP' hidden name='components[]' /> | ";
				}
				if($request['prp_units']!=0){
					echo "| PRP : ".$request['prp_units'];
					echo "<input type='text' value='PRP' hidden name='components[]' /> | ";
				}
				if($request['platelet_concentrate_units']!=0){
					echo "| Platelet Concentrate: ".$request['platelet_concentrate_units'];
					echo "<input type='text' value='Platelet Concentrate' hidden name='components[]' /> | ";
				}
				if($request['cryoprecipitate_units']!=0){
					echo "| Cryo: ".$request['cryoprecipitate_units'];
					echo "<input type='text' value='Cryo' hidden name='components[]' /> | ";
				}
				echo "</b><br />";
		}
		?>
		</div>
	<div class="panel-body">
	<?php
	if(count($inv)>0){
	?>
	
	<table class='table table-bordered table-striped'>
		<tr><th colspan="10">Inventory</th></tr>
	<tr><th>Blood Unit No.</th><th>Component</th><th>Blood Group</th><th>Expiry Date</th></tr>
	<?php
	foreach($inv as $i){
	?>
		<tr class="universal">
			<td><?php echo $i['blood_unit_num'];?></td>
			<td><?php echo $i['component_type'];?></td>
			<td><?php echo $i['blood_group'];?></td>
			<td><?php echo date("d-M-Y",strtotime($i['expiry_date']));;?></td>
			<td><input type="checkbox" value="<?php echo $i['inventory_id'];?>" name="inventory_id[]" class="select_component" /></td>
		</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="10">
		<br />
		<br />
		<br />
		<br />
			<div class="panel panel-success">
				<div class="panel-heading">
				Selected : 
				<div class="row">
					<div class="selected_components col-md-12">
					</div>
				</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-striped">
					<tr>
						<td>
								<select name="staff" class="form-control" required >
									<option value="" disabled selected>Issued By</option>
									<?php foreach($staff as $s){
										echo "<option value='$s->staff_id'>$s->first_name $s->last_name</option>";
									}
									?>
								</select><br />
								<select name="cross_matched_by" class="form-control" required>
									<option value="" disabled selected>Cross Matched By</option>
									<?php foreach($staff as $s){
										echo "<option value='$s->staff_id'>$s->first_name $s->last_name</option>";
									}
									?>
								</select>
						</td>
						<td colspan="2">
						<input type="text" size="12" name="issue_date" class="form-control" placeholder="Date" id="issue_date" form="issue_form" required /><br />
						<input type="text" size="12" name="issue_time" class="form-control" placeholder="Time" id="issue_time" form="issue_form" required />
						</td>
						<td>Sign</td>
					</tr>
					<tr>
						<td colspan="3" align="middle">
						<input type="submit" class="btn btn-primary btn-md" value="Issue" name="issue_request" />
						</td>
					</tr>
					</table>
				</div>
			</div>
		</td>
	</tr>
	</table>
	</form>
	<?php
	}
	else{
		echo "Required components are not available in inventory!";
	}
	?>
	</div>
	</div>
</div>

