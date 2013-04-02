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
								
									<section>
										<header><h2>Tell everyone about your event.</h2></header>
										
										<form name = "newevent" action = "php/submitevent.php" method = "post">
										<table id="table-2">
											<tr><td>Name of event: </td><td><input type = "text", name = "event"></td></tr>
											<tr><td>Date:</td><td><input type = "date", name = "date"></td></tr>
											<tr><td>Time:</td><td><input type = "time", name = "time"></td></tr>
											<input name="isHidden", value="yes", hidden='true'>
											<?php
												#Get the supported sports
												$query1 = "SELECT sport_name FROM sports";
												
												echo "<tr><td>Type of sport:</td><td><select name='sport'>";
												
												$result = mysqli_query($db, $query1) or die("Error Querying Database for facilities from event.php");

												while($row = mysqli_fetch_array($result)) {
													$sport_name = $row['sport_name'];
													
													echo "<option value='$sport_name'>$sport_name</option>";
												}
												echo "</select></td></tr>";


												$myZip= $s_zipcode;
												echo "<tr><td>Event Zipcode: </td><td><input type = 'text', id = 'zipvalue' name = 'zipvalue', value='$myZip'></td></tr>";
												
												$currentZip= $_POST['zipvalue'];
												
												$query2 = "SELECT fac_id, name, fac_zip FROM facilities ORDER BY fac_id ASC";
												
												echo "<tr><td>Facility:</td><td><select name='location'>";
												$result2 = mysqli_query($db, $query2) or die("Error Querying Database for facilities from event.php");
													
													
												while($row = mysqli_fetch_array($result2)) {
													$fac_id = $row['fac_id'];
													$fac_name = $row['name'];
													$fac_zip = $row['fac_zip'];
												
													echo "<option value='$fac_id', zip='$fac_zip', fac='yes'>$fac_name</option>";
												}
												
												
											?>
											</select>&nbsp<input type=button name='addFacility' value='Add a New Facility' status='bap'></td></tr>

											<tr toHide='yes'><td toHide='yes'>Name of Facility: </td><td toHide='yes'><input type=text, name='newFacName', toHide='yes'></td></tr><tr toHide='yes'><td toHide='yes'>Street Address: </td><td toHide='yes'><input type=text, name='newFacAddress', toHide='yes'></td></tr><tr toHide='yes'><td toHide='yes'>Zipcode: </td><td> <input type=text, name='newFacZip', toHide='yes'></td></tr>


											<tr><td style="vertical-align:middle;">Advertise your event:</td>
											<td><textarea rows = "10" cols = "75" name = "ad"></textarea><br><td>
											<td><input type = "submit" value="Submit Event"></td></tr>
										</table>
										</form>

									</section>

									<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
												</script>
												<script>

												$(document).ready(function(){
													opt=[];
													opt = $("select[name='location'] option").toArray();

													
													 var $recentZip = $("input[id='zipvalue']").attr('value');
														console.log($("input[id='zipvalue']").attr('value'));
														$("option[fac='yes']").remove();
														$("select[name='location']").append(opt);
														
														$("select[name='location'] option").filter(function() {
															if($(this).attr('zip') !== $recentZip)
															{
																return true;
															}
														}).remove();


													$("input[id='zipvalue']").keyup(function(){

														var $recentZip = $(this).val();
														console.log($(this).val());
														$("option[fac='yes']").remove();
														$("select[name='location']").append(opt);
														
														$("select[name='location'] option").filter(function() {
															if($(this).attr('zip') !== $recentZip)
															{
																return true;
															}
														}).remove();
														
													});


													$("tr[toHide='yes']").hide();
													$("td[toHide='yes']").hide();
													$("input[toHide='yes']").hide();
													$("input[name='addFacility']").data('status', 'add');


													$("input[name='addFacility']").click(function(){
														if($(this).data('status')=='add'){
															bap();
														}
														else if($(this).data('status')=='subtract'){
															subtract();
														}
														else{
															console.log("Aaaand this is where I'd put an error messege. IF I HAD ONE.");
														}
													});

													

												
														function bap(){
															console.log("Add");
															//console.log((this).data('status'));
															$("input[name='addFacility']").data('status','subtract');
															//console.log((this).data('status'));
															$("tr[toHide='yes']").show();
															$("td[toHide='yes']").show();
															$("input[toHide='yes']").show();
															$("input[name='addFacility']").attr('value', 'Use an Existing Facility');
															$("select[name='location']").hide();
															$("input[name='isHidden']").val('no');
														};

														function subtract(){
															console.log("Subtract");
															//console.log((this).data('status'));
															$("input[name='addFacility']").data('status','add');
															//console.log((this).data('status'));
															$("tr[toHide='yes']").hide();
															$("td[toHide='yes']").hide();
															$("input[toHide='yes']").hide();
															$("input[name='addFacility']").attr('value', 'Add a New Facility');
															$("select[name='location']").show();
															$("input[name='isHidden']").val('yes');
														};
													});



												</script>


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