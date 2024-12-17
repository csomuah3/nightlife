<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "Nightlife_hub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "add") {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $role = htmlspecialchars($_POST['role']);

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format!";
            exit;
        }

        // Insert user into database using prepared statements
        $stmt = $conn->prepare("INSERT INTO users (username, email, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $role);

        if ($stmt->execute()) {
            echo "User added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif ($action == "delete") {
        $user_id = intval($_POST['user_id']);

        // Delete user from database using prepared statements
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            echo "User deleted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Display users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nightclub Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        form {
            margin-top: 20px;
        }

        form div {
            margin-bottom: 15px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input,
        form select,
        form button {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Nightclub Admin Panel</h1>

        <!-- User Management Table -->
        <table>
            <thead>
                <tr>
                    <th>User_id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Safely display each field with defensive checks
                        $id = isset($row['User_id']) ? $row['User_id'] : 'N/A';
                        $username = isset($row['Username']) ? $row['Username'] : 'N/A';
                        $email = isset($row['Email']) ? $row['Email'] : 'N/A';
                        $role = isset($row['Role']) ? $row['Role'] : 'N/A';

                        echo "<tr>
                            <td>$id</td>
                            <td>$username</td>
                            <td>$email</td>
                            <td>$role</td>
                            <td>
                                <form action='admin-handler.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='user_id' value='$id'>
                                    <button type='submit' name='action' value='delete' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Add User Form -->
        <form action="admin-handler.php" method="post">
            <h2>Add New User</h2>
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div>
                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="guest">Guest</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <button type="submit" name="action" value="add">Add User</button>
            </div>
        </form>
    </div>

</body>

</html>

<?php
// Close the database connection
$conn->close();
?>