<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "requesttracker";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);


if ($conn) {
    // echo "Database Connected" . "<br>";
} else {
    mysqli_connect_error();
};
