<?php
include "db_connect.php";

$name = mysqli_real_escape_string($db, trim($_POST['event']));
$date = mysqli_real_escape_string($db, trim($_POST['date']));
$time = mysqli_real_escape_string($db, trim($_POST['time']));
$loc = $_POST['location'];
$sport = $_POST['sport'];
$ad = mysqli_real_escape_string($db, trim($_POST['ad']));

$query = "INSERT INTO events VALUES (null,'$name','$date','$time', '$loc','$sport','$ad')";

$result = mysqli_query($db,$query) or die("Error Querying Database: Submit Event Result1");

echo '<META http-equiv="refresh" content="0;URL=../joinevent.php">';

?>
