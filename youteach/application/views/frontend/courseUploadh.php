<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to Youteach</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets') ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/jasny-bootstrap/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets') ?>/mentisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets') ?>/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets') ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery File Upload CSS -->
    <!-- Generic page styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fileupload/css/style.css">
    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fileupload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fileupload/css/jquery.fileupload-ui.css">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>assets/fileupload/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>assets/fileupload/css/jquery.fileupload-ui-noscript.css"></noscript>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url('assets') ?>/jquery/jquery.min.js"></script>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Youteach</a>
            </div>
            <?php if($this->session->userdata('logged_in')) { ?>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="<?php echo site_url("frontend")."/receivedMessages"; ?>">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <?php }?>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <?php if($this->session->userdata('logged_in')) {?>
                        <li>
                            <div class="profile container-fluid" style="padding-bottom: 20px">
                                <div class="profile_pic">
                                    <img src="<?php echo base_url('assets/images/profile_pics')."/".$this->session->userdata("picture_url"); ?>" alt="..." class="img-circle profile_img">
                                </div>
                                <div class="profile_info">
                                    <span>Welcome,</span>
                                    <h2><?php echo ucfirst(strtolower($this->session->userdata('name'))); ?></h2>
                                </div>
                            </div>
                        </li>
                        <?php }
                        else {
                        ?>
                        <li>
                            <a href="#" ><i class="fa fa-fw fa-user"></i> Login<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <div class="container-fluid" style="padding: 10px">
                                        <form action="<?php echo site_url('login'); ?>" method="post" role="form">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" name="email" type="email" placeholder="Enter text" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" name="password" type="password" placeholder="Enter password" required="required">
                                            </div>
                                             <input type="submit" class="btn btn-default" style="float: right" value="Submit"/>
                                        </form>
                                     </div>
                                </li>
                            </ul>
                        </li>
                        <li class="active">
                            <a href="<?php echo site_url('register'); ?>"><i class="fa fa-tasks fa-fw"></i> Register</a>
                        </li>
                        <?php }?>
                        <li>
                            <a href="<?php echo site_url(); ?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Top Courses<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <?php foreach ($top_courses as $i) {?>
                                <li>
                                    <a href="<?php echo site_url('Frontend/viewcourse/'.$i->id); ?>"><?php echo $i->name; ?></a>
                                </li>
                            <?php }?>
                            </ul>   
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bitbucket fa-fw"></i> Recommended for you</a>
                        </li>
                        <?php if($this->session->userdata('logged_in') && $this->session->userdata('access_level')==2) {?>
                        <li>
                            <a href="<?php echo site_url('frontend/userCourses'); ?>"><i class="fa fa-graduation-cap fa-fw"></i> Your Courses</a>
                        </li>
                        <?php } else if($this->session->userdata('logged_in')) {?>
                        <li>
                            <a href="<?php echo site_url('frontend/courseUpload'); ?>"><i class="fa fa-graduation-cap fa-fw"></i> Become a teacher</a>
                        </li>
                        <?php
                        }?>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
