<!DOCTYPE HTML>
<!--
	Halcyonic 2.5 by HTML5 Up!
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)

	PHP and Modified HTML by:
	@Author: Josiah Neuberger
	@Author: Maddie Lord
	@Author: Michael Wang
	@Author: Brian Johnston
-->

<?php include 'php/session_start_loggedin.php'; ?>

<html>
	<head>
		<title>Rules and Information for Pickup Games</title>
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
						<div class="12u">

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
						
						
							<div class="3u" style="position:fixed; float:left;">
								
								<!-- Sidebar -->
									<section >
										<?php
											if (!$s_isLoggedIn) {
												$_SESSION['prev_url'] = $_SERVER["PHP_SELF"];
												echo '<p>New Here?You must register an account to create/join games. 
														<br>Or if you are returning you can login.</p>
													<a style="color: white;" href="login.php?action=createAccount" class="button-big">Register!</a><br>
													<a style="color: white;" href="login.php" class="button-big">Login!</a>';
											} else {
												echo '<p>Do you want to get started and join a game?</p>
													<a style="color: white;" href="joinevent.php" class="button-big">Join a Pickup Game!</a><br>
													<a style="color: white;" href="event.php" class="button-big">Create a New Event!</a>';
											}
										?>
									</section>

							</div>
						
							<div class="7u" style="float:right;">
							
								<!-- Main Content -->
									<section style="border-bottom:1px dashed;">
										<a name="football"></a>
										<header>
											<h2 style="border-bottom:2px double;">Football</h2>
											<h3>Pick Up Football Rules</h3>
										</header>
										<p>
											Basic football rules for beginners:					
										</p>
									</section>
									
									<section style="border-bottom:1px dashed;">
										<a name="soccer"></a>
										<header>
											<h2 style="border-bottom:2px double;">Soccer</h2>
											<h3>Pick Up Soccer Rules</h3>
										</header>
										<p>
											Basic soccer rules for beginners:					
										</p>
									</section>
									
									<section style="border-bottom:1px dashed;">
										<a name="baseball"></a>
										<header>
											<h2 style="border-bottom:2px double;">Baseball</h2>
											<h3>Pick Up Baseball Rules</h3>
										</header>
										<p>
											Basic baseball rules for beginners:					
										</p>
									</section>
									
									<section style="border-bottom:1px dashed;">
										<a name="basketball"></a>
										<header>
											<h2 style="border-bottom:2px double;">Basketball</h2>
											<h3>Pick Up Basketball Rules</h3>
										</header>
										<p>
											Basic basketball rules for beginners:					
										</p>
									</section>

							</div>
						</div>
					</div>
				</div>
			</div>

		<!-- Footer -->
			<div id="footer-wrapper">
				<footer id="footer" class="5grid-layout">
					<div class="row">
						<div class="8u">
						
							<!-- Links -->
						

						</div>
						<div class="4u">
							
							<!-- Blurb -->
							
						
						</div>
					</div>
				</footer>
			</div>

		<!-- Copyright -->
			<div id="copyright">
				&copy; Untitled. All rights reserved. | Design: <a href="http://html5up.net">HTML5 Up!</a> | Images: <a href="http://fotogrph.com">Fotogrph</a>
			</div>

	</body>
</html>