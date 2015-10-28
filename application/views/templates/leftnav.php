<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/fonts/flaticon.css" >
<?php if(preg_match("^equipments/*^",current_url())) { 
	$userinfo=$this->session->userdata('logged_in'); // Store the session data in a variable, contains all the functions the user has access to.
?>
<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header"> ADD
				<li <?php if(preg_match("^add/equipment$^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>equipments/add/equipment"><i class="glyph-icon flaticon-medical-equipment"></i>  Equipment</a></li>
				<li <?php if(preg_match("^add/equipment_type^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>equipments/add/equipment_type"><i class="glyph-icon flaticon-id12"></i>  Equipment Type</a></li>
				<li <?php if(preg_match("^add/service_records^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>equipments/add/service_records"><i class="fa fa-cog fa-spin  "></i></i> Service Issue</a></li>
				
				<li ><a href="#"><i class="fa fa-file-text  "></i>&nbsp;&nbsp;&nbsp;AMC/CMC</a></li>
				<li class="nav-header"> Edit
				<li <?php if(preg_match("^edit/equipment_type^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>equipments/edit/equipment_type"> <i class="glyph-icon flaticon-medical-equipment"></i>  Equipment Type</a></li>
				<li <?php if(preg_match("^edit/equipment$^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>equipments/edit/equipment"> <i class="glyph-icon flaticon-id12"></i> Equipment Details</a></li>
				<li <?php if(preg_match("^edit/service_records^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>equipments/edit/service_records"> <i class="fa fa-cog fa-spin "></i></i>  Service Issue</a></li>
				<li ><a href="#"><i class="fa fa-file-text  "></i>&nbsp;&nbsp;&nbsp;AMC/CMC</a></li>
				<li class="nav-header">View</li>
				<li <?php if(preg_match("^view/equipments_summary^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>equipments/view/equipments_summary"> <i class="glyph-icon flaticon-medical-equipment"></i> Equipments</a></li>
	<ul>
</div>
<?php } ?>
<?php if(preg_match("^vendor/*^",current_url())) { 
	$userinfo=$this->session->userdata('logged_in'); // Store the session data in a variable, contains all the functions the user has access to.
?>
<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header">Add</li>
				<li <?php if(preg_match("^add/vendor_type^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>vendor/add/vendor_type">Vendor Type</a></li>
				<li <?php if(preg_match("^add/vendor$^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>vendor/add/vendor">Vendor</a></li>
				<li <?php if(preg_match("^add/contact_person^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>vendor/add/contact_person">Contact Person</a></li>
				
				<li class="nav-header">Edit</li>
				<li <?php if(preg_match("^edit/vendor_type^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>vendor/edit/vendor_type">Vendor Type</a></li>
				<li <?php if(preg_match("^edit/vendor$^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>vendor/edit/vendor">Vendor</a></li>
				<li <?php if(preg_match("^edit/contact_person^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>vendor/edit/contact_person">Contact Person</a></li>
				
	<ul>
</div>
<?php } ?>
<?php if(preg_match("^consumables/*^",current_url())) { ?>

<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header">Add</li>
				<li <?php if(preg_match("^add/dosages^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>consumables/add/dosages">Dosages</a></li>
				<li <?php if(preg_match("^add/generic^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>consumables/add/generic">Generic Item</a></li>
				<li <?php if(preg_match("^add/drug_type^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>consumables/add/drug_type"> Drug Type Details</a></li>
				<li class="nav-header">Edit</li>
			<li <?php if(preg_match("^edit/drug_type^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>consumables/edit/drug_type">Drug Type Details</a></li>
				<li <?php if(preg_match("^edit/generics^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>consumables/edit/generics">Generic Item</a></li>
				<li <?php if(preg_match("^edit/dosages^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>consumables/edit/dosages">Dosage Details</a></li>
			

			<ul>
</div>
<?php } ?>
<?php if(preg_match("^staff/*^",current_url())) { ?>

<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header">Add</li>
				<li <?php if(preg_match("^add/staff$^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>staff/add/staff">Staff</a></li>
				<li <?php if(preg_match("^add/staff_role^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>staff/add/staff_role">Staff Role</a></li>
				<li <?php if(preg_match("^add/staff_category^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>staff/add/staff_category"> Staff Category</a></li>
				<li class="nav-header">Edit</li>
				<li <?php if(preg_match("^edit/staff$^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>staff/edit/staff">Staff</a></li>
				<li <?php if(preg_match("^edit/staff_role^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>staff/edit/staff_role">Staff Role</a></li>
				<li <?php if(preg_match("^edit/staff_category^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>staff/edit/staff_category">Staff Category</a></li>
                <li <?php if(preg_match("^edit/add_transaction^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>staff/add_transaction">HR Transaction</a></li>
	<ul>
</div>
<?php } ?>

<?php if(preg_match("^sanitation/*^",current_url())) { ?>
	<?php foreach($functions as $f){
			if($f->user_function=="Masters - Sanitation" || $f->user_function=="Masters - Facility" || $f->user_function == "Masters - Application"){ ?>
<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header">Add</li>
						<?php foreach($functions as $f){
								if($f->user_function=="Masters - Sanitation" && ($f->add==1 || $f->edit==1)){ ?>
									<li class="disabled"><a>Sanitation</a></li>
									<li <?php if(preg_match("^add/area_activity^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/area_activity">Area activity</a></li>
									<li <?php if(preg_match("^add/facility_activity^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/facility_activity">Facility Activity</a></li>
						<?php
									break;
								}
							}
						?>

						<?php foreach($functions as $f){
								if($f->user_function=="Masters - Facility" && ($f->add==1 || $f->edit==1)){ ?>
									<li class="disabled"><a>Facility</a></li>
									<li <?php if(preg_match("^add/facility_type^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/facility_type">Facility Type</a></li>
									<li <?php if(preg_match("^add/hospital^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/hospital">Hospital</a></li>
									<li <?php if(preg_match("^add/department^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/department">Department</a></li>
									<li <?php if(preg_match("^add/area_types^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/area_types">Area Types</a></li>
									<li <?php if(preg_match("^add/area^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/area">Area</a></li>
									<li <?php if(preg_match("^add/vendor_contracts^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/vendor_contracts">Vendor Contracts</a></li>
						<?php
									break;
								}
							}
						?>	
						
						<?php foreach($functions as $f){
								if($f->user_function=="Masters - Application" && ($f->add==1 || $f->edit==1)){ ?>
									<li class="disabled"><a>Application</a></li>
									<li <?php if(preg_match("^add/vendor^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/vendor">Vendor</a></li>
									<li <?php if(preg_match("^add/states^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/states">States</a></li>
									<li <?php if(preg_match("^add/districts^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/districts">Districts</a></li>
									<li <?php if(preg_match("^add/village_town^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>sanitation/add/village_town">Village Town</a></li>
						<?php
									break;
								}
							}
						?>						
								
				<li class="divider"></li>
	<ul>
</div>
<?php break; }}
}
?>

<?php if(preg_match("^diagnostics/*^",current_url())) { ?>
<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
	<?php 
	
	foreach($functions as $f){
		if($f->user_function=="Diagnostics"){ ?>
		<li class="nav-header">Diagnostics</li>
		<?php } 
	}
	foreach($functions as $f){
		if($f->user_function=="Diagnostics - Order"){ ?>
			<li <?php if(preg_match("^test_order^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>diagnostics/test_order">Order Tests</a></li>
	<?php } 
	} 
	$view_orders = 0;
	foreach($functions as $f){
		if($f->user_function=="Diagnostics - Order All"){ ?>
			<li <?php if(preg_match("^view_orders^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>diagnostics/view_orders/0">View Tests</a></li>
	<?php 
		$view_orders=1;
		} 
	}
	if($view_orders==0){
	foreach($functions as $f){
		if($f->user_function=="Diagnostics"){ ?>
			<li <?php if(preg_match("^view_orders^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>diagnostics/view_orders">Update Tests</a></li>
	<?php 
		$view_orders=1;
		} 
	}
	}
	foreach($functions as $f){
		if($f->user_function=="Diagnostics"){ ?>
			<li <?php if(preg_match("^edit_order^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>diagnostics/edit_order">Cancel Orders</a></li>
	<?php } 
	} 
	foreach($functions as $f){
		if($f->user_function=="Diagnostics - Approve"){ ?>
		<li <?php if(preg_match("^approve_results^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>diagnostics/approve_results">Approve Tests</a></li>
	<?php } 
		}
	 foreach($functions as $f){
		if($f->user_function=="Diagnostics"){ ?>
			<li <?php if(preg_match("^view_results^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>diagnostics/view_results">View Results</a></li>
		</li>
	<?php }
	} 

		 foreach($functions as $f){
		if($f->user_function=="Masters - Diagnostics"){ ?>
		<li class="nav-header">Add</li>

		<li <?php if(preg_match("^add/test_method^",current_url())) echo 'class="active"';?> title="Methods of testing - Serology, Microscopy, etc."><a href="<?php echo base_url();?>diagnostics/add/test_method">Test Method</a></li>
		<li <?php if(preg_match("^add/test_group^",current_url())) echo 'class="active"';?> title="Standard grouping of tests or test panels - LFT, RFT, etc."><a href="<?php echo base_url();?>diagnostics/add/test_group">Test Group</a></li>
		<li <?php if(preg_match("^add/test_status_type^",current_url())) echo 'class="active"';?> title="List of status types for a test - Ordered, Approved, etc."><a href="<?php echo base_url();?>diagnostics/add/test_status_type">Test Status Type</a></li>
		<li <?php if(preg_match("^add/test_name^",current_url())) echo 'class="active"';?> title="List of tests perfored in the labs - ASO, CRP, Blood culture, etc."><a href="<?php echo base_url();?>diagnostics/add/test_name">Test Name</a></li>
		<li <?php if(preg_match("^add/test_area^",current_url())) echo 'class="active"';?> title="Areas where the tests are done - Pathology, Microbiology, etc."><a href="<?php echo base_url();?>diagnostics/add/test_area">Test Area</a></li>
		<li <?php if(preg_match("^add/antibiotic^",current_url())) echo 'class="active"';?> title="List of Antibodies"><a href="<?php echo base_url();?>diagnostics/add/antibiotic">Antibiotic</a></li>
		<li <?php if(preg_match("^add/micro_organism^",current_url())) echo 'class="active"';?> title="List of Micro Organisms"><a href="<?php echo base_url();?>diagnostics/add/micro_organism">Micro Organism</a></li>
		<li <?php if(preg_match("^add/specimen_type^",current_url())) echo 'class="active"';?> title="List of Specimen types - Blood, Urine, etc."><a href="<?php echo base_url();?>diagnostics/add/specimen_type">Specimen Type</a></li>
		<li <?php if(preg_match("^add/lab_unit^",current_url())) echo 'class="active"';?> title="Add lab unit."><a href="<?php echo base_url();?>diagnostics/add/lab_unit">Units</a></li>

		<li class="nav-header">Edit</li>
		<li <?php if(preg_match("^edit/test_method^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>diagnostics/edit/test_method">Test Method</a></li>
		<li <?php if(preg_match("^edit/test_group^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>diagnostics/edit/test_group">Test Group</a></li>
		<li <?php if(preg_match("^edit/test_status_type^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>diagnostics/edit/test_status_type">Test Status Type</a></li>
		<li <?php if(preg_match("^edit/test_name^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>diagnostics/edit/test_name">Test Name</a></li>
		<li <?php if(preg_match("^edit/test_area^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>diagnostics/edit/test_area">Test Area</a></li>
		<li <?php if(preg_match("^edit/antibiotic^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>diagnostics/edit/antibiotic">Antibiotic</a></li>
		<li <?php if(preg_match("^edit/micro_organism^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>diagnostics/edit/micro_organism">Micro Organism</a></li>
		<li <?php if(preg_match("^edit/specimen_type^",current_url())) echo 'class="active"';?> ><a href="<?php echo base_url();?>diagnostics/edit/specimen_type">Specimen Type</a></li>
		<!--<li <?php if(preg_match("^add/lab_unit^",current_url())) echo 'class="active"';?> title="Edit lab unit."><a href="<?php echo base_url();?>diagnostics/edit/lab_unit">Units</a></li>-->
                
                <li class="nav-header">View</li>
                <li <?php if(preg_match("^view/master_tests^",current_url())) echo 'class="active"';?>><a href="<?php echo base_url();?>diagnostics/view/master_tests">Master Tests</a></li>
		<?php 
                
                } 
			} ?>
	
</ul>
</div>
	<?php
		}
		?>	

<?php if(preg_match("^user_panel/*^",current_url())) { ?>

		<div class="col-sm-3 col-md-2 sidebar-left">
			<strong>Settings</strong>
				<ul class="nav nav-sidebar nav-stacked">
				<li class="nav-divider"></li>
				<li>Forms</li>
				<li <?php if(preg_match("^user_panel/form_layout^",current_url())) echo 'class="active"';?> > 
					<a href="<?php echo base_url()."user_panel/form_layout";?>">Create New</a>
				</li>
				<li class="nav-divider"></li>

				<li class="navbar-text">Users</li>
				<li <?php if(preg_match("^user_panel/create_user^",current_url())) echo 'class="active"';?> > 
					<a href="<?php echo base_url()."user_panel/create_user";?>">Create New</a>
				</li>
				
				<li <?php if(preg_match("^user_panel/edit_user^",current_url())) echo 'class="active"';?>> 
				<a href="<?php echo base_url()."user_panel/edit_user";?>">Edit User</a>
				</li>
				</ul>
        </div>
<?php } ?>
