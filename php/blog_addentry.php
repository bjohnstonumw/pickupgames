<?php
	
	/*
	*Pickup Games Website
	*@Author: Josiah Neuberger
	*@Author: Maddie Lord
	*@Author: Michael Wang
	*@Author: Brian Johnston
	*/
	
	if (isset( $_POST['submit_addblogentry'] )) {

		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$blogentry = $_POST['blogentry'];
		
		$yourpic = "user_submissions/" . $_FILES['userpic']['name'];
		move_uploaded_file($_FILES['userpic']['tmp_name'], $yourpic);
		
		$query = "INSERT INTO blog VALUES (null, '";
		$query = $query . $firstname . "', '" . $lastname . "', null, '";
		$query = $query . $blogentry . "', '" . $yourpic . "')";
		
		$result = mysqli_query($db, $query)
			 or die("Error Querying Database from \"blog_addentry.php\"");

		# Echo "Thanks for your submission!"; #DEBUG @Delete
		
		echo '<META http-equiv="refresh" content="0;URL=blog.php">';
		
	}

	

	
?>