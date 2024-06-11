<?php
require('phpMQTT.php');

$server = 'broker.hivemq.com';
$port = 1883; // Use TCP port for MQTT
$username = ''; // Not needed for HiveMQ public broker
$password = ''; // Not needed for HiveMQ public broker
$client_id = 'phpMQTT-subscriber-' . uniqid(); // Unique client ID

$mysqli = new mysqli("localhost", "root", "", "pms");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

if(!$mqtt->connect(true, NULL, $username, $password)) {
    exit(1);
}

$topics['attendance/rfid'] = array('qos' => 0, 'function' => 'procMsg');
$mqtt->subscribe($topics, 0);

function procMsg($topic, $msg){
    global $mysqli;

    // Convert the hexadecimal message to decimal
    $id = hexdec($msg);

    // Insert the student ID into the attendance table
    $stmt = $mysqli->prepare("INSERT INTO attendance (student_id) VALUES (?)");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

while($mqtt->proc()){
}

$mqtt->close();
$mysqli->close();
?>
