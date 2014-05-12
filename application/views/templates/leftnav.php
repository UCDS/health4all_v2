<?php if(preg_match("^equipments/*^",current_url())) { ?>
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