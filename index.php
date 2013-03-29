<?php include 'php/session_start_loggedin.php'; ?>
<!DOCTYPE HTML>
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
<html>
	<head>
		<title>Get in the Game: A Pickup Sports Game Site</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<noscript><link rel="stylesheet" href="css/5grid/core.css" /><link rel="stylesheet" href="css/5grid/core-desktop.css" /><link rel="stylesheet" href="css/5grid/core-1200px.css" /><link rel="stylesheet" href="css/5grid/core-noscript.css" /><link rel="stylesheet" href="css/style.css" /><link rel="stylesheet" href="css/style-desktop.css" /></noscript>
		<script src="css/5grid/jquery.js"></script>
		<script src="css/5grid/init.js?use=mobile,desktop,1000px&amp;mobileUI=1&amp;mobileUI.theme=none&amp;mobileUI.titleBarHeight=55&amp;mobileUI.openerWidth=75&amp;mobileUI.openerText=&lt;"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/style-ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<div id="header-wrapper">
				<header id="header" class="5grid-layout">
					<div class="row">
						<div class="12u">
						
							<?php include 'php/menu.php'; ?>

						</div>
					</div>
				</header>
				<div id="banner">
					<div class="5grid-layout">
						<div class="row">
							<div class="6u">
							
								<!-- Banner Copy -->
									
									
									<?php
									if ($s_isLoggedIn) { 
										echo '<p>Welcome Back, ' . $s_username . '!</p>
											<a href="php/users.php?action=logoff" class="button-big">Logoff</a>'; 
									}
									else { 
										echo '<p>New Here? Register an account. Or if you are returning you can login</p>
											<a href="login.php?action=createAccount" class="button-big">Register!</a>
											<a href="login.php" class="button-big">Login!</a>';
									}
			
									?>

							</div>
							<div class="6u">
								
								<!-- Banner Image -->
									<a  class="bordered-feature-image"><img src="images/sports.jpg" alt="" /></a>
							
							</div>
						</div>
					</div>
				</div>
			</div>

		<!-- Features -->
			<div id="features-wrapper">
				<div id="features">
					<div class="5grid-layout">
						<div class="row">
							<div class="3u">
							
								<!-- Feature #1 -->
									<section>
										<a href="rules.php#football" class="bordered-feature-image"><img src="images/football.jpg" alt="" /></a>
										<h2><a href="rules.php#football">Football</a></h2>
										<p>
											Click on the image to see rules and other important information, such as
											you must bring your own equipment. You must be logged in to join a pickup game.
										</p>
									</section>

							</div>
							<div class="3u">
								
								<!-- Feature #2 -->
									<section>
										<a href="rules.php#baseball" class="bordered-feature-image"><img src="images/baseball.jpg" alt="" /></a>
										<h2><a href="rules.php#baseball">Baseball</a></h2>
										<p>
											Click on the image to see rules and other important information, such as
											you must bring your own equipment. You must be logged in to join a pickup game.
										</p>
									</section>

							</div>
							<div class="3u">
								
								<!-- Feature #3 -->
									<section>
										<a href="rules.php#basketball" class="bordered-feature-image"><img src="images/basketball.jpg" alt="" /></a>
										<h2><a href="rules.php#basketball">Basketball</a></h2>
										<p>
											Click on the image to see rules and other important information, such as
											you must bring your own equipment. You must be logged in to join a pickup game.
										</p>
									</section>

							</div>
							<div class="3u">
								
								<!-- Feature #4 -->
									<section>
										<a href="rules.php#soccer" class="bordered-feature-image"><img src="images/soccer.jpg" alt="" /></a>
										<h2><a href="rules.php#soccer">Soccer</a></h2>
										<p>
											Click on the image to see rules and other important information, such as
											you must bring your own equipment. You must be logged in to join a pickup game.
										</p>
									</section>

							</div>
						</div>
					</div>
				</div>
			</div>

		<!-- Copyright -->
			<div id="copyright">
				&copy; Untitled. All rights reserved. | Design: <a href="http://html5up.net">HTML5 Up!</a> | Images: <a href="http://fotogrph.com">Fotogrph</a> | <a href="credits.php" class="button-big">Credits!</a>
			</div>

	</body>
</html>