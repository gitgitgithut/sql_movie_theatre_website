<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upsert Theatre Complex</title>
    <link rel="stylesheet" href="omts.css">
</head>
<body>
    <div id="wrapper">
        <h1>Upsert Theatre Complex</h1>
        <?php 

            $name = $_POST["complex_name"];
            $street_name = $_POST["complex_street_name"];
            $street_number = $_POST["complex_street_number"];
            $postal_code = $_POST["complex_postal_code"];
            $phone_number = $_POST["complex_phone_number"];

            $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

            // Unsanitized input is acceptable for the purposes of this project. In the
            // real world obviously this is a really bad idea.
            $existing = $dbh->prepare("SELECT name FROM theatre_complex WHERE name = '$name'");

            if ($existing->execute() && $existing->rowCount() > 0) {
                $updateResult = $dbh->prepare("UPDATE theatre_complex SET street_name = '$street_name', street_number = $street_number, postal_code = '$postal_code', phone_number = $phone_number WHERE name = '$name'");
                if ($updateResult->execute()) {
                    echo "<p>Successfully updated theatre complex: $name.</p>";
                } else {
                    echo "<p>There was a problem updating the theatre complex: $name.</p>";
                    $err = $insertResult->errorInfo()[2];
                    echo "<p>Error message:</p>";
                    echo "<pre>$err</pre>";
                }
            } else {
                $insertResult = $dbh->prepare("INSERT INTO theatre_complex (name, street_name, street_number, postal_code, phone_number) VALUES ('$name', '$street_name', $street_number, '$postal_code', $phone_number)");
                if ($insertResult->execute()) {
                    echo "<p>Successfully inserted new theatre complex $name.</p>";
                } else {
                    echo "<p>There was a problem inserting the theatre complex: $name.</p>";
                    $err = $insertResult->errorInfo()[2];
                    echo "<p>Error message:</p>";
                    echo "<pre>$err</pre>";
                }
            }

            // Close the connection to the DB
            $dbh = null;

        ?>
        <p><a href="/admin.php">Return to Admin Panel</a></p>
    </div>
</body>
</html>
