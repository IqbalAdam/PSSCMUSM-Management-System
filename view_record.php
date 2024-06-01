<?php
// This code is used to view students who present in the selected class (RECORDS SUB-MODULE)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get class_id from query parameters
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;

// Fetch student records for the given class_id
$sql = "SELECT s.id, s.full_name, s.matric_ID, s.gender
        FROM attendance a
        JOIN student s ON a.student_id = s.id
        WHERE a.class_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $class_id);
$stmt->execute();
$result = $stmt->get_result();

$students = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($students);
?>
