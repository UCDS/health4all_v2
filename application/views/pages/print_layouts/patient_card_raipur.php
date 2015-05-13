		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css" media="print" >
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-barcode.min.js"></script>  
		<script>
			$(function(){
			$("#bcTarget").barcode("<?php echo $registered->patient_id;?>",'int25');
			});
		</script>
		<table style="width:98%;padding:5px">
			<tr>
			<td align="center">
			<img align="left" src="<?php echo base_url();?>assets/images/hospital_logo.png" alt="<?php echo $registered->patient_id;?>" width="50px" />
			<img align="left" src="<?php echo base_url();?>assets/images/patients/<?php echo $registered->patient_id;?>.jpg" alt="<?php echo $registered->patient_id;?>" />
			</td>
			<td>
				<b><?php echo $registered->patient_id;?></b><br />
				<b><?php echo $registered->first_name." ".$registered->last_name;?></b><br />
				<b>
				Age:
					<?php
						if($registered->age_years!=0){ echo $registered->age_years."Y"; } 
						if($registered->age_months!=0){ echo $registered->age_months."M"; }
						if($registered->age_days!=0){ echo $registered->age_days."D"; }
						if($registered->age_years==0 && $registered->age_months == 0 && $registered->age_days==0) echo "0D";
					?>
				Sex: <?php echo $registered->gender;?>
				</b><br />
				<b>Address: <?php echo $registered->place; ?></b>
				<div id="bcTarget"></div>   
				
			</td>
			</tr>
		</table>