<!DOCTYPE html>
<html>
	<body>

	<?php
		session_start();
		$account_num = $_SESSION["account_num"];
	?>

	<table>
	<?php
		$stars = $_POST["stars"];
		$review = $_POST["review"];
		$title = $_POST["title"];
		$queue = "insert into review values(
			'$title', $account_num, $stars, '$review'
		);";
			$dbh = new PDO('mysql:host=localhost;dbname=332project',"root", "");
			$result = $dbh->exec($queue);	
		if ($result == 0) {
			echo "Submittion failed!";
		} else {
			echo "Your review has been submitted!";
		}
	?>
	</table>
	</body>
</html>