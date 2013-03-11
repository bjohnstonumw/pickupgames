<?php
/*
	PHP and Modified HTML by:
	@Author: Josiah Neuberger
	@Author: Maddie Lord
	@Author: Michael Wang
	@Author: Brian Johnston
*/


echo "<h1><a href='index.php' class='mobileUI-site-name'>Get in the Game</a></h1>";

echo "<nav class='mobileUI-site-nav'>";

echo "<a href='index.php'>Homepage</a>";

#Items accessible to logged in users.
if ($s_isLoggedIn) { 
	echo '<a href="joinevent.php">Events</a>'; 
} 

#Items available to guests
echo "<a href='blog.php'>Blog</a>";
echo "<a href='rules.php'>Rules</a>";

#Only display login if not logged in:
if (!$s_isLoggedIn) {
	echo "<a href='login.php'>Login</a>";
}
else { echo "<a href='php/users.php?action=logoff'>Logoff</a>"; }
 
echo "</nav>";