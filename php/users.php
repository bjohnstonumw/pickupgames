<?php

	#@author Josiah Neuberger modified from my sessionDemo code.

	if (!isset($_SESSION)) { session_start(); } #This checks to see if the session_start() has not been called.
	
	#Call the correct function:
	if (!isset($_GET['action'])) { $_GET['action'] = "default"; }
	switch ($_GET['action']) {
	case 'webLogin':
		web_Login();
		break;
	case 'createAccount':
		web_CreateAccount();
		break;
	case 'logoff':
		web_Logoff();
		break;
	default:
		#DEBUG: You shouldn't be calling this file without setting action.
		break;
	}
			

	function web_Login() {
  	   include "db_connect.php";
  	   if (isset($_POST['username'])){
			 $p_username = mysqli_real_escape_string($db, trim($_POST['username']));
			 $p_password = trim($_POST['pw']); #hash the password,  really should be using a more labor intensive encryption like hash() or crypt().

			 $query = "select * from users WHERE username = '$p_username' AND password = SHA('$p_password')";
			 $result = mysqli_query($db, $query) or die("Error Querying Database in web_Login()");
			 
			if ($row = mysqli_fetch_array($result))
			{
				#echo $query . "<br>";
				#print_r($row); #FIXME: @DELETE
				
				
				$_SESSION['username'] = $row['username'];
				$_SESSION['zipcode'] = $row['zipcode'];
				$_SESSION['isLoggedIn'] = true;
				$_SESSION['loginFailed'] = false;
				
				if (isset($_SESSION['prev_url'])) { echo '<META http-equiv="refresh" content="0;URL=' . $_SESSION['prev_url'] . '">'; }
				else { echo '<META http-equiv="refresh" content="0;URL=../index.php">'; }
				
			}
			else {
				$_SESSION['username'] = $p_username;
				$_SESSION['isLoggedIn'] = false;
				$_SESSION['loginFailed'] = true;
				if (isset($_SESSION['attemptCount'])) {$_SESSION['attemptCount'] += 1; }
				else $_SESSION['attemptCount'] = 1;
				
				echo '<META http-equiv="refresh" content="0;URL=../login.php?action=loginFailed">';
			}
		}
	}
	
	function web_CreateAccount() {
		include "db_connect.php";
		$bad_user = '<META http-equiv="refresh" content="0;URL=../login.php?action=newAccount">';
		$p_zipcode = fix_check_zip($_POST['zipcode']);
		
		if (isset($_POST['username']) and isset($_POST['pw']) and $p_zipcode != false){
		
			$p_username = mysqli_real_escape_string($db, trim($_POST['username']));
			$p_password = trim($_POST['pw']); //hash the password,  really should be using a more labor intensive encryption like hash() or crypt().
			$p_zipcode = fix_check_zip($_POST['zipcode']);
			
			$query = "INSERT INTO users(username, password, users_zip) VALUES ('$p_username', SHA('$p_password'), '$p_zipcode')";
			
			$result = mysqli_query($db, $query) or die("Error Querying Database in web_CreateAccount()"); 
			if ($db->affected_rows != 0) {
				#echo "DEBUG: @DELETE Affected Rows: " . $db->affected_rows;
				$_SESSION['username'] = $result['username'];
				
				$_SESSION['username'] = $p_username;
				$_SESSION['zipcode'] = $p_zipcode;
				$_SESSION['isLoggedIn'] = true;
				$_SESSION['loginFailed'] = false;
				
				if (isset($_SESSION['prev_url'])) { echo '<META http-equiv="refresh" content="0;URL=' . $_SESSION['prev_url'] . '">'; }
				else { echo '<META http-equiv="refresh" content="0;URL=../index.php">'; }
				
			} else {
				#echo "DEBUG: @DELETE fell into else Affected Rows: " . $db->affected_rows;
				echo $bad_user;
			}
		}
		else { echo $bad_user; }
	}

/*
*Does a basic check for a valid zipcode form. That is, this
* function will return a 5 digit number, which may or may not
* validate to an actual USPS zipcode.
*/	
function fix_check_zip($zip) {
	
	$zip = trim($zip); #Remove any leading/trailing blank characters.
	if (strlen($zip) != 5) { return false; } #Check first to see if we have the right number of integers.
	else {
		$zip = filter_var($zip, FILTER_VALIDATE_INT); #Filter out any characters that are not integers.
		
		if ($zip == false or strlen($zip) != 5) { return false; } #We only accept 5 digit zip codes.
		else { return $zip; }
	}
}
	
function web_Logoff() {
	session_destroy();
	echo '<META http-equiv="refresh" content="0;URL=../index.php">';
}

?>