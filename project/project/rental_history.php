#empty case not finished
<!Document>
<html>


<body>

<table>

<?php
$account = $_POST["account_number"];
echo "<h1>Rental History for user $account</h1>";

$dbh = new PDO('mysql:host=localhost;dbname=332project',"root","");

$result = $dbh->query("select title,theatre_complex,theatre_num,num_tickets from reservation where account_number = $account");
if (!empty($result)){
	echo "<tr><th>title</th><th>theatre_complex</th><th>theatre_number</th><th>tickets_reserved</th></tr>";	
	foreach($result as $row){
		echo "<tr><td>".$row["title"]."</td><td>".$row["theatre_complex"]."</td><td>".$row["theatre_num"]."</td><td>".$row["num_tickets"]."</td></tr>";
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