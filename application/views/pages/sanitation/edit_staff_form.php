	
	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3><u>Edit Staff</u></h3></center><br>
	<?php echo form_open('masters/edit/Staff',array('role'=>'form')); ?>





		<div class="form-group">
		<label for="agency_name" class="col-md-4">first Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="first Name" id="first_name" name="first_name" 
		<?php if(isset($staff)){
			echo "value='".$staff[0]->first_name."' ";
			}
		?>
		/>
		<?php if(isset($staff)){ ?>
		<input type="hidden" value="<?php echo $staff[0]->staff_id;?>" name="staff_id" />
		
	 <?php } ?>
		</div>
	</div>

			
	
	</div></div>
   		<div class="col-md-3 col-md-offset-4"><div  class="col-md-8">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div></div>
	
   	</form>
	<?php } ?>
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('masters/edit/staff',array('role'=>'form','id'=>'search_form','class'=>'form-inline','name'=>'search_staff'));?>
	<h3> Search Staff </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>

		<td>
<input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" >
		
<!--	<select name="department_name" id="search_department_name" form='search_form' class="form-control" style="width:180px">
		<option value="" disabled selected>Department</option>
		<?php foreach($department as $department_name){
	echo "<option value='$firts_name->staff_id'>$first_name->first_name</option>";
		}
		?>
		</select>--></td>		
		   	<div class="col-md-3 col-md-offset-4"><div class="col-md-8">

		<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of Staff</h3>
	<div class="col-md-12 "><strong>
	<?php if($this->input->post('first_name')) echo "first name starting with : ".$this->input->post('first_name'); ?>
	</strong>
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>First Name </th><th>
	</thead>
	<?php 
	$i=1;
	foreach($staff as $a){ ?>
	<?php echo form_open('masters/edit/staff',array('id'=>'select_staff_form_'.$a->staff_id,'role'=>'form')); ?>
	<tr onclick="$('#select_staff_form_<?php echo $a->staff_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $a->first_name; ?>
		<input type="hidden" value="<?php echo $a->staff_id; ?>" name="staff_id" />
		<input type="hidden" value="select" name="select" />
		</td>
		<td><?php echo $a->first_name; ?></td>
		
			</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div></div>