<?php
// This code is used to register student in manage2.html
// Database connection settings
$servername = "localhost";
$username = "root"; 
$password = ""; 
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

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Prepare SQL statement
            $sql = "INSERT INTO student (full_name, matric_id, gender, ic_number, school, image) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $fullName, $matricID, $gender, $icNumber, $school, $targetFile);

            // Execute SQL statement
            if ($stmt->execute()) {
                echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>Registration Successful!";
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

// Redirect to manage.php
header("Location: manage.php");
exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--Referring to external JavaScript file-->
    <script src="script.js" defer></script>
</head>
<body>
    <!--Header with title and PSSCMUSM logo-->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        <h1>PSSCMUSM Management System</h1>
    </header>
</body>
</html>
