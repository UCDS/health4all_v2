<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-barcode.min.js"></script>  
<br><center><table style='border-collapse:collapse;padding-top:0px;' width='100%'><tr>
<?php
$count=0;
for($i=1;$i<=4;$i++)
{?>
                <script>
                    $(function(){
			$("#barcode_<?php echo $i; ?>").barcode("<?php echo $registered->patient_id;?>",'int25',{barWidth:2, barHeight:30,showHRI:false});
			});
		</script>
<?php $count++; ?>
<td bgcolor='#fff' style='padding-left:12px;'>
		<table cellpadding='2' style='border-collapse:collapse' width='100%'>
			<tr>
				<td><div id="barcode_<?php echo $i;?>"></div> 
				</td>
				<td>
                                    <img style='float:right;margin-right:20px;' src="<?php echo base_url();?>assets/images/uc-logo.png" width='40px;' height='40px;'><span style='font-size:12px;font-weight:bold;'>Institute of Mental Health, Erragadda, Hyderabad-38.</span>
				</td>
			</tr>
			<tr >
				<td colspan='2' height='30'>
					<span style='font-size:10px;float:left;'>Patient ID : </span><span style='font-size:10px;font-weight:bold;float:left;'> <?php echo $registered->patient_id; //if($registered->patient_id_manual != '') echo '/'.$registered->patient_id_manual; ?></span>
					<span style='font-size:10px;font-weight:bold;float:right;margin-right:20px;'><?php echo $registered->admit_date;?></span><span style='font-size:10px;float:right;'>Dt. Of Reg : </span>
				</td>
			</tr>
			<tr>
				<td colspan='2' height='30'>
					<span style='float:left;font-size:10px;'>Patient Name : </span><span style='font-size:10px;font-weight:bold'> <?php echo $registered->name;?></span>
				</td>
			</tr>
			<tr>
				<td width='40%'>
					<span style='float:left;font-size:10px;'>Age/Gender : </span><span style='font-size:10px;font-weight:bold'><?php echo $registered->age_years;?>y/<?php echo $registered->gender;?></span>
				</td>
				<td rowspan='3'>
					<img style='margin-left:80px;' src="<?php echo base_url();?>assets/images/patient.png" width='90px;' height='90px;' />
				</td>
			</tr>
			<tr padding='10px'>
				<td co>
					<span style='float:left;font-size:10px;'>S/O. : </span><span style='font-size:10px;font-weight:bold'><?php echo $registered->father_name;?></span>
				</td>
			</tr>
			<tr>
				<td>
					<span style='float:left;font-size:10px;'>Unit/Chief : </span><span style='font-size:10px;font-weight:bold'><?php echo $registered->unit_name;?></span>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<span style='float:left;font-size:10px;'>Permanent Address : </span><span style='float:left;font-size:10px;font-weight:bold;'><?php echo $registered->address;?></span>
				</td>
			</tr>
			<tr>
				<td colspan='2' rowspan='2' height='10'><span style='float:right;margin-right:20px;font-size:10px;'>Designed and Developed by Yousee. Visit www.yousee.in for more.</span></td>
			</tr>
		</table><br/>
	</td>
<?php
if($count%2==0){echo "</tr><tr>";}
}
echo "</tr></table></center>";