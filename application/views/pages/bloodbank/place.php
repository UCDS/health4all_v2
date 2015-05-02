
	<div class="col-md-10 col-sm-9">
		<h4>Welcome to Blood Bank - <?php echo $hospitaldata['hospital'];?>!</h4>
		<br />
		<br />
		<p> Current place set to <b><?php 
		$place=$this->session->userdata('place');
		echo $place['name']; ?></b>
		<br />
		<br />
		Change :
		<?php 
		echo form_open('bloodbank/user_panel/place'); ?>
				<select name="camp" id="camps" >
				<option value="">--Select Location--</option>
				<?php foreach($camps as $camp){
					echo "<option value='".$camp->camp_id."' id='camp".$camp->camp_id."'>$camp->camp_name, $camp->location</option>";
				?>
					
				<?php
				}
				?>
				</select>
				<input type="submit" value="Select Camp" />
				<input type="submit" value="BloodBank" name="reset" />
		</form>
		<hr>
		<h4>Add Camp</h4>
		<?php echo form_open('bloodbank/staff/set_place'); ?>
		Camp name : <input type="text" name="camp" required />
		Address : <input type="text" name="location" size="40" required />
		<input type="submit" value="Add Camp" name="add_camp" />
		</form>
		<hr>
		<h4>Add Hospital</h4>
		<?php echo form_open('bloodbank/staff/set_place'); ?>
		Hospital name : <input type="text" name="hospital" required />
		Place : <input type="text" name="location" size="20" required />
		District : <input type="text" name="district" size="20" required />
		State : <input type="text" name="state" size="20" required />
		<input type="submit" value="Add Hospital" name="add_hospital" />
		</form>
		<?php if(isset($msg)) echo $msg; ?>
	</div>

	