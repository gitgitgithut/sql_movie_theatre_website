<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="omts.css">
</head>

<body>
	<div id="wrapper">
	<nav>
		<span id="logo">OMTS</span>
		<div>
			<a href="/customer_portal.php">Customer Portal</a>
			<a href="/admin.php">Admin Panel</a>
		</div>
	</nav>
	<?php
		session_start();
		$account_num = $_SESSION["account_num"];
	?>

	<?php

		$movieName = $_POST["movieName"];

		echo "<h1>$movieName</h1>";

		$dbh = new PDO('mysql:host=localhost;dbname=332project', "root", "");

		$showingQuery = $dbh->prepare("select * from showing where title = '$movieName' and start_time_and_date <= CURDATE()");
		$showingQuery->execute();
		$check = $showingQuery->rowCount();

		$movieQuery = $dbh->prepare("select * from movie where title = '$movieName'");
		$movieQuery->execute();
		$movie = $movieQuery->fetch(PDO::FETCH_ASSOC);

		if ($check == 0){
			echo "That movie is not in the Theatres!";
		}
	?>

	<p><i><?php echo "$movie[run_time] minutes / Directed by $movie[director] / Rated $movie[rating]"; ?></i></p>
	<p><b>Plot Synopsis</b>: <?php echo "$movie[plot]"; ?></p>
	<p>Produced by <?php echo "$movie[production_company] and supplied by $movie[supplier]."; ?></p>

	<h2>Reviews</h2>
	<?php

		$dbh = new PDO('mysql:host=localhost;dbname=332project', "root", "");
		$reviewQuery = $dbh->prepare("select * from review inner join customer on review.account_number = customer.account_number where title = '$movieName'");

		if ($reviewQuery->execute()) {
			foreach ($reviewQuery as $review) {
				echo "<div>
				          $review[fname] $review[lname] rated the movie $review[stars] stars and said:
				          <blockquote><i>&ldquo;$review[review_text]&rdquo;</i></blockquote>
				      </div>";
			}
		} else {
            echo "<p>There was a problem getting reviews.</p>";
            $err = $reviewQuery->errorInfo()[2];
            echo "<p>Error message:</p>";
            echo "<pre>$err</pre>";
		}
		
	?>

	<h2>Purchase a Ticket</h2>

	<table>
		<thead>
			<tr>
				<th>Movie</th>
				<th>Start Time</th>
				<th>Theatre Complex</th>
				<th>Theatre Number</th>
				<th>Controls</th>
			</tr>
		</thead>
		<tbody>
			<?php
				echo "<tr>";

				foreach ($showingQuery as $row) {
					echo "<tr>";
					echo "<td>" . $row["title"] . "</td>";
					echo "<td>".$row["start_time_and_date"]."</td><td>".$row["theatre_complex"]."</td><td>".$row["theatre_number"]."</td>";
					echo "<td><form action = \"purchase.php\" method = \"post\">
					<input type=\"hidden\" name=\"title\" id=\"title\" value=\"$row[title]\">
					<input type=\"hidden\" name=\"showing_id\" id=\"showing_id\" value=\"$row[showing_id]\">
					<input type=\"hidden\" name=\"start_time_and_date\" id=\"start_time_and_date\" value=\"$row[start_time_and_date]\">
					<input type=\"hidden\" name=\"theatre_complex\" id=\"theatre_complex\" value=\"$row[theatre_complex]\">
					<input type=\"hidden\" name=\"theatre_number\" id=\"theatre_complex\" value=\"$row[theatre_number]\">
					<input type=\"text\" name = \"numTickets\" required=\"required\">
					<input type=\"submit\" value=\"buy\">
					</form></td>";

					echo '</tr>';
				}
			?>
			</tbody>
		</table>
	</div>
</body>
</html>