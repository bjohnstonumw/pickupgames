<?php
	
	/*
	*Pickup Games Website
	*@Author: Josiah Neuberger
	*@Author: Maddie Lord
	*@Author: Michael Wang
	*@Author: Brian Johnston
	*/
	
	if (isset( $_POST['submit_addblogentry'] )) {

		$blogentry = mysqli_real_escape_string($db, trim($_POST['blogentry']));
		
		
		$query = "INSERT INTO blog VALUES (null, '";
		$query .= $s_username . "', null, '";
		$query .= $blogentry . "')";
		
		$result = mysqli_query($db, $query)
			 or die("Error Querying Database from \"blog_addentry.php\"");
		
		echo '<META http-equiv="refresh" content="0;URL=blog.php">';
		
	}

	

	
?>