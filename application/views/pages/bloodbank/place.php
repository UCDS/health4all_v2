
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
		<?php echo form_open('bloodbank/staff/set_place'); ?>
		<div class="col-md-3">
		Camp name : <input type="text" class="form-control" name="camp" required />
		</div>
		<div class="col-md-3">
		Address : <input type="text" class="form-control" name="location" size="40" required />
		</div>
		
		<br>
		<input type="submit" value="Add Camp"  class="btn btn-primary btn-sm"name="add_camp" />
		
		</form>
			
		<hr>
		<h4>Add Hospital</h4>
		<?php echo form_open('bloodbank/staff/set_place'); ?>
		<div class="col-md-3">
		Hospital name : <input type="text"  class="form-control" name="hospital" required />
		</div>
		<div class="col-md-3">
		Place : <input type="text" name="location"  class="form-control" size="20" required />
		</div>
		<div class="col-md-3">
		District : <input type="text" name="district"   class="form-control" size="20" required />
		</div>
		<div class="col-md-3">
		State : <input type="text" name="state"  class="form-control" size="20" required />
		</div>
		<br><br><br>
		<div class="col-md-3 offset-12">
		<input type="submit" value="Add Hospital"  class="btn btn-primary btn-sm" name="add_hospital" />
		</div>
		</form>
		<?php if(isset($msg)) echo $msg; ?>
	</div>

	