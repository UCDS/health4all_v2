<?php $thispage="h4a"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $title; ?> - Health4All</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" media='screen,print'>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrap">
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
		<!-- Bootstrap toggle menu for mobile devices, only visible on small screens --> 
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>">Health4All</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
			<?php if($this->session->userdata('logged_in')) {	
			//Loop through the session data to check if the user has access to each function and only display those.
			foreach($functions as $f){
					//Check if the user has access to Out Patient Registration forms or In Patient Registration forms 
					if($f->user_function=="Out Patient Registration" || $f->user_function=="In Patient Registration"){ 
					// If they do, display dropdown menu which will contain all the links to the forms. ?>
						<li class="dropdown  <?php if(preg_match("^".base_url()."register^",current_url())){ echo "active";}?>">
									<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Patients <b class="caret"></b></a>
									<ul class="dropdown-menu">
						<?php
						//Loop through the user session data to check if the user has access to Out Patient forms
						foreach($functions as $f){
						//If they do, display all the OP forms available
								if($f->user_function=="Out Patient Registration"){ ?>
									<li class="dropdown-header">OutPatient</li>
									<?php foreach($op_forms as $form){ ?>
										<li><a href="<?php echo base_url()."register/custom_form/$form->form_id"; ?>"><?php echo $form->form_name;?></a></li>
									<?php }
									//When the match is found, break the loop.
									break;
								}
							}?>	
						  <li class="divider"></li>
						<?php 
						//Repeat for all list items, and menu items.
						foreach($functions as $f){
								if($f->user_function=="In Patient Registration"){ ?>
								  <li class="dropdown-header">InPatient</li>
								  <?php foreach($ip_forms as $form){ ?>
									<li><a href="<?php echo base_url()."register/custom_form/$form->form_id"; ?>"><?php echo $form->form_name;?></a></li>
								  <?php }
									break;
								}
							} ?>
							
							</ul>
						  </li>	
					<?php
							break; 
						} 
					} 
				?> 

			<?php foreach($functions as $f){
					if($f->user_function=="Diagnostics" || $f->user_function=="Bloodbank" || $f->user_function == "Sanitation Evaluation"){ ?>
					<li class="dropdown  <?php if(preg_match("^".base_url()."services^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Services <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<?php foreach($functions as $f){
								if($f->user_function=="Diagnostics"){ ?>
									<li><a href="<?php echo base_url()."diagnostics/test_order";?>">Diagnostics</a></li>
						<?php
									break;
								}
							}
						?>	

						<?php foreach($functions as $f){
								if($f->user_function=="Bloodbank"){ ?>
									<li><a href="<?php echo base_url();?>bloodbank/user_panel/place">BloodBank</a></li>
						<?php
									break;
								}
							}
						?>	
						
						<?php 
						$evaluate=0;
						foreach($functions as $f){
								if($f->user_function=="Sanitation Evaluation" && ($f->add==1 || $f->edit==1)){ ?>
									<li><a href="<?php echo base_url();?>sanitation/evaluate">Sanitation</a></li>
						<?php
									$evaluate=1;
									break;
								}
						}
						if($evaluate==0){
						foreach($functions as $f){
								if($f->user_function=="Masters - Sanitation" && ($f->add==1 || $f->edit==1)){ ?>
									<li><a href="<?php echo base_url();?>sanitation/add/facility_activity">Sanitation</a></li>
						<?php
								break;
								}
							}
						}
						?>	
						</ul>
					  </li>
					<?php
							break; 
						} 
					} 
				?> 
			<?php foreach($functions as $f){
					if($f->user_function=="Equipment" || $f->user_function=="Consumables" || $f->user_function=="HR"){ ?>
			<li class="dropdown  <?php if(preg_match("^".base_url()."inventory^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Resources <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<?php foreach($functions as $f){
								if($f->user_function=="HR"){ ?>
									<li><a href="<?php echo base_url()."staff/add/staff";?>">HR</a></li>
						<?php
									break;
								}
							}
						?>	

						<?php foreach($functions as $f){
								if($f->user_function=="Equipment"){ ?>
									<li><a href="<?php echo base_url()."equipments/add/equipment";?>">Equipment</a></li>
						<?php
									break;
								}
							}
						?>
						<?php foreach($functions as $f){
								if($f->user_function=="Consumables"){ ?>
						  <li><a href="<?php echo base_url()."consumables/add/dosages";?>">Consumables</a></li>
						<?php
									break;
								}
							}
						?>
						</ul>
					</li>
					<?php
							break; 
						} 
					} 
				?> 

			<?php 
			foreach($functions as $f){
					if($f->user_function=="OP Summary" || $f->user_function=="IP Summary" || 
					$f->user_function=="OP Detail" || $f->user_function=="IP Detail" || 
					($f->user_function == "Sanitation Evaluation" && $f->view==1) || 
					$f->user_function == "Reports - Blood Bank"){ ?>
					<li class="dropdown  <?php if(preg_match("^".base_url()."reports^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Reports <b class="caret"></b></a>
						<ul class="dropdown-menu">
			<?php	
				foreach($functions as $f){
					if($f->user_function=="OP Summary" || $f->user_function=="IP Summary"){ ?>
						  <li class="dropdown-header">Summary reports</li>
			<?php
				break;
				}
				}	
				foreach($functions as $f){
				if($f->user_function=="OP Summary"){ ?>
						  <li><a href="<?php echo base_url()."reports/op_summary";?>">OP Summary</a></li>
				<?php	}
					if($f->user_function=="IP Summary"){ ?>
						  <li><a href="<?php echo base_url()."reports/ip_summary";?>">IP Summary</a></li>
				<?php	} 
					if($f->user_function=="Diagnostics - Summary"){ ?>
						  <li><a href="<?php echo base_url()."reports/order_summary";?>">Orders Summary</a></li>
				<?php	} 
					if($f->user_function=="BloodBank Summary"){ ?>
						  <li><a href="<?php echo base_url()."bloodbank/reports/donation_summary";?>">Blood Donations</a></li>
						  <li><a href="<?php echo base_url()."bloodbank/reports/issue_summary";?>">Blood Issues</a></li>
						  <li><a href="<?php echo base_url()."bloodbank/reports/hospital_issues";?>">Blood Issues - Hospital Wise</a></li>
						  <li><a href="<?php echo base_url()."bloodbank/reports/available_blood";?>">Available Blood</a></li>
				<?php	}
					if($f->user_function=="Masters - Sanitation"){ ?>
						<li><a href="<?php echo base_url()."sanitation/view_summary";?>">Sanitation Evaluation</a></li>
				<?php	
					} 
				?>
			<?php	}	?>
			<li class="divider"></li>
			<?php foreach($functions as $f){
			?>
			<?php	if($f->user_function=="OP Detail" || $f->user_function=="IP Detail"){ ?>
						  <li class="dropdown-header">Detailed reports</li>

			<?php	break;
			}
			}
			foreach($functions as $f){
			if($f->user_function=="OP Detail"){ ?>
						<li><a href="<?php echo base_url()."reports/op_detail";?>">OP Detail</a></li>
			<?php	}
			if($f->user_function=="IP Detail"){ ?>
						<li><a href="<?php echo base_url()."reports/ip_detail";?>">IP Detail</a></li>
			<?php }
			if($f->user_function=="Diagnostics - Detail"){ ?>
						<li><a href="<?php echo base_url()."reports/order_detail";?>">Orders Detail</a></li>
			<?php }
			if($f->user_function=="BloodBank Detail"){ ?>
						<li><a href="<?php echo base_url()."bloodbank/reports/report_donations";?>">Blood Donations</a></li>
						<li><a href="<?php echo base_url()."bloodbank/reports/report_issue";?>">Blood Issues</a></li>
						<li><a href="<?php echo base_url()."bloodbank/reports/report_inventory";?>">Blood Inventory</a></li>
						<li><a href="<?php echo base_url()."bloodbank/reports/blood_donors";?>">Blood Donors</a></li>
						<li><a href="<?php echo base_url()."bloodbank/reports/report_screening";?>">Screening</a></li>
						<li><a href="<?php echo base_url()."bloodbank/reports/report_grouping";?>">Grouping</a></li>
			<?php }
			if($f->user_function=="Sanitation Evaluation"){ ?>
								<li><a href="<?php echo base_url()."sanitation/view_scores";?>">Sanitation Evaluation</a></li>
					<?php	}  
					
			} ?>
			</ul>
			<?php 
				break;
				}  
			}
			?>
			</li>
			<li class=" <?php if(preg_match("^".base_url()."help^",current_url())) echo "active";?>"><a href="<?php echo base_url()."help";?>" >Help</a></li>



			<?php } ?>
					
		</ul>
	<?php if($this->session->userdata('logged_in')) { ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown  <?php if(preg_match("^".base_url()."user_panel^",current_url())){ echo "active";}?>"><a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown"><?php $logged_in=$this->session->userdata('logged_in');echo $logged_in['username']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
				<?php
				foreach($functions as $f){
				if($f->user_function=="Masters - Application"){ ?>
                  <li><a href="<?php echo base_url()."user_panel/settings";?>">Settings</a></li>
				  <li class="divider"></li>
				<?php break;
					}
				}
				?>
				  <li><a href="<?php echo base_url();?>home/logout">Logout</a></li>
                </ul>
			</li>
          </ul>	
	<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">
