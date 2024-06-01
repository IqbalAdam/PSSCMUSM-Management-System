<?php
// Include database configuration file
//include_once 'database.php';

// Prepare and execute SQL query to fetch student information
$result = $conn->query("SELECT * FROM students");

// Fetch student data and store in array
$students = array();
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

// Convert array to JSON and output
echo json_encode($students);

// Close database connection
$conn->close();
?>
