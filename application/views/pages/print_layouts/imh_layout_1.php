<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-barcode.min.js"></script>  
<br><table style='border-collapse:collapse;padding-top:0px; vertical-align: top;' width='100%'><tr>
<?php
$count=0;
for($i=1;$i<=2;$i++)
{?>
                <script>
                    $(function(){
			$("#barcode_<?php echo $i; ?>").barcode("<?php echo $registered->patient_id;?>",'int25',{barWidth:2, barHeight:30,showHRI:false});
			});
		</script>
<?php $count++; ?>
<td bgcolor='#fff' style='padding-left:<?php if($count%2==0) echo "6px"; else echo "12px"; ?>;'>
		<table style='border-collapse:collapse;table-layout:auto;' width='100%'>
			<tr>
				<td><div id="barcode_<?php echo $i;?>"></div></td>
                                <td colspan="2">
                                    <img style='float:right;margin-right:20px;' src="<?php echo base_url();?>assets/images/telangana-logo.png" width='40px;' height='40px;'><span style='font-size:15px;font-weight:bold;'>Institute of Mental Health, Erragadda, Hyderabad-38.</span>
                                </td>
			</tr>
			<tr >
				<td>
                                    <span style='font-size:10px;'>Patient ID: </span><span style='font-size:15px;font-weight:bold;'> <?php /* echo $registered->patient_id; */ if($registered->patient_id_manual != '') echo $registered->patient_id_manual; ?></span>
				</td>
                                <td>
                                    <span style='font-size:10px;'>Dt. Of Reg: </span><span style='font-size:15px;font-weight:bold;'><?php echo ' '.date("d-M-Y",strtotime($registered->admit_date));?></span>
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
                                    <span style='font-size:15px;font-weight:bold'> <?php echo ' '.$registered->name;?></span>
				</td>
			</tr>
                        <tr>
                            <td>
				<span style='font-size:10px;'>Age/Gender: </span>
                                <span style='font-size:15px;font-weight:bold'><?php echo ' '.$registered->age_years;?>y/<?php echo ' '.$registered->gender;?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span style='font-size:10px;'>S/O: </span><span style='font-size:15px;font-weight:bold'><?php echo $registered->father_name;?></span>
                            </td>
                        </tr>
			<tr>
				<td colspan="2">
                                    <span style='font-size:10px;'>Unit/Chief: </span><span style='font-size:15px;font-weight:bold'><?php echo $registered->unit_name;?></span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
                                    <span style='font-size:10px;'>Perm Addr: </span>
                                    <?php 
                                        $font_size = '15';
                                        $yousee_font_size = '7';
                                        $dummy = '';
                                        if(strlen($registered->address) > 66){
                                            $font_size = '12';
                                        }
                                        if(strlen($registered->address) < 74){
                                            $yousee_font_size = '15';
                                        }
                                        if(strlen($registered->address) < 37){
                                            $dummy = '<br>&nbsp;';
                                        }
                                    ?>
                                    <span style='float:left;font-size:<?php echo $font_size; ?>px;font-weight:bold;'><?php echo $registered->address.$dummy;?></span>
				</td>
			</tr>
			<tr>
				<td colspan='3'><span style='font-size:<?php echo $yousee_font_size; ?>;'>Designed and Developed by YouSee(www.yousee.in)</span></td>
			</tr>
		</table><br/>
	</td>
<?php
if($count%2==0){echo "</tr><tr>";}
}
echo "</tr></table>";