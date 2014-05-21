<?php $thispage="h4a"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $title; ?> - Health4All</title>
	<link rel="stylesheet" type="text/css" 
	href="<?php echo base_url(); ?>assets/css/bootstrap.css" media='screen,print'>
	
	<script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" 
	src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrap">
    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
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
			<?php if($this->session->userdata('logged_in')) { ?>
			<li class="dropdown  <?php if(preg_match("^".base_url()."register^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Patients <b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li class="dropdown-header">OutPatient</li>
						  <?php foreach($op_forms as $form){ ?>
							<li><a href="<?php echo base_url()."register/custom_form/$form->form_id"; ?>"><?php echo $form->form_name;?></a></li>
						  <?php } ?>	
						  <li class="divider"></li>
						  <li class="dropdown-header">InPatient</li>
						  <?php foreach($ip_forms as $form){ ?>
							<li><a href="<?php echo base_url()."register/custom_form/$form->form_id"; ?>"><?php echo $form->form_name;?></a></li>
						  <?php } ?>	
	
						</ul>
					  </li>	
			<li class="dropdown  <?php if(preg_match("^".base_url()."services^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Services <b class="caret"></b></a>
						<ul class="dropdown-menu">
<li><a href="<?php echo base_url()."diagnostics/add/test_group";?>">Diagnostics</a></li>
						  <li><a href="#">BloodBank</a></li>
						</ul>
					  </li>
			<li class="dropdown  <?php if(preg_match("^".base_url()."inventory^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Resources <b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><a href="#">HR</a></li>
						  <li><a href="<?php echo base_url()."equipments/add/equipment";?>">Equipment</a></li>
						  <li><a href="<?php echo base_url()."consumables/add/dosages";?>">Consumables</a></li>
						</ul>
			</li>
			<li class="dropdown  <?php if(preg_match("^".base_url()."reports^",current_url())){ echo "active";}?>">
						<a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Reports <b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li class="dropdown-header">Summary reports</li>
						  <li><a href="<?php echo base_url()."reports/op_summary";?>">OP Summary</a></li>
						  <li><a href="<?php echo base_url()."reports/ip_summary";?>">IP Summary</a></li>
						  <li class="divider"></li>
						  <li class="dropdown-header">Detailed reports</li>
						  <li><a href="<?php echo base_url()."reports/op_detail";?>">OP Detail</a></li>
						  <li><a href="<?php echo base_url()."reports/ip_detail";?>">IP Detail</a></li>
						</ul>
			</li>
			<li class=" <?php if(preg_match("^".base_url()."help^",current_url())) echo "active";?>"><a href="<?php echo base_url()."help";?>" >Help</a></li>



			<?php } ?>
					
		</ul>
	<?php if($this->session->userdata('logged_in')) { ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown  <?php if(preg_match("^".base_url()."user_panel^",current_url())){ echo "active";}?>"><a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown"><?php $logged_in=$this->session->userdata('logged_in');echo $logged_in[0]['username']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url()."user_panel/settings";?>">Settings</a></li>
				  <li class="divider"></li>
				  <li><a href="<?php echo base_url();?>home/logout">Logout</a></li>
                </ul>
			</li>
          </ul>	
	<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">
