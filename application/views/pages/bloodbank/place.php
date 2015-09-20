
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
				<input type="submit" value="Select Camp" name="set_camp"class="btn btn-primary btn-sm" />
				<input type="submit" value="BloodBank" name="reset" class="btn btn-primary btn-sm" />
		</form>
		</div>
		<?php if(isset($msg)) echo $msg; ?>
	</div>

	