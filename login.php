<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<body>
	<table>
	<?php
	$account_num= $_POST["account_num"];
	$password = $_POST["password"];
	$dbh = new PDO('mysql:host=localhost;dbname=332project',"root", "");
	$result = $dbh->prepare("select account_number, password from customer where account_number = $account_num and password = '$password'");
	$result->execute();
	$count = $result->rowCount();
	
	if ($count == 0){
		echo "User name or password is incorrect";
	}
	else{
		$dbh = null;
		$_SESSION['account_num'] = $account_num;
		header("location: customer_portal.php");
	}
	?>
	</table>
	</body>
</html>