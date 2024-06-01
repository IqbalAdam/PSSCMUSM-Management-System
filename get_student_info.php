<?php
//include 'databse.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rfid_id = $_GET['rfid_id'];

$sql = "SELECT full_name, matric_id, gender, school, image FROM student WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $rfid_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(array("error" => "No student found"));
}

$stmt->close();
$conn->close();
?>
