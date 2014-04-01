<div class="col-md-8 col-md-offset-2">

	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3>Edit  Drug Type Details</h3></center><br>
	<?php echo form_open('consumables/masters/edit/drugs',array('role'=>'form')); ?>


		<div class="form-group">
		<label for="agency_name" class="col-md-4">Drug Name<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Drug Name" id="agency_name" name="drug_type" 
		<?php if(isset($drug)){
			echo "value='".$drug[0]->drug_type."' ";
			}
		?>
		/>
		<?php if(isset($drug)) { ?>
		<input type="hidden" value="<?php echo $drug[0]->drug_type_id;?>" name="drug_type_id" />
		
		<?php } ?>
		</div>
	</div>
<div class="form-group">
		<label for="agency_name" class="col-md-4">Description<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Generic Name" id="agency_name" name="description" 
		<?php if(isset($drug)){
			echo "value='".$drug[0]->description."' ";
			}
		?>
		/>
		<?php if(isset($drug)){ ?>
		<input type="hidden" value="<?php echo $drug[0]->drug_type_id;?>" name="drug_type_id" />
		
		<?php } ?>
		</div>
	</div>

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
	<?php echo form_open('consumables/masters/edit/drugs',array('role'=>'form','id'=>'search_form','class'=>'form-inline','name'=>'search_drugs'));?>
	<h3> Search Drug Type </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td><input type="text" class="form-control" placeholder="Drug type" id="agency_name" name="drug_type"> 
		
		<!--<select name="drug_type" id="search_generic_name" form='search_form' class="form-control" style="width:180px">
		<option value="" disabled selected>Drug Type</option>
		<?php foreach($drug as $drug_type){
			echo "<option value='$drug_type->drug_type_id'>$drug_type->drug_type</option>";
		}
		?>
		</select>--></td>		
				<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of Drug Types</h3>
	<div class="col-md-12 "><!--<strong>
	<?php if($this->input->post('drug_type')) echo "drug name starting with : ".$this->input->post('drug_name'); ?>
	</strong>-->
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>Drug Name </th><th>Description</th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($drug as $a){ ?>
	<?php echo form_open('consumables/masters/edit/drugs',array('id'=>'select_drug_form_'.$a->drug_type_id,'role'=>'form')); ?>
	<tr onclick="$('#select_drug_form_<?php echo $a->drug_type_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $a->drug_type; ?>
		<input type="hidden" value="<?php echo $a->drug_type_id; ?>" name="drug_type_id" />
		<input type="hidden" value="select" name="select" />
		</td>
		<td><?php echo $a->description; ?></td>
			</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div></div>