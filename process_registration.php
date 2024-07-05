<?php
// This code is used to register student in manage2.html
// Database connection settings
include 'database.php';

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
    $level = 100; 
    
    // Handle the file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Prepare SQL statement
            $sql = "INSERT INTO student (full_name, matric_id, gender, ic_number, school, image, level) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $fullName, $matricID, $gender, $icNumber, $school, $targetFile, $level);

            // Execute SQL statement
            if ($stmt->execute()) {
                echo "Registration Successful!";
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

    $conn->close();
    
    // Redirect to manage.php
    header("Location: manage.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSSCMUSM Management System - Register Student</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!--Header with title and PSSCMUSM logo-->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        <h1>PSSCMUSM Management System</h1>
    </header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="anr.html">Attendance & Records</a></li>
                <li><a href="sdm.html" class="active">Student Data Management</a></li>
                <li><a href="visual.html">Data Visualization</a></li>
            </ul>
            <button class="logout-btn">Logout</button>
        </nav>
    </div>

    <!-- Navigation text -->
    <div class="navigation-text">
        Student Data Management > Student List > Register Student
    </div>

    <div class="student-details-container">
        <form id="studentForm" action="process_registration.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullName">Full Name as in IC</label>
                <input type="text" id="fullName" name="fullName" oninput="this.value = this.value.toUpperCase()" required>
            </div>
            <div class="form-group inline">
                <label for="matricID">Matric ID</label>
                <input type="text" id="matricID" name="matricID" maxlength="10" required>
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="icNumber">IC Number:</label>
                <input type="text" id="icNumber" name="icNumber" placeholder="Enter IC Number" maxlength="12">
            </div>
            
            <div class="form-group">
                <label for="school">School</label>
                <input type="text" id="school" name="school" oninput="this.value = this.value.toUpperCase()" required>
            </div>
            <div class="form-group">
                <label for="image">Image (.png format)</label>
                <input type="file" id="image" name="image" accept=".png" required>
            </div>
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <!--Referring to external JavaScript file-->
    <script src="script.js" defer></script>

    <script>
        // Add event listener to the logout button
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // Redirect to login.html
            window.location.href = 'login.html';
        });
    </script>
</body>
</html>
