<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "Nightlife_hub";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = intval($_POST['user_id']);
    $venue_id = intval($_POST['venue_id']);
    $rating = floatval($_POST['rating']);
    $review_text = $conn->real_escape_string($_POST['review_text'] ?? NULL);

    // Ensure rating is within the valid range
    if ($rating < 0 || $rating > 5) {
        die("Invalid rating value. Please provide a value between 0 and 5.");
    }

    $sql = "INSERT INTO reviews (user_id, venue_id, rating, review_text)
            VALUES ($user_id, $venue_id, $rating, " . ($review_text ? "'$review_text'" : "NULL") . ")";

    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
