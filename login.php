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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_username = $conn->real_escape_string($_POST['username']);
    $input_password = $_POST['password'];

    // Check if the user exists by username or email
    $sql = "SELECT * FROM users WHERE username = '$input_username' OR email = '$input_username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($input_password, $user['Password'])) {
            // Start a session and store user info
            $_SESSION['user_id'] = $user['User_id'];  // Ensure this matches the actual column name
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role'] = $user['Role'];  // This stores the user's role (e.g., admin, staff, guest)

            // Redirect based on user role
            if ($_SESSION['role'] == 'Admin') {
                header("Location: adminpage.php");
                exit();
            } elseif ($_SESSION['role'] == 'Staff') {
                header("Location: booking.html");
                exit();
            } elseif ($_SESSION['role'] == 'Staff') {
                header("Location: booking.html");
                exit();
            
            else {
                header("Location: events.html");
                exit();
            }
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "User not found. Please check your username/email.";
    }
}

$conn->close();
