<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >
<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>

<div class="col-md-8 col-md-offset-2">
	
	
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
	 
	 if((isset($mode))&&(($mode)=="select")){ 
	 //var_dump($unit);
	 //($area); ?>
	<center>	<h3>Edit  Staff </h3></center><br>
	
<div class="col-md-8 col-md-offset-2">
	
	<center>
		<?php echo validation_errors(); ?>
	</center>
	<?php 
	//$staff = $staff[0]; 
	//What is form_open ?
	echo form_open('staff/edit/staff',array('class'=>'form-horizontal','role'=>'form','id'=>'edit_staff')); 
	?>

	<div class="form-group">
		<input type='hidden' name='staff_id' value='<?php echo $staff[0]->staff_id; ?>' />
		<div class="col-md-3">
			<label for="first_name" class="control-label">First Name</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name" required 
			value='<?php echo $staff[0]->first_name; ?>'/>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<label for="last_name" class="control-label">Last Name</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name" 
			value='<?php echo $staff[0]->last_name; ?>'/>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label class="control-label">Gender</label>
		</div>
		<?php $gender = $staff[0]->gender; ?>
		<div class="col-md-6">
			<label class="control-label">
				<input type="radio" name="gender" value="M" 
				<?php 
				if($gender == 'M')
				{
					echo 'checked';
				} ?> 
			/>Male
			</label>
			<label class="control-label">
				<input type="radio" name="gender" value="F" 
				<?php 
				if($gender == 'F')
				{
					echo 'checked';
				} ?> 
				/>Female
			</label>
			<label class="control-label">
				<input type="radio" name="gender" value="O" 
				<?php 
				if($gender == '')
				{
					echo 'checked';
				} ?> 
				/>Other
			</label>
		</div>
	</div>	
	<div class="form-group">
		<div class="col-md-3">
			<label for="date_of_birth" class="control-label" > Date of Birth</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control date" placeholder="Date of Birth" id="date_of_birth" name="date_of_birth" 
			value=<?php echo date("d-M-Y",strtotime($staff[0]->date_of_birth)); ?> />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<label for="department" class="control-label">Department</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="department" name="department" >
				<option value=""> </option>
				<?php foreach($department as $d){
				echo "<option value='$d->department_id'";
				if($staff[0]->department_id == $d->department_id)
				{
					echo ' selected';
				}
				echo ">$d->department";
				
				echo "</option>";
				}?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-3">	
			<label for="unit" class="control-label">Unit</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="unit" name="unit">
				<option value=""> </option>
				<?php foreach($unit as $u){
					echo "<option value='$u->unit_id' class='$u->department_id'";
					if($staff[0]->unit_id == $u->unit_id)
					{
						echo ' selected';
					}
					echo ">$u->unit_name</option>";
				}?>
			</select>
		</div>			
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label for="area" class="control-label">Area</label>
			<?php //var_dump($area); ?>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="area" name="area">
				<option value=""> </option>
				<?php foreach($area as $a){
					echo "<option value='$a->area_id' class='$a->department_id'";
					if($staff[0]->area_id == $a->area_id)
					{
						echo ' selected';
					}
					echo ">$a->area_name</option>";
				}?>
			</select>
		</div>	
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label for="staff_role" class="control-label">Staff Role</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="staff_role" name="staff_role" >
				<option value="">Staff Role</option>
				<?php foreach($staff_role as $sr){
				echo "<option value='$sr->staff_role_id'";
				if($staff[0]->staff_role_id == $sr->staff_role_id)
				{
					echo ' selected';
				}
				echo ">$sr->staff_role</option>";
				}?>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-3">
			<label for="staff_category" class="control-label">Staff Category</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="staff_category" name="staff_category" >
				<option value="">Staff Category</option>
				<?php foreach($staff_category as $sc){
				echo "<option value='$sc->staff_category_id' ";
				
				if($staff[0]->staff_category_id == $sc->staff_category_id)
				{
					echo 'selected';
				}
				echo ">$sc->staff_category</option>";
				}?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<label for="designation" class="control-label">Designation</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Designation" id="designation" name="designation"
			value='<?php echo $staff[0]->designation; ?>'
			  />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-3">
			<label for="staff_type" class="control-label">Staff Type</label>
		</div>
		<div class="col-md-6">
			<select class="form-control" id="staff_type" name="staff_type">
				<option value="">Staff Type</option>
				<option value="On Rolls">On Rolls</option>
				<option value="Contract">Contract</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-3">
			<label for="email" class="control-label">Email</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Email" id="email" name="email" 
			value='<?php echo $staff[0]->email; ?>'/>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<label for="phone" class="control-label">Phone</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" 
			value='<?php echo $staff[0]->phone; ?>'/>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-3">
			<label for="specialisation" class="control-label">Specialisation</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Specialisation" id="specialisation" name="specialisation" 
			value='<?php echo $staff[0]->specialisation; ?>'/>
		</div>
	</div>		
	
	<div class="form-group">
		<div class="col-md-3">
			<label for="research_area" class="control-label">Research Areas</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Research Areas" id="research_area" name="research_area" 
			value='<?php echo $staff[0]->research_area ?>'/>
		</div>
	</div>		
	
	<div class="form-group">
		<div class="col-md-3">
			<label for="research" class="control-label">Research</label>
		</div>
		<div class="col-md-6">
			<input type="text" class="form-control" placeholder="Research" id="research" name="research" 
			value='<?php echo $staff[0]->research ?>'/>
		</div>
	</div>		
		
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>

	
   	
	</form>
	<?php } ?>
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('staff/edit/staff',array('role'=>'form','id'=>'search_form','class'=>'form-inline','name'=>'search_staff'));?>
	<h3> Search Staff </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td><input type="text" class="form-control" placeholder="Staff" id="staff" name="staff"> 
		
		
				<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode)&&$mode=="search"){    ?>

	<h3 class="col-md-12">List of Staff</h3>
	<div class="col-md-12 ">
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>Staff Name </th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($staff as $a){ ?>
	<?php echo form_open('staff/edit/staff',array('id'=>'select_staff_form_'.$a->staff_id,'role'=>'form')); ?>
	<tr onclick="$('#select_staff_form_<?php echo $a->staff_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $a->first_name; ?>
		<input type="hidden" value="<?php echo $a->staff_id; ?>" name="staff_id" />
		<input type="hidden" value="select" name="select" />
		</td>
			</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div></div>
