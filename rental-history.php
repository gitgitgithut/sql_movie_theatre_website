<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental History</title>
    <link rel="stylesheet" href="omts.css">
</head>
<body>
    <div id="wrapper">
        <h1>Rental History</h1>
        <p>Showing all reservations made by account number <b><?php echo $_POST["rental_history_account_number"]; ?></b>.</p>
        <table>
            <thead>
                <tr>
                    <th>Movie Title</th>
                    <th>Theatre Complex</th>
                    <th>Theatre Number</th>
                    <th>Num Tickets Purchased</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                    $account_number = $_POST["rental_history_account_number"];

                    $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

                    // Unsanitized input is acceptable for the purposes of this project. In the
                    // real world obviously this is a really bad idea.
                    $rows = $dbh->prepare("
                        SELECT
                            title, theatre_complex, theatre_num, num_tickets
                        FROM
                            reservation
                        WHERE
                            account_number = $account_number");

                    if ($rows->execute()) {
                        foreach ($rows as $row) {
                            echo "<tr>";
                            echo "<td>$row[title]</td>";
                            echo "<td>$row[theatre_complex]</td>";
                            echo "<td>$row[theatre_num]</td>";
                            echo "<td>$row[num_tickets]</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<p>There was a problem retrieving the reservation history.</p>";
                        $err = $rows->errorInfo()[2];
                        $errCode = $rows->errorCode();
                        echo "<p>Error Code: $errCode</p>";
                        echo "<p>Error message:</p>";
                        echo "<pre>$err</pre>";
                    }

                    // Close the connection to the DB
                    $dbh = null;

                ?>
            </tbody>
        </table>
        <p><a href="/admin.php">Return to Admin Panel</a></p>
    </div>
</body>
</html>
