<?php
#@author Josiah Neuberger modified from my sessionDemo code.

if (!isset($_SESSSION)) { session_start(); } #This checks to see if the session_start() has not been called.


if (isset($_SESSION['isLoggedIn'])) { $s_isLoggedIn = $_SESSION['isLoggedIn']; }
else { $s_isLoggedIn = false; $hasZip = false;}

if ($s_isLoggedIn) {
	
	$s_username = $_SESSION['username'];
	$s_zipcode = $_SESSION['zipcode'];
	$hasZip = !is_null($s_zipcode); #not null equal to has zip.
}

?>