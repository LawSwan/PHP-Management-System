<?php
// Database connection settings.
// Connects to the complaints_app database using mysqli.
// $databaseConnection is used by the model functions when they run queries.

$databaseHost = "localhost";
$databaseUser = "root";
$databasePassword = "";
$databaseName = "velocitynet_db";

// Open the connection.
$databaseConnection = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

// Stop the page if the connection fails.
if ($databaseConnection == false) {
    die("Database connection failed.");
}
