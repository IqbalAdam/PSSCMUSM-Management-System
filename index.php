<?php

//This is mqtt attempt on 10/6/2024
require("phpMQTT.php");

$server = 'broker.hivemq.com';     // change if necessary
$port = 1883;                      // change if necessary
$username = '';                    // set your username
$password = '';                    // set your password
$client_id = 'phpMQTT-subscriber'; // make sure this is unique for connecting to server - you could use uniqid()

$mqtt = new phpMQTT($server, $port, $client_id);

if(!$mqtt->connect(true, NULL, $username, $password)) {
    exit(1);
}

$topics['attendance/rfid'] = array('qos' => 0, 'function' => 'procMsg');
$mqtt->subscribe($topics, 0);

while($mqtt->proc()) { }

$mqtt->close();

function procMsg($topic, $msg){
    // Save the message payload to a file
    file_put_contents('latest_message.txt', $msg);
    echo "Msg Recieved: " . date("r") . "\nTopic: {$topic}\n$msg\n\n";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Latest MQTT Message</title>
</head>
<body>
    <h1>Latest Message</h1>
    <p>
        <?php
        // Read the latest message from the file and display it
        if (file_exists('latest_message.txt')) {
            echo htmlspecialchars(file_get_contents('latest_message.txt'));
        } else {
            echo 'No message received yet.';
        }
        ?>
    </p>
</body>
</html>
