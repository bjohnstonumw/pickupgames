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
<title>Get in the Game: My Profile</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<noscript><link rel="stylesheet" href="css/5grid/core.css" /><link rel="stylesheet" href="css/5grid/core-desktop.css" /><link rel="stylesheet" href="css/5grid/core-1200px.css" /><link rel="stylesheet" href="css/5grid/core-noscript.css" /><link rel="stylesheet" href="css/style.css" /><link rel="stylesheet" href="css/style-desktop.css" /></noscript>
		<script src="css/5grid/jquery.js"></script>
		<script src="css/5grid/init.js?use=mobile,desktop,1000px&amp;mobileUI=1&amp;mobileUI.theme=none&amp;mobileUI.titleBarHeight=55&amp;mobileUI.openerWidth=75&amp;mobileUI.openerText=&lt;"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/style-ie9.css" /><![endif]-->
	</head></head>
<body class = "subpage">
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
			
<?

include 'php/db_connect.php';


if (isset($_POST['sport'] )){
	if( $_POST['sport'] != ''){
		$sport = $_POST['sport'];
		$insertsport = "INSERT INTO sportuser values('$s_username', '$sport')";
		$result = mysqli_query($db, $insertsport) or die ("Blew up picking a new sport, man.");
	}
}

if (isset($_POST['submit'])){

if (isset($_POST['photo'])){
	$photo = $_POST['photo'];
} else {
	$photo = NULL;
}

if (isset($_POST['name'])){
	$name = $_POST['name'];
} else {
	$name = NULL;
}

if (isset($_POST['age'])){
	$age = $_POST['age'];
} else {
	$age = NULL;
}

if (isset($_POST['gender'])){
	$gender = $_POST['gender'];
} else {
	$gender = NULL;
}

if (isset($_POST['zip'])){
	$zip = $_POST['zip'];
} else {
	$zip = NULL;
}

$updateuser = "UPDATE users SET photo='$photo', name='$name', age=$age, gender = '$gender', users_zip = $zip WHERE username = '$s_username'";
$result = mysqli_query($db, $updateuser) or die ("Blew up setting your user data, fella.");
}

$getinfoquery = "SELECT photo, name, age, gender, users_zip FROM users WHERE username = '$s_username'";
$result = mysqli_query($db, $getinfoquery) or die ("Blew up getting your user data, guy.");

$row = $result->fetch_array();
$photo = $row['photo'];
$name = $row['name'];
$age = $row['age'];
$gender = $row['gender'];
$zip = $row['users_zip'];



echo"
	<form name = 'profile' method = 'post'>
		<header><h2>$s_username's Profile</h2></header>
		<p>Note: All information is publicly accessible. Feel free to leave anything (except zip code) blank.</p>
		<img src = '$photo'>
		<p>Change your picture? <input type = 'text' name = 'photo' value = '$photo'></p>
		<h3>Your Vitals</h3>
		<p>Name: <input type = 'text' name = 'name' value = '$name'></p>
		<p>Age: <input type = 'text' name = 'age' value = '$age'></p>
		<p>Gender: <input type = 'text' name = 'gender' value = '$gender'></p>
		<p>Zip Code: <input type 'text' name = 'zip' value = '$zip'></p>
		<h3>Sports I'm into</h3>
		

";

$sportselectquery = "SELECT * FROM users u JOIN sportuser s ON u.username = '$s_username' AND u.username = s.username";
$result = mysqli_query($db, $sportselectquery) or die ("Blew up finding your sports, champ.");
while ($row = mysqli_fetch_array($result)) {
	$sport_name = $row['sport_name'];
	echo" 	<p>$sport_name</p>";

}
echo"
		<p>Add another sport? <input type = 'text' name = 'sport' value = ''>
		<p><input type = 'submit' name = 'submit' value = 'submit'></p>
	</form>


";
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
</body>
</html>
