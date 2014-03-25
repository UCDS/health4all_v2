
	<section id="right">
		<h1>Welcome to Health4All!</h1>
		<p>
		<?php if($this->session->userdata('hospital')){
				var_dump($this->session->userdata('hospital'));
			}
			else{
				echo "Please select a hospital to continue.";
			}
		?>
		<p>
		<?php
		if(count($this->session->userdata('logged_in'))>1){
		echo form_open('home'); ?>
		<select name="organisation">
		<option value="--Select--" selected disabled>--Select--</option>
		<?php 
			$i=0;
			foreach($this->session->userdata('logged_in') as $row){
				echo "<option id='hospital_$i' value='$row[hospital_id]'>$row[hospital], $row[description], $row[place], $row[district]</option>";
			}
		?>
		<input type="submit" value="Submit" />
		</select>
		</form>
		<?php } ?>
		</p>
	</section>
