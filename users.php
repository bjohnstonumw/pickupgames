<?php include 'php/session_start_loggedin.php';?>
<?php if(!isset($s_isLoggedIn) or $s_isLoggedIn == false) { die('Direct access not permitted'); } #From this point forward we can assume the user is logged in.?>
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
<!DOCTYPE HTML>
<html>
	<head>
		<title>Get in the Game: Users and Friends</title>
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
										function calculateDistance($x1,$x2,$y1,$y2){
												$pi = M_PI / 180;
												$x1=floatval($x1)*$pi;
												$x2=floatval($x2)*$pi;
												$y1=floatval($y1)*$pi;
												$y2=floatval($y2)*$pi;
												$dx=floatval($x2-$x1);
												$dy=floatval($y2-$y1);
												$a=sin($dx/2)*sin($dx/2)+cos($x1)*cos($x2)*sin($dy/2)*sin($dy/2);
												$c=2*atan2(sqrt($a),sqrt(1-$a));
												$r=6372.797*$c;
												$m=$r*0.621371192;
												return $m;
											}
											
										function displayWithinDistance($db, $distance, $zip, $p_input){
												
											echo "<table id='table-2'>";
										
													echo "<tr><th>ID</th><th>Name</th><th>Date</th><th>Time</th><th>Facility ID</th><th>Sport Type</th><th>Additional Information</th></tr>";
													
													$allZips = mysqli_query($db, "SELECT * FROM us_zips;") or die("Error Querying Database for events from joinevent.php");
													
													$selfLoc = mysqli_query($db,"SELECT * FROM us_zips WHERE zip='$zip';") or die("Error Querying Database for events from joinevent.php");
													$l = mysqli_fetch_array($selfLoc);

													$selfLat=$l['latitude'];
													$selfLon=$l['longitude'];
													while($row = mysqli_fetch_array($allZips)) {
														$lat=$row['latitude'];
														$lon=$row['longitude'];
														$zip=$row['zip'];
														if(calculateDistance($selfLat,$lat,$selfLon,$lon)<$distance){
															$q=mysqli_query($db,"SELECT facilities.fac_zip, facilities.name fname, e.*  FROM events e JOIN facilities WHERE facilities.fac_id=e.fac_id AND facilities.fac_zip='$zip' AND (upper(e.name) LIKE upper('%$p_input%') OR upper(e.ad) LIKE upper('%$p_input%') OR upper(e.sport_name) LIKE upper('%$p_input%')) ORDER BY e.event_date, e.event_time;") or die("Error in joining for zips");
														while($row2=mysqli_fetch_array($q)){
															$event_id = $row2['event_id'];
															$event_name = $row2['name'];
															$event_date = $row2['event_date'];
															$event_time = $row2['event_time'];
															$event_fac_id = $row2['fname'];
															$event_sport_type = $row2['sport_name'];
															$event_ad = $row2['ad'];
															
														$radio = "<input type='radio' name='events_search' value='$event_id' />"; 
														
														echo "<tr><td>$radio$event_id</td><td>$event_name</td><td>$event_date</td><td>$event_time</td><td>$event_fac_id</td><td>$event_sport_type</td><td>$event_ad</td></tr>";
													}
														}
													}
													echo "</table>";
													
										}
										
										function load_profile($db, $query, $useRadio, $radio_button_name) {
											
											echo "<table id='table-2'>";
								
											echo "<tr><th>Username</th><th>Name</th><th>Age</th><th>Gender</th><th>Zip</th><th>Photo</th></tr>";
											
											$result = mysqli_query($db, $query) or die("Error Querying Database for user profile from users.php: load_profile function");
										
											while($row = mysqli_fetch_array($result)) {
												$users_username = $row['username'];
												$users_name = $row['name'];
												$users_age = $row['age'];
												$users_gender = $row['gender'];
												$users_zip = $row['users_zip'];
												$users_pic_location = $row['photo'];
												

												
												if ($useRadio) { $radio = "<input type='radio' name='$radio_button_name' value='$users_username' />"; }
												else { $radio = ""; }
												
												echo "<tr><td>$radio$users_username</td><td>$users_name</td><td>$users_age</td><td>$users_gender</td><td>$users_zip</td><td><img src='$users_pic_location' alt='$users_pic_location'></tr>";
											}
											echo "</table>";
										}


										
										function add_friend($db, $s_username, $radio_button_name) {

											echo "<div>";
											echo "finally";
											$friend_username = $_POST[$radio_button_name]; #no need to escape because it's the id we pulled from the database. (not user input).
											if(isset($friend_username)){
											$query = "INSERT INTO friends VALUES ('$s_username', '$friend_username')"; #Use the logged in username.
											$result_insert = mysqli_query($db, $query) or die("Error Querying Database: Join Event: result_insert function");
											}
											echo "</div>";
											echo '<META http-equiv="refresh" content="0;URL=users.php">'; 
											
										}
			
									?>
									<section>
										<header>
											<h2>Your Profile<a href="myProfile.php" style="float:right; border:1px solid black; background-color: gray; color: white; padding:5px; display:inline-block;">Edit Your Profile!</a><h2>
										</header>
										
										<?php
											$query = "SELECT * FROM users WHERE username='$s_username'";
											load_profile($db, $query, FALSE, "not_needed"); 
										?>
										
									</section>
									
									<section>
										<header>
											<h2>Your Friends</h2>
										</header>
											<?php
												#$query = "SELECT uf.* from friends f inner join users u on (f.username = u.username) inner join users uf on (f.friend = uf.username) where f.username='$s_username'";
												$query = "SELECT * FROM view_friends WHERE id='$s_username'";
												load_profile($db, $query, FALSE, "not_needed"); 	
											?>
									</section>
									
									

								
									
									<section>
										<header>
											<h2>Users</h2>
							
										</header>
									
										
										<form method = "post" action = "users.php" enctype="multipart/form-data">
										
										<?php
											$query = "SELECT * FROM users";
											load_profile($db, $query, TRUE, "rb_user_profiles");
										?>
										<tr><td><input type="submit" name="add_as_your_friend_submit" value="Add Friend!" /></td><td>&nbsp;</td></tr>
											
										</form>

									</section>
									
									<!--Add friend if one is selected and submitted by user:-->
									<?php if (isset($_POST['add_as_your_friend_submit'])) { add_friend($db, $s_username, "rb_user_profiles"); } ?>
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