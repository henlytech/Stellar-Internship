<?php
$host = "localhost";
$port = "3307"; 
$user = "root";
$password = ""; 
$dbname = "stellar";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
