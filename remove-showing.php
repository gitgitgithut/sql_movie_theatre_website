<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove Showing</title>
    <link rel="stylesheet" href="omts.css">
</head>
<body>
    <div id="wrapper">
        <h1>Remove Showing</h1>
        <?php 

            $title = $_POST["showing_title"];
            $theatre_complex = $_POST["showing_theatre_complex"];
            $theatre_number = $_POST["showing_theatre_number"];
            $start_time_and_date = $_POST["showing_start_time_and_date"];

            $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

            // Unsanitized input is acceptable for the purposes of this project. In the
            // real world obviously this is a really bad idea.
            $rows = $dbh->prepare("
                DELETE FROM
                    showing
                WHERE
                    title = '$title' AND
                    theatre_complex = '$theatre_complex' AND
                    theatre_number = $theatre_number AND
                    start_time_and_date = '$start_time_and_date'");

            if ($rows->execute()) {
                echo "<p>Successfully deleted showing.</p>";
            } else {
                echo "<p>There was a problem removing the showing.</p>";
                $err = $insertResult->errorInfo()[2];
                $errCode = $insertResult->errorCode();
                echo "<p>Error Code: $errCode</p>";
                echo "<p>Error message:</p>";
                echo "<pre>$err</pre>";
            }

            // Close the connection to the DB
            $dbh = null;

        ?>
        <p><a href="/admin.php">Return to Admin Panel</a></p>
    </div>
</body>
</html>
