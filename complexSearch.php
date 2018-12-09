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
		<h1>Now Playing</h1>
		<table>

			<?php

				$complex = $_POST["complex"];

				$dbh = new PDO('mysql:host=localhost;dbname=332project', "root", "");

				$complexQuery = $dbh->prepare("SELECT title, start_time_and_date, theatre_complex FROM showing WHERE theatre_complex = '$complex' AND start_time_and_date <= CURRENT_TIMESTAMP");

				if ($complexQuery->execute() || $complexQuery->rowCount() === 0){
					echo "No movies at this theatre complex.";
				} else {
					echo "<table>";
					echo "<tr>
							<th>Movie Name</th>
							<th>Showtime (YEAR/MM/DD)</th>
							<th>Theatre Complex</th>
						   </tr>";
					foreach($complexQuery as $row) {
						echo "<tr><td>".$row["title"]."</td><td>".$row["start_time_and_date"]."</td><td>".$row["theatre_complex"]."</td><td>";
						echo "</td></tr>";
				    }
				    echo "</table>";
				    $dbh = null;
				}
			?>
		</table>
	</div>
</body>
</html>