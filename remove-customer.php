<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove customer</title>
    <link rel="stylesheet" href="omts.css">
</head>
<body>
    <div id="wrapper">
        <h1>Remove Customer</h1>
        <?php 

            $account_number = $_POST["account_number"];

            $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

            // Unsanitized input is acceptable for the purposes of this project. In the
            // real world obviously this is a really bad idea.
            $rows = $dbh->query("DELETE FROM review WHERE account_number = $account_number");
            $rows = $dbh->query("DELETE FROM reservation WHERE account_number = $account_number");
            $rows = $dbh->query("DELETE FROM customer WHERE account_number = $account_number");

            if ($rows) {
                echo "<p>Customer successfully deleted. All reviews and reservations for that customer have also been deleted.</p>";
            } else {
                echo "<p>There was a problem deleting customer data.</p>";
            }

            // Close the connection to the DB
            $dbh = null;

        ?>
        <p><a href="/admin.php">Return to Admin Panel</a></p>
    </div>
</body>
</html>
