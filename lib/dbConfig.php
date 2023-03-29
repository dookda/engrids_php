<?php
//db details
$dbHost = 'localhost';
$dbUsername = 'postgres';
$dbPassword = '1234';
$dbName = 'alr';

//Connect and select the database
//$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>