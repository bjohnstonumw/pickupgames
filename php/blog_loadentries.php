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

	while($row = mysqli_fetch_array($result)) {
		$content=$row['content'];
		$username=$row['username'];
		$sdate=$row['sdate'];
		Echo "<p style='padding: 15px; border-left: 4px solid black; border-bottom: 6px double black'> $content <br><br>
			<blockquote style='text-align:right; font-size:1.5em'>~ $username   @ $sdate </blockquote></p><br><br>";
	}
?>