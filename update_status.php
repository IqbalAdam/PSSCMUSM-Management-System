<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$class_id = $input['class_id'];
$student_id = $input['student_id'];
$status = $input['status'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

if ($status === 'PRESENT') {
    $sql = "INSERT INTO attendance (class_id, student_id) VALUES ('$class_id', '$student_id')";
} else {
    $sql = "DELETE FROM attendance WHERE class_id = '$class_id' AND student_id = '$student_id'";
}

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
