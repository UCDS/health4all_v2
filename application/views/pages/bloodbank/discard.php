
<div class="col-md-10 col-sm-9">
	<?php echo form_open('bloodbank/inventory/discard');?>
	<input type="text" placeholder="Blood Unit Number" name="blood_unit_num" />
	<input type="submit" value="Search" name="search" />
	</form>
	<?php
	$search="";
	$expired="";
	$expiring="";
	$under_collection="";
	$screening_failed="";
	if(isset($msg)) {
		echo $msg;
		echo "<br />";
		echo "<br />";
	}
	?>
        
	<div>
		<?php if(count($inventory)==0){
			echo "Empty.";
		}
		else{
		?>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="">Note:</span>
                    <ul>
                        <li>You have to Click on Discard button to remove expired bag from inventory.</li>
                        <li>Bags show up here if:
                            <ul>
                                <li>They have expired.</li>
                                <li>They have failed screening(Do not show up in inventory).</li>
                                <li>UC(Under Collection), if the volume collected is less than the volume of the bag(Do not show up in inventory).</li>
                            </ul>
                        </li>
                    </ul>
                    
                </div>
		<h3>Inventory : </h3>
		<table id="header-fixed" class="table-2 table table-striped table-bordered"></table>
		<table class="table-2 table table-striped table-bordered" id="table-1">
		<thead><th>Blood Unit No.</th><th>Component Type</th><th>Blood Group</th><th>Expiry Date</th><th>Status</th><th>Notes</th><th></th></thead>
		<?php 
		foreach($inventory as $inv){
			if($this->input->post('search')){
				$search.="<tr>";
				$search.=form_open('bloodbank/inventory/discard');
				$search.="<input type='text' value='".$inv->inventory_id."' readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv->expiry_date))."</td>";
				$search.="<td>$inv->don_status /<br /> $inv->inv_status</td>";
				$search.="<td><input type='text' name='notes' required /></td>
					<td><input type='submit' value='Discard'  name='discard' /></td>
				</form>
				</tr>";
			}
			else{
			if($inv->donation_status==3){
				$under_collection.="<tr>";
				$under_collection.=form_open('bloodbank/inventory/discard');
				$under_collection.="<input type='text' value='".$inv->inventory_id."' readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv->expiry_date))."</td>";
				$under_collection.="<td>$inv->don_status /<br /> $inv->inv_status</td>";
				$under_collection.="<td><input type='text' value='Under Collection' name='notes' required /></td>
					<td><input type='submit' value='Discard'  name='discard' /></td>
				</form>
				</tr>";
			}
			else if($inv->donation_status==6 && $inv->screening_result==0){
				$screening_failed.="<tr>";
				$screening_failed.=form_open('bloodbank/inventory/discard');
				$screening_failed.="<input type='text' value='".$inv->inventory_id."' readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv->expiry_date))."</td>";
				$screening_failed.="<td>$inv->don_status /<br /> $inv->inv_status</td>";
				$screening_failed.="<td><input type='text' value='Screening failed.' name='notes' required /></td>
					<td><input type='submit' value='Discard'  name='discard' /></td>
				</form>
				</tr>";
			}
			else if($inv->expiry_date>date('Y-m-d',strtotime("+7 Days"))){
				continue;
			}
			else if($inv->expiry_date>=date('Y-m-d')){
				$expiring.="<tr>";
				$expiring.=form_open('bloodbank/inventory/discard');
				$expiring.="<input type='text' value='".$inv->inventory_id."' readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv->expiry_date))."</td>";
				$expiring.="<td>$inv->don_status /<br /> $inv->inv_status</td>";
				$expiring.="<td></td>
					<td><input type='submit' value='Discard' name='discard'   /></td>
				</form>
				</tr>";			
			}
			else if($inv->expiry_date<date('Y-m-d')){
				$expired.="<tr>";
				$expired.=form_open('bloodbank/inventory/discard');
				$expired.="<input type='text' value='".$inv->inventory_id."' readonly name='inventory_id' size='3' hidden />
					<td>$inv->blood_unit_num</td>		
					<td>$inv->component_type</td>
					<td>$inv->blood_group</td>		
					<td>".date('d-M-Y',strtotime($inv->expiry_date))."</td>";
				$expired.="<td>$inv->don_status /<br /> $inv->inv_status</td>";
				$expired.="<td><input type='text' value='Expired' name='notes' required /></td>
					<td><input type='submit' value='Discard' name='discard'  /></td>
				</form>
				</tr>";
			}
			}
		}
		
			if($expiring!=""){
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Expiring in the next 7 days</font></th></tr>
			<?php
				echo $expiring;
			}
			if($expired!=""){
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Expired Blood</font></th></tr>
			<?php
				echo $expired;
			}
			if($under_collection!=""){
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Under Collection</font></th></tr>
			<?php
				echo $under_collection;
			}
			if($screening_failed!=""){
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Screening failed</font></th></tr>
			<?php
				echo $screening_failed;
			}
			if($search!=""){
			?>
			
			<tr><th colspan="10" style="background-color:#333;color:white;"><font size="3">Searched for..</font></th></tr>
			<?php
				echo $search;
			}
		}
		?>
		</table>
			
	</div>
</div>
