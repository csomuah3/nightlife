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
    $table_id = intval($_POST['table_id']);
    $event_id = intval($_POST['event_id']);
    $booking_date = $conn->real_escape_string($_POST['booking_date']);
    $status = $conn->real_escape_string($_POST['status']);
    $total_price = floatval($_POST['total_price']);

    $sql = "INSERT INTO bookings (user_id, table_id, event_id, booking_date, status, total_price)
            VALUES ($user_id, $table_id, $event_id, '$booking_date', '$status', $total_price)";

    if ($conn->query($sql) === TRUE) {
        echo "Booking created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
