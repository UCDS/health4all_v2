		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css" media="print" >
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-barcode.min.js"></script>  
		<script>
			$(function(){
			$("#bcTarget").barcode("<?php echo $registered->patient_id;?>",'int25',{barWidth:2, barHeight:30,showHRI:false});
			});
		</script>
		<br />
		<br />
		<br />
		<br />
		<div style="width:100%;padding:5px">
			<div style="float:left;margin-right:10px;">
			<?php
			$encoded_data = $this->input->post('patient_picture');
			?>
			<img src="data:image/gif;base64,<?php echo $encoded_data;?>" alt="<?php echo $registered->patient_id;?>" width="100px" />
			</div>
			<div style="width:50%;font-size:12px;">
				<b><?php echo "# ".$registered->patient_id;?></b><br />
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
				<b>Address:
				<?php if(!!$registered->address) echo $registered->address;
				if($registered->place && !!$registered->address) echo ", ";
				if($registered->place) echo $registered->place;
				?></b><br />
				<b>Date: <?php echo date("d-M-Y",strtotime($registered->admit_date)); ?></b><br />
				<div id="bcTarget"></div>   
				
			</div>
		</div>