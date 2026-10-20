<?php require_once("includes/initialize.php");
 if (studlogged_in()) {
?>
   <script type="text/javascript">
            window.location = "index.php";
    </script>
    <?php
}
 
if (isset($_POST['btnlogin'])) {
    //form has been submitted1
    
    $uname = trim($_POST['uname']);
    $upass = trim($_POST['pass']);
    
     $h_upass = $upass;
    //check if the email and password is equal to nothing or null then it will show message box
    if ($uname == '') {
?>    <script type="text/javascript">
                alert("Invalid Username and Password!");
                </script>
            <?php
        
    } else {
		//it creates a new objects of member
        $user = new Student();
		//make use of the static function, and we passed to parameters
		 $res = $user::Authenticatestudent($uname, $upass);
		//then it check if the function return to true
    	//$stud = new Student();
		//$res= $stud::Authenticatestudent($uname);
		if($res == true){
			?>   <script type="text/javascript">
					//then it will be redirected to home.php
					window.location = "index.php";
				</script>
			<?php
		
		
		} else {
?>    <script type="text/javascript">
                alert("Username or Password Not Registered! Contact Your administrator.");
                window.location = "index.php";
                </script>
        <?php
        }
        
    }
} else {
    
    $email = "";
    $upass = "";
    
}

?>
 
<!doctype html>
<html lang="en">

  <head>
    <title>Grade Tracking System</title>
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

  </head>

  <style>
    .btn-primary {
        background-color: #1167b1 !important;
        border-color: #1167b1 !important;
    }

    .btn-primary:hover {
        background-color: #0e5492 !important;
        border-color: #0e5492 !important;
    }

    .line-bottom:after {
        background-color: #1167b1 !important;
    }

  </style>


  <body class="student-login-page" data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    
    <div class="site-wrap" id="home-section">

      <div class="ftco-blocks-cover-1">
          <div class="ftco-cover-1 overlay" style="background-image: url('images/ssufront.jpg')">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-lg-5">
                  <h1 class="line-bottom">Online Grade Tracking System</h1>
                </div>
                <div class="col-lg-5 ml-auto">
                  
                </div>
              </div>
            </div>
          </div>
      </div>

    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-5 pr-md-5 mr-auto">
            <h2 class="line-bottom">Sign In</h2>
            <p>This area, you have to login using your id number in school in order access your account ang view your profile and subject with grades</p>
          </div>
          <div class="col-md-6">
            <div class="quick-contact-form bg-white">
                <h2>Sign In</h2>
                <form action="login.php" method="POST">
                  <div class="form-group">
                    <input type="number" class="form-control" name="uname" placeholder="Student Id Number">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" name="pass" placeholder="Password">
                  </div> 
                  <div class="form-group">
                    <input type="submit" value="Login" name="btnlogin" class="btn btn-primary px-5">
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
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
