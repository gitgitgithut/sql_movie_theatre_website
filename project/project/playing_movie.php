<!DOCTYPE html>
<html>
<body>
<h1> Now Playing Movies </h1>

<table>
<tr><th>Project Name</th><th>Available On</th><th>Location</th></tr>

<?php
$Complex = $_POST["Complex"];
#run a query to get the project names and locations of the person's department.
$dbh = new PDO('mysql:host=localhost;dbname=332project', "root", "");
#user name and password for mysql when using XAMPP is "root" and a blank password
$result = $dbh->query("select title, start_time_and_date, theatre_complex from showing where theatre_complex = $Complex and start_time_and_date >= CURDATE()");
foreach($result as $row) {
		echo "<tr><td>".$row["title"]."</td><td>".$row["start_time_and_date"]."</td><td>".$row["theatre_complex"]."</td></tr>";
    }
    $dbh = null;

?>

</body>
</html>