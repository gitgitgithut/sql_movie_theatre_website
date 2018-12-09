<?php
    session_start();
?>

<!DOCTYPE html>
<html>
	<body>
	
	<table>
	<?php

		session_start();

		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$password = $_POST["password"];
		$cpassword = $_POST["cpassword"];
		
		$email = $_POST["email"];
		$stNo = $_POST["stNo"];
		$stName = $_POST["stname"];
		$postal = $_POST["postal"];
		$phone = $_POST["phoneNo"];
		$ccNum = $_POST["ccNum"];
		$ccExpire = $_POST["ccExpire"];
		$csn = $_POST["csn"];
		$dbh = new PDO('mysql:host=localhost;dbname=332project',"root", "");

		if ($password == $cpassword) {

			// Generate random account number and make sure it hasn't been used already
			$check = 1;
			$new_account = 0;
			while ($check != 0) {
				$new_account = rand(100000, 999999);
				$result = $dbh->prepare("select account_number from customer where account_number = $new_account");
				$result->execute();
				$check = $result->rowCount();
			}
			
			// Do the insert of the new customer
			$result = $dbh->prepare("insert into customer values(
				$new_account, '$password', '$fname', '$lname', '$stName', $stNo, '$postal', '$phone', '$email', $ccNum, '$ccExpire', $csn
			);");

			if ($result->execute()) {
				echo '<SCRIPT>prompt("Registration successes! Taking you to the main page");</SCRIPT>';
				$_SESSION['account_num'] = $new_account;
				header("location: customer_portal.php");
			}
		} else {
			echo "<h1>Registration Error</h1>";
			echo '<p>The passwords did not match. <a href="index.html">Click here</a> to try again.</p>';
		}
	?>
	</table>
	</body>
</html>