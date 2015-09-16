		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css" media="print" >
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" media="print">
		<?php $patient=$patients[0];?>
		<table style="width:98%;padding:5px">
				<tr>
				<td colspan="3">
				<img style="float:right" style="margin-top:-20px" src="<?php echo base_url();?>assets/images/ap-logo.png" width="60px" />
				<img style="float:left" src="<?php echo base_url();?>assets/images/<?php $hospital=$this->session->userdata('hospital');echo $hospital['logo'];?>" width="60px" />
				<div style="float:middle;text-align:center">
				<b>Government of Andhra Pradesh</b><br />
				<font size="4"><?php echo $hospital['hospital'];?></font>
					<?php echo $hospital['description'];?> 
					@ 
					<?php echo $hospital['district'];?>
					<br />
					<br />
				<span style="border:1px solid #ccc;padding:5px;margin:5px;"><u><b>DISCHARGE SUMMARY</b></u></span>
				<br />
				<br />
				</div>
				</td>
				</tr>
				<tbody height="10%" style="border:1px solid black;">
				<tr width="95%">
						<td style="padding:5px;">Name: <?php echo $patient->name; ?></td>
						<td>Age/Sex: <?php 
						
							if($patient->age_years!=0){ echo $patient->age_years." Yrs "; } 
							if($patient->age_months!=0){ echo $patient->age_months." Mths "; }
							if($patient->age_days!=0){ echo $patient->age_days." Days "; }
							if($patient->age_years==0 && $patient->age_months == 0 && $patient->age_days==0) echo "0 Days";
							echo "/".$patient->gender; ?></td>
						<td>Admit Date:<?php echo date("d-M-Y",strtotime($patient->admit_date)); 
						echo date("g:iA",strtotime($patient->admit_time)); ?></td>
				</tr>
				<tr width="95%">
						<td  style="padding:5px;">Father / Spouse Name :  <?php echo $patient->parent_spouse; ?></td>
						<td>Address: <?php echo $patient->place; ?></td>
						<td>Phone : <?php echo $patient->phone; ?></td>
				</tr>
				<tr width="95%">
						<td>Department : <?php echo $patient->department; ?> </td>
						<td  style="padding:5px;"><?php echo $patient->visit_type;?> number : <?php echo $patient->hosp_file_no; ?></td>
						<td><?php if(!!$patient->outcome) echo $patient->outcome; else echo "Discharge"?> 
						Date: <?php 
						if(!!$patient->outcome_date) echo date("d-M-Y",strtotime($patient->outcome_date)); 
						if(!!$patient->outcome_time) echo date("g:iA",strtotime($patient->outcome_time)); 
						?></td>
				</tr>
				</tbody>
				<?php if(!!$patient->clinical_findings) { ?>
				<tr class="print-element" width="95%" height="80px">
					<td colspan="3">
					<b>Clinical Findings</b>: <?php echo $patient->clinical_findings;?>
					</td>
				</tr>
				<?php } ?>
				<?php 
				if(isset($tests) && count($tests)>0){ ?>				
				<tr  class="print-element" style="width:100%">
					<td colspan="3"><hr><b><u>Diagnositcs</u></b><br></td>
				</tr>
				<?php
					$count=0;
					$text_result_tests=array();
					foreach($tests as $test){	
						if($test->text_result==1 && $test->numeric_result == 0 && $test->binary_result == 0) {
							$text_result_tests[] = $test;
							array_splice($tests,$count,1);
							$count--;
						}
						$count++;
					}
					if(count($text_result_tests)>0) { 
				?>
				
							<?php 
							$o=array();
							foreach($text_result_tests as $order){
								$o[]=$order->order_id;
							}
							$o=array_unique($o);
							$i=1;
							foreach($o as $ord){	?>
								<?php
								foreach($text_result_tests as $order) { 
									if($order->order_id == $ord) { ?>
									<tr class="print-element" width="95%" height="40px">
										<td colspan="3">
											<span style="float:right"><?php echo $order->order_date_time;?></span>
											<b>Test: </b> <?php echo $order->test_name;?><br />
											<b>Report: </b><?php if($order->test_status==2 && $order->text_result == 1) echo $order->test_result_text; else echo "NA";?>
										</td>
									</tr>
								<?php
								}
								} ?>
							<?php } ?>
				<?php } 
				if(count($tests)>0){?>
				
				<tr class="print-element" width="95%" height="40px">
					<td colspan="3">
					<br>
						<table id="table-prescription">
						<tbody>
							<tr>
							<td style="width:3em">#</td>
							<td style="width:10em">Order Date</td>
							<td style="width:10em">Specimen</td>
							<td style="width:12em">Test</td>
							<td style="width:10em">Value</td>
							<td style="width:5em">Report - Binary</td>
							<td style="width:10em">Report</td>
							</tr>
							<?php 
							$o=array();
							foreach($tests as $order){
								$o[]=$order->order_id;
							}
							$o=array_unique($o);
							$i=1;
							foreach($o as $ord){	?>
								<?php
								foreach($tests as $order) { 
									if($order->order_id == $ord) { ?>
								<tr <?php if($order->test_status == 2) { ?> onclick="$('#order_<?php echo $ord;?>').submit()" <?php } ?>>
										<td><?php echo $i++;?></td>
										<td>
											<?php echo $order->order_id;?>
											</form>
										</td>
										<td><?php echo $order->specimen_type;?></td>
										<td>
										<?php
															if($order->test_status==1){
																$label="label-warning"; $status="Completed"; }
															else if($order->test_status == 2){ $label = "label-success"; $status = "Approved"; }
															else if($order->test_status == 0){ $label = "label-default"; $status = "Ordered"; }
															echo '<label class="label '.$label.'" title="'.$status.'">'.$order->test_name."</label><br />";									
											?>
										</td>
										<td>
											<?php if($order->test_status==2 && $order->numeric_result == 1) echo $order->test_result." ".$order->lab_unit; else echo "NA";?>
										</td>
										<td>
											<?php if($order->test_status==2 && $order->binary_result == 1) echo $order->test_result_binary; else echo "NA";?>
										</td>
										<td>
											<?php if($order->test_status==2 && $order->text_result == 1) echo $order->test_result_text; else echo "NA";?>
										</td>
								</tr>
								<?php
								}
								} ?>
							<?php } ?>
						</tbody>
						</table>	
					</td>
				</tr>
				<?php }
				} ?>
				<?php if(!!$patient->final_diagnosis) { ?>
				<tr class="print-element" width="95%" height="40px">
					<td colspan="3">
					<b>Final Diagnosis</b>: <?php echo $patient->final_diagnosis;?>
					</td>
				</tr>
				<?php } ?>
				<?php if(!!$patient->advise) { ?>
				<tr class="print-element" width="95%" height="40px">
					<td colspan="3">
					<b>Advise</b>: <?php echo $patient->advise;?>
					</td>
				</tr>
				<?php } ?>
				<?php if(isset($prescription) && !!$prescription){ ?>
				<tr class="print-element" width="95%">
					<td class="print-text" colspan="3">
					<hr>
						<b><u>Medicines Prescribed: </u></b>
					</td>
				</tr>
				<tr>
				<td colspan="3">
				
					<table id="table-prescription">
					<thead>
						<tr>
							<th rowspan="2" width="30px">S.no</th>
							<th rowspan="2" width="20%;">
							<img src="<?php echo base_url();?>assets/images/medicines.jpg" width="30px" alt="" />
							Medicine
							<img src="<?php echo base_url();?>assets/images/syrup.jpg" width="30px" alt="" /></th>
							<th rowspan="2" width="50px">Strength/ Quantity</th>
							<th rowspan="2" width="50px">Frequency</th>
							<th rowspan="2" width="50px"><img src="<?php echo base_url();?>assets/images/calendar.jpg" width="30px" alt="Days" /><br />Days</th>
							<th colspan="6" align="center" width="300px"><img src="<?php echo base_url();?>assets/images/timings.jpg" width="50px" height="40px" alt="Timings" />
							<span style="top:-10px;position:relative;">Timings</span></th>
						</tr>
						<tr align="center">
							<th colspan="2" width="30px"><img src="<?php echo base_url();?>assets/images/morning.jpg" width="30px" height="30px" />
							<span style="top:-10px;position:relative;">Morning</span>
							<br />
							<-<img src="<?php echo base_url();?>assets/images/food.jpg" alt="Food" width="30px" height="30px" />-></th>
							<th colspan="2" width="30px"><img src="<?php echo base_url();?>assets/images/afternoon.jpg" width="30px" height="30px" />
							<span style="top:-10px;position:relative;">Afternoon</span>
							<br />
							<-<img src="<?php echo base_url();?>assets/images/food.jpg" alt="Food" width="30px" height="30px" />-></th>
							<th colspan="2" width="30px"><img src="<?php echo base_url();?>assets/images/night.jpg" width="30px" height="30px" />
							<span style="top:-10px;position:relative;">Evening</span>
							<br />
							<-<img src="<?php echo base_url();?>assets/images/food.jpg" alt="Food" width="30px" height="30px" />-></th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$i=1;
					foreach($prescription as $pres){ ?>
					<tr>
						<td><?php echo $i++;?></td>
						<td><?php echo $pres->item_name;?></td>
						<td><?php echo $pres->quantity;?> <?php echo $pres->lab_unit;?></td>
						<td><?php echo $pres->frequency;?></td>
						<td><?php echo $pres->duration;?></td>
						<td><?php if($pres->morning == 1 || $pres->morning == 3) echo "<i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->morning == 2 || $pres->morning == 3) echo " <i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->afternoon == 1 || $pres->afternoon == 3) echo "<i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->afternoon == 2 || $pres->afternoon == 3) echo "<i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->evening == 1 || $pres->evening == 3) echo "<i class='fa fa-check'></i>";?></td>
						<td><?php if($pres->evening == 2 || $pres->evening == 3) echo "<i class='fa fa-check'></i>";?></td>
					</tr>
					<?php } ?>
					</tbody>
				</table>
				</td>
				</tr>
				<?php } ?>
				<tr class="print-element" width="95%" height="40px">
					<td colspan="3" style="text-align:right">
						<b>Doctor</b>
					</td>
				</tr>				
		</table>