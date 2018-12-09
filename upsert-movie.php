<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upsert Movie</title>
    <link rel="stylesheet" href="omts.css">
</head>
<body>
    <div id="wrapper">
        <h1>Upsert Movie</h1>
        <?php 

            $title = $_POST["movie_title"];
            $director = $_POST["movie_director"];
            $plot = $_POST["movie_plot"];
            $production_company = $_POST["movie_production_company"];
            $rating = $_POST["movie_rating"];
            $run_time = $_POST["movie_run_time"];
            $supplier = $_POST["movie_supplier"];

            $dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

            // Unsanitized input is acceptable for the purposes of this project. In the
            // real world obviously this is a really bad idea.
            $existing = $dbh->prepare("SELECT title FROM movie WHERE title = '$title'");

            if ($existing->execute() && $existing->rowCount() > 0) {
                $updateResult = $dbh->prepare("UPDATE movie SET director = '$director', plot = '$plot', production_company = '$production_company', rating = '$rating', run_time = $run_time, supplier = '$supplier' WHERE title = '$title'");
                if ($updateResult->execute()) {
                    echo "<p>Successfully updated movie: $title.</p>";
                } else {
                    echo "<p>There was a problem updating \"$title\".</p>";
                    $err = $insertResult->errorInfo()[2];
                    echo "<p>Error message:</p>";
                    echo "<pre>$err</pre>";
                }
            } else {
                $insertResult = $dbh->prepare("INSERT INTO movie (title, director, plot, production_company, rating, run_time, supplier) VALUES ('$title', '$director', '$plot', '$production_company', '$rating', $run_time, '$supplier')");
                if ($insertResult->execute()) {
                    echo "<p>Successfully inserted new movie: $title.</p>";
                } else {
                    echo "<p>There was a problem inserting the movie.</p>";
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
