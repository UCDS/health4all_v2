<?php
$send_email=0;
foreach($order_mail as $test){ if($test->test_status == 2) $send_email = 1; }
if(filter_var($email, FILTER_VALIDATE_EMAIL) && $send_email==1){
	$age="";
	if($order_mail[0]->age_years!=0) $age.=$order_mail[0]->age_years."Y ";
	if($order_mail[0]->age_months!=0) $age.=$order_mail[0]->age_months."M ";
	if($order_mail[0]->age_days!=0) $age.=$order_mail[0]->age_days."D ";
	$body = "<table style='border:0px;border-collapse:collapse;width:100%'>
		<thead>
		<tr style='border:0px solid black;padding:5px;'>
			<th colspan='4' style='border:0px solid black;padding:5px;'>".$departments[0]->department."</td>
		</tr>
		<tr style='border:0px solid black;padding:5px;'>
			<th colspan='4' style='border:0px solid black;padding:5px;'>".$order_mail[0]->hospital.", ".$order_mail[0]->place.", ".$order_mail[0]->district.", ".$order_mail[0]->state."</td>
		</tr>
		<tr style='border:0px solid black;padding:5px;'>
			<th colspan='4' style='border:0px solid black;padding:5px;text-decoration:underline'>".$order_mail[0]->test_method." Results</td>
		</tr>
		<tr>
			<td colspan='2' style='border:0px solid black;padding:5px;'>Order Date: ".date("d-M-Y g:ia",strtotime($order_mail[0]->order_date_time))."</td>
			<td colspan='2' style='border:0px solid black;padding:5px;'>Reported Date: ".date("d-M-Y g:ia",strtotime($order_mail[0]->reported_date_time))."</td>
		</tr>
		<tr>
			<td colspan='3' style='border:0px solid black;padding:5px;'><b>Patient: </b>".$order_mail[0]->first_name." ".$order_mail[0]->last_name." | $age | ".$order_mail[0]->gender."</td>
			<td style='border:0px solid black;padding:5px;'><b>".$order_mail[0]->visit_type."</b> #".$order_mail[0]->hosp_file_no."</td>
		</tr>
		<tr>
			<td colspan='2' style='border:0px solid black;padding:5px;'><b>Department : </b>".$order_mail[0]->department."</td>
			<td colspan='2'style='border:0px solid black;padding:5px;'><b>Unit/Area : </b>".$order_mail[0]->unit_name." / ".$order_mail[0]->area_name."</td>
		</tr>
		</thead>
		</table>
		<table style='border:1px solid #ccc;border-collapse:collapse; width:100%'>
		<tr>
			<th style='border:1px solid black;padding:5px;'>Test</th>
			<th style='border:1px solid black;padding:5px;'>Value</th>
			<th colspan='2' style='border:1px solid black;padding:5px;'>Report</th>
		</tr>";		
	foreach($order_mail as $test){ 
			$positive='';$negative='';
		 if($test->test_status!=2){continue;}
	$body.= "<tr>
			<td style='border:1px solid black;padding:5px;'>
				$test->test_name
			</td>
			<td style='border:1px solid black;padding:5px;'>";
	if($test->numeric_result==1){ 

					if($test->test_status == 2) { 
						$result=$test->test_result.' '.$test->lab_unit; 
					} 
					else{	
						$result='';
					}
					$body.=  $result;
				}
						else $body.=  '-';
			
			$body.= "</td>
			<td style='border:1px solid black;padding:5px;'>";
			if($test->binary_result==1){
					if($test->test_status == 2) { 
						if($test->test_result_binary == 1 ) $result=$test->binary_positive ; 
						else $result=$test->binary_negative ; 
					} 
					else{	
						$result='';
					}
				$body.= $result;
			}
				else $body.='-';
				if($test->test_result_binary==1 && preg_match('^Culture*^',$test->test_method)) { 
				$micro_organism_test_ids = array();
				$res = explode('^',trim($test->micro_organism_test,'^'));
				$k=0;
				foreach($res as $r) {
					$temp=explode(',',trim($r,' ,'));
					$temp[3]==1?$temp[3]='Sensitive':$temp[3]='Resistant';
					if(!in_array($temp[0],$micro_organism_test_ids)){
						if(count($micro_organism_test_ids)>0) $body.=  '</div></div></div>';
						$body.= "<div class='col-md-12'><div style='background:white;font-size:0.7em;'>
							<b>$temp[1]</b>
							<div class='row'>
							<div class='col-md-6'>$temp[2] - $temp[3]</div>";
						$micro_organism_test_ids[]=$temp[0];
					}
					else $body.="<div class='col-md-6'>$temp[2] - $temp[3]</div>";	
					$k++;
					if($k==count($res))
						$body.=  '</div></div></div>';
					}
					
				}
			$body.= "</td>";
			$body.= "<td style='border:1px solid black;padding:5px;'>";
			if($test->text_result==1){ 

				if($test->test_status == 2) { 
					$result= " $test->test_result_text";
				} 
				else{	
					$result='';
				}
				$body .= $result;
			 }
						else $body.='-'; 
		$body.= "</td></tr>";
		}
			$from_name = $departments[0]->department;
			$body.= "</table>";
			$to=$email;
			if($to!=''){
			$subject="Test Order #$test->order_id for patient $test->visit_type#$test->hosp_file_no is complete!";
			$mailbody="
			<div style='width:90%;padding:5px;margin:5px;font-style:\"Trebuchet MS\";border:1px solid #eee;'>
			<br />$body
			</div>";
			}
			$from = $departments[0]->department_email;
			if(!!$from){
			$this->email->from("$from", "$from_name - Gandhi Hospital");
			$this->email->to($to);
			$this->email->bcc("contact@yousee.in");
			$this->email->subject($subject);
			$this->email->message($mailbody);
			if ( ! $this->email->send()) {
				$this->email->print_debugger();
			}
			else{
				$this->email->clear(TRUE);
			}
			}
}
?>