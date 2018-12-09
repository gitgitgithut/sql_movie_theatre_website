<!DOCTYPE html>
<html>
	<body>
	<?php
	session_start();
	$account_num = $_SESSION["account_num"];
	?>
	<table>
	<?php
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
	$email = $_POST["email"];
	$stNo = $_POST["stNo"];
	$stName = $_POST["stName"];
	$postal = $_POST["postal"];
	$phone = $_POST["phoneNo"];
	$ccNum = $_POST["ccNum"];
	$ccExpire = $_POST["ccExpire"];
	$csn = $_POST["csn"];
	$dbh = new PDO('mysql:host=localhost;dbname=332project',"root", "");
	
	$result = $dbh->exec("update customer set fname = '$fname', lname = '$lname', password = '$password', email = '$email', street_number = $stNo, street_name = '$stName', postal_code = '$postal', phone_number = $phone, cc_number = $ccNum, cc_expiry_date = '$ccExpire', cc_security_num = $csn where account_number = $account_num
	;");
	header("location: playing_movie.html");
	?>
	</table>
	</body>
</html>