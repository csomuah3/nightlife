<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "Nightlife_hub";
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $venue_id = intval($_POST['venue_id']);
    $table_size = intval($_POST['table_size']);
    $package_details = $conn->real_escape_string($_POST['package_details'] ?? NULL);
    $amenities = $conn->real_escape_string($_POST['amenities'] ?? NULL);
    $price = floatval($_POST['price']);

    $sql = "INSERT INTO tables (venue_id, table_size, package_details, amenities, price)
            VALUES ($venue_id, $table_size, 
                    " . ($package_details ? "'$package_details'" : "NULL") . ", 
                    " . ($amenities ? "'$amenities'" : "NULL") . ", 
                    $price)";

    if ($conn->query($sql) === TRUE) {
        echo "New table added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
