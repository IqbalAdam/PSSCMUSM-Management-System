<?php
// To fetch data in overall.html
// Establish connection to MySQL database
include 'database.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve selected month and year from POST request
$selectedMonth = $_POST['selectedMonth'];
$selectedYear = $_POST['selectedYear'];

// Get total number of students
$studentQuery = "SELECT COUNT(*) as total_students FROM student";
$studentResult = $conn->query($studentQuery);
$studentRow = $studentResult->fetch_assoc();
$totalStudents = $studentRow['total_students'];

// Query to retrieve data for the selected month and year
$sql = "SELECT c.class_date AS date, COUNT(a.student_id) AS present
        FROM class c
        LEFT JOIN attendance a ON c.class_id = a.class_id
        WHERE MONTH(c.class_date) = $selectedMonth AND YEAR(c.class_date) = $selectedYear 
        GROUP BY c.class_date";
$result = $conn->query($sql);

$data = array();
// Fetch data and format it for JavaScript
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Calculate the number of absent students
        $absent = $totalStudents - $row['present'];
        $data[] = array(
            "date" => $row['date'],
            "present" => $row['present'],
            "absent" => $absent
        );
    }
}

// Return JSON response
echo json_encode($data);

$conn->close();
?>
