<!--
	Modified version of HTML5 Up template:
	
	Halcyonic 2.5 by HTML5 Up!
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
	
	PHP and Modified HTML by:
	@Author: Josiah Neuberger
	@Author: Maddie Lord
	@Author: Michael Wang
	@Author: Brian Johnston
-->
<?php
if (!isset($_SESSION)) { session_start(); }
	$MAX_LOGIN_ATTEMPTS = 3;
	$s_username = "";
	if (!isset($_GET['action'])) { $_GET['action'] = "default"; }

	if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] == true) { 
		$s_username = $_SESSION['username'];
		$s_zipcode = $_SESSION['zipcode'];		
	}
	elseif (isset($_SESSION['loginFailed']) and $_SESSION['loginFailed'] == true) { 
	
		if (isset($_SESSION['attemptCount'])) { $s_attemptCount = $_SESSION['attemptCount']; }
		else $s_attemptCount = $_SESSION['attemptCount'] = 0;
		//Track the number of failed login attempts.
		$s_isLoggedIn = false;
	}
	else { //Do nothing, never tried to login yet.
		$s_isLoggedIn = false;
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Get in the Game: Login</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<noscript><link rel="stylesheet" href="css/5grid/core.css" /><link rel="stylesheet" href="css/5grid/core-desktop.css" /><link rel="stylesheet" href="css/5grid/core-1200px.css" /><link rel="stylesheet" href="css/5grid/core-noscript.css" /><link rel="stylesheet" href="css/style.css" /><link rel="stylesheet" href="css/style-desktop.css" /></noscript>
		<script src="css/5grid/jquery.js"></script>
		<script src="css/5grid/init.js?use=mobile,desktop,1000px&amp;mobileUI=1&amp;mobileUI.theme=none&amp;mobileUI.titleBarHeight=55&amp;mobileUI.openerWidth=75&amp;mobileUI.openerText=&lt;"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/style-ie9.css" /><![endif]-->
	</head>
	<body class="subpage">
	
		<!-- Header -->
			<div id="header-wrapper">
				<header id="header" class="5grid-layout">
					<div class="row">
						<div class="10u">

							<?php include 'php/menu.php'; ?>

						</div>
					</div>
				</header>
			</div>

		<!-- Content -->
			<div id="content-wrapper">
				<div id="content">
					<div class="5grid-layout">
						<div class="row">
							<div class="12u">
							
								<!-- Main Content -->
										
								<section>
								
									<?php
										switch ($_GET['action']) {
										case 'createAccount':
											echo "<h2>Create Account</h2>";
											echo '<form method="post" action="php/users.php?action=createAccount">';
											break;
										case 'newAccount':
											echo "<h2>Create Account</h2>";
											echo '<form method="post" action="php/user.php?action=createAccount">';
											echo "<p>I'm sorry you're account could not be created. Please try again<p>";
											break;
										case 'loginFailed':
											echo "<h2>Retry Login</h2>";
											echo "<h3>Attempt: $s_attemptCount</h3>";
											echo "I'm sorry your username or password was incorrect.";
											echo '<form method="post" action="php/users.php?action=webLogin">';
											break;
										default:
											echo "<h2>Login</h2>";
											echo '<form method="post" action="php/users.php?action=webLogin">';
										}
									?>
									<p>
									<label for="username">Username:</label>
									<input type="text" id="username" name="username" value="<?php $s_username ?>" size="40" /></p>
									<p>
									<label for="password">Password:</label>
									<input type="password" id="password" name="pw" size="40" /></p>

									
									
									<?php
										if (isset($_GET['action']) and $_GET['action'] == 'createAccount') {
											echo "<p><label for='zipcode'>ZipCode:</label>
											<input type='number' id='zipcode' name='zipcode' size=40 /></p>
											
											<p><input type='submit' value='Create Account' name='submit' /></p>";
										
										} else {
											echo "<p><input type='submit' value='Login' name='submit' /></p>";
										}
									?>
									
									</form>
								
						  
									<p><a href="login.php?action=createAccount">Create Account</p>
								
									</section>


							</div>
						</div>
					</div>
				</div>
			</div>

		<!-- Footer Deleted for this page-->

		

		<!-- Copyright -->
			<div id="copyright">
				&copy; Untitled. All rights reserved. | Design: <a href="http://html5up.net">HTML5 Up!</a> | Images: <a href="http://fotogrph.com">Fotogrph</a>
			</div>

	</body>
</html>