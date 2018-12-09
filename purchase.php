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
		<h1>Confirm Purchase</h1>
		
		<?php

			$Complex = $_POST["theatre_complex"];
			$title = $_POST["title"];
			$time = $_POST["start_time_and_date"];
			$theatre_num = $_POST["theatre_number"];
			$resTickets = $_POST["numTickets"];
			$showing_id = $_POST["showing_id"];
			
			echo "<tr><p>Your are going to reserve ".$resTickets." tickets for ".$title." at ".$Complex." theatre ".$theatre_num." on ".$time."</p>";

		?>

		<form action="confirmation.php" method="post">
			<input type="hidden" name="title" id="title" value="$title">
			<input type="hidden" name="showing_id" id="showing_id" value="$showing_id">
			<input type="hidden" name="ticket" id="ticket" value="$resTickets">
			<input type="submit" value="Confirm?">
		</form>
	</div>
</body>
</html>