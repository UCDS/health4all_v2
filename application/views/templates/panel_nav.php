    <link href="<?php echo base_url();?>assets/css/simple-sidebar.css" rel="stylesheet">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                
	<li <?php if(current_url()==base_url()."bloodbank/user_panel/place"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/user_panel/place">Place</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/create_slots"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/create_slots">Create Slots</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/register"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register">Walk In</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/register/donation"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/donation">Medical Checkup</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/register/bleeding"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/bleeding">Bleeding</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/blood_grouping"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/blood_grouping">Grouping</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/prepare_components"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/prepare_components">Component Preparation</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/screening"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/screening">Screening</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/register/request"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/request">Request</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/issue"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/issue">Issue</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/discard"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/discard">Discard</a></li>

            </ul>
        </div>
<div class="col-sm-3 col-md-2">
  <ul class="nav nav-pills nav-stacked">
  </ul>
  
</div>