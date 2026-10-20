  <?php
  //login confirmation
 studconfirm_logged_in();

  ?>
<!doctype html>
<html lang="en">

  <head>
    <title>Online Grading System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/homepage/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/homepage/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/homepage/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/homepage/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/homepage/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/homepage/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/homepage/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/homepage/css/aos.css">
    <link rel="icon" type="image/png" href="img/WBGTS-logo.png">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>plugins/homepage/css/style.css">
    <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/responsive.css">

<style>
  body{
    background-color: #ddd;
  }
  /* Force menu text color */
    .site-navbar .site-navigation .site-menu > li > a {
        color: white !important;
    }

    /* Force active link color */
    .site-navbar .site-navigation .site-menu > li.active > a {
        color: white !important; /* same color, change if needed */
    }

    /* Fix hover color */
    .site-navbar .site-navigation .site-menu > li > a:hover {
        color: #1167b1 !important; /* choose any hover color */
    }
</style>
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" >

    
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>

      <header class="site-navbar site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">

            <div class="col-12 text-right">
              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white" aria-label="Open navigation menu"><span class="icon-menu h3 text-white"></span></a></span>

              

              <nav class="site-navigation  ml-auto d-none d-lg-block " role="navigation"  style="color: red" >
                <ul class="site-menu main-menu js-clone-nav ml-auto ">
                  <li class="active"><a href="<?php echo WEB_ROOT; ?>">Home</a></li>
                  <li><a href="<?php echo WEB_ROOT; ?>index.php?page=3">List of Subjects</a></li>
                  <li><a href="<?php echo WEB_ROOT; ?>index.php?page=2">Student Info</a></li>
                  <li><a href="<?php echo WEB_ROOT; ?>logout.php">Logout</a></li>  
                </ul>
              </nav>
            </div>
            

            
          </div>
        </div>

      </header>
      

    <div class="student-portal-main">
      <?php check_message(); ?>
      <?php require_once $content;?>
    </div>
    

    <footer >
      <div class="container">
         
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>

        </div>
      </div>
    </footer>

    </div>

    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/popper.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/bootstrap.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/owl.carousel.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/jquery.sticky.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/jquery.waypoints.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/jquery.animateNumber.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/jquery.fancybox.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/jquery.easing.1.3.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/aos.js"></script>

    <script src="<?php echo WEB_ROOT; ?>plugins/homepage/js/main.js"></script>

  </body>

</html>
