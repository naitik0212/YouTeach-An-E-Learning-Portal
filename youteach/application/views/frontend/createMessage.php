<div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create Message</h1>
                    <?php if(isset($error))
                    {
                        ?><span class="error"><?php echo validation_errors() ?></span><?php
                    }
                        else{?>
                        <ol class="breadcrumb">
                            <li class="">Messages</li>
                            <li class="active">Received Messages</li>
                        </ol>
                    <?php }?>
                </div>
                <!-- /.col-lg-12 -->
        </div>
    <link href="<?php echo base_url(); ?>assets/wysiwyg/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet" type="text/css"/>
    <div class="panel panel-default">
        <div class="panel-heading">
            Message Details
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo site_url("frontend")."/createMessageHelper"; ?>" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <input class="form-control" type="email" maxlength="255" placeholder="Enter receiver email" value="<?php if(isset($recipient)) echo $recipient; ?>" name="receiver" required="">
                            <?php if(form_error('receiver')) echo "<div class='alert alert-danger'>".form_error('receiver')."</div>"; ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" maxlength="50" placeholder="Enter message subject (50 characters max)" name="subject" required="">
                            <?php if(form_error('subject')) echo "<div class='alert alert-danger'>".form_error('subject')."</div>"; ?>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Enter message" class="form-control" height="" style="height: 350px" name="message" required=""></textarea>
                            <?php if(form_error('message')) echo "<div class='alert alert-danger'>".form_error('message')."</div>"; ?>
                        </div>
                        <div class="form-group" >
                            <input class="form-control btn btn-primary" type="Submit" value ="Send Message" style="width: 120px" >
                            
                            <a class="text-center btn btn-default pull-right" href="<?php echo site_url("frontend")."/receivedMessages"; ?>">Cancel</a>
                        </div>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6Lf_yRoTAAAAACGdNj667R2HERUJV5Wp493QQR3p"></div>
                            <?php if(form_error('g-recaptcha-response')) echo "<div class='alert alert-danger'>".form_error('g-recaptcha-response')."</div>"; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/wysiwyg/js/wysihtml5-0.3.0.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/wysiwyg/js/bootstrap-wysihtml5-0.0.2.js" type="text/javascript"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <script>
        $(document).ready( function() {
        $("[name=message]").wysihtml5({
            stylesheets:"<?php echo base_url("assets")."/wysiwyg/css/wysiwyg-color.css" ?>"
        });});
        
    </script>
    
</div>