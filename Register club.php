<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $club_name = htmlspecialchars($_POST['club_name']);
    $location = htmlspecialchars($_POST['location']);
    $owner_name = htmlspecialchars($_POST['owner_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $genre = htmlspecialchars($_POST['genre']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Save to a database (example with MySQL)
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Nightlife_hub";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO nightclubs (club_name, location, owner_name, email, phone, genre)
            VALUES ('$club_name', '$location', '$owner_name', '$email', '$phone', '$genre')";

    if ($conn->query($sql) === TRUE) {
        echo "Nightclub registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nightclub Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-container h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Register a Nightclub</h1>
        <form action="process-nightclub.php" method="post">
            <div class="form-group">
                <label for="club-name">Nightclub Name</label>
                <input type="text" id="club-name" name="club_name" placeholder="Enter nightclub name" required>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Enter location" required>
            </div>
            <div class="form-group">
                <label for="owner-name">Owner's Name</label>
                <input type="text" id="owner-name" name="owner_name" placeholder="Enter owner's name" required>
            </div>
            <div class="form-group">
                <label for="email">Contact Email</label>
                <input type="email" id="email" name="email" placeholder="Enter contact email" required>
            </div>
            <div class="form-group">
                <label for="phone">Contact Phone</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter contact phone number" required>
            </div>
            <div class="form-group">
                <label for="genre">Music Genre</label>
                <select id="genre" name="genre" required>
                    <option value="">Select a genre</option>
                    <option value="pop">Pop</option>
                    <option value="rock">Rock</option>
                    <option value="hiphop">Hip-Hop</option>
                    <option value="electronic">Electronic</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Register Nightclub</button>
            </div>
        </form>
    </div>

</body>

</html>