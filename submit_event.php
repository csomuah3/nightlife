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
    $title = $conn->real_escape_string($_POST['title']);
    $start_time = $conn->real_escape_string($_POST['start_time']);
    $end_time = $conn->real_escape_string($_POST['end_time']);
    $description = $conn->real_escape_string($_POST['description'] ?? NULL);
    $early_bird_discount = floatval($_POST['early_bird_discount'] ?? NULL);
    $last_minute_deal = floatval($_POST['last_minute_deal'] ?? NULL);

    $sql = "INSERT INTO events (venue_id, title, start_time, end_time, description, early_bird_discount, last_minute_deal, created_at)
            VALUES ($venue_id, '$title', '$start_time', '$end_time', 
                    " . ($description ? "'$description'" : "NULL") . ", 
                    " . ($early_bird_discount ? $early_bird_discount : "NULL") . ", 
                    " . ($last_minute_deal ? $last_minute_deal : "NULL") . ", 
                    NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "New event created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
