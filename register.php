<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = "";
$dbname = "Nightlife_hub";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize form data
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $membership_level = $conn->real_escape_string($_POST['membership_level']);
    $role_level = $conn->real_escape_string($_POST['Role_Level']);
    //$loyalty_points = intval($_POST['loyalty_points']);

    // SQL query to insert the data
    $sql = "INSERT INTO users (Username, Email, Password, Phone_number, Membership_level, Created_at,role) 
            VALUES ('$username', '$email', '$password', '$phone_number', '$membership_level', NOW(), '$role_level')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {

        header("Location: login.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
