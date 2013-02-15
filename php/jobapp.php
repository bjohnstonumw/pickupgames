<!--
Example PHP Code that will collect data from a user form and write the
information to a file for later use. 

The key is that the php is in a seperate file than the html main page,
which allows for one person to work on the php without causing tons
of conflicts with lots of edits in the main html file when doing
git commits.

This code can be included inline by inserting the following line
into your page's source file:

include php/jobapp.php
Contact: Josiah Neuberger
-->

<?php
if ( isset( $_POST['submit'] ) ) {

	date_default_timezone_set('America/New_York');
	$date = date('m/d/Y h:i:s a', time());

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$resume = $_POST['resume'];
	$phone = $_POST['phone'];

	$my_file = 'user_submissions/' . $lastname . "_" . $firstname . ".txt";
	$fout = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);

	fwrite ($fout, "\r\n*****************" . $date . "***********************************\r\n");
	fwrite ($fout, "lastname::" . $lastname);
	fwrite($fout, "\r\nfirstname::" . $firstname);
	fwrite ($fout, "\r\nphone::" . $phone);
	fwrite ($fout, "\r\n##########################Resume Start##########################\r\n");
	fwrite ($fout, $resume);
	fwrite ($fout, "\r\n##########################Resume End############################\r\n");

	fclose($fout);
	
	echo '<META http-equiv="refresh" content="0;URL=' . $my_file . '">';

}
?>