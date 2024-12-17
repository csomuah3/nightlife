<?php
session_start();

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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values from the form
    $user_id = $_POST['user_id'];
    $table_id = $_POST['table_id'];
    $event_id = $_POST['event_id'];
    $booking_date = $_POST['booking_date'];
    $status = $_POST['status'];
    $total_price = $_POST['total_price'];

    // Insert the booking data into the database
    $sql = "INSERT INTO bookings (User_id, Table_id, Event_id, booking_date, Status, Total_price) 
            VALUES ('$user_id', '$table_id', '$event_id', '$booking_date', '$status', '$total_price')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
