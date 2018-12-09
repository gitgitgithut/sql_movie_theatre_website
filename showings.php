<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Showings</title>
    <link rel="stylesheet" href="omts.css">
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="showings.php">Showings</a></li>
        <li><a href="admin.php">Admin Panel</a></li>
    </ul>
    <div id="wrapper">
        <h1>All Showings</h1>
        <p>Browse movies playing at all theatre complexes.</p>
        <table>
            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Theatre Complex</th>
                    <th>Theatre Number</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>

                <?php

                // Get database access
                $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

                $rows = $dbh->query("SELECT * FROM showing");

                foreach ($rows as $row) {
                    print("<tr>");
                    print("<td>$row[title]</td>");
                    print("<td>$row[theatre_complex]</td>");
                    print("<td>$row[theatre_number]</td>");
                    print("<td>$row[start_time_and_date]</td>");
                    print("</tr>");
                }

                // Close the connection to the DB
                $dbh = null;

                ?>

            </tbody>
        </table>
    </div>
</body>
</html>
