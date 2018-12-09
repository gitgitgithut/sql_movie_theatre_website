<?php
	session_start();
	$account_num = $_SESSION["account_num"];
?>

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
		<h1>Confirm your purchase</h1>

		<?php

			$ticket_num = $_POST["ticket"];
			$showing_id = $_POST["showing_id"];

			$dbh = new PDO('mysql:host=localhost;dbname=332project', "root", "");

			$movieQuery = $dbh->prepare("INSERT INTO reservation VALUES($account_num, $showing_id, $ticket_num)");
			
			if ($movieQuery->execute()) {
				echo "<p>You have successfully reserved your tickets!</p>";
			} else {
				$result = $dbh->prepare("SELECT num_tickets FROM reservation WHERE account_number = $account_num AND showing_id = $showing_id");
				if ($result.execute()) {
					$temp = $result->fetch();
					$ticket = $temp[0] + $ticket_num;
					$updateQuery = $dbh->exec("update reservation set num_tickets = $ticket where account_number = $account_num and showing_id = $showing_id");
					if ($updateQuery >0){
						echo "You have successfully reserved your tickets!";
						echo "<a href = \"purchase_history.php\"><input type=\"submit\" value=\"View Purchase History\"></a>";
					}
					else{
						echo "Error!!!!";
					}
				} else {
					$err = $result.errorInfo()[2];
					echo $err;
				}
			}
		?>
		</table>
	</div>
</body>
</html>