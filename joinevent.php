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
										<header>
											<h2>Join an Event></h2>
										</header>
											
												<form method = "post" action = "joinevent.php" enctype="multipart/form-data">
													<table>
														<tr><td>First Name</td><td><input type="text" id="firstname" name="firstname" /></td></tr>
														<tr><td>Last Name</td><td><input type="text" id="lastname" name="lastname" /></td></tr>
														<tr><td>&nbsp;</td><td> <textarea name="blogentry" id="blogentry" rows=6 cols=70 >"Type Blog Entry Here" </textarea> </td></tr>
														
														<tr><td>Sports Pic</td><td><input type="file" id="userpic" name="userpic" accept="image/*" /></td></tr>
														
														<tr><td><input type="submit" name="submit_addblogentry" value="Add Blog Entry" /></td><td>&nbsp;</td></tr>

													</table>
													
												</form>

										</section>
										
										<?php 
											
											if (isset( $_POST['submit_addblogentry'] )) {
											
												include 'php/db_connect.php';
												
												
												echo "<section>";
												
												echo "</section>";
												
												echo '<META http-equiv="refresh" content="0;URL=joinevent.php">';
											}
										?>

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