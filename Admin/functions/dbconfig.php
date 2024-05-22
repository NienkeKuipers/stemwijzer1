<?php
// Database configuration
$servername = "localhost";
$db_username = "root"; // replace with your MySQL username
$db_password = ""; // replace with your MySQL password
$dbname = "inlogtest";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

