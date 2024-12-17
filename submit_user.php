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
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing the password
    $phone_number = $conn->real_escape_string($_POST['phone_number'] ?? NULL);
    $membership_level = $conn->real_escape_string($_POST['membership_level']);
    $loyalty_points = intval($_POST['loyalty_points'] ?? 0);

    $sql = "INSERT INTO users (username, email, password, phone_number, membership_level, loyalty_points, created_at)
            VALUES ('$username', '$email', '$password', 
                    " . ($phone_number ? "'$phone_number'" : "NULL") . ", 
                    '$membership_level', $loyalty_points, NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
