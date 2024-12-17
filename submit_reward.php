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
    $points_earned = intval($_POST['points_earned']);
    $reward_description = $conn->real_escape_string($_POST['reward_description'] ?? NULL);
    $reward_claimed = intval($_POST['reward_claimed']);

    $sql = "INSERT INTO rewards (user_id, points_earned, reward_description, reward_claimed)
            VALUES ($user_id, $points_earned, " . ($reward_description ? "'$reward_description'" : "NULL") . ", $reward_claimed)";

    if ($conn->query($sql) === TRUE) {
        echo "Reward added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
