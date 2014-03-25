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
            <li <?php if(preg_match("/register/",current_url())){ echo "class='active'";}?>>
				<a href="<?php echo base_url();?>register/op">Out-Patient Registration</a>
			</li>
            <li <?php if(preg_match("/reports/",current_url())){ echo "class='active'";}?>>
				<a href="<?php echo base_url();?>reports">Reports</a>
			</li>
	<?php } ?>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
		</ul>
	<?php if($this->session->userdata('logged_in')) { ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a><?php echo $this->session->userdata('logged_in')[0]['username']; ?></a></li>
            <li><a href="<?php echo base_url();?>home/logout">Logout</a></li>
          </ul>	
	<?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div class="container">