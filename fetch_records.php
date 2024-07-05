<?php
// This code is used to fetch records of the past classes in record.html (RECORD SUB-MODULE)
include 'database.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get total number of students
$studentQuery = "SELECT COUNT(*) as total_students FROM student";
$studentResult = $conn->query($studentQuery);
$studentRow = $studentResult->fetch_assoc();
$totalStudents = $studentRow['total_students'];

// Fetch class records from the database
$sql = "SELECT class_id, class_date FROM class";
$result = $conn->query($sql);

$records = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Get the attendance count for each class
        $class_id = $row['class_id'];
        $attendanceQuery = "SELECT COUNT(*) as attend FROM attendance WHERE class_id = $class_id";
        $attendanceResult = $conn->query($attendanceQuery);
        $attendanceRow = $attendanceResult->fetch_assoc();
        
        $attend = $attendanceRow['attend'];
        $percentage = ($attend / $totalStudents) * 100;

        $records[] = array(
            'class_id' => $row['class_id'],
            'date' => $row['class_date'],
            'attend' => $attend,
            'overall' => $totalStudents,
            'percentage' => $percentage
        );
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($records);
?>
