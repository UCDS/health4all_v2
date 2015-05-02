	<style>
	@media print{
		.column{
			position:relative;float:left;width:33%;margin:5px 0px;
		}
		.row{
			margin-top:auto;
			font-size:16px;
			font-family:"Arial",serif;
			height:22%;
			border:1px solid #ccc;
			border-radius:0.3em;
			padding:10px;
			margin-bottom:3px;
		}
		.heading{
			font-size:18px;
			font-weight:bold;
			width:100%;
			text-align:center;
			font-family:"Arial",serif;
			margin:5px;
		}
	}
	</style>
		<div class="row">
			<div class="column">
				<b>IP No:</b> <?php echo $registered->hosp_file_no; ?>
			</div>
			<div  class="column">
				<b>Admit Date:</b> <?php echo date("d-M-Y",strtotime($registered->admit_date)); ?>
			</div>
			<div  class="column">
				<b>Admit Time:</b> <?php echo date("g:ia",strtotime($registered->admit_time)); ?>
			</div>
			<div  class="column">
				<b>Name:</b> <?php echo $registered->name; ?>
			</div>
			<div  class="column">
				<b>Gender/Age:</b> 
				<?php echo $registered->gender."/";
				if($registered->age_years!=0) echo $registered->age_years."y "; 
				if($registered->age_months!=0) echo $registered->age_months."m "; 
				if($registered->age_days!=0) echo $registered->age_years."d "; ?>
			</div>
			<div   class="column">
				<b>Department:</b> <?php echo $registered->department; ?>			
			</div>
			<div  class="column">
				<b>Parent/Spouse:</b> <?php echo $registered->parent_spouse; ?>
			</div>
			<div   class="column">
				<b>Address:</b> <?php echo $registered->address.",".$registered->place.",".$registered->district; ?>			
			</div>
			<div  class="column">
				<?php 
				if($registered->unit_name || $registered->area_name) { ?>
				<b>Unit/Area:</b> <?php echo $registered->unit_name." / ".$registered->area_name; 
				}
				?>
			</div>
			<div  class="column">
				<b>Phone:</b> <?php echo $registered->phone; ?>
			</div>
			<?php if($registered->mlc==1) { ?>
			<div  class="column"><?php echo "<b>MLC No:</b>" .$registered->mlc_number; ?>
			</div>
			<div class="column">
				<?php echo "<b>PS Name:</b>" .$registered->ps_name;?>
			</div>
			<div class="column">
				<?php echo "";?>
			</div>
			<div class="column">
				<?php if($registered->presenting_complaints != NULL) {echo "<b>MLC Reason:</b> ".$registered->presenting_complaints;}?>			
			</div>
			<?php } ?>
		</div>	
		<div class="row">
			<div class="column">
				<b>IP No:</b> <?php echo $registered->hosp_file_no; ?>
			</div>
			<div  class="column">
				<b>Admit Date:</b> <?php echo date("d-M-Y",strtotime($registered->admit_date)); ?>
			</div>
			<div  class="column">
				<b>Admit Time:</b> <?php echo date("g:ia",strtotime($registered->admit_time)); ?>
			</div>
			<div  class="column">
				<b>Name:</b> <?php echo $registered->name; ?>
			</div>
			<div  class="column">
				<b>Gender/Age:</b> 
				<?php echo $registered->gender."/";
				if($registered->age_years!=0) echo $registered->age_years."Y "; 
				if($registered->age_months!=0) echo $registered->age_months."M "; 
				if($registered->age_days!=0) echo $registered->age_days."D "; 
				if($registered->age_years==0 && $registered->age_months == 0 && $registered->age_days==0) echo "0 Days";
				?>
			</div>
			<div   class="column">
				<b>Department:</b> <?php echo $registered->department; ?>			
			</div>
			<div  class="column">
				<b>Parent/Spouse:</b> <?php echo $registered->parent_spouse; ?>
			</div>
			<div   class="column">
				<b>Address:</b> <?php echo $registered->address.",".$registered->place.",".$registered->district; ?>			
			</div>
			<div  class="column">
				<?php 
				if($registered->unit_name || $registered->area_name) { ?>
				<b>Unit/Area:</b> <?php echo $registered->unit_name." / ".$registered->area_name; 
				}
				?>
			</div>
			<div  class="column">
				<b>Phone:</b> <?php echo $registered->phone; ?>
			</div>
			<?php if($registered->mlc==1) { ?>
			<div  class="column"><?php echo "<b>MLC No:</b>" .$registered->mlc_number; ?>
			</div>
			<div class="column">
				<?php echo "<b>PS Name:</b>" .$registered->ps_name;?>
			</div>
			<div class="column">
				<?php echo "";?>
			</div>
			<div class="column">
				<?php if($registered->presenting_complaints != NULL) {echo "<b>MLC Reason:</b> ".$registered->presenting_complaints;}?>			
			</div>
			<?php } ?>
		</div>	
		<div class="row">
			<div class="column">
				<b>IP No:</b> <?php echo $registered->hosp_file_no; ?>
			</div>
			<div  class="column">
				<b>Admit Date:</b> <?php echo date("d-M-Y",strtotime($registered->admit_date)); ?>
			</div>
			<div  class="column">
				<b>Admit Time:</b> <?php echo date("g:ia",strtotime($registered->admit_time)); ?>
			</div>
			<div  class="column">
				<b>Name:</b> <?php echo $registered->name; ?>
			</div>
			<div  class="column">
				<b>Gender/Age:</b> 
				<?php echo $registered->gender."/";
				if($registered->age_years!=0) echo $registered->age_years."y "; 
				if($registered->age_months!=0) echo $registered->age_months."m "; 
				if($registered->age_days!=0) echo $registered->age_years."d "; ?>
			</div>
			<div   class="column">
				<b>Department:</b> <?php echo $registered->department; ?>			
			</div>
			<div  class="column">
				<b>Parent/Spouse:</b> <?php echo $registered->parent_spouse; ?>
			</div>
			<div   class="column">
				<b>Address:</b> <?php echo $registered->address.",".$registered->place.",".$registered->district; ?>			
			</div>
			<?php 
			if($registered->unit_name || $registered->area_name) { ?>
			<div  class="column">
				<b>Unit/Area:</b> <?php echo $registered->unit_name." / ".$registered->area_name; ?>
			</div>
			<?php
				}
			?>
			<div  class="column">
				<b>Phone:</b> <?php echo $registered->phone; ?>
			</div>
			<?php if($registered->mlc==1) { ?>
			<div  class="column"><?php echo "<b>MLC No:</b>" .$registered->mlc_number; ?>
			</div>
			<div class="column">
				<?php echo "<b>PS Name:</b>" .$registered->ps_name;?>
			</div>
			<div class="column">
				<?php echo "";?>
			</div>
			<div class="column">
				<?php if($registered->presenting_complaints != NULL) {echo "<b>MLC Reason:</b> ".$registered->presenting_complaints;}?>			
			</div>
			<?php } ?>
		</div>	
		<div class="row">
			<div class="heading"><?php $hospital=$this->session->userdata('hospital'); echo $hospital['hospital'];?> - Gate Pass</div>
			<div class="column">
				<b>IP No:</b> <?php echo $registered->hosp_file_no; ?>
			</div>
			<div  class="column">
				<b>Admit Date:</b> <?php echo date("d-M-Y",strtotime($registered->admit_date)); ?>
			</div>
			<div  class="column">
				<b>Admit Time:</b> <?php echo date("g:ia",strtotime($registered->admit_time)); ?>
			</div>
			<div  class="column">
				<b>Name:</b> <?php echo $registered->name; ?>
			</div>
			<div  class="column">
				<b>Gender/Age:</b> 
				<?php echo $registered->gender."/";
				if($registered->age_years!=0) echo $registered->age_years."y "; 
				if($registered->age_months!=0) echo $registered->age_months."m "; 
				if($registered->age_days!=0) echo $registered->age_years."d "; ?>
			</div>
			<div   class="column">
				<b>Department:</b> <?php echo $registered->department; ?>			
			</div>
			<div  class="column">
				<b>Parent/Spouse:</b> <?php echo $registered->parent_spouse; ?>
			</div>
			<div   class="column">
				<b>Address:</b> <?php echo $registered->address.",".$registered->place.",".$registered->district; ?>			
			</div>
			<div  class="column">
				<?php 
				if($registered->unit_name || $registered->area_name) { ?>
				<b>Unit/Area:</b> <?php echo $registered->unit_name." / ".$registered->area_name; 
				}
				?>
			</div>
			<div  class="column">
				<b>Phone:</b> <?php echo $registered->phone; ?>
			</div>
			<?php if($registered->mlc==1) { ?>
			<div  class="column"><?php echo "<b>MLC No:</b>" .$registered->mlc_number; ?>
			</div>
			<div class="column">
				<?php echo "<b>PS Name:</b>" .$registered->ps_name;?>
			</div>
			<div class="column">
				<?php echo "";?>
			</div>
			<!-- To display the MLC Reason we use "presenting_complaints" field of "patient_visits" table-->
			<div class="column">
				<?php if($registered->presenting_complaints != NULL) {echo "<b>MLC Reason:</b> ".$registered->presenting_complaints;}?>			
			</div>
			<?php } ?>
		</div>