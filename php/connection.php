<?php
$servername = 'group.encs.concordia.ca';
$username = 'username';
$password = 'pwd';
$dbServerHost = "login.encs.concordia.ca";
$dbName = "dbname";

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
