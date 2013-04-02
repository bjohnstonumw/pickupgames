<?php
include "db_connect.php";

$name = mysqli_real_escape_string($db, trim($_POST['event']));
$date = mysqli_real_escape_string($db, trim($_POST['date']));
$time = mysqli_real_escape_string($db, trim($_POST['time']));
$sport = $_POST['sport'];
$loc = $_POST['location'];
$newFacName = mysqli_real_escape_string($db, trim($_POST['newFacName']));
$newFacAddress = mysqli_real_escape_string($db, trim($_POST['newFacAddress']));
$newFacZip = mysqli_real_escape_string($db, trim($_POST['newFacZip']));
$ad = mysqli_real_escape_string($db, trim($_POST['ad']));

if($newFacName==''||$newFacAddress==''||$newFacZip==''){

echo "<input type=button id=back value='Back'>";
echo '<br>All three facility inputs must be filled to add a new facility';
}
else{
$query2 = "INSERT INTO facilities VALUES (null, '$newFacName', '$newFacAddress', '$newFacZip')";
$result2 = mysqli_query($db,$query2) or die("Error adding a new Facility");

$query3 = "SELECT fac_id FROM facilities WHERE name='$newFacName' AND street_address='$newFacAddress' AND fac_zip='$newFacZip';";
$result3 = mysqli_query($db,$query3) or die("Error retrieving added facility");
$row = mysqli_fetch_array($result3);
$loc = $row['fac_id'];

$query = "INSERT INTO events VALUES (null,'$name','$date','$time', '$loc','$sport','$ad')";
$result = mysqli_query($db,$query) or die("Error Querying Database: Submit Event Result1");

echo '<META http-equiv="refresh" content="0;URL=../joinevent.php">';
}



?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>

$(document).ready(function(){
	$("input[id='back']").click(function(){
		window.location = "../event.php";
	});
});

</script>












