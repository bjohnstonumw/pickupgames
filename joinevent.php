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
<?php if(!isset($s_isLoggedIn) or $s_isLoggedIn == false) { die('Direct access not permitted'); } #From this point forward we can assume the user is logged in.?>

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
							<div class="10u">
							
								<!-- Main Content -->
								
									<?php include 'php/db_connect.php'; ?>
									<?php
										function load_events($db, $your_query, $isYourEvents, $radio_button_name) {
												
											echo "<table id='table-2'>";
								
											echo "<tr><th>ID</th><th>Name</th><th>Date</th><th>Time</th><th>Facility ID</th><th>Sport Type</th><th>Additional Information</th></tr>";
											
											$result = mysqli_query($db, $your_query) or die("Error Querying Database for events from joinevent.php: load_events function");
											
											while($row = mysqli_fetch_array($result)) {
												$event_id = $row['event_id'];
												$event_name = $row['name'];
												$event_date = $row['event_date'];
												$event_time = $row['event_time'];
												$event_fac_id = $row['fname'];
												$event_sport_type = $row['sport_name'];
												$event_ad = $row['ad'];
												
												if (!$isYourEvents) { $radio = "<input type='radio' name='$radio_button_name' value='$event_id' />"; }
												else { $radio = ""; }
												
												echo "<tr><td>$radio$event_id</td><td>$event_name</td><td>$event_date</td><td>$event_time</td><td>$event_fac_id</td><td>$event_sport_type</td><td>$event_ad</td></tr>";
											}
											echo "</table>";
										}
										
										function insert_selected_event($db, $s_username, $radio_button_name) {

											echo "<div>";
											echo "finally";
											$eid = $_POST[$radio_button_name]; #no need to escape because it's the id we pulled from the database. (not user input).
											
											$query = "INSERT INTO jevents VALUES ('$s_username', '$eid')"; #Use the logged in username.
											$result_insert = mysqli_query($db, $query) or die("Error Querying Database: Join Event: result_insert function");
											
											echo "</div>";
											echo '<META http-equiv="refresh" content="0;URL=joinevent.php">'; 
											
										}
			
									?>
									<section>
										<header>
											<h2>Search for an Event<h2>
										</header>
										<?php
											echo "<form method = 'post' action='joinevent.php' enctype='multipart/form-data'>";
											echo "<input type='text' id='search' name='search' size='40'/>";
											echo "<tr><td><input type='submit' name='submit_search' value='search' /></td><td>&nbsp;</td></tr>";
											echo "</form>";
											
											if (isset($_POST['submit_search'])) {
							
												echo "<form method = 'post' action = 'joinevent.php' enctype='multipart/form-data'>";
												
												$p_input= $_POST['search'];
												$query = "SELECT e.*, f.name as fname FROM events as e left join facilities as f on (e.fac_id = f.fac_id) where upper(e.name) LIKE upper('%$p_input%') OR upper(e.ad) LIKE upper('%$p_input%') OR upper(e.sport_name) LIKE upper('%$p_input%') ORDER BY event_date, event_time";
												
												load_events($db, $query, FALSE, "events_search");
												
												echo '<tr><td><input type="submit" name="join_event_from_search" value="Join Event" /></td><td>&nbsp;</td></tr>';
												echo "</form>";	
											}
											
											#Insert Event if one is selected and submitted by user:
											if (isset($_POST['join_event_from_search'])) { insert_selected_event($db, $s_username, "events_search"); }	
										?>
									</section>

									<section>
										<header>
											<h2>Your Events</h2>
										</header>
											<?php
												$query = "SELECT e.*, f.name as fname FROM events as e natural join jevents as j left join facilities as f on (e.fac_id = f.fac_id) where username='$s_username' ORDER BY event_date DESC";
												load_events($db, $query, TRUE, "events_your");	
											?>
									</section>
									
									<section>
										<header>
											<h2>Upcoming Events <a href="event.php" style="float:right; border:1px solid black; background-color: gray; color: white; padding:5px; display:inline-block;">Create a New Event!</a></h2>
										</header>
											
										<form method = "post" action = "joinevent.php" enctype="multipart/form-data">
											
											<?php
												$query = "SELECT e.*, f.name as fname FROM events as e left join facilities as f on (e.fac_id = f.fac_id) ORDER BY event_date DESC LIMIT 10";
												load_events($db, $query, FALSE, "events_upcoming");
											?>
											<tr><td><input type="submit" name="join_event_from_upcoming" value="Join Event" /></td><td>&nbsp;</td></tr>
											
										</form>

									</section>
									
									<!--Insert Event if one is selected and submitted by user:-->
									<?php if (isset($_POST['join_event_from_upcoming'])) { insert_selected_event($db, $s_username, "events_upcoming"); } ?>
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