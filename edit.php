<?php
// This code is used to edit student test result in edit.php page
// Include the database connection file
include 'database.php';

$matric_id = $_GET['matric_id'];

// Fetch the student data based on matric_id
$sql = "SELECT full_name, matric_id, school, image, ic_number, test_1, test_2, theory FROM student WHERE matric_id='$matric_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No results found";
    exit();
}

// Update the student data if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $test_1 = $_POST['test_1'];
    $test_2 = $_POST['test_2'];
    $theory = $_POST['theory'];

    $update_sql = "UPDATE student SET test_1='$test_1', test_2='$test_2', theory='$theory' WHERE matric_id='$matric_id'";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Redirect to the result page after updating
    header("Location: result.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="edit-page">
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

    <!--Navigation header inside body-->
    <div class="navigation-text">
        Student Data Management > Student Results > Edit Result
    </div>

    <form method="POST" class="edit-form">
        <!-- Student Image -->
        <div class="student-image">
            <img src="<?php echo $row['image']; ?>" alt="Student Image">
        </div>
        <!-- Student Details -->
        <div class="student-details">
            <div class="student-detail">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo $row['full_name']; ?>" readonly>
            </div>
            <div class="student-detail">
                <label for="matric_id">Matric ID:</label>
                <input type="text" id="matric_id" name="matric_id" value="<?php echo $row['matric_id']; ?>" readonly>
            </div>
            <div class="student-detail">
                <label for="ic_number">IC Number:</label>
                <input type="text" id="ic_number" name="ic_number" value="<?php echo $row['ic_number']; ?>" readonly>
            </div>
            <div class="student-detail">
                <label for="school">School:</label>
                <input type="text" id="school" name="school" value="<?php echo $row['school']; ?>" readonly>
            </div>
        </div>
        <!-- Test Scores -->
        <div class="test-scores">
            <div class="test-score">
                <label for="test_1"><br>Test 1:</label>
                <input type="number" id="test_1" name="test_1" value="<?php echo $row['test_1']; ?>">
            </div>
            <div class="test-score">
                <label for="test_2"><br>Test 2:</label>
                <input type="number" id="test_2" name="test_2" value="<?php echo $row['test_2']; ?>">
            </div>
            <div class="test-score">
                <label for="theory"><br>Theory Test:</label>
                <input type="number" id="theory" name="theory" value="<?php echo $row['theory']; ?>">
            </div>
        </div>
        <button type="submit">Update</button>
        <button href="result.php" type="submit">Cancel</button>
    </form>
    
    <script>
        // Add event listener to the logout button
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // Redirect to login.html
            window.location.href = 'login.html';
        });
    </script>
</body>
</html>
