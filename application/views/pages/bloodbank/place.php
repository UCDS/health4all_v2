
	<div class="col-md-10 col-sm-9">
		<div class="well">
			<h4>Blood Bank - <?php echo $hospitaldata['hospital'];?>!</h4>
			<br />
			<br />
			<p> Current place set to <b><?php 
			$place=$this->session->userdata('place');
			echo $place['name']; ?></b>
			<br />
			<br />
		<?php 
		echo form_open('bloodbank/user_panel/place',array('class'=>'form-custom')); ?>
		Change :

			<select name="camp" id="camps" class="form-control" >
				<option value="">--Select Location--</option>
				<?php foreach($camps as $camp){
					echo "<option value='".$camp->camp_id."' id='camp".$camp->camp_id."'>$camp->camp_name, $camp->location</option>";
				?>
					
				<?php
				}
				?>
				</select>
				<input type="submit" value="Select Camp" class="btn btn-primary btn-sm" />
				<input type="submit" value="BloodBank" name="reset" class="btn btn-primary btn-sm" />
		</form>
		</div>
		<hr>
		<h4>Add Camp</h4>
		<?php echo form_open('bloodbank/staff/set_place',array('class'=>'form-custom')); ?>
				
		<div class="col-md-5">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Camp Name</span>
		  <input class="form-control"type="text" class="form-control" name="camp"   aria-describedby="basic-addon1" required>
		</div>		
		</div>
		<div class="col-md-5">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Address </span>
		  <input class="form-control"type="text" class="form-control"   name="location"  aria-describedby="basic-addon1" required>
		</div>		
		</div>
		<input type="submit"  class="btn btn-primary btn-sm" value="Add Camp" name="add_camp" />
		</form>
			
		<hr>
		<h4>Add Hospital</h4>
		<?php echo form_open('bloodbank/staff/set_place',array('class'=>'form-custom')); ?>
		<div class="col-md-6">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Hospital name </span>
		  <input class="form-control"type="text" class="form-control"   name="hospital"  aria-describedby="basic-addon1" required>
		</div>		
		</div>
		<div class="col-md-3">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">	Place </span>
		  <input class="form-control"type="text" class="form-control" name="location"   aria-describedby="basic-addon1" required>
		</div>		
		</div>
		<div class="col-md-3">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">	District</span>
		  <input class="form-control"type="text" class="form-control" name="district"  aria-describedby="basic-addon1" required>
		</div>		
		</div><br><br><br>
		<div class="col-md-3">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">	State</span>
		  <input class="form-control"type="text" class="form-control" name="state"  aria-describedby="basic-addon1" required>
		</div>		
		</div>
		
		<input type="submit" value="Add Hospital"   class="btn btn-primary btn-sm"name="add_hospital" />
		</form>
		<?php if(isset($msg)) echo $msg; ?>
	</div>

	