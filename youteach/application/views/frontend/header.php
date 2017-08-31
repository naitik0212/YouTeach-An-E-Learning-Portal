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

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets') ?>/mentisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets') ?>/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets') ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Fancybox CSS -->
    <link href="<?php echo base_url('assets') ?>/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url('assets') ?>/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/fancybox/jquery.fancybox.js" type="text/javascript"></script>

    <script>
        var error = "<?php echo $this->session->flashdata('login_error'); ?>";
        
        <?php if(!$this->session->userdata("logged_in")) 
        {
            echo ' $(document).ready( function() {
                    $(".fancybox").fancybox({
                        afterClose: function(){
                            $("#login_error").addClass("hidden");
                        }
                    });
                    if(error !== "")
                    {
                        $("#login_link").click();
                        $("#login_error").removeClass("hidden");
                        $("#login_error").html(error);
                    }
            }
        );  ';
        }?>
             
    </script>
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
                <a class="navbar-brand" href="<?php echo site_url() ?>">Youteach</a>
            </div>
            
            <?php if($this->session->userdata('logged_in')) { ?>
            <style>
                .badge-notify{
                    background:red;
                 }
            </style>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown" style="">
                    <a href="<?php echo site_url("Frontend")."/receivedMessages" ?>">
                        <i class="fa fa-envelope fa-fw"></i><span class="badge badge-notify"></span>
                    </a>
                    
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                
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
                        <li><a href="<?php echo site_url('Login/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <?php }?>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <style>
                div.cse .gsc-control-cse, div.gsc-control-cse {
  background-color:transparent;
  border:none;
  padding:5px 0px 0px 0px;
  margin:0px;
}
td.gsc-search-button input.gsc-search-button {
    border: none;
  background-color:#337AB7;
}
input.gsc-input, .gsc-input-box, .gsc-input-box-hover, .gsc-input-box-focus, .gsc-search-button {
  box-sizing:content-box;
  line-height:normal;
}

            </style>
            
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">

                                <script>
                                    (function() {
                                      var cx = '015792252020815714352:zx5k2nkcbzk';
                                      var gcse = document.createElement('script');
                                      gcse.type = 'text/javascript';
                                      gcse.async = true;
                                      gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                                          '//cse.google.com/cse.js?cx=' + cx;
                                      var s = document.getElementsByTagName('script')[0];
                                      s.parentNode.insertBefore(gcse, s);
                                    })();
                                    
                                    
                                  </script>
                                  <gcse:search></gcse:search>
<!--                                <input type="text" class="form-control" name="q" placeholder="Search...">-->
<!--                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>-->
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
                            <a href="#login_page" class="fancybox" id="login_link" ><i class="fa fa-fw fa-user"></i> Login</a>
                            
                            <div class="" id="login_page" style="display: none">
                                <div class="alert alert-danger hidden" id="login_error" ></div>
                                <form action="<?php echo site_url('Login'); ?>" method="post" role="form">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" type="email" placeholder="Enter text" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" name="password" type="password" placeholder="Enter password" required="required">
                                    </div>
                                     <input type="submit" class="btn btn-default" style="float: right" value="Login"/>
                                </form>
                             </div>
                                
                        </li>
                        <li class="">
                            <a href="<?php echo site_url('Register'); ?>"><i class="fa fa-tasks fa-fw"></i> Register</a>
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
                            <a href="<?php echo site_url("frontend")."/getRecommendations" ?>"><i class="fa fa-bitbucket fa-fw"></i> Recommended for you</a>
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
