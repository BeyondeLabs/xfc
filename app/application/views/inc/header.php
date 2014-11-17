<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url();?>favicon.ico">

    <title>FOCUS Champions &bull; Disciple the nations</title>
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">FOCUS Champions</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><?php echo anchor("home","Home"); ?></li>
            <li><a href="#about">About</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown active">
            <?php if($this->session->userdata('logged_in')){ ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-arrow-circle-right"></i> 
                  <?php if($this->session->userdata('is_admin')): ?>
        
                    <!-- admin menu here -->
                    <?php echo $this->session->userdata('username') ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><?php echo anchor("home/logout","<i class='fa fa-sign-out'></i> Logout"); ?></li>
                    </ul>
                  <?php else: ?>
                    <?php echo $this->session->userdata('first_name')." ".
                                $this->session->userdata('last_name');
                       ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><?php echo anchor("champion/profile","<i class='fa fa-user'></i> My Profile"); ?></a></li>
                        <li><?php echo anchor("champion/commitment","<i class='fa fa-user'></i> Commitment"); ?></a></li>
                        <li><a href="#"><i class='fa fa-gear'></i> Settings</a></li>
                        <li><?php echo anchor("home/logout","<i class='fa fa-sign-out'></i> Logout"); ?></li>
                    </ul>
                  <?php endif; ?>

            <?php } else{ ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-arrow-circle-o-right"></i> Guest <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><?php echo anchor("home/login","<i class='fa fa-heart'></i> Login"); ?></li>
                </ul>
            <?php } ?>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">