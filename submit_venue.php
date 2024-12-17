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
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $latitude = floatval($_POST['latitude']);
    $longitude = floatval($_POST['longitude']);
    $music_genre = $conn->real_escape_string($_POST['music_genre'] ?? NULL);
    $ambiance = $conn->real_escape_string($_POST['ambiance'] ?? NULL);
    $description = $conn->real_escape_string($_POST['description'] ?? NULL);
    $average_rating = floatval($_POST['average_rating'] ?? 0);

    $sql = "INSERT INTO venues (name, address, latitude, longitude, music_genre, ambiance, description, average_rating, created_at)
            VALUES ('$name', '$address', $latitude, $longitude, 
                    " . ($music_genre ? "'$music_genre'" : "NULL") . ", 
                    " . ($ambiance ? "'$ambiance'" : "NULL") . ", 
                    " . ($description ? "'$description'" : "NULL") . ", 
                    $average_rating, NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "New venue added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
