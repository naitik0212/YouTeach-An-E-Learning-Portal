<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $header; ?></title>

    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <!-- Metis core stylesheet -->
    <link href="<?php echo base_url() ?>assets/metis_dist/css/main.min.css" rel="stylesheet" type="text/css"/>

    <!-- metisMenu stylesheet -->
    <link href="<?php echo base_url() ?>assets/mentisMenu/metisMenu.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/metis_dist/css/theme.css" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
      <script src="assets/lib/html5shiv/html5shiv.js"></script>
      <script src="assets/lib/respond/respond.min.js"></script>
      <![endif]-->
    
    <!--jQuery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!--Modernizr-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
  </head>
  <body class="bg-dark dk ">
    <div class="bg-dark dk" id="wrap">
      <div id="top">

        <!-- .navbar -->
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <header class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
                <a href="<?php echo site_url("backend") ?>" class="navbar-brand">
                  <img src="<?php echo base_url() ?>assets/images/youteach_logo.png" style="height: 50px" alt="">
              </a>
            </header>
            <div class="topnav">
              <div class="btn-group">
                <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip" class="btn btn-default btn-sm" id="toggleFullScreen">
                  <i class="glyphicon glyphicon-fullscreen"></i>
                </a>
              </div>
              <div class="btn-group">
                <a data-placement="bottom" data-original-title="Course Upload Requests" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-graduation-cap"></i>
                  <span class="label label-warning">5</span>
                </a>
                <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                  <i class="fa fa-comments"></i>
                  <span class="label label-danger">4</span>
                </a>
                <a data-toggle="modal" data-original-title="Help" data-placement="bottom" class="btn btn-default btn-sm" href="#helpModal">
                  <i class="fa fa-question"></i>
                </a>
              </div>
              <div class="btn-group">
                  <a href="<?php echo site_url('login/modLogout'); ?>" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                  <i class="fa fa-power-off"></i>
                </a>
              </div>
              <div class="btn-group">
                <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                  <i class="fa fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">

              <!-- .nav -->
              <ul class="nav navbar-nav">
                  <li> <a href="<?php echo site_url('backend'); ?>">Dashboard</a>  </li>
<!--                <li> <a href="table.html">Tables</a>  </li>
                <li> <a href="file.html">File Manager</a>  </li>
                <li class='dropdown '>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Form Elements
                    <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
                    <li> <a href="form-general.html">General</a>  </li>
                    <li> <a href="form-validation.html">Validation</a>  </li>
                    <li> <a href="form-wysiwyg.html">WYSIWYG</a>  </li>
                    <li> <a href="form-wizard.html">Wizard &amp; File Upload</a>  </li>
                  </ul>
                </li>-->
              </ul><!-- /.nav -->
            </div>
          </div><!-- /.container-fluid -->
        </nav><!-- /.navbar -->
        <div class="head">
          <div class="search-bar">
            <form class="main-search" action="">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Live Search ...">
                <span class="input-group-btn">
            <button class="btn btn-primary btn-sm text-muted" type="button">
                <i class="fa fa-search"></i>
            </button>
        </span>
              </div>
            </form><!-- /.main-search -->
          </div><!-- /.search-bar -->
          <div class="main-bar">
            <h3>
              <i class="fa fa-list"></i>&nbsp; <?php echo $header ?></h3>
          </div><!-- /.main-bar -->
        </div><!-- /.head -->
      </div><!-- /#top -->
      <div id="left">
        <div class="media user-media bg-dark dker">
          <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
          </div>
          <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
              <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url() ?>assets/metis_dist/img/user.gif">
              <span class="label label-danger user-label">16</span>
            </a>
            <div class="media-body">
              <h5 class="media-heading"><?php echo $this->session->userdata('name'); ?></h5>
              <ul class="list-unstyled user-info">
                <li> <a href="">Moderator</a>  </li>
<!--                <li>Last Access :
                  <br>
                  <small>
                    <i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
                </li>-->
              </ul>
            </div>
          </div>
        </div>

        <!-- #menu -->
        <ul id="menu" class="bg-blue dker">
          <li class="nav-header">Menu</li>
          <li class="nav-divider"></li>
          <li class="">
            <a href="<?php echo site_url('backend'); ?>">
              <i class="fa fa-dashboard"></i><span class="link-title"> Dashboard</span>
            </a>
          </li>
          
          <li>
              <a href="<?php echo site_url('backend/viewUsers') ?>">
              <i class="fa fa-user"></i>
              <span class="link-title"> Users</span>
            </a>
          </li>
          <li>
              <a href="<?php echo site_url('backend/viewcourses'); ?>">
              <i class="fa fa-book"></i>
              <span class="link-title">
             Courses
          </span>  </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-inbox"></i><span class="link-title">
             Messages
          </span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-check"></i>
              <span class="link-title">
             Approved by you
          </span>
            </a>
          </li>
          <li>
              <a href="<?php echo site_url('backend/viewRequestsPending'); ?>">
              <i class="fa fa-pencil-square-o"></i>
              <span class="link-title">
                  Pending Requests <span class="text-right label label-danger user-label"><?php if(isset($request_count)) echo $request_count ?></span>
          </span>
            </a>
          </li>
          <li>
              <a href="<?php echo site_url('backend/viewRequestsGranted'); ?>">
              <i class="fa fa-check-circle"></i>
              <span class="link-title">
             Requests granted
          </span>
            </a>
          </li>
        </ul><!-- /#menu -->
      </div><!-- /#left -->