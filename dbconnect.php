<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = "";
$dbname = "Nightlife_hub";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error, 3, "error.log");
    die("Database connection failed. Please try again later.");
}

// Set charset
$conn->set_charset("utf8mb4");

// Uncomment the following line for debugging (do not use in production)
// echo "Connected successfully to the database 'nightlife_hub'";
