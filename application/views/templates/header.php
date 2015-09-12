<?php $thispage="h4a"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $title; ?> - Health4All</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" media='screen,print'>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" >
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flaticon.css" >
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.chained.min.js"></script>
	<script>
	$(function () {
	  $('[data-toggle="popover"]').popover({trigger:'hover',html:true});
		$("#unit").chained("#department");
		$("#area").chained("#department");
	});
	</script>
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
					if($f->user_function=="Out Patient Registration" || $f->user_function=="In Patient Registration" || $f->user_function == "View Patients"){ 
					// If they do, display dropdown menu which will contain all the links to the forms. ?>
						<li class="dropdown  <?php if(preg_match("^".base_url()."register^",current_url())){ echo "active";}?>">
									<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown"><i class="fa fa-user"></i> Patients <b class="caret"></b></a>
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
							<li class="divider"></li>
							<?php
								foreach($functions as $f){
									if($f->user_function == "View Patients"){ ?>
										<li><a href="<?php echo base_url()."register/view_patients"; ?>">View Patients</a></li>
									<?php 
									break;
									} 
								} ?>
							<?php
								foreach($functions as $f){
									if($f->user_function == "Update Patients"){ ?>
										<li><a href="<?php echo base_url()."register/update_patients"; ?>">Update Patients</a></li>
									<?php 
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
					if($f->user_function=="Diagnostics" ||$f->user_function=="Diagnostics - Order All" || $f->user_function=="Bloodbank" || $f->user_function == "Sanitation Evaluation"){ ?>
					<li class="dropdown  <?php if(preg_match("^".base_url()."services^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Services <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<?php
						$diagnostics=0;
						foreach($functions as $f){
								if($f->user_function=="Diagnostics - Order All"){ ?>
									<li><a href="<?php echo base_url()."diagnostics/test_order/1";?>"><i class="glyph-icon flaticon-chemistry20"></i> Diagnostics</a></li>
						<?php		$diagnostics=1;
									break;
								}
							}
						if($diagnostics==0){
						foreach($functions as $f){
								if($f->user_function=="Diagnostics - Order"){ ?>
									<li><a href="<?php echo base_url()."diagnostics/test_order";?>"><i class="glyph-icon flaticon-chemistry20"></i> Diagnostics</a></li>
						<?php		$diagnostics=1;
									break;
								}
							}
						}
						if($diagnostics==0){
						foreach($functions as $f){
								if($f->user_function=="Diagnostics"){ ?>
									<li><a href="<?php echo base_url()."diagnostics/view_orders";?>"><i class="glyph-icon flaticon-chemistry20"></i> Diagnostics</a></li>
						<?php		$diagnostics=1;
									break;
								}
							}
						}
						?>	

						<?php foreach($functions as $f){
								if($f->user_function=="Bloodbank"){ ?>
									<li><a href="<?php echo base_url();?>bloodbank/user_panel/place"><i class="fa fa-tint" style="color:#E84F4F" ></i> BloodBank</a></li>
						<?php
									break;
								}
							}
						?>	
						
						<?php 
						$evaluate=0;
						foreach($functions as $f){
								if($f->user_function=="Sanitation Evaluation" && ($f->add==1 || $f->edit==1)){ ?>
									<li><a href="<?php echo base_url();?>sanitation/evaluate"><i class="glyph-icon flaticon-sweep1"></i>  Sanitation</a></li>
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
					if($f->user_function=="Equipment" || $f->user_function=="Consumables" || $f->user_function=="HR" || $f->user_function=="Vendor"){ ?>
			<li class="dropdown  <?php if(preg_match("^".base_url()."inventory^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Resources <b class="caret"></b></a>
						<ul class="dropdown-menu">
						<?php foreach($functions as $f){
								if($f->user_function=="HR"){ ?>
									<li><a href="<?php echo base_url()."staff/add/staff";?>"><i class="fa fa-user-md"></i> HR</a></li>
						<?php
									break;
								}
							}
						?>	

						<?php foreach($functions as $f){
								if($f->user_function=="Equipment"){ ?>
									<li><a href="<?php echo base_url()."equipments/add/equipment";?>"><i class="glyph-icon flaticon-medical-equipment"></i> Equipment</a></li>
						<?php
									break;
								}
							}
						?>
						<?php foreach($functions as $f){
								if($f->user_function=="Consumables"){ ?>
						  <li><a href="<?php echo base_url()."consumables/add/dosages";?>"><i class="glyph-icon flaticon-drugs5"></i> Consumables</a></li>
						<?php
									break;
								}
							}
						?>
						<?php foreach($functions as $f){
								if($f->user_function=="Vendor"){ ?>
						  <li><a href="<?php echo base_url()."vendor/add/vendor";?>">Vendor</a></li>
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
					$f->user_function=="Diagnostics - Detail" || $f->user_function=="Diagnostics - Summary" || 
					($f->user_function == "Sanitation Evaluation" && $f->view==1) || 
					$f->user_function == "Bloodbank"){ ?>
					<li class="dropdown  <?php if(preg_match("^".base_url()."reports^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown"><i class="fa fa-line-chart"></i> Reports <b class="caret"></b></a>
						<ul class="dropdown-menu">
			<?php	
				foreach($functions as $f){
					if($f->user_function=="OP Summary" || $f->user_function=="IP Summary" || $f->user_function == "Bloodbank"){ ?>
						  <li class="dropdown-header">Summary reports</li>
			<?php
				break;
				}
				}	
				foreach($functions as $f){
				if($f->user_function=="OP Summary"){ ?>
                                            <li><a href="<?php echo base_url()."reports/op_summary";?>">OP Summary</a></li>
				<?php	}
                                }
				foreach($functions as $f){
					if($f->user_function=="IP Summary"){ ?>
						  <li><a href="<?php echo base_url()."reports/ip_summary";?>">IP Summary</a></li>
						  <li><a href="<?php echo base_url()."reports/ip_op_trends";?>">IP/OP Trends</a></li>
						  <li><a href="<?php echo base_url()."reports/icd_summary";?>">ICD Code Summary</a></li>
				<?php	} 
                                }
				foreach($functions as $f){
					if($f->user_function=="Diagnostics - Summary"){ ?>
						  <li><a href="<?php echo base_url()."reports/order_summary/department";?>">Orders Summary</a></li>
						  <li><a href="<?php echo base_url()."reports/sensitivity_summary";?>">Sensitivity Report</a></li>
				<?php	} 
					if($f->user_function=="Bloodbank"){ ?>
						  <li><a href="<?php echo base_url()."bloodbank/user_panel/donation_summary";?>">Bloodbank Reports</a></li>
				<?php	} 
					if($f->user_function=="Bloodbank"){ ?>
						  <li><a href="<?php echo base_url()."reports/audiology_summary";?>">Audiology Report</a></li>
				<?php	}
					if($f->user_function=="Masters - Sanitation" || $f->user_function == "Sanitation Summary"){ ?>
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
						<li><a href="<?php echo base_url()."reports/icd_detail";?>">ICD Code Detail</a></li>
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
			<li class=" <?php if(preg_match("^".base_url()."help^",current_url())) echo "active";?>"><a href="<?php echo base_url()."help";?>" ><i class="fa fa-question"></i> Help</a></li>



			<?php } ?>
					
		</ul>
	<?php if($this->session->userdata('logged_in')) { ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown  <?php if(preg_match("^".base_url()."user_panel^",current_url())){ echo "active";}?>"><a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown"><?php $logged_in=$this->session->userdata('logged_in');echo $logged_in['username']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
				<?php
				foreach($functions as $f){
				if($f->user_function=="Masters - Application"){ ?>
                  <li><a href="<?php echo base_url()."user_panel/settings";?>"><i class="fa fa-gear"></i> Settings</a></li>
				  <li class="divider"></li>
				<?php break;
					}
				}
				?>
                  <li><a href="<?php echo base_url()."user_panel/change_password";?>"><i class="fa fa-edit"></i> Change Password</a></li>
				  <li><a href="<?php echo base_url();?>home/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
			</li>
          </ul>	
	<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">
