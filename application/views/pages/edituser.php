<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/selectize.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/patient_field_validations.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
<link rel="stylesheet"  type="text/css" href="<?php echo base_url();?>assets/css/bootstrap_datetimepicker.css">
<link rel="stylesheet"  type="text/css" href="<?php echo base_url();?>assets/css/patient_field_validations.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-barcode.min.js"></script>
<style>
    .obstetric_history_table {  
        border-collapse: collapse; 
    }
    .obstetric_history_table tr{
        display: block; float: left;
    }
    .obstetric_history_table td{
        display: block; 
        border: 1px solid black;
        height: 55px;
    }
</style>
<style>
    .obstetric_history_table {  
        border-collapse: collapse; 
    }
    .obstetric_history_table tr{
        display: block; float: left;
    }
    .obstetric_history_table td{
        display: block; 
        border: 1px solid black;
        height: 55px;
    }
</style>


<style>
	.row{
		margin-bottom: 1.5em;
	}
	.alt{
		margin-bottom:0;
		padding:0.5em;
	}
	.alt:nth-child(odd){
		background:#eee;
	}
		.selectize-control.repositories .selectize-dropdown > div {
			border-bottom: 1px solid rgba(0,0,0,0.05);
		}
		.selectize-control.repositories .selectize-dropdown .by {
			font-size: 11px;
			opacity: 0.8;
		}
		.selectize-control.repositories .selectize-dropdown .by::before {
			content: 'by ';
		}
		.selectize-control.repositories .selectize-dropdown .name {
			font-weight: bold;
			margin-right: 5px;
		}
		.selectize-control.repositories .selectize-dropdown .title {
			display: block;
		}
		.selectize-control.repositories .selectize-dropdown .description {
			font-size: 12px;
			display: block;
			color: #a0a0a0;
			white-space: nowrap;
			width: 100%;
			text-overflow: ellipsis;
			overflow: hidden;
		}
		.selectize-control.repositories .selectize-dropdown .meta {
			list-style: none;
			margin: 0;
			padding: 0;
			font-size: 10px;
		}
		.selectize-control.repositories .selectize-dropdown .meta li {
			margin: 0;
			padding: 0;
			display: inline;
			margin-right: 10px;
		}
		.selectize-control.repositories .selectize-dropdown .meta li span {
			font-weight: bold;
		}
		.selectize-control.repositories::before {
			-moz-transition: opacity 0.2s;
			-webkit-transition: opacity 0.2s;
			transition: opacity 0.2s;
			content: ' ';
			z-index: 2;
			position: absolute;
			display: block;
			top: 12px;
			right: 34px;
			width: 16px;
			height: 16px;
			background: url(<?php echo base_url();?>assets/images/spinner.gif);
			background-size: 16px 16px;
			opacity: 0;
		}
		.selectize-control.repositories.loading::before {
			opacity: 0.4;
		}
</style>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.selectize.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.timeentry.min.js"></script>

<div class="row">
		<div class="col-md-12 alt" id="create_followup">

					<table class="table table-striped table-bordered" id="followup_table">
					<thead>
						<tr>
						<th  class="text-center">Follow Up Category</th>
						<th  class="text-center">Follow Up Status</th>
						<th  class="text-center">Status Reason</th>
						<th  class="text-center">Follow Up Speciality</th>
						<th  class="text-center">Assigned to </th>
						<th  class="text-center">Follow Up Target Date</th>

					<!--	<th rowspan="3" class="text-center">Issued Quantity</th> -->
						</tr>

													
					</thead>
					<tbody>
						<tr>
						<td>
							<select name="followup_category[]" class="form-control">
								<option value="">--Select--</option>
								<?php foreach($follow_ups as $follow_up): ?>
									<option value="<?php echo $follow_up->follow_up_category_id;?>" id="follow_up_category"><?php echo $follow_up->follow_up_category;?></option>
								<?php endforeach; ?>
								
								</select>
							</td>
							<td>
								<select name="followup_status[]" class="form-control">
								<option value="" selected>--SELECT--</option>
								<?php foreach($follow_up_status as $follow_up_stat): ?>
								<option value="<?php echo $follow_up_stat->follow_up_status_id;?>" id="follow_up_status"><?php echo $follow_up_stat->follow_up_status;?></option>
								<?php endforeach; ?>				
							</select>	
							</td>
						
							<td>
								<select name="followup_statusreason[]" class="form-control">
									<option value="" selected>--SELECT--</option>
									<?php foreach($follow_up_status_reason as $follow_up): ?>
									<option value="<?php echo $follow_up->follow_up_status_reason_id;?>"><?php echo $follow_up->follow_up_status_reason;?></option>
								<?php endforeach; ?>
								</select>	
							</td>
							<td>
								<select name="followup_clinicalspeciality[]" class="form-control">
							<option value="" selected>--SELECT--</option>
							<?php foreach($clinical_speciality as $follow_up): ?>
								<option value="<?php echo $follow_up->clinical_speciality_id;?>"><?php echo $follow_up->clinical_speciality;?></option>
							<?php endforeach; ?>
							</select>
							</td>
							<td>
									<select name="followup_staffid[]" class="form-control">
									<option value="" selected>--SELECT--</option>
									<?php foreach($get_staff_selected_hosp as $follow_up): ?>
										<option value="<?php echo $follow_up['staff_id'];?>"><?php echo $follow_up['first_name'];?></option>
									<?php endforeach; ?>
									</select>
							</td>
							<td>
									<input type="date" name="followup_date[]" class="form-control" />
									
							</td>
						</tr>
						<tr>
							
							<td style="text-align:center">
								<b>Notes</b>
							</td>
							<td colspan="6" rowspan="2" >
								<textarea class="form-control" cols="40"  name="followup_notes[]"></textarea>
							</td>
							<td>
								<button type="button" class="btn btn-primary btn-sm" id="follow_up_add" >Add</button>
							</td>
						</tr>

							
					</tbody>
				</table>
				</div>
</div>