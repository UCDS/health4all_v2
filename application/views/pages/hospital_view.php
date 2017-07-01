  			<div class="center-block">
				<div class="col-xs-4 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header" style="font-size:20px;font-style:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add
				<li <?php if(preg_match("^hospital/add_hosptial$^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>hospital/add_hosptial" style="font-size:15px;font-style:bold"><i class="fa fa-hospital-o fa-lg"style="color:red"></i>&nbsp;&nbsp;&nbsp;Hospital</a></li>
				<li <?php if(preg_match("^add/equipment_type^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>equipments/add/equipment_type" style="font-style:bold;font-size:15px"><i class="fa fa-medkit fa-lg"style="color:red"></i>&nbsp;&nbsp;Department</a></li>
				<li <?php if(preg_match("^add/service_records^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>equipments/add/service_records"style="font-style:bold;font-size:15px"><i class="fa fa-building-o fa-lg"style="color:red" aria-hidden="true"></i>
 &nbsp;&nbsp;Units</a></li>
				<li <?php if(preg_match("^add/service_records^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>equipments/add/service_records" style="font-style:bold;font-size:15px"><i class="fa fa-map-marker fa-2x" style="color:red"></i></i> &nbsp;&nbsp;&nbsp;Areas</a></li>
				
				
				
	<ul>
</div>

			<h2 align="center">Hospital</h2><br>
			<?php echo form_open('hospital/add_hospital',array('class'=>'form-group','role'=>'form','id'=>'add_hospital')); ?>
				<div class="col-md-8 col-md-offset-3">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="inputhospital ">Hospital Name</label>
								<input class="form-control" name="hospital" id="inputhospital" placeholder="enter name" type="TEXT" align="middle">
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputplace">Place</label>
								<input class="form-control" name="place" id="inputplace" placeholder="enter name" type="TEXT" align="middle">
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6  col-lg-4">
							<div class="form-group">
								<label for="inputhospital_short_name ">Hospital Short Name</label>
								<input class="form-control" name="hospital_short_name" id="inputhospital_short_name" placeholder="enter name" type="text">
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputdistrict" >District</label>
								<input class="form-control" name="district" id="inputdistrict" placeholder="enter name" type="TEXT" align="middle">
							</div>	
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputstate" >State</label>
								<input class="form-control" name="state" id="inputstate" placeholder="enter name" type="TEXT" align="middle">
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputtype1">Type1</label>
								<select class="form-control" name="type1">
									<option selected="selected">select</option>
									<option value="Private">Private</option>
									<option value="Public">Public</option>
									<option value="Non-profif">Non-Profit</option>
								</select>
							</div>	
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputtype2" >Type2</label>
								<select class="form-control" name="type2">
									<option selected="selected">select</option>
									<option value="State Government">State Government</option>
									<option value="Central Government">Central Government</option>
								</select>
							</div>	
						</div>
					   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputtype3" >Type3</label>
								<select class="form-control" name="type3">
									<option selected="selected">select</option> 
									<option value="Teaching">Teaching</option>
									<option value="Non-Teaching">Non-Teaching</option>
								</select>
							</div>	
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputtype4">Type4</label>
								<select class="form-control" name="type4">
									<option selected="selected">select</option>
									<option value="District">District</option>
									<option value="Area">Area</option>
									<option value="CHC">CHC</option>
									<option value="PHC">PHC</option>
									<option value="Sub">Sub Centre</option>
								</select>
							</div>	
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputtype5">Type5</label>
								<select class="form-control" name="type5">
									<option selected="selected">select</option>
									<option value="Urban">Urban</option>
									<option value="Rural">Rural</option>
								</select>
							</div>	
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputtype6">Type6</label>
								<select class="form-control" name="type6">
									<option selected="selected">select</option>
									<option value=""DME>DME</option>
									<option value="VVR">VVP</option>
									<option value="DH">DH</option>
								</select>
							</div>	
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6  col-lg-4">
							<div class="form-group">
								<label for="Inputdescription">Description</label>
								<textarea class="form-control" name="description" rows="3"></textarea>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="Inputlogo">logo</label><br>
								<img src="logo.jpg"  name="logo" width="100px" height="50px">
							</div>
						</div>
						<div class="col-md-12">
							<center><button class="btn btn-default" type="submit" name="Submit" id="btn">Submit</button></center>
						</div>
					</div>
				</div>
            <?php echo form_close(); ?>	
