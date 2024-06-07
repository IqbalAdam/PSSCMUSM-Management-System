<?php
header('Content-Type: application/json');

include 'database';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

if (!isset($_GET['id'])) {
    die(json_encode(["error" => "ID not provided"]));
}

$id = intval($_GET['id']);
$sql = "SELECT full_name, matric_ID, gender, school, image FROM student WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "No student found with ID $id"]);
}

$conn->close();
?>
