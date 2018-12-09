
<!Document>
<html>


<body>

<table>
<?php
session_start();
$account_num = $_SESSION["account_num"];
?>

<?php
function delete{
	
	
	
}

echo "<h1>Rental History for user $account</h1>";

$dbh = new PDO('mysql:host=localhost;dbname=332project',"root","");

$result = $dbh->prepare("select title,theatre_complex,theatre_num,num_tickets, start_time from reservation where account_number = $account_num order by start_time");
$result->execute();
$check = $result->rowCount();
if ($check != 0){
	echo "<tr><th>title</th><th>theatre_complex</th><th>theatre_number</th><th>tickets_reserved</th></tr>";	
	foreach($result as $row){
		echo "<tr><td>".$row["title"]."</td><td>".$row["theatre_complex"]."</td><td>".$row["theatre_num"]."</td><td>".$row["num_tickets"]."</td><td>".$row["start_time"]"</td></tr>";
		if ($row["start_time"] > new DateTime('now')){
				echo "<input type=\"submit\" name=\"cancel reservation\" value=\"\" />"
		}
	}
	$dbh = null;
}
else {
	echo "No user history available";
}
?>

</table>

</body>
</html>