<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>  
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-barcode.min.js"></script>  
<br><table style='border-collapse:collapse;padding-top:0px; vertical-align: top;' width='100%'><tr>
<?php
$count=0;
for($i=1;$i<=1;$i++)
{?>
   <script>
$(document).ready(function() {
			var settings = {
				barWidth: 1,
				barHeight: 30,
				moduleSize: 5,
				showHRI:false,
				addQuietZone: true,
				marginHRI: 5,
				bgColor: "#FFFFFF",
				color: "#000000",
				fontSize: 10,
				output: "css",
				posX: 0,
				posY: 0
				};
				var patient = "<?php echo $registered->patient_id; ?>";
				$("#barcode").barcode(
					patient, // Value barcode (dependent on the type of barcode)
					"code128", // type (string)
				settings
				);
				$("#barcod").barcode(
					patient, // Value barcode (dependent on the type of barcode)
					"code128", // type (string)
				settings
				);
				$("#barco").barcode(
					patient, // Value barcode (dependent on the type of barcode)
					"code128", // type (string)
				settings
				);
				$("#barc").barcode(
					patient, // Value barcode (dependent on the type of barcode)
					"code128", // type (string)
				settings
				);
		});
            
		</script>
<?php $count++; ?>
<td bgcolor='#fff' style='padding-left:<?php if($count%2==0) echo "26px"; else echo "6px"; ?>;'>
		<table style='border-collapse:collapse;table-layout:auto;' width='100%'>
			<tr>
			    <td><div id="barcode"></div></td>
				<td colspan="2">
				<img style="float:right" style="margin-top:-20px" src="<?php echo base_url();?>assets/images/ap-logo.png" width="60px" />
				<img style="float:left" src="<?php echo base_url();?>assets/images/<?php $hospital=$this->session->userdata('hospital');echo $hospital['logo'];?>" width="60px" />
				<div style="float:middle;text-align:center">
				    <?php echo $hospital['state'];?></b><br />
				    <font size="2"><?php echo $hospital['hospital'];echo ",";?>
					<?php echo $hospital['description'];?> 
					<?php echo $hospital['district'];?></font>
					<?php echo $hospital['state'];echo ".";?>

				    </div>
			   </td>
			</tr>
			<tr>
				<td>
				</td>
				<td colspan="2">
					<span style='font-size:12px;' colspan="2">Dt. Of Reg: </span><span style='font-size:10px;font-weight:bold;'><?php echo ' '.date("d-M-Y",strtotime($registered->admit_date));?></span>
				</td>
			</tr>
			<tr >
				<td colspan="2">
                                    <span style='font-size:12px;'>Patient ID: </span><span style='font-size:10px;font-weight:bold;'> <?php echo $registered->patient_id;if($registered->patient_id_manual != '') echo $registered->patient_id_manual; ?></span>
				</td>
			</tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td rowspan='6'>
                                    <img src="<?php echo base_url();?>assets/images/patient.png" width='75px;' height='75px;' />
                            </td>
                        </tr>
			<tr>
				<td colspan="2">
                                    <span style='font-size:10px;'>Patient Name: </span>
                                    <span style='font-size:10px;font-weight:bold'> <?php echo ' '.$registered->name;?></span>
				</td>
			</tr>
            <tr>
				<td>
					<span style='font-size:10px;'>Age/Gender: </span>
					<span style='font-size:10px;font-weight:bold'><?php echo ' '.$registered->age_years;?>y/<?php echo ' '.$registered->gender;?></span>
				</td>
            </tr>
			<tr>
				<td>
					<span style='font-size:10px;'>S/O W/O: </span><span style='font-size:10px;font-weight:bold'><?php echo $registered->parent_spouse;?></span>
				</td>
			</tr>
			<tr>
				<td>
					<span style='font-size:10px;'>ID: </span>
					<span style='font-size:10px;font-weight:bold;'><?php if(!!$registered->id_proof_number){ echo $registered->id_proof_type." - ".$registered->id_proof_number;} ?></span>
				</td>
			</tr>
			<tr>
				<td>
					<span style='font-size:10px;'>Perm Addr: </span>
					<span style='font-size:10px;font-weight:bold;'><?php echo $registered->address; ?></span>
				</td>
			</tr>
            <tr>
				<td>
					<span style='font-size:10px;'>Mobile No: </span>
					<span style='font-size:10px;font-weight:bold'><?php echo ' '.$registered->phone;?></span>
				</td>
            </tr>
		</table>
	</td>
	<td bgcolor='#fff' style='padding-left:<?php if($count%2==0) echo "26px"; else echo "6px"; ?>;'>
		<table style='border-collapse:collapse;table-layout:auto;' width='100%'>
			<tr>
			    <td><div id="barcod"></div></td>
				<td colspan="2">
				<img style="float:right" style="margin-top:-20px" src="<?php echo base_url();?>assets/images/ap-logo.png" width="60px" />
				<img style="float:left" src="<?php echo base_url();?>assets/images/<?php $hospital=$this->session->userdata('hospital');echo $hospital['logo'];?>" width="60px" />
				<div style="float:middle;text-align:center">
				    <?php echo $hospital['state'];?></b><br />
				    <font size="2"><?php echo $hospital['hospital'];echo ",";?>
					<?php echo $hospital['description'];?> 
					<?php echo $hospital['district'];?></font>
					<?php echo $hospital['state'];echo ".";?>

				    </div>
			   </td>
			</tr>
			<tr>
				<td>
				</td>
				<td colspan="2">
					<span style='font-size:12px;' colspan="2">Dt. Of Reg: </span><span style='font-size:10px;font-weight:bold;'><?php echo ' '.date("d-M-Y",strtotime($registered->admit_date));?></span>
				</td>
			</tr>
			<tr >
				<td colspan="2">
                                    <span style='font-size:12px;'>Patient ID: </span><span style='font-size:10px;font-weight:bold;'> <?php echo $registered->patient_id; if($registered->patient_id_manual != '') echo $registered->patient_id_manual; ?></span>
				</td>
			</tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td rowspan='6'>
                                    <img src="<?php echo base_url();?>assets/images/patient.png" width='75px;' height='75px;' />
                            </td>
                        </tr>
			<tr>
				<td colspan="2">
                                    <span style='font-size:10px;'>Patient Name: </span>
                                    <span style='font-size:10px;font-weight:bold'> <?php echo ' '.$registered->name;?></span>
				</td>
			</tr>
            <tr>
				<td>
					<span style='font-size:10px;'>Age/Gender: </span>
					<span style='font-size:10px;font-weight:bold'><?php echo ' '.$registered->age_years;?>y/<?php echo ' '.$registered->gender;?></span>
				</td>
            </tr>
			<tr>
				<td>
					<span style='font-size:10px;'>S/O W/O: </span><span style='font-size:10px;font-weight:bold'><?php echo $registered->parent_spouse;?></span>
				</td>
			</tr>
			<tr>
				<td>
					<span style='font-size:10px;'>ID: </span>
					<span style='font-size:10px;font-weight:bold;'><?php if(!!$registered->id_proof_number){ echo $registered->id_proof_type." - ".$registered->id_proof_number;} ?></span>
				</td>
			</tr>
			<tr>
				<td>
					<span style='font-size:10px;'>Perm Addr: </span>
					<span style='font-size:10px;font-weight:bold;'><?php echo $registered->address; ?></span>
				</td>
			</tr>
            <tr>
				<td>
					<span style='font-size:10px;'>Mobile No: </span>
					<span style='font-size:10px;font-weight:bold'><?php echo ' '.$registered->phone;?></span>
				</td>
            </tr>
		</table>
	</td>
<?php
if($count%2==0){echo "</tr><tr>";}
}
echo "</tr></table>";
