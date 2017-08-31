
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets') ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
  <!-- <link href="" rel="stylesheet"> -->
 
    <style>
        .button{
         background-color: #000;
         box-shadow: 0 4px #2A3F54;
         color: white;
         width: 100%;
         height: 40px;
         border-width: 4px;
         border-color: black;
         border-radius: 3px;
         font-size: 16px; 
        }


        .form-container{
         width: 25%;
         height: auto;
         padding: 20px 20px 20px 20px;
         border-radius: 5px;
         margin-top:10%;
         border-width: 4px;
         border-color: white;
         text-align: center;
         text-decoration-line: none;
        } 
    </style>

</head>    


<body class="login-body" style="background-color: #F8F8F8">
 
 <div class="container form-container" style="background-color: #F0F0F0">
     <div class="container-fluid alert alert-danger"></div>
     <form class="form-signin" method="post" action="<?php echo site_url('backend/validate') ?>">
         <a class="form-control btn-primary" href="<?php echo $_SERVER['REQUEST_URI']; ?>" style="text-decoration: none; font-size: 18px" role="button">Youteach</a>
         <br>
              <?php if(isset($login_error)) {?> <div class="alert alert-danger">
                 <span class=" glyphicon glyphicon-exclamation-sign"></span> <?php echo $login_error ?>
              </div>
         <?php }?>
             
   <div class="login-wrap">
     <input type="text" class="form-control" placeholder="Email" autofocus name="email"><br>
     <input type="password" class="form-control" placeholder="Password" name="password">
     <label class="checkbox">
         <input style="" type="checkbox" value="remember-me"> Remember me
     <span class="pull-right"><a href="#"> Forgot Password?</a></span><br>
     </label>
    <button class="button" type="submit">Sign in</button>
   </div >
   <br>
  </form>
 </div>
     
    
</body> 
</html>	