<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="<?php echo base_url() ?>assets/animate/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/metis_dist/css/main.min.css">
  </head>
  <body class="login">
    <div class="form-signin">
      <div class="text-center">
        <!--<img src="assets/img/logo.png" alt="Metis Logo">-->
          <span class="fa fa-graduation-cap"></span> Youteach
      </div>
      <hr>
      <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form action="<?php echo site_url('backend/validate') ?>" method="post">
            <p class="text-muted text-center">
              Enter your username and password
            </p>
            <input type="text" placeholder="Email" class="form-control top" name="email">
            <input type="password" placeholder="Password" class="form-control" name="password" bottom>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          </form>
        </div>
        <div id="forgot" class="tab-pane">
          <form action="index.html">
            <p class="text-muted text-center">Enter your valid e-mail</p>
            <input type="email" placeholder="mail@domain.com" class="form-control">
            <br>
            <button class="btn btn-lg btn-danger btn-block" type="submit">Recover Password</button>
          </form>
        </div>
        
      </div>
      <hr>
      <div class="text-center">
        <ul class="list-inline">
          <li> <a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password?</a>  </li>
          <li> <a class="text-muted" href="#signup" data-toggle="tab"> Signup</a>  </li>
        </ul>
      </div>
    </div>

    <!--jQuery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!--Bootstrap -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      (function($) {
        $(document).ready(function() {
          $('.list-inline li > a').click(function() {
            var activeForm = $(this).attr('href') + ' > form';
            //console.log(activeForm);
            $(activeForm).addClass('animated fadeIn');
            //set timer to 1 seconds, after that, unload the animate animation
            setTimeout(function() {
              $(activeForm).removeClass('animated fadeIn');
            }, 1000);
          });
        });
      })(jQuery);
    </script>
  </body>
</html>