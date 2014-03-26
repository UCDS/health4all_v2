<?php $thispage="h4a"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title><?php echo $title; ?> - Health4All</title>
	<link rel="stylesheet" type="text/css" 
	href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	
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
          <a class="navbar-brand" href="#">Health4All</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php if(current_url()==base_url()){ echo "class='active'";}?>><a href="#">Home</a></li>
	<?php if($this->session->userdata('logged_in')) { ?>
	<li class="dropdown">
                <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Patients <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url();?>register/op">OutPatient</a></li>
                  <li><a href="#">InPatient</a></li>
                </ul>
              </li>	
	<li class="dropdown">
                <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Services <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Diagnostics</a></li>
                  <li><a href="#">BloodBank</a></li>
                </ul>
              </li>
	<li class="dropdown">
                <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Resources <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">HR</a></li>
                  <li><a href="#">Equipment</a></li>
                  <li><a href="#">Consumables</a></li>
                </ul>
              </li>
	<li class="dropdown">
                <a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">Reports <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">OutPatient Summary</a></li>
                  <li><a href="#">OutPatient Detailed</a></li>
                  <li><a href="#">InPatient</a></li>
                </ul>
              </li>
	<li><a href="#" >Help</a></li>



	<?php } ?>
            
		</ul>
	<?php if($this->session->userdata('logged_in')) { ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a><?php $logged_in=$this->session->userdata('logged_in');echo $logged_in[0]['username']; ?></a></li>
            <li><a href="<?php echo base_url();?>home/logout">Logout</a></li>
          </ul>	
	<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">
