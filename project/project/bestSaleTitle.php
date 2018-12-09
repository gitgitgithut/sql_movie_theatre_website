<!DOCTYPE html>
<html>
	<body>
	<h1> Top Selling Movies</h1>
	
	<table>
	<?php
	$dbh = new PDO('mysql:host=localhost;dbname=332project',"root", "");
	$result = $dbh->query("select title, sum(num_tickets) as sales from reservation group by title");
	echo "<tr><th>Title</th><th>Sales</th></tr>";
	foreach($result as $row){
		echo "<tr><td>".$row["title"]."</td><td>".$row["sales"]."</td></tr>";
	}
	
	?>
	</table>
	</body>
</html>