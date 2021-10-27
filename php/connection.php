<?php
/**
** php code to connect to db, just include in file
**/

$servername = 'group.encs.concordia.ca';
$username = 'username';
$password = 'pwd';
$dbServerHost = "login.encs.concordia.ca";
$dbName = "dbname";

$conn = new mysqli("localhost", "root", "", "test", 3306);///new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
