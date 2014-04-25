	<style>
	@media print{
		.column{
			position:relative;float:left;width:33%;margin:5px 0px;
		}
		.row{
			font-size:16px;
			font-family:"Trebuchet MS",serif;
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
			font-family:"Trebuchet MS",serif;
			margin:5px;
		}
	}
	</style>
		<div class="row">
			<div class="column">
				IP No: <?php echo $registered->hosp_file_no; ?>
			</div>
			<div  class="column">
				Admit Date: <?php echo date("d-M-Y",strtotime($registered->admit_date)); ?>
			</div>
			<div  class="column">
				Admit Time: <?php echo date("g:ia",strtotime($registered->admit_time)); ?>
			</div>
			<div  class="column">
				Name: <?php echo $registered->name; ?>
			</div>
			<div  class="column">
				Gender: <?php echo $registered->gender; ?>
			</div>
			<div  class="column">
				Parent/Spouse: <?php echo $registered->parent_spouse; ?>
			</div>
			<div   class="column">
				Address: <?php echo $registered->address; ?>			
			</div>
			<div  class="column">
				Place: <?php echo $registered->place; ?>
			</div>
			<div  class="column">
				Phone: <?php echo $registered->phone; ?>
			</div>
			<div   class="column">
				Department: <?php echo $registered->department; ?>			
			</div>
			<div  class="column">
				<?php 
				if($registered->unit_name || $registered->area_name) { ?>
				Unit/Area: <?php echo $registered->unit_name." / ".$registered->area_name; 
				}
				?>
			</div>
			<div  class="column">
				<?php if($registered->mlc==1) { echo "MLC No: ".$registered->mlc_number.", PS Name:".$registered->ps_name; }?>
			</div>
		</div>	
		<div class="row">
			<div class="column">
				IP No: <?php echo $registered->hosp_file_no; ?>
			</div>
			<div  class="column">
				Admit Date: <?php echo date("d-M-Y",strtotime($registered->admit_date)); ?>
			</div>
			<div  class="column">
				Admit Time: <?php echo date("g:ia",strtotime($registered->admit_time)); ?>
			</div>
			<div  class="column">
				Name: <?php echo $registered->name; ?>
			</div>
			<div  class="column">
				Gender: <?php echo $registered->gender; ?>
			</div>
			<div  class="column">
				Parent/Spouse: <?php echo $registered->parent_spouse; ?>
			</div>
			<div   class="column">
				Address: <?php echo $registered->address; ?>			
			</div>
			<div  class="column">
				Place: <?php echo $registered->place; ?>
			</div>
			<div  class="column">
				Phone: <?php echo $registered->phone; ?>
			</div>
			<div   class="column">
				Department: <?php echo $registered->department; ?>			
			</div>
			<div  class="column">
				<?php 
				if($registered->unit_name || $registered->area_name) { ?>
				Unit/Area: <?php echo $registered->unit_name." / ".$registered->area_name; 
				}
				?>
			</div>
			<div  class="column">
				<?php if($registered->mlc==1) { echo "MLC No: ".$registered->mlc_number.", PS Name:".$registered->ps_name; }?>
			</div>
		</div>	
		<div class="row">
			<div class="column">
				IP No: <?php echo $registered->hosp_file_no; ?>
			</div>
			<div  class="column">
				Admit Date: <?php echo date("d-M-Y",strtotime($registered->admit_date)); ?>
			</div>
			<div  class="column">
				Admit Time: <?php echo date("g:ia",strtotime($registered->admit_time)); ?>
			</div>
			<div  class="column">
				Name: <?php echo $registered->name; ?>
			</div>
			<div  class="column">
				Gender: <?php echo $registered->gender; ?>
			</div>
			<div  class="column">
				Parent/Spouse: <?php echo $registered->parent_spouse; ?>
			</div>
			<div   class="column">
				Address: <?php echo $registered->address; ?>			
			</div>
			<div  class="column">
				Place: <?php echo $registered->place; ?>
			</div>
			<div  class="column">
				Phone: <?php echo $registered->phone; ?>
			</div>
			<div   class="column">
				Department: <?php echo $registered->department; ?>			
			</div>
			<div  class="column">
				<?php 
				if($registered->unit_name || $registered->area_name) { ?>
				Unit/Area: <?php echo $registered->unit_name." / ".$registered->area_name; 
				}
				?>
			</div>
			<div  class="column">
				<?php if($registered->mlc==1) { echo "MLC No: ".$registered->mlc_number.", PS Name:".$registered->ps_name; }?>
			</div>
		</div>	
		<div class="row">
			<div class="heading">Gandhi Hospital - Gate Pass</div>
			<div class="column">
				IP No: <?php echo $registered->hosp_file_no; ?>
			</div>
			<div  class="column">
				Admit Date: <?php echo date("d-M-Y",strtotime($registered->admit_date)); ?>
			</div>
			<div  class="column">
				Admit Time: <?php echo date("g:ia",strtotime($registered->admit_time)); ?>
			</div>
			<div  class="column">
				Patient Name: <?php echo $registered->name; ?>
			</div>
			<div  class="column">
				Gender: <?php echo $registered->gender; ?>
			</div>
			<div  class="column">
				Parent/Spouse: <?php echo $registered->parent_spouse; ?>
			</div>
			<div   class="column">
				Department: <?php echo $registered->department; ?>			
			</div>
			<div  class="column">
				<?php 
				if($registered->unit_name || $registered->area_name) { ?>
				Unit/Area: <?php echo $registered->unit_name." / ".$registered->area_name; 
				}
				?>
			</div>
			<div  class="column">
				<?php if($registered->mlc==1) { echo "MLC No: ".$registered->mlc_number.", PS Name:".$registered->ps_name; }?>
			</div>
		</div>	