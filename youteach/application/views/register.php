<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets') ?>/css/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets') ?>/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo base_url('assets') ?>/datepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url('assets') ?>/jquery/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="<?php echo base_url('assets') ?>/js/jquery.maskedinput.min.js" type="text/javascript"></script>
</head>
<body>
    <div id="wrapper">
         <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; ">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo site_url(); ?>">Youteach</a>
            </div>
            <!-- /.navbar-header -->

            
            <!-- /.navbar-top-links -->

            
            <!-- /.navbar-static-side -->
        </nav> 
<div class="container-fluid" >
        <style>
            .error {color: #FF0000;}
            
                
        </style>

        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img')
                            .attr('src', e.target.result)
                            .width(175)
                            .height(150)
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        $(document).ready( function(){
            $(".disciplines").select2({
                maximumSelectionLength: 0
            });
            $(".country").select2();

            $(".disciplines").addClass("hidden");
            $('.datepicker').datepicker();
//             $('.datepicker').bind("change paste keyup", function (){
//                    if(!Date.parse($(this).value))
//                    {
//                        $(this).removeClass("alert alert-success");
//                        $(this).addClass("alert alert-danger");
//                    }
//                    else if(Date.parse($(this).value)!==null)
//                    {
//                        $(this).removeClass("alert alert-danger");
//                        $(this).addClass("alert alert-success");
//                    }
//                });
            $("[name=dob]").mask("9999-99-99",{placeholder:"yyyy-mm-dd"});
            $("[name=phone]").mask("9999999999");
        });
        $("#formCheck").trigger('reset');
        
        
        </script>
        
      <div class="row">
          <div class="col-md-2"></div>
        <div class="col-md-8  toppad" >
          <div class="panel panel-info">
              <div class="panel-heading"><h3 class="panel-title">Registration details</h3></div>

              <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 alert alert-danger <?php if(!validation_errors()) echo "hidden" ?>">
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
              <div class="row">
                  <form method="post" id="formCheck" action="<?php echo site_url("Register/registerUser") ?>" enctype="multipart/form-data">
                      <div class="col-md-3 col-lg-3 " align="center"> <img id="img" src="<?php echo base_url("assets")?>/images/profile_pics/user.png" alt="your image"/>
                          <input type='file' class="filestyle" name="picture" data-classButton="btn btn-primary" data-buttonName="btn-primary" data-input="false" data-buttonText="Upload picture" onchange="readURL(this);" /></div>


                <div class=" col-md-9 col-lg-9 ">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>First Name:</td>
                        <td><input class="form-control" type="text" name="firstname"><br><span class="error"> *</span></td>
                      </tr>
                      <tr>
                        <td>Last Name:</td>
                        <td><input class="form-control" type="text" name="lastname"></td>
                      </tr>
                       <tr>
                        <td>Gender:</td>
                        <td>
                            <input class="form-control" type="hidden" name="option" value="" id="btn-input" />
                            <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-primary">
                                <input  type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-primary">
                                <input type="radio" name="gender" value="female"> &nbsp; Female
                            </label>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Date of birth:</td>
                        <td><div class="input-group date" data-provide="datepicker">
                                <input type="text" name="dob" class="datepicker form-control" data-date-format="yyyy-mm-dd">
                            </div>
                        </td>
                      </tr>
                        <tr>
                            <td>Contact:</td>
                            <td><input class="form-control" type="text" name="phone"></td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td><select class="country form-control" style="display: none; width: 100%" name="country" >
                                    <option value="" disabled selected>Select your option</option>
                                    <?php foreach($countries as $country){
                                        ?>
                                    <option><?php echo $country->country_name; ?></option>
                                        <?php
                                    }?>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Institution Name:</td>
                            <td><input class="form-control"  type="text" name="inst"></td>
                        </tr>
                      <tr>
                        <td>Email:</td>
                        <td><input class="form-control" type="email" name="email"><br><span class="error"> *</span></td>
                      </tr>
                      <tr>
                        <td>Set a password:</td>
                        <td><input class="form-control" type="password" name="password"><br><span class="error"> *</span></td>
                      </tr>
                      <tr>
                        <td>Professional Skills:</td>
                        <td><textarea class="form-control" style="width: 250px" name="skill"></textarea></td>
                      </tr>
                           <tr>
                        <td>
                                            Favorite domains:</td><td>
                            <select name="domain[]" class="disciplines form-control" style="max-width: 300px" multiple="multiple">
                                                    <?php foreach($domains as $domain) { ?>
                                                    <option><?php echo $domain->name ?></option>
                                                    <?php }?>
                                                </select>

                            </td>
                      </tr>
<!--                      <tr>
                        <td>Video settings:</td>
                        <td><select class="form-control"> 
                                <option value="HD">HD</option>
                                <option value="480">480p</option>
                                <option value="360">360p</option>
                                <option value="240">240p</option>
                                <option value="144">144p</option>
                                <option value="auto">auto</option>
                            </select></td>
                      </tr>-->
<!--                        <tr>
                        <td>Notify about updates:</td>
                        <td><select class="form-control">
                                <option value="every">Everyday</option>
                                <option value="week">Every week</option>
                                <option value="new">Whenever new course is uploaded</option>
                            </select>
                        </td>

                      </tr>-->
                      <tr>
                          <td>Verification</td>
                          <td><div class="">
                        <div class="g-recaptcha" data-sitekey="6Lf_yRoTAAAAACGdNj667R2HERUJV5Wp493QQR3p"></div><?php echo form_error('g-recaptcha-response'); ?>
                    </div></td>
                      </tr>


                    </tbody>
                  </table>
                     <input style="margin-left: 100px;" type="submit" name="Submit" class="btn btn-primary"/>
                     <input type="reset" name="Reset" class="btn btn-default" />
                </div>

                  </form>
              </div>

            </div>
          </div>
        </div>
        <div class="col-md-2"></div>

      </div>
    </div>
</div>
</body>
<footer>
    <script src="<?php echo base_url('assets') ?>/select2/js/select2.min.js"></script>
        <script src="<?php echo base_url('assets') ?>/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets') ?>/bootstrap/js/bootstrap-filestyle.min.js"> </script>
        <script src="<?php echo base_url('assets') ?>/datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
</footer>
</html>
