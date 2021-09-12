<?php
$servername = 'nkc353.encs.concordia.ca';
$username = 'nkc353_1';
$password = 'jak353';
$dbServerHost = "login.encs.concordia.ca";
$dbName = "nkc353_1";
// Create connection
//$conn = new mysqli($servername, $username, $password,'nkc353_1','3306');

//shell_exec("ssh -fNg -L 3307:nkc353.encs.concordia.ca:3306 ssh@login.encs.concordia.ca");//("ssh -L 3306:nkc353.encs.concordia.ca:3306 login.encs.concordia.ca");
$conn = new mysqli($servername, $username, $password, $dbName);
//shell_exec("ssh -f -L $dbServerHost:3307:$dbServerHost:3306 user@login.encs.concordia.ca sleep 60 >> logfile");
// $connection = ssh2_connect($dbServerHost, 22, [], []);
// $conn = mysqli_connect($dbServerHost, $username, $password, $dbName, 3306, $connection);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "connected";
?>
