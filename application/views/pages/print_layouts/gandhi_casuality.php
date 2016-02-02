		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css" media="print" >
		<table style="width:98%;padding:5px">
				<tr>
				<td colspan="3">
				<img style="float:right" style="margin-top:-20px" src="<?php echo base_url();?>assets/images/ap-logo.png" width="60px" />
				<img style="float:left" src="<?php echo base_url();?>assets/images/<?php $hospital=$this->session->userdata('hospital');echo $hospital['logo'];?>" width="60px" />
				<div style="float:middle;text-align:center">
				<b>Government of Telangana</b><br />
				<font size="4"><?php echo $hospital['hospital'];?></font>
					<?php echo $hospital['description'];?> 
					@ 
					<?php echo $hospital['district'];?>
					<br />
					<br />
				<span style="border:1px solid #ccc;padding:5px;margin:5px;"><u><b>OUT PATIENT <?php if(!!$registered->visit_name) echo "- ".strtoupper($registered->visit_name);?></b></u></span>
				<br />
				<br />
				</div>
				</td>
				</tr>
				<tbody height="10%" style="border:1px solid black;">
				<tr width="95%">
						<td style="padding:5px;">Name: <?php echo $registered->name; ?></td>
						<td>Age/ Sex: 	
							<?php 
							if($registered->age_years!=0){ echo $registered->age_years." Years "; } 
							if($registered->age_months!=0){ echo $registered->age_months." Months "; }
							if($registered->age_days!=0){ echo $registered->age_days." Days "; }
							if($registered->age_years==0 && $registered->age_months == 0 && $registered->age_days==0) echo "0 Days ";
							?>/ <?php echo $registered->gender; ?></td>
						<td style="padding:5px;">Date, Time:  
							<?php echo date("d-M-Y",strtotime($registered->admit_date)); ?>,
							<?php echo date("g:iA",strtotime($registered->admit_time)); ?></td>
				</tr>
				<tr width="95%">
						<td  style="padding:5px;"> <b style="font-size:1.3em;"> OP number: <?php echo $registered->hosp_file_no; ?></b></td>
						<td style="padding:5px;">Department : <?php echo $registered->department; ?></td>
						<td> 
						<?php 
						if(!!$registered->unit_name) echo "Unit";
						if(!!$registered->unit_name) echo ": "; 
						if(!!$registered->unit_name) echo $registered->unit_name;
						?>
						</td>
				</tr>
				<tr width="95%">
						<td></td>
						<td></td>
						<td></td>
				</tr>
				</tbody>
				<tr class="print-element" width="95%" height="100px">
					<td colspan="2">
						Chief Complaint:
					</td>
					<td 	Investigations:<br />
						<small style="font-size:10px;color:#666;">Provisional Diagnosis is <br />
						mandatory for investigations.</small>
					</td>
				</tr>
				<tr class="print-element" width="95%" height="150px">
					<td colspan="2">
						Examination:
					</td>
				</tr>
				<tr class="print-element" width="95%" height="70px">
					<td>
						Provisional Diagnosis:
					</td>
				</tr>
				
		</table>