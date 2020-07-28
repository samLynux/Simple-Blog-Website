<?php
session_start();
date_default_timezone_set("Asia/Jakarta");

require_once 'securimage/securimage.php';
require_once 'Connection/connectionDB.php';
if (isset($_POST['login'])) {
	$image = new Securimage();
	if ($image->check($_POST['captcha_code']) == false) {
		echo ("<script>alert(\"Sorry, wrong captcha code.\");</script>");
	} else {
		if (
			preg_match('/[\';^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['loginUsername']) ||
			preg_match('/;()/', $_POST['loginPassword'])
		) {
			echo ("<script>alert(\"special characters not allowed\");</script>");
		} else {
			if ($_POST['loginUsername'] == NULL || $_POST['loginPassword'] == NULL) {
				echo ("<script>alert(\"Please fill the username and/or password.\");</script>");
			} else {
				$sql =
					"SELECT * FROM `profiles`";
				$data = $db->query($sql);
				$bool = false;
				foreach ($data as $row) {
					if (
						$row['username'] == $_POST["loginUsername"] &&
						$row['password'] == md5($_POST["loginPassword"] . $row['username'] . 'UTSPTIGANJIL2019')
					) {
						$bool = true;
					}
				}
				if (!$bool) {
					echo ("<script>alert(\"username and/or password is wrong\");</script>");
				} else {
					// ganti halaman disini
					$_SESSION["ID"] = $_POST['loginUsername'];
					echo ("<script>location.href ='main.php';</script>");
				}
			}
		}
	}
} else if (isset($_POST['signup'])) {
	if ($_POST['signupUserName'] == NULL || $_POST['signupPassword'] == NULL) {
		echo ("<script>alert(\"Please fill the username and/or password.\");</script>");
	} else if (strlen($_POST['signupPassword']) < 7) {
		echo ("<script>alert(\"Password needs at least 7 characters.\");</script>");
	} else if (
		preg_match('/[\';^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['signupUserName']) ||
		preg_match('/[\';^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['firstName']) ||
		preg_match('/[\';^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['lastName']) ||
		preg_match('/;()/', $_POST['signupPassword'])
	) {
		echo ("<script>alert(\"->special characters not allowed as a Username, first name, or last name<br>\");</script>");
		echo ("<script>alert(\"->passwords are not allowed to have the folowing characters([ ; ],[ ( ],[ ) ])\");</script>");
	} else {

		if ($_POST['signupPassword'] !=  $_POST['signupPasswordConfirmation']) {
			echo ("<script>alert(\"Please type the same password in confirmation textfield.\");</script>");
		} else {
			$g;
			if (empty($_POST["gender"])) {
				$g = 'o';
			} else if ($_POST["gender"] == "male") {
				$g = 'm';
			} else if ($_POST["gender"] == "female") {
				$g = 'f';
			} else {
				$g = 'o';
			}
			$sql =
				"INSERT INTO `profiles` ( `first_name`, `last_name`, `username`, `password`, `birthdate`, `date_joined`,`gender`) 
    				VALUES ('" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . $_POST["signupUserName"] . "', 
    				'" . $_POST["signupPassword"] . "', '" . $_POST["birthday"] . "', curdate(),'" . $g . "')";
			if ($db->query($sql) == false) {
				echo ("<script>alert(\"Username is already used, please enter a new username.\");</script>");
			} else {
				$passSetup =
					"UPDATE `profiles` 
    						 SET `password` = '" . md5($_POST["signupPassword"] . $_POST["signupUserName"] . 'UTSPTIGANJIL2019') .  "'
    						 WHERE `profiles`.`username` = '" . $_POST["signupUserName"] . "'";
				$db->query($passSetup);
				// ganti halaman disini
				$_SESSION["ID"] = $_POST['signupUserName'];
				echo ("<script>location.href ='main.php';</script>");
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="file/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="file/fonts/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="file/css/style.css">
	<link rel="stylesheet" type="text/css" href="file/css/login.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


	<script>
		$(document).ready(function() {

			let loginDialog = $('#login-form').dialog({
				autoOpen: false

			});
			$('.loginButton').on('click', function(btn) {
				loginDialog.dialog('open');
			});


			let signupDialog = $('#signup-form').dialog({
				autoOpen: false
			});
			$('.signUpButton').on('click', function(btn) {
				signupDialog.dialog('open');
			});
		});
	</script>
</head>

<body class="loginPage">
	<div id="head" class="head">

	</div>
	<div id="services" class="text-center">
		<div class="container">
			<div class="section-title">
				<h2>Feel Like Making Friends ?</h2>
				<p> Then what are you waiting for? <br> Join now and be Popular ! </p>
			</div>
			<button class="loginButton btn-custom5" onclick="dialogOpen()">LOGIN</button> <br> <br> <br>
			<p> <i> Not a member yet? Join now for free! </i> </p>
			<button class="signUpButton btn-custom5" onclick="dialogOpen()">SIGNUP</button> <br> <br> <br> <br>
			<div class="row">
				<div class="col-md-4"> <i class="fa fa-unlock"></i>
					<div class="service-desc">
						<h3>Place to Express Yourself</h3>
						<p>I'm expressing with my full capabilities <br>
							And now I'm living in correctional facilities </p>
					</div>
				</div>
				<div class="col-md-4"> <i class="fa fa-smile-o"></i>
					<div class="service-desc">
						<h3> Place to Make Friends </h3>
						<p> A special shot of peace goes out to all my pals</p>
					</div>
				</div>
				<div class="col-md-4"> <i class="fa fa-money"></i>
					<div class="service-desc">
						<h3> Place to Grow Your Brands and Make Money </h3>
						<p> Cash Rules Everything Around Me </p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="login-form" title="Login">
		<form method="post">
			Userame
			<input id="email" type="text" name="loginUsername" class="text" placeholder="Username">
			Password
			<input id="password" type="password" name="loginPassword" class="text" placeholder="Password">
			<div>
				<?php echo Securimage::getCaptchaHtml() ?>
			</div>
			<button type='submit' name='login'>Submit</button>
		</form>
	</div>
	<div id="signup-form" title="Create a new Account">
		<form method="post">
			<input type="text" name="firstName" class="text" placeholder="First Name">
			<input type="text" name="lastName" class="text" placeholder="Last Name">
			<input type="text" name="signupUserName" class="text" placeholder="UserName">
			<br><b>Birthday</b>
			<input type="date" id="birthday" name="birthday"><br><br>
			<b>Gender </b><br>
			<label for="male" class="radio-inline">
				<input type="radio" id="male" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
			</label>
			<label for="female" class="radio-inline">
				<input type="radio" id="female" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">Female
			</label>
			<label for="other" class="radio-inline">
				<input type="radio" id="other" name="gender" value="other">Other
			</label><br><br>
			<input id="password" type="password" name="signupPassword" class="text" placeholder="Password">
			<input id="password" type="password" name="signupPasswordConfirmation" class="text" placeholder="Password(confirmation)">
			<button type='submit' name='signup'>Submit</button>
		</form>
	</div>
	<div id="footer">
		<div class="container text-center">
			<p>&copy; Project Pemograman Web Genap 2020. Created by Jordy, Sam and Yuan </a></p>
		</div>
	</div>
</body>

</html>