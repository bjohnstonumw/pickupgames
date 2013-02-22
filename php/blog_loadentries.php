<?php
	/*
	*Pickup Games Website
	*@Author: Josiah Neuberger
	*@Author: Maddie Lord
	*@Author: Michael Wang
	*@Author: Brian Johnston
	*/
	
	include('db_connect.php');					
	$query = "SELECT * FROM blog ORDER BY sdate DESC";
	
	$result = mysqli_query($db, $query)
		 or die("Error Querying Database");

	foreach ($result as $row) {
		Echo "<p style='padding: 15px; border-left: 4px solid black; border-bottom: 6px double black'>" . $row['content'] . "<br><br>
			<img src=\"" .  $row['pic'] . "\" alt=\"Awww, No Pic!\">
			<blockquote style='text-align:right; font-size:1.5em'>~" . $row['firstname'] . " " . $row['lastname'] . " @" . $row['sdate'] . "</blockquote></p><br><br>";
	}
?>