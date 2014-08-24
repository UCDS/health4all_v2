<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript"
 src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script>
	$(function(){
		var anti_a,anti_b,anti_ab,anti_d,a_cells,b_cells,o_cells,du;
		$("#grouping_date").Zebra_DatePicker({
			direction:false
		});
		$(".blood_group").on('change',function(){
			var donation_id=$(this).attr('id').substring(12);
			switch($(this).val()){
				case 'A+':
					anti_a='+';
					anti_b='-';
					anti_ab='+';
					anti_d='+';
					a_cells='-';
					b_cells='+';
					o_cells='-';
					du='+';
					$('#sub_group_'+donation_id).show();
					break;
				case 'A-':
					anti_a='+';
					anti_b='-';
					anti_ab='+';
					anti_d='-';
					a_cells='-';
					b_cells='+';
					o_cells='-';
					$('#sub_group_'+donation_id).show();
					du='-';
					break;
				case 'B+':
					anti_a='-';
					anti_b='+';
					anti_ab='+';
					anti_d='+';
					a_cells='+';
					b_cells='-';
					o_cells='-';
					du='+';
					$('#sub_group_'+donation_id).hide();
					break;
				case 'B-':
					anti_a='-';
					anti_b='+';
					anti_ab='+';
					anti_d='-';
					a_cells='+';
					b_cells='-';
					o_cells='-';
					du='-';
					$('#sub_group_'+donation_id).hide();
					break;
				case 'AB+':
					anti_a='+';
					anti_b='+';
					anti_ab='+';
					anti_d='+';
					a_cells='-';
					b_cells='-';
					o_cells='-';
					$('#sub_group_'+donation_id).show();
					du='+';
					break;
				case 'AB-':
					anti_a='+';
					anti_b='+';
					anti_ab='+';
					anti_d='-';
					a_cells='-';
					b_cells='-';
					o_cells='-';
					du='-';
					$('#sub_group_'+donation_id).show();
					break;
				case 'O+':
					anti_a='-';
					anti_b='-';
					anti_ab='-';
					anti_d='+';
					a_cells='+';
					b_cells='+';
					o_cells='-';
					du='+';
					$('#sub_group_'+donation_id).show();
					break;
				case 'O-':
					anti_a='-';
					anti_b='-';
					anti_ab='-';
					anti_d='-';
					a_cells='+';
					b_cells='+';
					o_cells='-';
					du='-';
					$('#sub_group_'+donation_id).show();
					break;
				default:
					alert('error');
					break;
			}
		set_defaults(donation_id);	
		});
		function set_defaults(donation_id){
			$('#anti_a_'+donation_id).val(anti_a);
			$('#anti_b_'+donation_id).val(anti_b);
			$('#anti_ab_'+donation_id).val(anti_ab);
			$('#anti_d_'+donation_id).val(anti_d);
			$('#a_cells_'+donation_id).val(a_cells);
			$('#b_cells_'+donation_id).val(b_cells);
			$('#o_cells_'+donation_id).val(o_cells);
			$('#du_'+donation_id).val(du);
		}
		
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
		<?php if(count($ungrouped_blood)==0){
			echo "No samples available for grouping.";
		}
		else{
		?>
		<?php echo form_open('bloodbank/inventory/blood_grouping');?>
		<input type="text" id="from_id" placeholder="From" size="7" name="from_id" />
		<input type="text" id="to_id" placeholder="To" size="7" name="to_id" />
		<input type="submit" value="Filter" name="filter" />
		</form>
		<h3>Available samples : </h3>
		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead>
			<th>S.No</th>
			<th>Blood Unit No.</th>
			<th>Blood Group</th>
			<th>Anti A</th>
			<th>Anti B</th>
			<th>Anti AB</th>
			<th>Anti D</th>
			<th>A Cells</th>
			<th>B Cells</th>
			<th>O Cells</th>
			<th>Du</th>
			<th></th>
		</thead>
		<?php echo form_open('bloodbank/inventory/blood_grouping',array('id'=>'grouping_form'));?>
		<?php 
		$i=1;
		foreach($ungrouped_blood as $blood){
		?>
		<tr>
			<td><?php echo $i++;?></td>
			<td>
				<?php echo $blood['blood_unit_num'];?>
			</td>
		<td>
			<select name="blood_group_<?php echo $blood['donation_id'];?>" id="blood_group_<?php echo $blood['donation_id'];?>"  class="blood_group" style="width:50px;">
			<option value="" selected disabled>----</option>
			<option value="A+">A+</option>
			<option value="B+">B+</option>
			<option value="O+">O+</option>
			<option value="AB+">AB+</option>
			<option value="A-">A-</option>
			<option value="B-">B-</option>
			<option value="O-">O-</option>
			<option value="AB-">AB-</option>
			</select>
			<select name="sub_group_<?php echo $blood['donation_id'];?>"  id="sub_group_<?php echo $blood['donation_id'];?>" style="width:50px;" hidden>
			<option value="" selected >Sub Group</option>
			<option value="A1" >A1</option>
			<option value="A2" >A2</option>
			<option value="A1B">A1B</option>
			<option value="A2B">A2B</option>
			<option value="Oh" >Oh</option>
			</select>
		</td>
			<td>
			<input type='text' name='anti_a_<?php echo $blood['donation_id'];?>' id='anti_a_<?php echo $blood['donation_id'];?>' size='2' />
			</td>
			<td><input type='text' name='anti_b_<?php echo $blood['donation_id'];?>' id='anti_b_<?php echo $blood['donation_id'];?>' size='2' /></td>
			<td><input type='text' name='anti_ab_<?php echo $blood['donation_id'];?>' id='anti_ab_<?php echo $blood['donation_id'];?>' size='2' /></td>
			<td><input type='text' name='anti_d_<?php echo $blood['donation_id'];?>' id='anti_d_<?php echo $blood['donation_id'];?>' size='2' /></td>
			<td><input type='text' name='a_cells_<?php echo $blood['donation_id'];?>' id='a_cells_<?php echo $blood['donation_id'];?>' size='2' /></td>
			<td><input type='text' name='b_cells_<?php echo $blood['donation_id'];?>' id='b_cells_<?php echo $blood['donation_id'];?>' size='2' /></td>
			<td><input type='text' name='o_cells_<?php echo $blood['donation_id'];?>' id='o_cells_<?php echo $blood['donation_id'];?>' size='2' /></td>
			<td><input type='text' name='du_<?php echo $blood['donation_id'];?>' id='du_<?php echo $blood['donation_id'];?>' size='2' /></td>
			<td>
			<input type='hidden' value='<?php echo $blood['donor_id'];?>' name='donor_id_<?php echo $blood['donation_id'];?>' size='2' />
			<input type="checkbox" value="<?php echo $blood['donation_id'];?>" name="donation_id[]"  /></td>
		</tr>
		<?php 
		}
		?>
		<tr>
		<td colspan="3" >	
			<select name="forward_by" required>
				<option value="" disabled selected>Forward Done By</option>
				<?php foreach($staff as $s){
					echo "<option value='$s->staff_id'>$s->name</option>";
				}
				?>
			</select>
			<select name="reverse_by" required>
				<option value="" disabled selected>Reverse Done By</option>
				<?php foreach($staff as $s){
					echo "<option value='$s->staff_id'>$s->name</option>";
				}
				?>
			</select>
		</td>
		<td colspan="4" >Date <input type="text" name="grouping_date" id="grouping_date" form='grouping_form' required /></td>
		<td colspan="4" align="right" ><input type="submit" name="Update" value="Update" /></td>
		</tr>
		</form>
		<?php
		}
		?>
</table>
			
	</div>
</div>

