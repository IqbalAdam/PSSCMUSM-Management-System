<?php
require 'path/to/phpMQTT.php'; // Ensure the path to phpMQTT.php is correct

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pms";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// MQTT server details
$server = "127.0.0.1"; // MQTT server IP
$port = 1883;
$topic = "rfid/id";

// Create a new MQTT client
$mqtt = new phpMQTT($server, $port, "PHPClientSubscriber");

if (!$mqtt->connect(true, NULL, "username", "password")) { // Add MQTT username/password if required
    exit(1);
}

// Subscribe to the MQTT topic
$mqtt->subscribe([$topic => ["qos" => 0, "function" => "procmsg"]]);

function procmsg($topic, $msg) {
    global $conn;
    
    $uid = $msg;
    // Fetch student details from the database
    $sql = "SELECT full_name, matric_ID, gender, school, image FROM student WHERE id = '$uid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentData = [
            'full_name' => $row['full_name'],
            'matric_ID' => $row['matric_ID'],
            'gender' => $row['gender'],
            'school' => $row['school'],
            'image' => $row['image']
        ];
        echo json_encode($studentData);
    } else {
        echo json_encode(['error' => 'Student not found']);
    }
}

while ($mqtt->proc()) {}

$conn->close();
$mqtt->close();
?>
