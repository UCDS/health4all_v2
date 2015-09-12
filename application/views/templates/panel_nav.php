<div  class="col-sm-3 col-md-2">
  <ul class="nav nav-pills nav-stacked">
	<li <?php if(current_url()==base_url()."bloodbank/user_panel/place"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/user_panel/place"><i class="fa fa-map-marker " style="color:#E84F4F"></i> Place</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/create_slots"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/create_slots"><i class="fa fa-calendar " style="color:#E84F4F"></i>  Create Slots</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/register"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register"><i class="fa fa-user " style="color:#E84F4F"></i>  Walk In</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/register/donation"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/donation"><i class="fa fa-stethoscope " style="color:#E84F4F"></i>   Medical &nbsp;&nbsp;Checkup</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/register/bleeding"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/bleeding"><i class="fa fa-tint " style="color:#E84F4F" ></i>  Bleeding</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/blood_grouping"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/blood_grouping"><i class="fa fa-spinner " style="color:#E84F4F"></i> Grouping</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/prepare_components"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/prepare_components"><i class="fa fa-crosshairs " style="color:#E84F4F"></i>   Component &nbsp;&nbsp;Preparation</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/screening"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/screening"><i class="fa fa-search " style="color:#E84F4F"></i>  Screening</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/register/request"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/request"><i class="fa fa-user " style="color:#E84F4F"></i>   Request</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/issue"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/issue"><i class="fa fa-pencil-square-o " style="color:#E84F4F"></i>  Issue</a></li>
	<li <?php if(current_url()==base_url()."bloodbank/inventory/discard"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/discard"><i class="fa fa-times-circle" style="color:#E84F4F"></i>  Discard</a></li>

  </ul>
  
</div>