<?php
include "db_connect.php";






function sessionsearch_junk_justforreference () {
if ($s_isLoggedIn) { echo "<h1>Results for $s_zipcode</h1>"; }
	else { echo "<h1>Results</h1>"; }
	
	if (isset($_POST['search']))
	{
		$searchterm = mysqli_real_escape_string($db, trim($_POST['search']));
		

		if ($searchterm == 'movies')
		{
			if ($hasZip) { $addZipToQuery = " WHERE zip=$s_zipcode "; }
			else { $addZipToQuery = ""; }
			
			$query = "SELECT * FROM movies$addZipToQuery ORDER BY movie";
	  
			$result = mysqli_query($db, $query)
				or die("Error Querying Database");
			echo "<table id=\"hor-minimalist-b\">\n<tr><th>Movie</th><th>Theater</th><tr>\n\n";
			while($row = mysqli_fetch_array($result)) {
				$movie = $row['movie'];
				$theater = $row['theater'];
				echo "<tr><td  >$movie</td><td >$theater</td></tr>\n";
			}
			echo "</table>\n"; 
		}
		else
		{
			if ($hasZip) { $addZipToQuery = " AND zip=$s_zipcode "; }
			else { $addZipToQuery = ""; }
			
			$query = "SELECT * FROM stores where (name LIKE '%$searchterm%' OR type LIKE '%$searchterm%')$addZipToQuery ORDER BY name";
	  
			$result = mysqli_query($db, $query)
				or die("Error Querying Database");
			echo "<table id=\"hor-minimalist-b\">\n<tr><th>Name</th><th>Type</th><th>Address</th><th>City</th><tr>\n\n";
			while($row = mysqli_fetch_array($result)) {
				$name = $row['name'];
				$type = $row['type'];
				$address = $row['address'];
				$city = $row['city'];

				echo "<tr><td  >$name</td><td >$type</td><td >$address</td><td >$city</td></tr>\n";
			}
			echo "</table>\n"; 
		}
		
	  }
}
	?>