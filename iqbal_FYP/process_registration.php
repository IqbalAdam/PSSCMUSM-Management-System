<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // default XAMPP username
$password = ""; // default XAMPP password is empty
$dbname = "pms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullName = strtoupper($_POST['fullName']);
    $matricID = $_POST['matricID'];
    $gender = $_POST['gender'];
    $icNumber = $_POST['icNumber'];
    $school = strtoupper($_POST['school']);
    
    // Handle the file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Prepare SQL statement
            $sql = "INSERT INTO student (full_name, matric_id, gender, ic_number, school, image) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $fullName, $matricID, $gender, $icNumber, $school, $targetFile);

            // Execute SQL statement
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}

$conn->close();
?>
