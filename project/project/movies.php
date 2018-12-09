<?php

$dbh = new PDO('mysql:host=localhost;dbname=332project;', "root", "");

$rows = $dbh->query("SELECT * FROM movie");

foreach ($rows as $row) {
    echo $row[0] . "<br>";
}

$dbh = null;

?>