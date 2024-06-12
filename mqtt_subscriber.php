<?php
// Need to run command 'php mqtt_subscriber.php' in terminal to make it running in background
require('phpMQTT\phpMQTT.php');

$server = 'broker.hivemq.com';
$port = 1883; // Use TCP port for MQTT
$username = ''; // Not needed for HiveMQ public broker
$password = ''; // Not needed for HiveMQ public broker
$client_id = 'phpMQTT-subscriber-' . uniqid(); // Unique client ID

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

if (!$mqtt->connect(true, NULL, $username, $password)) {
    exit(1);
}

$topics['attendance/rfid'] = array('qos' => 0, 'function' => 'procMsg');
$mqtt->subscribe($topics, 0);

function procMsg($topic, $msg) {
    // Write the hexadecimal message directly to latest_message.txt
    file_put_contents('latest_message.txt', $msg);
}

while ($mqtt->proc()) {
}

$mqtt->close();
?>
