<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $report[0]; ?> - Dashboard</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" media='screen,print'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flaticon.css" >
	<link rel="stylesheet"  type="text/css" href="<?php echo base_url();?>assets/css/bootstrap_datetimepicker.css"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/Chart.js"></script>
	<script>
	$(function(){
		$(".date").datetimepicker({
			format : "D-MMM-YYYY"
		});
		
			var hospitalctx = $("#hospitalChart");
			var myChart = new Chart(hospitalctx, {
				type: 'horizontalBar',
				data: {
					labels: [<?php $i=1;foreach($report[1] as $a) { echo "'".$a->hospital_short_name;if($i<count($report[1])) echo "' ,"; else echo "'"; $i++; }?>],
					datasets: [
						{
							type: 'horizontalBar',
							label: 'OP',
							xAxisID : "A",
							backgroundColor: "rgba(255,102,0,0.6)",
							borderColor: "rgba(255,102,0,0.6)",
							data: [<?php $i=1;foreach($report[1] as $a) { echo $a->total_op;if($i<count($report[1])) echo " ,"; $i++; }?>]
						},
						{
							type: 'horizontalBar',
							label: 'IP',
							xAxisID : "A",
							backgroundColor: "rgba(153,204,0, 0.7)",
							borderColor: "rgba(153,204,0, 0.7)",
						data: [<?php $i=1;foreach($report[1] as $a) { echo $a->total_ip;if($i<count($report[1])) echo " ,"; $i++; }?>],
						}
					]
				},
				options: {
					scales: {
					  xAxes: [{
							id: 'A',
							type: 'linear',
							position: 'bottom',
							ticks: {
								beginAtZero:true
							},
							gridLines : false,
							scaleLabel : {
								display : true,
								labelString : "Patients"
							}
						}],
						yAxes: [{
							stacked: true
						}]
					}
				}
			});
	});
	</script>
</head>
<body>
<div id="wrap">
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
		<!-- Bootstrap toggle menu for mobile devices, only visible on small screens --> 
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>"><?php echo $report[0];?> - Dashboard</a>
        </div>
        <div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/"><i class="fa fa-sign-out"></i>Login</a></li>
				<li><a href="<?php echo base_url();?>home/about">About</a></li>
				<li><a href="http://www.yousee.in" target="_blank"><img src="<?php echo base_url();?>assets/images/uc-logo.png" alt="" height="22" width="22"></a></li>
			</ul>	
		</div> 
		</div><!--/.nav-collapse -->
      </div>
	<div class="container">
	<?php
		foreach($report[1] as $r) { 
			$total_op=0;
			$total_repeat_op=0;
			$total_ip=0;
			foreach($report[1] as $r) {
				$total_op+=$r->total_op;
				$total_ip+=$r->total_ip;
				$total_repeat_op+=$r->repeat_op;
			}
		}
	?>
	<div class="row">  
		<div class="col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h5 style="display:inline">Report as on <?php echo date("d-M-Y g:iA");?></small></h5>

					<span class="text-right" style="display:inline">	
						<?php echo form_open("dashboard/view/".$organization,array("class"=>"form-custom"));?>
						<input type="text" class="date form-control" style="width:150px" value="<?php if($this->input->post('date')) echo date("d-M-Y",strtotime($this->input->post('date'))); else echo date("d-M-Y");?>" name="date" />
						<input type="submit" class="btn btn-sm btn-primary" value="Submit" name="submit" />
						</form>
					</span>
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th></th>
								<th>Hospital</th>
								<th colspan="3" class="text-center">OP</th>
								<th class="text-right">IP</th>
							</tr>
							<tr>
								<th></th>
								<th></th>
								<th class="text-right">New</th>
								<th class="text-right">Repeat</th>
								<th class="text-right">OP Total</th>
							</tr>
							<tr>
								<th>#</td>
								<th>Total</td>
								<th class="text-right"><?php echo number_format($total_op - $total_repeat_op);?></th>
								<th class="text-right"><?php echo number_format($total_repeat_op);?></th>
								<th class="text-right"><?php echo number_format($total_op);?></th>
								<th class="text-right"><?php echo number_format($total_ip);?></th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$i=1;
						foreach($report[1] as $r) {
						?>
								<tr>
									<td><?php echo $i++;?></td>
									<td><?php echo $r->hospital_short_name;?></td>
									<td class="text-right"><?php echo number_format($r->total_op - $r->repeat_op);?></td>
									<td class="text-right"><?php echo number_format($r->repeat_op);?></td>
									<td class="text-right"><?php echo number_format($r->total_op);?></td>
									<td class="text-right"><?php echo number_format($r->total_ip);?></td>
								</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
		<div class="col-md-6">
			<div class="panel panel-default">
			<div class="panel-body">
			<canvas id="hospitalChart" width="200" height="150"></canvas>
			</div>
			</div>
		</div>
	</div>
	</div>