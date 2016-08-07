<style>
.sousMenu:hover ul
{
    display:inherit;
}
.sousMenu ul
{
    top: 40px;
    display: none;
    list-style-type: none;
}
</style>
    <link href="<?php echo base_url();?>assets/css/simple-sidebar.css" rel="stylesheet">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
    <li <?php if(current_url()==base_url()."bloodbank/user_panel/donation_summary"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/user_panel/donation_summary"><img src="<?php echo base_url();?>assets/images/flaticons/seo-report.png" alt="Reports" width="20" height="20">Bloodbank Reports</a></li>
    <li><img src="<?php echo base_url();?>assets/images/flaticons/team.png" alt="Blood Donors" width="20" height="20">Blood Donor</li>    
    <li <?php if(current_url()==base_url()."bloodbank/register/repeat_donor"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/repeat_donor">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/heart.png" alt="Repeat Donor" width="20" height="20">Repeat Donor</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/register"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/blood-donation.png" alt="Walk In" width="20" height="20">Walk In</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/register"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/open-carton-box.png" alt="Bulk Receive" width="20" height="20">Bulk Receive</a></li>    
    <li><img src="<?php echo base_url();?>assets/images/flaticons/apple.png" alt="Repeat Donor" width="20" height="20">Blood Donation</li>    
    <li <?php if(current_url()==base_url()."bloodbank/register/donation"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/donation">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/stethoscope.png" alt="Medical checkup" width="20" height="20">Medical Checkup</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/register/bleeding"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/bleeding">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/chemistry.png" alt="Bleeding" width="20" height="20">Bleeding</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/register/donation"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/donation"><img src="<?php echo base_url();?>assets/images/flaticons/science.png" alt="Blood Preparation" width="20" height="20">Blood Preparation</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/inventory/blood_grouping"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/blood_grouping">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/medical-1.png" alt="Grouping" width="20" height="20">Grouping</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/inventory/prepare_components"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/prepare_components">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/test-tubes.png" alt="Component Preparation" width="20" height="20">Components</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/inventory/screening"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/screening">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/microscope.png" alt="Screening" width="20" height="20">Screening</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/inventory/discard"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/discard"><img src="<?php echo base_url();?>assets/images/flaticons/garbage.png" alt="Discard" width="20" height="20">Discard</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/register/request"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/request"><img src="<?php echo base_url();?>assets/images/flaticons/smartphone.png" alt="In Patient" width="20" height="20">Blood Request</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/blood_request/internal_patient_blood_request"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/blood_request/internal_patient_blood_request">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/patient.png" alt="In Patient" width="20" height="20">In Patient</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/register/request"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/request">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/patient-with-bandages-and-a-doctor.png" alt="External Patient" width="20" height="20">External Patient</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/register/request"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/request"><img src="<?php echo base_url();?>assets/images/flaticons/shopping-basket.png" alt="In Patient" width="20" height="20">Issue</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/inventory/issue"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/inventory/issue">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/transfusion.png" alt="Patient" width="20" height="20">Patient</a></li>        
    <li <?php if(current_url()==base_url()."bloodbank/register/request"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/request">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/medical-truck.png" alt="Bulk Screened" width="20" height="20">Bulk Screened</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/register/request"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/register/request">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/biohazard-sign-inside-a-triangle-outline.png" alt="Bulk Unscreened" width="20" height="20">Bulk Unscreened</a></li>    	    
    <li class ="sousMenu"<?php if(current_url()==base_url()."bloodbank/user_panel/place"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/user_panel/place"><img src="<?php echo base_url();?>assets/images/flaticons/cogwheel.png" alt="Bloodbank Configuration" width="20" height="20">Configuration</a></li>            
    <li <?php if(current_url()==base_url()."bloodbank/staff/add_camp"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/staff/add_camp">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/placeholder.png" alt="Add Camp" width="20" height="20">Add Camp</li>
    <li <?php if(current_url()==base_url()."bloodbank/staff/add_camp"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/staff/add_camp">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/placeholder.png" alt="Add Camp" width="20" height="20">Add Bulk Receive</li>
    <li <?php if(current_url()==base_url()."bloodbank/staff/add_hospital"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/staff/add_hospital">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/hospital-1.png" alt="Add Hospital/Storage Center" width="20" height="20">Add Hospital/Storage</li>
    <li <?php if(current_url()==base_url()."bloodbank/staff/add_hospital"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/staff/add_hospital">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo base_url();?>assets/images/flaticons/medical-3.png" alt="Add Test" width="20" height="20">Add Test</li>
    <li <?php if(current_url()==base_url()."bloodbank/donation/get_donation"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/donation/get_donation"><img src="<?php echo base_url();?>assets/images/flaticons/medical-2.png" alt="Edit Donation" width="20" height="20">Edit Donation</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/create_slots"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/create_slots"><img src="<?php echo base_url();?>assets/images/flaticons/interface.png" alt="Bulk Unscreened" width="20" height="20">Create Slots</a></li>
    <li <?php if(current_url()==base_url()."bloodbank/user_panel/invite_donor"){ echo "class='active'";}?>><a href="<?php echo base_url();?>bloodbank/user_panel/invite_donor"><img src="<?php echo base_url();?>assets/images/flaticons/megaphone.png" alt="Bulk Unscreened" width="20" height="20">Invite Donor's</a></li>
            </ul>
        </div>
<div class="col-sm-3 col-md-2">
  <ul class="nav nav-pills nav-stacked">
  </ul>
  
</div>