<?php require_once("../includes/initialize.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../plugins/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../plugins/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../plugins/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../plugins/login/css/main.css">
	<link rel="stylesheet" type="text/css" href="login.css">
<!--===============================================================================================-->
</head>
<body>
<?php
 if (logged_in()) {
?>
   <script type="text/javascript">
            window.location = "index.php";
    </script>
<?php }  ?>

<?php
if (isset($_POST['btnlogin'])) {
    //form has been submitted1
    
    $uname = trim($_POST['uname']);
    $upass = trim($_POST['pass']);
    
    $h_upass = sha1($upass);
    //check if the email and password is equal to nothing or null then it will show message box
    if ($uname == '' OR $upass == '') {
?>    <script type="text/javascript">
                alert("Invalid Username and Password!");
                </script>
            <?php
        
    } else {
		//it creates a new objects of member
        $user = new User();
		//make use of the static function, and we passed to parameters
		$res = $user::AuthenticateUser($uname, $h_upass);
		//then it check if the function return to true
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
	<div class="limiter">
		<div class="container-login100 admin-login-background" style="background-image: url('../plugins/login/images/ssufront.jpg');">
			<div class="admin-login-content">
				<h1 class="login100-form-title admin-login-title">Admin Account Login</h1>
				<div class="wrap-login100 admin-login-card">
					<form class="login100-form validate-form admin-login-form" action="login.php" method="POST" aria-label="Admin account login">

					<div class="wrap-input100 validate-input admin-login-field" data-validate = "Enter username">
						<label class="sr-only" for="admin-username">Email or username</label>
						<input class="input100" id="admin-username" type="text" name="uname" placeholder="Email or username" autocomplete="username" aria-label="Email or username">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input admin-login-field admin-password-field" data-validate="Enter password">
						<label class="sr-only" for="admin-password">Password</label>
						<input class="input100" id="admin-password" type="password" name="pass" placeholder="Password" autocomplete="current-password" aria-label="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
						<button class="password-visibility-toggle" type="button" aria-label="Show password" aria-pressed="false" aria-controls="admin-password">
							<i class="fa fa-eye" aria-hidden="true"></i>
						</button>
					</div>

					<div class="container-login100-form-btn admin-login-submit">
						<button class="login100-form-btn" type="submit" name="btnlogin">
							Login
						</button>
					</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="../plugins/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/login/vendor/bootstrap/js/popper.js"></script>
	<script src="../plugins/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="../plugins/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/login/js/main.js"></script>
	<script>
		(function () {
			var password = document.getElementById('admin-password');
			var toggle = document.querySelector('.password-visibility-toggle');
			var icon = toggle.querySelector('i');

			toggle.addEventListener('click', function () {
				var showPassword = password.type === 'password';
				password.type = showPassword ? 'text' : 'password';
				toggle.setAttribute('aria-label', showPassword ? 'Hide password' : 'Show password');
				toggle.setAttribute('aria-pressed', showPassword ? 'true' : 'false');
				icon.className = showPassword ? 'fa fa-eye-slash' : 'fa fa-eye';
				password.focus();
			});
		}());
	</script>

</body>
</html>