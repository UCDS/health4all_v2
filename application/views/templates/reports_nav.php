
  <link href="<?php echo base_url();?>assets/css/simple-sidebar.css" rel="stylesheet">
<div class="col-sm-3 col-md-2">
  <ul class="nav nav-pills nav-stacked">
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/appointment_bookings"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/appointment_bookings'>Appointment Report</a></li> 
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/donation_summary"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/donation_summary'>Donations Summary</a></li> 
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/report_donations"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/report_donations'>Donations Detailed</a></li> 
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/issue_summary"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/issue_summary'>Issue Summary</a></li> 
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/hospital_issues"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/hospital_issues'>Hospital Wise Issues</a></li> 
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/report_issue"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/report_issue'>Issue Report</a></li>
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/available_blood"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/available_blood'>Available Blood</a></li> 
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/report_inventory"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/report_inventory'>Inventory Detailed</a></li> 
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/blood_donors"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/blood_donors'>Donors report</a></li> 
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/report_screening"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/report_screening'>Screening Report</a></li> 
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/report_grouping"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/report_grouping'>Grouping Report</a></li>
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/discard_summary"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/discard_summary'><i class="fa fa-trash" style="color:#E84F4F"></i> Discard Summary</a></li>
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/discard_report"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/discard_report'><i class="fa fa-times-circle " style="color:#E84F4F"></i> Discard Detail</a></li>
		<li <?php if(current_url()==base_url()."bloodbank/user_panel/print_certificates"){ echo "class='active'";}?>><a href='<?php echo base_url();?>bloodbank/user_panel/print_certificates'>Print Certificates</a></li>
                	</ul>
</div>
