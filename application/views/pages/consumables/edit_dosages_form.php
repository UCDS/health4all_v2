<div class="col-md-8 col-md-offset-2">

	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3>Edit  Dosage Details</h3></center><br>
	<?php echo form_open('consumables/masters/edit/dosages',array('role'=>'form')); ?>


		<div class="form-group">
		<label for="agency_name" class="col-md-4">Dosage<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Dosage " id="agency_name" name="dosage" 
		<?php if(isset($dosage)){
			echo "value='".$dosage[0]->dosage."' ";
			}
		?>
		/>
		<?php if(isset($dosage)) { ?>
		<input type="hidden" value="<?php echo $dosage[0]->dosage_id;?>" name="dosage_id" />
		
		<?php } ?>
		</div>
	</div>
	<div class="form-group">
		<label for="agency_name" class="col-md-4">Dosage Unit<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Dosage Unit" id="agency_name" name="dosage_unit" 
		<?php if(isset($dosage)){
			echo "value='".$dosage[0]->dosage_unit."' ";
			}
		?>
		/>
		<?php if(isset($dosage)){ ?>
		<input type="hidden" value="<?php echo $dosage[0]->dosage_id;?>" name="dosage_id" />
		
		<?php } ?>
		</div>
	</div>

<!--<div class="form-group">
		<label for="agency_name" class="col-md-4">Dosage Unit<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder=" Dosage Unit" id="agency_name" name="dosage_unit" 
		<?php if(isset($dosage)){
			echo "value='".$dosage[0]->dosage_unit."' ";
			}
		?>
		/>
		<?php if(isset($dosage)){ ?>
		<input type="hidden" value="<?php echo $dosage[0]->dosage_id;?>" name="drug_type_id" />
		
		<?php } ?>
		</div>
	</div>-->

<!--
			<div class="form-group">
		<label for="item_type" class="col-md-4">Item Name</label>
		<div  class="col-md-8">
	<select name="item_type" id="division" class="form-control">
		<option value="">Items</option>
		<?php foreach($item_type as $d){
			echo "<option value='$d->item_type_id'>$d->item_type</option>";
		if(isset($generic) && $generic[0]->generic_item_id==$d->item_type_id)
		{		echo "selected";
			echo ">$d->item_type</option>";
		}
			
		}
		?>
		</select>
			
	</div></div>-->
<!--
		<div class="form-group">
		<label for="agency_contact_name" class="col-md-4">Agency Contact Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Contact Name" id="agency_contact_name" name="agency_contact_name" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_contact_name."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="agency_contact_designation" class="col-md-4">Agency Designation</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Designation" id="agency_contact_designation" name="agency_contact_designation"
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_contact_designation."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="agency_address" class="col-md-4">Agency Address</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Address" id="agency_address" name="agency_address" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_address."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="agency_contact_number" class="col-md-4">Agency Contact No</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Contact Number" id="agency_contact_number" name="agency_contact_number" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_contact_number."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="agency_email_id" class="col-md-4">Agency Email Id</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Agency Email Id" id="agency_email_id" name="agency_email_id" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->agency_email_id."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="account_no" class="col-md-4">Account No</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Account No" id="account_no" name="account_no" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->account_no."' ";
			}
		?>
		/>
		</div></div>

		<div class="form-group">
		<label for="bank_name" class="col-md-4">Bank Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Bank Name" id="bank_name" name="bank_name" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->bank_name."' ";
			}
		?>
		/>
</div></div>


		<div class="form-group">
		<label for="branch" class="col-md-4">Branch</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Branch" id="branch" name="branch" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->branch."' ";
			}
		?>
		/>
</div></div>
		<div class="form-group">
		<label for="pan" class="col-md-4">Pan</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="pan" id="pan" name="pan" 
		<?php if(isset($agency)){
			echo "value='".$agency[0]->pan."' ";
			}
		?>
		/>

		</div>

	</div> -->
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } ?>
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('consumables/masters/edit/dosages',array('role'=>'form','id'=>'search_form','class'=>'form-inline','name'=>'search_dosages'));?>
	<h3> Search Dosage Type </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td><input type="text" class="form-control" placeholder=" Dosage" id="agency_name" name="dosage_name"> 
		
				<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of Dosages </h3>
	<div class="col-md-12 "><!--<strong>
	<?php if($this->input->post('drug_type')) echo "drug name starting with : ".$this->input->post('drug_name'); ?>
	</strong>-->
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>Dosage </th><th>Dosage Unit</th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($dosage as $a){ ?>
	<?php echo form_open('consumables/masters/edit/dosages',array('id'=>'select_dosages_form_'.$a->dosage_id,'role'=>'form')); ?>
	<tr onclick="$('#select_dosages_form_<?php echo $a->dosage_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $a->dosage; ?>
		<input type="hidden" value="<?php echo $a->dosage_id; ?>" name="dosage_id" />
		<input type="hidden" value="select" name="select" />
		</td>
		<td><?php echo $a->dosage_unit; ?></td>
			</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div></div>	