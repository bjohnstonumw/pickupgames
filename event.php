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
<?php include 'php/session_start_loggedin.php';?>
<html>
	<head>
		<title>Get in the Game: Join an Event</title>
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

							<!-- Logo -->
								<h1><a href="index.php" class="mobileUI-site-name">Get in the Game</a></h1>
							
							<!-- Nav -->
								<nav class="mobileUI-site-nav">
									<a href="index.php">Homepage</a>
								</nav>

						</div>
					</div>
				</header>
			</div>

		<!-- Content -->
			<div id="content-wrapper">
				<div id="content">
					<div class="5grid-layout">
						<div class="row">
							<div class="10u">
							
								<!-- Main Content -->
								
									<section>
										<header><h2>Tell everyone about your event.</h2></header>
										
										<form name = "newevent" action = "php/submitevent.php" method = "post">
										<table>
											<tr><td>Name of event: </td><td><input type = "text", name = "event"></td></tr>
											<tr><td>Date:</td><td><input type = "date", name = "date"></td></tr>
											<tr><td>Time:</td><td><input type = "time", name = "time"></td></tr>
											<tr><td>Location:</td><td><input type = "text", name = "location"></td></tr>
											<tr><td>Zip Code:</td><td><input type = "text", name = "zip"></td></tr>
											<tr><td>Type of sport:</td><td><select name = "sport"><option value = "football">Football<option value = "baseball">Baseball<option value = "basketball">Basketball<option value = "soccer">Soccer</td></tr>
										</table>
											Advertise your event:<br>
											<textarea rows = "10" cols = "30" name = "ad"></textarea><br>
											<input type = "submit" value="Submit Event">
										</form>

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