<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Showing</title>
    <link rel="stylesheet" href="omts.css">
</head>
<body>
    <div id="wrapper">
        <h1>Insert Showing</h1>
        <?php 

            $title = $_POST["showing_title"];
            $theatre_complex = $_POST["showing_theatre_complex"];
            $theatre_number = $_POST["showing_theatre_number"];
            $start_time_and_date = $_POST["showing_start_time_and_date"];

            $dbh = new PDO('mysql:host=localhost;dbname=omts;', "root", "");

            // Unsanitized input is acceptable for the purposes of this project. In the
            // real world obviously this is a really bad idea.

            $insertResult = $dbh->prepare("
                INSERT INTO
                    showing (title, theatre_complex, theatre_number, start_time_and_date)
                VALUES
                    ('$title', '$theatre_complex', $theatre_number, '$start_time_and_date')");

            if ($insertResult->execute()) {
                echo "<p>Successfully inserted new showing for $title at $theatre_complex.</p>";
            } else {
                echo "<p>There was a problem inserting the showing.</p>";
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
