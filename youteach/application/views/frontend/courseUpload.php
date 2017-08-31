<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Upload Course</h1>
                   
                        <ol class="breadcrumb">
                            <li class="">Course Upload</li>
                            <li class="active">Course Details</li>
                        </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <link href="<?php echo base_url('assets') ?>/jasny-bootstrap/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <link href="<?php echo base_url(); ?>assets/wysiwyg/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet" type="text/css"/>
            <!-- /.row -->
            
            
            <style>
                .error { color: #FF0000 }
            </style>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Provide your course information
                        </div>
                        <div class="panel-body">
                            <form method="post" action="<?php echo site_url('frontend/courseUploadHelper') ?>" enctype="multipart/form-data" role="form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Course name</label>
                                            <input class="form-control" type="text" name="name" placeholder="Enter course name">
                                            <?php if(form_error('name')) echo "<div class='alert alert-danger'>".form_error('name')."</div>"; ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Course Description</label>
                                            <textarea class="form-control" name="description" rows="3" style="max-width: 100%" placeholder="Enter the course description of 250-500 words"></textarea>
                                        </div>
                                        <?php if(form_error('description')) echo "<div class='alert alert-danger'>".form_error('description')."</div>"; ?>
                                        <div class="form-group">
                                            <label>Domain</label>
                                            <select class="form-control" name="domain" id="domain">
                                                <?php foreach($domain as $i) {?>
                                                <option value="<?php echo $i->name;?>"><?php echo $i->name;?></option>
                                                <?php } ?>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                if($('#domain option:selected').text()==='Other')
                                                {
                                                    $('#domain2').removeClass('hidden');
                                                }else
                                                {
                                                    $('#domain2').addClass('hidden');
                                                }
                                            });
                                              $('#domain').change(function() {
                                                if($('#domain option:selected').text()==='Other')
                                                {
                                                    $('#domain2').removeClass('hidden');
                                                }else
                                                {
                                                    $('#domain2').addClass('hidden');
                                                }});
                                        </script>
                                        <div class="form-group hidden" id="domain2">
                                            <label>Enter Domain name</label>
                                            <input class="form-control" type="text" name="domain2" placeholder="Enter course name">
                                        </div>
                                        <?php if(form_error('domain')) echo "<div class='alert alert-danger'>".form_error('domain')."</div>"; ?>
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">   Next   </button>
                                    </div>
                                    <div class="col-lg-6"> 
                                        <div class="row">
                                        <div class="col-lg-3">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="file">Choose image:</label><br>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 203px; height: 256px;">
                                                    <img src="" alt="No image selected">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                        <input type="file" class="form-control" name="frontcover" id="frontcover">
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                                <span class="help-block error"><?php echo form_error('frontcover') ?></span>
                                            </div>
                                            <div class="g-recaptcha" data-sitekey="6Lf_yRoTAAAAACGdNj667R2HERUJV5Wp493QQR3p"></div>
                                            <?php if(form_error('g-recaptcha-response')) echo "<div class='alert alert-danger'>".form_error('g-recaptcha-response')."</div>"; ?>

                                        </div>
                                        </div>
                                    </div>                        
                                </div>
                            </form>
                            <!-- /.row (nested) -->
                        <!-- /.panel-body -->
                    </div>
            <script src="<?php echo base_url('assets') ?>/js/fileinput.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/wysiwyg/js/wysihtml5-0.3.0.js" type="text/javascript"></script>
            <script src="<?php echo base_url(); ?>assets/wysiwyg/js/bootstrap-wysihtml5-0.0.2.js" type="text/javascript"></script>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <script>
                $(document).ready(function (){
                $("[name=description]").wysihtml5({
                    stylesheets:"<?php echo base_url("assets")."/wysiwyg/css/wysiwyg-color.css" ?>"
                });});
            </script>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
</div>