<?php

// Set the timezone for the MySQL connection
$timeZoneQuery = "SET time_zone = '+5:30' ";

// MySQLi Connection
$mysqli = new mysqli("localhost", "root", "", "admin_portal");
if ($mysqli->connect_errno) {
    die("Error in database connection: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");
$mysqli->query($timeZoneQuery);
