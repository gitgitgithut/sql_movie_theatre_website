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
	$review = $_POST["movieReview"];
	$dbh = new PDO('mysql:host=localhost;dbname=332project', "root", "");
	$reviewQuery = $dbh->query("select title, stars, review_text from review where title = '$review'");
	$count = $reviewQuery->rowCount();
		
	if($count < 1){
		echo '<h5>No reviews have been made about this movie yet!</h5>';
		echo '<form action="addReview.html" method="post">
				<p>Add a review for a movie?</p>
				<input type="submit" value="Write Review!">
			  </form>'; 
	}
	else{
		echo "<table>";
		echo "<tr>
				<th>Movie Name</th>
				<th>Stars (/5)</th>
				<th>Review</th>
			   </tr>";
		foreach($reviewQuery as $row1){
			echo "<tr><td>".$row1["title"]."</td><td>".$row1["stars"]."</td><td>".$row1["review_text"]."</td></tr>";
		}
		echo "</table>";
	    $dbh = null;
	}	
?>
</table>
</body>
</html>