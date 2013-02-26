<?php
$db = mysqli_connect('localhost', 'pickupgameuser22', 'pickup', 'pickupgames')
        or die ("ERROR: connecting to mysql server!");

$name = mysqli_real_escape_string($db, trim($_POST['event']));
$date = mysqli_real_escape_string($db, trim($_POST['date']));
$time = mysqli_real_escape_string($db, trim($_POST['time']));
$loc = mysqli_real_escape_string($db, trim($_POST['location']));
$zip = mysqli_real_escape_string($db, trim($_POST['zip']));
$sport = $_POST['sport'];
$ad = mysqli_real_escape_string($db, trim($_POST['ad']));

$query = "INSERT INTO events VALUES (null,'$name','$date','$time','$loc','$zip','$sport','$ad')";

$result = mysqli_query($db,$query) or die("Error Querying Database: Submit Event Result1");


$query2 = "SELECT * FROM events";

$result2 = mysqli_query($db, $query2) or die("Error Querying Database: Submit Event Result2");

while($row = mysqli_fetch_array($result2)) {
$fname = $row['name'];
$fdate = $row['event_date'];
$floc = $row['location'];
$fzip = $row['zip'];
$fsport = $row['sport_type'];
$fad = $row['ad'];
#echo "<tr><td >$fname</td><td >$fdate</td><td >$floc</td><td >$fzip</td><td >$fsport</td><td >$fad</td></tr>\n";
}

echo '<META http-equiv="refresh" content="0;URL=../event.php">';

?>
