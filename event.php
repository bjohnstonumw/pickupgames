<html>
<head>
</head>
<body>
Tell everyone about your event.<br>
<form name = "newevent" action = "submitevent.php" method = "post">
<table>
	<tr><td>Name of event:</td><td><input type = "text", name = "event"></td></tr>
	<tr><td>Date</td><td><input type = "date", name = "date"></td></tr>
	<tr><td>Time</td><td><input type = "time", name = "time"></td></tr>
	<tr><td>Location:</td><td><input type = "text", name = "location"></td></tr>
	<tr><td>Zip Code:</td><td><input type = "text", name = "zip"></td></tr>
	<tr><td>Type of sport:</td><td><select name = "sport"><option value = "football">Football<option value = "baseball">Baseball<option value = "basketball">Basketball<option value = "soccer">Soccer</td></tr>
</table>
	Advertise your event:<br>
	<textarea rows = "10" cols = "30" name = "ad"></textarea><br>
	<input type = "submit">
</form>
</body>
</html>
