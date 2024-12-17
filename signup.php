<?php
// Include the database connection file
include 'dbconnect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : null;
    $membership_level = $_POST['membership_level'] ?? 'Basic';
    $loyalty_points = intval($_POST['loyalty_points'] ?? 0);

    // Validate required fields
    if (empty($username) || empty($email) || empty($password)) {
        echo "<p style='color: red;'>Username, Email, and Password are required.</p>";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color: red;'>Invalid email format.</p>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // SQL query with placeholders
    $sql = "INSERT INTO users (Username, Email, Password, Phone_number, Membership_level, Loyalty_points, Created_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())";

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssi", $username, $email, $hashed_password, $phone_number, $membership_level, $loyalty_points);

        // Execute the query and check for success
        if ($stmt->execute()) {
            echo "<p style='color: green;'>User registered successfully!</p>";
        } else {
            if ($stmt->errno == 1062) {
                // Handle duplicate entry errors (e.g., duplicate username or email)
                echo "<p style='color: red;'>Username or Email already exists!</p>";
            } else {
                echo "<p style='color: red;'>An error occurred. Please try again later.</p>";
            }
        }
        $stmt->close();
    } else {
        echo "<p style='color: red;'>Failed to prepare the SQL statement.</p>";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration Form</h2>
    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number"><br>

        <label for="membership_level">Membership Level:</label>
        <select id="membership_level" name="membership_level">
            <option value="Bronze">Bronze</option>
            <option value="Silver">Silver</option>
            <option value="Gold">Gold</option>
        </select><br>

        <label for="loyalty_points">Loyalty Points:</label>
        <input type="number" id="loyalty_points" name="loyalty_points" value="0" min="0"><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
