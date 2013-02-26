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
											<h2>Join an Event</h2>
										</header>
											
										<form method = "post" action = "joinevent.php" enctype="multipart/form-data">
											<table>
												<!--<tr><td>Name of the Event</td><td>&nbsp;</td><td><input type="text" id="eventname" name="eventname" /></td></tr>-->
												<tr><td>Name of the Event</td><td>&nbsp;</td><td><select name="eventname">
												<?php
													$query = "SELECT * FROM events ORDER BY event_date DESC LIMIT 10";

													$result = mysqli_query($db, $query) or die("Error Querying Database for events from joinevent.php");
													
													
													while($row = mysqli_fetch_array($result)) {
														$event_name = $row['name'];
														echo "<option value='$event_name'>$event_name";
													}
													echo "</select>";
												?>
												<tr><td><input type="submit" name="join_event" value="Join Event" /></td><td>&nbsp;</td></tr>

											</table>
											
										</form>

									</section>
										
									<?php 
									
										
										/*	#Don't really need with the events being pulled into the dropdown box above.
										echo "<section><header><h2>Listing of Most Recent Events (Top 10)</h2></header>";
											
										$query = "SELECT * FROM events ORDER BY event_date DESC LIMIT 10";

										$result = mysqli_query($db, $query) or die("Error Querying Database");
										echo "<table id='events' class='test'><tr><td>ID</td><td>Name</td><tr>\n\n";
										while($row = mysqli_fetch_array($result)) {
											$event_id = $row['id'];
											$event_name = $row['name'];
											echo "<tr class='test'><td>$event_id</td><td>$event_name</td></tr>\n";
										}
										echo "</table>\n"; 
										echo "</section>";*/
										
										if (isset( $_POST['join_event'] ) and '$s_isLoggedIN' == true) {

											
											
											echo "<section>";
											$ename = mysqli_real_escape_string($db, trim($_POST['eventname']));
											$uname = $s_username;
											$result = mysqli_query($db, "SELECT id FROM events WHERE name = '$ename'");
											if (!$result) {
												echo 'Could not run query: ' . mysqli_error();
												exit;
											}
											$row = mysqli_fetch_row($result);
											$eid = $row[0];
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