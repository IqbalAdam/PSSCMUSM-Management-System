<?php
// This code is used to view students who present in the selected class (RECORDS SUB-MODULE)
include 'database.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get class_id from query parameters
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;

// Fetch all students
$all_students_sql = "SELECT id, full_name, matric_ID, gender FROM student";
$all_students_result = $conn->query($all_students_sql);

$all_students = array();

if ($all_students_result->num_rows > 0) {
    while($row = $all_students_result->fetch_assoc()) {
        $all_students[$row['id']] = $row;
    }
}

// Fetch students who are present for the given class_id
$present_students_sql = "SELECT s.id, s.full_name, s.matric_ID, s.gender
                         FROM attendance a
                         JOIN student s ON a.student_id = s.id
                         WHERE a.class_id = ?";
$stmt = $conn->prepare($present_students_sql);
$stmt->bind_param("i", $class_id);
$stmt->execute();
$result = $stmt->get_result();

$present_students = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $present_students[$row['id']] = $row;
    }
}

$stmt->close();
$conn->close();

// Determine absent students
$absent_students = array_diff_key($all_students, $present_students);

// Prepare the response
$response = array(
    'present' => array_values($present_students),
    'absent' => array_values($absent_students)
);

header('Content-Type: application/json');
echo json_encode($response);
?>
