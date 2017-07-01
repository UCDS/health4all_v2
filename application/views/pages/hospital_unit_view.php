<div class="center-block">
	<div class="col-xs-4 col-md-2 sidebar-left">
		<ul class="nav nav-sidebar">
    		<li class="nav-header" style="font-size:20px;font-style:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add
			<li <?php if(preg_match("^hospital_units/add_unit$^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>equipments/add/" style="font-size:15px;font-style:bold"><i class="fa fa-hospital-o fa-lg"style="color:red"></i>&nbsp;&nbsp;&nbsp;Hospital</a></li>
			<li <?php if(preg_match("^add_hospital_units^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>hospital_units/add_unit" style="font-style:bold;font-size:15px"><i class="fa fa-medkit fa-lg"style="color:red"></i>&nbsp;&nbsp;Department</a></li>
			<li <?php if(preg_match("^add_hospital_units^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>hospital_units/add_unit/hospital_unit_view"style="font-style:bold;font-size:15px"><i class="fa fa-building-o fa-lg"style="color:red" aria-hidden="true"></i>&nbsp;&nbsp;Units</a></li>
			<li <?php if(preg_match("^add_hospital_areas^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>hospital_area/add_area/hospital_area_view" style="font-style:bold;font-size:15px"><i class="fa fa-map-marker fa-2x" style="color:red"></i></i> &nbsp;&nbsp;&nbsp;Areas</a></li>
		<ul>
	</div>
	<h2 align="center">UNIT DETAILS</h2><br>
	<strong><?php if (isset($message)){
		if($message=="unit added succesfully.")
			{
				$color="green";
			}
			else
				{
					$color="red";
				}
			 echo "<center><font style='color:".$color.";font-size:30px;'>".$message."</font></center>";
		}?></strong>
		<?php   echo form_open('hospital_units/add_unit',array('class'=>'form-group','role'=>'form')); ?>
			<div class = "col-md-8 col-md-offset-3">
				<div class="row">
					<div class = "col-xs-12 col-sm-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="inputunit_head_staff_id" >Unit Head Staff</label>
							<input type="text" class="form-control" placeholder="Unit Head Staff id"name="unit_head_staff_id" id="inputunit_head_staff_id" >
						</div>
					</div>
					<div class = "col-xs-12 col-sm-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="inputunit_name" >Unit Name</label>
							<input type="text" class="form-control" placeholder="Unit Name"name="unit_name" id="unit_name">
						</div>
					</div>
					<div class = "col-xs-12 col-sm-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="inputdepartment_id" >Department</label>
							<input type="text" class="form-control" placeholder="Department id"name="department_id" id="inputdepartment_id">
						</div>
				   </div>
					<div class = "col-xs-12 col-sm-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="beds" >Beds</label>
							<input type="text" class="form-control" placeholder="Bed id"name="Beds" id="beds">
						</div>
					</div>
					<div class = "col-xs-12 col-sm-12 col-md-6 col-lg-4">
						<div class="form-group">
							<label for="inputop_room_no" >Lab Report Staff</label>
							<input type="text" class="form-control" placeholder="Lab Report Staff id"name="lab_report_staff_id" id="inputlab_report_staff_id">
						</div>
					</div>
				</div>
				<div class = "col-md-4 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<center><button class="btn btn-default" type="submit" name="Submit" id="btn">Submit</button></center>
						</div>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
					
					
					
