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


<?php include 'php/session_start_loggedin.php'; ?>

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
						
							<!-- Logo -->
								<h1><a href="#" class="mobileUI-site-name">Get in the Game</a></h1>
							
							<!-- Nav -->
								<nav class="mobileUI-site-nav">
									<a href="index.php">Homepage</a>
									<?php
									if ($s_isLoggedIn) { #Only show if we are logged in.
										echo '<a href="event.php">Event</a>';
										echo '<a href="joinevent.php">Join a Pickup Game</a>'; 
									} 
									?>
									<a href="blog.php">Blog</a>
								</nav>

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

		<!-- Content -->
			<div id="content-wrapper">
				<div id="content">
					<div class="5grid-layout">
						<div class="row">
							<div class="4u">

								<!-- Box #1 -->
									<section>
										<header>
											<h2>Who We Are</h2>
											<h3>An Awesome Group of People</h3>
										</header>
										<a  class="feature-image"><img src="images/group.jpg" alt="" /></a>
										<p>
											Brian, Maddie, Michael, and Josiah are 4 UMW Computer Science
											Students who have created this site. We are doing this as a 
											database course project.
										</p>
									</section>

							</div>
							<div class="4u">

								<!-- Box #2 -->
									<section>
										<header>
											<h2>What We Do</h2>
											<h3>We Play Sports</h3>
										</header>
										<a  class="feature-image"><img src="images/pic05.jpg" alt="" /></a>
										<p>
											We really don't.
										</p>
									</section>

							</div>
							<div class="4u">
								
								<!-- Box #3 -->
									<section>
										<header>
											<h2>What People Are Saying</h2>
											<h3>By People We Mean Us</h3>
										</header>
										<ul class="quote-list">
											<li>
												<img src="images/brian.jpg" alt="" />
												<p>"Neque nisidapibus mattis"</p>
												<span>Brian Johnston, Scrum Master of Get in the Game</span>
											</li>
											<li>
												<img src="images/josiah.jpg" alt="" />
												<p>"Lorem ipsum consequat!"</p>
												<span>Josiah Neuberger, President of Get in the Game</span>
											</li>
											<li>
												<img src="images/maddie.jpg" alt="" />
												<p>"Magna veroeros amet tempus"</p>
												<span>Maddie Lord, Head Programmer of Get in the Game</span>
											</li>
											<li>
												<img src="images/michael.jpg" alt="" />
												<p>"Magna veroeros amet tempus"</p>
												<span>Michael Wang, Product Owner of Get in the Game</span>
											</li>
										</ul>
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
								<section>
									<h2>Links to Important Stuff</h2>
									<div class="5grid">
										<div class="row">
											<div class="3u">
												<ul class="link-list last-child">
													<li><a href="football.php">Football Rules and Regulation</a></li>
													<li><a href="baseball.php">Baseball Rules and Regulation</a></li>
													<li><a href="basketball.php">Basketball Rules and Regulation</a></li>
													<li><a href="soccer.php">Soccer Rules and Regulation</a></li>
												</ul>
											</div>

										</div>
									</div>
								</section>

						</div>
						<div class="4u">
							
							<!-- Blurb -->
								<section>
									<h2>An Informative Text Blurb</h2>
									<p>
										Duis neque nisi, dapibus sed mattis quis, rutrum accumsan sed. Suspendisse eu 
										varius nibh. Suspendisse vitae magna eget odio amet mollis. Duis neque nisi, 
										dapibus sed mattis quis, sed rutrum accumsan sed. Suspendisse eu varius nibh 
										lorem ipsum amet dolor sit amet lorem ipsum consequat gravida justo mollis.
									</p>
								</section>
						
						</div>
					</div>
				</footer>
			</div>

		<!-- Copyright -->
			<div id="copyright">
				&copy; Untitled. All rights reserved. | Design: <a href="http://html5up.net">HTML5 Up!</a> | Images: <a href="http://fotogrph.com">Fotogrph</a> | <a href="credits.php" class="button-big">Credits!</a>
			</div>

	</body>
</html>