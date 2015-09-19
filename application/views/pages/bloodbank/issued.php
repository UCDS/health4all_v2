<div class="col-md-10 col-sm-9">
	<?php
	if(isset($msg)) {
		echo "<div class='alert alert-info'>$msg</div>";
		echo "<br />";
	}
	?>
	<div>
		<table class="table-2 table table-striped table-bordered">
			<tr><th colspan="10">Issued Blood Donors List</th></tr>
			<tr><th>Name</th><th>Email</th></tr>
 		<?php 
 		$mail_count=0;
		foreach($donors as $donor){
				if($donor->request_type==0){
				if(filter_var($donor->email, FILTER_VALIDATE_EMAIL)){
								$donor->donation_date=date('d-M-Y',strtotime($donor->donation_date));
								$donor->issue_date=date('d-M-Y',strtotime($donor->issue_date));
								$to=$donor->email;
								if($to!=''){
								$subject="Thank you for your blood donation!";
								$body="
								<div style='width:90%;padding:5px;margin:5px;font-style:\"Trebuchet MS\";border:1px solid #eee;'>
								<p>Dear $donor->name,</p>
								<p>This is to inform you that a component of blood you have donated on $donor->donation_date
								was issued on $donor->issue_date to a patient with '$donor->diagnosis'.</p>
								<p>Thank you for your donation.</p>
								<p>
								</p>
								<p>
								From,<br />
								Blood Bank<br />
								Indian Red Cross Society, Vidyanagar <br />
								Hyderabad - 500044. <br />
								</p>
								</div>";
								}
								$this->email->from('redcross.bloodbankhyd@gmail.com', 'Indian Red Cross Society Blood Bank');
								$this->email->to($to);
								$this->email->bcc("contact@yousee.in");
								$this->email->subject($subject);
								$this->email->message($body);
								if ( ! $this->email->send()) {
									echo "<div class='alert alert-danger'>Email to $donor->email failed</div>";
								}
								else{
									$this->email->clear(TRUE);
									$mail_count++;
								}
					}
				}
			?>
			<td><?php echo $donor->name;?></td>
			<td><?php echo $donor->email;?></td>
		</tr>
		<?php } ?>
		</table>
		<?php echo $mail_count." mails sent"; ?>
		</form>
	</div>
</div>
