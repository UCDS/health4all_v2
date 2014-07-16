<?php if(preg_match("^equipments/*^",current_url())) { 
	$userinfo=$this->session->userdata('logged_in'); // Store the session data in a variable, contains all the functions the user has access to.
?>
<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header">Add</li>
				<li><a href="<?php echo base_url();?>equipments/add/equipment">Equipment</a></li>
				<li><a href="<?php echo base_url();?>equipments/add/equipment_type">Equipment Type</a></li>
				<li><a href="<?php echo base_url();?>equipments/add/service_records">Service Issue</a></li>
				<li><a href="#">AMC/CMC</a></li>
				<li class="nav-header">Edit</li>
				<li><a href="<?php echo base_url();?>equipments/edit/equipment_type">Equipment Type</a></li>
				<li><a href="<?php echo base_url();?>equipments/edit/equipments">Equipment Details</a></li>
				<li><a href="#">AMC/CMC</a></li>
				<li class="nav-header">View</li>
				<li><a href="<?php echo base_url();?>equipments/view/equipments_summary">Equipments</a></li>
	<ul>
</div>
<?php } ?>
<?php if(preg_match("^consumables/*^",current_url())) { ?>

<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header">Add</li>
				<li><a href="<?php echo base_url();?>consumables/add/dosages">Dosages</a></li>
				<li><a href="<?php echo base_url();?>consumables/add/generic">Generic Item</a></li>
				<li><a href="<?php echo base_url();?>consumables/add/drug_type"> Drug Type Details</a></li>
				<li class="nav-header">Edit</li>
			<li><a href="<?php echo base_url();?>consumables/edit/drug_type">Drug Type Details</a></li>
				<li><a href="<?php echo base_url();?>consumables/edit/generics">Generic Item</a></li>
				<li><a href="<?php echo base_url();?>consumables/edit/dosages">Dosage Details</a></li>
			

			<ul>
</div>
<?php } ?>
<?php if(preg_match("^staff/*^",current_url())) { ?>

<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header">Add</li>
				<li><a href="<?php echo base_url();?>staff/add/staff">Staff</a></li>
				<li><a href="<?php echo base_url();?>staff/add/staff_role">Staff Role</a></li>
				<li><a href="<?php echo base_url();?>staff/add/staff_category"> Staff Category</a></li>
		<li class="nav-header">Edit</li>
		<li><a href="<?php echo base_url();?>staff/edit/staff">Staff</a></li>
		<li><a href="<?php echo base_url();?>staff/edit/staff_role">Staff Role</a></li>
		<li><a href="<?php echo base_url();?>staff/edit/staff_category">Staff Category</a></li>
	<ul>
</div>
<?php } ?>

<?php if(preg_match("^sanitation/*^",current_url())) { ?>

<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">
    			<li class="nav-header">Add</li>
				<li><a href="<?php echo base_url();?>sanitation/add/area_types">Area Types</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/area_activity">Area activity</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/department">Department</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/districts">Districts</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/facility_activity">Facility Activity</a></li>
		        <li><a href="<?php echo base_url();?>sanitation/add/hospital">Hospital</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/facility_type">Facility Type</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/area">Area</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/states">States</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/vendor">Vendor</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/vendor_contracts">Vendor Contracts</a></li>
				<li><a href="<?php echo base_url();?>sanitation/add/village_town">Village Town</a></li>
				<li class="divider"></li>
	<ul>
</div>
<?php } ?>

<?php if(preg_match("^diagnostics/*^",current_url())) { ?>
<div class="col-sm-3 col-md-2 sidebar-left">
    <ul class="nav nav-sidebar">

		<li class="nav-header">Add</li>

		<li><a href="<?php echo base_url();?>diagnostics/add/test_method">Test Method</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/add/test_group">Test Group</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/add/test_status_type">Test Status Type</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/add/test_name">Test Name</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/add/test_area">Test Area</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/add/antibody">Antibody</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/add/micro_organism">Micro Organism</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/add/specimen_type">Specimen Type</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/add/sample_status">Sample Status</a></li>

		<li class="nav-header">Edit</li>
		<li><a href="<?php echo base_url();?>diagnostics/edit/test_method">Test Method</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/edit/test_group">Test Group</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/edit/test_status_type">Test Status Type</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/edit/test_name">Test Name</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/edit/test_area">Test Area</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/edit/antibody">Antibody</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/edit/micro_organism">Micro Organism</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/edit/specimen_type">Specimen Type</a></li>
		<li><a href="<?php echo base_url();?>diagnostics/edit/sample_status">Sample Status</a></li>
		
</ul>
</div>	

<?php } ?>

<?php if(preg_match("^user_panel/*^",current_url())) { ?>

		<div class="col-sm-3 col-md-2 sidebar-left">
			<strong>Settings</strong>
				<ul class="nav nav-sidebar nav-stacked">
				<li class="nav-divider"></li>
				<li>Forms</li>
				<li> 
					<a href="<?php echo base_url()."user_panel/form_layout";?>">Create New</a>
				</li>
				<li class="disabled"><a>Edit</a>
					<ul>
						<li> 
						<a href="#">Out Patient Form</a>
						</li>
						<li> 
						<a href="#">In Patient Form</a>
						</li>
					</ul>
				</li>
				<li class="nav-divider"></li>

				<li class="navbar-text">Users</li>
				<li> 
					<a href="<?php echo base_url()."user_panel/create_user";?>">Create New</a>
				</li>
				</ul>
        </div>
<?php } ?>