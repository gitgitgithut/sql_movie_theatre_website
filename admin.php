<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="omts.css">
    <link rel="stylesheet" href="picker.min.css">
    <script type="text/javascript" src="picker.min.js"></script>
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
        <h1>Admin Panel</h1>

        <h2>List all the members</h2>
        <table>
            <thead>
                <tr>
                    <th>Account Number</th>
                    <th>Name</th>
                    <th>Phone #</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

                    $rows = $dbh->query("SELECT * FROM customer");

                    foreach ($rows as $row) {
                        print("<tr>");
                        print("<td>$row[account_number]</td>");
                        print("<td>$row[fname] $row[lname]</td>");
                        print("<td>$row[phone_number]</td>");
                        print("</tr>");
                    }

                    // Close the connection to the DB
                    $dbh = null;
                ?>
            </tbody>
        </table>

        <h2>Remove a Customer</h2>
        <p>Removing a customer will also remove all reviews and reservations associated with that customer.</p>
        <form action="remove-customer.php" method="post">
            <div>
                <label for="account_number">Customer Account Number</label>
                <select name="account_number" id="account_number">
                    <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");
                        $rows = $dbh->query("SELECT account_number FROM customer");
                        foreach ($rows as $row) {
                            print("<option value=\"$row[0]\">$row[0]</option>");
                        }
                        $dbh = null;
                    ?>  
                </select>
            </div>
            <div>
                <input type="submit" value="Remove Customer">
            </div>
        </form>

        <h2>Add or update the information for a theatre complex/theatre</h2>
        <p>If a theatre complex already exists in the database with the name given, that theatre complex will be updated to match the given values. If no theatre complex exists with the given name, a new theatre complex with the given information will be inserted.</p>
        <form action="upsert-theatre-complex.php" method="post">
            <div>
                <label for="complex_name">Name</label>
                <input name="complex_name" id="complex_name" type="text">
            </div>
            <div>
                <label for="complex_street_name">Street Name</label>
                <input name="complex_street_name" id="complex_street_name" type="text">
            </div>
            <div>
                <label for="complex_street_number">Street Number</label>
                <input name="complex_street_number" id="complex_street_number" type="text">
            </div>
            <div>
                <label for="complex_postal_code">Postal Code</label>
                <input name="complex_postal_code" id="complex_postal_code" type="text">
            </div>
            <div>
                <label for="complex_phone_number">Phone Number</label>
                <input name="complex_phone_number" id="complex_phone_number" type="text">
            </div>
            <div>
                <input type="submit" value="Upsert Theatre Complex">
            </div>
        </form>

        <h2>Add or update the information for a movie</h2>
        <p>If a movie already exists in the database with the title given, that movie will be updated to the given values. If no movie exists with the given title, a new movie with the given information will be inserted.</p>
        <form action="upsert-movie.php" method="post">
            <div>
                <label for="movie_title">Title</label>
                <input name="movie_title" id="movie_title" type="text">
            </div>
            <div>
                <label for="movie_director">Director</label>
                <input name="movie_director" id="movie_director" type="text">
            </div>
            <div>
                <label for="movie_plot">Plot</label>
                <input name="movie_plot" id="movie_plot" type="text">
            </div>
            <div>
                <label for="movie_production_company">Production Company</label>
                <input name="movie_production_company" id="movie_production_company" type="text">
            </div>
            <div>
                <label for="movie_rating">Rating</label>
                <input name="movie_rating" id="movie_rating" type="text">
            </div>
            <div>
                <label for="movie_run_time">Run Time</label>
                <input name="movie_run_time" id="movie_run_time" type="text">
            </div>
            <div>
                <label for="movie_supplier">Supplier</label>
                <select name="movie_supplier" id="movie_supplier">
                    <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");
                        $rows = $dbh->query("SELECT company_name FROM supplier");
                        foreach ($rows as $row) {
                            print("<option value=\"$row[0]\">$row[0]</option>");
                        }
                        $dbh = null;
                    ?>
                </select>
            </div>
            <div>
                <input type="submit" value="Upsert Movie">
            </div>
        </form>

        <h2>Update where/when movies are showing</h2>
        <p>You can either remove an existing showing using the table below or add a new showing using the form below.</p>
        <h3>Remove an Existing Showing</h3>
        <table>
            <thead>
                <tr>
                    <th>Movie Title</th>
                    <th>Theatre Complex</th>
                    <th>Theatre Number</th>
                    <th>Start Time and Date</th>
                    <th>Available Seats</th>
                    <th>Controls</th>
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
                    print("<td>$row[available_seats]</td>");
                    print("<td>
                        <form action=\"remove-showing.php\" method=\"post\">
                            <input type=\"hidden\" name=\"showing_title\" id=\"showing_title\" value=\"$row[title]\">
                            <input type=\"hidden\" name=\"showing_theatre_complex\" id=\"showing_theatre_complex\" value=\"$row[theatre_complex]\">
                            <input type=\"hidden\" name=\"showing_theatre_number\" id=\"showing_theatre_number\" value=\"$row[theatre_number]\">
                            <input type=\"hidden\" name=\"showing_start_time_and_date\" id=\"showing_start_time_and_date\" value=\"$row[start_time_and_date]\">
                            <input type=\"submit\" value=\"delete\">
                        </form>
                    </td>");
                    print("</tr>");
                }

                // Close the connection to the DB
                $dbh = null;

                ?>

            </tbody>
        </table>
        <h3>Add a New Showing</h3>
        <form action="insert-showing.php" method="post">
            <div>
                <label for="showing_title">Movie Title</label>
                <select name="showing_title" id="showing_title">
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
                <label for="showing_theatre_complex">Theatre Complex</label>
                <select name="showing_theatre_complex" id="showing_theatre_complex">
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
                <label for="showing_theatre_number">Theatre Number</label>
                <select name="showing_theatre_number" id="showing_theatre_number">
                    <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");
                        $rows = $dbh->query("SELECT theatre_number FROM theatre");
                        foreach ($rows as $row) {
                            print("<option value=\"$row[0]\">$row[0]</option>");
                        }
                        $dbh = null;
                    ?>
                </select>
                <p><b>Note</b>: Theatre number needs to be fixed. It should only show the theatre numbers that are available in the currently selected theatre complex.</p>
            </div>
            <div>
                <label for="showing_start_time_and_date">Start Time and Date</label>
                <input type="text" name="showing_start_time_and_date" id="showing_start_time_and_date" class="form-control js-full-picker">
                <script>
                    new Picker(document.querySelector('.js-full-picker'), {
                        format: 'YYYY-MM-DD HH:mm:ss',
                    });
                </script>
            </div>
            <div>
                <input type="submit" value="Add New Showing">
            </div>
        </form>

        <h2>For a particular customer, show their rental history (including current tickets held)</h2>
        <form action="rental-history.php" method="post">
            <div>
                <label for="rental_history_account_number">Account Number</label>
                <select name="rental_history_account_number" id="rental_history_account_number">
                    <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");
                        $rows = $dbh->query("SELECT account_number FROM customer");
                        foreach ($rows as $row) {
                            print("<option value=\"$row[0]\">$row[0]</option>");
                        }
                        $dbh = null;
                    ?>  
                </select>
            </div>
            <div>
                <input type="submit" value="Get Rental History">
            </div>
        </form>

        <h2>Find the movie that is the most popular (ie. has sold the most tickets across all theatres).</h2>
        <?php
            $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");
            $rows = $dbh->query("SELECT title, SUM(num_tickets) FROM reservation INNER JOIN showing ON reservation.showing_id = showing.showing_id GROUP BY title ORDER BY SUM(num_tickets) DESC LIMIT 1");
            foreach ($rows as $row) {
                print("<p>The most popular movie is <b>$row[0]</b>, which has <b>$row[1]</b> tickets sold.");
            }
            $dbh = null;
        ?>

        <h2>Find the theatre complex that is most popular (ie. has sold the most tickets across all movies)</h2>
        <?php
            $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");
            $rows = $dbh->query("SELECT theatre_complex, SUM(num_tickets) FROM reservation INNER JOIN showing ON reservation.showing_id = showing.showing_id GROUP BY theatre_complex ORDER BY SUM(num_tickets) DESC LIMIT 1");
            foreach ($rows as $row) {
                print("<p>The most popular theatre complex is <b>$row[0]</b>, which has <b>$row[1]</b> tickets sold.");
            }
            $dbh = null;
        ?>

    </div>
</body>
</html>
