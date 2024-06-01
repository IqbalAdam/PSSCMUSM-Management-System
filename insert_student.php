<?php
// Establishing connection to MySQL database
include 'databse.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO student (full_name, matric_id, gender, ic_number, school, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $full_name, $matric_id, $gender, $ic_number, $school, $image);

    // Set parameters and execute
    $full_name = $_POST['fullName'];
    $matric_id = $_POST['matricID'];
    $gender = $_POST['gender'];
    $ic_number = $_POST['icNumber'];
    $school = $_POST['school'];
    $image = $_FILES['image']['name']; // Assuming 'image' is the name of the file input

    // Move uploaded file to desired location
    $target_dir = "uploads/"; // Directory where you want to store uploaded images
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Execute prepared statement
    if ($stmt->execute()) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
