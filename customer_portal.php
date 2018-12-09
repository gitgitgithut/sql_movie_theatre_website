<?php
    session_start();
    $user_account_number = $_SESSION['account_num'];
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/omts.css">
</head>

<body>
    <div id="wrapper">
        <nav>
            <span id="logo">OMTS</span>
            <div>
                <a href="/customer_portal.php">Customer Portal</a>
                <a href="/admin.php">Admin Panel</a>
            </div>
        </nav>
        <h1>Customer Portal</h1>

        <h2>Theatre Complex Search</h2>
        <form action="complexSearch.php" method="post">
            <div>
                <label for="complex">Theatre Complex</label>
                <select name="complex" id="complex">
                    <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");
                        $rows = $dbh->query("SELECT name FROM theatre_complex");
                        foreach ($rows as $row) {
                            print("<option value=\"$row[0]\">$row[0]</option>");
                        }
                        $dbh = null;
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="GO!">
            </div>
        </form>

        <h2>Movie Search</h2>
        <form action="movie.php" method="post">
            <div>
                <label for="movieName">Movie</label>
                <select name="movieName" id="movieName">
                <?php
                    $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");
                    $rows = $dbh->query("SELECT title FROM movie");
                    foreach ($rows as $row) {
                    print("<option value=\"$row[0]\">$row[0]</option>");
                    }
                    $dbh = null;
                ?>
                </select>
            </div>
            <div>
                <input type="submit" value="GO!">
            </div>
        </form>

        <h2>View your purchases</h2>
        <p>You can cancel your purchase using the table below.</p>
        <table>
            <thead>
                <tr>
                    <th>Movie Title</th>
                    <th>Theatre Complex</th>
                    <th>Theatre Number</th>
                    <th>Start Time and Date</th>
                    <th>Available Seats</th>
                    <th>Number of Tickets</th>
                    <th>Controls</th>
                </tr>
            </thead>
            <tbody>

            <?php

                // Get database access
                $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

                $rows = $dbh->query("SELECT * FROM reservation INNER JOIN showing ON reservation.showing_id = showing.showing_id WHERE account_number = $user_account_number AND start_time_and_date >= CURRENT_TIMESTAMP");

                foreach ($rows as $row) {
                    print("<tr>");
                    print("<td>$row[title]</td>");
                    print("<td>$row[theatre_complex]</td>");
                    print("<td>$row[theatre_number]</td>");
                    print("<td>$row[start_time_and_date]</td>");
                    print("<td>$row[available_seats]</td>");
                    print("<td>$row[num_tickets]</td>");
                    print("<td>
                        <form action=\"remove-showing.php\" method=\"post\">
                            <input type=\"hidden\" name=\"showing_title\" id=\"showing_titl[title]\">
                            <input type=\"hidden\" name=\"showing_theatre_complex\" id=\"showing_theatre_complex\" value=\"$row[theatre_complex]\">
                            <input type=\"hidden\" name=\"showing_theatre_number\" id=\"showing_theatre_number\" value=\"$row[theatre_number]\">
                            <input type=\"hidden\" name=\"showing_start_time_and_date\" id=\"showing_start_time_and_date\" value=\"$row[start_time_and_date]\">
                            <input type=\"submit\" value=\"cancel\">
                        </form>
                    </td>");
                    print("</tr>");
                }

                // Close the connection to the DB
                $dbh = null;

                ?>

            </tbody>
        </table>

        <h2>Browse their past rentals</h2>
        <table>
            <thead>
                <tr>
                    <th>Movie Title</th>
                    <th>Theatre Complex</th>
                    <th>Theatre Number</th>
                    <th>Start Time and Date</th>
                    <th>Available Seats</th>
                    <th>Number of Tickets</th>
                </tr>
            </thead>
            <tbody>

            <?php

                // Get database access
                $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

                $rows = $dbh->query("SELECT * FROM reservation INNER JOIN showing ON reservation.showing_id = showing.showing_id WHERE account_number = $user_account_number AND start_time_and_date < CURRENT_TIMESTAMP");

                foreach ($rows as $row) {
                    print("<tr>");
                    print("<td>$row[title]</td>");
                    print("<td>$row[theatre_complex]</td>");
                    print("<td>$row[theatre_number]</td>");
                    print("<td>$row[start_time_and_date]</td>");
                    print("<td>$row[available_seats]</td>");
                    print("<td>$row[num_tickets]</td>");
                    print("</tr>");
                }

                // Close the connection to the DB
                $dbh = null;

                ?>

            </tbody>
        </table>

        <h2>Add a review for a movie</h2>
        <form action="addReview.php" method="post">
            <div>
                <label for="title">Movie</label>
                <select name="title" id="title">
                <?php
                    $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");
                    $rows = $dbh->query("SELECT title FROM movie");
                    foreach ($rows as $row) {
                    print("<option value=\"$row[0]\">$row[0]</option>");
                    }
                    $dbh = null;
                ?>
                </select>
            </div>
            <div>
                <label for="stars">Rating: (/5)</label>
                <input type="range" min="1" max="5" name="stars" required="required">
            </div>
            <div>
                <label>Review:</label>
                <textarea type="text" name="review" required="required"></textarea>
            </div>
            <div>
                <input type="submit" value="Submit Review">
            </div>
        </form>        

        <h2>Update Profile</h2>
        <a href="update_p.html">Update Profile</a>
    </div>
</body>
</html>