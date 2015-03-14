<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/table2CSV.js"></script>
<script type="text/javascript">
$(function(){
	$("#from_date,#to_date").Zebra_DatePicker();
	$("#generate-csv").click(function(){
		$(".table").table2CSV();
	});
});
</script>
	<div class="row">
	<?php 
	$from_date=date("Y-m-d");$to_date=$from_date;
	if($this->input->post('from_date')) $from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
	if($this->input->post('to_date')) $to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
	?>
		<h4>Sensitivity Report</h4>	
		<?php echo form_open("reports/sensitivity_summary",array('role'=>'form','class'=>'form-custom')); ?>
					From Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y",strtotime($from_date)); ?>" name="from_date" id="from_date" size="15" />
					To Date : <input class="form-control" type="text" value="<?php echo date("d-M-Y",strtotime($to_date)); ?>" name="to_date" id="to_date" size="15" />
					<input class="btn btn-sm btn-primary" type="submit" value="Submit" />
		</form>
	<br />
	<?php if(isset($report) && count($report)>0){ ?>
	<?php 
	$micro_organisms = array();
	$antibiotics = array();
	foreach($report as $s){
		$micro_organisms[] = $s->micro_organism;
		$antibiotics[] = $s->antibiotic;
	}
	$micro_organisms = array_unique($micro_organisms);
	sort($micro_organisms);
	$antibiotics = array_unique($antibiotics);
	?>
	<table class="table table-bordered table-striped">
	<thead>
		<tr>
		<th style="text-align:center"></th>
		
		<?php foreach($micro_organisms as $m){
				echo "<th colspan='3'>$m</th>";
			}
		?>
		</tr>
		<tr>
			<th></th>
		<?php foreach($micro_organisms as $m){
				echo "<th>S</th><th>T</th><th>%</th>";
			}
		?>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($antibiotics as $a){
					$mo = array();
			echo "<tr><td>$a</td>";
				$i=0;
					foreach($micro_organisms as $m){
						foreach($report as $r){
							if( $r->antibiotic == $a && $r->micro_organism == $m){
								echo "<td>$r->sensitive</td><td>$r->total_antibiotic</td><td>".number_format(($r->sensitive/$r->total_antibiotic)*100)."%</td>";
								$mo[]=$m;
							}
							//else {var_dump($mo); break;}
						}
						
							if(!in_array($m,$mo)){
								$mo[]=$m;
								echo "<td>0</td><td>0</td><td>0%</td>";
							}
				$i++;
					}
			echo "</tr>";
	}
	?>
	</tbody>
	</table>
	<?php } else { ?>
	No Orders on the given date.
	<?php } ?>
	</div>