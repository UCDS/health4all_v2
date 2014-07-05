<div class="col-md-8 col-md-offset-2">
	<?php if((isset($mode))&&(($mode)=="select")){ ?>
	<center><h3>Edit Antibody </h3></center><br>
	<?php echo form_open('diagnostics/edit/antibody',array('role'=>'form')); ?>
	
		<div class="form-group">
		<label for="antibody" class="col-md-4">Antibody<font color='red'>*</font></label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Antibody" id="antibody" name="antibody" 
		<?php if(isset($antibodys)){
			echo "value='".$antibodys[0]->antibody."' ";
			}
		?>
		/>
		<?php if(isset($antibodys)) { ?>
		<input type="hidden" value="<?php echo $antibodys[0]->antibody_id;?>" name="antibody_id" />
		
		<?php } ?>
		</div>
	</div>
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } ?>
	
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('diagnostics/edit/antibody',array('role'=>'form','id'=>'antibody_form','class'=>'form-inline','name'=>'antibody'));?>
	<h3> Search Antibody</h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr>
		<td><input type="text" class="form-control" placeholder="Antibody" id="antibody" name="antibody"> 
				<td><input class="btn btn-lg btn-primary btn-block" name="search" id="search" value="Search" type="submit" /></td>
	</tr>
	</tbody>
	</table>
	</form>
<?php if(isset($mode) && $mode=="search"){   ?>

	<h3 class="col-md-12">List of Antibodies </h3>
	<div class="col-md-12 ">
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th> Antibody</th>
	</thead>
	<tbody>
	<?php 
	$j=1;
	foreach($antibodys as $tg){ ?>

	<?php echo form_open('diagnostics/edit/antibody',array('id'=>'antibody_form_'.$tg->antibody_id,'role'=>'form')); ?>
	<tr onclick="$('#antibody_form_<?php echo $tg->antibody_id;?>').submit();" >
		<td><?php echo $j++; ?></td>
		<td><?php echo $tg->antibody; ?>
		<input type="hidden" value="<?php echo $tg->antibody_id; ?>" name="antibody_id"/>
		<input type="hidden" value="select" name="select" />
		</td>
	</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
		<?php } ?>
</div>
</div>