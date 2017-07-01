<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" media='screen,print'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flaticon.css" >
	<link rel="stylesheet"  type="text/css" href="<?php echo base_url();?>assets/css/bootstrap_datetimepicker.css"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/Chart.js"></script>
	
	
	<?php 
		$total=0;
		foreach($hospital_report as $h){
			$total+=$h->count;
		}
		$d_array = array();
		$default_time = strtotime("00:00:00");
		foreach($duration as $d){
			$d_array[]= strtotime($d->dial_call_duration)-$default_time;
		}
		$average = calculate_average($d_array);
		$median = calculate_median($d_array);
	?>
	<script>
	$(function(){
		$(".date").datetimepicker({
			format : "D-MMM-YYYY"
		});
		
			var hospitalctx = $("#hospitalChart");
			var myChart = new Chart(hospitalctx, {
				type: 'horizontalBar',
				data: {
					labels: [<?php $i=1;foreach($hospital_report as $a) { echo "'".$a->hospital;if($i<count($hospital_report)) echo "' ,"; else echo "'"; $i++; }?>],
					datasets: [
						{
							type: 'horizontalBar',
							label: 'Calls',
							xAxisID : "A",
							backgroundColor: "rgba(255,102,0,0.6)",
							borderColor: "rgba(255,102,0,0.6)",
							data: [<?php $i=1;foreach($hospital_report as $a) { echo $a->count;if($i<count($hospital_report)) echo " ,"; $i++; }?>]
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
								labelString : "Calls"
							}
						}],
						yAxes: [{
							stacked: true
						}]
					}
				}
			});
			
			var durationctx = $("#durationChart");
			var myChart = new Chart(durationctx, {
				type: 'bar',
				data: {
					labels: ['Average','Median'],
					datasets: [
						{
							type: 'bar',
							label: 'Time (in seconds)',
							yAxisID : "A",
							backgroundColor: "rgba(255,102,0,0.6)",
							borderColor: "rgba(255,102,0,0.6)",
							data: [<?php echo $average;?>, <?php echo $median;?>]
						}
					]
				},
				options: {
					scales: {
					  yAxes: [{
							id: 'A',
							type: 'linear',
							position: 'left',
							ticks: {
								beginAtZero:true
							},
							gridLines : false,
							scaleLabel : {
								display : true,
								labelString : "Time"
							}
						}],
						xAxes: [{
							stacked: true
						}]
					}
				}
			});
			
			var volunteerctx = $("#volunteerChart");
			var myChart = new Chart(volunteerctx, {
				type: 'horizontalBar',
				data: {
					labels: [<?php $i=1;foreach($volunteer_report as $a) { echo "'".$a->dial_whom_number;if($i<count($volunteer_report)) echo "' ,"; else echo "'"; $i++; }?>],
					datasets: [
						{
							type: 'horizontalBar',
							label: 'Calls',
							xAxisID : "A",
							backgroundColor: "rgba(255,102,0,0.6)",
							borderColor: "rgba(255,102,0,0.6)",
							data: [<?php $i=1;foreach($volunteer_report as $a) { echo $a->count;if($i<count($volunteer_report)) echo " ,"; $i++; }?>]
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
								labelString : "Calls"
							}
						}],
						yAxes: [{
							stacked: true
						}]
					}
				}
			});
			
			
			var callertypectx = $("#callerType");
			var myChart = new Chart(callertypectx, {
				type: 'pie',
				data: {
					labels: [<?php $i=1;foreach($caller_type_report as $a) { echo "'".$a->caller_type;if($i<count($caller_type_report)) echo "' ,"; else echo "'"; $i++; }?>],
					datasets: [
						{
							type: 'pie',
							label: 'Caller Type',
							backgroundColor: "rgba(255,102,0,0.6)",
							borderColor: "rgba(255,102,0,0.6)",
							data: [<?php $i=1;foreach($caller_type_report as $a) { echo $a->count;if($i<count($caller_type_report)) echo " ,"; $i++; }?>]
						}
					]
				}
			});
			var calltypectx = $("#callType");
			var myChart = new Chart(calltypectx, {
				type: 'pie',
				data: {
					labels: [<?php $i=1;foreach($call_type_report as $a) { echo "'".$a->call_type;if($i<count($call_type_report)) echo "' ,"; else echo "'"; $i++; }?>],
					datasets: [
						{
							type: 'pie',
							label: 'Caller Type',
							backgroundColor: "rgba(255,102,0,0.6)",
							borderColor: "rgba(255,102,0,0.6)",
							data: [<?php $i=1;foreach($call_type_report as $a) { echo $a->count;if($i<count($call_type_report)) echo " ,"; $i++; }?>]
						}
					]
				}
			});
			var callcategoryctx = $("#callCategory");
			var myChart = new Chart(callcategoryctx, {
				type: 'pie',
				data: {
					labels: [<?php $i=1;foreach($call_category_report as $a) { echo "'".$a->call_category;if($i<count($call_category_report)) echo "' ,"; else echo "'"; $i++; }?>],
					datasets: [
						{
							type: 'pie',
							label: 'Caller Type',
							backgroundColor: "rgba(255,102,0,0.6)",
							borderColor: "rgba(255,102,0,0.6)",
							data: [<?php $i=1;foreach($call_category_report as $a) { echo $a->count;if($i<count($call_category_report)) echo " ,"; $i++; }?>]
						}
					]
				}
			});
			var to_numberctx = $("#to_number");
			var myChart = new Chart(to_numberctx, {
				type: 'pie',
				data: {
					labels: [<?php $i=1;foreach($to_number_report as $a) { echo "'".$a->to_number;if($i<count($to_number_report)) echo "' ,"; else echo "'"; $i++; }?>],
					datasets: [
						{
							type: 'pie',
							label: 'To Number',
							backgroundColor: "rgba(255,102,0,0.6)",
							borderColor: "rgba(255,102,0,0.6)",
							data: [<?php $i=1;foreach($to_number_report as $a) { echo $a->count;if($i<count($to_number_report)) echo " ,"; $i++; }?>]
						}
					]
				}
			});
			var op_ipctx = $("#op_ip");
			var myChart = new Chart(op_ipctx, {
				type: 'pie',
				data: {
					labels: [<?php $i=1;foreach($op_ip_report as $a) { echo "'".$a->ip_op;if($i<count($op_ip_report)) echo "' ,"; else echo "'"; $i++; }?>],
					datasets: [
						{
							type: 'pie',
							label: 'Visit Type',
							backgroundColor: "rgba(255,102,0,0.6)",
							borderColor: "rgba(255,102,0,0.6)",
							data: [<?php $i=1;foreach($op_ip_report as $a) { echo $a->count;if($i<count($op_ip_report)) echo " ,"; $i++; }?>]
						}
					]
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
          <a class="navbar-brand" href="<?php echo base_url();?>"><?php echo $title;?></a>
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
	
	<div class="panel panel-default">
		<div class="panel panel-body">
			<?php 
			if($this->input->post('from_date')) $from_date = date("d-M-Y",strtotime($this->input->post('from_date'))); else $from_date = date("d-M-Y");
			if($this->input->post('to_date')) $to_date = date("d-M-Y",strtotime($this->input->post('to_date'))); else $to_date = date("d-M-Y");
			?>
			<div class="row">
			<?php echo form_open('dashboard/helpline/',array('role'=>'form','class'=>'form-custom')); ?>
			<div style="position:relative;display:inline;">
			<input type="text" class="date" name="from_date" class="form-control" value="<?php echo $from_date;?>" />
			</div>
			<div  style="position:relative;display:inline;">
			<input type="text" class="date" name="to_date" class="form-control" value="<?php echo $to_date;?>" />	
			</div>
			<select name="caller_type" style="width:100px" class="form-control">
				<option value="">Select</option>
				<?php foreach($caller_type as $ct){ ?>
					<option value="<?php echo $ct->caller_type_id;?>"
					<?php if($this->input->post('caller_type') == $ct->caller_type_id) echo " selected "; ?>
					><?php echo $ct->caller_type;?></option>
				<?php } ?>
			</select>	
			<select name="call_category" style="width:100px" class="form-control">
				<option value="">Select</option>
				<?php foreach($call_category as $cc){ ?>
					<option value="<?php echo $cc->call_category_id;?>"
					<?php if($this->input->post('call_category') == $cc->call_category_id) echo " selected "; ?>									
					><?php echo $cc->call_category;?></option>
				<?php } ?>
			</select>	
			<select name="resolution_status" style="width:100px" class="form-control">
				<option value="">Select</option>
				<?php foreach($resolution_status as $rs){ ?>
					<option value="<?php echo $rs->resolution_status_id;?>"
					<?php if($this->input->post('resolution_status') == $rs->resolution_status_id) echo " selected "; ?>																		
					><?php echo $rs->resolution_status;?></option>
				<?php } ?>
			</select>
			<select name="hospital" style="width:100px" class="form-control">
				<option value="">Select</option>
				<?php foreach($all_hospitals as $hosp){ ?>
					<option value="<?php echo $hosp->hospital_id;?>"
					<?php if($this->input->post('hospital') == $hosp->hospital_id) echo " selected "; ?>																		
					><?php echo $hosp->hospital;?></option>
				<?php } ?>
			</select>
			<select name="visit_type" style="width:100px" class="form-control">
				<option value="">Select</option>
					<option value="OP"
					<?php if($this->input->post('visit_type') == "OP") echo " selected "; ?>																		
					>OP</option>
					<option value="IP"
					<?php if($this->input->post('visit_type') == "IP") echo " selected "; ?>																		
					>IP</option>
			</select>	
			<input type="submit" name="submit" value="Go" class="btn btn-primary btn-sm" />
			</form>
			<hr>
		</div>
	
	
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
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4>Hospital</h4>
			</div>
			<div class="panel-body">
			<canvas id="hospitalChart" width="200" height="150"></canvas>
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4>Category</h4>
			</div>
			<div class="panel-body">
			<canvas id="callCategory" width="200" height="150"></canvas>
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4>Caller</h4>
			</div>
			<div class="panel-body">
			<canvas id="callerType" width="200" height="150"></canvas>
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4>Status</h4>
			</div>
			<div class="panel-body">
			<canvas id="callType" width="200" height="150"></canvas>
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4>Duration</h4>
			</div>
			<div class="panel-body">
			<canvas id="durationChart" width="200" height="150"></canvas>
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4>Patient Type</h4>
			</div>
			<div class="panel-body">
			<canvas id="op_ip" width="200" height="150"></canvas>
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4>Reciever</h4>
			</div>
			<div class="panel-body">
			<canvas id="volunteerChart" width="200" height="150"></canvas>
			</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4>Helpline</h4>
			</div>
			<div class="panel-body">
			<canvas id="to_number" width="200" height="150"></canvas>
			</div>
			</div>
		</div>
	</div>
	</div>

	
	
	
<?php 
function calculate_median($arr) {
    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median = (($low+$high)/2);
    }
    return $median;
}

function calculate_average($arr) {
    $count = count($arr); //total numbers in array
    foreach ($arr as $value) {
        $total = $total + $value; // total value of array numbers
    }
    $average = ($total/$count); // get average value
    return $average;
}
?>