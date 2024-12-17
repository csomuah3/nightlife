<?php
header('Content-Type: application/json');

$host = "localhost";
$username = "root";
$password = "";
$dbname = "Nightlife_hub";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

$sql = "SELECT table_id AS id, CONCAT('Table #', table_id, ' - Venue ', venue_id) AS name FROM tables";
$result = $conn->query($sql);

$tables = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row;
    }
}

echo json_encode($tables);
$conn->close();
