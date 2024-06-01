<?php
include 'database.php';

// This code is used to store date as selected in attend.html
// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected date from the form
$classDate = $_POST['class-date'];

// Convert the date to a format that MySQL can understand
$formattedDate = date('Y-m-d', strtotime($classDate));

// Insert the date into the 'class' table
$sql = "INSERT INTO class (class_date) VALUES ('$formattedDate')";

if ($conn->query($sql) === TRUE) {
    // Get the last inserted class_id
    $class_ID = $conn->insert_id;

    // Redirect to attend2.html with the class_ID as a parameter
    header("Location: attend2.html?class_ID=$class_ID");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
