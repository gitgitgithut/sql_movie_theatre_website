<!DOCTYPE html>
<html>
<body>
<h3> Movie Information </h3>
<style>
table, td{
    border: 1px solid black;
}
</style>
<table>

<?php
	$movieName = $_POST["movieInformation"];
	$dbh = new PDO('mysql:host=localhost;dbname=332project', "root", "");
	$movieQuery = $dbh->query("select * from movie where title = '$movieName'");
	$actorInfo = $dbh->query("select * from actor where title = '$movieName'");

	if(empty($movieQuery)){
		echo 'Information on this movie in unavailable!'; 
	}
	else{
		echo "<table>";
		echo "<tr>
				<th>Movie Name</th>
				<th>Run Time(mins)</th>
				<th>Rating</th>
				<th>Director</th>
				<th>Plot</th>
				<th>Production Company</th>
				<th>Supplier</th>
				<th>Movie Actor</th>
			   </tr>";
		foreach($movieQuery as $row1){
			echo "<tr><td>".$row1["title"]."</td><td>".$row1["run_time"]."</td><td>".$row1["rating"]."</td><td>".$row1["director"]."</td><td>".$row1["plot"]."</td><td>".$row1["production_company"]."</td><td>".$row1["supplier"]."</td>";
		}
		foreach($actorInfo as $row2){
			echo "<td>".$row2["name"]."</td></tr>";
		}
		echo "</table>";
	    $dbh = null;
	}	
?>
</table>
</body>
</html>