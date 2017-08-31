<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registration form Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo base_url('assets'); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="<?php echo base_url('assets'); ?>/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets'); ?>/bootstrap/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Youteach Registration form <small>where knowledge is free</small></h1>
</div>

<!-- Registration form - START -->
<div class="container">
    <div class="row">
        <form role="form" method="post" action="<?php echo site_url('register').'/registerUser' ?>">
            <div class="col-lg-12">
                <?php if(isset($error)) { ?><div class="alert alert-danger"><strong><span class="glyphicon glyphicon-asterisk"></span><?php echo $error; ?></strong></div>
                <?php }
                else {
                ?>
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <?php }
                ?>
                <div class="form-group">
                    <label for="name">Enter Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Enter Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_email">Confirm Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email2" name="confirm_email" placeholder="Confirm Email" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Enter Password</label><p><?php echo form_error('password'); ?></p>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2">Confirm Password</label><p><?php echo form_error('password2'); ?></p>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Enter Password Again" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="number">Enter Contact Number</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="number" name="number" placeholder="Enter Contact Number" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="g-recaptcha" data-sitekey="6Lf_yRoTAAAAACGdNj667R2HERUJV5Wp493QQR3p"></div><?php echo form_error('g-recaptcha-response'); ?>
                    </div>
                    <div class="col-md-6">
                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                    </div>
                </div>
                <br>
                
            </div>
        </form>
    </div>
</div>
<!-- Registration form - END -->

</div>

</body>
</html>
