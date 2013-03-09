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
								
									<?php include 'php/db_connect.php'; ?>
									
									<section>
										<header>
											<h2>Your Events</h2>
										</header>
										
										
											
											<?php
												function load_events($db, $your_query, $isYourEvents) {
													
													echo "<table id='table-2'>";
										
													echo "<tr><th>ID</th><th>Name</th><th>Date</th><th>Time</th><th>Facility ID</th><th>Sport Type</th><th>Additional Information</th></tr>";
													
													#print_r($db);
													#print_r($your_query);
													$result = mysqli_query($db, $your_query) or die("Error Querying Database for events from joinevent.php");
													
													
													while($row = mysqli_fetch_array($result)) {
														$event_id = $row['event_id'];
														$event_name = $row['name'];
														$event_date = $row['event_date'];
														$event_time = $row['event_time'];
														$event_fac_id = $row['fac_id'];
														$event_sport_type = $row['sport_name'];
														$event_ad = $row['ad'];
														
														if (!$isYourEvents) { $radio = "<input type='radio' name='jevent' value='$event_id' />"; }
														else { $radio = ""; }
														
														echo "<tr><td>$radio$event_id</td><td>$event_name</td><td>$event_date</td><td>$event_time</td><td>$event_fac_id</td><td>$event_sport_type</td><td>$event_ad</td></tr>";
													}
													echo "</table>";
												}
												
												$query = "SELECT * FROM events natural join jevents where username='$s_username' ORDER BY event_date DESC";
												load_events($db, $query, TRUE);
													
											?>
									</section>
									
									<section>
										<header>
											<h2>Join an Event</h2>
										</header>
											
										<form method = "post" action = "joinevent.php" enctype="multipart/form-data">
											
											<?php
												$query = "SELECT * FROM events ORDER BY event_date DESC";
												load_events($db, $query, FALSE);
											?>
											<tr><td><input type="submit" name="join_event" value="Join Event" /></td><td>&nbsp;</td></tr>
											
										</form>

									</section>
										
									<?php 
										
										if (isset( $_POST['join_event'] ) and '$s_isLoggedIN' == true) {
											echo "<section>";
											$uname = $s_username;

											$eid = $_POST['jevent']; #no need to escape because it's the id we pulled from the database. (not user input).
											$query = "INSERT INTO jevents VALUES ('$uname', '$eid')";

											$result2 = mysqli_query($db,$query) or die("Error Querying Database: Join Event Result1");
											echo "</section>";

											echo '<META http-equiv="refresh" content="0;URL=joinevent.php">';
											echo $eid; 
										}
									?>

									


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